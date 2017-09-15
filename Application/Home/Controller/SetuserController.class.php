<?php
namespace Home\Controller;
use Think\Controller;

class SetuserController extends PublicController {

	Public function user_list(){   //操作员列表  ajax方法处理分页	
        $dao = M("user");
		$map['company_id'] = $_SESSION['company_id'];   // 查询记录 限定在本公司id里面		      	
		$list=$dao
			->where($map)
			->field(array('id','username','level','realname','tel','creat_time','mail'))	
			->order('username asc')
			->select();		
        $this->assign("userlist", $list); //数据循环变量	
        $this->display();	
	}	
	
	public function changepass(){		 //修改密码	   
			 $this->display();
    }
	
	Public function ajaxinsert(){	//添加	
		$password = get_rand_string(4,5);  //获得一个 没有0,4 的随机数字 	随机密码		
		$_POST['password']=$password;
		$dao = D('User');  
        if (!$dao->create()){  // 如果创建失败 表示验证没有通过 输出错误提示信息            
		    $this->ajaxReturn(0,$dao->getError(),0);
        }
		else{                // 验证通过 可以进行其他数据操作          
			$rs = $dao->add(); // 根据条件保存添加的数据 	
			if ($rs) {
				 $result = send_mail( $_POST['mail'] , "一方代驾软件发送注册密码" , get_mail_body_findpass( $_SESSION['company_id'], $_POST['username'] ,$password ) ); //发送注册邮件 
				 if( $result ) {
					$this->ajaxReturn(1,'密码已经发送到注册邮箱,请查看',1);				    
				 }else{			 
					$this->ajaxReturn(0,$result,0);
				 }	
			}
			else{
				 $this->ajaxReturn(0,"添加数据失败！",0);
			}		   		  		  		   
       } 		

	}	
	
	Public function ajaxedit(){  //修改查询
		$dao = M('User');
        $map1['id'] = array("EQ",(int)$_POST['id']);  
        $map1['company_id'] = $_SESSION['company_id'];   // 查询记录 限定在本公司id里面	
	    $rs=$dao->where($map1)->find();	 		
		if ( (is_null($rs))  ||  (!($rs)) )  {   //判断 如果查询结果是null 或者是 false 返回失败  否则传过去查询出来的数据 
		     $this->ajaxReturn(0,"读数据失败！请刷新重试",0);
		}
        else {
		     $this->ajaxReturn($rs,"读数据成功！",1);
		} 			
	}	
		
	Public function ajaxsave(){  //修改保存
		$dao = D('User');
        if (!$dao->create()){           
			$this->ajaxReturn(0,$dao->getError(),0);  // 创建失败 表示验证没有通过 输出错误提示信息	   	
        }
		else{
		    $map['id'] = array("EQ",(int)$_POST['id']);  
            $map['company_id'] = $_SESSION['company_id'];   //删除记录 限定在本公司id里面								
			$rs=$dao->where($map)->save(); 	// 根据条件保存修改的数据   
		    if (!($rs)) {
				$this->ajaxReturn(0,'数据没有变化不需要保存或者请刷新重试',0);  //保存失败
		    }
            else {
			  $this->ajaxReturn(1,"写数据成功！",1);   //保存数据成功
		    } 
	    }	
	}	
	
	Public function ajaxdel(){	 //删除
		$dao = M('User');
        $map['id'] = array("EQ",(int)$_POST['id']) ; 
        $map['company_id'] = $_SESSION['company_id'];   //删除记录 限定在本公司id里面	
	    $rs=$dao->where($map)->delete();
		if (!($rs)) {			   
		  $this->ajaxReturn(0,'请刷新重试',0);  //删除数据失败
    	}
        else {	
		   $this->ajaxReturn(1,"删除数据成功！",1);   //删除成功，在这里可以记录删除的日志，什么时间，删除了那个表的数据，是谁删除的等等
		} 	
    }
	

	Public function ajaxfindpass(){	//找回密码  用户管理的界面上
	    $mail=$_POST['mail'];		 
	    $map['mail'] = array("EQ",$mail);
        $map['company_id'] = $_SESSION['company_id'];   //限定在本公司id里面		
	    $dao = M('User');			
	    $rs=$dao->where($map)->find();	
	    if ( (is_null($rs))  ||  (!($rs)) )  {   //判断 如果查询结果是null 或者是 false 返回成功  		   
			 $this->ajaxReturn(0,"邮箱错误,没有找到该注册邮箱",0);	//	
	    }
	    else {
			 $result = send_mail( $mail , "一方代驾软件发送注册密码" , get_mail_body_findpass( $rs['company_id'], $rs['username'] ,$rs['password'] ) ); //发送注册邮件 
	    } 		  
		if( $result ) {
				$this->ajaxReturn(1,'找回密码邮件已经发送成功',1);				    
		 }else{			 
				$this->ajaxReturn(0,$result,0);
		 }	
		 
     }

	Public function ajaxchangepass(){	//修改密码
	    $password=$_POST['password'];	
	    $map['username'] = $_SESSION['username'];
        $map['company_id'] = $_SESSION['company_id'];   //删除记录 限定在本公司id里面	
     	$data['password'] = $password ;		
	    $dao = M('User');	
        $rs = $dao->where($map)->data($data)->save(); 	// 根据条件保存修改的数据  

		if (!($rs)) {
			$this->ajaxReturn(0,'数据没有变化不需要保存或者请刷新重试',0);  //保存失败
		}
		else {
		  $this->ajaxReturn(1,"写数据成功！",1);   //保存数据成功
		} 			 
     }
}
