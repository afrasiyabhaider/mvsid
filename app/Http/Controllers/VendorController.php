<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Yajra\DataTables\DataTables;

use Illuminate\Http\Request;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()){
            $category = Vendor::all();
            return DataTables::of($category)
                ->addColumn('name',function ($row)
                {
                    return $row->name;
                })

                ->addColumn('actions',function ($row)
                {
                    $data ='<a class="text-primary fa-2x"
                                style="cursor: pointer;" href="'.url("edit-vendor/".$row->id). '">
                                <span class="fa fa-edit"></span>
                            </a>';

                    $data .= '<a class="text-danger fa-2x"
                                    style="cursor: pointer;" href="'.url("delete-vendor/".$row->id). '">
                                    <span class="fa fa-trash"></span>
                                </a>

                                    ';

                    return $data;
                })
            ->rawColumns(['actions'])
            ->make(true);
        }

        return view('vendors.view-vendor');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('vendors.add-vendor');
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
            'name' => 'required',
            'shop_name' => 'required',
            'address' => 'required',
            'phone_number' => 'required| unique:vendors,phone_number',

        ]);

         Vendor::create([
            'name'=>$request->name,
            'shop_name'=>$request->shop_name,
            'address'=>$request->address,
            'phone_number'=>$request->phone_number,
        ]);
        toast()->success('Vendor Added Successfully')->timerProgressBar();
        return redirect()->route('vendor');


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
        $vendor = Vendor::find($id);
        return view('vendors.edit-vendor',compact('vendor'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name' => 'required',
            'shop_name' => 'required',
            'address' => 'required',
            'phone_number' => 'required |unique:vendors,phone_number,'.$id,

        ]);

        Vendor::where('id',$id)->update([
            'name'=>$request->name,
            'shop_name'=>$request->shop_name,
            'address'=>$request->address,
            'phone_number'=>$request->phone_number,
       ]);
       toast()->success('Vendor Updated Successfully')->timerProgressBar();
       return redirect()->route('vendor');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $vendor = Vendor::find($id);
       $vendor->delete();
       toast()->success('Vendor Deleted Successfully')->timerProgressBar();
       return redirect()->route('vendor');



    }
}
