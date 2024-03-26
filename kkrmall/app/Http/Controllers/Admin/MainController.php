<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\Product;

class MainController extends Controller
{
    //관리자 메인화면
    public function home(){
        /**
         * TODO:미들웨어 user_level 관리자여부 체크
         */
        return view('admin.main');
    }

    //주문내역
    public function orderList(Request $request){
        /**
         * TODO:
         */
        //$data = DB::table('order')->orderBy('id','DESC');
        //$order = new Order;
        $order_no = $request->order_no;
        $user_name = $request->user_name;
        $order_sdate = $request->order_sdate;
        $order_edate = $request->order_edate;



        $order = Order::select(
                            'order.id as id',
                            'order.order_no as order_no',
                            'users.name as username',
                            'product.name as product_name',
                            'order.pcount as pcount',
                            'order.order_date as order_date',
                            'status.status as status',
                            'status.code as code'
                            )
        ->when($order_no, function($query, $order_no){
            $query->where('order.order_no','=', $order_no);
        })
        ->when($user_name, function($query, $user_name){
            $query->where('users.name','like',"%$user_name%");
        })
        ->when($order_sdate && $order_edate, function($query) use ($order_sdate, $order_edate) {
            $query->where('order.order_date','>=',  $order_sdate)->where('order.order_date','<=', $order_edate);
        })
        ->leftJoin('product','order.product_id', '=', 'product.id')
        ->leftJoin('users','order.user_id', '=', 'users.id')
        ->leftJoin('status','order.status', '=', 'status.code')
        ->orderBy('order.id','desc')
        ->paginate(10);


        return view('admin.orderList',['data'=>$order,
                                    'order_no'=>$order_no,
                                    'user_name'=>$user_name,
                                    'order_sdate'=>$order_sdate,
                                    'order_edate'=>$order_edate]);
    }

    //주문상세정보
    public function orderInfo(Order $id){
        $data = Order::select(
            'order.id as order_id',
                            'users.name as user_name',
                            'users.email as user_email',
                            'users.phone as user_phone',
                            'users.zip_code as zip_code',
                            'users.address as address',
                            'users.address_detail as address_detail',
                            'order.order_no as order_no',
                            'order.status as order_status',
                            'status.status as status',
                            'product.id as product_id',
                            'product.name as product_name',
                            'product.normal as product_normal',
                            'product.price as product_price',
                            'product_option.name as option_name',
                            'product_option.add_normal as option_normal',
                            'product_option.add_price as option_price'
                            )        
        ->where('order.order_no','=', function($query) use ($id) {
            $query->select("order_no")
                    ->from('order')
                    ->where('order.id', $id->id);
        })
        ->leftjoin('product','order.product_id', '=', 'product.id')
        ->leftjoin('product_option','order.option_id', '=', 'product_option.id')
        ->leftJoin('users','order.user_id', '=', 'users.id')
        ->leftJoin('status','order.status', '=', 'status.code')
        ->orderBy('order.id','desc')
        ->get();


        return view('admin.orderInfo',['data'=>$data]);
    }

    //상품리스트
    public function productList(Request $request){
        /**
         * TODO:
         */
        $product_id = $request->product_id;
        $product_name = $request->product_name;
        $start_date = $request->start_date;
        $end_date = $request->end_date;



        $product = Product::select(
                            'product.id as id',
                            'product.name as name',
                            'product.start_date as sdate',
                            'product.end_date as edate',
                            'product.normal as normal',
                            'product.price as price',
                            'product.active as active'
                            )
        ->when($product_id, function($query, $product_id){
            $query->where('product.id','=', $product_id);
        })
        ->when($product_name, function($query, $product_name){
            $query->where('product.name','like',"%$product_name%");
        })
        ->when($start_date && $end_date, function($query) use ($start_date, $end_date) {
            $query->where('product.end_date','>=',  $start_date)->where('product.end_date','<=', $end_date);
        })
        ->orderBy('product.id','desc')
        ->paginate(10);


        return view('admin.productList',['data'=>$product,
                                    'product_id'=>$product_id,
                                    'product_name'=>$product_name,
                                    'start_date'=>$start_date,
                                    'end_date'=>$end_date]);
    }

    //상품등록
    public function productRegist(){

        return view('admin.productRegist');
    }
}