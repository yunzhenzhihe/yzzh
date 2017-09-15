
$(function() {
		$( "#dialog:ui-dialog" ).dialog( "destroy" );	
		$( "#dialog-images" ).dialog({
			autoOpen: false,
			height: 'auto',
			width: 'aut0',
			modal: true,		
			buttons: {
				取消: function() {
					$( this ).dialog( "close" );
				}
			},
		});
			
	});
	
	
function open_image_dialog() {    //打开图片对话框
		$( "#dialog-images" ).dialog( "open" );				
		$( "#dialog-images" ).dialog('option','height','auto');			
	    $( "#dialog-images" ).dialog('option','width', 'auto' );	
        $( "#dialog-images" ).dialog('option','position', 'center' );
        $("#image_desc").val('');   //清空 		
}

function ajaxFileUpload()  {   
	    var image_desc = replaceEscape($("#image_desc").val()), //把双引号等做过滤和替换 ，替换 ;
            parent_id=$("#parent_id").val(),
			uploadurl=$("#url_url").val()+'/upload/';
						
        $("#loading").ajaxStart(function(){
            $(this).show();
        })//开始上传文件时显示一个图片  loading.gif 正在加载图片		
        .ajaxComplete(function(json){
            $(this).hide();
        });//文件上传完成将图片隐藏起来
        
        $.ajaxFileUpload
        (
            {
                url:uploadurl,//用于文件上传的服务器端请求地址
                secureuri:false,//一般设置为false
                fileElementId:'file',//文件上传空间的id属性  <input type="file" id="file" name="file" />
                dataType: 'json',//返回值类型 一般设置为json
				data:{image_desc:image_desc, parent_id:parent_id},   // data: "image_desc="+image_desc+",parent_guid="+parent_guid,// data:{image_desc:'image_desc'}, //parent_guid:'parent_guid'},  //data: "image_desc="+image_desc+",parent_guid="+parent_guid,   //data:{image_desc:'logan', id:'id'},   //	data:{name:'logan', id:'id'},  //传递一个描述和商品唯一id号
			    success: function(data){
				 if (data.status==1) {  
					  $("#image_desc").val('');   //清空 
                      var info = data.data;			
                      ajax_html(info);	 //局部刷新				  			  
				 }
				 else{  
					 alert('上传失败：'+data.info);
				 }		   
			   },			   
			   error:function(XMLHttpRequest, textStatus, errorThrown){
					alert('超时或其它未知的错误,请重试');

						
			   }				   
            }
        )
		document.getElementById( "file" ).outerHTML=document.getElementById( "file" ).outerHTML.replace(/(value=\").+\"/i,"$1\"");    //选择文本框清空
        return false;

    }	

// function upload_edit_image(){   //上传完数据以后重新读取图片数据
        //  document.getElementById( "file" ).outerHTML=document.getElementById( "file" ).outerHTML.replace(/(value=\").+\"/i,"$1\"");    //选择文本框清空		   
	       // var  editurl= $("#url_url").val()+'/ajaxedit_image'; 
	// $.ajax({
		   // type: "POST",
		   // url: editurl,   
		   // data: {parent_id:$("#parent_id").val()},   //"parent_id ="+parent_id,
		   // dataType: "json",
		   // success: function(json){
             // if (json.status==1) {  //读数据成功
                  // var info = json.data;			
                   // ajax_html(info);
			 // }
			 // else{  //读数据出错啦
			     // $(".imageRow").html('无图片');  
			 // }		   
		   // }
		// });					
			
// } 	
	
	
	

function edit_image(parent_id,image_set_name){   //读取图片数据
	       $("#images_number").text(get_cookie('images_number')); 
		   $("#images_maxsize").text(get_cookie('images_maxsize_kb')); 
           $("#parent_id").val(parent_id); 	
		   $("#image_set").html(image_set_name);   
           document.getElementById( "file" ).outerHTML=document.getElementById( "file" ).outerHTML.replace(/(value=\").+\"/i,"$1\"");    //选择文本框清空		   
	       var  editurl= $("#url_url").val()+'/ajaxedit_image'; 
	$.ajax({
		   type: "POST",
		   url: editurl,   
		   data: {parent_id:parent_id},   //"parent_id ="+parent_id,
		   dataType: "json",
		   success: function(json){
             if (json.status==1) {  //读数据成功
                  var info = json.data;			
                   ajax_html(info);
			       open_image_dialog();  //打开图片对话框	
			 }
			 else{  //读数据出错啦
			     $(".imageRow").html('无图片');  
			  	 open_image_dialog();  //打开图片对话框	
			 }		   
		   }
		});					
			
} 	

function ajax_html(info){   //刷新局部	
		  jQuery.ajaxSetup ({cache:false})  ;  //使用jquery里load方法或者ajax调用页面的时候会存在cache的问题，清除cache的方法:  调用jQuery.ajaxSetup ({cache:false}) 方法即可。
		  var html='',
		  i=0,
		  public_url=$("#url_public").val();
		  url_upload=$("#url_upload").val();

		  $.each(info,function(index,commit){ 	//组装数据 刷新局部 
				html+='  <div class="single"> ';
				html+='  <div> ';
				html+='    <input class="input_lightbox_edit" type="image" title="编辑描述"  value="" src="'+public_url+'/images/lightbox_edit.png" onClick="edit_image_desc('+commit['id']+',\''+commit['image_desc']+'\') "  /> ';
				html+='    <input class="input_lightbox_del" type="image" title="删除图片"  value=""  src="'+public_url+'/images/lightbox_del.png" onClick="del_image('+commit['id']+',\''+commit['image_name']+'\') "  />	';	  
				html+='  </div> ';
				html+='  <div  class="image_desc" >'+commit['image_desc']+'</div> ';
				html+='  <br class="clearfloat" />	';		
				html+='  <a href="'+url_upload+commit['image_url']+commit['image_name']+'" rel="lightbox[plants]" title="'+commit['image_desc']+'"><img src="'+url_upload+commit['image_url']+'thumb/s_'+commit['image_name']+'" title="'+commit['image_desc']+'" alt="Plants" /></a>	'    
				html+='  </div>  ';	
                i+=1;				
		  });
		  
		  if (i<$("#images_number").text()) {  //在这里限制传输图片的数量
         		$( "#upload_image_file" ).show(); 		
		  } else {
	      	    $( "#upload_image_file" ).hide();
		  }
   		  		  
		  $(".imageRow").html(html);  //	 可以用这个方法加一个样式表 $(".single").find("tr:odd").addClass("even");
		  $(document).ready(function(){    //鼠标滑过显示编辑和删除的按钮
			  $(".single").mouseover(function(){
				  $(this).css("background-color","#cde6c7");  
				  $(this).find(".image_desc").css("display","none");
				  $(this).find(".input_lightbox_edit").css("display","inline");  
				  $(this).find(".input_lightbox_del").css("display","inline");
				});	

			  $(".single").mouseout(function(){	
				 $(this).css("background-color","");  	
				 $(this).find(".image_desc").css("display","inline");
				 $(this).find(".input_lightbox_edit").css("display","none");  
				 $(this).find(".input_lightbox_del").css("display","none");
				})			
		   })	

}
	
function del_image(id,image_name){   //删除图片
	 if (confirm("确认要删除选中的图片？")) {
	 var parent_id=$("#parent_id").val(),
	     delurl=$("#url_url").val()+'/ajaxdel_image';		 		 
		$.ajax({
			   type: "POST",
			   url: delurl,   
			   data: {id:id, parent_id:parent_id,image_name:image_name}, 
			   dataType: "json",
			   success: function(json){
				 if (json.status==1) {  //删除成功
                      var info = json.data;			
                      ajax_html(info);	 //局部刷新					  
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

function edit_image_desc(id,image_desc){   //修改图片描述
        $("#record_id").val(id); 
        $( "#imagedesc-form" ).dialog( "open" );	
		$( "#imagedesc-form" ).dialog('option','height','auto');	
		$( "#imagedesc-form" ).dialog('option','width', 'auto' );	
        $( "#imagedesc-form" ).dialog('option','position', 'center' );	
		$( "#form_image_desc").val(image_desc); 		
		

}

$(function() { //修改图片描述对话框
		$( "#dialog:ui-dialog" ).dialog( "destroy" );	
		$( "#imagedesc-form" ).dialog({   //  图片描述修改
			autoOpen: false,
			height: 'auto',
			width: 'aut0',
			modal: true,  
			open: function() { 
				//jquery之dialog的键盘事件(输入完毕回车检索)  
				 $('#form_image_desc').bind('keypress',function(event){
						if(event.keyCode == "13") {
							//  $(".ui-dialog-buttonpane button").first().click();  
						//	   $('<button>确定</button>').click() ;
						    //  edit_image_desc_ajax()
							  return false;
						} 
				});
			}, 			
			buttons: {
				"确定": function() {
					   //开始提交添加数据到后台存储					   
						var image_desc_string = replaceEscape($("#form_image_desc").val()), //把双引号，一些保留字 替换 
							saveurl=$("#url_url").val()+'/ajaxsave_image',
							parent_id=$("#parent_id").val(),
							id=$("#record_id").val();							
						$.ajax({
							   type: "POST",
							   url: saveurl,   
							   data: {id:id, image_desc:image_desc_string, parent_id:parent_id}, 
							   dataType: "json",
							   success: function(json){
								 if (json.status==1) {  //修改描述成功
									  var info = json.data;			
									  ajax_html(info);	 //局部刷新	
									  $("#imagedesc-form").dialog('close') ;									  
								 }
								 else{  //删数据出错啦
									 alert('修改图片描述失败：'+json.info);
								 }		   
							   }
							});	
						//结束提交添加数据到后台存储	
				},
				取消: function() {
					$( this ).dialog( "close" );
				}
			},
		});	
});

	

  
 
  