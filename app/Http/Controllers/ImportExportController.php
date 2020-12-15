<?php

namespace App\Http\Controllers;

use App\Imports\ProductImport;
use Maatwebsite\Excel\Facades\Excel;

class ImportExportController extends Controller
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function importExportView()
    {
        return view('import.import');
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function export()
    {
        // return Excel::download(new StoreExport, 'users.xlsx');
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function import()
    {
        $this->validate(request(),[
            'file' => 'required'
        ]);
        Excel::import(new ProductImport, request()->file('file'));
        toast()->success('Product Data Imported successfully')->timerProgressBar();
        return redirect(url('product-list'));
    }
}
