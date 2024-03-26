<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductOption;
use App\Models\Banner;

class HomeController extends Controller
{
    //메인페이지
    public function home(){
        //상단배너 슬라이드이미지
        $bannerData = Banner::where('banner_active', true)
        ->orderBy('banner_order','ASC')
        ->get();

        //하단 상품 슬라이드
        $product = Product::select(
                                    'product.id as id',
                                    'product.name as product_name',
                                    'product.normal as normal',
                                    'product.price as price',
                                    DB::raw('round(((product.normal - product.price)/product.normal)*100) as discount'), // 연산 부분을 DB::raw()로 랩핑
                                    'product_content.content as content')
        ->join('product_content','product.id', '=', 'product_content.product_id')
        ->where('product_content.type', '=', 'thumbnail')
        ->get();
        
        return view('home',['banner'=>$bannerData,'product'=>$product]);
    }
}
