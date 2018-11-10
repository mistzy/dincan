<?php

namespace App\Http\Controllers\Api;

use App\Models\AddressList;

use App\Models\Cart;
use App\Models\Member;
use App\Models\Menu;
use App\Models\Order;
use Endroid\QrCode\QrCode;
use App\Models\OrderGood;

use EasyWeChat\Foundation\Application;
use Endroid\QrCode\ErrorCorrectionLevel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Monolog\Handler\IFTTTHandler;
use Endroid\QrCode\LabelAlignment;

class OrderController extends Controller
{
    //添加订单
    public function add(Request $request){
        //1.查出收货地址
        $address = AddressList::find($request->post('address_id'));
//        dd($address);
        //2.判定地址是否错误
        if ($address === null){
            return[
                "status" => "false",
                "message" => "请选择正确的地址"
            ];

        }
        //3.分别给用户id和店铺id赋值
        //用户id
        $data["user_id"] = $request->post('user_id');
//        dd($data);
        //店铺id
        $carts = Cart::where("user_id",$request->post('user_id'))->get();
//        dd($carts);
        //先找到购物车第一条数据的商品id，在通过id在菜品中找到shop_id
        $shopId =Menu::find($carts[0]->goods_id)->shop_id;
//        dd($shopId);
        $data['shop_id']= $shopId;

        //生成订单号
        $data['order_code'] = date("ymdHis") . rand(1000,9999);

        //地址
        $data['provence'] = $address->provence;//省份
        $data['city'] = $address->city;//市
        $data['area'] = $address->area;//区县
        $data['detail_address'] = $address->detail_address;//详细地址
        $data['tel'] = $address->tel;//收货人手机号
        $data['name'] = $address->name;//收货人姓名
//        dd($data);

        //算商品总价
        $total = 0;

        foreach ($carts as $k => $v){
            $good = Menu::where('id',$v->goods_id)->first();
            //算出总价
            $total += $v->amount * $good->goods_price;
        }
        $data['total'] = $total;
        //状态 等待支付
        $data['status'] = 0;

        //启动事务
        DB::beginTransaction();
        try{
            //订单入库
            $order = Order::create($data);
//            dd($order);
            //订单商品
            foreach ($carts as $kk=>$cart){
                //得到当前菜品
                $menu = Menu::find($cart->goods_id);
                //保存
                $menu->save();

                OrderGood::insert([
                    'order_id'=>$order->id,
                    'goods_id'=>$cart->goods_id,
                    'amount'=>$cart->amount,
                    'goods_name'=>$menu->goods_name,
                    'goods_img'=>$menu->goods_img,
                    'goods_price'=>$menu->goods_price
                ]);
            }
            //清空购物车
            Cart::where("user_id",$request->post('user_id'))->delete();
            //提交事务
            DB::commit();

        }catch (\Exception $exception){
            //回滚
            DB::rollBack();
            return[
                "status" => "false",
                "message" => $exception->getMessage(),
            ];
        }

        return[
            "status" => "true",
            "message" => "添加成功",
            "order_id" => $order->id

        ];
    }

    //订单详情
    public function detail(Request $request){
        //获取id
        $order = Order::find($request->input('id'));
        $data['id'] = $order->id;
        $data['order_code'] = $order->order_code;
        $data['order_birth_time'] = (string)$order->created_at;
        $data['order_status'] = $order->order_status;
        $data['shop_id'] = $order->shop_id;
        $data['shop_name'] = $order->shop->shop_name;
        $data['shop_img'] = $order->shop->shop_img;
        $data['order_price'] = $order->total;
        $data['order_address'] = $order->provence . $order->city . $order->area . $order->detail_address;
        $data['goods_list'] = $order->goods;
        return $data;
//        dump($data);
    }

    //订单支付
    public function pay(Request $request)
    {
        // 得到订单
        $order = Order::find($request->post('id'));
        //得到用户
        $member =Member::find($order->user_id);
        //判断钱够不够
        if ($order->total > $member->money) {
            return [
                'status' => 'false',
                "message" => "用户余额不够，请充值"
            ];
        }
        //否则扣钱
        $member->money = $member->money - $order->total;
        $member->save();
        //更改订单状态
        $order->status = 1;
        $order->save();
        return [
            'status' => 'true',
            "message" => "支付成功"
        ];
    }
    public function index(Request $request)
    {
        $orders = Order::where("user_id", $request->input('user_id'))->get();
        $datas=[];
        foreach ($orders as $order) {
            $data['id'] = $order->id;
            $data['order_code'] = $order->order_code;
            $data['order_birth_time'] = (string)$order->created_at;
            $data['order_status'] = $order->order_status;
            $data['shop_id'] = (string)$order->shop_id;
            $data['shop_name'] = $order->shop->shop_name;
            $data['shop_img'] = $order->shop->shop_img;
            $data['order_price'] = $order->total;
            $data['order_address'] = $order->provence . $order->city . $order->area . $order->detail_address;
            $data['goods_list'] = $order->goods;
            $datas[] = $data;
        }
        return $datas;
    }
    public function wxPay(){
        //订单ID
        $id = \request()->get("id");
//把订单找出来
        $orderModel = Order::find($id);
        //0.配置
        $options = config("wechat");
        //dd($options);
        $app = new Application($options);
        $payment = $app->payment;
        //1.生成订单
        $attributes = [
            'trade_type' => 'NATIVE', // JSAPI，NATIVE，APP...
            'body' => '源码点餐平台支付',
            'detail' => '源码点餐平台支付',
            'out_trade_no' => $orderModel->order_code,
            'total_fee' => $orderModel->total * 100, // 单位：分
            'notify_url' => 'http://www3.zjl1996.cn/api/order/ok', // 支付结果通知网址，如果不设置则会使用配置里的默认地址
            // 'openid'           => '当前用户的 openid', // trade_type=JSAPI，此参数必传，用户在商户appid下的唯一标识，
            // ...
        ];
        $order = new \EasyWeChat\Payment\Order($attributes);
        //2. 统计下单
        $result = $payment->prepare($order);
        //   dd($result);
        if ($result->return_code == 'SUCCESS' && $result->result_code == 'SUCCESS') {
            //2.1 拿到预支付链接
            $codeUrl = $result->code_url;
            $qrCode = new QrCode($codeUrl);
            $qrCode->setSize(250);//大小
// Set advanced options
            $qrCode
                ->setMargin(10)//外边框
                ->setEncoding('UTF-8')//编码
                ->setErrorCorrectionLevel(ErrorCorrectionLevel::HIGH)//容错级别
                ->setForegroundColor(['r' => 45, 'g' => 65, 'b' => 0])//码颜色
                ->setBackgroundColor(['r' => 255, 'g' => 255, 'b' => 255])//背景色
                ->setLabel('微信扫码支付', 16, public_path("font/msyh.ttc"), LabelAlignment::CENTER)
                ->setLogoPath(public_path("images/loog.png"))//LOGO
                ->setLogoWidth(100);//LOGO大小
// Directly output the QR code
            header('Content-Type: ' . $qrCode->getContentType());//响应类型
            return $qrCode->writeString();
        } else {
            return $result;
        }
    }
    public function status(){
        $id = \request()->get("id");
        $order = Order::find($id);
        return $order;
    }

    public function ok()
{
    //0.配置
    $options = config("wechat");
    //dd($options);
    $app = new Application($options);
    //1.回调
    $response = $app->payment->handleNotify(function ($notify, $successful) {
        // 使用通知里的 "微信支付订单号" 或者 "商户订单号" 去自己的数据库找到订单
        // $order = 查询订单($notify->out_trade_no);
        $order=Order::where("order_code",$notify->out_trade_no)->first();
        if (!$order) { // 如果订单不存在
            return 'Order not exist.'; // 告诉微信，我已经处理完了，订单没找到，别再通知我了
        }
        // 如果订单存在
        // 检查订单是否已经更新过支付状态
        if ($order->status==1) { // 假设订单字段“支付时间”不为空代表已经支付
            return true; // 已经支付成功了就不再更新了
        }
        // 用户是否支付成功
        if ($successful) {
            // 不是已经支付状态则修改为已经支付状态
            //$order->paid_at = time(); // 更新支付时间为当前时间
            $order->status = 1;
        }
        $order->save(); // 保存订单
        return true; // 返回处理完成
    });
    return $response;
}










}
