<?php

namespace App\Http\Controllers\Superadmin;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Helpers\ErrorTryCatch;
use Illuminate\Validation\Rule;
use Sohibd\Laravelslug\Generate;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;


class SubCategoryController extends Controller
{
    private $User;
    function __construct()
    {

        $this->middleware(function ($request, $next) {
            $this->User = Auth::user();
           
            return $next($request);
        });

       
    }
    public function index(Request $request)
    {

     try {
          
            $data = SubCategory::with('category')->latest();

            if ($request->ajax()) {

                return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function ($data) {
                       $btn = '<a href=' . route(request()->segment(1) . '.sub-categories.edit', (encrypt($data->id))) . ' class="btn btn-info btn-sm waves-effect" style="margin-left: 5px"><i class="fa fa-edit"></i></a>';
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
                ['link' => route(request()->segment(1) . '.sub-categories.index'), 'name' => "Subcategory"],
                ['name' => 'List'],
            ];
            return view('backend.superadmin.sub_category.index', compact('breadcrumbs'));
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
            ['link' => route(request()->segment(1) . '.sub-categories.index'), 'name' => "Subcategory"],
            ['name' => 'Create'],
        ];
        return view('backend.superadmin.sub_category.create', compact('breadcrumbs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate(
            $request,
            [
                'category_id' => 'required',
                'status' => 'required',
                'sub_category_name.*' => 'required', 
                
            ],
            [
                'sub_category_name.unique' => "The Sub Category name field is unique",
                'sub_category_name.required' => "The Sub Category name field is required",
                'sub_category_name.min' => "The Sub Category Minimum Length 1",
                'sub_category_name.max' => "The Sub Category Maximum Length 190",

            ]
        );

        try {
            DB::beginTransaction();
            $subCategoryName=$request->input('sub_category_name');
            for ($i = 0; $i < count($subCategoryName); $i++) {
                $subcategory=new SubCategory();
                $subcategory->superadmin_id = Auth::id();
                $subcategory->category_id = $request->category_id;
                $subcategory->status = $request->status;
                $subcategory->sub_category_name = $subCategoryName[$i];
                $subcategory->slug = Generate::Slug($subCategoryName[$i]);
                $subcategory->save();
               }
           
            DB::commit();
            Toastr::success("Sub Category Created Successfully", "Success");
            return redirect()->route(request()->segment(1) . '.sub-categories.index');
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
            if ($User->user_type == 'Admin') {
                $data = Category::whereuser_id($User->id)->findOrFail($id);
            } else {
                $data = Category::findOrFail($id);
            }
            return view('backend.common.sub_category.show')->with('slider', $data);
        } catch (\Exception $e) {
            DB::rollBack();
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
           
            $data = SubCategory::findOrFail(decrypt($id));
            $breadcrumbs = [
                ['link' => route(request()->segment(1) . '.dashboard'), 'name' => "Home"],
                ['link' => route(request()->segment(1) . '.sub-categories.index'), 'name' => "Subcategory"],
                ['name' => 'Edit'],
            ];
            return view('backend.superadmin.sub_category.edit',compact('breadcrumbs'))->with('subcategory', $data);
        } catch (\Exception $e) {
            DB::rollBack();
            $response = ErrorTryCatch::createResponse(false, 500, 'Internal Server Error.', null);
            Toastr::error($response['message'], "Error");
            return back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category   $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate(
            $request,
            [
                'sub_category_name' => 'required|min:1|max:198',
                'category_id'=>'required',
                'status'=>'required'

            ],
            [
                'sub_category_name.unique' => "The Sub Category name field is unique",
                'sub_category_name.required' => "The Sub Category name field is required",
                'sub_category_name.min' => "The Sub Category Minimum Length 1",
                'sub_category_name.max' => "The Sub Category Maximum Length 190"
            ]
        );

        try {
            DB::beginTransaction();
            $subcategory = SubCategory::find($id);
            $subcategory->category_id = $request->category_id;
            $subcategory->sub_category_name = $request->sub_category_name;
            $subcategory->status = $request->status;
            $subcategory->slug = Generate::Slug($request->sub_category_name);
            $subcategory->save();
            DB::commit();

            Toastr::success("Sub Category Update Successfully", "Success");
            return redirect()->route(request()->segment(1) . '.sub-categories.index');
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
    public function destroy(Category  $category)
    {
        //
    }
    public function updateStatus(Request $request)
    {
        $category = SubCategory::findOrFail($request->id);
        $category->status = $request->status;
        if ($category->save()) {
            return 1;
        }
        return 0;
    }
}
