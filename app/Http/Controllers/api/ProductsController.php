<?php

namespace App\Http\Controllers\api;

use App\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ExcelFileUpload;

class ProductsController extends Controller
{
    use ExcelFileUpload;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();

        return response()->json($products);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = $request->all();
        $product['created_at'] = Carbon::now();
        $product['updated_at'] = Carbon::now();
        $result = Product::insert($product);
        return response()->json(['result'=>$result]);
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = $request->all();
        $result = Product::find($id)->update($product);
        return response()->json(['result'=>$result]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = Product::find($id)->delete();
        return response()->json(['result' => $result]);
    }

    public function upload(Request $request)
    {
        $file = $request->file('file');
        $type = $request->get('abbr');

        $excelData = $this->getExcelData($file, $type);

        $result = Product::insert($excelData);

        return response()->json(['result'=>$result]);
    }
}