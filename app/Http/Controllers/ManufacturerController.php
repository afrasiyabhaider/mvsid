<?php

namespace App\Http\Controllers;

use App\Models\Manufacturer;
use Illuminate\Http\Request;

use Yajra\DataTables\DataTables;


class ManufacturerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()){
            $manufacturer = Manufacturer::all();
            return DataTables::of($manufacturer)
                ->addColumn('name',function ($row)
                {
                    return $row->name;
                })

                ->addColumn('actions',function ($row)
                {
                    $data ='<a class="fa-2x text-primary"
                                style="cursor: pointer;" href="'.url("edit-manufacturer/".$row->id). '">
                                <span class="fa fa-edit"></span>
                            </a>';

                    $data .= '<a class="text-danger fa-2x"
                                    style="cursor: pointer;" href="'.url("delete-manufacturer/".$row->id). '">
                                    <span class="fa fa-trash"></span>
                                </a>

                                    ';

                    return $data;
                })
            ->rawColumns(['actions'])
            ->make(true);
        }

        return view('manufacturers.view-manufacturer');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('manufacturers.add-manufacturer');
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
            'manufacturer_name' => 'required',
            'shop_name' => 'required',
            'address' => 'required',
            'phone_number' => 'required| unique:manufacturers,phone_number',

        ]);

         Manufacturer::create([
            'manufacturer_name'=>$request->manufacturer_name,
            'shop_name'=>$request->shop_name,
            'address'=>$request->address,
            'phone_number'=>$request->phone_number,
        ]);
        toast()->success('Manufacturer Added Successfully')->timerProgressBar();
        return redirect()->route('manufacturer');

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
        $manufacturer = Manufacturer::find($id);
        return view('manufacturers.edit-manufacturer',compact('manufacturer'));
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
            'manufacturer_name' => 'required',
            'shop_name' => 'required',
            'address' => 'required',
            'phone_number' =>'required |unique:manufacturers,phone_number,'.$id,

        ]);

        Manufacturer::where('id',$id)->update([
            'manufacturer_name'=>$request->manufacturer_name,
            'shop_name'=>$request->shop_name,
            'address'=>$request->address,
            'phone_number'=>$request->phone_number,
       ]);
       toast()->success('Manufacturer Updated Successfully')->timerProgressBar();
       return redirect()->route('manufacturer');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $manufacturer = Manufacturer::find($id);
       $manufacturer->delete();
       toast()->success('Manufacturer Deleted Successfully')->timerProgressBar();
       return redirect()->route('manufacturer');

    }
}
