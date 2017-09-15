<?php
namespace Admin\Controller;
use Think\Controller;
class OrderController extends Controller {
    public function add(){
        if (IS_POST) {
            $post = I('post.');
            $address[] = $post['province1'];
            $address[] = $post['city1'];
            $address[] = $post['district1'];
            $address[] = $post['user_address'];
            $user_address = implode(" ", $address);
            $goods_number = $post['amount'];
            $company_id = $_SESSION['company_id'];
            $user_name = $post['user_name'];
            $user_telephone = $post['user_telephone'];
            $user_pay = $post['user_pay'];
            $webStyle = $_SESSION['web_style'];
            foreach ($post as $key => $value) {
                if (is_array($value)) {
                    $companyIdtr = implode(',', $value);
                    $post[$key] = $companyIdtr;
                    unset($companyIdtr);
                }
            }
            $post = array_diff_key($post, ['amount' => "xy", "user_name" => "xy", "user_address" => "xy", "province1" => "xy", "city1" => "xy", "district1" => "xy", "user_telephone" => "xy", "user_pay" => "xy"]);
            $goods_attr = json_encode($post, JSON_UNESCAPED_UNICODE);
            $order_number =  time() . rand(100000, 999999);
            $add_time = time();
            $goods = array(
                'company_id' => $company_id,
                'order_number' => $order_number,
                'goods_attr' => $goods_attr,
                'goods_number' => $goods_number,
                'add_time' => $add_time,
                'user_name' => $user_name,
                'user_address' => $user_address,
                'user_telephone' => $user_telephone,
                'user_pay' => $user_pay
            );
            $res = M('dzgoods_order')->add($goods);
            if ($res) {
                $this->success(L('Order_succes'), U('showlist', array('order_number' => $order_number)), 3);
            } else {
                $this->error(L('Order_error'), U('Index/detail',array('company_id' => $company_id,'web_style' => $webStyle)));
            }
        }
    }

    public function showlist(){
        $get = I('get.');
        $order_number = $get['order_number'];
        $data = M('dzgoods_order')
            ->where("order_number = $order_number")
            ->find();
        $data['goods_attr'] = json_decode($data['goods_attr'],true);
        $this -> assign('data',$data);
        $this -> display();
    }

    public function del(){
        $company_id = $_SESSION['company_id'];
        $ordernum = I('get.order_number');
        $res = M('dzgoods_order') -> where("order_number = $ordernum") -> delete();
        $webStyle = $_SESSION['web_style'];
        if($res){
            $this -> success(L('del_succes'),U("Index/detail",array('company_id' => $company_id,'web_style' => $webStyle)),3);
        }else{
            $this -> error(L('del_error'),U('showlist',array('order_number' => $ordernum)));
        }
    }

}