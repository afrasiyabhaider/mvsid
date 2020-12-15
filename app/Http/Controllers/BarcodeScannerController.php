<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Manufacturer;
use App\Models\Product;
use App\Models\Store;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PHPZxing\PHPZxingDecoder;


class BarcodeScannerController extends Controller
{
    public function scanProduct($barcode){
        $product = Product::Where('barcode',$barcode)->get();
        if(count($product)>0){
            return [
                        'product_id'=>$product[0]->id,
                        'barcode' => encrypt($barcode)
                    ];
        }else{
            return [
                'product_id' => 0,
                'barcode' => encrypt($barcode)
            ];
        }
    }

    public function postBarcode(Request $req){
        $product = Product::Where('barcode', $req->barcode)->get();
        if (count($product) > 0) { //update case
            $barcode = $req->barcode;
            $product = Product::withTrashed()->firstWhere('barcode', $barcode);
            $vendors = Vendor::all();
            $stores = Store::all();
            $maincat = Category::whereNull('parent_id')->get();
            if ($product->category_id) {
                $categories = Category::where('parent_id', Category::find($product->category_id)->parent->id)->get();
                $parent_cat = Category::find($product->category_id)->parent->id;
            } else {
                $parent_cat = Category::whereNull('parent_id')->get();
                $categories = [];
            }
            $cats = Category::all();
            $manuf = Manufacturer::all();
            $barcode = encrypt($barcode);

            return view('products.update-product-form', compact('vendors', 'maincat', 'categories', 'manuf', 'barcode', 'product', 'parent_cat', 'stores'));
        } else { // create case
            $vendors = Vendor::all();
            $stores = Store::all();
            $categories = Category::whereNull('parent_id')->get();
            $manuf = Manufacturer::all();
            $barcode = encrypt($req->barcode);
            return view('products.add-product-form', compact('vendors', 'categories', 'manuf', 'barcode', 'stores'));
        }
    }

    public function addProductView(){
        return view('products.add-product-view');
    }

    public function scanView(){
        return view('barcodescanner.barcodevideo');
    }

    public function scanFile(){
        return view('barcodescanner.barcode1');
    }

    public function barcodes(){
        /* echo DNS1D::getBarcodeSVG('4445645656', 'PHARMA2T');
        echo "<br>";
        echo DNS1D::getBarcodeSVG('4445645656', 'PHARMA2T');
        echo "<br>";

        echo DNS1D::getBarcodeHTML('4445645656', 'PHARMA2T');
        echo "<br>";
        echo DNS1D::getBarcodeHTML('4445645656', 'PHARMA2T', 3, 33, 'green', true);
        echo "<br>";
        echo DNS2D::getBarcodeHTML('4445645656', 'QRCODE');
        echo "<br>";
        echo DNS2D::getBarcodePNGPath('4445645656', 'PDF417');
        echo "<br>";

        echo '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG('4', 'C39+', 3, 33) . '" alt="barcode"   />';

        echo "<br>";
        $image = DNS1D::getBarcodePNG('4445645656', 'C128');
        echo '<img src="data:image/png;base64,' . $image . '" alt="barcodeee"   />'; */
        /* echo "<br>";
        echo DNS2D::getBarcodeSVG('4445645656', 'DATAMATRIX');
        echo "<br>";
        echo $barcode = DNS1D::getBarcodeHTML('4445645656', 'C128');
        echo "<br>"; */
    }

    public function scanBarcode(){
        return view('barcodescanner.barcode-scan-zxing');
    }

    public function storeBarcodeImage(Request $request){
        $img = $request->message;
        $folderPath = "public/";
        $image_parts = explode(";base64,", $img);

        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];

        $image_base64 = base64_decode($image_parts[1]);
        $fileName = uniqid() . '.png';

        $file = $folderPath . $fileName;
        $storage = Storage::put($fileName,$image_base64);
        // return $fileName;

        $decoder        = new PHPZxingDecoder();

    //    $data1 =  $decoder->setJavaPath('/usr/bin/java');
            // $realJavaPath = exec('readlink -f /usr/bin/java');
            $decoder->setJavaPath('C:\Program Files\Java\jdk1.8.0_101\bin');

        $data   = $decoder->decode(public_path('product_images'.'/'.$fileName));


        return $data;




        // return $data;

        // if($data->isFound()) {
        //     $data->getImageValue();
        //     $data->getFormat();
        //     $data->getType();
        // }

        // dd($data);

        // file_put_contents($file, $image_base64);

    }


}
