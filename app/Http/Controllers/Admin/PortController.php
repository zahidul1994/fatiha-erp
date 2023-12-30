<?php
namespace App\Http\Controllers\Admin;
use App\Models\User;
use App\Models\Port;
use Illuminate\Http\Request;
use App\Helpers\ErrorTryCatch;
use Yajra\DataTables\DataTables;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;

class PortController extends Controller
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


    }
    public function index(Request $request)
    {

        try {
            $User = $this->User;
            $data = Port::whereadmin_id(Auth::id())->latest();
            if ($request->ajax()) {
                return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function ($data) use ($User) {
                        $btn = '<a href=' . route(request()->segment(1) . '.ports.edit', (encrypt($data->id))) . ' class="btn btn-success btn-sm waves-effect" style="width:30px; padding: 5px"><i class="fa fa-edit"></i></a>';
                        return $btn;
                    })
                    ->addColumn('status', function ($data) {
                        if ($data->status == 0) {
                            return '<div class="form-check form-switch"><input type="checkbox" id="flexSwitchCheckDefault"  class="form-check-input" disabled value=' . $data->id . ' /></div>';
                        } else {
                            return '<div class="form-check form-switch"><input type="checkbox" id="flexSwitchCheckDefault" checked="" disabled class="form-check-input"  value=' . $data->id . ' /></div>';
                        }
                    })
                    
                    ->rawColumns(['action','status'])
                    ->make(true);
            }
            $breadcrumbs = [
                ['link' => route(request()->segment(1) . '.dashboard'), 'name' => "Home"],
                ['link' => route(request()->segment(1) . '.ports.index'), 'name' => "Port"],
                ['name' => 'List'],
            ];
            return view('backend.admin.port.index', compact('breadcrumbs'));
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
            ['link' => route(request()->segment(1) . '.ports.index'), 'name' => "Port"],
            ['name' => 'Create'],
        ];
        return view('backend.admin.port.create', compact('breadcrumbs'));
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
             
              'port_address' => 'required|min:1|max:190',
              'port_name' => ['required', 'min:1',
                'max:190', Rule::unique('ports')->where(function ($query){
                    return $query->where('admin_id',  Auth::id());
                })
            ]]
              
            );
         try {
            DB::beginTransaction();
            $port = new Port();
            $port->admin_id =  Auth::id();
            $port->port_name = $request->port_name;
            $port->port_address =$request->port_address;
            $port->status = $request->status;
            $port->created_user_id = Auth::id();
            $port->updated_user_id =  Auth::id();
            $port->save();
            DB::commit();
            Toastr::success("Port Create Successfully", "Success");
            return redirect()->route(request()->segment(1) . '.ports.index');
           } catch (\Exception $e) {
            DB::rollBack();
            $response = ErrorTryCatch::createResponse(false, 500, 'Internal Server Error.', null);
            Toastr::error($response['message'], "Error");
            return back();
          }


    }

    
    public function show($id)
    {
        try {
              $data = Port::whereadmin_id(Auth::id())->findOrFail($id);
            return view('backend.admin.Port.show')->with('port', $data);
        } catch (\Exception $e) {
            DB::rollBack();
            $response = ErrorTryCatch::createResponse(false, 500, 'Internal Server Error.', null);
            Toastr::error($response['message'], "Error");
            return back();
        }
    }

   
    public function edit($id)
    {

        try {

            $data = Port::whereadmin_id(Auth::id())->findOrFail(decrypt($id));
            return view('backend.admin.port.edit')->with('port', $data);
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
         
          'port_address' => 'required|min:1|max:190',
          'port_name' => ['required', 'min:1',
            'max:190', Rule::unique('ports')->ignore($id, 'id')->where(function ($query){
                return $query->where('admin_id',  Auth::id());
            })
        ]]
          
        );
     try {
        DB::beginTransaction();
        $port =Port::find($id);
        $port->admin_id =  Auth::id();
        $port->port_name = $request->port_name;
        $port->port_address =$request->port_address;
        $port->status = $request->status;
        $port->created_user_id = Auth::id();
        $port->updated_user_id =  Auth::id();
        $port->save();
        DB::commit();
        Toastr::success("Port Update Successfully", "Success");
        return redirect()->route(request()->segment(1) . '.ports.index');
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
     * @param  \App\Models\Port   $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Port  $category)
    {
        //
    }
   
}
