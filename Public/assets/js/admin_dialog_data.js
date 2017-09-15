
var timeout=get_cookie('ajaxsavedata_timeout'); //超时时间 毫秒,来自登陆的cookie	
$("body").css("background-color","#ece9d8");  //调整背景的颜色
	
$(function() {
		$( "#dialog:ui-dialog" ).dialog( "destroy" );
		var hash = $("input[name='__hash__']").val(),
			success_flag=false, //如果修改或者是添加成功以后，修改这个标志位true 用于判断是否需要刷新本页面		
			saveurl=$("#url_url").val()+'/ajaxsave',    //修改保存的地址
			inserturl=$("#url_url").val()+'/ajaxinsert';	  //添加的地址				
		$( "#dialog-form" ).dialog({
			autoOpen: false,
			height: 'auto',
			width: 'auto',
			modal: true,		
			buttons: {
				"确定": function() {				   
					var bValid = true;
					bValid = dialogcheckdata() ;  //校验数据有效性										
					if ( bValid ) {	
                      open_ajaxsavedata_form() ; //打开ajax保存数据的  遮罩					
					  if ($( "#dialog-form" ).dialog('option','title')=='添加') {  //开始添加数据的业务处理
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
								       success_flag=true;
									   alert('保存数据成功');									   
					                   if ($("#addcheck").is(":checked")) {    //如果连续输入的选择框为true 那就清空输入框  否则就关闭		
                                              dialogclearinputbox();  //清空数据输入框
			                            } else {				                          
											  $("#dialog-form").dialog('close') ;
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
								       success_flag=true;
									   alert('保存数据成功');									   			                          
									   $("#dialog-form").dialog('close') 
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
				},
				取消: function() {
					$( this ).dialog( "close" );
				}
			},
			close: function() {			
				if ( success_flag ) {
				//  window.location.reload(); 
				  window.location.href=window.location.href;  //刷新纪录,
				} 				
			}
		});
			
		$( "#ajaxsavedata-form" ).dialog({   //  ajax保存数据 的  遮罩,
			autoOpen: false,
			showClose: false,
			height: 'auto',
			width: 'aut0',
			modal: true,	
            closeOnEscape: false,
         //   open: function(event, ui) { $(".ui-dialog-titlebar-close").hide(); }		  //关闭close图标  关闭 esc键退出	
		    open: function(event, ui) { }		  //关闭close图标  关闭 esc键退出	
		});			
					
});



function open_ajaxsavedata_form() {    //打开ajax保存数据的  遮罩
		$( "#ajaxsavedata-form" ).dialog( "open" );		
		$( "#ajaxsavedata-form" ).dialog('option','height','auto');	
		$( "#ajaxsavedata-form" ).dialog('option','width', 'auto' );	
        $( "#ajaxsavedata-form" ).dialog('option','position', 'center' );	
		$(".ui-dialog-titlebar-close").hide();  //关闭close icon	
}

function close_ajaxsavedata_form() {    //关闭ajax保存数据的  遮罩
        $( "#ajaxsavedata-form" ).dialog( "close" );	//关闭ajax保存数据的  遮罩
		$(".ui-dialog-titlebar-close").show();   //打开close icon
}

function open_add_dialog() {    //打开添加数据对话框
		$( "#dialog-form" ).dialog( "open" );
		$( "#addcheck" ).show(); 
		$("#addchecktext").show(); 		 
		dialogclearinputbox();  //清空数据输入框			
		$( "#dialog-form" ).dialog('option','height','auto');	
		$( "#dialog-form" ).dialog('option','width', 'auto' );	
        $( "#dialog-form" ).dialog('option','position', 'center' );		
		$( "#dialog-form" ).dialog('option','title','添加');		
}
	
function open_edit_dialog() {    //打开修改数据对话框
		$( "#dialog-form" ).dialog( "open" );				
		$( "#addcheck" ).hide();	
		$( "#addchecktext" ).hide();	  
		$( "#dialog-form" ).dialog('option','height','auto');	
		$( "#dialog-form" ).dialog('option','width', 'auto' );
		$( "#dialog-form" ).dialog('option','position', 'center' );		
		$( "#dialog-form" ).dialog('option','title','修改');			
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
			    open_edit_dialog();  //打开修改的对话框					
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
				}      				   
                var b=document.getElementsByName( "selectdatabox" ) ;  //遍历selectdatabox  选择下拉框 然后赋值  
                for(var   i=0;i <b.length;i++) {
				      var b1=b[i].options;
				      for(var   j=0;j <b1.length;j++) {	
                      if (trim(b1[j].value)==trim(info[b[i].id] ) )  {	
				               b1[j].selected=true;	//开始赋值  
							   break; 
				           }				   
				       } 
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

function dialog_ajax_data(ajaxtype) {   // ajax 数据	从页面上读取json数据给弹出的对话框里面 data
        var ajaxdataArray = new Array();
			var a=document.getElementsByName( "inputdatabox" ) ;  //遍历inputdatabox 输入文本框 然后放入数组 
			for(var   i=0;i <a.length;i++) {
			//   alert($(a[i]).attr("disabled"));	
			   if ( $(a[i]).attr("disabled")!='disabled' ) {  //如果元素是只读，不能修改的状态的话，就不取数据			   
                    if ( a[i].id =='time_appointment' ) { //预约的时间是2013-01-04 23:14   要对这个数据拆解 把小时和分钟分别赋值给select    
                           var str= $("#time_appointment").val()+' '+ $("#time_appointment_hour").val()+ ':'+ $("#time_appointment_minute").val()
						 ajaxdataArray.push([trim($(a[i]).attr('id'))]);
						 ajaxdataArray.push(str);		
						 
					} else {			   			   
						 ajaxdataArray.push([trim($(a[i]).attr('id'))]);
						 ajaxdataArray.push([trim($(a[i]).val())]);			
				 }
			   }	 
			}
			
			var b=document.getElementsByName( "selectdatabox" ) ;  //遍历selectdatabox  选择下拉框值 然后放入数组  
			for(var   i=0;i <b.length;i++) {
				  var b1=b[i].options;
				  for(var   j=0;j <b1.length;j++) {	
				  if (b1[j].selected==true )  {	
						 ajaxdataArray.push([trim($(b[i]).attr('id'))]);
						 ajaxdataArray.push([trim($(b1[j]).val())]);				  
						break; 
				   }				   
				  } 
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

function dialog_clear_allbox() {   // 当连续输入的时候，需要清空输入框的数据，初始化一些选择项
		var a=document.getElementsByName( "inputdatabox" ) ;  //遍历inputdatabox 输入文本框 然后清空 
		for(var   i=0;i <a.length;i++) 
		   a[i].value='';	  				
}

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


	




	
		
  



















