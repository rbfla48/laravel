<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductOption;
use App\Models\ProductContent;
use Carbon\Carbon;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Imagick\Driver;

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
                            'order.order_date as order_date',
                            'status.name as status',
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

    //상품등록
    public function productStore(Request $request){
        
        // $validatedData = $request->validate([
        //     'product_name' => 'required|string',
        //     'category' => 'required|string',
        //     'start_date' => 'required|date',
        //     'end_date' => 'required|date',
        //     'active' => 'required|char',
        //     'product_info' => 'required|string',
        //     'product_normal' => 'required|numeric',
        //     'product_price' => 'required|numeric',
        //     'delivery' => 'required|numeric',
        //     'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        //     // Add validation rules for other fields as needed
        // ]);

        $nowTime = Carbon::now();
        $userName = Auth::user()->name;

        //product 저장
        $product = new Product();

        $product->name = $request->input('product_name');
        $product->category = $request->input('category');
        $product->start_date = $request->input('start_date')." 00:00:00";
        $product->end_date = $request->input('end_date')." 23:59:59";
        $product->active = $request->input('active');
        $product->discription= $request->input('product_info');
        $product->normal = $request->input('product_normal');
        $product->price = $request->input('product_price');
        $product->delivery = $request->input('delivery');
        $product->created_at = $nowTime;
        $product->created_by = $userName;

        $product->save();
        $productId = $product->id;
        
        //product_option 저장
        $option = new productOption();
        $odata = $request->input('option');
        
        for($i=0 ; $i < count($odata['name']) ; $i++){
            $option->product_id = $productId;
            $option->option_no = $i+1;
            $option->name = $odata['name'][$i];
            $option->add_price = $odata['price'][$i];
            $option->stock = $odata['stock'][$i];
            $option->active = $odata['active'][$i];
            $option->created_at = $nowTime;
            $option->created_by = $userName;

            $option->save();
        }
        
        //이미지파일정보
        if ($request->hasFile('image')) {
            //$imagePath = $request->file('image')->store('images'); // /app/images 에 저장
            $imageFile = $request->file('image');
            $imageName = $imageFile->getClientOriginalName(); //이미지파일명                     
            $imageSize = $imageFile->getSize(); //이미지파일 크기
            $imageExtension = $imageFile->getClientOriginalExtension(); //파일 확장자
            
            $imagePath = $imageFile->move(public_path('images'), $imageName); //public의 images폴더에 저장

            $image = new ImageManager(new Driver());
            $image->read('images/'.$imageName)->resize(512,512)->save('images/'.$imageName);
        }
        
        //product_content 저장
        $content = new ProductContent();
        $content->product_id = $productId;
        $content->type = "thumbnail";
        $content->name = $imageName;
        $content->content = "/images/".$imageName;
        $content->created_at = $nowTime;

        $content->save();

        return redirect()->route('admin.productList')->with('success', 'Product added successfully!');
    }

    //상품수정화면
    public function productManage($id){
        $product = new Product;
        $product = $product::where('id','=',$id)->first();

        $option = new ProductOption;
        $option = $option::where('product_id','=',$id)->get();

        $content = new ProductContent;
        $content = $content::where('product_id','=',$id)->first();

        return view('admin.productManage',['product'=>$product, 'option'=>$option, 'content'=>$content]);
    }


    //상품수정
    public function productUpdate(Request $request){
        
        // $validatedData = $request->validate([
        //     'product_name' => 'required|string',
        //     'category' => 'required|string',
        //     'start_date' => 'required|date',
        //     'end_date' => 'required|date',
        //     'active' => 'required|char',
        //     'product_info' => 'required|string',
        //     'product_normal' => 'required|numeric',
        //     'product_price' => 'required|numeric',
        //     'delivery' => 'required|numeric',
        //     'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        //     // Add validation rules for other fields as needed
        // ]);

        $nowTime = Carbon::now();
        $userName = Auth::user()->name;
        $productId = $request->product_id;

        //product 수정      
        $productArr['name'] = $request->input('product_name');
        $productArr['category'] = $request->input('category');
        $productArr['start_date'] = $request->input('start_date');
        $productArr['end_date'] = $request->input('end_date');
        $productArr['active'] = $request->input('active');
        $productArr['discription'] = $request->input('product_info');
        $productArr['normal'] = $request->input('product_normal');
        $productArr['price'] = $request->input('product_price');
        $productArr['delivery'] = $request->input('delivery');
        $productArr['updated_at'] = $nowTime;
        
        $product = new Product();
        $product
        ->where('id',$productId)
        ->update($productArr);
        
        //product_option 저장
        
        $option = new productOption();
        $odata = $request->input('option');

        for ($i = 0; $i < count($odata['name']); $i++) {
            $option->updateOrCreate(
                ['product_id' => (int)$productId, 'option_no' => $i + 1],
                [
                    'product_id' => (int)$productId,
                    'option_no' => $i + 1,
                    'name' => $odata['name'][$i],
                    'add_price' => $odata['price'][$i],
                    'stock' => $odata['stock'][$i],
                    'active' => $odata['active'][$i],
                    'updated_at' => $nowTime,
                    'created_at' => $nowTime,
                    'created_by' => $userName
                ]
            );
        }
        
        // for($i=0 ; $i < count($odata['name']) ; $i++){    
        //     $optionArr[$i]['id'] = !empty($odata['id'][$i]) ? $odata['id'][$i] : null;
        //     $optionArr[$i]['name'] = $odata['name'][$i];
        //     $optionArr[$i]['product_id'] = (int)$productId;
        //     $optionArr[$i]['option_no'] = $i+1;
        //     $optionArr[$i]['add_price'] = $odata['price'][$i];
        //     $optionArr[$i]['stock'] = $odata['stock'][$i];
        //     $optionArr[$i]['active'] = $odata['active'][$i];
        //     $optionArr[$i]['created_at'] = $nowTime;
        //     $optionArr[$i]['created_by'] = $userName;
        //     $optionArr[$i]['updated_at'] = $nowTime;
        // }

        // $option->upsert($optionArr,['product_id','option_no'],['name','add_price','stock','active','updated_at']);
        
        //이미지파일정보
        if ($request->hasFile('image')) {
            //$imagePath = $request->file('image')->store('images'); // /app/images 에 저장
            $imageFile = $request->file('image');
            $imageName = $imageFile->getClientOriginalName(); //이미지파일명                     
            $imageSize = $imageFile->getSize(); //이미지파일 크기
            $imageExtension = $imageFile->getClientOriginalExtension(); //파일 확장자
            
            $imagePath = $imageFile->move(public_path('images'), $imageName); //public의 images폴더에 저장

            //product_content 저장
            $contentArr['name'] = $imageName;
            $contentArr['content'] = "/images/".$imageName;
            $contentArr['updated_at'] = $nowTime;

            $content = new ProductContent();
            $content
            ->where('product_id',$productId)
            ->update($contentArr);
        }
        

        return redirect()->route('admin.productManage', ['id' => $productId]);
    }


}