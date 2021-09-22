<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use \Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Cloudder;

class AdminController extends Controller
{
    private $limit = 5;
    public function index_Admin()
    {
        $countUser = DB::table('users')->count();
        $countPurchase = DB::table('purchases')->count();
        $countCategory = DB::table('categories')->count();
        $countProduct = DB::table('products')->count();
        return view('Admin.indexAdmin', [
            'countUser' =>  $countUser,
            'countPurchase' => $countPurchase,
            'countCategory' => $countCategory,
            'countProduct' => $countProduct
        ]);
    }

    public function view_Product()
    {
        $listProducts = DB::table('Products')
        ->select('Products.*')
        ->get();
        return view('Admin.Products.viewProductAdmin',[
            'listProducts' => $listProducts,
        ]);
    }

    public function top_Product()
    {
        $listProducts = DB::table('PurchaseDetail')
        ->join('Products', 'Products.id_product', '=', 'PurchaseDetail.id_product')
        ->select('PurchaseDetail.id_product','Products.name','Products.avatar', DB::raw('SUM(PurchaseDetail.quantity) as total_quantity'), DB::raw('SUM(PurchaseDetail.unit_price) as total_price'), DB::raw('count(*) as countBought'))
        ->groupBy('PurchaseDetail.id_product','Products.name','Products.avatar')
        ->orderBy('countBought', 'desc')
        ->take(10)
        ->get();
        return view('Admin.Products.topProductAdmin',[
            'listProducts' => $listProducts
        ]);
    }

    public function view_Customer()
    {
        $msg = '';
        $listCustomer = DB::table('users')->get();
        return view('Admin.Customers.viewCustomers',[
            'listCustomer' => $listCustomer,
            'msg'=>$msg
        ]);
    }

    public function add_Customer()
    {

        return view('Admin.Customers.addCustomer');
    }

    public function view_Purchase()
    {
        $listPurchases = DB::table('Purchases')
            ->join('users', 'Purchases.id_user', '=', 'users.id')
            ->join('Status', 'Status.id_stt', '=', 'status')
            ->orderBy('Purchases.created_at', 'asc')
            ->select('Purchases.*', 'Status.description')
            ->paginate($this->limit);
        $listStatus = DB::table('Status')->get();
        return view('Admin.Purchase.viewPurchase', [
            'listPurchases' => $listPurchases,
            'listStatus' => $listStatus
        ]);
    }

    public function filter_Purchase()
    {
        return view('Admin.Purchase.filterPurchase');
    }

    public function revenue_Statistic()
    {
        return view('Admin.Revenue.revenueStatistics');
    }

    public function revenue_Day(Request $res)
    {
        $day = $res->input('day');
        $statistics = DB::table('Purchases')
                        ->join('users', 'Purchases.id_user', '=', 'users.id')
                        ->select('Purchases.id_purchase', 'users.email', 'Purchases.address', 'Purchases.total', 'Purchases.created_at')
                        ->whereDate('Purchases.created_at', $day)
                        ->get();
        $total_price = DB::table('Purchases')
                ->select(DB::raw('SUM(total) as total_price'))
                ->whereDate('Purchases.created_at', $day)
                ->get();
        $total_purchase = DB::table('Purchases')
                        ->whereDate('Purchases.created_at', $day)
                        ->count();
        return response()->json(['statistics' => $statistics, 'total_price' => $total_price, 'total_purchase' => $total_purchase],200);
    }
    public function revenue_Month(Request $res)
    {
        $data = $res->input();
        $statistics = DB::table('Purchases')
                        ->join('users', 'Purchases.id_user', '=', 'users.id')
                        ->select('Purchases.id_purchase', 'users.email', 'Purchases.address', 'Purchases.total', 'Purchases.created_at')
                        ->whereMonth('Purchases.created_at', $data['month'])
                        ->whereYear('Purchases.created_at', $data['year'])
                        ->get();
        $total_price = DB::table('Purchases')
                ->select(DB::raw('SUM(total) as total_price'))
                ->whereMonth('Purchases.created_at', $data['month'])
                ->whereYear('Purchases.created_at', $data['year'])
                ->get();
        $total_purchase = DB::table('Purchases')
                        ->whereMonth('Purchases.created_at', $data['month'])
                        ->whereYear('Purchases.created_at', $data['year'])
                        ->count();
        return response()->json(['statistics' => $statistics, 'total_price' => $total_price, 'total_purchase' => $total_purchase],200);
    }

    public function firstQuarter($year)
    {
        $statistics = DB::table('Purchases')
                        ->join('users', 'Purchases.id_user', '=', 'users.id')
                        ->select('Purchases.id_purchase', 'users.email', 'Purchases.address', 'Purchases.total', 'Purchases.created_at')
                        ->whereYear('Purchases.created_at', $year)
                        ->whereMonth('Purchases.created_at', '1')
                        ->orwhereMonth('Purchases.created_at', '2')
                        ->orwhereMonth('Purchases.created_at', '3')
                        ->get();
        $total_price = DB::table('Purchases')
                        ->select(DB::raw('SUM(total) as total_price'))
                        ->whereYear('Purchases.created_at', $year)
                        ->whereMonth('Purchases.created_at', '1')
                        ->orwhereMonth('Purchases.created_at', '2')
                        ->orwhereMonth('Purchases.created_at', '3')
                        ->get();
        $total_purchase = DB::table('Purchases')
                        ->whereYear('Purchases.created_at', $year)
                        ->whereMonth('Purchases.created_at', '1')
                        ->orwhereMonth('Purchases.created_at', '2')
                        ->orwhereMonth('Purchases.created_at', '3')
                        ->count();
        return ['statistics' => $statistics, 'total_price' => $total_price, 'total_purchase' => $total_purchase];
    }
    public function secondQuarter($year)
    {
        $statistics = DB::table('Purchases')
                        ->join('users', 'Purchases.id_user', '=', 'users.id')
                        ->select('Purchases.id_purchase', 'users.email', 'Purchases.address', 'Purchases.total', 'Purchases.created_at')
                        ->whereYear('Purchases.created_at', $year)
                        ->whereMonth('Purchases.created_at', '4')
                        ->orwhereMonth('Purchases.created_at', '5')
                        ->orwhereMonth('Purchases.created_at', '6')
                        ->get();
        $total_price = DB::table('Purchases')
                        ->select(DB::raw('SUM(total) as total_price'))
                        ->whereYear('Purchases.created_at', $year)
                        ->whereMonth('Purchases.created_at', '4')
                        ->orwhereMonth('Purchases.created_at', '5')
                        ->orwhereMonth('Purchases.created_at', '6')
                        ->get();
        $total_purchase = DB::table('Purchases')
                        ->whereYear('Purchases.created_at', $year)
                        ->whereMonth('Purchases.created_at', '4')
                        ->orwhereMonth('Purchases.created_at', '5')
                        ->orwhereMonth('Purchases.created_at', '6')
                        ->count();
        return ['statistics' => $statistics, 'total_price' => $total_price, 'total_purchase' => $total_purchase];
    }
    public function thirdQuarter($year)
    {
        $statistics = DB::table('Purchases')
                        ->join('users', 'Purchases.id_user', '=', 'users.id')
                        ->select('Purchases.id_purchase', 'users.email', 'Purchases.address', 'Purchases.total', 'Purchases.created_at')
                        ->whereYear('Purchases.created_at', $year)
                        ->whereMonth('Purchases.created_at', '7')
                        ->orwhereMonth('Purchases.created_at', '8')
                        ->orwhereMonth('Purchases.created_at', '9')
                        ->get();
        $total_price = DB::table('Purchases')
                        ->select(DB::raw('SUM(total) as total_price'))
                        ->whereYear('Purchases.created_at', $year)
                        ->whereMonth('Purchases.created_at', '7')
                        ->orwhereMonth('Purchases.created_at', '8')
                        ->orwhereMonth('Purchases.created_at', '9')
                        ->get();
        $total_purchase = DB::table('Purchases')
                        ->whereYear('Purchases.created_at', $year)
                        ->whereMonth('Purchases.created_at', '7')
                        ->orwhereMonth('Purchases.created_at', '8')
                        ->orwhereMonth('Purchases.created_at', '9')
                        ->count();
        return ['statistics' => $statistics, 'total_price' => $total_price, 'total_purchase' => $total_purchase];
    }
    public function fourthQuarter($year)
    {
        $statistics = DB::table('Purchases')
                        ->join('users', 'Purchases.id_user', '=', 'users.id')
                        ->select('Purchases.id_purchase', 'users.email', 'Purchases.address', 'Purchases.total', 'Purchases.created_at')
                        ->whereYear('Purchases.created_at', $year)
                        ->whereMonth('Purchases.created_at', '10')
                        ->orwhereMonth('Purchases.created_at', '11')
                        ->orwhereMonth('Purchases.created_at', '12')
                        ->get();
        $total_price = DB::table('Purchases')
                        ->select(DB::raw('SUM(total) as total_price'))
                        ->whereYear('Purchases.created_at', $year)
                        ->whereMonth('Purchases.created_at', '10')
                        ->orwhereMonth('Purchases.created_at', '11')
                        ->orwhereMonth('Purchases.created_at', '12')
                        ->get();
        $total_purchase = DB::table('Purchases')
                        ->whereYear('Purchases.created_at', $year)
                        ->whereMonth('Purchases.created_at', '10')
                        ->orwhereMonth('Purchases.created_at', '11')
                        ->orwhereMonth('Purchases.created_at', '12')
                        ->count();
        return ['statistics' => $statistics, 'total_price' => $total_price, 'total_purchase' => $total_purchase];
    }

    public function revenue_Quarter(Request $res)
    {
        $data = $res->input();

        $quarter = $data['quarter'];
        $year = $data['year'];

        if($quarter == 1)
        {
            return response()->json($this->firstQuarter($year), 200);
        }
        if($quarter == 2)
        {
            return response()->json($this->secondQuarter($year), 200);
        }
        if($quarter == 3)
        {
            return response()->json($this->thirdQuarter($year), 200);
        }
        if($quarter == 4)
        {
            return response()->json($this->fourthQuarter($year), 200);
        }
        return response()->json(['statistics' => [],'total_price'=> 0,  'total_purchase' => 0], 200);
    }

    public function revenue_Year(Request $res)
    {
        $year = $res->input('year');
        $statistics = DB::table('Purchases')
                        ->join('users', 'Purchases.id_user', '=', 'users.id')
                        ->select('Purchases.id_purchase', 'users.email', 'Purchases.address', 'Purchases.total', 'Purchases.created_at')
                        ->whereYear('Purchases.created_at', $year)
                        ->get();
        $total_price = DB::table('Purchases')
                ->select(DB::raw('SUM(total) as total_price'))
                ->whereYear('Purchases.created_at', $year)
                ->get();
        $total_purchase = DB::table('Purchases')
                        ->whereYear('Purchases.created_at', $year)
                        ->count();
        return response()->json(['statistics' => $statistics, 'total_price' => $total_price, 'total_purchase' => $total_purchase],200);
    }

    public function removeProduct($id){
        DB::table('Products')->where('id_product', '=', $id)->delete();
        return redirect('/');
    }

    public function removeUser($id){
        DB::table('users')->where('id', '=', $id)->delete();
        return redirect('/');
    }


    public function add_ProductAdmin(){
        $categories = DB::table('Categories')->get();
        $msg = "";
        return view('Admin.Products.addProductAdmin', [
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
            'images' => 'required|min:1'

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
            return redirect('AddProductAdmin')
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
            return view('Admin.Products.addProductAdmin', [
                'categoryList' => $categories
            ])->with('msg', "$msg");
        }
    }

    public function remove($id){
        DB::table('Products')->where('id_product', '=', $id)->delete();
        $listProducts = DB::table('Products')
                        ->select('Products.*')
                        ->get();
        return view('Admin.Products.viewProductAdmin',[
            'listProducts' => $listProducts,
            'msg' => "xóa thành công",
        ]);
    }

    public function remove_user($id){
        DB::table('users')->where('id', '=', $id)->delete();
        $listCustomer = DB::table('users')->select('users.*')->get();
        return view('Admin.Customers.viewCustomers',[
            'listCustomer' => $listCustomer,
            'msg' => "Xóa người dùng thành công!",
        ]);
    }


    public function statistic_Purchase(Request $res){
        $data = $res->all();
        $get = DB::table('purchases as pur')
                ->whereMonth('pur.created_at', '=', now())
                ->select(array(DB::Raw('sum(pur.total) as total'), DB::Raw('DATE(pur.created_at) day')))
                ->groupBy('day')
                ->get();
                //$date = date("d-m-y",$val->created_at);
                    foreach ($get as $key => $val){
                              $chart_data[] =  array(
                                'day'=> $val->day,
                                'value'=>$val->total
                            );
                            // $chart_data['month'] = (string) $val->created_at->format('M');
                            // $chart_data['value'] = $val->total
                    }
      echo $data = json_encode($chart_data);

    }

    public function changeRole(Request $res)
    {
        $data = $res->input();
        $id = $data['id'];
        DB::table('users')
            ->where('id', '=', $data['id'])
            ->update(['role' => $data['value']]);
    }
}