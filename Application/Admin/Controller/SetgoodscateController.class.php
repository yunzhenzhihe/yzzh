<?php
namespace Admin\Controller;
use Think\Controller;

class SetgoodscateController extends PublicController{

    public $cateListAll = array();
    public function cate_list(){
        $map['id'] = I('get.id');
        $goods = M('goods');
        $name = $goods->field('name')->where($map)->find();
        $gid = I('get.id');
        $this->cateChildList(0,$gid);//�Ӹ���=0��ʼ�ݹ�
        $list=$this->cateListAll;
        foreach($list as $k=>$v){
            $num = count(explode(',',$v['path']))-2;
            $list[$k]['cate'] = str_repeat('&nbsp&nbsp|----&nbsp&nbsp',$num).$v['cate'];
        }

        $this->assign('cate',$list);
        $this->assign('recordlist',$list);
        $this->assign('gid',$gid);
        $this->assign('name',$name);
        $this->display();
    }

    public function ajaxinsert(){	//���

        $this->pub_add('goodscate');
    }
    // ��ӷ������
    public function add(){
        $M = M('goodscate');
        if(I('post.id')==0){
            $data['cate'] = I('post.cate');
            $data['pid'] = 0;
            $data['path'] = '0,';
            $data['gid'] = I('gid');
        }else{
            $id = I('post.id');
            $data['cate'] = I('post.cate');
            $data['pid'] = I('post.id');
            $data['gid'] = I('post.gid');
            $map['id'] = $id;
            $p = $M->field('path')->where($map)->find();
            $path = $p['path'];
            $data['path'] = $path.$id.',';
        }
        $res = $M->add($data);
        if($res){
            $this->success("��ӳɹ���");
        }else{
            $this->error('���ʧ�ܣ�������');
        }
    }

    protected function cateChildList($pid,$gid)
    {
        $cate=M('goodscate');
        $map['pid'] = $pid;
        $map['gid'] = $gid;
        $parent = $cate->where($map)->order('path asc,id asc')->select();
        if($parent)
        {
            foreach($parent as $item)
            {
                $this->cateListAll[]=$item;
                $this->cateChildList($item['id'],$gid);
            }
        }
    }

    public function ajaxedit(){  //�޸Ĳ�ѯ
        $this->pub_edit('goodscate');
    }

    public function ajaxsave(){  //�޸ı���
        $this->pub_save('goodscate');
    }

    public function delete(){	 //ɾ��
        $dao = M('goodscate');
        $map['pid'] = I('get.id');
        $map1['id'] = I('get.id');
        $map['company_id'] = session('company_id');   //ɾ����¼ �޶��ڱ���˾id����
        $map1['company_id'] = session('company_id');
        $rs=$dao->where($map)->find();
        if ($rs) {
            $this->error('There is a subcategory under this category that cannot be deleted!','javascript:history.back(-1);',3);
        }
        else {
            if($dao->where($map1)->delete()){
                $this->success('Delete successfully!','javascript:history.back(-1);',3);
            }else{
                $this->error('Delete failed!','javascript:history.back(-1);',3);
            }
        }
    }
}