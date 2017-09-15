<?php
namespace Home\Controller;
use Think\Controller;

class SetgoodsController extends PublicController
{
    function goods_list(){   //������Ա
        $dao = M('goods');
        $map['company_id'] = $_SESSION['company_id'];   // ��ѯ��¼ �޶��ڱ���˾id����
        $count = $dao->where($map)->count();    //��������
        $p = new \Think\Page($count, cookie('NumberOfRows'));//��ҳ

        $list=$dao
            ->where($map)
            ->order('id')
            ->limit($p->firstRow.','.$p->listRows)
            ->select();

        $page = $p->show();            //��ҳ�ĵ��������������
        $this->assign("page", $page);
        $this->assign("recordlist", $list); //����ѭ������
        $this->assign( "selectrowslist", get_array_numberofrows() );  //ѡ��ÿҳ��ʾ������  select �����������
        $this->display();
    }

    public function ajaxinsert(){	//���

        $this->pub_add('goods');
    }

    public function ajaxedit(){  //�޸Ĳ�ѯ
        $this->pub_edit('goods');
    }

    public function ajaxsave(){  //�޸ı���
        $this->pub_save('goods');
    }

    public function delete(){	 //ɾ��
        $dao = M('goodscate');
        $map['gid'] = I('get.id');
        $map['company_id'] = session('company_id');   //ɾ����¼ �޶��ڱ���˾id����
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