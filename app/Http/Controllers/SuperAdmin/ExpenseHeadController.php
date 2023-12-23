<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Helpers\ErrorTryCatch;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Validation\Rule;
use App\Models\ExpenseHead;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ExpenseHeadController extends Controller
{
    private $User;
    function __construct()
    {

        $this->middleware(function ($request, $next) {
            $this->User = Auth::user();
           
            return $next($request);
        });

       
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
       
        try {
            $User = $this->User;

          
                $data = ExpenseHead::with('user')->latest();
      
            if ($request->ajax()) {

                return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function ($data) use ($User) {
                        $btn = '';
                       
                            $btn = '<a href=' . route(request()->segment(1) . '.expense-head.edit', (encrypt($data->id))) . ' class="btn btn-info btn-sm waves-effect" style="margin-left: 5px"><i class="fa fa-edit"></i></a>';
                     
                        $btn .= '</span>';
                        return $btn;
                    })
                    ->addColumn('status', function ($data) {
                        if ($data->status == 0) {
                            return '<div class="form-check form-switch"><input type="checkbox" id="flexSwitchCheckDefault" onchange="updateStatus(this)" class="form-check-input"  value=' . $data->id . ' /></div>';
                        } else {
                            return '<div class="form-check form-switch"><input type="checkbox" id="flexSwitchCheckDefault" checked="" onchange="updateStatus(this)" class="form-check-input"  value=' . $data->id . ' /></div>';
                        }
                    })
                   ->rawColumns(['action', 'status'])
                    ->make(true);
            }
            $breadcrumbs = [
                ['link' => route(request()->segment(1) . '.dashboard'), 'name' => "Home"],
                ['link' => route(request()->segment(1) . '.expense-head.index'), 'name' => "expenseHead"],
                ['name' => 'List'],
            ];

            return view('backend.common.expense_head.index',compact('breadcrumbs'));
        } catch (\Exception $e) {
            $response = ErrorTryCatch::createResponse(false, 500, 'Internal Server Error.', null);
            Toastr::error($response['message'], "Error");
            return back();
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $breadcrumbs = [
            ['link' => route(request()->segment(1) . '.dashboard'), 'name' => "Home"],
            ['link' => route(request()->segment(1) . '.expense-head.index'), 'name' => "Expense Head"],
            ['name' => 'Create'],
        ];
        return view('backend.common.expense_head.create',compact('breadcrumbs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
     
        $this->validate($request,
            [
               'expense_name' => ['required','min:1',
                'max:255', Rule::unique('expense_heads')->where(function ($query){
                        return $query->where('superadmin_id', Auth::user()->id);
                    })
                ]               
                ],
            [
                'expense_name.unique' => "The Expense Head name field need to be unique",
                'expense_name.required' => "The Expense Head name field is required",
                'expense_name.min' => "The Expense Head Minimum field length 1",
                'expense_name.max' => "The Expense Head Maximum field length 255",
                
            ]);
       

        try {
            DB::beginTransaction();
            $expense_head = new ExpenseHead();
            $expense_head->expense_name = $request->expense_name;
            $expense_head->superadmin_id = $this->User->id;
           $expense_head->status = $request->status;
           $expense_head->save();
            DB::commit();
            if ($request->has('saveandback')) {
                Toastr::success("Expense Head Created Successfully  Done. Add  Another Expens Head", "Success");
                return redirect()->back();
            } else {
                Toastr::success("Expense Head Created Successfully", "Success");
                return redirect()->route(request()->segment(1) . '.expense-head.index');
            }
           
        } catch (\Exception $e) {
            DB::rollBack();
            $response = ErrorTryCatch::createResponse(false, 500, 'Internal Server Error.', null);
            Toastr::error($response['message'], "Error");
            return back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
      
        try {
            $User = $this->User;
            if ($User->user_type == 'Superadmin') {
                $data = ExpenseHead::findOrFail(decrypt($id));
            }
            
            return view('backend.common.expense_head.edit')->with('expenseHead', $data);
        } catch (\Exception $e) {
            DB::rollBack();
            $response = ErrorTryCatch::createResponse(false, 500, 'Internal Server Error.', null);
            Toastr::error($response['message'], "Error");
            return back();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    { 
        $this->validate($request,
            [
              
               'status' => 'required|min:0|max:100',
                'expense_name' => ['required','min:1',
                'max:255', Rule::unique('expense_heads')->ignore($id, 'id')->where(function ($query){
                        return $query->where('superadmin_id', Auth::user()->id);
                    })
                ]               
                ],
            [
                'expense_name.unique' => "The Expense Head name field need to be unique",
                'expense_name.required' => "The Expense Head name field is required",
                'expense_name.min' => "The Expense Head Minimum field length 1",
                'expense_name.max' => "The Expense Head Maximum field length 255",
                
                
                

            ]);
      

        try {
            DB::beginTransaction();
            $expense_head = ExpenseHead::find($id);
            $expense_head->expense_name = $request->expense_name;
            $expense_head->superadmin_id = $this->User->id;
           $expense_head->status = $request->status;
           $expense_head->save();
            DB::commit();
           Toastr::success("Expense Head Update Successfully", "Success");
            return redirect()->route(request()->segment(1) . '.expense-head.index');
        } catch (\Exception $e) {
            DB::rollBack();
            $response = ErrorTryCatch::createResponse(false, 500, 'Internal Server Error.', null);
            Toastr::error($response['message'], "Error");
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function updateStatus(Request $request)
    {
        $expense_head = ExpenseHead::findOrFail($request->id);
        $expense_head->status = $request->status;
        $expense_head->superadmin_id = Auth::id();
        if ($expense_head->save()) {
            return 1;
        }
        return 0;
    }
}
