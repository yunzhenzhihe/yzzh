<?php
namespace Admin\Controller;
use Think\Controller;

//图片管理模块
class ShowimagesController extends Controller {

	public function index()
    {
        $this->display();
    }
    public function upload($returnType=1){


        $upload = new \Think\Upload();

        $upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->autoSub =true ;
        $upload->subType ='date';
        $upload->saveName = time().'_'.mt_rand();
        $upload->dateFormat ='ym' ;
        $upload->rootPath = './';
        $upload->savePath =  './Uploads/thumb/';// 设置附件上传目录
        $info = $upload->upload();

        if($info){

            foreach($info as $v){

                $imgData[] = $v['savepath'].$v['savename'];


                if($returnType==1){
                    echo json_encode(array(
                        'url'=>$imgData,
                        'state'=>'SUCCESS'
                    ));
                }elseif($returnType==2){
                    return $imgData;
                }else{
                    $_SESSION['imgData'][] = $imgData;
                    return;
                }

            }

        }else{
            echo json_encode(array(
                'state'=>$upload->getError()
            ));
            exit;
        }
    }
    public function delete(){
	    $M = M('image');
	    $map['id'] = I('post.id');
	    if($M->where($map)->delete()){
	        $this->success('删除成功！');
        }else{
	        $this->error('删除失败！');
        }
    }

    public function group(){
        $M = M('image');
        $count = $M->count();
        $page = new \Think\Page($count,24);
        $show = $page->show();
        $list = $M->field('image_name,image_url,id')->limit($page->firstRow.','.$page->listRows)->select();
        $info = M('yzgoodsinfo');
        $map['check'] = array('in','3,4');
        $res = $info->field('attr,value')->where($map)->select();
        foreach ($res as $k=>$v){
            $res[$k]['value'] = explode(',',$v['value']);
        }
//        var_dump($res);
        $this->assign('res',$list);
        $this->assign('page',$show);
        $this->display('Showimages/images_group');
    }
}