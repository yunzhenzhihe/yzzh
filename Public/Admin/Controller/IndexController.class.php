<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends Controller {
    public $cateListAll;
    public function index(){
        $this -> display();
    }
    public function detail()
    {
        if (IS_POST) {
            $post = I('post.');
            $address[] = $post['province1'];
            $address[] = $post['city1'];
            $address[] = $post['district1'];
            $address[] = $post['user_address'];
            $user_address = implode(",",$address);
            $goods_number = $post['amount'];
            $company_id = $_SESSION['company_id'];
            $user_name = $post['user_name'];
            $user_telephone = $post['user_telephone'];
            $user_pay = $post['user_pay'];

            foreach ($post as $key => $value) {
                if (is_array($value)) {
                    $companyIdtr = implode(',', $value);
                    $post[$key] = $companyIdtr;
                    unset($companyIdtr);
                }
            }
            $post = array_diff_key($post, ['amount' => "xy", "user_name" => "xy","user_address" => "xy","province1" => "xy","city1" => "xy","district1" => "xy","user_telephone" => "xy","user_pay" => "xy"]);
            $goods_attr = json_encode($post, JSON_UNESCAPED_UNICODE);
            $order_number = date('YmdHis', time()) . rand(100000, 999999);
            $add_time = time();
            $goods = array(
                'company_id' => $company_id,
                'order_number' => $order_number,
                'goods_attr' => $goods_attr,
                'goods_number' => $goods_number,
                'add_time' => $add_time,
                'user_name' =>  $user_name,
                'user_address'  => $user_address,
                'user_telephone' => $user_telephone,
                'user_pay'  =>  $user_pay
            );
            $res = M('dzgoods_order')->add($goods);
            if($res){
                $this -> success(L('Order_succes'),U('add',array('order_number' => $order_number)),3);
            } else {
                $this -> error(L('Order_error'),U('detail'));
            }

        } else {

            /***************************根据id获取商品，别用select********************************/
            $companyId = I('get.company_id');
            $goodsAttr = M('company')->alias('t1')
                ->field('t1.company_id,t1.web_style,t2.*')
                ->join('right join yt_yzgoodsinfo as t2 on t1.Company_Id=t2.Company_Id')
                ->where("t1.company_id = $companyId")
                ->select();
            $webStyle = $goodsAttr[0]['web_style'];
            session('company_id',$companyId);


            foreach($goodsAttr as $key => $value){
                $arr[] = $goodsAttr[$key]['value'];
                if(is_string($arr[$key])){
                    $goodsAttr[$key]['value'] = explode(',',$arr[$key]);
                }
            }
            array_multisort(array_column($goodsAttr,'sort'),SORT_ASC ,$goodsAttr);
            $this->assign('goodsAttr', $goodsAttr);
            $this->display("detail$webStyle");
        }
    }



    public function add(){
        $get = I('get.');
        $order_number = $get['order_number'];
        $data = M('dzgoods_order')
            ->where("order_number = $order_number")
            ->find();
        $this -> assign('data',$data);
        $this->display();
    }

    public function del(){
        $company_id = $_SESSION['company_id'];
        $ordernum = I('get.order_number');
        $res = M('dzgoods_order') -> where("order_number = $ordernum") -> delete();
        if($res){
            $this -> success('删除成功',U('detail',array('company_id' => $company_id)),3);
        }else{
            $this -> error('删除失败',U('add',array('order_number' => $ordernum)));
        }
    }
}