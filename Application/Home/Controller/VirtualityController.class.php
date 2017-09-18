<?php
namespace Home\Controller;
use Think\Controller;

class VirtualityController extends PublicController {

    public function index(){
            $map['company_id'] = session('company_id');
            $map['branch_id'] = session('branch_id');
            $g= M('goods');
            $goods = $g->field('name,id')->where($map)->select();
            $this->assign('goods_name',$goods);
            $this->display();
    }

    public function goodscatelist(){
        $map['company_id'] = session('company_id');
        $map['branch_id'] = session('branch_id');
        $map['gid'] = I('post.gid');
        $map['company_id'] = session('company_id');
        $map['branch_id'] = session('branch_id');
        $goodscate = M('goodscate');
        $cate = $goodscate->field('cate,id')->where($map)->select();

        $this->ajaxReturn($cate);
    }

    public function upload(){
        $upload = new \Think\Upload();

        $upload->exts = array('jpg', 'gif', 'png', 'jpeg','obj','mtl');// ���ø����ϴ�����
        $upload->autoSub =true ;
        $upload->subType ='date';
        $upload->saveName = time().'_'.mt_rand();
        $upload->dateFormat ='ym' ;
        $upload->rootPath = './';
        $upload->savePath =  './Uploads/thumb/';// ���ø����ϴ�Ŀ¼

        $info = $upload->upload();

        if($info){

            foreach($info as $v){
                if($v['ext']=='obj'||$v['ext']=='mtl') {
                    $map['id'] = I('post.id');
                    $map['cate'] = I('post.cate');
                    $map['company_id'] = session('company_id');
                    $map['branch_id'] = session('branch_id');
                    $goodscate = M('goodscate');
                    //�ϴ�obj�ļ�
                    if ($v['ext'] == 'obj') {

                        $data['model_obj'] = $v['savepath'].$v['savename'];

                        if($goodscate->where($map)->save($data)){

                            $path = $v['savepath'].$v['savename'];

                            $this->ajaxReturn($path,'Obj',1);
                        }else{

                            $this->ajaxReturn(0,"Obj file upload failed!",0);
                        }
                    }
                    //�ϴ�mtl�ļ�
                    if ($v['ext'] == 'mtl') {

                        $cate = $goodscate->field('model_mtl')->where($map)->find()['model_mtl'];
                        if (!$cate) {//���goodscate����û��mtl�ļ�·���Ͳ��룬��ֹ�ظ�����
                            $data['model_mtl'] = $v['savepath'] . $v['savename'];
                            if ($goodscate->where($map)->save($data)) {

                                $path['path'] = $v['savepath'] . $v['savename'];
                                $file_path = $path['path'];
                                if (file_exists($file_path)) {
                                    $fp = fopen($file_path, "r");
                                    $str = fread($fp, filesize($file_path));

                                    //ƥ������滻��ͼƬ
                                    preg_match_all("/\bm.*\.(jpg|tif)/", $str, $matches);

                                    // ƥ��mtl�ļ��еı���
                                    preg_match_all("/newmtl\s(.*)\r/", $str, $result);

                                    $data1['cate_id'] = I('post.id');
                                    $data1['company_id'] = session('company_id');
                                    $data1['branch_id'] = session('branch_id');
                                    $data1['cate'] = I('post.cate');
                                    $mtl = M('mtl_title');
                                    $mtl_id = $mtl->field('id')->where($data1)->select();
                                    $id = array();
                                    foreach ($mtl_id[0] as $ke => $v) {
                                        $id[$ke] = $v;
                                    }
                                    // ������������mtl�ļ�title������ŵ�Ҫ���뵽���ݿ��е�������
                                    foreach ($result[1] as $k => $val) {
                                        $data1['mtl_title'] = $result[1][$k];

                                        //������ݿ���û�� id�ǲ�������ʱ���ص�id �����ǲ������id
                                        if (!$mtl_id) {
                                            $path['id'][$k] = $mtl->add($data1);//��mtl��title�������ݿ���
                                        } else {
                                            $path['id'] = $id['id'];
                                        }
                                    }
                                    $path['cate_id'] = I('post.id');
                                }

                                $this->ajaxReturn($path, 'Mtl', 1);
                            } else {

                                $this->ajaxReturn(0, "Mtl file upload failed!", 0);
                            }
                        }else{
                            //���ݿ���mtl�ļ��Ѿ����ڷ���mtl�ļ�����Ϣ
                            $mtl = M('mtl_title');
                            $mtl_id = $mtl->field('id')->where($data1)->select();

                            foreach ($mtl_id as $ke => $v) {
                                $path['id'][$ke] = $mtl_id[$ke]['id'];
                            }

                            $path['path'] = $cate[0]['model_mtl'];
                            $path['cate_id'] = I('post.id');
                            $this->ajaxReturn($path, 'Mtl', 1);
                        }
                    }
                }else{//�ϴ���ͼ
                    $map['value'] = I('post.value');
                    $map['cate_id'] = I('post.cate_id');
                    $map['company_id'] = session('company_id');
                    $map['branch_id'] = session('branch_id');
                    $maptable = M('map');
                    if(I('post.img')) {
                        $data['map'] = $v['savepath'] . $v['savename'];
                    }else{
                        $data['map_path'] = $v['savepath'] . $v['savename'];
                    }
                    if($maptable->where($map)->save($data)){

                        $path = $v['savepath'] . $v['savename'];

                        $this->ajaxReturn($path,"Texture file upload successfully!",1);
                    }else{

                        $this->ajaxReturn(0,"Texture file upload failed!",0);
                    }
                }
            }

        }else{
            $this->ajaxReturn($upload->getError());
            exit;
        }
    }

    //���ֶ�ֵ������д��map����
    public function modelmap(){
        $map['cate_id'] = I('post.cate_id');
        $map['company_id'] = session('company_id');
        $map['branch_id'] = session('branch_id');
        $info = M('yzgoodsinfo');
        $res = $info->field('attr,value,gid,cate_id')->where($map)->find();
        if($res) {
            $res['value'] = explode(',', $res['value']);
            $maptable = M('map');
            $map1['company_id'] = session('company_id');
            $map1['branch_id'] = session('branch_id');
            $map1['cate_id'] = I('post.cate_id');
            $map1['attr'] = $res['attr'];
            foreach ($res['value'] as $k=>$v){
                $data =array();
                $map1['value'] = $res['value'][$k];
                if(!$maptable->where($map1)->select()) {
                    $data['gid'] = $res['gid'];
                    $data['cate_id'] = I('post.cate_id');
                    $data['company_id'] = session('company_id');
                    $data['branch_id'] = session('branch_id');
                    $data['attr'] = $res['attr'];
                    $data['value'] = $res['value'][$k];
                    $maptable->add($data);
                }
            }
            $this->ajaxReturn($res);
        }else{
            $this->ajaxReturn(0);
        }
    }

    // �ѳ���ǰ��������Ʒ�����Ժ�mtl��title��ǰ̨���û���goodsinfo���mtl_title�����
    public function mtlinfo(){
        $info = M('yzgoodsinfo');
        $map['cate_id'] = I('post.cate_id');
        $map['company_id'] = session('company_id');
        $map['branch_id'] = session('branch_id');
        $attr = $info->field('id,attr')->where($map)->select();
        $mtl = M('mtl_title');
        if(I('post.mtl_id')) {
            $map1['id'] = array('in', I('post.mtl_id'));
            $map1['company_id'] = session('company_id');
            $map1['branch_id'] = session('branch_id');
            $mtl_title = $mtl->field('id,mtl_title')->where($map1)->select();
        }else{
            $map1['cate_id'] = I('post.cate_id');
            $map1['company_id'] = session('company_id');
            $map1['branch_id'] = session('branch_id');
            $mtl_title = $mtl->field('id,mtl_title')->where($map1)->select();
        }
        if($attr && $mtl_title) {
            $this->ajaxReturn($attr, $mtl_title, 1);
        }else{
            $this->ajaxReturn(0,0,0);
        }
    }

    // ���mtl��obj�ļ��Ƿ��Ѿ��ϴ� ����Ѿ��ϴ��������ٴ��ϴ� �ر�ssi uploader ����
    public function check(){
        if(I('post.ext')=="obj"){
            $map['id'] = I('post.id');
            $map['company_id'] = session('company_id');
            $map['branch_id'] = session('branch_id');
            $cate = M('goodscate');

            if($cate->field('model_obj')->where($map)->find()['model_obj']){
                $this->ajaxReturn('false','obj',1);
            }else{
                $this->ajaxReturn('true','obj',1);
            }
        }
        if(I('post.ext')=="mtl"){
            $map['id'] = I('post.id');
            $map['company_id'] = session('company_id');
            $map['branch_id'] = session('branch_id');
            $cate = M('goodscate');

            if($cate->field('model_mtl')->where($map)->find()['model_mtl']){
                $this->ajaxReturn('false','mtl',1);
            }else{
                $this->ajaxReturn('true','mtl',1);
            }
        }
    }
}