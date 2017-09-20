<?php

namespace Home\Controller;

use Think\Controller;

class VirtualityController extends PublicController
{

    public function index()
    {
        $map['company_id'] = session('company_id');
        $map['branch_id'] = session('branch_id');
        $g = M('goods');
        $goods = $g->field('name,id')->where($map)->select();
        $this->assign('goods_name', $goods);
        $this->display();
    }

    public function goodscatelist()
    {
        $map['company_id'] = session('company_id');
        $map['branch_id'] = session('branch_id');
        $map['gid'] = I('post.gid');
        $map['company_id'] = session('company_id');
        $map['branch_id'] = session('branch_id');
        $goodscate = M('goodscate');
        $cate = $goodscate->field('cate,id')->where($map)->select();

        $this->ajaxReturn($cate);
    }

    public function upload()
    {
        $upload = new \Think\Upload();

        $upload->exts = array('jpg', 'gif', 'png', 'jpeg', 'obj', 'mtl');// 设置附件上传类型
        $upload->autoSub = true;
        $upload->subType = 'date';
        $upload->saveName = time() . '_' . mt_rand();
        $upload->dateFormat = 'ym';
        $upload->rootPath = './';
        $upload->savePath = './Uploads/thumb/';// 设置附件上传目录

        $info = $upload->upload();

        if ($info) {

            foreach ($info as $v) {
                if ($v['ext'] == 'obj' || $v['ext'] == 'mtl') {
                    $map['id'] = I('post.id');
                    $map['cate'] = I('post.cate');
                    $map['company_id'] = session('company_id');
                    $map['branch_id'] = session('branch_id');
                    $goodscate = M('goodscate');
                    //上传obj文件
                    if ($v['ext'] == 'obj') {
//                        \Think\Log::write('调试的$post：'.json_encode(I('post.')));
                        $data['model_obj'] = $v['savepath'] . $v['savename'];

                        if ($goodscate->where($map)->save($data)) {

                            $path = $v['savepath'] . $v['savename'];

                            $this->ajaxReturn($path, 'Obj', 1);
                        } else {

                            $this->ajaxReturn(0, "Obj file upload failed!", 0);
                        }
                    }
                    //上传mtl文件
                    if ($v['ext'] == 'mtl') {
//                        \Think\Log::write('调试的$post：'.json_encode(I('post.')));
                        $cate = $goodscate->field('model_mtl')->where($map)->find()['model_mtl'];
                        if (!$cate) {//如果goodscate表中没有mtl文件路径就插入，防止重复插入
                            $data['model_mtl'] = $v['savepath'] . $v['savename'];
                            if ($goodscate->where($map)->save($data)) {

                                $path['path'] = $v['savepath'] . $v['savename'];
                                $file_path = $path['path'];
                                if (file_exists($file_path)) {
                                    $fp = fopen($file_path, "r");
                                    $str = fread($fp, filesize($file_path));
//                                    //匹配可以替换的图片
//                                    preg_match_all("/\bm.*\.(jpg|tif)/", $str, $matches);

                                    // 匹配mtl文件中的标题
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
                                    // 遍历读出来的mtl文件title并将其放到要插入到数据库中的数据中
                                    foreach ($result[1] as $k => $val) {
                                        $data1['mtl_title'] = $result[1][$k];

                                        //如果数据库中没有 id是插入数据时返回的id 否则是查出来的id
                                        if (!$mtl_id) {
                                            $path['id'][$k] = $mtl->add($data1);//将mtl的title插入数据库中
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
                        } else {
                            //数据库中mtl文件已经存在返回mtl文件的信息
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
                } else {//上传贴图

                    $map['id'] = I('post.id');
                    $map['company_id'] = session('company_id');
                    $map['branch_id'] = session('branch_id');
                    $maptable = M('map');

                    $data['map_path'] = $v['savepath'] . $v['savename'];

                    if ($maptable->where($map)->save($data)) {

                        $path = $v['savepath'] . $v['savename'];

                        $this->ajaxReturn($path, "Texture file upload successfully!", 1);
                    } else {

                        $this->ajaxReturn(0, "Texture file upload failed!", 0);
                    }
                }
            }

        } else {
            $this->ajaxReturn($upload->getError());
            exit;
        }
    }

    //把字段值读出来写到map表中
    public function modelmap()
    {
        $map['cate_id'] = I('post.cate_id');
        $map['company_id'] = session('company_id');
        $map['branch_id'] = session('branch_id');
        $info = M('yzgoodsinfo');
        $res = $info->field('attr,value,gid,cate_id')->where($map)->select();

        if ($res) {
            $maptable = M('map');
            $map1['company_id'] = session('company_id');
            $map1['branch_id'] = session('branch_id');
            $map1['cate_id'] = I('post.cate_id');
            $mes = $maptable->where($map1)->select();

            foreach ($res as $key => $val) {
                $res[$key]['value'] = explode(',', $val['value']);
                $map1['attr'] = $res[$key]['attr'];
                foreach ($res[$key]['value'] as $k => $v) {
                    $data = array();
                    $map1['value'] = $res[$key]['value'][$k];
                    if (!$mes) {
                        $data['gid'] = $val['gid'];
                        $data['cate_id'] = I('post.cate_id');
                        $data['company_id'] = session('company_id');
                        $data['branch_id'] = session('branch_id');
                        $data['attr'] = $val['attr'];
                        $data['value'] = $res[$key]['value'][$k];
                        $id[$k] = $maptable->add($data);
                    }
                }
            }

            $this->ajaxReturn($mes);
        } else {
            $this->ajaxReturn(0);
        }
    }

    // 搜出当前操作的商品的属性和mtl的title在前台展示给用户
    public function mtlinfo()
    {
        $goodscate = M('goodscate');
        $where['id'] = I('post.cate_id');
        $where['company_id'] = session('company_id');
        $where['branch_id'] = session('branch_id');
        $mod = $goodscate->field('model_obj,model_mtl')->where($where)->find();
        if ($mod['model_obj'] && $mod['model_mtl']) {
            $info = M('yzgoodsinfo');
            $map['cate_id'] = I('post.cate_id');
            $map['company_id'] = session('company_id');
            $map['branch_id'] = session('branch_id');
            $info->field('id,attr')->where($map)->select();
            $attr = $info->field('id,attr')->where($map)->select();

            $mtl = M('mtl_title');
            if (I('post.mtl_id')) {
                $map1['id'] = array('in', I('post.mtl_id'));
                $map1['company_id'] = session('company_id');
                $map1['branch_id'] = session('branch_id');
                $mtl_title = $mtl->field('id,mtl_title')->where($map1)->select();
            } else {
                $map1['cate_id'] = I('post.cate_id');
                $map1['company_id'] = session('company_id');
                $map1['branch_id'] = session('branch_id');
                $mtl_title = $mtl->field('id,mtl_title')->where($map1)->select();
            }

            if ($attr && $mtl_title) {
                $this->ajaxReturn($attr, $mtl_title, 1);
            } else {
                $this->ajaxReturn(0, 0, 0);
            }
        } else {
            $res['info'] = 'none';
            $this->ajaxReturn($res);
        }
    }

    // 检查mtl，obj文件是否已经上传 如果已经上传不可以再次上传 关闭ssi uploader 开关
    public function check()
    {
        if (I('post.ext') == "obj") {
            $map['id'] = I('post.id');
            $map['company_id'] = session('company_id');
            $map['branch_id'] = session('branch_id');
            $cate = M('goodscate');

            if ($cate->field('model_obj')->where($map)->find()['model_obj']) {
                $this->ajaxReturn('false', 'obj', 1);
            } else {
                $this->ajaxReturn('true', 'obj', 1);
            }
        }
        if (I('post.ext') == "mtl") {
            $map['id'] = I('post.id');
            $map['company_id'] = session('company_id');
            $map['branch_id'] = session('branch_id');
            $cate = M('goodscate');

            if ($cate->field('model_mtl')->where($map)->find()['model_mtl']) {
                $this->ajaxReturn('false', 'mtl', 1);
            } else {
                $this->ajaxReturn('true', 'mtl', 1);
            }
        }
    }

    //将goodsinfo表和mtl_title表关联
    public function related()
    {
        if (I('post.mtl_id') && I('post.attr_id')) {
            $goodsinfo = M('yzgoodsinfo');
            $map['id'] = I('post.attr_id');
            $map['company_id'] = session('company_id');
            $map['branch_id'] = session('branch_id');
            $data['mtl_id'] = I('post.mtl_id');
            $res = $goodsinfo->where($map)->save($data);

            $mtl = M('mtl_title');
            $map1['id'] = I('post.mtl_id');
            $map1['company_id'] = session('company_id');
            $map1['branch_id'] = session('branch_id');
            $data1['info_id'] = I('post.attr_id');
            $res1 = $mtl->where($map1)->save($data1);

            if ($res && $res1) {
                $result['status'] = 1;
                $result['content'] = '关联成功！';
                $this->ajaxReturn($result, 'json');
            } else {
                $result['status'] = 1;
                $result['content'] = '关联成功！';
                $this->ajaxReturn($result, 'json');
            }
        } else {
            $this->ajaxReturn(0, 0, 0);
        }
    }

}