
var timeout=get_cookie('ajaxsavedata_timeout'); //超时时间 毫秒,来自登陆的cookie	
var add_success_flag=false; //如果连续添加成功以后，修改这个标志位true 用于判断是否需要刷新本页面

function windowclose(){  //关闭当前弹出的界面
	 var browserName=navigator.appName;
	 if (browserName=="Netscape"){
		   window.open('', '_self', '');
		   window.close();
	 }
	 if (browserName=="Microsoft Internet Explorer") { 
		   window.parent.opener = "whocares"; 
		   window.parent.close(); 
	 }
}

function yt_ajaxsave_simpledata(n) {  //切换tab 然后吧tab号传递给后台 用 ajax的方式 或者传递一些数据到后台 不要前台提醒
		$.ajax({
				type: "POST",
				url: YTajaxurl,
				timeout:timeout,
				data:  {data:n},   
				dataType: "json",
				success: function(json){
				   if(json.status==1){  //写数据成功
					 //   alert('保存数据成功');					   
					}
					else{  //写数据出错啦
					 //  alert('保存数据失败，错误提示：'+json.info);
					}
				},
				error:function(XMLHttpRequest, textStatus, errorThrown){
					//alert('超时错误或其它未知的错误,请刷新重试');
				}							
		});	
}

function yt_ajaxsubmit(ajaxurl,ajaxtype,successtype) // ajax提交数据  新增保存  url:ajax网址  ajaxtype：0  新增保存    1：修改保存  successtype=0 成功以后 刷新 可以继续录入新的数据  successtype=1 关闭当前页面 
{
		open_ajaxsavedata_form() ; //打开ajax保存数据的  遮罩					
		$.ajax({
				type: "POST",
				url: ajaxurl,
				timeout:timeout,
				data:  yt_ajaxdata(ajaxtype),   //收集网页上的数据  0：添加   1：修改
				dataType: "json",
				success: function(json){
				   close_ajaxsavedata_form() ;   //关闭ajax保存数据的  遮罩
				   if(json.status==1){  //写数据成功
				        if ( json.info != '') {
							alert(json.info);
						} else {
							alert('保存数据成功');	
						}
					    
						if (successtype!=0) {  //如果是修改
							  // window.close() ;
							  windowclose();//关闭当前弹出的界面
							}	else  {
							   window.location.href=window.location.href;  //页面
							}					   
					}
					else{  //写数据出错啦
					   alert('保存数据失败，错误提示：'+json.info);
					}
				},
				error:function(XMLHttpRequest, textStatus, errorThrown){
					close_ajaxsavedata_form() ;   //关闭ajax保存数据的  遮罩	
					alert('超时错误或其它未知的错误,请刷新重试');
				}							
		});			
}

function yt_ajaxdata(ajaxtype) {   // ajax 数据	从页面上读取json数据给ajax提交里面 data  ajaxtype：0  新增保存    1：修改保存
        var ajaxdataArray = new Array();	
        var form = $('#submit_form');
	    $('.form-control-static', form).each(function(){
			var input = $('[name="'+$(this).attr("data-display")+'"]', form);
			
			
			var input_name = $(this).attr("data-display");	
			if (input.is(":text") || input.is("textarea")) {
				ajaxdataArray.push([trim( input_name )]);
			    ajaxdataArray.push([trim( input.val() )]);					
			} else if (input.is("select")) {
			   if ( trim( input_name )=='order_goods_type') {	//商品分类的处理 		      
				  var str=trim( input.find('option:selected').text() );  //下拉选择框  文本   
				  str=trim(str.replace("├",""));  //去掉  这个字符 ├ 	
				  ajaxdataArray.push(['goods_type']);
			      ajaxdataArray.push([str]);	//下拉选择框  文本	
			      ajaxdataArray.push(['goods_type_id']);
				  ajaxdataArray.push([trim( input.find('option:selected').val() )]);	//下拉选择框  value					  		   
			   }else if ( trim( input_name )=='order_goods_name') 	//商品名称的处理 	
			   {
				  ajaxdataArray.push(['goods_name']);
			      ajaxdataArray.push([trim( input.find('option:selected').text() )]);	//下拉选择框  文本	
			      ajaxdataArray.push(['goods_name_id']);
				  ajaxdataArray.push([trim( input.find('option:selected').val() )]);	//下拉选择框  value					   
			   } else {
			      ajaxdataArray.push([trim( input_name )]);
				  ajaxdataArray.push([trim( input.find('option:selected').val() )]);	//下拉选择框  value	
				} 
		/*	} else if (input.is(":radio") && input.is(":checked")) {
				ajaxdataArray.push([trim( input_name )]);
			    ajaxdataArray.push([trim( input.attr("data-title") )]);	*/
			} else if (input.is(":radio") ) {
				   var str1='';				  
				   input.each(function(){  
						if  ( $(this).attr("checked") == "checked" ){
							str1=$(this).val();
						}
					});
				    ajaxdataArray.push([trim( input_name )]);
			        ajaxdataArray.push([trim( str1 )]);								
			} else if ($(this).attr("data-display") == 'payment') {
				var payment = [];
				$('[name="payment[]"]').each(function(){
					payment.push($(this).attr('data-title'));
				});
				ajaxdataArray.push([trim( input_name )]);
			    ajaxdataArray.push([trim( payment.join("<br>") )]);					
			}
		});	
		$('input[name="yt_input_data"]').each(function(){   //当传递 客户的guid   客户的id  等等隐藏字段的时候  使用这个判断
				ajaxdataArray.push([trim( $(this).attr("id") )]);
			   ajaxdataArray.push([trim( $(this).val() )]);	
				//alert( $(this).attr("id")   +":"+ $(this).val() );		
		});	
		
		if (ajaxtype!=0) {  //如果是修改
		  	   ajaxdataArray.push(['id']);
			   ajaxdataArray.push([$( "#edit_record_id" ).val()]);	 
			}	

  //  	alert(arrTojson( ajaxdataArray ));	
	    return jQuery.parseJSON(arrTojson( ajaxdataArray ))  ; 	 //json文本转对象
		
}


$('#goods_type').change(function(){  //选择商品种类 联动  商品名称
		var  ajaxurl=$("#url_app").val()+'/Util/util_findgoods';	  //查询商品
		var  goods_type=$(this).children('option:selected').val();	  //商品分类的guid
	    $("#goods_name").empty();	
	    $("#goods_name").append('<option value="" selected ></option>'); //为Select追加一个  空的 Option(下拉项) 	
		$("#goods_name").select2();	//初始化 商品名称选择框			
		if ( goods_type.length < 2 ) { return } ;  //如果是选择项是空的就返回
		open_ajaxsavedata_form() ; //打开ajax保存数据的  遮罩					
		$.ajax({
				type: "POST",
				url: ajaxurl,
				timeout:timeout,
				data:  {type_id:goods_type},
				dataType: "json",
				success: function(json){
				   close_ajaxsavedata_form() ;   //关闭ajax保存数据的  遮罩
				   if(json.status==1){  //写数据成功
                      var info = json.data;					  
					   for(var   i=0;i <info.length;i++) {
					      $("#goods_name").append('<option value="'+info[i]['guid']+'">'+info[i]['name']+'</option>'); //为Select追加一个  Option(下拉项) '			
						}                       					  					  									
					}
					else{  //读数据出错啦
					  alert('错误提示：'+json.info);
					}
				},
				error:function(XMLHttpRequest, textStatus, errorThrown){
					close_ajaxsavedata_form() ;   //关闭ajax保存数据的  遮罩	
					alert('超时错误或其它未知的错误,请刷新重试');
				}							
		});			
		
}) 

$('#goods_type_stock').change(function(){  //选择商品种类 联动  商品名称 用于库存 不带服务费用类目的商品 
		var  ajaxurl=$("#url_app").val()+'/Util/util_findgoods_stock';	  //查询商品
		var  goods_type=$(this).children('option:selected').val();	  //商品分类的guid
	    $("#goods_name").empty();	
	    $("#goods_name").append('<option value="" selected ></option>'); //为Select追加一个  空的 Option(下拉项) 	
		$("#goods_name").select2();	//初始化 商品名称选择框			
		if ( goods_type.length < 2 ) { return } ;  //如果是选择项是空的就返回
		open_ajaxsavedata_form() ; //打开ajax保存数据的  遮罩					
		$.ajax({
				type: "POST",
				url: ajaxurl,
				timeout:timeout,
				data:  {type_id:goods_type},
				dataType: "json",
				success: function(json){
				   close_ajaxsavedata_form() ;   //关闭ajax保存数据的  遮罩
				   if(json.status==1){  //写数据成功
                      var info = json.data;					  
					   for(var   i=0;i <info.length;i++) {
					      $("#goods_name").append('<option value="'+info[i]['guid']+'">'+info[i]['name']+'</option>'); //为Select追加一个  Option(下拉项) '			
						}                       					  					  									
					}
					else{  //读数据出错啦
					  alert('错误提示：'+json.info);
					}
				},
				error:function(XMLHttpRequest, textStatus, errorThrown){
					close_ajaxsavedata_form() ;   //关闭ajax保存数据的  遮罩	
					alert('超时错误或其它未知的错误,请刷新重试');
				}							
		});			
		
}) 

$('#goods_type_statistics').change(function(){  //选择商品种类 联动  商品名称 用于统计 
		var  ajaxurl=$("#url_app").val()+'/Util/util_findgoods';	  //查询商品
		var  goods_type=$(this).children('option:selected').val();	  //商品分类的guid
		if ( goods_type == '1' ) {
			$("#goods_name_statistics").empty();	
			$("#goods_name_statistics").append('<option value="1" selected >全部商品</option>'); //为Select追加一个  空的 Option(下拉项) 	
			$("#goods_name_statistics").select2();	//初始化 商品名称选择框	
		    return 
		} ;  //如果是选择项是全部分类 		
	    $("#goods_name_statistics").empty();	
	    $("#goods_name_statistics").append('<option value="1" selected >全部商品</option>'); //为Select追加一个  空的 Option(下拉项) 	
		$("#goods_name_statistics").select2();	//初始化 商品名称选择框			
		if ( goods_type.length < 2 ) { return } ;  //如果是选择项是空的就返回

		open_ajaxsavedata_form() ; //打开ajax保存数据的  遮罩					
		$.ajax({
				type: "POST",
				url: ajaxurl,
				timeout:timeout,
				data:  {type_id:goods_type},
				dataType: "json",
				success: function(json){
				   close_ajaxsavedata_form() ;   //关闭ajax保存数据的  遮罩
				   if(json.status==1){  //写数据成功
                      var info = json.data;					  
					   for(var   i=0;i <info.length;i++) {
					      $("#goods_name_statistics").append('<option value="'+info[i]['guid']+'">'+info[i]['name']+'</option>'); //为Select追加一个  Option(下拉项) '			
						}                       					  					  									
					}
					else{  //读数据出错啦
					  alert('错误提示：'+json.info);
					}
				},
				error:function(XMLHttpRequest, textStatus, errorThrown){
					close_ajaxsavedata_form() ;   //关闭ajax保存数据的  遮罩	
					alert('超时错误或其它未知的错误,请刷新重试');
				}							
		});			
		
})

function find_goods_memo(goods_guid,flag){  //选择商品名称 联动  商品描述说明字段
		var  ajaxurl=$("#url_app").val()+'/Util/util_findgoodsmemo';	  //查询商品描述说明字段
	//	var  goods_guid=$(this).children('option:selected').val();	  //商品名称的guid	
		if ( goods_guid.length < 2 ) { 
			$("#goods_memo").val("");
			$("#goods_unit").val("");		
		    return
		 } ;  //如果是选择项是空的就返回
		 
		open_ajaxsavedata_form() ; //打开ajax保存数据的  遮罩					
		$.ajax({
				type: "POST",
				url: ajaxurl,
				timeout:timeout,
				data:  {guid:goods_guid},
				dataType: "json",
				success: function(json){
				   close_ajaxsavedata_form() ;   //关闭ajax保存数据的  遮罩
				   if(json.status==1){  //读数据成功
                      var info = json.data;	
					  
					      $("#goods_number").val("");	 //商品编号
                          $("#goods_number").val(info['number']);					  
					  
					      $("#goods_specs").val("");	 //商品规格
                          $("#goods_specs").val(info['specs']);
						  
						  $("#goods_unit").val("");	  //计量单位
                          $("#goods_unit").val(info['unit']);	
						  
						  $("#regular_maintenance").val("0");	  //定期维护间隔天数 0：不定期维护
                          $("#regular_maintenance").val(info['regular_maintenance']);		
						  
						  $("#regular_visits").val("0");	  //定期回访间隔天数 0:不定期回访
                     //     $("#regular_visits").val(info['regular_visits']);	
						  
						  $("#warranty_period").val("0");	  //质保时间（月） 0：不质保 9999：质保终身
                          $("#warranty_period").val(info['warranty_period']);	
						  
						  $("#warranty_period_txt").val("不质保");	  //质保时间文字部分
                          $("#warranty_period_txt").val(info['warranty_period_txt']);	
						  
						  $("#property").val("");	  //质保时间文字部分
                          $("#property").val(info['property']);		
						  
                         if ( flag !='1' ) {   // flag=1 :录入入库订单 不需要单价
							  $("#goods_unitprice").val("");	  //单价
							  $("#goods_unitprice").val(info['price']);	
							  $("#goods_unitprice").change();								 
						 }
		  
					}
					else{  //读数据出错啦
					  alert('错误提示：'+json.info);
					}
				},
				error:function(XMLHttpRequest, textStatus, errorThrown){
					close_ajaxsavedata_form() ;   //关闭ajax保存数据的  遮罩	
					alert('超时错误或其它未知的错误,请刷新重试');
				}							
		});	
}


$('#yt_dialog_btn_ok').click(function (e) {   //对话框里面的确认按钮
		var hash = $("input[name='__hash__']").val(),
			saveurl=$("#url_url").val()+'/ajaxsave',    //修改保存的地址
			inserturl=$("#url_url").val()+'/ajaxinsert';	  //添加的地址		
			var bValid = true;
			bValid = dialogcheckdata() ;  //校验数据有效性	
			if ( bValid ) {	
			  open_ajaxsavedata_form() ; //打开ajax保存数据的  遮罩					
			  if ($("#yt_dialog_title").html()=='<strong>添加数据</strong>') {  //开始添加数据的业务处理
			   //开始提交添加数据到后台存储
				  $.ajax({
						type: "POST",
						url: inserturl,
						timeout:timeout,
						data:  dialog_ajax_data(0),  //收集网页上的数据  0：添加   1：修改
						dataType: "json",
						success: function(json){
						   close_ajaxsavedata_form() ;   //关闭ajax保存数据的  遮罩
						   if(json.status==1){  //写数据成功
							   alert('保存数据成功');									   
							   if ($("#yt_dialog_addcheck").is(":checked")) {    //如果连续输入的选择框为true 那就清空输入框  否则就关闭		
									  dialogclearinputbox();  //清空数据输入框
									  add_success_flag=true;  //连续添加录入成功标志 
								} else {	
									 window.location.href=window.location.href;  //页面										
									 //$("#yt_dialog_form").modal('hide') ;  //关闭对话框
								}
							}
							else{  //写数据出错啦
							   alert('保存数据失败，错误提示：'+json.info);
							}
						},
						error:function(XMLHttpRequest, textStatus, errorThrown){
							close_ajaxsavedata_form() ;   //关闭ajax保存数据的  遮罩	
							alert('超时错误或其它未知的错误,请刷新重试');
						}
					});	
				//结束提交添加数据到后台存储							
			  }
			  else {  //开始修改数据的业务处理
			   //开始提交修改数据到后台存储
				  $.ajax({
						type: "POST",
						url: saveurl,
						timeout:timeout,
						data:  dialog_ajax_data(1),  //收集网页上的数据  0：添加   1：修改
						dataType: "json",
						success: function(json){
						   close_ajaxsavedata_form() ;   //关闭ajax保存数据的  遮罩								
						   if(json.status==1){  //写数据成功
							   alert('保存数据成功');	
							   window.location.href=window.location.href;  //刷新页面
							 //  $("#yt_dialog_form").modal('hide') ;  //关闭对话框
							}
							else{  //写数据出错啦
							   alert('保存数据失败，错误提示：'+json.info);
							}
						} ,
						error:function(XMLHttpRequest, textStatus, errorThrown){
							close_ajaxsavedata_form() ;   //关闭ajax保存数据的  遮罩	
							alert('超时错误或其它未知的错误,请刷新重试');
						}								
					});						   
			   //结束提交修改数据到后台存储		
			 }					                      				
			} 
});	

function yt_ajaxsubmit_dialog(ajaxurl,ajaxtype,successtype) // ajax提交数据  新增保存  url:ajax网址  ajaxtype：0  新增保存    1：修改保存  successtype=0 成功以后 刷新 可以继续录入新的数据  successtype=1 关闭当前页面 	
  {	
	    var bValid = true;
		bValid = dialogcheckdata() ;  //校验数据有效性		
		if ( bValid ) {	
		  open_ajaxsavedata_form() ; //打开ajax保存数据的  遮罩					
		   //开始提交添加数据到后台存储
			  $.ajax({
					type: "POST",
					url: ajaxurl,
					timeout:timeout,
					data:  dialog_ajax_data(ajaxtype),  //收集网页上的数据  0：添加   1：修改
					dataType: "json",
					success: function(json){
					   close_ajaxsavedata_form() ;   //关闭ajax保存数据的  遮罩
					   if(json.status==1){  //写数据成功
						   alert('保存数据成功');									   
							if (successtype!=0) {  //如果是修改
							 //  window.close() ;
							   windowclose();//关闭当前弹出的界面
							}	else  {
							   window.location.href=window.location.href;  //页面
							}	
						}
						else{  //写数据出错啦
						   alert('保存数据失败，错误提示：'+json.info);
						}
					},
					error:function(XMLHttpRequest, textStatus, errorThrown){
						close_ajaxsavedata_form() ;   //关闭ajax保存数据的  遮罩	
						alert('超时错误或其它未知的错误,请刷新重试');
					}
				});	
			//结束提交添加数据到后台存储									                      				
		} 
};	





$("#yt_dialog_form").on('hidden.bs.modal', function (e) {  //对话框退出前检查 是否需要刷新页面
	if ( add_success_flag ) {
	  window.location.href=window.location.href;  //刷新页面
	} 	
})

function edit_record(record_id){   //取数据然后把数据赋值给弹出的对话框里面的字段
    var  editurl=$("#url_url").val()+'/ajaxedit';	  //地址
    open_ajaxsavedata_form() ; //打开ajax保存数据的  遮罩	
	$.ajax({
		   type: "POST",
		   url: editurl, 
		   timeout:timeout,
		//   data: "id="+id,
		   data:  {id:record_id},
		   dataType: "json",
		   success: function(json){
		     close_ajaxsavedata_form() ;   //关闭ajax保存数据的  遮罩	
             if (json.status==1) {  //读数据成功
                var info = json.data;
                open_edit_dialog() ;   //打开修改数据对话框		
				if($("#rpassword").length>0){  //登录用户名的修改
					$('#username').attr("readonly","readonly")
					$("#id_password").hide();
					$("#id_rpassword").hide();
				}				
                $("#edit_record_id").val(info.id);   //把这个数据id 保存到 #edit_record_id
                var a=document.getElementsByName( "inputdatabox" ) ;  //遍历inputdatabox 输入文本框 然后赋值 		
                for(var   i=0;i <a.length;i++) {	
                    info[a[i].id] = info[a[i].id].replace(/<br>/g,"\r");	 // 替换换行  把	<br> 换成回车，换行	
                    if ( a[i].id =='time_appointment' ) { //预约的时间是2013-01-04 23:14   要对这个数据拆解 把小时和分钟分别赋值给select                            
                           var timearr=info[a[i].id].replace(" ",":").replace(/\:/g,"-").split("-");   //数据分解到数组里面
						   info[a[i].id]=timearr[0]+'-'+timearr[1]+'-'+timearr[2]; // 重新赋值年月日
						   $("#time_appointment_hour").val(timearr[3]);   //小时赋值
						   $("#time_appointment_minute").val(timearr[4]);   //分钟赋值		 
					}	
 				    a[i].value=info[a[i].id] ;	//开始赋值  
                    if  (a[i].id=='value') {
						$("#value").select2({
							tags: [ 
							
								  ]		
							});
					}					
				}      				   
                var b=document.getElementsByName( "selectdatabox" ) ;  //遍历selectdatabox  选择下拉框 然后赋值  
                for(var   i=0;i <b.length;i++) {
				      var b1=b[i].options;
				      for(var   j=0;j <b1.length;j++) {
                      if (trim(b1[j].value)==trim(info[b[i].id] ) )  {	
				            b1[j].selected=true;	//开始赋值  			   
							$("select[name='selectdatabox']").change();   							   
							   break; 
				           }				   
				       } 
				 }  

				 $('input[name="check"]').each(function(){

					      $(this).attr("checked",false) ;
 
				   });				 

				 $('input[name="check"]').each(function(){
					  if  ( info.check==$(this).val() ) {					     
						  $(this).attr("checked",true) ;
						  checkRadio();
					  } 
				   });



				

			 }
			 else{  //读数据出错啦
			  	 alert('错误提示：'+json.info);
			 }		   
		   },
 		   error:function(XMLHttpRequest, textStatus, errorThrown){
					close_ajaxsavedata_form() ;   //关闭ajax保存数据的  遮罩	
					alert('超时错误或其它未知的错误,请刷新重试');
		   }	 
		});		
}

function open_ajaxsavedata_form() {    //打开ajax读写数据的  遮罩
      $('#yt_loading').modal('show') ; 
}

function close_ajaxsavedata_form() {    //关闭ajax保存数据的  遮罩
	  $('#yt_loading').modal('hide')
}

$('#yt_btn_add').click(function (e) {
   open_add_dialog() ;    //打开添加数据对话框
});	

function open_add_dialog() {    //打开添加数据对话框
    $("#yt_dialog_title").html('<strong>添加数据</strong>'); 
	$( "#yt_dialog_addchecktext" ).show();  //连续添加按钮关闭
    dialogclearinputbox();  //清空数据输入框
	add_success_flag=false;
	if($("#rpassword").length>0){  //登录用户名的修改
		$('#username').removeAttr("readonly");
		$("#id_password").show();
		$("#id_rpassword").show();
	}		
	$("#yt_dialog_form").modal('show') ; 	
}
	
function open_edit_dialog() {    //打开修改数据对话框
	$("#yt_dialog_addchecktext" ).hide();	//连续添加按钮关闭
	$("#yt_dialog_title").html("<strong>修改数据</strong>"); 
	add_success_flag=false;
	$("#yt_dialog_form").modal("show") ;  //打开修改的对话框		
}

	
function del_record(id){   //删除一条记录
    var  delurl=$("#url_url").val()+'/ajaxdel';	  //删除的地址		
	 if (confirm("确认要删除选中的记录？")) {
	    open_ajaxsavedata_form() ; //打开ajax保存数据的  遮罩
		$.ajax({
			   type: "POST",
			   url: delurl, 
			   timeout:timeout,
			   data: "id="+id,
			   dataType: "json",
			   success: function(json){
			     close_ajaxsavedata_form() ;   //关闭ajax保存数据的  遮罩
				 if (json.status==1) {  //删数据成功
					  alert('删除数据成功');	
					  window.location.reload(); 				  
				 }
				 else{  //删数据出错啦
					  alert('删除数据失败：'+json.info);
				 }		   
			   },
				error:function(XMLHttpRequest, textStatus, errorThrown){
					close_ajaxsavedata_form() ;   //关闭ajax保存数据的  遮罩	
					alert('超时错误或其它未知的错误,请刷新重试');
				}			   
			});	
	  }		
} 

function YTajax_del_url(id,url){   //删除一条记录  传过来url
	var  delurl=$("#url_url").val()+'/'+url;	  //删除的地址
	 if (confirm("确认要删除选中的记录？")) {
		open_ajaxsavedata_form() ; //打开ajax保存数据的  遮罩
		$.ajax({
			   type: "POST",
			   url: delurl, 
			   timeout:timeout,
			   data: "id="+id,
			   dataType: "json",
			   success: function(json){
				 close_ajaxsavedata_form() ;   //关闭ajax保存数据的  遮罩	
				 if (json.status==1) {  //删数据成功
					  alert('删除数据成功');	
					  window.location.reload(); 				  
				 }
				 else{  //删数据出错啦
					 alert('删除数据失败：'+json.info);
				 }		   
			   },
				error:function(XMLHttpRequest, textStatus, errorThrown){
					close_ajaxsavedata_form() ;   //关闭ajax保存数据的  遮罩	
					alert('超时错误或其它未知的错误,请刷新重试');
				}			   
			});	
	  }		
} 

function del_guid(id,guid){   //删除一条 带guid的资料 比如客户的资料 需要判断客户名下有没有销售记录 售后记录等等
     var  delurl=$("#url_url").val()+'/ajaxdel';	  //删除的地址	
	 if (confirm("确认要删除选中的记录？")) {
	   open_ajaxsavedata_form() ; //打开ajax保存数据的  遮罩
		$.ajax({
			   type: "POST",
			   url: delurl, 
               timeout:timeout,			   
			   data:  {id: id, guid: guid},    //"id="+id+",guid="+guid,
			   dataType: "json",
			   success: function(json){
			     close_ajaxsavedata_form() ;   //关闭ajax保存数据的  遮罩	
				 if (json.status==1) {  //删数据成功
					  alert('删除数据成功');	
					  window.location.reload(); 				  
				 }
				 else{  //删数据出错啦
					 alert('删除数据失败：'+json.info);
				 }		   
			   },
				error:function(XMLHttpRequest, textStatus, errorThrown){
					close_ajaxsavedata_form() ;   //关闭ajax保存数据的  遮罩	
					alert('超时错误或其它未知的错误,请刷新重试');
				}	
			});	
	  }		
} 	


function del_cat(id,cat_id){   //删除一条无限分类记录
     var  delurl=$("#url_url").val()+'/ajaxdel';	  //删除的地址	
	 if (confirm("确认要删除选中的记录？")) {
	   open_ajaxsavedata_form() ; //打开ajax保存数据的  遮罩
		$.ajax({
			   type: "POST",
			   url: delurl, 
               timeout:timeout,			   
			   data:  {id: id, cat_id: cat_id},    //"id="+id+",cat_id="+cat_id,
			   dataType: "json",
			   success: function(json){
			     close_ajaxsavedata_form() ;   //关闭ajax保存数据的  遮罩	
				 if (json.status==1) {  //删数据成功
					  alert('删除数据成功');	
					  window.location.reload(); 				  
				 }
				 else{  //删数据出错啦
					 alert('删除数据失败：'+json.info);
				 }		   
			   },
				error:function(XMLHttpRequest, textStatus, errorThrown){
					close_ajaxsavedata_form() ;   //关闭ajax保存数据的  遮罩	
					alert('超时错误或其它未知的错误,请刷新重试');
				}	
			});	
	  }		
} 
	
function dialog_ajax_data(ajaxtype) {   // ajax 数据	从页面上读取json数据给弹出的对话框里面 data
        var ajaxdataArray = new Array();
			var a=document.getElementsByName( "inputdatabox" ) ;  //遍历inputdatabox 输入文本框 然后放入数组 
			for(var   i=0;i <a.length;i++) {
			//   alert($(a[i]).attr("disabled"));	
			   if ( $(a[i]).attr("disabled")!='disabled' ) {  //如果元素是只读，不能修改的状态的话，就不取数据			   
						 ajaxdataArray.push([trim($(a[i]).attr('id'))]);
						 ajaxdataArray.push([trim($(a[i]).val())]);			

			   }	 
			}

			var b=document.getElementsByName( "selectdatabox" ) ;  //遍历selectdatabox  选择下拉框值 然后放入数组  
			for(var   i=0;i <b.length;i++) {
				  var b1=b[i].options;
				  for(var   j=0;j <b1.length;j++) {	
				  if (b1[j].selected==true )  {	
						 ajaxdataArray.push([trim($(b[i]).attr('id'))]);
						 ajaxdataArray.push([trim($(b1[j]).val())]);
                         if  ( trim($(b[i]).attr('id')) =='warranty_period' ) {	//商品质保期						  
						     ajaxdataArray.push([ 'warranty_period_txt' ]);
						     ajaxdataArray.push([trim( $(b1[j]).text() )]);							  
						 }						 
						break; 
				   }				   
				  } 
			 } 

			var c=document.getElementsByName( "customfieldcheckbox" ) ;  //遍历customfieldcheckbox 选择框  自定义字段选择框 然后赋值 			
			for(var   i=0;i <c.length;i++) {	
			   if ( c[i].checked==true) {
			      		 ajaxdataArray.push([trim($(c[i]).attr('id'))]);
						 ajaxdataArray.push('');	
			    }  else   {
			      		 ajaxdataArray.push([trim($(c[i]).attr('id'))]);
						 ajaxdataArray.push('yt_nodisplay');					
				}			 			
			}  
			
	
			
            if ($('input:radio[name="regular_type"]:checked').length>0 ){  //客户提醒日单选框 按年或者按日
					ajaxdataArray.push([ 'regular_type' ]);
					ajaxdataArray.push([$('input:radio[name="regular_type"]:checked').val()]);
			}	else {
					$("input:radio").each(function(){ 
						if(this.checked){
			      		 ajaxdataArray.push('check');
						 ajaxdataArray.push($(this).val());														
						}
					});				
			}		
			 
			  
	//	   ajaxdataArray.push(['__hash__']);  去掉了表单验证
	//	   ajaxdataArray.push([$("input[name='__hash__']").val()]);	 
			 
		   if (ajaxtype!=0) {  //如果是修改
			   ajaxdataArray.push(['id']);
			   ajaxdataArray.push([$( "#edit_record_id" ).val()]);	 
			}	

//	alert(ajaxdataArray);	
	//		return arrTojson( ajaxdataArray )  ; 	 //json文本转对象
	    return jQuery.parseJSON(arrTojson( ajaxdataArray ))  ; 	 //json文本转对象
}	

/*function dialog_clear_allbox() {   // 当连续输入的时候，需要清空输入框的数据，初始化一些选择项    这个函数写到具体的html里面 做清理验证
		var a=document.getElementsByName( "inputdatabox" ) ;  //遍历inputdatabox 输入文本框 然后清空 
		for(var   i=0;i <a.length;i++) 
		   a[i].value='';	  				
} */

function save_record(){  
    var saveurl=$("#url_url").val()+'/ajaxsave',    //修改保存的地址	
	bValid = true;
	bValid = dialogcheckdata() ;  //校验数据有效性										
	if ( bValid ) {	
    open_ajaxsavedata_form() ; //打开ajax保存数据的  遮罩	
	$.ajax({
		   type: "POST",
		   url: saveurl,
		   timeout:timeout, 
		   data: dialog_ajax_data(1),
		   dataType: "json",
		   success: function(json){
		     close_ajaxsavedata_form() ;   //关闭ajax保存数据的  遮罩	
             if (json.status==1) {  //成功		
               alert('数据保存成功');			 
			   window.location=window.location.href;  //刷新页面			  
			 }
			 else{  //出错
			  	 alert('错误提示：'+json.info);
				 }
			 },
			error:function(XMLHttpRequest, textStatus, errorThrown){
				close_ajaxsavedata_form() ;   //关闭ajax保存数据的  遮罩	
				alert('超时错误或其它未知的错误,请刷新重试');
			}			   
		  
		});	
	}
}

 function yt_wizard_datatoinput(data) {   //接受网页的数据 然后赋值  wizard 模式的页面适用 2014.8.23
        var form = $('#submit_form');
	    $('.form-control-static', form).each(function(){
			var input = $('[name="'+$(this).attr("data-display")+'"]', form);
			var input_name = $(this).attr("data-display");	
            if (input.is(":text") || input.is("textarea")) {
				input.val(data[input_name].replace(/<br>/g,"\r"));  // 替换换行  把	<br> 换成回车，换行	
			 } else  if (input.is("select")) {
			    if (input_name=="order_goods_type") {
				     input.val(data["goods_type_id"]);
				   } 
				else  if (input_name=="order_goods_name") {
				     input.val(data["goods_name_id"]);
				   } 
				else {
				    input.val(data[input_name]);
				 }				 				 
			 } else if (input.is(":radio") ) {				 
			 	input.each(function(){  		  
				    if  ( $(this).val() == data[input_name] ){
					    $(this).attr("checked",true) ;
					}
		        });	
			 }
        });
 }	
 
function edit_imagedesc(id,image_desc)	{   //编辑图片描述
	     $("#edit_record_id").val(id);   //把这个数据id 保存到 #edit_record_id
		 $("#image_desc").val(image_desc);   //把这个数据id 保存到 #edit_record_id
	     $("#yt_dialog_form").modal("show") ;  //打开修改的对话框		
}; 
	
function yt_ajaxFileUpload(parent_id)  {   	
	    var image_desc = replaceEscape($("#upload_image_desc").val()), //把双引号等做过滤和替换 ，替换 ;   
		    flag = $("#flag").val(), //上传的图片的类型 1：公司的图片 2：客户的图片 3：售后订单的图片
			uploadurl=$("#url_url").val()+'/upload/';
		    open_ajaxsavedata_form() ; //打开ajax保存数据的  遮罩			
			$.ajaxFileUpload
			(
				{
					url:uploadurl,//用于文件上传的服务器端请求地址
					secureuri:false,//一般设置为false
					fileElementId:'file',//文件上传空间的id属性  <input type="file" id="file" name="file" />
					dataType: 'json',//返回值类型 一般设置为json
					data:{image_desc:image_desc, flag:flag, parent_id:parent_id},   // data: "image_desc="+image_desc+",parent_guid="+parent_guid,// data:{image_desc:'image_desc'}, //parent_guid:'parent_guid'},  //data: "image_desc="+image_desc+",parent_guid="+parent_guid,   //data:{image_desc:'logan', id:'id'},   //	data:{name:'logan', id:'id'},  //传递一个描述和商品唯一id号
					success: function(data){
					 close_ajaxsavedata_form() ;   //关闭ajax保存数据的  遮罩
					 if (data.status==1) {  
						   alert('上传成功');
						   window.location.href=window.location.href;  //刷新页面			  			  
					 }
					 else{  
						 alert('上传失败：'+data.info);
						 return false;
					 }		   
				   },			   
				   error:function(XMLHttpRequest, textStatus, errorThrown){
						close_ajaxsavedata_form() ;   //关闭ajax保存数据的  遮罩
						alert('超时或其它未知的错误,请重试');
						return false;

							
				   }				   
				}
			)
}


function del_image(id,image_name,parent_id){   //删除图片
	 if (confirm("确认要删除选中的图片？")) {
	 var delurl=$("#url_url").val()+'/ajaxdel';		 		 
		$.ajax({
			   type: "POST",
			   url: delurl,   
			   data: {id:id, parent_id:parent_id,image_name:image_name}, 
			   dataType: "json",
			   success: function(json){
				 if (json.status==1) {  //删除成功
				      alert('删除成功');
                      window.location.href=window.location.href;  //刷新页面						  
				 }
				 else{  //删数据出错啦
				     if (json.info=='无图片') {
					    $(".imageRow").html('无图片');  
					 } else {
					    alert('删除图片失败：'+json.info);
					 }	
				 }		   
			   }
			});	
	  }		
}	

function ajax_submit(ajax_url,ajax_date){   //ajax 提交数据
    open_ajaxsavedata_form() ; //打开ajax保存数据的  遮罩	
	$.ajax({
		   type: "POST",
		   url: ajax_url, 
		   timeout:timeout,
		   data:  ajax_date,
		   dataType: "json",
		   success: function(json){
		     close_ajaxsavedata_form() ;   //关闭ajax保存数据的  遮罩	
             if (json.status==1) {  //读数据成功
                var info = json.data;
			    alert('数据处理成功');
			    window.location.href=window.location.href;  //刷新页面	
			 }
			 else{  //读数据出错啦
			  	 alert('错误提示：'+json.info);
			 }		   
		   },
 		   error:function(XMLHttpRequest, textStatus, errorThrown){
					close_ajaxsavedata_form() ;   //关闭ajax保存数据的  遮罩	
					alert('超时错误或其它未知的错误,请刷新重试');
		   }	 
		});		
}

function ajax_universalsubmit(ajax_url,ajax_date,http_url){   //通用的ajax  提交数据 
    open_ajaxsavedata_form() ; //打开ajax保存数据的  遮罩	
	$.ajax({
		   type: "POST",
		   url: ajax_url, 
		   timeout:timeout,
		   data:  ajax_date,
		   dataType: "json",
		   success: function(json){
		     close_ajaxsavedata_form() ;   //关闭ajax保存数据的  遮罩	
             if (json.status==1) {  //读数据成功
			   if  ( json.info.indexOf("登陆成功") >-1 ) {  //pcclent 登录成功 转pc程序处理
					alert(json.info);
					return;
				}			 
			   if  ( json.info !='' ) {
					alert(json.info);					
				}
			    if  ( http_url !='' ) {
					window.location.href=http_url;  //刷新页面	
				} 
			 }
			 else{  //读数据出错啦
			    if  ( json.info !='' ) {
					alert(json.info);
				}			 			  	 
			 }		   
		   },
 		   error:function(XMLHttpRequest, textStatus, errorThrown){
					close_ajaxsavedata_form() ;   //关闭ajax保存数据的  遮罩	
					alert('超时错误或其它未知的错误,请刷新重试');
		   }	 
		});		
}

function ajax_verifysubmit(ajax_url,ajax_date,http_url,err_no){   //验证码 ajax  提交数据  用于注册 登录  忘记密码
    open_ajaxsavedata_form() ; //打开ajax保存数据的  遮罩	
	$.ajax({
		   type: "POST",
		   url: ajax_url, 
		   timeout:timeout,
		   data:  ajax_date,
		   dataType: "json",
		   success: function(json){
		     close_ajaxsavedata_form() ;   //关闭ajax保存数据的  遮罩	
             if (json.status==1) {  //读数据成功
			   if  ( json.info.indexOf("登陆成功") >-1 ) {  //pcclent 登录成功 转pc程序处理
					alert(json.info);
					return;
				}			 
			   if  ( json.info !='' ) {
					alert(json.info);					
				}
			    if  ( http_url !='' ) {
					window.location.href=http_url;  //刷新页面	
				}					
			 }
			 else{  //读数据出错啦
			    if  ( json.info !='' ) {
					alert(json.info);
				}	
			    if  ( err_no =='1' ) {
					YTlogin_resetVerifyCode();  //刷新验证码 登录和注册
				} 
			    if  ( err_no =='2' ) {
					YTlogin_resetVerifyCode1(); //刷新验证码  忘记密码
				} 				
				
			 }		   
		   },
 		   error:function(XMLHttpRequest, textStatus, errorThrown){
					close_ajaxsavedata_form() ;   //关闭ajax保存数据的  遮罩	
					alert('超时错误或其它未知的错误,请刷新重试');
					if  ( err_no =='1' ) {
						YTlogin_resetVerifyCode();  //刷新验证码 登录和注册
					} 
					if  ( err_no =='2' ) {
						YTlogin_resetVerifyCode1(); //刷新验证码  忘记密码
					} 					
		   }	 
		});		
}


	




	
		
  



















