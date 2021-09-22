<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Image;
use Cart;
use Darryldecode\Cart\Cart as CartCart;
use Cloudder;
class PageController extends Controller
{
    public function __construct() {
        $currentUser = DB::table('users')->where('username', '=', session()->get('user'))->get()->first();
        return redirect()->back()->with(['currentUser' => $currentUser]);
        // View::share('currentUser', $currentUser);
    }
    public function index()
    {
        $categories = DB::table('Categories')->get();

        //lấy 10 id_product có tổng số lượng lớn nhất trong PurchaseDetail
        $id_products = DB::table('PurchaseDetail')
            ->select('id_product', DB::raw('SUM(quantity) as total'))
            ->groupBy('id_product')
            ->orderBy('total', 'desc')
            ->take(10)
            ->get();


        $arr_id = array();

        //tạo mảng chứa các id_product
        for ($i = 0; $i < count($id_products); $i++) {
            $arr_id[$i] = $id_products[$i]->id_product;
        }

        // 10 sản phẩm bán chạy nhất
        $topSaleProduct = DB::table('Products')
            ->whereIn('id_product', $arr_id)
            ->take(10)
            ->get();

        // 10 sản phẩm mới nhất
        $topNewProduct = DB::table('Products')
            ->orderBy('id_product', 'desc')
            ->take(10)
            ->get();

        // 10 sản phẩm được yêu thích nhất nhất
        $topLikeProduct = DB::table('Products')
            ->orderBy('liked', 'desc')
            ->take(10)
            ->get();


        $products = DB::table('Products')->get();

        $currentUser  = DB::table('users')->where('username', '=', session()->get('user'))->get()->first();

        return view('index', [
            'categoryList' => $categories,
            'productList' =>  $products,
            'topSaleProduct' => $topSaleProduct,
            'topNewProduct' => $topNewProduct,
            'topLikeProduct' => $topLikeProduct,
            'currentUser' =>  $currentUser
        ]);
    }
    public function chitietsanpham($idCat, $idProduct)
    {
        $liked = false;
        // Lấy chi tiết sản phẩm
        $product = DB::table('Products')
            ->where('id_product', '=', $idProduct)
            ->where('id_Cat', '=', $idCat)
            ->get()->first();
        // Lấy một vài sản phẩm cùng loại
        $cat = DB::table('Products')
            ->where('id_Cat', '=', $idCat)
            ->take(10)->get();
        // Lấy chi tiết hình ảnh
        $imageDetail = DB::table('Image')
            ->where('id_product', '=', $idProduct)
            ->get();
        // Lấy các comment về sản phẩm
        $listComments = DB::table('Comments')

            ->join('users', 'users.id', '=', 'id_user')
            ->orderBy('Comments.id_comment', 'desc')
            ->where('id_product', '=', $idProduct)
            ->get();

        // Lấy thông tin khách hàng
        $user  = DB::table('users')->where('username', '=', session()->get('user'))->get()->first();
        $checkAdmin =false;

        if ($user != null) {
            if($user->role==1){
                $checkAdmin = true;
            }
            // tìm xem user đã like sản phẩm đó chưa
            $userLikeProduct = DB::table('UserLikeProduct')
                ->where('user_id', '=', $user->id)
                ->where('product_id', '=', $idProduct)
                ->get()
                ->first();

            if ($userLikeProduct != null) {
                $liked = true;
            }
        }
        return view("frontend.Products.detailProduct", [
            'product' => $product,
            'listProductAsCat' => $cat,
            'imageDetail' => $imageDetail,
            'listComments' => $listComments,
            'liked' => $liked,
            'checkAdmin' => $checkAdmin,
            'currentUser' => $user
        ]);
    }

    public function SearchProduct(Request $res)
    {
        $keyword = $res->input('keyword');

        if ($keyword == null) {
            return redirect()->back();
        }

        //lấy tất cả các sản phẩm
        $listProduct = DB::table('Products')
                    ->where('name', 'like', '%'.$keyword.'%')
                    ->get();
        return view("frontend.Products.search", ['listProduct' => $listProduct]);
    }

    public function insertProduct()
    {
        $categories = DB::table('Categories')->get();
        $msg = "";
        return view('frontend.Products.addProduct', [
            'categoryList' => $categories
        ])->with('msg', "$msg");
    }
    public function insertProductToDB(Request $res)
    {

        $data = $res->input();
        $images = array();
        $rule = [
            'name' => 'required',
            'price' => 'required',
            'about' => 'required',
            'qty' => 'required',
            'images' => 'required|min:3'

        ];
        $customMessage = [
            // Tên sản phẩm
            'name.required' => 'Tên sản phẩm không được để trống',
            // Giá
            'price.required' => 'Giá sản phẩm không được để trống',

            // Chi tiết
            'about.required' => 'Chi tiết sản phẩm không được để trống',
            // Sản phẩm
            'qty.required' => 'Số lượng sản phẩm không được để trống',
            // Hình ảnh
            'images.required' => 'Hình ảnh sản phẩm không được để trống',
            'images.min' => 'Hình ảnh tối thiểu phải là 1',
        ];
        $msg = '';
        $validator = Validator::make($res->all(), $rule, $customMessage);
        if ($validator->fails()) {
            return redirect('AddProduct')
                ->withInput()
                ->withErrors($validator);
        } else {
            if (count($res->file('images')) >= 1) {
                DB::table('Products')->insert([
                    'name' => $data['name'],
                    'id_Cat' => $data['cats'],
                    'quantity' => $data['qty'],
                    'description' => $data['about'],
                    'price' => $data['price'],
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
                $lastItem = DB::table('Products')->latest()->first();
                $id_Product = $lastItem->id_product;
                foreach ($res->file('images') as $img) {
                    // Cấp quyền lưu file
                    Cloudder::upload($img->getRealPath(),"" ,array("width"=>200, "height"=>200));


                    $name = Cloudder::getResult();
                    DB::table('Image')->insert([
                        'id_product' => $id_Product,
                        'image' => $name['url'],
                    ]);
                }
                // Cập nhật avatar mặc định cho sản phẩm
                $images = DB::table('Image')->where('id_product', '=', $id_Product)->get()->first();
                DB::table('Products')
                    ->where('id_product', $id_Product)
                    ->update(['avatar' => $images->image]);
                $msg = "Thêm sản phẩm thành công";
            } else {
                $msg = "Thêm sản phẩm thất bại, số lượng ảnh tối thiểu phải là 3";
            }
            $categories = DB::table('Categories')->get();
            return view('frontend.Products.addProduct', [
                'categoryList' => $categories
            ])->with('msg', "$msg");
        }
    }

    public function cart()
    {
        $items = \Cart::getContent();
        $total = \Cart::getTotal();
        return view('frontend.checkout.cart')->with([
            "list" => $items,
            'total_money' => $total
        ]);
    }

    public function themgiohang(Request $res)
    {
        $data = $res->input();
        $idProduct = $data['id'];
        $product = DB::table('Products')
            ->where('id_product', '=', $idProduct)
            ->get()->first();
        $qtt = 1;
        if ($data != null) {
            if ($data['quantity'] != 0) {
                $qtt = $data['quantity'];
            }
        }
        $msg = "Thêm sản phẩm thất bại";
        $item = Cart::get($idProduct);
        if ($item != null && ($item->quantity == $product->quantity || $item->quantity + $qtt == $product->quantity)) {
            $qtt = $product->quantity;

            // Xoá sản phẩm hiện tại
            Cart::remove($idProduct);
            // Thêm sản phẩm mới với số lượng là tối đa
            Cart::add(array(
                'id'    => $idProduct,
                'name'  => $product->name,
                'price' => $product->price,
                'quantity'   => $qtt,
                'attributes' => [
                    'img' => $product->avatar,
                    'cat' => $product->id_Cat
                ]
            ));
            $msg = "Thêm sản phẩm thành công";

        } else {
            if($qtt>$product->quantity){
                $msg = "Thêm sản phẩm thất bại";
            }
            else{
                Cart::add(array(
                    'id'    => $idProduct,
                    'name'  => $product->name,
                    'price' => $product->price,
                    'quantity'   => $qtt,
                    'attributes' => [
                        'img' => $product->avatar,
                        'cat' => $product->id_Cat,
                    ]
                ));
                $msg = "Thêm sản phẩm thành công";
            }


        }


        return response(['msg'=>$msg]);
    }
    public function xoasanpham($idProduct)
    {
        $remove = \Cart::remove($idProduct);
        return redirect()->back();
    }
    public function giamsanpham(Request $res)
    {
        $data = $res->input();
        $idProduct = $data['id'];
        $item = \Cart::get($idProduct);
        if ($item->quantity == 1) {
            $remove = \Cart::remove($idProduct);
        } else {
            Cart::update($idProduct, array(
                'quantity' => -1, // lấy số lượng hiện tại trong giỏ hàng trừ đi 1
            ));
        }
        return response(['msg'=>'Post deleted','cart'=>Cart::getContent()]);    }
    public function tangsanpham(Request $res)
    {
        $data = $res->input();
        $idProduct = $data['id'];
        $itemDB = DB::table("Products")->where("id_product", "=", $idProduct)->get()->first();


        $item = \Cart::get($idProduct);
        if ($item->quantity == $itemDB->quantity) {
            $msg = "Sản phẩm trong kho không đủ để thực hiện giao dịch";
            return redirect()->back()->with('jsAlert', $msg);
        } else {
            Cart::update($idProduct, array(
                'quantity' => +1, // lấy số lượng hiện tại trong giỏ hàng cộng thêm1

            ));
            return redirect()->back();
        }
    }
    public function chitietdathang()
    {
        $user  = DB::table('users')->where('username', '=', session()->get('user'))->get()->first();
        return view('frontend.checkout.checkout')->with('user', $user);
    }
    public function thanhtoan(Request $request)
    {
        $items = \Cart::getContent();
        if (Cart::isEmpty()) {
            return redirect()->back()->with('thatbai', 'Giỏ hàng của bạn đang trống');
        } else {
            $data = $request->input();
            $this->validate(
                $request,
                [
                    'hoten'         => 'required',
                    'email'         => 'required|email',
                    'diachi'        => 'required',
                    'sodienthoai'   => 'required'

                ],
                [
                    'hoten.required'        => 'Bạn chưa điền tên',
                    'email.required'        => 'Bạn chưa điền email',
                    'diachi.required'       => 'Bạn chưa điền địa chỉ',
                    'sodienthoai.required'  => 'Bạn cần điền số điện thoại'
                ]
            );
            $total_money = floatval(preg_replace('/[^\d.]/', '', Cart::getSubTotal()));
            $status = 1;
            // Thanh toán qua zalopay
            if ($data['thanhtoan'] == 0) {
                $status = 0;
            }
            // Lấy thông tin khách hàng
            $user  = DB::table('users')->where('username', '=', session()->get('user'))->get()->first();
            // Tạo đơn hàng trong database
            DB::table('Purchases')->insert([
                'id_user' => $user->id,
                'total' => $total_money,
                'status' => 1,
                'note' => $data['ghichu'],
                'thanhtoan' => $status,
                'name' => $data['hoten'],
                'phone' => $data['sodienthoai'],
                'address' => $data['diachi'],
            ]);
            $lastItem = DB::table('Purchases')->latest()->first();
            $id_Purchase = $lastItem->id_purchase;
            // Lưu số thứ tự từng món hàng
            $stt = 1;
            foreach ($items as $product) {
                DB::table('PurchaseDetail')->insert([
                    'id_purchase' => $id_Purchase,
                    'id_detail' => $stt++,
                    'id_product' => $product->id,
                    'quantity' => $product->quantity,
                    'unit_price' => $product->price,
                ]);
                // Trừ số lượng sản phẩm trong kho
                DB::table('Products')
                    ->where('id_product', '=', $product->id)
                    ->decrement('quantity', $product->quantity);
            }
            Cart::clear();
            return redirect()->back()->with('thanhcong', 'Đặt hàng thành công');
        }
    }

    public function likeProduct(Request $res)
    {
        $idProduct = $res->input('id');
        // Lấy thông tin khách hàng
        $user  = DB::table('users')->where('username', '=', session()->get('user'))->get()->first();

        // tìm xem user đã like sản phẩm đó chưa
        $userLikeProduct = DB::table('UserLikeProduct')
            ->where('user_id', '=', $user->id)
            ->where('product_id', '=', $idProduct)
            ->get()
            ->first();

        if ($userLikeProduct == null) {
            //insert nếu chưa tồn tại
            DB::table('UserLikeProduct')->insert([
                'user_id' => $user->id,
                'product_id' => $idProduct,
            ]);

            // update cột liked tăng lên 1 giá trị
            DB::table('Products')
                ->where('id_product', '=', $idProduct)
                ->increment('liked');
        } else {
            //delete nếu đã tồn tại
            DB::table('UserLikeProduct')
                ->where('id', $userLikeProduct->id)
                ->delete();

            // update cột liked giảm 1 giá trị
            DB::table('Products')
                ->where('id_product', '=', $idProduct)
                ->decrement('liked');
        }
        //lấy thông tin sản phẩm
        $product = DB::table('Products')
            ->where('id_product', '=', $idProduct)
            ->get()
            ->first();
        return response()->json(['product' => $product, 'liked' => $liked]); // 200 là mã lỗi
    }

    public function profile($user)
    {
         // Lấy thông tin khách hàng
         $user_id  = DB::table('users')->where('username', '=', $user)->get()->first();

        $listPurchases = DB::table('Purchases')
            ->join('users', 'Purchases.id_user', '=', 'users.id')
            ->join('Status', 'Status.id_stt', '=', 'status')
            ->where('users.username', '=', $user)
            ->orderBy('Purchases.created_at', 'asc')
            ->select('Purchases.*', 'Status.description')->get();


        $likedProducts = DB::table('UserLikeProduct')
                        ->join('Products', 'UserLikeProduct.product_id', '=', 'Products.id_product')
                        ->where('UserLikeProduct.user_id', '=', $user_id->id)
                        ->select('Products.*')
                        ->get();

        return view('Users.Profile', [
            'listPurchases' => $listPurchases,
            'likedProducts' => $likedProducts,
            'currentUser' => $user_id
        ]);
    }

    public function comment(Request $res, $id)
    {
        $data = $res->input();
        if($data['textComment'])
        {
            $user  = DB::table('users')->where('username', '=', session()->get('user'))->get()->first();
            DB::table('Comments')->insert([
                'id_product' => $id,
                'id_user' => $user->id,
                'content' => $data['textComment']
            ]);
        }
        return redirect()->back();
    }
    public function bill()
    {
        $listPurchases = DB::table('Purchases')
            ->join('users', 'Purchases.id_user', '=', 'users.id')
            ->join('Status', 'Status.id_stt', '=', 'status')
            ->orderBy('Purchases.created_at', 'asc')
            ->select('Purchases.*', 'Status.description')->get();
        $listStatus = DB::table('Status')->get();
        return view('Admin.bill', [
            'listPurchases' => $listPurchases,
            'listStatus' => $listStatus
        ]);
    }
    public function changeStatus(Request $res)
    {
        $data = $res->input();
        $id = $data['id'];
        DB::table('Purchases')
            ->where('id_purchase', '=', $data['id'])
            ->update(['status' => $data['value']]);
    }
    public function getEdit($id)
    {  $msg = '';
        $product = DB::table('Products')
            ->where('id_product', '=', $id)->get()->first();
        $categories = DB::table('Categories')->get();
        $image = DB::table('Image')->where('id_product', '=', $id)->get();

        return view('Admin.Products.editProduct', [
            'product' => $product,
            'categoryList' => $categories,
            'listImage' => $image,
            'msg' => $msg
        ]);
    }
    public function postEdit(Request $res, $id)
    {
        $data = $res->input();
        $rule = [
            'name' => 'required',
            'price' => 'required',
            'about' => 'required',
            'qty' => 'required',

        ];
        $customMessage = [
            // Tên sản phẩm
            'name.required' => 'Tên sản phẩm không được để trống',
            // Giá
            'price.required' => 'Giá sản phẩm không được để trống',

            // Chi tiết
            'about.required' => 'Chi tiết sản phẩm không được để trống',
            // Sản phẩm
            'qty.required' => 'Số lượng sản phẩm không được để trống',

        ];
        $msg = '';
        $validator = Validator::make($res->all(), $rule, $customMessage);
        if ($validator->fails()) {
            return redirect()->route('editProduct')
                ->withInput()
                ->withErrors($validator);
        } else {

            DB::table('Products')
            ->where('id_product',$id)
            ->update([
                'name' => $data['name'],
                'id_Cat' => $data['cats'],
                'quantity' => $data['qty'],
                'description' => $data['about'],
                'price' => $data['price'],
                'updated_at' => Carbon::now(),
                'avatar' => $data['image'],
            ]);

            $msg = "Cập nhật phẩm thành công";

            $product = DB::table('Products')
                ->where('id_product', '=', $id)->get()->first();
            $categories = DB::table('Categories')->get();
            $image = DB::table('Image')->where('id_product', '=', $id)->get();
            return view('Admin.Products.editProduct', [
                'product' => $product,
                'categoryList' => $categories,
                'listImage' => $image,
                'msg' => $msg
            ]);
        }
    }

}
