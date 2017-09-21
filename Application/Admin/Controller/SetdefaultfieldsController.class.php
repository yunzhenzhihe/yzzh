<?php
namespace Admin\Controller;
use Think\Controller;

//设置自定义字段
class SetdefaultfieldsController extends PublicController {
 
	function defaultfields_list(){   //自定义字段罗列	
		$dao = M("yzgoodsinfo");
		$map['compny_id'] = $_SESSION['company_id'];   // 查询记录 限定在本公司id里面
        $map['cate_id'] = I('get.id');
		$list=$dao
			->field(array('id','guid','gid','sort','attr',
						  'check','value',
						  ))		
			->where($map)
			->order('CONVERT( sort USING gbk )  asc  ')
			->select();

		$cate_id = I('get.id');     //分类id
		$cate = M('goodscate');
        $map1['id'] = I('get.id');
		$name = $cate->field('gid,cate')->where($map1)->find();
    	$map2['id'] = $name['gid'];
    	$goods = M('goods');
    	$goods_name = $goods->field('id,name')->where($map2)->find();

		$this->assign('recordlist',$list);
        $this->assign('name',$name);
        $this->assign('goods_name',$goods_name);
        $this->assign('cate_id',$cate_id );
        $this->display();	

	}	
	
	
	function defaultfields_add(){   //添加新自定义字段
        $this->display();	
	}	
	
	
	public  function ajaxinsert(){	//添加

		if ( ( $_POST['check']=='1' )  ||  (  $_POST['check']=='2'  ) )  {		 //当选择文本框或者时间的话 字段值赋空
		   $_POST['value'] ='';
		}
	    $this->pub_add('Yzgoodsinfo');
	}	
	
	function ajaxedit(){  //修改查询
        $this->pub_edit('Yzgoodsinfo');			
	}	
		
	function ajaxsave(){  //修改保存
		if ( ( $_POST['check']=='1' )  ||  (  $_POST['check']=='2'  ) )  {		 //当选择文本框或者时间的话 字段值赋空
		   $_POST['value'] ='';
		}	
	    $this->pub_save('Yzgoodsinfo');
	}
	
	function ajaxdel(){	 //删除
	   $this->pub_del('Yzgoodsinfo');
    }	
	
    //排序上移
    function sortup(){		
        $id = $_POST['id'];//当前操作的属性的Id
		$sort= $_POST['sort'];//当前操作的属性的Id
		
		$dao = M("yzgoodsinfo");
		$map['compny_id'] = $_SESSION['company_id'];   // 查询记录 限定在本公司id里面	
        $map['sort'] = array(array('lt',$sort)) ;
		$rs=$dao
			->field(array('id','sort',))
            ->order('CONVERT( sort USING gbk )  desc ')			
			->where($map)
			->select();	

		if ($rs){
			$id1 = $rs[0]['id'];//当前操作的属性的Id
			$sort1= $rs[0]['sort'];//当前操作的属性的sort	

		    $map1['compny_id'] = $_SESSION['company_id'];   // 查询记录 限定在本公司id里面	
            $map1['id'] = $id ;		
            $data1['sort']=$sort1;
		    $rs1=$dao		
				->where($map1)
                 ->save($data1); // 根据条件保存修改的数据

		    $map2['compny_id'] = $_SESSION['company_id'];   // 查询记录 限定在本公司id里面	
            $map2['id'] = $id1 ;	
            $data2['sort']=$sort;			
		    $rs2=$dao		
				->where($map2)
                 ->save($data2); // 根据条件保存修改的数据
			
			$this->ajaxReturn(1,"操作成功！",1);   //保存数据成功
			
		}else{
			$this->ajaxReturn(0,"错误，刷新重试。",0);
		}				
		
    }	
	
    //排序下移
    function sortdown(){		
        $id = $_POST['id'];//当前操作的属性的Id
		$sort= $_POST['sort'];//当前操作的属性的Id
		
		$dao = M("yzgoodsinfo");
		$map['compny_id'] = $_SESSION['company_id'];   // 查询记录 限定在本公司id里面	
        $map['sort'] = array(array('GT',$sort)) ;
		$rs=$dao
			->field(array('id','sort',))
            ->order('CONVERT( sort USING gbk )  asc ')			
			->where($map)
			->select();	

		if ($rs){
			$id1 = $rs[0]['id'];//当前操作的属性的Id
			$sort1= $rs[0]['sort'];//当前操作的属性的sort	

		    $map1['compny_id'] = $_SESSION['company_id'];   // 查询记录 限定在本公司id里面	
            $map1['id'] = $id ;		
            $data1['sort']=$sort1;
		    $rs1=$dao		
				->where($map1)
                 ->save($data1); // 根据条件保存修改的数据

		    $map2['compny_id'] = $_SESSION['company_id'];   // 查询记录 限定在本公司id里面	
            $map2['id'] = $id1 ;	
            $data2['sort']=$sort;			
		    $rs2=$dao		
				->where($map2)
                 ->save($data2); // 根据条件保存修改的数据
			
			$this->ajaxReturn(1,"操作成功！",1);   //保存数据成功
			
		}else{
			$this->ajaxReturn(0,"错误，刷新重试。",0);
		}
    }
}