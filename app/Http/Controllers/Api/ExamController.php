<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Controller;
use App\Models\Supplier;


use Illuminate\Http\Request;

class ExamController extends Controller
{
    public function __construct()
    {
    }

    /******
     * 考題1
     * 
    *******/
    public function test1(Request $request)
    {

        // 回傳結果
        $response  = response([
            'message' => __('讀取成功'),
            'data'    => 'OK',
            'code'    => '200',
        ], 200);

        return $response;
    }

    /******
     * 考題2
     * 
    *******/
    public function test2(Request $request)
    {

        // 回傳結果
        $response  = response([
            'message' => __('讀取成功'),
            'data'    => 'OK',
            'code'    => '200',
        ], 200);

        return $response;
    }

    /******
     * 考題3
     * 
    *******/
    public function test3(Request $request)
    {
        $供應商 = new Supplier();
        $供應商 = $供應商->with(['Update']);
        $供應商 = $供應商->findById(1);

        $內容 = ['Supplier', $供應商];

        // 回傳結果
        $結果 = response([
            'message' => __('讀取成功'),
            'data'    => $內容,
            'code'    => '200',
        ], 200);

        return $結果;
    }
}
