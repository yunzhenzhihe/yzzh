<?php
namespace Home\Controller;
use Think\Controller;

// 模块
class SetsoftinfoController extends PublicController {
	
	function softmap(){   //软件默认参数设置
		$map1['company_id'] = array("EQ",$_SESSION['company_id']);  //基准地图的修改
		$dao1 = M('company');			
		$rs1=$dao1->field(array('lat','lng','zoom_level'))->where($map1)->find();	
	   if ( (is_null($rs1))  ||  (!($rs1)) )  {   //判断 如果查询结果是null 或者是 false 返回失败 
		     $this->error('操作失败，请刷新重试');
			 return;
		}
		
		$this->assign("map_info", $rs1); 	///基准地图		
        $this->display();	       			
	}	
	
	function softinfo(){   //软件默认参数设置
        $map['company_id'] = array("EQ",$_SESSION['company_id']);
        $style = M('company')->field('web_style')->where($map)->find();
        $this->assign('style',$style);
        $this->display();	       			
	}	
	
    function savesoftmap(){   //保存地图信息
		$lng = $_POST['lng'];
		$lat = $_POST['lat'];
		$zoom_level = $_POST['zoom_level'];	
		
		if  (empty($lng) || empty($lat)  || empty($zoom_level)  ) {
			$this->ajaxReturn(0,"数据错误，请刷新重试",0);	
		}	

		$map1['company_id'] = array("EQ",$_SESSION['company_id']);  //基准地图的修改
		$dao1 = M('company');			
		$rs1=$dao1->field(array('id'))->where($map1)->find();	
	    if ( (is_null($rs1))  ||  (!($rs1)) )  {   //判断 如果查询结果是null 或者是 false 返回失败 
		     $this->ajaxReturn(0,"数据错误，请刷新重试",0);	
		}		

	    $dao = M('Company');  	
		$data['lat'] = $lat ;
		$data['lng'] = $lng ;
		$data['zoom_level'] = $zoom_level;   //地图缩放等级	
		$map['company_id'] = $_SESSION['company_id'];   // 查询记录 限定在本公司id里面	
		$map['id'] = $rs1['id'];   // 
		$rs = $dao->where($map)->save($data); // 根据条件保存数据 	
		if( $rs ){   //成功		
			 $_SESSION['city_lng'] = $lng; 
			 $_SESSION['city_lat'] = $lat; 
			 $_SESSION['city_zoomLevel'] = $zoom_level; 		
			 $this->ajaxReturn(1,'数据保存成功，所有客户端退出软件，重新登录，数据才会生效',1);				    								
		 } else{    //失败	
			$this->ajaxReturn(0,"数据保存失败或者没有变化不需要保存，请刷新重试",0);					
		 }		  					
	}
	
	function ajaxsave(){  //修改保存
		$select_interval_days = $_POST['select_interval_days'];
		if ( ( !(in_array($select_interval_days, array("1","2","3","4","5","6","7","8","9","10"))))  )  {
            $this->ajaxReturn(0,'数据错误，请刷新重试',0);
        }

		$map1['company_id'] = array("EQ",$_SESSION['company_id']);  //基准地图的修改
		$dao1 = M('company');
		$rs1=$dao1->field(array('id'))->where($map1)->find();
	    if ( (is_null($rs1))  ||  (!($rs1)) )  {   //判断 如果查询结果是null 或者是 false 返回失败
		     $this->ajaxReturn(0,"数据错误，请刷新重试",0);
		}

	    $dao = M('Company');
		$data['web_style'] = $select_interval_days ;  //查询销售或者售后记录时默认间隔天数
		$map['company_id'] = $_SESSION['company_id'];   // 查询记录 限定在本公司id里面
		$map['id'] = $rs1['id'];   //
		$rs = $dao->where($map)->save($data); // 根据条件保存数据
		if( $rs ){   //成功
			 $_SESSION['select_interval_days'] = $select_interval_days;
			 $this->ajaxReturn(1,'数据保存成功，所有客户端退出软件，重新登录，数据才会生效',1);
		 } else{    //失败
			$this->ajaxReturn(0,"数据保存失败或者没有变化不需要保存，请刷新重试",0);
		 }
	}	
	
		
	

}