
var timeout=15000; //  超时时间  15秒
/* 时间控件变量开始 */
var opt={}; //时间控件
var currYear = (new Date()).getFullYear();	
	opt.date = {preset : 'date'};
	opt.datetime = {preset : 'datetime'};
	opt.time = {preset : 'time'};
	opt.default = {
		theme: 'android-ics light', //皮肤样式
		display: 'modal', //显示方式 
		mode: 'scroller', //日期选择模式
		dateFormat: 'yy-mm-dd',
		lang: 'zh',
		showNow: true,
		nowText: "今天",
		startYear: currYear - 10, //开始年份
		endYear: currYear + 10 //结束年份
     };
/* 时间控件变量结束*/

function YTajax_nextpage(ajax_url){   //ajax 加载数据翻页
    YTajax_open_ajaxsavedata_form() ; //打开ajax保存数据的  遮罩	
	$.ajax({
		   type: "POST",
		   url: ajax_url, 
		   timeout:timeout,
		   data:  {firstRow: $("#firstRow").val()},
		   dataType: "json",
		   success: function(json){	
		       YTajax_close_ajaxsavedata_form() ;   //关闭ajax保存数据的  遮罩
			   var info = json.data;
			   if (json.status==1) {  //读数据成功
				  $("#total_record").html(info.total_record);  //总记录数量	
				  $("#others_record").html(info.others_record);  //剩余记录	
				  $("#firstRow").val(info.firstRow);  //下一条记录的首记录	
				  $("#data_body").append(info.info);
				  if ( info.others_record !=0) { 
					 $("#hint_txt").html('查看更多');  //操作提示	
				  } else {
					 $("#hint_txt").html('到底了');  //操作提示
					 $('#btn_continue').attr('onclick', '')						 
				  }
			   }
			   else{  //读数据出错啦
					$("#data_body").html(info.info);  //加载数据	
					$("#bar_continue").hide(); //关闭继续加载按钮
			   }				   
		   },
		   error:function(XMLHttpRequest, textStatus, errorThrown){
			 YTajax_close_ajaxsavedata_form() ;   //关闭ajax保存数据的  遮罩   
			 var str="<div class='card content-padded yt_margintop5 '>";
				 str=str+"<p></p>&nbsp;加载数据错误，请刷新重试<p></p>";
				 str=str+"</div >";	
				 $("#data_body").html(str);  //加载数据	
				 $("#bar_continue").hide(); //关闭继续加载按钮					 
		   }	 
		});		
}

function YTajax_FileUpload(parent_id)  {   	
	    var image_desc = replaceEscape($("#upload_image_desc").val()), //把双引号等做过滤和替换 ，替换 ;   
		    flag = $("#flag").val(), //上传的图片的类型 1：公司的图片 2：客户的图片 3：售后订单的图片
			uploadurl=$("#url_url").val()+'/upload/';
		    YTajax_open_ajaxsavedata_form() ; //打开ajax保存数据的  遮罩		
			$.ajaxFileUpload
			(
				{
					url:uploadurl,//用于文件上传的服务器端请求地址
					secureuri:false,//一般设置为false
					fileElementId:'file',//文件上传空间的id属性  <input type="file" id="file" name="file" />
					dataType: 'json',//返回值类型 一般设置为json
					data:{image_desc:image_desc, flag:flag, parent_id:parent_id},   // data: "image_desc="+image_desc+",parent_guid="+parent_guid,// data:{image_desc:'image_desc'}, //parent_guid:'parent_guid'},  //data: "image_desc="+image_desc+",parent_guid="+parent_guid,   //data:{image_desc:'logan', id:'id'},   //	data:{name:'logan', id:'id'},  //传递一个描述和商品唯一id号
					success: function(data){
					YTajax_close_ajaxsavedata_form() ;   //关闭ajax保存数据的  遮罩
					 if (data.status==1) {  
						//    layer.alert('上传成功');
						    window.open('YT_refresh');  //刷新网页				  			  
					 }
					 else{  
						 layer.alert('上传失败：'+data.info, {icon: 2});
						 return false;
					 }		   
				   },			   
				   error:function(XMLHttpRequest, textStatus, errorThrown){
						YTajax_close_ajaxsavedata_form() ;   //关闭ajax保存数据的  遮罩
						//alert('超时或其它未知的错误,请重试');
						layer.alert('未知错误,请重试', {icon: 2});
						return false;							
				   }				   
				}
			)
}

function YTajax_delimage(id,image_name,parent_id){   //删除图片
	layer.confirm('确认要删除选中的图片？',  {
							skin: 'layui-layer-molv' //样式类名
							,closeBtn: 0,btn: ['是','否'],title: ['提示', 'font-size:18px;'] //按钮
					    },
	  function(){
		 var delurl=$("#url_url").val()+'/ajaxdel';	
		 YTajax_open_ajaxsavedata_form() ; //打开ajax保存数据的  遮罩	
		 $.ajax({
			   type: "POST",
			   url: delurl,   
			   data: {id:id, parent_id:parent_id,image_name:image_name}, 
			   dataType: "json",
			   success: function(json){
				 YTajax_close_ajaxsavedata_form() ;   //关闭ajax保存数据的  遮罩  
				 if (json.status==1) {  //删除成功
					 // alert('删除成功');
					 // layer.alert('删除成功');					  
					  window.open('YT_refresh');  //刷新网页					
				 }
				 else{  //删数据出错啦
					  layer.alert('删除图片失败：'+json.info, {icon: 2});			
				 }		   
			   },			   
				   error:function(XMLHttpRequest, textStatus, errorThrown){
						YTajax_close_ajaxsavedata_form() ;   //关闭ajax保存数据的  遮罩
						layer.alert('未知错误,请重试', {icon: 2});	
						return false;		
				   }	
			});	
	});  

}

function YTajax_submit(ajax_url,ajax_date,flag){   //ajax 提交数据
    YTajax_open_ajaxsavedata_form() ; //打开ajax保存数据的  遮罩	
	$.ajax({
		   type: "POST",
		   url: ajax_url, 
		   timeout:timeout,
		   data:  ajax_date,
		   dataType: "json",
		   success: function(json){
		     YTajax_close_ajaxsavedata_form() ;   //关闭ajax保存数据的  遮罩  
             if (json.status==1) {  //读数据成功
				// layer.alert('数据操作成功');
			//	alert('这是最常用的吧');
				if ( flag==1 ) {  //直接刷新			
					window.open('YT_refresh');  //刷新网页
				} else  if ( flag==2 ) {  //询问是否继续添加				
						layer.confirm('备件添加成功,继续添加？', {
							skin: 'layui-layer-molv' //样式类名
							,closeBtn: 0,btn: ['是','否'],title: ['提示', 'font-size:18px;'] //按钮
					    }, function(){
							 window.open('YT_refresh');  //刷新网页	
						}, function(){
							window.open('YT_backandreload');  //退出当前页面 并且刷新上一级页面	
						});		
				} else if ( flag==3 ) {
					 window.open( YTapp+'/Mobilemenu/workemenu/YT_login_ok'+json.info);  //  登录成功 转    YT_login_ok
				} else if ( flag==4 ) {  //提示成功 然后什么都不做
					 layer.alert(json.info);
				}else if ( flag==5 ) {  //退出当前页面 并且刷新上一级页面	
					 window.open('YT_backandreload');  //退出当前页面 并且刷新上一级页面	
				}
			 }
			 else{  //读数据出错啦
				var str=json.info.toString().replace(/[\\n]/g,"<br>")
				layer.alert(str, {icon: 2}); 
			 }		   
		   },
 		   error:function(XMLHttpRequest, textStatus, errorThrown){
					YTajax_close_ajaxsavedata_form() ;   //关闭ajax保存数据的  遮罩  
					layer.alert('未知错误,请刷新重试', {icon: 2});
					return false;	
		   }	 
		});		
}

function YTmodal_selectgoodstype( cat_id,cat_name )	{   //  选择商品种类 非查询类 添加维修备件使用
		var  ajaxurl=YTapp+'/Util/util_findgoods';	  //查询商品
		var  goods_type=trim(cat_id);	  //商品分类的guid
		YTajax_open_ajaxsavedata_form() ; //打开ajax保存数据的  遮罩						
		$.ajax({
				type: "POST",
				url: ajaxurl,
				timeout:timeout,
				data:  {type_id:goods_type},
				dataType: "json",
				success: function(json){
				   YTajax_close_ajaxsavedata_form() ;   //关闭ajax保存数据的  遮罩  
				   if(json.status==1){  //写数据成功
                      var info = json.data;	
                      var str='',str1="<li class='table-view-cell yt_padding10 ' onClick=' YTmodal_selectgoodsname" ,	str2="'"	;							  
					   for(var   i=0;i <info.length;i++) {
						   str=str+ str1+' (" '+ info[i]['guid'] + '", "'+  info[i]['name'] +'"  )'+str2+ '   >' + info[i]['name'] +'，'+info[i]['unit']+'，'+info[i]['price']+'</li>';	  		
						}
                        $("#modal_goodsnamelist").html(str);

                        $("#goods_type_id").val(goods_type);						
						cat_name = trim( ( cat_name ).replace("├", "") ) ;  //去掉 ├
						$("#goods_type").val(cat_name);	//商品分类 赋值	
                        $("#goods_name").val('');	//初始化商品名称
                        $("#goods_unit").val('');
					//	$("#goods_memo").val('');												
						YTmodal_openorclose( $('#modal_goodstype') )  //关闭商品分类的modal 
						YTmodal_openorclose( $('#modal_goodsname') )   //打开商品名称的modal						
					}
					else{  //读数据出错啦
					  layer.alert(json.info, {icon: 2});
					}
				},
				error:function(XMLHttpRequest, textStatus, errorThrown){
					YTajax_close_ajaxsavedata_form() ;   //关闭ajax保存数据的  遮罩  
					layer.alert('未知错误,请刷新重试', {icon: 2});
				}							
		});					 
};

function YTmodal_selectgoodstype1( cat_id,cat_name )	{   //  选择商品种类  查询  使用  添加了全部商品的选项
        if (trim(cat_id)=='1')  {  //选择的是全部分类
			$("#modal_goodsnamelist").html('');
			$("#goods_type_id").val('1');						
			$("#goods_type").val('全部分类');	//商品分类 赋值	
			$("#goods_name_id").val('1');	
			$("#goods_name").val('全部商品');	//初始化商品名称
			YTmodal_openorclose( $('#modal_goodstype') )  //关闭商品分类的modal 	
            return;			
		}
		
		var  ajaxurl=YTapp+'/Util/util_findgoods';	  //查询商品
		var  goods_type=trim(cat_id);	  //商品分类的guid
		YTajax_open_ajaxsavedata_form() ; //打开ajax保存数据的  遮罩						
		$.ajax({
				type: "POST",
				url: ajaxurl,
				timeout:timeout,
				data:  {type_id:goods_type},
				dataType: "json",
				success: function(json){
				   YTajax_close_ajaxsavedata_form() ;   //关闭ajax保存数据的  遮罩  
				   if(json.status==1){  //写数据成功
                      var info = json.data;	
                      var str='',str1="<li class='table-view-cell yt_padding10 ' onClick=' YTmodal_selectgoodsname" ,	str2="'"	;	
						  str=str+ str1+' ("1", "全部商品"  )'+str2+ '   >全部商品</li>';	 						  
					   for(var   i=0;i <info.length;i++) {
						   str=str+ str1+' (" '+ info[i]['guid'] + '", "'+  info[i]['name'] +'"  )'+str2+ '   >' + info[i]['name'] +'，'+info[i]['unit']+'，'+info[i]['price']+'</li>';	  		
						}
						

                        $("#modal_goodsnamelist").html(str);

                        $("#goods_type_id").val(goods_type);						
						cat_name = trim( ( cat_name ).replace("├", "") ) ;  //去掉 ├
						$("#goods_type").val(cat_name);	//商品分类 赋值	
						$("#goods_name_id").val('1');	
						$("#goods_name").val('全部商品');	//初始化商品名称						
                        $("#goods_unit").val('');
					//	$("#goods_memo").val('');												
						YTmodal_openorclose( $('#modal_goodstype') )  //关闭商品分类的modal 
						YTmodal_openorclose( $('#modal_goodsname') )   //打开商品名称的modal						
					}
					else{  //读数据出错啦
					  layer.alert(json.info, {icon: 2});
					}
				},
				error:function(XMLHttpRequest, textStatus, errorThrown){
					YTajax_close_ajaxsavedata_form() ;   //关闭ajax保存数据的  遮罩  
					layer.alert('未知错误,请刷新重试', {icon: 2});
				}							
		});					 
};


function YTmodal_selectgoodsname(goods_guid,goods_name){  //选择商品名称 联动  商品描述说明字段

        if ( trim(goods_guid) == '1')  {  //选择的是全部商品  用于查询库存
			$("#goods_name_id").val('1');	
			$("#goods_name").val('全部商品');	//初始化商品名称
			YTmodal_openorclose( $('#modal_goodsname') )  //关闭商品名称的modal 	
            return;			
		}

		var  ajaxurl=YTapp+'/Util/util_findgoodsmemo';	  //查询商品描述说明字段
	         goods_guid=trim(goods_guid);;	  //商品名称的guid	

		YTajax_open_ajaxsavedata_form() ; //打开ajax保存数据的  遮罩					
		$.ajax({
				type: "POST",
				url: ajaxurl,
				timeout:timeout,
				data:  {guid:goods_guid},
				dataType: "json",
				success: function(json){
				   YTajax_close_ajaxsavedata_form() ;   //关闭ajax保存数据的  遮罩  
				   if(json.status==1){  //读数据成功
                      var info = json.data;	
					  						  
					  $("#goods_unit").val("");	  //计量单位
					  $("#goods_unit").val(info['unit']);	
											  
					  $("#property").val("");	  //商品属性
					  $("#property").val(info['property']);		
					  
				//	  $("#goods_memo").val("");	  //商品配置和描述
				//	  $("#goods_memo").val(info['description']);
					  
					  $("#goods_unitprice").val("");	  //单价
					  $("#goods_unitprice").val(info['price']);	
					  $("#goods_unitprice").change();
					  
					  $("#goods_name_id").val(goods_guid);
					  $("#goods_name").val(goods_name);	//商品名称 赋值	
					  
                      YTmodal_openorclose( $('#modal_goodsname') )   //关闭商品名称的modal	
		  
					}
					else{  //读数据出错啦
					  layer.alert(json.info, {icon: 2});
					}
				},
				error:function(XMLHttpRequest, textStatus, errorThrown){
					YTajax_close_ajaxsavedata_form() ;   //关闭ajax保存数据的  遮罩  
					layer.alert('未知错误,请刷新重试', {icon: 2});
				}							
		});	
}


function YTajax_open_ajaxsavedata_form(){   //打开ajax保存数据的  遮罩
	$.blockUI({ 
		message: '数据处理中,请耐心等待...', 
		css: { 
			border: 'none', 
			padding: '15px', 
			backgroundColor: '#000', 
			'-webkit-border-radius': '10px', 
			'-moz-border-radius': '10px', 
			opacity: .5, 
			top:  ($(window).height() - 250) /2 + 'px', 
			left: ($(window).width() - 250) /2 + 'px', 
			width: '250px',
			color: '#fff' 
		}
	}); 
}

function YTajax_close_ajaxsavedata_form(){   //关闭ajax保存数据的  遮罩
   $.unblockUI();  
}

function YTmodal_openorclose( modal )	{   //  打开或者关闭 modal 是 obj 对象 如果是关闭状态 就会自动打开 如果是打开状态就会自动关闭
  modal.toggleClass("active") ; 
// window.open('YT_backandreload');  //刷新网页				
};

function YTmodal_openselectgoodsname( modal )	{   //  打开或者关闭 modal 是 obj 对象 如果是关闭状态 就会自动打开 如果是打开状态就会自动关闭
   if ( ( trim( $("#goods_type").val() ) =='' ) || ( trim( $("#goods_type").val() ) =='全部分类' ) ){
	  layer.alert('请先选择商品分类', {icon: 5}); 
	  return;
   }
   YTmodal_openorclose( modal ) 
};


function YTmobile_checkEmpty( o , n ) {   // 弹出添加 修改数据框 提交前做 空 验证 
	if ( trim(o.val()).length < 1 ) {
			layer.alert( n + " 不能为空 ", {icon: 2});

			
			//alert( n + " 不能为空 " );
			return false;
	} else {
			return true;
	}	
}

function YTmobile_checkRegexp( o, regexp, n ) {     // 弹出添加 修改数据框 提交前做正则表达式验证 
		if ( !( regexp.test( trim(o.val()) ) ) ) {
		    if ( n.length>0 ) {
				layer.alert( n , {icon: 2});
			}			
			return false;
		} else {
			return true;
		}
}

function YTmobile_getServicesSelectUrl()  {   //得到售后统计条件的url售后订单查询或者统计
  var url = '/date_begin/'+$("#date_begin").val()+'/date_end/'+$("#date_end").val();  //起始截至日期
      url=url+'/date_type/'+$('input:radio[name="data_type"]:checked').val();	//日期类型  
	  url=url+'/status/'+$("#status").val();	//订单状态
	  url=url+'/service_staff/'+$("#service_staff").val();	//售后人员
	return url;	  
} ;	


function YTmobile_getSalesSelectUrl()  {   //得到销售统计条件的url销售订单查询或者统计
  var url = '/date_begin/'+$("#date_begin").val()+'/date_end/'+$("#date_end").val();  //起始截至日期
      url=url+'/date_type/'+$('input:radio[name="data_type"]:checked').val();	//日期类型  
	  url=url+'/status/'+$("#status").val();	//订单状态
	return url;	  
} ;	


function YTmobile_getStockSelectUrl()  {   //得到当前库存统计条件的url库存查询
  var url = '/goods_type/'+$("#goods_type").val()+'/goods_type_id/'+$("#goods_type_id").val();  //商品分类
      url =url+ '/goods_name/'+$("#goods_name").val()+'/goods_name_id/'+$("#goods_name_id").val();  //商品分类
  return url;	  
} ;	

function YTmobile_getFactorySelectUrl()  {   //得到返厂维修 条件的url
  var url = '/date_begin/'+$("#date_begin").val()+'/date_end/'+$("#date_end").val();  //起始截至日期  
	  url=url+'/status/'+$("#status").val();	//订单状态
	return url;	  
} ;	

function YTmobile_getStockservicestaffSelectUrl()  {   //得到领料 退料 条件的url
  var url = '/date_begin/'+$("#date_begin").val()+'/date_end/'+$("#date_end").val();  //起始截至日期
	  url=url+'/flag/'+$("#flag").val();	//1：领料   3：退料
	  url=url+'/close/'+$("#close").val();	//yes:售后人员查询  空：管理人员查询
	  url=url+'/service_staff/'+$("#service_staff").val();	//售后人员
	return url;	  
} ;	

function YTmobile_getCustomerSelectUrl()  {   //查询客户 条件的url
  var url='/searchkey/'+$("#searchkey").val();	
	  url=url+'/searchvalue/'+$("#searchvalue").val();	
	  url=url+'/searchtxt/'+trim($("#searchtxt").val());	
	return url;	  
} ;

/*
$(function () {  //移动手机 时间插件 
		var currYear = (new Date()).getFullYear();	
		var opt={};
		opt.date = {preset : 'date'};
		opt.datetime = {preset : 'datetime'};
		opt.time = {preset : 'time'};
		opt.default = {
			theme: 'android-ics light', //皮肤样式
			display: 'modal', //显示方式 
			mode: 'scroller', //日期选择模式
			dateFormat: 'yyyy-mm-dd',
			lang: 'zh',
			showNow: true,
			nowText: "今天",
			startYear: currYear - 10, //开始年份
			endYear: currYear + 10 //结束年份
		};

		$("#appDate").mobiscroll($.extend(opt['date'], opt['default']));
		var optDateTime = $.extend(opt['datetime'], opt['default']);
		var optTime = $.extend(opt['time'], opt['default']);
		$("#appDateTime").mobiscroll(optDateTime).datetime(optDateTime);
		$("#date_arrival").mobiscroll(optDateTime).datetime(optDateTime);
		$("#appTime").mobiscroll(optTime).time(optTime);
	});	
*/

function YTmobile_dologin()	{   //  登录
	var ajaxdataArray = new Array();					
		ajaxdataArray.push(['username']);
		ajaxdataArray.push([trim(  $("#username").val() )]);	
		ajaxdataArray.push(['password']);
		ajaxdataArray.push([trim(  $("#password").val() )]);	
		ajaxdataArray.push(['companyid']);
		ajaxdataArray.push([trim(  $("#companyid").val() )]);	
		ajaxdataArray.push(['remember']);
		ajaxdataArray.push([document.getElementById("remember").checked]);	
		ajaxdataArray.push(['authcode']);
		ajaxdataArray.push(['YTmobile_dologin']);					
	//layer.alert(arrTojson( ajaxdataArray ) , {icon: 2});	
	var data=jQuery.parseJSON(arrTojson( ajaxdataArray ))  ; 
	var url=YTapp+'/User/dologin/';
	var flag=3;  //3：登录
	YTajax_submit(url,data,flag)  ;	
};

function YTmobile_loginToggle()	{   //开关 登录界面 是否显示密码
	if (document.getElementById("loginToggle").className.indexOf("active") > 0 ){
		document.getElementById("password").type = 'text';
	}
	else
	{
	   document.getElementById("password").type = 'password';
	}
}

function YTmobile_doforgetpassword()	{   //  忘了密码
	var ajaxdataArray = new Array();					
		ajaxdataArray.push(['email']);
		ajaxdataArray.push([trim(  $("#email").val() )]);	
		ajaxdataArray.push(['authcode']);
		ajaxdataArray.push(['YTmobile_dologin']);					
	//layer.alert(arrTojson( ajaxdataArray ) , {icon: 2});	
	var data=jQuery.parseJSON(arrTojson( ajaxdataArray ))  ; 
	var url=YTapp+'/User/doforget/';
	var flag=4;  //4：什么都不做 提示成功
	YTajax_submit(url,data,flag)  ;	

};

function YTmobile_customermap(lat,lng)	{   //查询客户地图
  window.open( YTapp+'/Mobileservicestaff/mobileutil_customer_map/lat/'+lat+'/lng/'+lng+'/reload/close');  
};  

function YTmobile_editimage(guid,flag)	{   //图片管理      显示 编辑  上传  删除等操作   flag  2：客户的图片 3：售后订单的图片 4:销售图片  
  window.open( YTapp+'/Showimages/mobile_show_image/guid/'+guid+'/flag/'+flag);  //调用 pc端的图形处理  show_image
};

function YTmobile_openimage(guid,flag,status)	{   //显示图片      显示 编辑  上传  删除等操作   flag  2：客户的图片 3：售后订单的图片 4:销售图片  
  window.open( YTapp+'/Showimages/mobile_show_image/guid/'+guid+'/flag/'+flag+'/status/'+status);  //调用 pc端的图形处理  show_image
};

function YTmobile_arrival(guid) {    // 我已经到服务现场
	layer.confirm('已经到服务现场 ？', {
							skin: 'layui-layer-molv' //样式类名
							,closeBtn: 0,btn: ['是','否'],title: ['提示', 'font-size:18px;'] //按钮
					    }, function(){
         var ajaxdataArray = new Array();	
			 ajaxdataArray.push(['guid']);
			 ajaxdataArray.push([guid]);	 
	    var data=jQuery.parseJSON(arrTojson( ajaxdataArray ))  ; 
		var url=YTapp+'/Mobileservicestaff/workingorder_arrivalsave/';
		var flag=1;  //刷新当前页
		YTajax_submit(url,data,flag)  ;	
	});  

}

function YTmobile_completedinfo1(guid)	{   //录入故障解决   售后已经完成，开始录入售后数据
   layer.prompt({title: '请输入故障解决方法(必须填)，并确认',closeBtn: false, formType: 2}, function(text){
        var str=replaceEscape(trim(text)) ;
		if  ( str=='' ) {
			layer.alert('错误：故障解决方法不能为空', {icon: 2});
		} else  {
			var ajaxdataArray = new Array();	
				 ajaxdataArray.push(['guid']);
				 ajaxdataArray.push([guid]);	 
				 ajaxdataArray.push(['service_solution']);  //故障解决方法
				 ajaxdataArray.push([str]);					 
			var data=jQuery.parseJSON(arrTojson( ajaxdataArray ))  ; 
			var url=YTapp+'/Mobileservicestaff/workingorder_completedsave1/';
			var flag=1;  //刷新当前页
			YTajax_submit(url,data,flag)  ;			
		}
    });
};	

function YTmobile_completedinfo2(guid)	{   //售后完成，数据录入完成，确认	
	layer.confirm('售后完成，数据录入完成 ？', {
							skin: 'layui-layer-molv' //样式类名
							,closeBtn: 0,btn: ['是','否'],title: ['提示', 'font-size:18px;'] //按钮
					    }, function(){
         var ajaxdataArray = new Array();	
			 ajaxdataArray.push(['guid']);
			 ajaxdataArray.push([guid]);	 
	    var data=jQuery.parseJSON(arrTojson( ajaxdataArray ))  ; 
		var url=YTapp+'/Mobileservicestaff/workingorder_completedsave2/';
		var flag=5;  //退出当前页面 并且刷新上一级页面	
		YTajax_submit(url,data,flag)  ;	
	});  	
};	

function YTmobile_changeservicesolution(txt,guid) {    // 修改故障解决
   layer.prompt({title: '修改故障解决方法', closeBtn: false, formType: 2,value: txt}, function(text){
        var str=replaceEscape(trim(text)) ;
		if  ( str=='' ) {
			layer.alert('错误：故障解决方法不能为空', {icon: 2});
		} else  {
			//layer.alert(text);
			var ajaxdataArray = new Array();	
				 ajaxdataArray.push(['guid']);
				 ajaxdataArray.push([guid]);	 
				 ajaxdataArray.push(['service_solution']);  //故障解决方法
				 ajaxdataArray.push([str]);					 
			var data=jQuery.parseJSON(arrTojson( ajaxdataArray ))  ; 
			var url=YTapp+'/Mobileservicestaff/workingorder_changeservicesolutionsave/';
			var flag=1;
			YTajax_submit(url,data,flag)  ;			
		}
    });
}

function YTmobile_addservicegoods(guid)	{   //  添加维修备件
  window.open( YTapp+'/Mobileservicestaff/workingorder_addservicegoods/guid/'+guid+'/reload/close');  //添加维修备件
};

function YTmodal_changegoodsmemo() {    // 维修更换备件备注 编辑
   layer.prompt({title: '维修更换备件备注', closeBtn: false,formType: 2,value: $("#goods_memo").val()} , 
    function(text, index, layero){ //或者使用btn1
        //按钮【按钮一】的回调
         $("#goods_memo").val(replaceEscape(trim(text)));
		 layer.close(index);		
    });
}

function YTmobile_addservicegoods_submit(guid) {    // 添加维修备件 确认按钮
	 var checkvalid = true;
		   checkvalid = checkvalid && YTmobile_checkEmpty( $( "#goods_type" ) , "商品分类" ) ;
		   checkvalid = checkvalid && YTmobile_checkEmpty( $( "#goods_name" ) , "商品名称" ) ;	   
		   checkvalid = checkvalid && YTmobile_checkEmpty( $( "#goods_unit" ) , "单位" ) ;			 		 
		   checkvalid = checkvalid && YTmobile_checkRegexp( $( "#goods_quantity" ) ,/^-?[1-9]\d*$/,"数量必须是整数" ) ;	
		   checkvalid = checkvalid && YTmobile_checkRegexp( $( "#goods_unitprice" ) , /^[(\-|\+)\d|\.]+$/,"单价必须是有效的数字" ) ;	
		   checkvalid = checkvalid && YTmobile_checkRegexp( $( "#goods_money" ) , /^[(\-|\+)\d|\.]+$/,"金额必须是有效的数字" ) ;	
	 if (checkvalid) {	
		   var str="[{";	 
			 str=str+"'goods_name':'"+ trim( $("#goods_name").val() ) + "',";
			 str=str+"'goods_name_id':'"+ trim( $("#goods_name_id").val() )  + "',";
			 str=str+"'goods_type':'"+ trim( $("#goods_type").val() )  + "',";
			 str=str+"'goods_type_id':'"+ trim( $("#goods_type_id").val() )  + "',";
			 str=str+"'goods_unit':'"+ trim( $("#goods_unit").val() )  + "',";
			 str=str+"'goods_quantity':'"+ trim( $("#goods_quantity").val() )  + "',";
			 str=str+"'goods_unitprice':'"+ trim( $("#goods_unitprice").val() )  + "',";
			 str=str+"'goods_money':'"+ trim( $("#goods_money").val() )  + "',";	
			 str=str+"'goods_memo':'"+ replaceEscape( trim( $("#goods_memo").val() ) )  +  "',";	
			 str=str+"'property':'"+ trim(  $("#property").val() )  + "'"; 
			 str=str+"}]";	

			var ajaxdataArray = new Array();					
				ajaxdataArray.push(['guid']);
				ajaxdataArray.push([guid]);	
				ajaxdataArray.push(['goods_json']);
				ajaxdataArray.push([str]);						 					 
			var data=jQuery.parseJSON(arrTojson( ajaxdataArray ))  ; 
			var url=YTapp+'/Mobileservicestaff/workingorder_addservicegoodssave/';
			var flag=2;
			YTajax_submit(url,data,flag)  ;						  
	 }		
}  

function YTmobile_delservicegoods(guid)	{   //  删除维修备件
	layer.confirm('确认要删除维修备件？',  {
							skin: 'layui-layer-molv' //样式类名
							,closeBtn: 0,btn: ['是','否'],title: ['提示', 'font-size:18px;'] //按钮
					    },
	  function(){
			var ajaxdataArray = new Array();					
				ajaxdataArray.push(['guid']);
				ajaxdataArray.push([guid]);						 					 
			var data=jQuery.parseJSON(arrTojson( ajaxdataArray ))  ; 
			var url=YTapp+'/Mobileservicestaff/workingorder_delservicegoodssave/';
			var flag=1;
			YTajax_submit(url,data,flag)  ;	
	});  
};

function YTmobile_otherserviceinfo(guid)	{   //  修改其他资料
  window.open( YTapp+'/Mobileservicestaff/workingorder_otherserviceinfo/guid/'+guid+'/reload/close');  // 修改其他资料
};

function YTmobile_otherserviceinfo_submit(guid) {    // 修改其他资料 确认按钮
			var ajaxdataArray = new Array();					
				ajaxdataArray.push(['guid']);
				ajaxdataArray.push([guid]);	
				ajaxdataArray.push(['record_field1']);
				ajaxdataArray.push([trim(  $("#record_field1").val() )]);	
				ajaxdataArray.push(['record_field2']);
				ajaxdataArray.push([trim(  $("#record_field2").val() )]);	
				ajaxdataArray.push(['record_field3']);
				ajaxdataArray.push([trim(  $("#record_field3").val() )]);					
				ajaxdataArray.push(['record_field4']);
				ajaxdataArray.push([trim(  $("#record_field4").val() )]);	
				ajaxdataArray.push(['record_field5']);
				ajaxdataArray.push([trim(  $("#record_field5").val() )]);					
				ajaxdataArray.push(['record_field6']);
				ajaxdataArray.push([trim(  $("#record_field6").val() )]);	
				ajaxdataArray.push(['record_field7']);
				ajaxdataArray.push([trim(  $("#record_field7").val() )]);	
				ajaxdataArray.push(['record_field8']);
				ajaxdataArray.push([trim(  $("#record_field8").val() )]);					
				ajaxdataArray.push(['record_field9']);
				ajaxdataArray.push([trim(  $("#record_field9").val() )]);	
				ajaxdataArray.push(['record_field10']);
				ajaxdataArray.push([trim(  $("#record_field10").val() )]);		
				ajaxdataArray.push(['service_feedback']);
				ajaxdataArray.push([trim(  $("#service_feedback").val() )]);					
			var data=jQuery.parseJSON(arrTojson( ajaxdataArray ))  ; 
			var url=YTapp+'/Mobileservicestaff/workingorder_otherserviceinfosave/';
			var flag=5;//退出当前页面 并且刷新上一级页面	
			YTajax_submit(url,data,flag)  ;						  
} 


function YTmobile_showDateBeginEnd(days) { //设置 起始截至日期
   if  ( days=='a' ) {  //本月        
		var d=new Date();
		d.setDate( 1 ); 
		$("#date_begin").val(d.Format("yyyy-MM-dd"));  //设置开始日期 
   } else 	if  ( days=='b' ) {  //本季度   
		var year=new Date().getFullYear();
		var month=new Date().getMonth();
		var season=parseInt(month/3)+1;
		var d=new Date(year+"-"+(3*(season-1)+1)+"-01");
		$("#date_begin").val(d.Format("yyyy-MM-dd"));  //设置开始日期 
   } else 	if  ( days=='c' ) {  //本年
		var year=new Date().getFullYear();
		var d=new Date(year+"-01-01");
		$("#date_begin").val(d.Format("yyyy-MM-dd"));  //设置开始日期    
   } else {
	   $("#date_end").val(new Date().Format("yyyy-MM-dd"));  //设置截至日期
		var d=new Date();
		d.setDate(d.getDate()-days*1 ); 
		$("#date_begin").val(d.Format("yyyy-MM-dd"));  //设置开始日期		   
   }
   
   $("#date_end").val(new Date().Format("yyyy-MM-dd"));  //设置截至日期
   YTmodal_openorclose( $('#modal_selectdaterange') ) ;  //关闭选择界面
}

function YTmodal_serviceorder_selectstatus(status) {  //设置售后订单状态
   $("#status").val(status);  //售后订单状态
   YTmodal_openorclose( $('#modal_selectstatus') ) ;  //关闭选择界面
}

function YTmodal_serviceorder_selectservicestaff(service_staff) {  //设置售后人员
   $("#service_staff").val(service_staff);  //售后人员
   YTmodal_openorclose( $('#modal_selectservicestaff') ) ;  //关闭选择界面
}

function YTmodal_openmodal( modal )	{   //  打开modal  并且关闭刷新
   YTmodal_openorclose( modal )
   window.open('YT_closerefresh');  //关闭下拉刷新网页	
			
};

function YTmodal_closemodal( modal )	{   //  关闭 modal 打开刷新
  YTmodal_openorclose( modal )	;
  window.open('YT_openrefresh');  //打开下拉刷新网页	 
};

function YTmobile_selectservicerecord_ajax()	{   //  ajax方式 查询售后记录
  	var url = YTmobile_getServicesSelectUrl() ;
	YTajax_nextpage(YTapp+'/Mobileserviceorder/ajax_serviceorder_list'+url);	
};

function YTmobile_selectservicerecord()	{   //  查询售后记录
  	var url = YTmobile_getServicesSelectUrl() ;
	window.open(YTapp+'/Mobileserviceorder/serviceorder_list'+url+'/YT_urlrefresh');	//订单状态;		YT_urlrefresh 通知安卓客户端 刷新本页面 用本页面代替原来的url
};

function YTmobile_selectservicerecord1(url)	{   //  查询售后记录  从售后人员地图那里过来的查询
	window.open(YTapp+'/Mobileserviceorder/serviceorder_list'+url+'');	//订单状态;		YT_urlrefresh 通知安卓客户端 刷新本页面 用本页面代替原来的url
};

function YTmobile_serviceorderprocess_info( order_guid,order_number )	{   //售后订单追踪
  window.open( YTapp+'/Mobileutil/serviceorderprocess_info/order_guid/'+order_guid+'/order_number/'+order_number);
};


function YTmobile_dispatch( order_guid)	{   //派工
  window.open( YTapp+'/Mobileserviceorder/serviceorder_dispatch/order_guid/'+order_guid);
};

function YTmobile_dispatch_submit(guid,name) {    // 派工 确认按钮
	layer.confirm('确认派工-->'+name+'？',  {
							skin: 'layui-layer-molv' //样式类名
							,closeBtn: 0,btn: ['是','否'],title: ['提示', 'font-size:18px;'] //按钮
					    },
	  function(){
		  
		//   layer.alert('错误：故障解决方法不能为空', {icon: 2});
			var ajaxdataArray = new Array();					
			ajaxdataArray.push(['guid']);
			ajaxdataArray.push([guid]);	
			ajaxdataArray.push(['name']);
			ajaxdataArray.push([name]);				
			var data=jQuery.parseJSON(arrTojson( ajaxdataArray ))  ; 
			var url=YTapp+'/Mobileserviceorder/serviceorder_dispatchsave/';
			var flag=5;//退出当前页面 并且刷新上一级页面	
			YTajax_submit(url,data,flag)  ;	  
	});  
			
} 

function YTmobile_confirm(guid) {    // 审核 确认按钮
	layer.confirm('审核过的订单将不能做任何修改<br>确认审核？',  {
							skin: 'layui-layer-molv' //样式类名
							,closeBtn: 0,btn: ['是','否'],title: ['提示', 'font-size:18px;'] //按钮
					    },
	  function(){
			var ajaxdataArray = new Array();					
			ajaxdataArray.push(['guid']);
			ajaxdataArray.push([guid]);				
			var data=jQuery.parseJSON(arrTojson( ajaxdataArray ))  ; 
			var url=YTapp+'/Mobileserviceorder/serviceorder_confirmsave/';
			var flag=1;  //刷新当前页
			YTajax_submit(url,data,flag)  ;	  
	});  
			
} 

function YTmobile_selectsalesorder_ajax()	{   // ajax方式 查询销售记录
  	var url = YTmobile_getSalesSelectUrl() ;
	YTajax_nextpage(YTapp+'/Mobilesalesorder/ajax_salesorder_list'+url);	
};

function YTmobile_selectsalesrecord()	{   //  查询销售记录
  	var url = YTmobile_getSalesSelectUrl() ;
	window.open(YTapp+'/Mobilesalesorder/salesorder_list'+url+'/YT_urlrefresh');	//订单状态;		YT_urlrefresh 通知安卓客户端 刷新本页面 用本页面代替原来的url
};

function YTmodal_salesorder_selectstatus(status) {  //设置销售订单状态
   $("#status").val(status);  //销售订单状态
   YTmodal_openorclose( $('#modal_selectstatus') ) ;  //关闭选择界面
}

function YTmobile_salesorderprocess_info( order_guid,order_number )	{   //销售订单追踪
  window.open( YTapp+'/Mobileutil/salesorderprocess_info/order_guid/'+order_guid+'/order_number/'+order_number);
};

function YTmobile_salesorderconfirm(id) {    // 销售订单 审核 确认按钮
    var str="[{'id':'"+id+ "'}]"  ;
	layer.confirm('审核过的订单将不能再做修改<br>确认审核？',  {
							skin: 'layui-layer-molv' //样式类名
							,closeBtn: 0,btn: ['是','否'],title: ['提示', 'font-size:18px;'] //按钮
					    },
	  function(){
			var ajaxdataArray = new Array();
			ajaxdataArray.push(['json']);
			ajaxdataArray.push([str]);				
			var data=jQuery.parseJSON(arrTojson( ajaxdataArray ))  ; 
			var url=YTapp+'/Salesprocess/process_confirm/';  //审核处理转pc部分的处理审核的程序 改造成手机和pc公用
			var flag=1;  //刷新当前页
			YTajax_submit(url,data,flag)  ;	  
	});  
			
} 

function YTmobile_selectstock_ajax()	{   // ajax方式 查询商品库存
  	var url = YTmobile_getStockSelectUrl() ;
	YTajax_nextpage(YTapp+'/Mobilestock/ajax_statistics_stockselect'+url);	
};

function YTmobile_selectstock()	{   //  查询库存
  	var url = YTmobile_getStockSelectUrl() ;
	window.open(YTapp+'/Mobilestock/statistics_stockselect'+url+'/YT_urlrefresh');	//订单状态;		YT_urlrefresh 通知安卓客户端 刷新本页面 用本页面代替原来的url
};

function YTmobile_factory_list_ajax()	{   // ajax方式 查询返厂维修记录
  	var url = YTmobile_getFactorySelectUrl() ;
	YTajax_nextpage(YTapp+'/Mobilestock/ajax_factory_list'+url);	
};

function YTmobile_selectfactoryrecord()	{   //  查询返厂记录
  	var url = YTmobile_getFactorySelectUrl() ;
	window.open(YTapp+'/Mobilestock/factory_list'+url+'/YT_urlrefresh');	//订单状态;		YT_urlrefresh 通知安卓客户端 刷新本页面 用本页面代替原来的url
};

function YTmobile_stockservicestaff_list_ajax()	{   //  ajax方式 查询领料  退料记录
  	var url = YTmobile_getStockservicestaffSelectUrl() ;
	YTajax_nextpage(YTapp+'/Mobilestock/ajax_stockservicestaff_list'+url);	
};

function YTmobile_selectstockservicestaffrecord()	{   //  查询领料  退料记录
  	var url = YTmobile_getStockservicestaffSelectUrl() ;
	window.open(YTapp+'/Mobilestock/statistics_stockservicestaff_list'+url+'/YT_urlrefresh');	//订单状态;		YT_urlrefresh 通知安卓客户端 刷新本页面 用本页面代替原来的url
};

function YTmodal_customer_selectsearchkey(key,value) {  //设置客户查询条件 
   $("#searchkey").val(key);  //
   $("#searchvalue").val(value);  //
   YTmodal_openorclose( $('#modal_selectsearchkey') ) ;  //关闭选择界面
}

function YTmobile_selectcustomer_ajax()	{   //  ajax方式 查询客户
  	var url = YTmobile_getCustomerSelectUrl() ;
	YTajax_nextpage(YTapp+'/Mobilecustomer/ajax_customer_list'+url);	
};

function YTmobile_selectcustomer()	{   //  查询客户资料
    if ( trim($("#searchtxt").val()) =='' ){ 
	    layer.alert('查询关键词不能为空', {icon: 2});
	} else {
		var url = YTmobile_getCustomerSelectUrl() ;
		window.open(YTapp+'/Mobilecustomer/customer_list'+url+'/YT_urlrefresh');	//订单状态;		YT_urlrefresh 通知安卓客户端 刷新本页面 用本页面代替原来的url		
	}

};

function YTmobile_callnumber_selectcustomer( callnumber )	{   //按电话号码查询客户资料
  window.open( YTapp+'Mobilecustomer/customer_list/searchkey/phone_number/searchvalue/按电话搜索/searchcall/true/searchtxt/'+callnumber+'/YT_urlrefresh');
};

function YTmobile_callnumbertopc( callnumber,calladdress )	{   //传送电话号码到pc端
  window.open( YTapp+'/Mobilelogin/save_callnumber/callnumber/'+callnumber+'/calladdress/'+calladdress);
};

function YTmobile_questionsandanswers_ajax()	{   //  ajax方式 答疑、建议、反馈  
	YTajax_nextpage(YTapp+'/Mobileutil/ajax_questionsandanswers_list');	
};

function YTmobile_questionsandanswers_save()	{   //  保存 答疑、建议、反馈 
	var str1=$('input:radio[name="question_type"]:checked').val() ;	
	if (typeof(str1) == "undefined") { 
		layer.alert('错误：类型没有选择', {icon: 2});
		return;
     }  
	 
	var str2=replaceEscape(trim($("#memo").val())) ;
	if  ( str2=='' ) {
		layer.alert('错误：内容不能为空', {icon: 2});
		return;
	} 

	var ajaxdataArray = new Array();
		ajaxdataArray.push(['question_type']);
		ajaxdataArray.push([str1]);	
		ajaxdataArray.push(['memo']);
		ajaxdataArray.push([str2]);			
	var data=jQuery.parseJSON(arrTojson( ajaxdataArray ))  ; 
	var url=YTapp+'/Mobileutil/questionsandanswers_save/';  // 保存 答疑、建议、反馈 
	var flag=1;  //刷新当前页
	YTajax_submit(url,data,flag)  ;	  
};

function YTmobile_questionsandanswers_save1()	{   // 继续提问  保存 答疑、建议、反馈 
    var str1=$("#info_id").val() ;	
	var str2=replaceEscape(trim($("#memo").val())) ;
	if  ( str2=='' ) {
		layer.alert('错误：内容不能为空', {icon: 2});
		return;
	} 
	
	var ajaxdataArray = new Array();
		ajaxdataArray.push(['id']);
		ajaxdataArray.push([str1]);	
		ajaxdataArray.push(['memo']);
		ajaxdataArray.push([str2]);			
	var data=jQuery.parseJSON(arrTojson( ajaxdataArray ))  ; 
	var url=YTapp+'/Mobileutil/questionsandanswers_save1/';  // 保存 答疑、建议、反馈 
	var flag=1;  //刷新当前页
	YTajax_submit(url,data,flag)  ;	  	
};

function YTmobile_notice_ajax()	{   //  ajax方式 通知
	YTajax_nextpage(YTapp+'/Mobileutil/ajax_notice_list');	
};


