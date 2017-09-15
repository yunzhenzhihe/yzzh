	$("#goods_quantity").on('input',function(e){  
	   count1();
	});  
			 
	$("#goods_unitprice").on('input',function(e){  
	   count1();
	});

	$("#goods_unitprice").change(function() {  
	   count1(); 
	});	 
				 
	$("#goods_money").on('input',function(e){  
	   count2();
	});	
	
	$("#discount_money").on('input',function(e){  
	 var checkvalid = true,j=0,k=0,t=0;		   	
		   checkvalid = checkvalid && checkRegexp( $( "#discount_money" ) , /^(-?\d+)(\.\d+)?$/,"" ) ;	
		   if (checkvalid) {
			 j=(trim($( "#salegoods_money" ).val())-0).toFixed(2);  
			 k=(trim($( "#discount_money" ).val())-0).toFixed(2);  
			 t=(j-k).toFixed(2); 
			 $("#discount_money_bak").val(trim($( "#discount_money" ).val())); 
			 $("#sale_money").val(t);  //销售记录的金额值 传到服务器端做处理  商品金额-折扣=销售金额
			 $("#total_salemoney1_bak").val(t);				   
		   }
	}); 	
	
	
	 function open_addgoods_dialog() {    //打开添加数据对话框
	        $( "#goods_quantity" ).val('1');
			$( "#goods_unitprice" ).val('0');
			$( "#goods_money" ).val('0');			
			$("#yt_dialog_title").html('<strong>添加数据</strong>'); 			
			$("#yt_dialog_form").modal('show') ; 	
	  }	 

	 function count1() {   // 输入数量 单价 计算金额  数量*单价=金额	
		 var checkvalid = true;		   
			   checkvalid = checkvalid && checkRegexp( $( "#goods_quantity" ) , /^[0-9]*[1-9][0-9]*$/,"" ) ;	
			   checkvalid = checkvalid && checkRegexp( $( "#goods_unitprice" ) , /^(-?\d+)(\.\d+)?$/,"" ) ;	
			   if (checkvalid) {
				  $( "#goods_money" ).val( (( $( "#goods_quantity" ).val()-0 )*( $( "#goods_unitprice" ).val()-0 )).toFixed(2) ) ;
			   }
      } 	  
	  
	 function count2() {   // 输入金额 单价 单价  单价=金额/数量
		 var checkvalid = true;		   
			   checkvalid = checkvalid && checkRegexp( $( "#goods_quantity" ) , /^[0-9]*[1-9][0-9]*$/,"" ) ;	
			   checkvalid = checkvalid && checkRegexp( $( "#goods_money" ) , /^(-?\d+)(\.\d+)?$/,"" ) ;	
		var i=	( $( "#goods_quantity" ).val()-0 ) ;   
			   if ((checkvalid) && (i!=0) ) {
				  $( "#goods_unitprice" ).val( (( $( "#goods_money" ).val()-0 )/( $( "#goods_quantity" ).val()-0 ) ).toFixed(2) ) ;
			   }	 
      }  

	  
    var rowCount=1;  //行号  
  
    function  btn_submit_addgoods() {   //确认提交添加商品
		 var checkvalid = true;
		       checkvalid = checkvalid && checkEmpty( $( "#goods_type" ) , "商品分类" ) ;
			   checkvalid = checkvalid && checkEmpty( $( "#goods_name" ) , "商品名称" ) ;	   
			   checkvalid = checkvalid && checkEmpty( $( "#goods_unit" ) , "单位" ) ;			 		 
			   checkvalid = checkvalid && checkRegexp( $( "#goods_quantity" ) , /^[0-9]*[1-9][0-9]*$/,"数量必须是大于零的整数" ) ;	
			   checkvalid = checkvalid && checkRegexp( $( "#goods_unitprice" ) , /^(-?\d+)(\.\d+)?$/,"单价必须是有效的数字" ) ;	
			   checkvalid = checkvalid && checkRegexp( $( "#goods_money" ) , /^(-?\d+)(\.\d+)?$/,"金额必须是有效的数字" ) ;	
         if (checkvalid) {	
		       var goods_type = trim( ( $( "#goods_type" ).find("option:selected").text() ).replace("├", "") ) ;
			   var str='<tr id="option'+rowCount+'" >';
					str=str+'<td>'+$( "#goods_name" ).find("option:selected").text()+'</td>';
					str=str+'<td  class="yt_nodisplay" >'+$( "#goods_name" ).val()+'</td>';
					str=str+'<td>'+goods_type+'</td>';
					str=str+'<td  class="yt_nodisplay"  >'+$( "#goods_type" ).val()+'</td>';
					str=str+'<td>'+$( "#goods_unit" ).val()+'</td>';
					str=str+'<td  class="yt_text_right">'+$( "#goods_quantity" ).val()+'</td>';
					str=str+'<td  class="yt_text_right">'+$( "#goods_unitprice" ).val()+'</td>';			
					str=str+'<td  class="yt_text_right">'+$( "#goods_money" ).val()+'</td>';
					
					str=str+'<td>'+$( "#goods_number" ).val()+'</td>';
					str=str+'<td>'+$( "#goods_specs" ).val()+'</td>';
					str=str+'<td>'+$( "#goods_memo" ).val()+'</td>';	
					
                    str=str+'<td  class="yt_nodisplay" >'+$( "#regular_maintenance" ).val()+'</td>';	
					str=str+'<td  class="yt_nodisplay" >'+$( "#regular_visits" ).val()+'</td>';
					str=str+'<td  class="yt_nodisplay" >'+$( "#warranty_period" ).val()+'</td>';
					str=str+'<td  class="yt_nodisplay" >'+$( "#warranty_period_txt" ).val()+'</td>';
					str=str+'<td  class="yt_nodisplay" >'+$( "#property" ).val()+'</td>';

					str=str+'<td><a class="btn red btn-xs" href="javascript:del_tr('+rowCount+') ;">删除 <i class="icon-remove"></i>	</a> </td>';	
					str=str+'</tr>';

			   var str1='<tr id="option_bak'+rowCount+'" >';
					str1=str1+'<td>'+$( "#goods_name" ).find("option:selected").text()+'</td>';
					str1=str1+'<td  class="yt_nodisplay" >'+$( "#goods_name" ).val()+'</td>';
					str1=str1+'<td>'+goods_type+'</td>';
					str1=str1+'<td  class="yt_nodisplay"  >'+$( "#goods_type" ).val()+'</td>';
					str1=str1+'<td>'+$( "#goods_unit" ).val()+'</td>';
					str1=str1+'<td  class="yt_text_right">'+$( "#goods_quantity" ).val()+'</td>';
					str1=str1+'<td  class="yt_text_right">'+$( "#goods_unitprice" ).val()+'</td>';			
					str1=str1+'<td  class="yt_text_right">'+$( "#goods_money" ).val()+'</td>';
					str1=str1+'<td>'+$( "#goods_number" ).val()+'</td>';
					str1=str1+'<td>'+$( "#goods_specs" ).val()+'</td>';					
					str1=str1+'<td>'+$( "#goods_memo" ).val()+'</td>';	
					str1=str1+'</tr>';					
				 $('#yt_table').append(str);
				 $('#yt_table_bak').append(str1);
				 rowCount=rowCount+1;
				 $('#yt_dialog_form').modal('hide');				 
				 table_sum();//重新计算 数量合计和金额合计
		 }
	}

	function del_tr(rowIndex){
	   if (confirm("确认要删除选中的行？")) {
         $("#option"+rowIndex).remove();  
		 $("#option_bak"+rowIndex).remove();  
		 table_sum();//重新计算 数量合计和金额合计
	    }
    };
	
	function table_sum(){
     var i=0,j=0,k=0,t=0,str="[";	 
		$("#yt_table tr").each(function(trindex,tritem){  //遍历表格行  onclick="JavaScript:save_record() "  >
            if  ( trindex!=0 ) {
     		  i=i+ ($(tritem).find('td:eq(5)').html()-0);
			  j=j+ ($(tritem).find('td:eq(7)').html()-0);			  			  
			 if  (str.length==1) { str=str+"{"; }  else { str=str+",{"; }
				 str=str+"'goods_name':'"+ trim( $(tritem).find('td:eq(0)').html() ) + "',";
				 str=str+"'goods_name_id':'"+ trim( $(tritem).find('td:eq(1)').html() )  + "',";
				 str=str+"'goods_type':'"+ trim( $(tritem).find('td:eq(2)').html() )  + "',";
				 str=str+"'goods_type_id':'"+ trim( $(tritem).find('td:eq(3)').html() )  + "',";
				 str=str+"'goods_unit':'"+ trim( $(tritem).find('td:eq(4)').html() )  + "',";
				 str=str+"'goods_quantity':'"+ trim( $(tritem).find('td:eq(5)').html() )  + "',";
				 str=str+"'goods_unitprice':'"+ trim( $(tritem).find('td:eq(6)').html() )  + "',";
				 str=str+"'goods_money':'"+ trim( $(tritem).find('td:eq(7)').html() )  + "',";	
				 str=str+"'goods_number':'"+ trim($(tritem).find('td:eq(8)').html() )+  "',";	
				 str=str+"'goods_specs':'"+ trim($(tritem).find('td:eq(9)').html() )+  "',";		 
				 str=str+"'goods_memo':'"+ $(tritem).find('td:eq(10)').html() +  "',";		
				 str=str+"'regular_maintenance':'"+ $(tritem).find('td:eq(11)').html() + "',";
				 str=str+"'regular_visits':'"+ $(tritem).find('td:eq(12)').html() + "',";
				 str=str+"'warranty_period':'"+ $(tritem).find('td:eq(13)').html() + "',";	
				 str=str+"'warranty_period_txt':'"+ $(tritem).find('td:eq(14)').html() + "',";	
				 str=str+"'property':'"+ $(tritem).find('td:eq(15)').html() + "'";					 
		    	 str=str+"}";			 
			}  
	    });	 		
	   j=j.toFixed(2) ;		
	  str=str+"]";
	  $("#sales_json").val(str);  //销售记录明细json字符串 传到服务器端做处理
	  $("#sale_quantity").val(i);  //销售记录的数量值 传到服务器端做处理
	  $("#salegoods_money").val(j);  //销售商品金额合计 传到服务器端做处理

	  if (  checkRegexp( $( "#discount_money" ) , /^(-?\d+)(\.\d+)?$/,"" ) ) {
	     k=(trim($( "#discount_money" ).val())-0).toFixed(2);  
		 t=(j-k).toFixed(2); ;
		 $("#discount_money").val(k); 
		 $("#discount_money_bak").val(k); 
		 $("#sale_money").val(t);  //销售记录的金额值 传到服务器端做处理  商品金额-折扣=销售金额
		 $("#total_salemoney1_bak").val(t);	
	  }	else {
	     $("#discount_money").val(0.00); 
		 $("#discount_money_bak").val(0.00); 
		 $("#sale_money").val(j);  //销售记录的金额值 传到服务器端做处理  商品金额-折扣=销售金额
		 $("#total_salemoney1_bak").val(j);
	  }

	  $("#total_salequantity").html(i);	
	  $("#total_salequantity_bak").html(i);	
	  $("#total_salemoney_bak").val(j);	
    };