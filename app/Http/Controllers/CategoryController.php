<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Null_;
use Yajra\DataTables\DataTables;
use Illuminate\Validation\Rule;



class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if(request()->ajax()){
            $category = Category::all();
            return DataTables::of($category)
                ->addColumn('name',function ($row)
                {
                    return $row->name;
                })
                ->addColumn('parent_name',function ($row)
                {
                    if($row->parent){
                      return  $row->parent->name;
                    }else{
                        return "-----";

                    }

                })
                ->addColumn('actions',function ($row)
                {
                    $data ='<a class="text-primary fa-2x"
                                style="cursor: pointer;" href="'.url("edit-category/".$row->id). '">
                                <span class="fa fa-edit"></span>
                            </a>';

                    $data .= '<a class="text-danger fa-2x"
                                    style="cursor: pointer;" href="'.url("delete-category/".$row->id). '">
                                    <span class="fa fa-trash"></span>
                                </a>

                                    ';

                    return $data;
                })
            ->rawColumns(['actions'])
            ->make(true);
        }

        return view('categories.view-category');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $categories = Category::where('parent_id',Null)->get();
       return view('categories.add-category',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required| unique:categories',
        ]);

        $category = Category::create([
            'name'=>$request->name,
            'parent_id'=>$request->parent_category,
        ]);
        toast()->success('Category Added Successfully')->timerProgressBar();
        return redirect()->route('category');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {



        $category = Category::find($id);

        $categories = Category::where('parent_id',Null)->get();

        return view('categories.edit',compact('category','categories'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function categoryUpdate(Request $request, $id)
    {
        $this->validate($request,[
            'name' => 'required |unique:categories,id,'.$id,
        ]);

        Category::where('id', $id)->update([
            'name'=>$request->name,
            'parent_id'=>$request->parent_category,
            ]);

        toast()->success('Category Updated Successfully')->timerProgressBar();
        return redirect()->route('category');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $category=Category::find($id);
       $category->delete();
       toast()->success('Category Deleted Successfully')->timerProgressBar();
        return redirect()->route('category');

    }

    public function subCategories($id){
       $sub_cat = Category::where('parent_id',$id)->get();
       return $sub_cat;
    }
}
