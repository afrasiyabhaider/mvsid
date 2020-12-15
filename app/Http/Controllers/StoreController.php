<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class StoreController extends Controller
{
    public function index(){
        return view('store.add-store');
    }

    public function store(Request $req){
        $this->validate($req,[
            'name' =>'required',
            'phone_number' =>'required | unique:stores,contact',
            'address' =>'required',
        ]);

        $store = Store::create([
            'store_name' => $req->name,
            'contact' => $req->phone_number,
            'address' => $req->address,
        ]);
        toast()->success('Store added successfully')->timerProgressBar();
        return redirect()->route('/view-store');
    }

    public function show(){
        if (request()->ajax()) {
            $stores = Store::withTrashed()->get();
            return DataTables::of($stores)
                ->addColumn('actions', function ($row) {
                    $data = '<a class="text-primary fa-2x"
                                style="cursor: pointer;" href="' . url("/store-edit/" . encrypt($row->id)) . '">
                                <span class="fa fa-edit"></span>
                            </a>';

                    if ($row->deleted_at == null) {
                        $data .= '<a class="text-danger fa-2x"
                                    style="cursor: pointer;" href="' . url("/delete-store/" . encrypt($row->id)) . '">
                                    <span class="fa fa-trash"></span>
                                </a>';
                    } else {
                        $data .=    '<a class="text-success fa-2x"
                                        style="cursor: pointer;" href="' . url("/restore-store/" . encrypt($row->id)) . '">
                                        <span class="fa fa-recycle"></span>
                                    </a>';
                    }

                    return $data;
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('store.view-store');
    }

    public function edit($id){
        $id = decrypt($id);
        $store = Store::withTrashed()->find($id);
        return view('store.edit-store',compact('store'));
    }

    public function update(Request $req,$id){
        $this->validate($req, [
            'name' => 'required',
            'phone_number' => 'required | unique:stores,contact'.$req['id'],
            'address' => 'required',
        ]);

        $store = Store::withTrashed()->find($id)->update([
            'store_name' => $req->name,
            'contact' => $req->phone_number,
            'address' => $req->address,
        ]);

        toast()->success('Store Updated successfully')->timerProgressBar();
        return redirect()->route('/view-store');
    }

    public function delete($id){
        $id = decrypt($id);
        Store::withTrashed()->find($id)->delete();
        toast()->success('Store Deleted successfully')->timerProgressBar();
        return redirect()->back();
    }

    public function restore($id)
    {
        $id = decrypt($id);
        Store::withTrashed()->find($id)->restore();
        toast()->success('Store Restored successfully')->timerProgressBar();
        return redirect()->back();
    }
}
