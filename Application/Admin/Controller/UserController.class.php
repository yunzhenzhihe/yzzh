<?php
// 登陆页面
namespace Admin\Controller;
use Think\Controller;

class UserController extends Controller{

    function _initialize() {		
        $_SESSION['soft_footer'] = '2017 &copy; 云镇智合定制平台&nbsp;&nbsp;核心版本号：v0.0.3';   //软件尾部 软件的名称和版本号
     }	
	
 //  Public function verify(){  //校验码  3。1.3 的验证码
//			import('ORG.Util.Image');
//		    Image::buildImageVerify();
  //  }	
	
    public function verify()
    {
		ob_clean();
	//	\Think\Log::record('测试日志信息:'.date('Y-m-d H:i:s'));
		$config =    array(
		    'expire' => 1800, // 验证码过期时间（s）
			'fontSize'    =>    35,    // 验证码字体大小
			'length'      =>    4,     // 验证码位数
			'useNoise'    =>    false, // 关闭验证码杂点
			'useCurve'    =>    false, // 关闭验证码混淆曲线 	
            'reset' => false, // 验证成功后是否重置			
		);
		$Verify = new \Think\Verify($config);
		$Verify->codeSet = '0123456789'; 
	//	$Verify->fontttf = '5.ttf'; 
		$Verify->fontttf = '4.ttf'; 
		$Verify->entry();
    }

 //   protected function check_verify($code, $id = '')
  //  {
  //      $verify = new \Think\Verify();
 //       return $verify->check($code, $id);
 //   }	
 
     protected function check_verify($code)
    {
        $verify = new \Think\Verify();
        return $verify->check($code);
    }	
 
	
	
    public function login(){  //登陆

	         $this->assign( "login_flag", $_GET['login_flag'] ); //当pcclent 登录的时候 会传进来这个参数 网页登陆则没有这个参数 这个参数决定了登录成功以后 返回的参数
             $_SESSION['YT_ROOT'] =__ROOT__  ; //root 跟路径 用于 Minify 来做css和js压缩
			 $this->display();
    }
	
    public function logout(){  //退出登录
	    $_SESSION['company_id']=null ;
		redirect(U('User/login') )	;  
    }	
	
    public function forget(){		//忘了密码\修改密码？  
			 $this->display();
    }	
		
    public function register(){		//注册新公司	   
			 $this->display();
    }	

    public function userinfo(){		//补全资料   
			 $this->display();
    }		

    public function changepassword(){		 //修改密码	  
        if( empty($_GET['guid']) ){
				$this->error('操作错误');
				return;
			} 	
			
        $dao = M("forgetpassword");
		$map['guid'] =$_GET['guid'];   
				
		$map['_string'] =" ( TIMESTAMPDIFF(minute,count_date,CURRENT_TIMESTAMP) < 60 )"; //60分钟之内有效
      //  $map['_string'] =" ( TIMESTAMPDIFF(SECOND,count_date,CURRENT_TIMESTAMP) < 500 )"; 
		$rs=$dao		
			->where($map)
			->find();	
		if ( (is_null($rs))  ||  (!($rs))  )  {   //判断 超过了10秒 或者   重新计算				
		    $this->error('此链接已经失效或者不存在');
			return;
		}
	    $this->assign("guid", $_GET['guid']);	
	    $this->display();
    }	
	
	Public function dologin(){   //登陆

	        $cookietime = 180*24*60*60;   //180天 cook有效期
	
		//	$username = trim($_POST['username']);
		//	$password = trim($_POST['password']);
		//	$company_id = trim($_POST['companyid']);
		//	$authcode = trim($_POST['authcode']);			
		//	$remember = trim($_POST['remember']);
		//	$login_flag = trim($_POST['login_flag']);
			
			$username = trim(I('username'));
			$password = trim(I('password'));
			$company_id = (int)trim(I('companyid'));
			$authcode = trim(I('authcode'));			
			$remember = trim(I('remember'));
			$login_flag = trim(I('login_flag'));			
			

		/*	//  调试用  直接登录 	
			$username = 'admin';  
			$password = '1000';
			$company_id = '62722';	
		//  结束 	调试用  直接登录 		  */


			if(empty($username) || empty($password)|| empty($company_id)){
				$this->ajaxReturn(0,"用户名或密码或公司ID 不能为空",0);
			}
	/*	//下面的代码是3.1.3	
			if ( (md5($authcode) != $_SESSION['verify']) && ( $authcode !='YTmobile_dologin' )){  //YTmobile_dologin  来自手机登录 不需要验证码
				//$this->ajaxReturn(0,"验证码错误,verify:".$_SESSION['verify']."  authcode:".$authcode."  authcode:".md5($authcode),0);	//	开发阶段先把这个关闭 
				$this->ajaxReturn(0,"验证码错误",0);	//	开发阶段先把这个关闭 	
			}
	*/
			if ( ( !$this->check_verify($authcode)) && ( $authcode !='YTmobile_dologin' )){  //YTmobile_dologin  来自手机登录 不需要验证码
				$this->ajaxReturn(0,"验证码错误",0);	//	开发阶段先把这个关闭 
			}

			$user_ip=get_real_ip();  //获得真实的ip地址
			if ( !($user_ip) )  {   //如果没有获得ip地址就返回错误
			    $this->ajaxReturn(0,"ip地址出错,请重启电脑试试",0);	//	
			}	

	//		if  ( $_SESSION['company_id'] ) {   //如果已经有公司id 表示已经登录过的 就不能再次登陆了证  is_set('company_id')  
	//			$this->ajaxReturn(0,"软件已经登录，请不要重复登陆",0);	//	
	//		}

			$map['username'] = array("EQ",$username);  
			$map['password'] = array("EQ",md5($password));  //md5 密码加密
			$map['company_id'] = array("EQ",$company_id);   

			$dao = M('user');			
			$rs=$dao->where($map)->find();	
	
			$dao1 = M('company');	
			$map1['a.company_id'] = array("EQ",$company_id); 
		    $rs1=$dao1
		    ->alias('a')
			->field(array('a.id','a.name','a.phone','a.mail','a.company_name','a.company_abbreviation','a.company_address','a.company_memo',
						  'a.lat','a.lng','a.zoom_level','a.s_province',
			              'a.s_city','a.s_county','a.company_id','a.branch_id','a.creat_time','a.creat_date',
						  'a.creat_ip','a.status','a.status_info','a.status_time','a.last_login_time','a.select_interval_days','a.regular_interval_days',
						  'a.map_serviceinterval_days','a.plan_id','a.plan_date','a.count_customer',
						  'a.count_sales','a.count_service','a.count_images','a.count_total','a.images_thumb_flag',
						  'b.plan_name ','b.count_record as plan_count'))	
			->join( C('DB_PREFIX') . 'admin_price AS b ON a.plan_id = b.plan_id ' )			
			->where($map1)
			->find();		

			$map2['company_id'] = array("EQ",$company_id); 
			$dao2 = M('customfields');	//自定义字段的设置		
			$rs2=$dao2->where($map2)->find();	
			
			
			
			if ( (is_null($rs))  ||  (!($rs)) || (is_null($rs1))  ||  (!($rs1)) || (is_null($rs2))  ||  (!($rs2)) )  {   //判断 如果查询结果是null 或者是 false 返回失败  		
				cookie('password',null); // password  清空
				cookie('RememberPassword',null); // RememberPassword   清空
				$this->ajaxReturn(0,"用户名或密码或公司ID 不正确",0);
			}
			else {	
                if ( $rs['status']	!='正常' ) {
					$this->ajaxReturn(0,"该用户名已经被停用，".$rs['status_info'],0);
				}
                if ( $rs1['status']	!='正常' ) {
					$this->ajaxReturn(0,"贵公司账号已经被停用，".$rs1['status_info'],0);
				}				
				$branch_id = $rs['branch_id']; //分支机构id
                $realname = $rs['realname']; //真实姓名

				$dao3 = M('user');  //开始写登陆日志  
				$data3['id']	=	$rs['id'];
				$data3['last_login_time']	=	 date('Y-m-d H:i:s');	//最近登陆时间
				$data3['last_ip']	=	 $user_ip; //客户的真实ip地址
				$data3['login_count']	=	array('exp','login_count+1');							
				$dao3->save($data3);	
				
				$dao4 = M('company');  //开始写登陆日志 
				//计算本公司的销售 售后 客户  图片数量量 和套餐的数量 来判断是否有权利再使用本软件
				 if (   date('Y-m-d',strtotime($rs1['last_login_time'])) != date('Y-m-d') ) {   //如果最后登录时间是今天 就说明已经计算过了 就不再计算了 每天运算一次
				           $map10['company_id'] = array("EQ",$company_id);     //  限定在本公司id里面							   
					       $dao10 = M("customer");	 //客户  
						   $count10 = $dao10->where($map10)->count();    //计算总数 						   
						   $dao11 = M("ordersale");	 //销售   
						   $count11 = $dao11->where($map10)->count();     //计算总数								   
						   $dao12 = M("orderservice");	  //售后  
						   $count12 = $dao12->where($map10)->count();     //计算总数		   
						   $dao13 = M("images");  //图片
						   $count13 = $dao13->where($map10)->count();     //计算图片数量总数	
						   $dao14 = M("images");  //图片
						   $count14 = $dao14->where($map10)->sum('image_size');//计算图片大小总数	
						   $data4['count_customer']=$count10 ;
						   $data4['count_sales']=$count11 ;				 
						   $data4['count_service']=$count12;
						   $data4['count_images']=$count13;
						   $data4['count_images_size']=round($count14/1024 ,2);
						   $data4['count_total']=$count10+$count11+$count12+$count13 ;
						   $_SESSION['count_customer']=$count10 ;
						   $_SESSION['count_sales']=$count11 ;	
						   $_SESSION['count_service']=$count12;
						   $_SESSION['count_images']=$count13;
						   $_SESSION['count_total']=$count10+$count11+$count12+$count13 ;
				 } else {
						   $_SESSION['count_customer']=$rs1['count_customer'] ;
						   $_SESSION['count_sales']=$rs1['count_sales'] ;	
						   $_SESSION['count_service']=$rs1['count_service'];
						   $_SESSION['count_images']=$rs1['count_images'];
						   $_SESSION['count_total']=$rs1['count_total'] ;
				 }

				   $_SESSION['plan_id']=$rs1['plan_id'] ;  //套餐id
				   $_SESSION['plan_name']=$rs1['plan_name'] ;	//套餐名称
				   $_SESSION['plan_count']=$rs1['plan_count'] ;	//套餐名称
				   $_SESSION['plan_date']=$rs1['plan_date'] ;  //套餐截至日期
				//结束计算						   

				$data4['id']	=	$rs1['id'];
				$data4['last_login_time'] = date('Y-m-d H:i:s');	//最近登录的时间戳 秒  以这个为依据,以后一年没有登陆的账户将被清理 	
				$dao4->save($data4);	
				 $dao5 = M('companylog');	//写入日志  先暂时去掉
				 $data5['log_username'] = $username ;		
				 $data5['log_time'] = date('Y-m-d H:i:s');	//时间
				 $data5['log_ip'] = $user_ip ;	//注册ip						
				 $data5['log_content'] = '登陆' ;	 // '内容',  
				 $data5['log_type'] = '登陆' ;	 // 类型   账户或者是登陆 , 
				 $data5['company_id'] = $company_id ;  // company_id 机构ID		
				 $data5['branch_id'] = $branch_id ;  // 分支机构id 
				 $dao5->data($data5)->add();  //写入登陆日志

				//开始写cookie 
				cookie('username',$username,$cookietime); 
				cookie('company_id',$company_id,$cookietime);

				if  ( $remember=='true' ) {
				   cookie('password',$password,$cookietime);
				   cookie('RememberPassword','checked',$cookietime);
				   $mobile_logininfo='/username/'.$username.'/password/'.$password.'/companyid/'.$company_id.'/remember/checked';
				} else {
				   cookie('password',null); // password 清空
				   cookie('RememberPassword',null); // RememberPassword 清空
				   $mobile_logininfo='/username/'.$username.'/companyid/'.$company_id.'/remember/false';
				}
							
				//云天售后开始session				
				   $_SESSION['custom_field1_style'] = $rs2['custom_field1_style']; //客户自定义字段1 是否显示   style="display: none"  表示关闭   为空表示显示出来   这个是下拉框1
				   $_SESSION['custom_field1_text'] =  $rs2['custom_field1_text'];  //客户自定义字段1 文本  
				   
				   $_SESSION['custom_field2_style'] = $rs2['custom_field2_style'];  //客户自定义字段2 是否显示   style="display: none"  表示关闭   为空表示显示出来   这个是下拉框2
				   $_SESSION['custom_field2_text'] =  $rs2['custom_field2_text'];  //客户自定义字段2 文本 	
				   
				   $_SESSION['custom_field3_style'] = $rs2['custom_field3_style'];  //客户自定义字段3 是否显示   style="display: none"  表示关闭   为空表示显示出来    这个是下拉框3
				   $_SESSION['custom_field3_text'] =  $rs2['custom_field3_text'];  //客户自定义字段3文本  
				   
				   $_SESSION['custom_field4_style'] = $rs2['custom_field4_style'];  //客户自定义字段4 是否显示   style="display: none"  表示关闭   为空表示显示出来    这个是下拉框4
				   $_SESSION['custom_field4_text'] =  $rs2['custom_field4_text'];  //客户自定义字段4 文本 				   
				   
				   $_SESSION['custom_field5_style'] = $rs2['custom_field5_style']; //客户自定义字段5 是否显示   style="display: none"  表示关闭   为空表示显示出来 
				   $_SESSION['custom_field5_text'] =  $rs2['custom_field5_text'];  //客户自定义字段5 文本  
				   
				   $_SESSION['custom_field6_style'] = $rs2['custom_field6_style'];  //客户自定义字段6 是否显示   style="display: none"  表示关闭   为空表示显示出来 
				   $_SESSION['custom_field6_text'] =  $rs2['custom_field6_text'];  //客户自定义字段6 文本 
				   
				   $_SESSION['custom_field7_style'] = $rs2['custom_field7_style']; //客户自定义字段7 是否显示   style="display: none"  表示关闭   为空表示显示出来 
				   $_SESSION['custom_field7_text'] =  $rs2['custom_field7_text'];  //客户自定义字段7 文本  
				   
				   $_SESSION['custom_field8_style'] = $rs2['custom_field8_style'];  //客户自定义字段8 是否显示   style="display: none"  表示关闭   为空表示显示出来 
				   $_SESSION['custom_field8_text'] =  $rs2['custom_field8_text'];  //客户自定义字段8 文本 		
				   
				   $_SESSION['custom_field9_style'] = $rs2['custom_field9_style']; //客户自定义字段9 是否显示   style="display: none"  表示关闭   为空表示显示出来 
				   $_SESSION['custom_field9_text'] =  $rs2['custom_field9_text'];  //客户自定义字段9 文本  
				   
				   $_SESSION['custom_field10_style'] = $rs2['custom_field10_style'];  //客户自定义字段10 是否显示   style="display: none"  表示关闭   为空表示显示出来 
				   $_SESSION['custom_field10_text'] =  $rs2['custom_field10_text'];  //客户自定义字段10 文本 				   

				   $_SESSION['sales_field1_style'] = $rs2['sales_field1_style']; //销售记录自定义字段1 是否显示   style="display: none"  表示关闭   为空表示显示出来   这个是下拉框1
				   $_SESSION['sales_field1_text'] =  $rs2['sales_field1_text'];  //销售记录自定义字段1 文本  
				   
				   $_SESSION['sales_field2_style'] = $rs2['sales_field2_style'];  //销售记录自定义字段2 是否显示   style="display: none"  表示关闭   为空表示显示出来   这个是下拉框2
				   $_SESSION['sales_field2_text'] =  $rs2['sales_field2_text'];   //销售记录自定义字段2 文本 	
				   
				   $_SESSION['sales_field3_style'] = $rs2['sales_field3_style'];  //销售记录自定义字段3 是否显示   style="display: none"  表示关闭   为空表示显示出来    这个是下拉框3
				   $_SESSION['sales_field3_text'] =  $rs2['sales_field3_text'];  //销售记录自定义字段3文本  
				   
				   $_SESSION['sales_field4_style'] = $rs2['sales_field4_style'];  //销售记录自定义字段4 是否显示   style="display: none"  表示关闭   为空表示显示出来    这个是下拉框4
				   $_SESSION['sales_field4_text'] =  $rs2['sales_field4_text'];   //销售记录自定义字段4 文本 				   
				   
				   $_SESSION['sales_field5_style'] = $rs2['sales_field5_style'];  //销售记录自定义字段5 是否显示   style="display: none"  表示关闭   为空表示显示出来 
				   $_SESSION['sales_field5_text'] =  $rs2['sales_field5_text'];   //销售记录自定义字段5 文本  
				   
				   $_SESSION['sales_field6_style'] = $rs2['sales_field6_style'];  //销售记录自定义字段6 是否显示   style="display: none"  表示关闭   为空表示显示出来 
				   $_SESSION['sales_field6_text'] =  $rs2['sales_field6_text'];   //销售记录自定义字段6 文本 				

				   $_SESSION['sales_field7_style'] = $rs2['sales_field7_style'];  //销售记录自定义字段7 是否显示   style="display: none"  表示关闭   为空表示显示出来 
				   $_SESSION['sales_field7_text'] =  $rs2['sales_field7_text'];   //销售记录自定义字段7 文本  
				   
				   $_SESSION['sales_field8_style'] = $rs2['sales_field8_style'];  //销售记录自定义字段8 是否显示   style="display: none"  表示关闭   为空表示显示出来 
				   $_SESSION['sales_field8_text'] =  $rs2['sales_field8_text'];   //销售记录自定义字段8 文本 
				   
				   $_SESSION['sales_field9_style'] = $rs2['sales_field9_style'];  //销售记录自定义字段9 是否显示   style="display: none"  表示关闭   为空表示显示出来 
				   $_SESSION['sales_field9_text'] =  $rs2['sales_field9_text'];   //销售记录自定义字段9 文本  
				   
				   $_SESSION['sales_field10_style'] = $rs2['sales_field10_style'];  //销售记录自定义字段10 是否显示   style="display: none"  表示关闭   为空表示显示出来 
				   $_SESSION['sales_field10_text'] =  $rs2['sales_field10_text'];   //销售记录自定义字段10 文本 				   
				   				   
				   $_SESSION['record_field1_style'] = $rs2['record_field1_style']; //售后记录自定义字段1 是否显示   style="display: none"  表示关闭   为空表示显示出来   这个是下拉框1
				   $_SESSION['record_field1_text'] =  $rs2['record_field1_text'];  //售后记录自定义字段1 文本  
				   
				   $_SESSION['record_field2_style'] = $rs2['record_field2_style'];  //售后记录自定义字段2 是否显示   style="display: none"  表示关闭   为空表示显示出来   这个是下拉框2
				   $_SESSION['record_field2_text'] =  $rs2['record_field2_text'];   //售后记录自定义字段2 文本 	
				   
				   $_SESSION['record_field3_style'] = $rs2['record_field3_style'];  //售后记录自定义字段3 是否显示   style="display: none"  表示关闭   为空表示显示出来    这个是下拉框3
				   $_SESSION['record_field3_text'] =  $rs2['record_field3_text'];   //售后记录自定义字段3文本  
				   
				   $_SESSION['record_field4_style'] = $rs2['record_field4_style'];  //售后记录自定义字段4 是否显示   style="display: none"  表示关闭   为空表示显示出来    这个是下拉框4
				   $_SESSION['record_field4_text'] =  $rs2['record_field4_text'];   //售后记录自定义字段4 文本 				   
				   
				   $_SESSION['record_field5_style'] = $rs2['record_field5_style'];  //售后记录自定义字段5 是否显示   style="display: none"  表示关闭   为空表示显示出来 
				   $_SESSION['record_field5_text'] =  $rs2['record_field5_text'];   //售后记录自定义字段5 文本  
				   
				   $_SESSION['record_field6_style'] = $rs2['record_field6_style'];  //售后记录自定义字段6 是否显示   style="display: none"  表示关闭   为空表示显示出来 
				   $_SESSION['record_field6_text'] =  $rs2['record_field6_text'];   //售后记录自定义字段6 文本 				

				   $_SESSION['record_field7_style'] = $rs2['record_field7_style'];  //售后记录自定义字段7 是否显示   style="display: none"  表示关闭   为空表示显示出来 
				   $_SESSION['record_field7_text'] =  $rs2['record_field7_text'];   //售后记录自定义字段7 文本  
				   
				   $_SESSION['record_field8_style'] = $rs2['record_field8_style'];  //售后记录自定义字段8 是否显示   style="display: none"  表示关闭   为空表示显示出来 
				   $_SESSION['record_field8_text'] =  $rs2['record_field8_text'];   //售后记录自定义字段8 文本 	
				   
				   $_SESSION['record_field9_style'] = $rs2['record_field9_style'];  //售后记录自定义字段9 是否显示   style="display: none"  表示关闭   为空表示显示出来 
				   $_SESSION['record_field9_text'] =  $rs2['record_field9_text'];   //售后记录自定义字段9 文本  
				   
				   $_SESSION['record_field10_style'] = $rs2['record_field10_style'];  //售后记录自定义字段10 是否显示   style="display: none"  表示关闭   为空表示显示出来 
				   $_SESSION['record_field10_text'] =  $rs2['record_field10_text'];   //售后记录自定义字段10 文本 					
				
						 // $_SESSION['sales_order_number_style'] = 'style="display: none"';  //销售单号是否自动生成  是否显示   style="display: none"  表示关闭 自动生成    为空表示显示出来 手工录入单号'   
						//  $_SESSION['sales_order_number_required'] = 'required'; //当手工录入的时候 需要做非空验证

						 // $_SESSION['sales_order_number_style'] = 'style="display: none"';  //销售单号是否自动生成  是否显示   style="display: none"  表示关闭 自动生成    为空表示显示出来 手工录入单号'   
						 // $_SESSION['sales_order_number_required'] = ''; //当手工录入的时候 需要做非空验证
				 
             //    $_SESSION['warranty_interval_days'] = 365;  //默认  质保间隔天数
				 $_SESSION['select_interval_days'] = $rs1['select_interval_days'];  //默认 查询默认时间间隔  销售管理  查询销售/售后记录  修改/删除 默认10  
				 $_SESSION['regular_interval_days'] = $rs1['regular_interval_days'];  //默认 提前几天显示到期的  需要定期维护和回访的时间  默认提前10天显示到期的数据
				 $_SESSION['map_serviceinterval_days'] = $rs1['map_serviceinterval_days'];  //默认 查询默认时间间隔  从当天算 显示多少天以后的数据在地图上  售后地图 默认5
				 
				 $_SESSION['indexcount_interval_second'] = 10;  //默认 主页刷新计算的间隔时间 秒  这个应该在我们的管理后台里面设置
				 
				 
				if (cookie('customersorter_key')==null) {   //默认客户  排序字段 默认按姓名排序 
			    	cookie('customersorter_key','name',$cookietime);   //默认客户搜索关键字 排序字段 默认按姓名排序 
					cookie('customersorter_number','2',$cookietime);  //默认客户搜索关键字 排序字段 默认按姓名排序  序号是2 
					cookie('customersorter_ascordesc','asc',$cookietime);   //默认客户搜索关键字 排序字段 默认 升序
				}	

				if (cookie('salessorter_key')==null) {   //默认销售 排序字段 默认按姓名排序 
			    	cookie('salessorter_key','date_sale',$cookietime);   //默认销售 排序字段 默认按销售时间排序 
					cookie('salessorter_number','3',$cookietime);  //默认销售 排序字段 默认按姓名排序  序号是3 
					cookie('salessorter_ascordesc','desc',$cookietime);   //默认销售 排序字段 默认 降序
				}	

				if (cookie('servicesorter_key')==null) {   //默认售后 排序字段 默认按姓名排序 
			    	cookie('servicesorter_key','date_report',$cookietime);   //默认售后 排序字段 默认按报修时间排序 
					cookie('servicesorter_number','3',$cookietime);  //默认售后 排序字段   序号是3
					cookie('servicesorter_ascordesc','desc',$cookietime);   //默认售后 排序字段 默认 降序
				}				
				 
				if (cookie('NumberOfRows')==null) {   //默认每页显示的数据行数 
			    	cookie('NumberOfRows','10',$cookietime);
				}

				if (cookie('searchcustomer_key')==null) {   //默认客户搜索关键字 默认按姓名搜索 
			    	cookie('searchcustomer_key','name',$cookietime);
				}	
				
				if (cookie('sales_searchcustomer_key')==null) {   //老客户添加销售记录 默认客户搜索关键字 默认按姓名搜索 
			    	cookie('sales_searchcustomer_key','name',$cookietime);
				}	

				if (cookie('service_searchcustomer_key')==null) {   //老客户添加售后记录 默认客户搜索关键字 默认按姓名搜索 
			    	cookie('servicesales_searchcustomer_key','name',$cookietime);
				}					
				
				if (cookie('searchsales_key')==null) {   //默认销售记录搜索关键字 默认按姓名搜索 
			    	cookie('searchsales_key','b.name',$cookietime);
				}	
				
                 $_SESSION['NumberOfLast'] ='10'   ;//设置 客户详细资料那里 显示最近的几条销售/售后记录	
				 $_SESSION['stock_control_flag'] = 'yes';  //库存管理状态   yes：需要管理库存 审核时会自动减库存 当库存不足使会提示错误  no： 不需要管理库存 不见库存 不做判断  从数据库里面读取 写到session里面
				 $_SESSION['salesprocess_flag'] = 'no';  //销售是否需要过程化管理 比如增加 安排送货员 销售完成的设置  当设置成yes时 那销售最后的一个状态是  已完成 在回访里面 以这个为需要回访的状态 当设置成no的时候 已审核就是最后的一个状态    从数据库里面读取 写到session里面

			//	cookie('images_number','500',$cookietime);  //初始化图片的数量上限	
			//	cookie('images_maxsize','2048000',$cookietime);  //初始化图片的最大尺寸  512000    204800  3m大小 3072000 字节
			//	cookie('images_maxsize_kb','2M',$cookietime);  //初始化图片的最大尺寸 500k  200k  kb 单位

				if ( $rs1['images_thumb_flag'] != '1') {  //1:不压缩   0：压缩   默认是压缩的
					$_SESSION['images_thumbMaxWidth'] ='800'   ;//设置缩略图最大宽度    这个设置的大一些 就是不压缩的了  
					$_SESSION['images_thumbMaxHeight'] ='800'   ;//设置缩略图最大高度 
					cookie('images_thumbMaxWidth','800',$cookietime);  //设置缩略图最大宽度    这个设置的大一些 就是不压缩的了 
					cookie('images_thumbMaxHeight','800',$cookietime);  //设置缩略图最大高度 
				} else {
					$_SESSION['images_thumbMaxWidth'] ='10000'   ;//设置缩略图最大宽度    这个设置的大一些 就是不压缩的了  
					$_SESSION['images_thumbMaxHeight'] ='10000'   ;//设置缩略图最大高度 
					cookie('images_thumbMaxWidth','10000',$cookietime);  //设置缩略图最大宽度    这个设置的大一些 就是不压缩的了 
					cookie('images_thumbMaxHeight','10000',$cookietime);  //设置缩略图最大高度 					
				}

				$_SESSION['images_number'] ='500'   ; //初始化图片的数量上限	
				$_SESSION['images_maxsize'] ='4194304' ;   //初始化图片的最大尺寸  512000    2097152 3145728 4194304字节
				$_SESSION['images_maxsize_kb'] ='4M'  ; //初始化图片的最大尺寸 500k  200k  kb 单位	
				
				cookie('images_maxsize','4194304',$cookietime);  //初始化图片的最大尺寸  512000   2097152 3145728 4194304字节
				cookie('images_maxsize_kb','4M',$cookietime);  //初始化图片的最大尺寸 500k  200k  kb 单位				
				
				
			//	$_SESSION['images_path'] =__ROOT__.'/Public/uploads/'  ; //图片路径  用于本地或者虚拟主机的图片上传的位置
				$_SESSION['images_path'] ='http://ytsoft-yunpan.bj.bcebos.com/'  ; //百度BOS 存储地址
				
				$_SESSION['last_read_notice']  =$rs['last_read_notice'];   ///最后读公司信息的时间的时间			
		//		$_SESSION['last_accessed_times1']  =0;  //时间戳  用5次访问的时间间隔计算是否是  计算机恶意访问  5磁记录以后  最后一次减第一次访问时间如果小于
		//		$_SESSION['last_accessed_times2']  =0;  //时间戳 
		//		$_SESSION['last_accessed_times3']  =0;  //时间戳 
		//		$_SESSION['last_accessed_times4']  =0;  //时间戳 
		//		$_SESSION['last_accessed_times5']  =0;  //时间戳 
				

				//云天售后结束session

				$_SESSION['loginname'] = $username; 
				$_SESSION['username'] = $realname;  //真实姓名 会写到订单的creatname字段
			    $_SESSION['company_id'] = $company_id;  //把company_id写到sission里面 在这里可以把这个登陆用户的权限，资料等写到sission里面
				$_SESSION['branch_id'] = $branch_id;  //把branch_id写到sission里面 这个是分支机构id  从数据库里面获取 
				$_SESSION['service_staff'] = $rs['servicestaff']; //是否是售后人员  售后人员的名字
							
			    $_SESSION['user_ip'] = $user_ip;  //登录用户的ip地址

				//$_SESSION['company_name'] = "云天代驾";  //把company_name写到sission里面 这个是公司的缩写,在注册公司的时候,详细资料那里录入,写到订单里面,让代驾手机可以看到是哪个公司的任务
                $_SESSION['company_name'] = $rs1['company_abbreviation']  ;  //把company_name写到sission里面 这个是公司的缩写,在注册公司的时候,详细资料那里录入,写到订单里面,让代驾手机可以看到是哪个公司的任务

				 $_SESSION['city_lng'] = $rs1['lng']; 
				 $_SESSION['city_lat'] = $rs1['lat']; 
				 $_SESSION['city_zoomLevel'] = $rs1['zoom_level']; 				 

                cookie('city_pageCapacity','8',$cookietime);  //地图搜索 每页显示结果的条数  这些数据在登录的时候,可选,然后记录在cookie里面				
				
                cookie('ajaxsavedata_timeout','60000',$cookietime);  //ajax 增 改 查 的超时的时间  毫秒为单位
				

			//	cookie('images_number','4',$cookietime);  //初始化图片的数量上限	
			//	cookie('images_maxsize','204800',$cookietime);  //初始化图片的最大尺寸  204800 字节
			//	cookie('images_maxsize_kb','200k',$cookietime);  //初始化图片的最大尺寸  200k  kb 单位
				
			//	$rs['company_name'] = $rs1['company_abbreviation'];   // 公司名称缩写	
			//	$rs['soft_http'] = 'http://www.yfdj365.com/pc.htm';   // 软件主页地址
			//	$rs['var_num'] = '1.0.0';   // 核心版本号,网页的,每次升级以后,要修改这个版本版本号
			//	 $this->ajaxReturn(1,json_encode($rs),1);

              //用于pc客户端登陆的初始化参数
              	$rs_client['company_name'] = $rs1['company_abbreviation'];   // 公司名称缩写	
				$rs_client['soft_http'] = 'http://www.ytsoft.cn/yt800/';   // 软件主页地址
				$rs_client['var_num'] = '0.0.1';   // 核心版本号,网页的,每次升级以后,要修改这个版本版本号		
				$rs_client['sid'] = session_id();   // pc 客户端登陆成功以后 把当前的session传递到pc 客户端那里记录 下次访问要带上来	
				$rs_client['username'] = $rs['username'];   // 用户登录名	
				$rs_client['realname'] = $rs['realname'];   // 用户实际名字	
			 //结束 用于pc客户端登陆的初始化参数
  			 //常用网址设置
			      $_SESSION['url_planadd'] = 'http://www.ytsoft.cn/yt800/buy.php';   //充值网址
			 //常用网址设置结束
			   

			if (  $authcode !='YTmobile_dologin' ){  //来自pc登录或者 web登录	
			   //开始按权限来生成左边menu	并且声称权限验证  action  字符串	 web和pc登录的权限设置	  
						$m = M('auth_group');
						$where['branch_id'] = $_SESSION['branch_id'];
						$where['company_id'] = $_SESSION['company_id'];	
						$where['group_id'] =  array('eq',$rs['group_id']);	
						$reuslt = $m->field('id,title,rules')->where($where)->find();
						if (!($reuslt)) {
							$this->ajaxReturn(0,"登录错误，请刷新重试",0);
							return;
						}	
						$reuslt['rules'] = ','.$reuslt['rules'].',';			  				  				  
						$str='';
						$str1=''; 
						$str2=''; 
						$m = M('auth_rule');
						$data = $m->field('id,name,title,mid,micon,murl')->where('pid=0 and id<60')->order(' sort asc ')->select();
						foreach ($data as $k=>$v){
							$data[$k]['sub'] = $m->field('id,name,title,mid,micon,murl')->where('pid='.$v['id'])->order(' sort asc ')->select();	
							for ($i= 0;$i< count($data[$k]['sub']); $i++){ 
							   $data[$k]['sub'][$i]['sub1'] = $m->field('id,name,title')->where('pid='.$data[$k]['sub'][$i]['id'])->order(' sort asc ')->select();	
							}
						}
						if ( $rs['group_id'] !='10') {  //普通用户
							foreach ($data as $k=>$v){
								if  (  strpos($reuslt['rules'],','.$v['id'].',') > -1 ) {
									 $str=$str.'<li id="'.$v['mid'].'" >';
									 $str=$str.'<a href="javascript:;" id="'.$v['mid'].'_arrow" >';
									 $str=$str.'<i class="'.$v['micon'].'"></i>'; 
									 $str=$str.'<span class="title">&nbsp;'.$v['title'].'</span>';
									 $str=$str.'<span class="arrow "></span>';  			   
									 $str=$str.'</a>';
									 $str=$str.'<ul class="sub-menu">';	
										for ($i= 0;$i< count($data[$k]['sub']); $i++){ 
										   if  (  strpos($reuslt['rules'],','.$data[$k]['sub'][$i]['id'].',') > -1 ) {       									
											 $str=$str.'<li id="'.$data[$k]['sub'][$i]['mid'].'" >';
											 if  ( strpos($data[$k]['sub'][$i]['murl'], '<a  href=')> -1 ) {
												 $str=$str.$data[$k]['sub'][$i]['murl']; //如果是弹出新的窗口 url是在数据库里面直接写好的
											 } else {
												 $str=$str."<a href='".$data[$k]['sub'][$i]['murl']."'>"; //如果不是就拼接一下
											 }
									//		 $str=$str."<a href='".$data[$k]['sub'][$i]['murl']."'>"; 
											 $str=$str.$data[$k]['sub'][$i]['title'].'</a> </li>'; 
												$str1=$str1.$data[$k]['sub'][$i]['name'].',';  //组装权限 验证 action  权限
												for ($j= 0;$j< count($data[$k]['sub'][$i]['sub1']); $j++){ 
												   if  (  strpos($reuslt['rules'],','.$data[$k]['sub'][$i]['sub1'][$j]['id'].',') > -1 ) {       									
														$str1=$str1.$data[$k]['sub'][$i]['sub1'][$j]['name'].',';
												   }
												} 										 
										   }								   
										} 							 
									 $str=$str.'</ul>';
									 $str=$str.'</li>';								
								}
							}											
						} 
						else  {  //系统管理员
							foreach ($data as $k=>$v){
								 $str=$str.'<li id="'.$v['mid'].'" >';
								 $str=$str.'<a href="javascript:;" id="'.$v['mid'].'_arrow" >';
								 $str=$str.'<i class="'.$v['micon'].'"></i>'; 
								 $str=$str.'<span class="title">&nbsp;'.$v['title'].'</span>';
								 $str=$str.'<span class="arrow "></span>';  			   
								 $str=$str.'</a>';
								 $str=$str.'<ul class="sub-menu">';	

									for ($i= 0;$i< count($data[$k]['sub']); $i++){ 								
										 $str=$str.'<li id="'.$data[$k]['sub'][$i]['mid'].'" >';
											 if  ( strpos($data[$k]['sub'][$i]['murl'], '<a  href=')> -1 ) {
												 $str=$str.$data[$k]['sub'][$i]['murl']; //如果是弹出新的窗口 url是在数据库里面直接写好的
											 } else {
												 $str=$str."<a href='".$data[$k]['sub'][$i]['murl']."'>"; //如果不是就拼接一下
											 }										 
										// $str=$str."<a href='".$data[$k]['sub'][$i]['murl']."'>"; 
										 $str=$str.$data[$k]['sub'][$i]['title'].'</a> </li>'; 
									} 							 
								 $str=$str.'</ul>';
								 $str=$str.'</li>';			
							}						
						}					
						foreach ($data as $k=>$v){ // 组装全部权限 验证 action  权限
							for ($i= 0;$i< count($data[$k]['sub']); $i++){ 
							   $str2=$str2.$data[$k]['sub'][$i]['name'].',';  //全部权限 验证 action  权限
							   for ($j= 0;$j< count($data[$k]['sub'][$i]['sub1']); $j++){    									
									$str2=$str2.$data[$k]['sub'][$i]['sub1'][$j]['name'].',';
								} 									   
							} 							 
						}						
						$_SESSION['group_id'] =$rs['group_id']  ; //用户权限组
						$_SESSION['group_name'] =$reuslt['title']  ; //用户权限组名				
						$_SESSION['group_rules'] =$reuslt['rules']  ; //用户权限规则
						$_SESSION['group_allaction_rules'] ='/?/,'.$str2  ; //全部权限  action  规则
						$_SESSION['group_action_rules'] ='/?/,'.$str1  ; //权限 验证 action  权限
						
						$find="__APP__";
						$replace=__APP__ ;	
						$str = str_replace($find, $replace, $str);	

						$find="__PUBLIC__";
						$replace=__PUBLIC__;	
						$str = str_replace($find, $replace, $str);	//3.2.3  不支持在 Controller 中支持 __PUBLIC__ 

						$_SESSION['yt_left_menu'] =$str ; //用户左 菜单		

					//	Log::write('调试的$rs：'.json_encode($data));  
					//	Log::write('调试的$str1：'.$str1);  
					//	Log::write('调试的$str2：'.$str2);  
					//	Log::write('调试的$_SESSION[yt_left_menu]：'.$_SESSION['yt_left_menu']);  
					//	Log::write('调试的$_SESSION[group_id]：'.$_SESSION['group_id']);  
					//	Log::write('调试的$_SESSION[group_name]：'.$_SESSION['group_name']);  
					//	Log::write('调试的$_SESSION[group_rules]：'.$_SESSION['group_rules']);  
			 //web和pc登录  结束按权限来生成左边menu	
			  if ( $login_flag !="" ) {  //不等于空表示来自pcclent的登录  如果为空表示来自web的登录			  
			  		//套餐验证 是否过期 是否超标
						if ((  $_SESSION['plan_date'] < date('Y-m-d') ) || ( (int)$_SESSION['count_total'] >  (int)$_SESSION['plan_count'] ) ){
							$this->ajaxReturn(1,'套餐过期'.json_encode($rs_client),1);
							//$this->ajaxReturn(0,"账户停用<br>1. 套餐已经过期<br>2. 数据使用量超出套餐容量",0);	
						} else {
							$this->ajaxReturn(1,'登陆成功'.json_encode($rs_client),1);	
						}

		           //套餐验证结束			  
			      $_SESSION['login_type'] ='pcclent' ; //pcclent登陆	 	
			  } else {
				  $_SESSION['login_type'] ='web' ; //web登陆
				  $this->ajaxReturn(1,'',1);			
			  }               
			}	 else {
			   //开始按权限来生成左边menu	并且声称权限验证  action  字符串	 手机登录的权限设置	  
						$m = M('auth_group');
						$where['branch_id'] = $_SESSION['branch_id'];
						$where['company_id'] = $_SESSION['company_id'];	
						$where['group_id'] =  array('eq',$rs['group_id']);	
						$reuslt = $m->field('id,title,rules')->where($where)->find();
						if (!($reuslt)) {
							$this->ajaxReturn(0,"登录错误，请刷新重试",0);
							return;
						}	
						$reuslt['rules'] = ','.$reuslt['rules'].',';			  				  				  
						$str='';
						$str1=''; 
						$str2=''; 
						$m = M('auth_rule');
						$data = $m->field('id,name,title,mid,micon,murl')->where('pid=0 and id=60')->order(' sort asc ')->select();
						foreach ($data as $k=>$v){
							$data[$k]['sub'] = $m->field('id,name,title,mid,micon,murl')->where('pid='.$v['id'])->order(' sort asc ')->select();	
							for ($i= 0;$i< count($data[$k]['sub']); $i++){ 
							   $data[$k]['sub'][$i]['sub1'] = $m->field('id,name,title')->where('pid='.$data[$k]['sub'][$i]['id'])->order(' sort asc ')->select();	
							}
						}
						$i1=0;
						if ( $rs['group_id'] !='10') {  //普通用户
							foreach ($data as $k=>$v){
								if  (  strpos($reuslt['rules'],','.$v['id'].',') > -1 ) {	
										for ($i= 0;$i< count($data[$k]['sub']); $i++){ 
										   if  (  strpos($reuslt['rules'],','.$data[$k]['sub'][$i]['id'].',') > -1 ) {    
											      $str=$str.'<li class="table-view-cell media">';
												  $str=$str."<a class='navigate-right' href='".$data[$k]['sub'][$i]['murl']."'>"; 
												  $str=$str." <img class='media-object pull-left' width='40' height='40' src='".$data[$k]['sub'][$i]['micon'].".png'>"; 
												  $str=$str.' <div class="media-body">';
												  $str=$str.$data[$k]['sub'][$i]['title'];
												  $str=$str.' </div>';
												  $str=$str.'</a>';
												  $str=$str.'</li>	';	
												  $i1=$i1+1;
                                                 if ( $data[$k]['sub'][$i]['id'] == '207' ) {   //领料查询的权限												  
															  $str=$str.'<li class="table-view-cell media">';
															  $str=$str."    <a class='navigate-right' href='";
															  $str=$str.'    JavaScript:window.open("__APP__/Mobilestock/statistics_stockservicestaff_list/flag/3"); ';
															  $str=$str."'  >  ";
															  $str=$str.'	  <img class="media-object pull-left" width="40" height="40" src="__PUBLIC__/images/index_mystock.png">';
															  $str=$str.' 	  <div class="media-body">';
															  $str=$str.'    售后人员退料查询<p>售后人员退料明细查询</p>';
															  $str=$str.' 	  </div>';
															  $str=$str.'	</a>';
															  $str=$str.' </li>';
															  $i1=$i1+1;				 													  
												  }
												  if (  ($i1>3) && ( ($i+1) != count($data[$k]['sub']) ) ){
													  $i1=0;
													  $str=$str.' </ul> <ul class="table-view">';  //超过4个行 就换个框
												  }

												$str1=$str1.$data[$k]['sub'][$i]['name'].',';  //组装权限 验证 action  权限
												for ($j= 0;$j< count($data[$k]['sub'][$i]['sub1']); $j++){ 
												   if  (  strpos($reuslt['rules'],','.$data[$k]['sub'][$i]['sub1'][$j]['id'].',') > -1 ) {       									
														$str1=$str1.$data[$k]['sub'][$i]['sub1'][$j]['name'].',';
												   }
												} 										 
										   }								   
										} 							 					
								}
							}											
						} 
						else  {  //系统管理员
							foreach ($data as $k=>$v){
									for ($i= 0;$i< count($data[$k]['sub']); $i++){ 								
											      $str=$str.'<li class="table-view-cell media">';
												  $str=$str."<a class='navigate-right' href='".$data[$k]['sub'][$i]['murl']."'>"; 
												  $str=$str." <img class='media-object pull-left' width='40' height='40' src='".$data[$k]['sub'][$i]['micon'].".png'>"; 
												  $str=$str.' <div class="media-body">';
												  $str=$str.$data[$k]['sub'][$i]['title'];
												  $str=$str.' </div>';
												  $str=$str.'</a>';
												  $str=$str.'</li>	';
												  $i1=$i1+1;
                                                 if ( $data[$k]['sub'][$i]['id'] == '207' ) {   //领料查询的权限												  
															  $str=$str.'<li class="table-view-cell media">';
															  $str=$str."    <a class='navigate-right' href='";
															  $str=$str.'    JavaScript:window.open("__APP__/Mobilestock/statistics_stockservicestaff_list/flag/3"); ';
															  $str=$str."'  >  ";
															  $str=$str.'	  <img class="media-object pull-left" width="40" height="40" src="__PUBLIC__/images/index_mystock.png">';
															  $str=$str.' 	  <div class="media-body">';
															  $str=$str.'    售后人员退料查询<p>售后人员退料明细查询</p>';
															  $str=$str.' 	  </div>';
															  $str=$str.'	</a>';
															  $str=$str.' </li>';
															  $i1=$i1+1;
													}
												   if (  ($i1>3) && ( ($i+1) != count($data[$k]['sub']) ) ){
													  $i1=0;
													  $str=$str.' </ul> <ul class="table-view">';  //超过4个行 就换个框
												  }										
												  
									} 							 		
							}						
						}					
						foreach ($data as $k=>$v){ // 组装全部权限 验证 action  权限
							for ($i= 0;$i< count($data[$k]['sub']); $i++){ 
							   $str2=$str2.$data[$k]['sub'][$i]['name'].',';  //全部权限 验证 action  权限
							   for ($j= 0;$j< count($data[$k]['sub'][$i]['sub1']); $j++){    									
									$str2=$str2.$data[$k]['sub'][$i]['sub1'][$j]['name'].',';
								} 									   
							} 							 
						}		
						$find="（";
						$replace="<p>" ;
						$str = str_replace($find, $replace, $str);		
						$find="）";
						$replace="</p>" ;	
						$str = str_replace($find, $replace, $str);			
						$_SESSION['group_id'] =$rs['group_id']  ; //用户权限组
						$_SESSION['group_name'] =$reuslt['title']  ; //用户权限组名				
						$_SESSION['group_rules'] =$reuslt['rules']  ; //用户权限规则
						$_SESSION['group_allaction_rules'] ='/?/,'.$str2  ; //全部权限  action  规则
						$_SESSION['group_action_rules'] ='/?/,'.$str1  ; //权限 验证 action  权限
					//	$_SESSION['yt_left_menu'] =$str ; //用户左 菜单	
						$_SESSION['login_type'] ='Mobile' ; //手机客户端登陆
						
						$find="__APP__";
						$replace=__APP__ ;	
						$str = str_replace($find, $replace, $str);	

						$find="__PUBLIC__";
						$replace="./Public/" ;

						$str = str_replace($find, $replace, $str);	//3.2.3  不支持在 Controller 中支持 __PUBLIC__ 						

						$_SESSION['yt_left_menu'] =$str ; //用户左 菜单		
		
						

					//	Log::write('调试的$rs：'.json_encode($data));  
					//	Log::write('调试的$str1：'.$str1);  
					//	Log::write('调试的$str2：'.$str2);  
					//	Log::write('调试的$_SESSION[yt_left_menu]：'.$_SESSION['yt_left_menu']);  
					//	Log::write('调试的$_SESSION[group_id]：'.$_SESSION['group_id']);  
					//	Log::write('调试的$_SESSION[group_name]：'.$_SESSION['group_name']);  
					//	Log::write('调试的$_SESSION[group_rules]：'.$_SESSION['group_rules']);  
			 //手机登录  结束按权限来生成menu	
			 
			  		//套餐验证 是否过期 是否超标
						if ((  $_SESSION['plan_date'] < date('Y-m-d') ) || ( (int)$_SESSION['count_total'] >  (int)$_SESSION['plan_count'] ) ){
							$this->ajaxReturn(0,"账户停用<br>1. 套餐过期<br>2. 数据使用量超出套餐容量",0);	//	
						} else {
							$this->ajaxReturn(1,$mobile_logininfo,1);	 //来自手机登录
						}						 
		           //套餐验证结束						
				
				
				//$this->ajaxReturn(1,$mobile_logininfo,1);	 //来自手机登录
			}							 
	    } 
	}
	
	
    public function doforget(){  //忘记密码
		$email = trim($_POST['email']);	 
		$authcode = trim($_POST['authcode']);	
		if(empty($email)){
			$this->ajaxReturn(0,"邮件地址不能为空",0);
		}
		if (  !( preg_match("/^[\w\-\.]+@[\w\-\.]+(\.\w+)+$/", $email) ) )  {
			$this->ajaxReturn(0,"邮件格式不正确",0);
		}

		if ( ( !$this->check_verify($authcode))	 && ( $authcode !='YTmobile_dologin' )){  //YTmobile_dologin  来自手机登录 不需要验证码
			$this->ajaxReturn(0,"验证码不正确",0);	//	开发阶段先把这个关闭 	
		}	
			
	    $dao = M('user');	
		$map['mail'] = array("EQ",$email); 
	    $rs=$dao->where($map)->find();	
	    if ( (is_null($rs))  ||  (!($rs)) )  {   //判断 如果查询结果是null 或者是 false 返回成功  		   
			 $this->ajaxReturn(0,"邮箱输入错误，没有找到该邮箱",0);	//	
	    }
	    else {
		   $guid =get_guid(); 
		   $url='http://'.$_SERVER['SERVER_NAME'].__APP__.'User/changepassword/guid/'.$guid;  
		   $data1['guid'] = $guid; 		
		   $data1['email'] = $email;  
		   $data1['uesrid'] = $rs['id']; 
		   $data1['username'] = $rs['username'];
		   $data1['company_id'] = $rs['company_id'];  
		   $data1['count_date'] = date('Y-m-d H:i:s');	
		   $dao1 = M('forgetpassword');                
		   $rs1 = $dao1->add($data1); 	
		  if ($rs1) {   //保存成功 当前的时间  标志位guid   邮件地址
			  $result = send_mail( $email , "云天售后软件找回密码" , get_mail_body_findpass( $url,$rs['company_id'],$rs['username'] ) ); //发送找回密码处理邮件 
		  } else {
			  $this->ajaxReturn(0,"处理失败，请刷新重试",0);	//	
		  }
	    } 		  
		if( $result ) {
			 $this->ajaxReturn(1,'修改密码的邮件已经发送到'.$email.'，请接收邮件并处理，如果没有收到，请耐心等待一会',1);				    
		 }else{			 
		    $this->ajaxReturn(0,$result,0);
		 }			
    }	
	
    public function dochangepassword(){  //修改密码
			$password = trim($_POST['password']);
			$rpassword = trim($_POST['rpassword']);
			$guid = trim($_POST['guid']);
		//	$authcode = trim($_POST['authcode']);			
		//	if( empty($password) || empty($rpassword) || empty($authcode) || empty($guid)  ){
		//		$this->ajaxReturn(0,"密码或验证码不能为空",0);
		//	}
			if( empty($password) || empty($rpassword) ||  empty($guid)  ){
				$this->ajaxReturn(0,"密码不能为空",0);
			}			
			
			if ( $password != $rpassword )  {
				$this->ajaxReturn(0,"两次密码输入不一样",0);
			} 			
			if (  !( preg_match("/^[A-Za-z0-9]+$/", $password) ) )  {	
				$this->ajaxReturn(0,"密码只能由字母和数字组成，不能有其它字符",0);
			}
			if ( ( strlen($password)<4 ) || ( strlen($password)>10 )  ) {
				$this->ajaxReturn(0,"密码长度大于4，小于10",0);
			}
	//		if(md5($authcode) != $_SESSION['verify']){
	//			$this->ajaxReturn(0,"验证码错误",0);	//	开发阶段先把这个关闭 	
	//		}
		
	    $dao = M('forgetpassword');	
		$map['guid'] = array("EQ",$guid); 
	    $rs=$dao->where($map)->find();	
	    if ( (is_null($rs))  ||  (!($rs)) )  {   //判断 如果查询结果是null 或者是 false 返回成功  		   
			 $this->ajaxReturn(0,"数据处理错误",0);	//	
	    }
	    else {			
			$username = $rs['username'];
			$company_id = $rs['company_id'];  
			$email =$rs['email'];  
		    $dao1 = M('user');	
		    $map1['id'] = $rs['uesrid'];  
			$map1['email'] = $email;  
			$data1['password'] = md5($password); 				
	        $rs1=$dao1->where($map1)->save($data1);	
			if ( (is_null($rs1))  ||  (!($rs1)) )  {   //判断 如果查询结果是null 或者是 false 返回成功  		   
				 $this->ajaxReturn(0,"修改密码失败或者密码没有变化不需要修改，请刷新重试",0);	//	
			}
			$rs=$dao->where($map)->delete();
			$result = send_mail( $email , "云天售后软件找回密码" , get_mail_body_changepassword( $company_id,$username,$password) ); //发送账户信息邮件 
	    } 		  
		if( $result ) {
			 $this->ajaxReturn(1,'修改密码成功，账户信息邮件已经发送到'.$email.'，请登录软件',1);				    
		 }else{			 
		    $this->ajaxReturn(1,'修改密码成功，请登录软件',1);	
		 }			
    }
		
	Public function doregister(){	//注册
		$name = trim($_POST['name']);
		$phone = trim($_POST['phone']);
		$mail = trim($_POST['email']);
		$rmail = trim($_POST['remail']);
		$company_name = trim($_POST['company_name']);
		$company_address = trim($_POST['company_address']);			
		$s_province = trim($_POST['s_province']);
		$s_city = trim($_POST['s_city']);
		$s_county = trim($_POST['s_county']);
		$lng = trim($_POST['lng']);
		$lat = trim($_POST['lat']);
		$authcode = trim($_POST['authcode']);	
		
		if  (empty($lng) || empty($lat) ) {
			$lat = '39.90499';		//如果没有采集到经纬度 就用北京的经纬度
			$lng = '116.40529';	
		}		

    //   $this->ajaxReturn(0,$s_province." ".$s_city." ".$s_county." ".$lng." ".$lat,0);

		
		if(empty($name) || empty($phone) || empty($mail) || empty($rmail) || empty($company_name) || empty($company_address) || empty($authcode) || empty($s_province) || empty($s_city)  ){
			$this->ajaxReturn(0,"数据填写不完整",0);
		}
		
	   if ( $mail != $rmail )  {
				$this->ajaxReturn(0,"两次注册邮箱输入不一样",0);
		} 

		if (  !( preg_match("/^[\w\-\.]+@[\w\-\.]+(\.\w+)+$/", $mail) ) )  {
			$this->ajaxReturn(0,"邮件格式不正确",0);
		}			

		if ( ( !$this->check_verify($authcode))	){  
			$this->ajaxReturn(0,"验证码错误",0);	//	开发阶段先把这个关闭 	
		}			
		

		$user_ip=get_real_ip();  //获得真实的ip地址
		if ( !($user_ip) )  {   //如果没有获得ip地址就返回错误
				$this->ajaxReturn(0,"注册ip地址出错,请重启电脑试试",0);	//	
		}
		
	    if ( !(checkVarUniqueNoCompany('user','mail',$mail)) ) {  //判断注册邮箱是否唯一
				 $this->ajaxReturn(0,"该邮箱已经被注册过,可以通过忘记密码的方式来获得这个邮箱注册的登陆信息",0);	//		
		 }
		 
		if ( !checkVarUniqueIp('company','creat_ip',$user_ip,'creat_time',60*10) ) {  //判断ip地址 注册的频繁性限制 10分钟 同一ip地址不能再次注册
				$this->ajaxReturn(0,"错误提示:频繁注册,两次注册的间隔时间是10分钟",0);	//		
		}	
						
		$company_id= get_rand_string(6,5);  //获得一个 没有0,4 的随机数字  随机的机构ID72833
		if ( !checkVarUniqueNoCompany('company','company_id',$company_id) ) {  //判断company_id是否唯一
				$company_id= get_rand_string(6,5);  //获得一个 没有0,4 的随机数字  如果有重复,就第二次再取随机数
				     if ( !checkVarUniqueNoCompany('company','company_id',$company_id) ) {  //判断company_id是否唯一
					      $company_id= get_rand_string(6,5);  //获得一个 没有0,4 的随机数字  如果有重复,就第三次再取随机数
				                 if ( !checkVarUniqueNoCompany('company','company_id',$company_id) ) {  //判断company_id是否唯一 
								         $this->ajaxReturn(0,"注册过程中出现未知的网络错误,请退出软件重新尝试注册",0);	//	三次取的company_id都重复的话,就退出 提示错误
								  }
                      }								  
	    }	
		$branch_id=100000 ;  //分支机构代码 默认总公司是100000		
        $password = get_rand_string(5,5);  //获得一个 没有0,4 的随机数字 	随机密码
		
        M()->startTrans();//开启事务		
		
		$dao = M('Company');  	
		$data['company_id'] = $company_id ;  //随机最多三次生成不能重复的 company_id 机构ID
		$data['branch_id'] = $branch_id ;  //分支机构代码 默认总公司是1000
		$data['username'] = 'admin' ;		
		$data['password'] =  md5($password); 	//随机生成密码
		$data['creat_time'] = time() ;  //注册时间戳 秒
		$data['creat_date'] = date('Y-m-d H:i:s');	  //注册日期
		$data['creat_ip'] = $user_ip ;	//注册ip	
		$data['status'] = '正常' ;	 // '公司账户状态   正常  冻结',  
		$data['last_login_time'] = date('Y-m-d H:i:s');	//最近登录的时间戳 秒  以这个为依据,以后一年没有登陆的账户将被清理 				
		$data['name'] = $name ;
		$data['phone'] = $phone ;
		$data['mail'] = $mail ;
		$data['company_name'] = $company_name ;
	//	$data['company_abbreviation'] = $company_address ;  公司缩写
		$data['company_address'] = $company_address ;		
	//	$data['city'] = $_POST['city'] ;
		$data['lat'] = $lat ;
		$data['lng'] = $lng ;
		$data['zoom_level'] = '12';   //地图缩放等级	
		$data['s_province'] = $s_province ;
		$data['s_city'] = $s_city ; 
		$data['s_county'] = $s_county ;
		$data['select_interval_days'] = 10 ;   //默认 查询默认时间间隔  销售管理  查询销售/售后记录  修改/删除 默认10  
		$data['regular_interval_days'] = 10 ;   //默认 提前几天显示到期的  需要定期维护和回访的时间  默认提前10天显示到期的数据
		$data['map_serviceinterval_days'] = 5 ;		 //默认 查询默认时间间隔  从当天算 显示多少天以后的数据在地图上  售后地图 默认5		

		$dao1 = M('companylog');	//写入日志
		$data1['log_username'] = 'admin' ;		
		$data1['log_time'] = date('Y-m-d H:i:s');	//时间
		$data1['log_ip'] = $user_ip ;	//注册ip						
		$data1['log_content'] = '注册' ;	 // '内容',  
		$data1['log_type'] = '账户' ;	 // 类型   账户或者是登陆 , 
		$data1['company_id'] = $company_id ;  // company_id 机构ID	
        $data1['branch_id'] = $branch_id ;  // 分支机构ID	branch_id		

		$dao2 = M('user');
		$data2['username'] = 'admin' ;		
		$data2['password'] =  md5($password); 	//随机生成密码
		$data2['mail'] = $mail ;
		$data2['group_id'] = '10' ;	  //系统管理员组号
		$data2['realname'] = $name ;		
		$data2['creat_time'] = date('Y-m-d H:i:s');	//时间
		$data2['last_login_time'] = date('Y-m-d H:i:s');	//最近登陆时间
		$data2['status'] = '正常' ;	 // '公司账户状态   正常  冻结', 
		$data2['company_id'] = $company_id ;  // company_id 机构ID	
		$data2['branch_id'] = $branch_id ;  // 分支机构ID	branch_id
		$data2['last_ip'] = $user_ip ;	//注册ip
		$data2['creat_name'] = 'admin' ;	//建立人
		

		$rs2 = $dao2->data($data2)->add();  //写入新用户
		$rs1 = $dao1->data($data1)->add();  //写入登陆日志
		$rs = $dao->data($data)->add();
		
	\Think\Log::write('调试的SQL：'.$dao->getLastSql());  //把最后一句sql写到日志里面去	
	\Think\Log::write('调试的SQL2：'.$dao2->getLastSql());  //把最后一句sql写到日志里面去	
		
		
		
		//开始写初始数据	 放需要初始化的步骤 写一些数据库
			$dao_init1 = M('customfields');  //客户和销售和售后记录自定义字段  customfields
			$data_init1['company_id'] = $company_id ;  //company_id 机构ID
			$data_init1['branch_id'] = $branch_id ;  //分支机构代码 
			$rs_init1 = $dao_init1->data($data_init1)->add();
			
			$dao_init2 = M('indexcount');  //首页统计表
			$data_init2['company_id'] = $company_id ;  //company_id 机构ID
			$data_init2['branch_id'] = $branch_id ;  //分支机构代码 
			$rs_init2 = $dao_init2->data($data_init2)->add();		

			$dao_init3 = M('reportsetup');  //打印机的默认设置 打印份数  横竖
			$data_init3['company_id'] = $company_id ;  //company_id 机构ID
			$data_init3['branch_id'] = $branch_id ;  //分支机构代码 
			$rs_init3 = $dao_init3->data($data_init3)->add();			
			
			$dao_init4 = M('auth_group');  //设置一个超级用户组   系统管理员组
			$data_init4['company_id'] = $company_id ;  //company_id 机构ID
			$data_init4['branch_id'] = $branch_id ;  //分支机构代码 
			$data_init4['group_id'] = 10 ;  //系统管理员组号
			$data_init4['title'] = '系统管理员' ;
			$data_init4['creat_time'] = date('Y-m-d H:i:s');
			$rs_init4 = $dao_init4->data($data_init4)->add();				
	
       	//结束写初始数据 
	\Think\Log::write('调试的$rs：'.json_encode($rs).'    '.json_encode($rs1).'    '.json_encode($rs2).'    '.json_encode($rs_init1).'    '.json_encode($rs_init2).'    '.json_encode($rs_init3).'    '.json_encode($rs_init4));  //把最后一句sql写到日志里面去	
	
		if($rs && $rs1 && $rs2 && $rs_init1 && $rs_init2 && $rs_init3 && $rs_init4){   //成功	
				$result = send_mail( $mail , "云天售后软件注册邮件" , get_mail_body_register( $company_id, 'admin' , $password  ,$name , $phone, $company_name, $company_address ) ); //发送注册邮件 
				if( $result ) {
						M()->commit();//事务提交	
                        //开始写初始化的一些基本数据
					//	$dao_init5 =  new Model();  // 实例化一个model对象 没有对应任何数据表
					    $dao_init5 =  M();  // 实例化一个model对象 没有对应任何数据表

						$sql="INSERT INTO `".C('DB_PREFIX')."group` (`cat_id`, `cat_name`, `parent_id`, `branch_id`, `company_id`)  VALUES ";
                        $sql=$sql."( '".get_rand_string(20,1)."', '客户分组1', '0', ".$branch_id.",".$company_id."),";
						$sql=$sql."( '".get_rand_string(20,1)."', '客户分组2', '0', ".$branch_id.",".$company_id."),";
						$sql=$sql."( '".get_rand_string(20,1)."', '客户分组3', '0', ".$branch_id.",".$company_id.")"	;					
                        $rs_init5=$dao_init5->execute($sql);	//客户分组					

	
						//结束写初始化的一些基本数据
						$this->ajaxReturn(1,'注册成功,注册信息已经发送到'.$mail.'，如果没有收到，请耐心等待一会',1);				    
				 }else{
						M()->rollback();//不成功，回滚					 
						$this->ajaxReturn(0,"注册失败11,请重试",0);	
				 } 								
		 } else{    //失败	
				M()->rollback();//不成功，回滚
				$this->ajaxReturn(0,"注册失败22,请重试",0);					
		 }		  					
       }	
		
	Public function money_info(){	//套餐到期或者超标 付款页面
		$table_head_array = array( array('key'=>"order_number", 'value'=>"订单编号", 'number'=>2  , 'search'=>false   ),									   
							);		
		$i=3 ;	
		$table_head_array[] =  array('key'=>"date_received", 'value'=>"付款日期", 'number'=>$i   , 'search'=>true   ) ; $i=$i+1;	
		$table_head_array[] =  array('key'=>"plan_name", 'value'=>"套餐名称", 'number'=>$i   , 'search'=>true   ) ; $i=$i+1;	
		$table_head_array[] =  array('key'=>"plan_type", 'value'=>"付款类型", 'number'=>$i   , 'search'=>true   ) ; $i=$i+1;	
		$table_head_array[] =  array('key'=>"quantity", 'value'=>"数量", 'number'=>$i   , 'search'=>true   ) ; $i=$i+1;	
		$table_head_array[] =  array('key'=>"price", 'value'=>"单价", 'number'=>$i   , 'search'=>true   ) ; $i=$i+1;	
		$table_head_array[] =  array('key'=>"money", 'value'=>"金额", 'number'=>$i   , 'search'=>true   ) ; $i=$i+1;
		$table_head_array[] =  array('key'=>"buy_way", 'value'=>"付款方式", 'number'=>$i   , 'search'=>true   ) ; $i=$i+1;	
		$table_head_array[] =  array('key'=>"date_planbegin", 'value'=>"套餐开始", 'number'=>$i   , 'search'=>true   ) ; $i=$i+1;	
		$table_head_array[] =  array('key'=>"date_planend", 'value'=>"套餐截至", 'number'=>$i   , 'search'=>true   ) ; $i=$i+1;		
		
	
		$this->assign("table_head", $table_head_array); //表头循环变量	

		$dao = M("admin_money");
		// import("@.ORG.Page");  //3.1.3       //导入分页类
		$map['a.company_id'] = $_SESSION['company_id'];   // 查询记录 限定在本公司id里面		
		$list=$dao	
			->alias('a')
			->field(array('a.order_number','a.plan_id','a.plan_type','a.quantity','a.price','a.money','a.date_planbegin','a.date_planend','a.date_received','a.buy_way',
						  'a.memo',
						  'b.plan_name ','b.count_record'))							  
			->join( C('DB_PREFIX') . 'admin_price AS b ON a.plan_id = b.plan_id ' )				
			->where($map)			
			->order('a.creat_time DESC '  )  
			->select();	
		$this->assign("recordlist", $list); //数据循环变量		
		if (  $_SESSION['plan_date'] < date('Y-m-d') ) {
		   	$this->assign("text", '套餐过期，软件目前处于暂停使用状态'); 	
		}
		if ( (int)$_SESSION['count_total'] >  (int)$_SESSION['plan_count'] ) {
		   	$this->assign("text", '数据使用量超出套餐容量，软件目前处于暂停使用状态'); 	
		}	
		$this->assign("flag", trim($_GET['flag'])); 	
        $this->display();		
	}
}
