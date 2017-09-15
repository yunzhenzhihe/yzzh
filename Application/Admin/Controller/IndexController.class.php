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
            /***************************根据id获取商品，别用select********************************/
            $webStyle = I('get.web_style');
            $companyId = I('get.company_id');
            session('company_id',$companyId);

            if(!empty($webStyle)){
                $goodsAttr = $this -> show($companyId);
        } else{
                $goodsAttr = $this -> show($companyId);
                $webStyle = $goodsAttr[0]['web_style'];
            }
        session('web_style',$webStyle);
            $this -> assign('goodsAttr', $goodsAttr);
            $this -> display("detail$webStyle");
        }



    public function show($companyId){
        $goodsAttr = M('company')->alias('t1')
            ->field('t1.company_id,t1.web_style,t2.*')
            ->join('right join yt_yzgoodsinfo as t2 on t1.Company_Id=t2.Company_Id')
            ->where("t1.company_id = $companyId")
            ->select();
        foreach($goodsAttr as $key => $value){
            $arr[] = $goodsAttr[$key]['value'];
            if(is_string($arr[$key])){
                $goodsAttr[$key]['value'] = explode(',',$arr[$key]);
            }
        }

        array_multisort(array_column($goodsAttr,'sort'),SORT_ASC ,$goodsAttr);
        return $goodsAttr;
    }
}