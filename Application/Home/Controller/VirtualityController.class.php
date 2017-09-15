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

        $upload->exts = array('jpg', 'gif', 'png', 'jpeg','obj','mtl');// 设置附件上传类型
        $upload->autoSub =true ;
        $upload->subType ='date';
        $upload->saveName = time().'_'.mt_rand();
        $upload->dateFormat ='ym' ;
        $upload->rootPath = './';
        $upload->savePath =  './Uploads/thumb/';// 设置附件上传目录

        $info = $upload->upload();

        if($info){

            foreach($info as $v){
                if($v['ext']=='obj'||$v['ext']=='mtl') {
                    $map['id'] = I('post.id');
                    $map['cate'] = I('post.cate');
                    $map['company_id'] = session('company_id');
                    $map['branch_id'] = session('branch_id');
                    $goodscate = M('goodscate');
                    //上传obj文件
                    if ($v['ext'] == 'obj') {

                        $data['model_obj'] = $v['savepath'].$v['savename'];

                        if($goodscate->where($map)->save($data)){

                            $path = $v['savepath'].$v['savename'];

                            $this->ajaxReturn($path,'Obj',1);
                        }else{

                            $this->ajaxReturn(0,"Obj file upload failed!",0);
                        }
                    }
                    //上传mtl文件
                    if ($v['ext'] == 'mtl') {

                        $cate = $goodscate->field('model_mtl')->where($map)->select();
                        if (!$cate) {//如果goodscate表中没有mtl文件路径就插入，防止重复插入
                            $data['model_mtl'] = $v['savepath'] . $v['savename'];
                            if ($goodscate->where($map)->save($data)) {

                                $path['path'] = $v['savepath'] . $v['savename'];
                                $file_path = $path['path'];
                                if (file_exists($file_path)) {
                                    $fp = fopen($file_path, "r");
                                    $str = fread($fp, filesize($file_path));

                                    preg_match_all("/\bm.*\.(jpg|tif)/", $str, $matches);

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
                                    foreach ($result[1] as $k => $val) {
                                        $data1['mtl_title'] = $result[1][$k];
                                        if (!$mtl_id) {//如果数据库中没有 id是返回的id 否则是查出来的id
                                            $path['id'][$k] = $mtl->add($data1);
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
                }else{//上传贴图
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

    //把字段值读出来写到map表中
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
    public function mtlinfo(){
        $info = M('yzgoodsinfo');
        $map['cate_id'] = I('post.cate_id');
        $map['company_id'] = session('company_id');
        $map['branch_id'] = session('branch_id');
        $attr = $info->field('id,attr')->where($map)->select();
        $mtl = M('mtl_title');
        $map1['id'] = array('in',I('post.mtl_id'));
        $map1['company_id'] = session('company_id');
        $map1['branch_id'] = session('branch_id');
        $mtl_title = $mtl->field('id,mtl_title')->where($map1)->select();

        if($attr && $mtl_title) {
            $this->ajaxReturn($attr, $mtl_title, 1);
        }else{
            $this->ajaxReturn(0,0,0);
        }
    }
}