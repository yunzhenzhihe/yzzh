<?php
namespace Home\Controller;
use Think\Controller;

class SetgoodsController extends PublicController
{
    function goods_list(){   //销售人员
        $dao = M('goods');
        $map['company_id'] = $_SESSION['company_id'];   // 查询记录 限定在本公司id里面
        $count = $dao->where($map)->count();    //计算总数
        $p = new \Think\Page($count, cookie('NumberOfRows'));//分页

        $list=$dao
            ->where($map)
            ->order('id')
            ->limit($p->firstRow.','.$p->listRows)
            ->select();

        $page = $p->show();            //分页的导航条的输出变量
        $this->assign("page", $page);
        $this->assign("recordlist", $list); //数据循环变量
        $this->assign( "selectrowslist", get_array_numberofrows() );  //选择每页显示多少行  select 下拉框的内容
        $this->display();
    }

    public function ajaxinsert(){	//添加

        $this->pub_add('goods');
    }

    public function ajaxedit(){  //修改查询
        $this->pub_edit('goods');
    }

    public function ajaxsave(){  //修改保存
        $this->pub_save('goods');
    }

    public function delete(){	 //删除
        $dao = M('goodscate');
        $map['gid'] = I('get.id');
        $map['company_id'] = session('company_id');   //删除记录 限定在本公司id里面
        $rs=$dao->where($map)->find();
        var_dump($rs);
        if ($rs) {
           $this->error('There is a subcategory under this category that cannot be deleted!','javascript:history.back(-1);',3);
        }
        else {
            $map1['id'] = I('get.id');
            $map1['company_id'] = session('company_id');
           if(M('goods')->where($map1)->delete()){
               $this->success('Delete successfully!',$_SERVER['HTTP_REFERER'],3);
           }else{
               $this->error('Delete failed!','javascript:history.back(-1);',3);
           }
        }
    }
}