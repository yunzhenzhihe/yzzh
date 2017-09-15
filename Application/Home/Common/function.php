<?php
/**
 * 
 * Common.php (项目公共函数库)
 *
 * @package      	YOURPHP
 * @author          liuxun QQ:147613338 <admin@yourphp.cn>
 * @copyright     	Copyright (c) 2008-2011  (http://www.yourphp.cn)
 * @license         http://www.yourphp.cn/license.txt
 * @version        	YourPHP企业网站管理系统 v2.1 2011-03-01 yourphp.cn $
 */
 
/**
 +----------------------------------------------------------
 * 把返回的数据集转换成Tree
 +----------------------------------------------------------
 * @access public
 +----------------------------------------------------------
 * @param array $list 要转换的数据集
 * @param string $pid parent标记字段
 * @param string $level level标记字段
 +----------------------------------------------------------
 * @return array
 +----------------------------------------------------------
 */

function list_to_tree($list, $pk='id',$pid = 'pid',$child = '_child',$root=0) {
    // 创建Tree
    $tree = array();
    if(is_array($list)) {
        // 创建基于主键的数组引用
        $refer = array();
        foreach ($list as $key => $data) {
            $refer[$data[$pk]] =& $list[$key];
        }
        foreach ($list as $key => $data) {
            // 判断是否存在parent
            $parentId = $data[$pid];
            if ($root == $parentId) {
                $tree[] =& $list[$key];
            }else{
                if (isset($refer[$parentId])) {
                    $parent =& $refer[$parentId];
                    $parent[$child][] =& $list[$key];
                }
            }
        }
    }
    return $tree;
}

function saveNumberOfRows() {   //页面上设置每页显示的行数 保存到cookie里面
     if(!empty($_GET['NumberOfRows'])) 	{
		    cookie('NumberOfRows',  $_GET['NumberOfRows'] ,0); //从页面传递过来的参数 每页面的行数，直接写到cookie里面	
	  } 
}

function isdate($str,$format="Y-m-d"){   //判断日期是不是合法的日期
	$strArr = explode("-",$str);
	if(empty($strArr)){
		return false;
	}
	foreach($strArr as $val){
		if(strlen($val)<2){
			$val="0".$val;
		}
		$newArr[]=$val;
	}
	$str =implode("-",$newArr);
    $unixTime=strtotime($str);
    $checkDate= date($format,$unixTime);
    if($checkDate==$str)
        return true;
    else
        return false;
}


function get_guid() {   //生成一个guid
    $charid = strtoupper(md5(uniqid(mt_rand(), true)));
    $hyphen = chr(45);// "-"
   /*$uuid = chr(123)// "{"
     $uuid =chr(123)
    .substr($charid, 0, 8).$hyphen
    .substr($charid, 8, 4).$hyphen
    .substr($charid,12, 4).$hyphen
    .substr($charid,16, 4).$hyphen
    .substr($charid,20,12)
    .chr(125);// "}"   */
	$uuid = substr($charid, 0, 8).$hyphen
	       .substr($charid, 8, 4).$hyphen
		   .substr($charid,12, 4).$hyphen
		   .substr($charid,16, 4).$hyphen
		   .substr($charid,20,12);
    return $uuid;
}


/**
	 +----------------------------------------------------------
 * 产生随机字串，可用来自动生成密码
 * 默认长度6位 字母和数字混合 支持中文
	 +----------------------------------------------------------
 * @param string $len 长度
 * @param string $type 字串类型
 * 0 字母 1 数字 其它 混合
 * @param string $addChars 额外字符
	 +----------------------------------------------------------
 * @return string
	 +----------------------------------------------------------
 */
function get_rand_string($len = 6, $type = '', $addChars = '') {
	$str = '';
	switch ($type) {
		case 0 :
			$chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz' . $addChars;
			break;
		case 1 :
			$chars = str_repeat ( '0123456789', 3 );
			break;
		case 2 :
			$chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ' . $addChars;
			break;
		case 3 :
			$chars = 'abcdefghijklmnopqrstuvwxyz' . $addChars;
			break;
		case 5 :
			$chars = str_repeat ( '12356789', 3 );
			break;			
		default :
			// 默认去掉了容易混淆的字符oOLl和数字01，要添加请使用addChars参数
			$chars = 'ABCDEFGHIJKMNPQRSTUVWXYZabcdefghijkmnpqrstuvwxyz23456789' . $addChars;
			break;
	}
	if ($len > 10) { //位数过长重复字符串一定次数
		$chars = $type == 1 ? str_repeat ( $chars, $len ) : str_repeat ( $chars, 5 );
	}
	if ($type != 4) {
		$chars = str_shuffle ( $chars );
		$str = substr ( $chars, 0, $len );
	} else {
		// 中文随机字
		for($i = 0; $i < $len; $i ++) {
			$str .= msubstr ( $chars, floor ( mt_rand ( 0, mb_strlen ( $chars, 'utf-8' ) - 1 ) ), 1 );
		}
	}
	return $str;
}

function get_visit_score($score) {
	$str = '';
	switch ($score) {
		case 1 :
			$str='很差';
			break;
		case 2 :
			$str='不满';
			break;
		case 3 :
			$str='一般';
			break;
		case 4 :
			$str='满意';
			break;
		case 5 :
			$str='赞一个';
			break;	
		case 8 :
			$str='乱收费';
			break;
		case 9 :
			$str='收费正常';
			break;					
		default :
			$str='';
			break;
	}
	return $str;
}

function checkAuthority($action) {   //判断有没有权限 供index_menu 使用
		if(( session('group_id') != '10') && ( strpos(session('group_allaction_rules'),$action) > -1 ) && ( !strpos(session('group_action_rules'),$action)  ) ){
			return false;
		} else {
            return true;
		}
}

function checkCardMoney($number,$field,$variables) {   //判断会员卡余额或者次数 够不够结账	 $field : money 金额	times 次数  是否被冻结
	   $map[$field] = array("EGT",$variables);  //   字段 EGT 大于等于 变量
	   $map['company_id'] = $_SESSION['company_id'];
	   $map['branch_id'] = $_SESSION['branch_id']; 
	   $map['state'] = '正常';
	   $map['number'] = array("EQ",$number);   // map  查询 number=$number  and  company_id=本公司  and  金额或者是次数大于等于$variables 的记录
       $dao = M('carddata');			
	   $rs=$dao->where($map)->find();
	   
	  //  Log::write('调试的SQL：'.$dao->getLastSql(), Log::SQL);  //把最后一句sql写到日志里面去
		
       if ( (is_null($rs))  ||  (!($rs)) )  {   //判断 如果查询结果是null 或者是 false 返回失败  没有找到符合条件的记录 
		     return false;
	   }
       else {
		     return true;
       }   
}

function checkVarUnique($ModuleName,$variables) {   //判断唯一性	
		if  (  ( empty($_POST[$variables]) ) )  {		//当 $_POST[$variables] 不能""、0、"0"、NULL、、FALSE、array()、var $var;  就错误返回	
			return false;
		}
	   $edit_record_id=(int)$_POST['id'];
       if ($edit_record_id<>null) {   //修改的按钮按下	   
	       $map1[$variables] = array("EQ",trim($_POST[$variables]));  
           $map1['company_id'] = $_SESSION['company_id'];
		   $map1['branch_id'] = $_SESSION['branch_id']; 
		   $map1['id'] = array("NEQ",$edit_record_id);
	   } else {    //添加的按钮按下	  
	       $map1[$variables] = array("EQ",trim($_POST[$variables]));  
           $map1['company_id'] = $_SESSION['company_id'];  
           $map1['branch_id'] = $_SESSION['branch_id']; 		   
	   } 
       $dao = M($ModuleName);			
	   $rs=$dao->where($map1)->find();	
       if ( (is_null($rs))  ||  (!($rs)) )  {   //判断 如果查询结果是null 或者是 false 返回成功  
		     return true;
	   }
       else {
		     return false;
       }   
}

function checkVarUniqueNoId($ModuleName,$variables) {   //判断唯一性 不用检验id 用于会员卡 是否存在的查询	
		if  (  ( empty($_POST[$variables]) ) )  {		//当 $_POST[$variables] 不能""、0、"0"、NULL、、FALSE、array()、var $var;  就错误返回	
			return false;
		}
	   $map1[$variables] = array("EQ",$_POST[$variables]);  
	   $map1['company_id'] = $_SESSION['company_id'];   
	   $map1['branch_id'] = $_SESSION['branch_id']; 
       $dao = M($ModuleName);			
	   $rs=$dao->where($map1)->find();	
       if ( (is_null($rs))  ||  (!($rs)) )  {   //判断 如果查询结果是null 或者是 false 返回成功  
		     return true;
	   }
       else {
		     return false;
       }   
}

//判断唯一性	不带company_id 属于全局的查询唯一性 用于注册邮箱的检查  或者 company_id的唯一性检测	
function checkVarUniqueNoCompany($ModuleName,$variablesName,$variables) {   
	   $map[$variablesName] = array("EQ",trim($variables)); 
	   $dao = M($ModuleName);			
	   $rs=$dao->where($map)->find();	

	   if ( (is_null($rs))  ||  (!($rs)) )  {   //判断 如果查询结果是null 或者是 false 返回成功  
			 return true;
	   }
	   else {
			 return false;
	   }  
}

//判断唯一性	不带company_id 属于全局的查询唯一性 用于注册邮箱的检查  检验id
function checkVarUniqueNoCompanyHaveId($ModuleName,$variables) {   //判断唯一性	
		if  (  ( empty($_POST[$variables]) ) )  {		//当 $_POST[$variables] 不能""、0、"0"、NULL、、FALSE、array()、var $var;  就错误返回	
			return false;
		}
	   $edit_record_id=(int)$_POST['id'];
       if ($edit_record_id<>null) {   //修改的按钮按下	   
	       $map1[$variables] = array("EQ",trim($_POST[$variables]));  
		   $map1['id'] = array("NEQ",$edit_record_id);
	   } else {    //添加的按钮按下	  
	       $map1[$variables] = array("EQ",trim($_POST[$variables]));  
	   } 
       $dao = M($ModuleName);			
	   $rs=$dao->where($map1)->find();	
	//   Log::write('调试的SQL：'.$dao->getLastSql(), Log::SQL);  //把最后一句sql写到日志里面去
       if ( (is_null($rs))  ||  (!($rs)) )  {   //判断 如果查询结果是null 或者是 false 返回成功  
		     return true;
	   }
       else {
		     return false;
       }   
}

//按条件查询 满足条件的记录有没有  有返回true 如果没有返回false
function checkRecord($ModuleName,$map) {   
       $dao = M($ModuleName);	
	   $map['company_id'] = $_SESSION['company_id'];   
	   $map['branch_id'] = $_SESSION['branch_id']; 
	   $rs=$dao->where($map)->find();	
       if ( (is_null($rs))  ||  (!($rs)) )  {   //判断 如果查询结果是null 或者是 false 返回成功  
		     return false;
	   }
       else {
		     return true;
       }   
}


//判断ip地址 n分钟内不能注册,或者不能做其他的动作  $variables 变量值 $variablesName 变量名 $variablesTime 用哪个变量来计算 $DelayTime 秒 计算距离现在时间多少秒没有登陆过
function checkVarUniqueIp($ModuleName,$variablesName,$variables,$variablesTime,$delayTime) {  
	   $map[$variablesName] = array("EQ",$variables);  
	   $map[$variablesTime] = array("between",array((time()-$delayTime),time()));
	   $dao = M($ModuleName);			
	   $rs=$dao->where($map)->find();
	   if ( (is_null($rs))  ||  (!($rs)) )  {   //判断 如果查询结果是null 或者是 false 返回成功  
			 return true;
	   }
	   else {
			 return false;
	   }  
}

function checkStringLength($variables, $min, $max){   //判断字符串的长度是否在一个范围内
       if ( ( strlen( $_POST[$variables] ) <= $max ) && ( $min <= strlen( $_POST[$variables] ) ) ) {
	        return true;   
	   } else {
	        return false;
	   }
}
   
function getUploadFileName(){   //生成上传的随机文件名  company_id+随机数
	   return $_SESSION['company_id'].'_'.uniqid();   
}  

function get_real_ip(){  //获得真实的ip地址
		$ip=false;
		if(!empty($_SERVER["HTTP_CLIENT_IP"])){
			$ip = $_SERVER["HTTP_CLIENT_IP"];
		}
		if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			$ips = explode (", ", $_SERVER['HTTP_X_FORWARDED_FOR']);
			if ($ip) { array_unshift($ips, $ip); $ip = FALSE; }
			for ($i = 0; $i < count($ips); $i++) {
				if (!eregi ("^(10|172\.16|192\.168)\.", $ips[$i])) {
					$ip = $ips[$i];
					break;
				}
			}
		}
		return ($ip ? $ip : $_SERVER['REMOTE_ADDR']);
} 

function send_mail( $sendto_email, $subject, $body  ){   //邮件的发送  自动做两次发送 如果都不成功就返回最后的那个失败的 ErrorInfo

   define('IS_CLOUD',false);
   
   if ( IS_CLOUD  ) {   //如果云空间 就走云发送短信的步骤  
//  if ( '1'=='1'  ) {   //如果云空间 就走云发送短信的步骤  
 
 /*    require_once ( "Bcms.class.php" ) ;   //百度云空间使用  Bcms::FROM   百度信息通道的发送,不稳定 2013.8.3 取消 走 sendcloud 
	$bcms = new Bcms () ;
	  $ret = $bcms->mail('d0157f096592a470115d383660533a45', $body , array($sendto_email) , array(Bcms::FROM=>'service@ytsoft.cn',Bcms::MAIL_SUBJECT=>$subject)); //正式的信息通道
   // $ret = $bcms->mail('5fdfd781500aaf74228468c8e658f4cb', $body , array($sendto_email) , array(Bcms::FROM=>'service@ytsoft.cn',Bcms::MAIL_SUBJECT=>$subject));  //测试的信息通道  

        if ( false === $ret )  
        {		
		  return '发邮件错误: '.$bcms->errmsg () ;
        }
        else
        {
          return true;   	
        }   
	*/	
     //开始sendcloud通道	 
 			$url = 'https://sendcloud.sohu.com/webapi/mail.send.json';
			//不同于登录SendCloud站点的帐号，您需要登录后台创建发信子帐号，使用子帐号和密码才可以进行邮件的发送。
			$param = array('api_user' => 'postmaster@yfdj365.sendcloud.org',
					'api_key' => 'fpje3XcM',
					'from' => 'service@ytsoft.cn',
					'fromname' => '云天售后软件客服邮箱',
					'to' => $sendto_email,
					'subject' => $subject,
					'html' => $body.'测试SendCloud');

			$options = array('http' => array('method'  => 'POST','content' => http_build_query($param)));
			$context  = stream_context_create($options);
			$result = file_get_contents($url, false, $context);
			
			//return '发邮件错误: '.$result ;
						
			if  ('success'==(json_decode($result)->{'message'}) )   
				{						  
				  return true;   
				}
				else
				{
				  return '发邮件错误: '.json_decode($result)->{'message'} ;   	
				} 	 	 
	 //结束sendcloud通道
	 
	} else  {   //如果不是云平台,就走正常的phpmail发送短信
		 $result1= smtp_send_mail( $sendto_email, $subject, $body , 0 ) ;
		 if( $result1 ) {
			  return true;   				    
		 }else{
			 $result2= smtp_send_mail( $sendto_email, $subject, $body , 1 ) ;
			 if( $result2 ) {
				  return true;   				    
			 }else{
				 return '第一次错误:'.$result1.' 第二次错误:'.$result2 ;
			 }	 
		 } 	
   } 	 
}
 
//   $host : 主机	 比如：smtp.163.com;mail.tsingfeng.com ; smtp.qq.com
//   $username :  用户名，比如发件地址是 123@139.com 那 用户名就是 123 不用后面的后缀域名
//   $password :  密码 
//   $from :  邮件头的From字段 
//   $fromName :  发件人名字
//   $sendto_email : 收件人地址
//   $subject :  邮件标题
//   $body :  邮件正文
//   $type :  发送邮件的主机类型 0: 139  1: QQ  2: 126   定义两组邮箱 一个是给公司的客户使用的客服邮箱 一个是给司机移动客户端使用的邮箱 在下面定义
function smtp_send_mail( $sendto_email, $subject, $body , $type ){  
		 switch ($type) {
			case 0 :
				 $host = "smtp.ytsoft.cn" ;      //主机	 比如：smtp.163.com;mail.tsingfeng.com
			//	 $username = "service@ytsoft.cn" ;  //用户名，比如发件地址是 123@139.com 那 用户名就是 123 不用后面的后缀域名
			//	 $password ="@ytdz1401@" ;  //  密码 
			//	 $from = "service@ytsoft.cn"  ;  //邮件头的From字段		
				 $username = "yt800@ytsoft.cn" ;  //用户名，比如发件地址是 123@139.com 那 用户名就是 123 不用后面的后缀域名
				 $password ="#yt2015#" ;  //  密码 
				 $from = "yt800@ytsoft.cn"  ;  //邮件头的From字段					
			
				break;			 
			case 1 :
				 $host = "smtp.139.com" ;      //主机	 比如：smtp.163.com;mail.tsingfeng.com
				 $username = "13581805793" ;  //用户名，比如发件地址是 123@139.com 那 用户名就是 123 不用后面的后缀域名
				 $password ="@13581805793@" ;  //  密码 
				 $from = "13581805793@139.com"  ;  //邮件头的From字段
				 break;
			case 2 :
				 $host = "smtp.qq.com" ;      //主机	 比如：smtp.163.com;mail.tsingfeng.com  QQ邮箱 暂时不行 
				 $username = "2289335991@qq.com" ;  //用户名，比如发件地址是 123@139.com 那 用户名就是 123 不用后面的后缀域名
				 $password ="codcnynuessbecci" ;  //  密码   qq 邮箱独立授权码 smtp开通的话
				 $from = "2289335991@qq.com"  ;  //邮件头的From字段				
				break;
			case 3 :
				break;
			case 5 :
				break;			
		} 
		$fromName = "云天售后客服" ;  // 发件人名字						
		vendor("phpMailer.class#phpmailer");  	   						
		$mail = new PHPMailer();
		$mail->CharSet = "utf-8"; // 设置编码
		$mail->IsSMTP();                                      // 使用 SMTP
		$mail->Host = $host;  // 比如：smtp.163.com;mail.tsingfeng.com
		$mail->SMTPAuth = true;     // 设置为“需要验证”
		$mail->Username = $username;  // 用户名，比如发件地址是 123@139.com 那 用户名就是 123 不用后面的后缀域名
		$mail->Password = $password; // 密码
		$mail->From = $from;   //设置邮件头的From字段。
		$mail->FromName = $fromName;           // 设置发件人名字
		$mail->AddAddress( $sendto_email );    // 收件人地址，可以多次使用来添加多个收件人
		//$mail->AddCC('zzzz@qq.com');       // 抄送
		//$mail->AddBCC('zzzz@qq.com');       // 密送			
		$mail->AddReplyTo( $from, $fromName ); //回复人
		$mail->WordWrap = 50;                                 //50字换行
		//$mail->AddAttachment("/tmp/image.jpg", "new.jpg");    // 附件
		$mail->IsHTML(true);                                  // set email format to HTML
		$mail->Subject = $subject;
		$mail->Body    = $body;
		$mail->AltBody = "";
		if (!$mail->Send()) {
			 return  $mail->ErrorInfo  ;	
		}else{
			 return true;   
		}   	
}
	
function get_mail_body_register( $company_id, $username, $password  ,$name , $phone, $company_name, $company_address ){  //注册邮件的正文部分
	 $bodytext="<!--HTML-->您好，尊敬的用户,感谢注册<p>";
	 $bodytext.="您注册的机构ID：<font size=\"4\" color=red>" . $company_id . "</font> <p>";
	 $bodytext.="        用户名：<font size=\"4\" color=red>" . $username . "</font> <p>";
	 $bodytext.="        密码：<font size=\"4\" color=red>" . $password . "</font> <p><p>";
	 $bodytext.="注册资料： <p>";
	 $bodytext.="联系人姓名：<font size=\"4\" >" . $name . "</font> <p>";
	 $bodytext.="联系人电话：<font size=\"4\" >" . $phone . "</font> <p>";
	 $bodytext.="公司名称：<font size=\"4\" >" . $company_name . "</font> <p>";
	 $bodytext.="公司地址：<font size=\"4\" >" . $company_address . "</font> <p>";
	 $bodytext.="注册时间：<font size=\"4\" color=red>" . date('Y-m-d H:i:s') . "</font> <p>";
	 $bodytext.="欢迎来到云天售后服务软件：<a href=http://www.ytsoft.cn/yt800/ target=_blank>http://www.ytsoft.cn/yt800/</a> <p><p>";
	 $bodytext.=" 注：此邮件为系统自动发送，请勿回复。 <p>";
	 return $bodytext ;
}

function get_mail_body_findpass(  $url,$company_id,$username ){  //找回密码和注册新用户发送邮件的正文部分
	 $bodytext="<!--HTML-->您好，尊敬的用户<p>";
	 $bodytext.="        机构ID：<font size=\"4\" color=red>" . $company_id . "</font> <p>";
	 $bodytext.="        用户名：<font size=\"4\" color=red>" . $username . "</font> <p>";	 
	 $bodytext.="        请在1个小时内点击下面的网址完成修改密码的操作：<font size=\"4\" color=red>" . $url . "</font> <p>";
	 $bodytext.="        发送邮件时间：<font size=\"4\" color=red>" . date('Y-m-d H:i:s') . "</font> <p>";
	 $bodytext.="欢迎来到云天售后服务软件：<a href=http://www.ytsoft.cn/yt800/ target=_blank>http://www.ytsoft.cn/yt800/</a> <p><p>";
	 $bodytext.=" 注：此邮件为系统自动发送，请勿回复。 <p>";
	 return $bodytext ;
}

function get_mail_body_changepassword( $company_id, $username, $password ){  //完成修改密码以后给客户发送的确认邮件
	 $bodytext="<!--HTML-->您好，尊敬的用户<p>";
	 $bodytext.="        机构ID：<font size=\"4\" color=red>" . $company_id . "</font> <p>";
	 $bodytext.="        用户名：<font size=\"4\" color=red>" . $username . "</font> <p>";
	 $bodytext.="        密码：<font size=\"4\" color=red>" . $password . "</font> <p>";
	 $bodytext.="修改密码时间：<font size=\"4\" color=red>" . date('Y-m-d H:i:s') . "</font> <p>";	 
	 $bodytext.="欢迎来到云天售后服务软件：<a href=http://www.ytsoft.cn/yt800/ target=_blank>http://www.ytsoft.cn/yt800/</a> <p><p>";
	 $bodytext.=" 注：此邮件为系统自动发送，请勿回复。 <p>";
	 return $bodytext ;
}


function get_mail_body_finddriverpass( $username, $password ){  //找回司机密码邮件的正文部分  注：此邮件为系统自动发送，请勿回复。


	 $bodytext="<!--HTML-->您好，尊敬的用户<p>";
	 $bodytext.="        用户名是：<font size=\"4\" color=red>" . $username . "</font> <p>";
	 $bodytext.="        密码是：<font size=\"4\" color=red>" . $password . "</font> <p>";
	 $bodytext.="欢迎来到云天售后服务软件：<a href=http://www.ytsoft.cn/yt800/ target=_blank>http://www.ytsoft.cn/yt800/</a> <p><p>";
	 $bodytext.=" 注：此邮件为系统自动发送，请勿回复。 <p>";
	 return $bodytext ;
}

function get_json_id( $json ) {   //json字符串里面 抽取id  用于批量确认 打印  流转状态
		$find1="'";
		$find2="“";
        $replace='"' ;
		$json = str_replace($find1, $replace, $json);  //替换json字符串里面 可能出现的不合法的 字符 
		$json = str_replace($find2, $replace, $json);

 	    $json_array=json_decode($json,true); //传过来的 需要修改订单的 id  json
		$id='';
		foreach ($json_array as $key){  //开始解析需要处理订单的id号
           if ( $id=='' ) {
			   $id ='( id= '.(int)$key['id'].' )'   ;  
		   } else {			   
			   $id =$id.' or ( id= '.(int)$key['id'].' )'   ;   
		   } 		   
		}
    return $id;
}

function get_array_numberofrows() {   //选择每页显示多少行  select 下拉框的内容 
  //return array('2','3','5','10','15','20','30','50','100');
 return array('5','10','15','20','30','50');
}

function get_stock_confirm($YT_type){	//库存出库 审核确认
	switch ($YT_type) {  //按传进来的参数 来初始化一些参数 
		case 1 :   //入库订单审核确认 入库
			$YT_table_record = 'stockin'; //记录待审核的订单的表名
			$YT_order_status_before='待处理'; //处理前订单的状态
			$YT_order_status_after='已审核'; //处理后订单的状态
			$YT_tablerecord_flag=1; //标记 1：入库 2：退货入库 3：损耗  4：领料 5：退料 6：销售出库
			$YT_stockdetails_flag=1; //标记 1：入库 2：退货入库 3：损耗  4：领料 5：退料
			$YT_inout_flag = 2;	//  库存出入库明细 标记  1：出库 2：入库',
			$YT_inout_content = '商品入库订单审核确认入库';	//内容
			break;
		case 2 :
			$str='不满';
			break;
		case 3 :  //损毁订单审核确认 出库
			$YT_table_record = 'stockin'; //记录待审核的订单的表名
			$YT_order_status_before='待处理'; //处理前订单的状态
			$YT_order_status_after='已审核'; //处理后订单的状态
			$YT_tablerecord_flag=3; //标记 1：入库 2：退货入库 3：损耗  4：领料 5：退料
			$YT_stockdetails_flag=3; //标记 1：入库 2：退货入库 3：损耗  4：领料 5：退料 6：销售出库
			$YT_inout_flag = 1;	//  库存出入库明细 标记  1：出库 2：入库',
			$YT_inout_content = '毁损订单审核确认出库';	//内容
		//	return 'gfgdg';
			break;
		case 4 :    //售后人员领料 审核 出库
			$YT_table_record = 'stockservicestaff'; //记录待审核的订单的表名
			$YT_order_status_before='待处理'; //处理前订单的状态
			$YT_order_status_after='已审核'; //处理后订单的状态
			$YT_tablerecord_flag=4 ;  //标记 1：入库 2：退货入库 3：损耗  4：领料 5：退料 6：销售出库
			$YT_stockdetails_flag=4 ; //标记 1：入库 2：退货入库 3：损耗 4：领料 5：退料 6：销售出库
			$YT_inout_flag = 1;	//  库存出入库明细 标记  1：出库 2：入库',
			$YT_inout_content = '售后人员领料审核确认出库';	//库存出入库明细 备注内容
			break;
		case 5 :  //售后人员退料订单 审核  入库
			$YT_table_record = 'stockservicestaff'; //记录待审核的订单的表名
			$YT_order_status_before='待处理'; //处理前订单的状态
			$YT_order_status_after='已审核'; //处理后订单的状态
			$YT_tablerecord_flag=5 ;  //标记 1：入库 2：退货入库 3：损耗  4：领料 5：退料 6：销售出库
			$YT_stockdetails_flag=5 ; //标记 1：入库 2：退货入库 3：损耗 4：领料 5：退料 6：销售出库
			$YT_inout_flag = 2;	//  库存出入库明细 标记  1：出库 2：入库',
			$YT_inout_content = '售后人员退料审核确认入库';	//库存出入库明细 备注内容
			break;
		case 8 :
			$str='乱收费';
			break;
		case 9 :
			$str='收费正常';
			break;					
		default :
			$str='';
			break;
	}

	
	
	$confirm_flag=true;
	$confirm_error='';  //错误提示字符串  比如 某个订单的库存数量不够 不能做出库处理 
	$i=0;   //操作数据记录条数的计数器	
	$json=$_GET['json'];
	
	$find1="'";
	$find2="“";
	$replace='"' ;
	$json = str_replace($find1, $replace, $json);  //替换json字符串里面 可能出现的不合法的 字符 
	$json = str_replace($find2, $replace, $json);

	$json_array=json_decode($json,true); //传过来的 需要修改订单的 id  json
	$id='';
	foreach ($json_array as $key){  //开始解析需要处理订单的id号					 		
					 $id ='( id= '.(int)$key['id'].' )'   ;  
					 if ( isset($dao) ) {
						unset($dao,$map,$dao1,$map1,$data1,$dao2,$map2,$data2,$dao3,$map3,$data3,$dao4,$map4,$data4) ;  //循环开始时  变量初始化 
					 } 

			 /* 开始写库存 
			  1.根据传过来的订单id 先查询订单
			  2.查询到订单以后 得到订单的guid  查询 本订单的商品列表
			  3.按照这个列表 循环 建立动态的变量 
			  */
					$map['company_id'] = $_SESSION['company_id'];   // 1.根据传过来的订单id 先查询订单
					$map['branch_id'] = $_SESSION['branch_id'];   // 1.根据传过来的订单id 先查询订单
					$map['order_status'] =  array("EQ",$YT_order_status_before);   //$YT_order_status_before  订单处理以前的状态
					$map['_string'] = ' ( '.$id.' ) '; 
					$map['flag']  = $YT_tablerecord_flag; 
					$dao = M($YT_table_record); 
					$rs=$dao
						 ->field(array('guid as order_guid','order_status','order_number'  ))	
						 ->where($map)
						 ->find();	
					if (!($rs)) {
						$confirm_flag=flase;  //确认订单有错误
						$confirm_error=$confirm_error.'\\n 审核失败abc ';
						continue; //放弃本次操作 进行下一个循环
					}

					$map1['company_id'] = $_SESSION['company_id'];   // 2.查询到订单以后 得到订单的guid  查询 本订单的商品列表
					$map1['branch_id'] = $_SESSION['branch_id'];   // 1.根据传过来的订单id 先查询订单
					$map1['order_guid'] = $rs['order_guid']; 
					$map1['flag']  = $YT_stockdetails_flag; //标记 1：入库 2：退货入库 3：损耗 4：领料 5：退料
					$dao1 = M("Stockdetails");
					$rs1=$dao1
					//	->field(array('goods_quantity','goods_name_id','goods_name','goods_type_id','goods_type'))		
					
						->where($map1)
						->select();	

					if (!($rs1)) {
						$confirm_flag=flase;  //确认订单有错误
						$confirm_error=$confirm_error.'\\n 订单号：'.$rs['order_number'].'审核失败123，';  //错误提示字符串  比如 某个订单的库存数量不够 不能做出库处理 							
						continue; //放弃本次操作 进行下一个循环
					}
					
					M()->startTrans();//开启事务
					
					$j=100;  //3.按照这个列表 循环 建立动态的变量 
					foreach ($rs1 as $key){  //开始遍历这个订单的商品的数量 准备减库存 
						$dao_var = 'dao'.$j;   //定义动态变量
						$rs_var  = 'rs'.$j;      //定义动态变量
						$dao_inout = 'daoinout'.$j;   //写出库数据表
						$rs_inout  = 'rsinout'.$j;	//定义动态变量

						$goods_name  = 'goods_name'.$j;  // 记录出库错误的商品名称
													
						$$goods_name=$key['goods_name'];  //记录上商品的名称 用于当写数据失败的时候 返回去是哪个商品库存不足或者有问题了							
						$$dao_var = M(); // 实例化一个model对象 没有对应任何数据表
						if ( ( $YT_type == 4 ) OR ( $YT_type == 3 ) ) {
							$sql="UPDATE ".C('DB_PREFIX')."goods SET quantity_stock=(quantity_stock-".$key['goods_quantity']."),quantity_out=(quantity_out+".$key['goods_quantity'].")";
							$sql=$sql." WHERE ( company_id=".$_SESSION['company_id']." ) AND ( branch_id=".$_SESSION['branch_id']." ) AND ( guid='".$key['goods_name_id']."' )  AND ( property='普通商品' ) AND ( quantity_stock>=".$key['goods_quantity']." ) " ;
						}
						if ( ( $YT_type == 1 ) OR ( $YT_type == 5 )  ) {
							$sql="UPDATE ".C('DB_PREFIX')."goods SET quantity_stock=(quantity_stock+".$key['goods_quantity']."),quantity_in=(quantity_in+".$key['goods_quantity'].")";
							$sql=$sql." WHERE ( company_id=".$_SESSION['company_id']." ) AND ( branch_id=".$_SESSION['branch_id']." ) AND ( guid='".$key['goods_name_id']."' ) AND ( property='普通商品' )  " ;
						}						
						$$rs_var=$$dao_var
							   ->execute($sql);	

						//开始保存出库数据表	   
						$$dao_inout = M('Goodsinout');	
						if ( isset($data_inout) ) {
						   unset($data_inout) ;  //循环开始时  变量初始化 
						} 
						$data_inout['guid'] = get_guid();   //本条记录的guid 
						$data_inout['order_guid'] = $rs['order_guid'];  //订单的guid   					
						$data_inout['order_number'] = $rs['order_number'];  //订单号
						$data_inout['time_inout'] = date('Y-m-d H:i:s');   //操作时间
						$data_inout['goods_type_id'] = $key['goods_type_id'];  //商品分类id
						$data_inout['goods_type'] = $key['goods_type'];	//商品分类								
						$data_inout['goods_name_id'] = $key['goods_name_id'];  //商品id
						$data_inout['goods_name'] = $key['goods_name'];	//商品名称								
						$data_inout['goods_quantity'] = $key['goods_quantity'];  //数量
						$data_inout['flag'] = $YT_inout_flag;	//  标记  1：出库 2：入库',
						$data_inout['flag_inout'] = $YT_tablerecord_flag ; // 出入库类型 标记 1：入库 2：退货入库 3：损耗 4：领料 5：退料 6：销售出库
						$data_inout['content'] = $YT_inout_content ;	//内容
						$data_inout['branch_id'] = $_SESSION['branch_id'];
						$data_inout['company_id'] = $_SESSION['company_id'];
						$data_inout['creat_time'] = date('Y-m-d H:i:s');
						$data_inout['creat_name'] = $_SESSION['username'];	
						$$rs_inout = $$dao_inout->add($data_inout); // 保存出库记录						
						//结束保存出库数据表   
						$j=$j+1;
					}
					if  ( $j==100 ) {  
						$confirm_flag=flase;  //确认订单有错误
						$confirm_error=$confirm_error.'\\n 订单号：'.$rs['order_number'].'审核失败456，';				
						continue; //放弃本次操作 进行下一个循环
					}
					
			/* 检测动态循环见库存 是否正常，如果不正常 就记录是哪个商品部正常 并且吧标志位=false*/		
					$flag=true;
					$error_str='';
					for ( $j1=100;$j1<$j;$j1++) {
						$rs_var  = 'rs'.$j1; //定义动态变量
						$rs_inout  = 'rsinout'.$j1;	//定义动态变量							
						$goods_name  = 'goods_name'.$j1; 
						if (  !( $$rs_var && $$rs_inout ) ) { //写数据失败  记录失败的商品名称 
							 $flag=false ;   //写失败标志位 =false 
							 $error_str=$error_str.' '.$$goods_name;
						} 
					}

			/* 订单的商品 写上出库的时间*/		
					$dao3 = M('Stockdetails');
					$map3['company_id'] = $_SESSION['company_id'];   //限定在本公司id里面	
					$map3['branch_id'] = $_SESSION['branch_id'];   // 
					$map3['order_guid'] = $rs['order_guid'];    	
					$data3['time_in'] = date('Y-m-d H:i:s');	
					$rs3=$dao3->where($map3)->save($data3); 	// 根据条件保存修改的数据 
					
			/* 开始写订单的状态 做审核确认*/		
					$dao2 = M($YT_table_record);
					$map2['company_id'] = $_SESSION['company_id'];   //删除记录 限定在本公司id里面	
					$map2['branch_id'] = $_SESSION['branch_id'];   // 1.根据传过来的订单id 先查询订单
					$map2['order_status']  = $YT_order_status_before;	// 查询记录 限定订单的状态是 待处理  才可以做确认和出库	   $YT_order_status_before  订单处理以前的状态
					$map2['_string'] = ' ( '.$id.' ) '; 
					$map2['flag']  = $YT_tablerecord_flag ; //标记 标记 					
					$data2['order_status'] = $YT_order_status_after;  //订单处理完以后的状态	
					$data2['confirm_time'] = date('Y-m-d H:i:s');	
					$data2['confirm_name'] = $_SESSION['username'];	;	
					$rs2=$dao2->where($map2)->save($data2); 	// 根据条件保存修改的数据   						
					
			  /* 如果成功 就确认   否则 就回滚*/		
					if($rs2 && $rs3  && $flag ){  //
						M()->commit();//事务提交
						$i=$i+1; //操作数据记录条数的计数器	
					}else{
						M()->rollback();//不成功，回滚
						$confirm_flag=false;  //确认订单有错误
						$confirm_error=$confirm_error.'\\n 订单号：'.$rs['order_number'].'，商品：'.$error_str.'出库错误，可能是数量不足造成' ;  //错误提示字符串  比如 某个订单的库存数量不够 不能做出库处理 
					}			
	}

	if( ($confirm_flag) && ($i>0) ){  //$i 计数器 每审核一条记录 不论是否成功 都会加1 如果等于零 表示没有审核一条 按失败处理
	   return '' ;   //成功		
	}else{
	   return  $confirm_error ;   //失败 返回错误代码
	} 
}	

function get_reportprogramcodes($flag) {  //获取打印报表的程序代码
	$dao = M('reportprogramcodes');
	$map['flag'] = $flag;  		
	$map['company_id'] = $_SESSION['company_id'];   // 查询记录 限定在本公司id里面	
	$map['branch_id'] = $_SESSION['branch_id'];
	$rs=$dao
		 ->field(array('report_programcodes'))
		  ->where($map)->find();	

	if ( (is_null($rs))  ||  (!($rs)) )  {   //判断 如果查询结果是null 或者是 false 返回失败  否则传过去查询出来的数据 
		$dao1 = M('reportglobalprogramcodes');   //全局的参数
		$map1['flag'] = $flag;  	
		$rs1=$dao1
		 ->field(array('report_programcodes'))
		  ->where($map1)->find();	 
		if ( (is_null($rs1))  ||  (!($rs1)) )  {   //判断 如果查询结果是null 或者是 false 返回失败  否则传过去查询出来的数据 
				$str = 'flase' ;
		} else {
			    $str = $rs1['report_programcodes'] ; 
		}	  
	} else {
		        $str = $rs['report_programcodes']; 
	}	
	return $str;
}

function get_reportsetup() {  //获取打印报表参数 打印份数  纵向打印 或者横向打印
	$dao = M('reportsetup');
	$map['company_id'] = $_SESSION['company_id'];   // 查询记录 限定在本公司id里面	
	$map['branch_id'] = $_SESSION['branch_id'];
	$rs=$dao
		 ->where($map)->find();	

	if ( (is_null($rs))  ||  (!($rs)) )  {   //判断 如果查询结果是null 或者是 false 返回失败  否则传过去查询出来的数据 
		$str = 'flase' ;	  
	} else {
	    $str = $rs; 
	}	
	return $str;
}

function get_autolink($str, $attributes = array()) {  //实现把文本中的URL转换为链接  web下使用
    $attrs = '';
    foreach ($attributes as $attribute=>$value) {
        $attrs .= " {$attribute}=\"{$value}\"";
    }
    
    $str = ' '.$str;
    $str = preg_replace('`([^"=\'>])((http|https|ftp|ftps)://[^\s< ]+[^\s<\.)])`i', '$1<a href="$2" rel="external nofollow" '.$attrs.'>$2</a>', $str);
    $str = substr($str, 1);
    
    return $str;
}  

function get_mobile_autolink($str) {  //实现把文本中的URL转换为链接   手机下使用
    $str = ' '.$str;
    $str = preg_replace('`([^"=\'>])((http|https|ftp|ftps)://[^\s< ]+[^\s<\.)])`i', '$1<a href= JavaScript:window.open("YT_urlto:$2") ;>$2</a>', $str);
    $str = substr($str, 1);
    
    return $str;
}  // JavaScript:window.open('YT_urlto:http://www.ytsoft.cn/yt800/') ;


//本地上传文件的IO操作 从3.1.3里面拷贝过来的
function file_upload($src_file,$dest_file){
	$pdir=dirname($dest_file);
	if(!is_dir($pdir)) @mkdir($pdir,0777);
	return copy($src_file,$dest_file);
}

function file_delete($filename){
	return unlink($filename);
}



?>