<?php

namespace App\Http\Controllers\Admin;
use PDF;
use App\Models\Warehouse;
use App\Helpers\Helper;
use Illuminate\Http\Request;
use App\Helpers\ErrorTryCatch;
use Illuminate\Validation\Rule;
use App\Models\warehouseCurrentStock;
use Sohibd\Laravelslug\Generate;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;

class WarehouseController extends Controller
{
     private $User;
    function __construct()
    {

        $this->middleware(function ($request, $next) {
            $this->User = Auth::user();
            if ($this->User->status == 0) {
                $request->session()->flush();
                Toastr::error('Your Account was De active Please Contact with Support Center', "Error");
                return redirect('login');
            }
            return $next($request);
        });


    }
    public function index(Request $request)
    {

        try {
            $User = $this->User;
             $data = Warehouse::with('user')->whereadmin_id($this->User->id)->latest();

            if ($request->ajax()) {
                return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function ($data) use ($User) {
                        $btn = '<a href=' . route(request()->segment(1) . '.warehouses.show', (encrypt($data->id))) . ' class="btn btn-success btn-sm waves-effect" style="width:30px; padding: 5px"><i class="fa fa-eye"></i></a>';
                        $btn .= '<a href=' . route(request()->segment(1) . '.warehousePdf', (encrypt($data->id))) . ' class="btn btn-info btn-sm waves-effect" style="width:30px; padding: 5px;  margin-left:2px"><i class="fas fa-file-pdf"></i></a>';
                       $btn .= '<a href=' . route(request()->segment(1) . '.warehouses.edit', (encrypt($data->id))) . ' class="btn btn-warning btn-sm waves-effect" style="width:30px; padding: 5px;  margin-left:2px"><i class="fa fa-edit"></i></a>';
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
                ['link' => route(request()->segment(1) . '.warehouses.index'), 'name' => "Warehouse"],
                ['name' => 'List'],
            ];

            return view('backend.admin.warehouses.index',compact('breadcrumbs'));
        } catch (\Exception $e) {
            $response = ErrorTryCatch::createResponse(false, 500, 'Internal Server Error.', null);
            Toastr::error($response['message'], "Error");
            return back();
        }
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $breadcrumbs = [
            ['link' => route(request()->segment(1) . '.dashboard'), 'name' => "Home"],
            ['link' => route(request()->segment(1) . '.warehouses.index'), 'name' => "Warehouse"],
            ['name' => 'Create'],
        ];
        return view('backend.admin.warehouses.create',compact('breadcrumbs'));
    
    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
            $this->validate($request,
            [
              'warehouse_phone' => 'required|min:9|max:11',
              'warehouse_address' => 'required|min:1|max:198',
              'status' => 'required|min:0|max:190',
                'warehouse_name' => ['required','min:1',
                'max:198', Rule::unique('warehouses')->where(function ($query) {
                        return $query->where('admin_id', Auth::id());
                    })
                ]
                ],
            [
                'warehouse_name.unique' => "The Warehouse name field need to be unique",
                'warehouse_name.required' => "The Warehouse name field is required",
                'warehouse_name.min' => "The Warehouse Minimum field length 1",
                'warehouse_name.max' => "The Warehouse Maximum field length 100",
            ]);
        try {
            DB::beginTransaction();
            $warehouse = new Warehouse();
            $warehouse->warehouse_name = $request->warehouse_name;
            $warehouse->slug = Generate::Slug($request->warehouse_name);
            $warehouse->warehouse_phone = $request->warehouse_phone;
            $warehouse->warehouse_email = $request->warehouse_email;
            $warehouse->warehouse_address = $request->warehouse_address;
            $warehouse->admin_id = $this->User->id;
            $warehouse->created_user_id = $this->User->id;
            $warehouse->updated_user_id = $this->User->id;
            $warehouse->status = $request->status;
            $warehouse->save();
            DB::commit();
            Toastr::success("Warehouse Created Successfully", "Success");
            return redirect()->route(request()->segment(1) . '.warehouses.index');
        } catch (\Exception $e) {
            DB::rollBack();
            $response = ErrorTryCatch::createResponse(false, 500, 'Internal Server Error.', null);
            Toastr::error($response['message'], "Error");
            return back();
        }  



    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category   $category
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $User = $this->User;
            if ($User->user_type == 'Superadmin') {
                $warehouse = Warehouse::with('user')->findOrFail(decrypt($id));
            } elseif ($User->user_type == 'Admin') {
                $warehouse =Warehouse::with('user')->whereadmin_id($this->User->id)->findOrFail(decrypt($id));
            } else {
                $warehouse =  Warehouse::with('user')->whereadmin_id($this->User->admin_id)->findOrFail(decrypt($id));
            }
            $warehouseCurrentStocks=warehouseCurrentStock::wherewarehouse_id($warehouse->id)->get();
   
            return view('backend.admin.warehouses.show', compact('warehouse','warehouseCurrentStocks'));
        } catch (\Exception $e) {
            $response = ErrorTryCatch::createResponse(false, 500, 'Internal Server Error.', null);
            Toastr::error($response['message'], "Error");
            return back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category   $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        try {
           $data = Warehouse::whereadmin_id(Auth::id())->findOrFail(decrypt($id));
            return view('backend.admin.warehouses.edit')->with('warehouse', $data);
        } catch (\Exception $e) {
            DB::rollBack();
            $response = ErrorTryCatch::createResponse(false, 500, 'Internal Server Error.', null);
            Toastr::error($response['message'], "Error");
            return back();
        }
    }


    public function update(Request $request, $id)
    {
        $this->validate($request,
        [
          'warehouse_phone' => 'required|min:9|max:11',
          'warehouse_address' => 'required|min:1|max:198',
          'status' => 'required|min:0|max:190',
            'warehouse_name' => ['required','min:1',
            'max:198', Rule::unique('warehouses')->ignore($id, 'id')->where(function ($query) {
                    return $query->where('admin_id', Auth::id());
                })
            ]
            ],
        [
            'warehouse_name.unique' => "The Warehouse name field need to be unique",
            'warehouse_name.required' => "The Warehouse name field is required",
            'warehouse_name.min' => "The Warehouse Minimum field length 1",
            'warehouse_name.max' => "The Warehouse Maximum field length 100",
        ]);
        try {
            DB::beginTransaction();
            $warehouse = Warehouse::find($id);
            $warehouse->warehouse_name = $request->warehouse_name;
            $warehouse->slug = Generate::Slug($request->warehouse_name);
            $warehouse->warehouse_phone = $request->warehouse_phone;
            $warehouse->warehouse_email = $request->warehouse_email;
            $warehouse->warehouse_address = $request->warehouse_address;
            $warehouse->admin_id = $this->User->id;
            $warehouse->updated_user_id = $this->User->id;
            $warehouse->status = $request->status;
           $warehouse->save();
            DB::commit();
           Toastr::success("Warehouse Update Successfully", "Success");
            return redirect()->route(request()->segment(1) . '.warehouses.index');
        } catch (\Exception $e) {
            DB::rollBack();
            $response = ErrorTryCatch::createResponse(false, 500, 'Internal Server Error.', null);
            Toastr::error($response['message'], "Error");
            return back();
        }
    }





    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category   $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Warehouse  $category)
    {
        //
    }
    public function updateStatus(Request $request)
    {
        $category = Warehouse::findOrFail($request->id);
        $category->status = $request->status;
        $category->updated_user_id = Auth::id();
        if ($category->save()) {
            return 1;
        }
        return 0;
    }

    public function warehousePdf($id)
    {
        try {
            $User = $this->User;
            if ($User->user_type == 'Superadmin') {
                $warehouse = Warehouse::with('user')->findOrFail(decrypt($id));
            } elseif ($User->user_type == 'Admin') {
                $warehouse =Warehouse::with('user')->whereadmin_id($this->User->id)->findOrFail(decrypt($id));
            } else {
                $warehouse =  Warehouse::with('user')->whereadmin_id($this->User->admin_id)->findOrFail(decrypt($id));
            }
            $warehouseCurrentStocks=warehouseCurrentStock::wherewarehouse_id($warehouse->id)->get();
            $pdf = PDF::loadView('backend.admin.warehouses.pdf', compact('warehouse','warehouseCurrentStocks'));
            return $pdf->stream('warehouse_stock_' . now() . '.pdf');
            
        } catch (\Exception $e) {
            $response = ErrorTryCatch::createResponse(false, 500, 'Internal Server Error.', null);
            Toastr::error($response['message'], "Error");
            return back();
        }

        
    }

}
