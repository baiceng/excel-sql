<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PhpOffice\PhpSpreadsheet\IOFactory;

class UploadController extends Controller
{
    private $worksheet;
    private $dataType;

    public function import (Request $request) {
        $this->worksheet = IOFactory::load($request->file('file'))->getActiveSheet()->toArray();
        $arr = $this->arrayFilter($this->worksheet);
        $length = count($arr);
        $this->getDataType();
        return response()->json([ 'type' => $this->dataType, 'length' => $length -1 ]);
    }

    private function getDataType()
    {
        switch (count($this->worksheet[0])) {
        case '6':
            $this->dataType = 'clients';
            break;
        case '8':
            $this->dataType = 'products';
            break;
        case '12':
            $this->dataType = 'orders';
            break;
        case '14':
            $this->dataType = 'bills';
            break;
        }
    }

    private function arrayFilter($array) {
        $array = array_filter(array_map('array_filter', $array));
        return $array;
    }
}
