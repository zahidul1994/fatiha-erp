<?php

namespace App\Http\Controllers\Common;
use PDF;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Expense;
use App\Helpers\Helper;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;
use App\Helpers\ErrorTryCatch;
use Sohibd\Laravelslug\Generate;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;

class ExpenseController extends Controller
{

    private $User;
    function __construct()
    {

        $this->middleware(function ($request, $next) {
            $this->User = Auth::user();
            if ($this->User->status == 0) {
                $request->session()->flush();
                return redirect('login');
            }
            return $next($request);
        });
        $this->middleware('permission:expense-list', ['only' => ['index', 'show']]);
        $this->middleware('permission:expense-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:expense-edit', ['only' => ['edit', 'update', 'updateStatus']]);
        $this->middleware('permission:expense-delete', ['only' => ['destroy']]);


    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

    try {
        $User = $this->User;

        if ($User->user_type == 'Superadmin') {
            $data = Expense::with('user','expensehead')->latest();
        } elseif ($User->user_type == 'Admin') {
            $data = Expense::with('user','expensehead')->whereadmin_id($this->User->id)->latest();
        } else {
            $data = Expense::with('user','expensehead')->whereshop_id($this->User->shop_id)->whereadmin_id($this->User->admin_id)->latest();
        }
        if ($request->ajax()) {
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) use ($User) {
                    $btn = '';
                    if ($User->can('expense-list')) {
                        $btn = '<a href=' . route(request()->segment(1) . '.expenses.show', (encrypt($data->id))) . ' class="btn btn-info btn-sm waves-effect" style="width:30px; padding: 5px"><i class="fas fa-file-pdf"></i></a>';
                        $btn .= '<a href=' . route(request()->segment(1) . '.expenses.edit', (encrypt($data->id))) . ' class="btn btn-warning btn-sm waves-effect" style="width:30px; padding: 5px;  margin-left:2px" ><i class="fa fa-edit"></i></a>';
                    }
                    $btn .= '</span>';
                    return $btn;
                })


                ->rawColumns(['action'])
                ->make(true);
        }
        $breadcrumbs = [
            ['link' => route(request()->segment(1) . '.dashboard'), 'name' => "Home"],
            ['link' => route(request()->segment(1) . '.expenses.index'), 'name' => "Expense"],
            ['name' => 'List'],
        ];

        return view('backend.common.expenses.index', compact('breadcrumbs'));
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
            ['link' => route(request()->segment(1) . '.expenses.index'), 'name' => "Expense"],
            ['name' => 'Create'],
        ];
        return view('backend.common.expenses.create', compact('breadcrumbs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        if ($this->User->user_type == 'Admin') {
            $adminId = Auth::id();
            $employeeId = NULL;
        } else {
            $adminId = Auth::user()->admin_id;
            $employeeId = Auth::id();
        }
        $this->validate(
            $request,
            [

                'shop_id' => 'required',
                'expense_amount' => 'required|numeric|between:1,99999999',
                'payment_method' => 'required',
                'expense_head_id' => 'required',

            ], [

                'shop_id.required' => "The Shop name field is required",
                'expense_amount.required' => "The  Expense Amount field is required",
                'expense_amount.min' => "The Product Price Minimum Length 1",
                'expense_amount.max' => "The Product Price  Maximum Length 99999999",
                'expense_head_id.required' => "The Expense Head Name field is required",
                'payment_method.required' => "The Payment Method Name field is required",
            ]
        );

        if ($request->hasfile('attachfile')) {
            if (!is_dir(storage_path() . "/app/public/files/shares/uploads/" .  $adminId . "/expenses/thumbs/")) {
                mkdir(storage_path() .  "/app/public/files/shares/uploads/" .  $adminId . "/expenses/thumbs/", 0777, true);
            }
            $ex = $request->attachfile->extension();
            $rand = uniqid(Generate::Slug(Str::limit($request->attachfile, 40)));
            $name = $rand . "." . $ex;
            $request->attachfile->move(storage_path('/app/public/files/shares/uploads/' .  $adminId. "/expenses/"), $name, 60);

            $resizedImage_thumbs = Image::make(storage_path() . '/app/public/files/shares/uploads/' .  $adminId . "/expenses/". '/' . $name)->resize(35, null, function ($constraint) {
                $constraint->aspectRatio();
            });

            $resizedImage_thumbs->save(storage_path() . '/app/public/files/shares/uploads/' .  $adminId . "/expenses". '/thumbs/' . $name, 60);
            $path = 'storage/files/shares/uploads/' .  $adminId. "/expenses/";
        } else {
            $path = Helper::defaultImagePath();
            $name = Helper::defaultImageName();
        }

          try {
            DB::beginTransaction();
            $expenses = new Expense();
            $expenses->date = $request->date;
            $expenses->shop_id =$request->shop_id;
            $expenses->payment_method =  $request->payment_method;
            $expenses->expense_head_id =  $request->expense_head_id;
            $expenses->expense_amount =  $request->expense_amount;
            $expenses->transaction_number =  $request->transaction_number;
            $expenses->phone_number =  $request->phone_number;
            $expenses->bank_account_number =  $request->bank_account_number;
            $expenses->bank_name =  $request->bank_name;
            $expenses->admin_id =  $adminId;
            $expenses->employee_id =  $employeeId;
            $expenses->created_user_id = $this->User->id;
            $expenses->updated_user_id = $this->User->id;
            $expenses->notes =  $request->note;
            $expenses->path =  $path;
            $expenses->attachment =  $name;
            $expenses->status =  1;
            $expenses->save();
            DB::commit();
            Toastr::success("Expense Added Successfully", "Success");
            return redirect()->route(request()->segment(1) . '.expenses.index');
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
        // try {
            $User = $this->User;
            if ($User->user_type == 'Superadmin') {
                $expenses = Expense::with( 'shop','user')->findOrFail(decrypt($id));
            } elseif ($User->user_type == 'Admin') {
                $expenses = Expense::with('shop', 'user')->whereadmin_id($this->User->id)->findOrFail(decrypt($id));
            } else {
                $expenses = Expense::with('shop', 'user')->whereadmin_id($this->User->admin_id)->findOrFail(decrypt($id));
            }
            $pdf = PDF::loadView('backend.common.expenses.pdf',compact('expenses'));
            return $pdf->stream('expense_invoice_' . now() . '.pdf');
        // } catch (\Exception $e) {
        //     $response = ErrorTryCatch::createResponse(false, 500, 'Internal Server Error.', null);
        //     Toastr::error($response['message'], "Error");
        //     return back();
        // }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $User = $this->User;
            if ($User->user_type == 'Superadmin') {
                $data = Expense::with('user', 'expensehead')->findOrFail(decrypt($id));
            } elseif ($User->user_type == 'Admin') {
                $data = Expense::with('user','expensehead')->whereadmin_id($this->User->id)->findOrFail(decrypt($id));
            } else {
                $data = Expense::with('user','expensehead')->whereadmin_id($this->User->admin_id)->findOrFail(decrypt($id));
            }
            return view('backend.common.expenses.edit')->with('expense', $data);
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
    public function update(Request $request, string $id)
    {

        $expenses = Expense::find($id);
        if ($this->User->user_type == 'Admin') {
            $adminId = Auth::id();
            $employeeId = NULL;
        } else {
            $adminId = Auth::user()->admin_id;
            $employeeId = Auth::id();
        }
        $this->validate(
            $request,
            [

                'shop_id' => 'required',
                'expense_amount' => 'required|numeric|between:1,99999999',
                'payment_method' => 'required',
                'expense_head_id' => 'required',

            ], [

                'shop_id.required' => "The Shop name field is required",
                'expense_amount.required' => "The  Expense Amount field is required",
                'expense_amount.min' => "The Product Price Minimum Length 1",
                'expense_amount.max' => "The Product Price  Maximum Length 99999999",
                'expense_head_id.required' => "The Expense Head Name field is required",
                'payment_method.required' => "The Payment Method Name field is required",
            ]
        );

        if ($request->hasfile('attachment')) {
            if(file_exists($expenses->path . '/' . $expenses->attachment)){
                unlink(@$expenses->path . '/' . $expenses->attachment);
                unlink(@$expenses->path . '/thumbs/' . $expenses->attachment);
              }
            if (!is_dir(storage_path() . "/app/public/files/shares/uploads/" .  $adminId . "/expenses/thumbs/")) {
                mkdir(storage_path() .  "/app/public/files/shares/uploads/" .  $adminId . "/expenses/thumbs/", 0777, true);
            }
            $ex = $request->attachment->extension();
            $rand = uniqid(Generate::Slug(Str::limit($request->attachment, 40)));
            $name = $rand . "." . $ex;
            $request->attachment->move(storage_path('/app/public/files/shares/uploads/' .  $adminId. "/expenses/"), $name, 60);

            $resizedImage_thumbs = Image::make(storage_path() . '/app/public/files/shares/uploads/' .  $adminId. "/expenses" . '/' . $name)->resize(35, null, function ($constraint) {
                $constraint->aspectRatio();
            });

            $resizedImage_thumbs->save(storage_path() . '/app/public/files/shares/uploads/' .  $adminId . "/expenses". '/thumbs/' . $name, 60);
            $path = 'storage/files/shares/uploads/' .  $adminId. "/expenses/";
        } else {
            $path = $expenses->path;
            $name = $expenses->attachment;
        }
// dd($request->all());
          try {
            DB::beginTransaction();
            $expenses->date = $request->date;
            $expenses->shop_id =$request->shop_id;
            $expenses->payment_method =  $request->payment_method;
            $expenses->expense_head_id =  $request->expense_head_id;
            $expenses->expense_amount =  $request->expense_amount;
            $expenses->transaction_number =  $request->transaction_number;
            $expenses->phone_number =  $request->phone_number;
            $expenses->bank_account_number =  $request->bank_account_number;
            $expenses->bank_name =  $request->bank_name;
            $expenses->admin_id =  $adminId;
            $expenses->employee_id =  $employeeId;
            $expenses->created_user_id = $this->User->id;
            $expenses->updated_user_id = $this->User->id;
            $expenses->notes =  $request->notes;
            $expenses->path =  $path;
            $expenses->attachment =  $name;
            $expenses->status =  1;
            $expenses->save();
            DB::commit();
            Toastr::success("Expense Updated Successfully", "Success");
            return redirect()->route(request()->segment(1) . '.expenses.index');
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
}
