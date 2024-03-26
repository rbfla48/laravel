<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductOption;
use Carbon\Carbon;

class ProductController extends Controller
{
    //상품상세
    public function productDetail($id, Product $product, ProductOption $option){

        $product = $product::select(
                    'product.id as id',
                    'product.name as product_name',
                    'product.discription as discription',
                    'product.normal as normal',
                    'product.price as price',
                    DB::raw('round(((product.normal - product.price)/product.normal)*100) as discount'),
                    'product_content.content as content')
        ->join('product_content','product.id', '=', 'product_content.product_id')
        ->where('product.id', '=', $id)
        ->where('product.active', '=', 'Y')
        ->where('product_content.type', '=', 'thumbnail')
        ->first();

        $option = $option::where('product_id', '=', $id)
        ->where('active', '=', 'Y')
        ->get();

        return view('product_detail',['product'=>$product, 'option'=>$option]);
    }


    //선택옵션 금액조회
    public function getOptionPrice(Request $request, Product $product, ProductOption $option){
    
        $product_no = $request->product_no;
        $option_no = $request->option_no;

        $price = $product::select('price')
        ->where('id','=',$product_no)
        ->value('price');

        $add_price = $option::select('add_price')
        ->where('product_id','=',$product_no)
        ->where('option_no','=',$option_no)
        ->value('add_price');

        
        return response()->json(['price'=>$price,'add_price'=>$add_price, 'option_id'=>$option_no], 200);
    }

    //결제정보
    public function paymentReady(Request $request, Product $product){

        $product_id = $request->product_no;
        $option_id = $request->option_id;
        $total_price = $request->total_price;

        $data = $product::select(
            'product.id as id',
            'product.name as product_name',
            'product.discription as discription',
            'product.normal as normal',
            'product.price as price',
            'product_option.name as option_name',
            'product_option.add_price as add_price',
            DB::raw('round(((product.normal - product.price)/product.normal)*100) as discount'),
            'product_content.content as content')
        ->join('product_content','product.id', '=', 'product_content.product_id')
        ->leftjoin('product_option','product.id', '=', 'product_option.product_id')
        ->where('product.id', '=', $product_id)
        ->where('product_option.id', '=', $option_id)
        ->where('product_content.type', '=', 'thumbnail')
        ->first();

        $data->total_price=$total_price;

        //예상배송일 계산
        $nowDate = Carbon::now();
        $nowWeek = $nowDate->dayOfWeek;

        if($nowWeek == Carbon::SUNDAY || $nowWeek == Carbon::SATURDAY){
            $service_date = $nowDate->addDay(3);
        }else{
            $service_date = $nowDate->addDay(2);
        }
        


        return view('payment_ready',['data'=>$data,'service_date'=>$service_date]);
    }

    public function paymentCheckout(){
        return view('payment_checkout');
    }

    public function paymentComplete(){
        return view('payment_complete');
    }
}
