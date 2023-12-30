<?php
namespace App\Http\Controllers\Admin;
use App\Models\User;
use App\Models\Currency;
use Illuminate\Http\Request;
use App\Helpers\ErrorTryCatch;
use Yajra\DataTables\DataTables;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;

class CurrencyController extends Controller
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
            $data = Currency::whereadmin_id(Auth::id())->latest();
            if ($request->ajax()) {
                return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function ($data) use ($User) {
                        $btn = '<a href=' . route(request()->segment(1) . '.currency.edit', (encrypt($data->id))) . ' class="btn btn-success btn-sm waves-effect" style="width:30px; padding: 5px"><i class="fa fa-edit"></i></a>';
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
                ['link' => route(request()->segment(1) . '.currency.index'), 'name' => "Currency"],
                ['name' => 'List'],
            ];
            return view('backend.admin.currency.index', compact('breadcrumbs'));
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
            ['link' => route(request()->segment(1) . '.currency.index'), 'name' => "Currency"],
            ['name' => 'Create'],
        ];
        return view('backend.admin.currency.create', compact('breadcrumbs'));
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
              'currency_rate' => 'required',
              'currency_symbol' => 'required',
              'currency_name' => ['required', 'min:1',
                'max:190', Rule::unique('currencies')->where(function ($query){
                    return $query->where('admin_id',  Auth::id());
                })
            ]]
              
            );
         try {
            DB::beginTransaction();
            $currency = new Currency();
            $currency->admin_id =  Auth::id();
            $currency->currency_rate = $request->currency_rate;
            $currency->currency_name =$request->currency_name;
            $currency->currency_symbol = $request->currency_symbol;
            $currency->status = $request->status;
            $currency->created_user_id = Auth::id();
            $currency->updated_user_id =  Auth::id();
            $currency->save();
            DB::commit();
            Toastr::success("Currency Create Successfully", "Success");
            return redirect()->route(request()->segment(1) . '.currency.index');
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
              $data = Currency::whereadmin_id(Auth::id())->findOrFail($id);
            return view('backend.admin.currency.show')->with('currency', $data);
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

            $data = Currency::whereadmin_id(Auth::id())->findOrFail(decrypt($id));
            return view('backend.admin.currency.edit')->with('currency', $data);
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
          'currency_rate' => 'required',
          'currency_symbol' => 'required',
          'currency_name' => ['required', 'min:1',
            'max:190', Rule::unique('currencies')->ignore($id, 'id')->where(function ($query){
                return $query->where('admin_id',  Auth::id());
            })
        ]]
          
        );
     try {
        DB::beginTransaction();
        $currency =Currency::find($id);
        $currency->admin_id =  Auth::id();
        $currency->currency_rate = $request->currency_rate;
        $currency->currency_name =$request->currency_name;
        $currency->currency_symbol = $request->currency_symbol;
        $currency->created_user_id = Auth::id();
        $currency->updated_user_id =  Auth::id();
        $currency->status = $request->status;
        $currency->save();
        DB::commit();
        Toastr::success("Currency Update Successfully", "Success");
        return redirect()->route(request()->segment(1) . '.currency.index');
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
     * @param  \App\Models\Currency   $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Currency  $category)
    {
        //
    }
   
}
