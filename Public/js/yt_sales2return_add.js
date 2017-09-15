    $("input[name='input_quantity']").live('input',function(e){  
		 var checkvalid = true;		   
			   checkvalid = checkvalid && checkRegexp( $(this) , /^[0-9]*[1-9][0-9]*$/,"" ) ;	
			   if ( (checkvalid)  ){  //判断当前的
			      if  (  (table_checkdata2()) && (table_checkdata1()) ){
				        table_sum();
				  }
			   }	
    });
	
	function table_checkdata1(){   //判断 退货数量不能大于销售数量
		 var i1=0,i2=0,checkvalid = true; 
			$("#yt_table1 tr").each(function(trindex,tritem){  //遍历表格行   "  >
				if  ( trindex!=0 ) {
				  i1=($(tritem).find('input').val()-0);  //数量
				  i2=($(tritem).find('td:eq(6)').html()-0);   //最大数量		  			  
				  if  (i1>i2) { 
				   checkvalid = false;
				   alert( "退货商品："+$(tritem).find('td:eq(0)').html()+ "，错误提示：退货数量不能大于销售数量 " );  
				  } 
				}  
			});	 
		   return checkvalid;		
    };	
	
 	function table_checkdata2(){   //判断 退货数量数量必须是大于零的整数
		  var checkvalid = true, str=''; 
			$("#yt_table1 tr").each(function(trindex,tritem){  //遍历表格行   "  >
				if  ( trindex!=0 ) {
				   str="退货商品："+$(tritem).find('td:eq(0)').html()+ "，错误提示：退货数量数量必须是大于零的整数 ";
				   checkvalid = checkvalid && checkRegexp( $(tritem).find('input') , /^[0-9]*[1-9][0-9]*$/,str ) ;
				}  
			});	 
		   return checkvalid;		
    };	
	
   function table_checkdata3() {   // 提交前做验证  Verify the results
         var checkvalid = true;
		 	//   checkvalid = checkvalid && checkRegexp( $( "#return_money" ) , /^(-?\d+)(\.\d+)?$/,"退货金额必须是有效的数字" ) ;
			   checkvalid = checkvalid && checkRegexp( $( "#return_money" ) , /^\d+(\.\d+)?$/,"退货金额必须是大于零的数字" ) ;
               checkvalid = checkvalid && checkComparisons( $( "#return_money" ) , $( "#oredersale_money" ) , "退货金额不能大于销售金额" ) ;			   
		 	   checkvalid = checkvalid && checkEmpty( $( "#date_return" ) , "退货日期" ) ;
			   checkvalid = checkvalid && checkEmpty( $( "#gestor" ) , "经办人" ) ;	   
			   checkvalid = checkvalid && checkEmpty( $( "#returnreason" ) , "退货原因" ) ;	
	     return checkvalid;
   }
   
   $("input:checkbox[name='order_checkbox']").change(function () {	
       var str="",html="";	 
		$("#yt_table tr").each(function(trindex,tritem){  //遍历表格行 		
		    if  ( $(tritem).find("input:checkbox[name='order_checkbox']:checked").val() !=null  )  {
			        str=str+"<tr>";
					str=str+'<td>'+trim( $(this).find('td:eq(1)').html()) +'</td>';
					str=str+'<td class="yt_nodisplay" >'+trim( $(this).find('td:eq(2)').html()) +'</td>';					
					str=str+'<td>'+trim( $(this).find('td:eq(3)').html()) +'</td>';
					str=str+'<td class="yt_nodisplay" >'+trim( $(this).find('td:eq(4)').html()) +'</td>';					
					str=str+'<td>'+trim( $(this).find('td:eq(5)').html()) +'</td>';
					
					str=str+'<td class="yt_text_right" >';								
					str=str+'<input type="text" name="input_quantity"  class="yt_input-small70  yt_text_right " value='+ trim( $(this).find('td:eq(6)').html()) +'  />';
					str=str+'</td>';
					
                    str=str+'<td class="yt_nodisplay" >'+trim( $(this).find('td:eq(6)').html()) +'</td>';
                    str=str+'<td class="yt_text_right" >'+trim( $(this).find('td:eq(7)').html()) +'</td>';
                    str=str+'<td class="yt_text_right" >'+trim( $(this).find('td:eq(8)').html()) +'</td>';					
					str=str+'<td>'+trim( $(this).find('td:eq(9)').html()) +'</td>';
					str=str+'<td>'+trim( $(this).find('td:eq(10)').html()) +'</td>';
					str=str+'</tr>';			
			}			
	    });
		if (str=="") {
		   html= '  <div class="news-blocks yt_margintop15 ">'  +
 				 '	   <h4>无退货商品，请在上面的商品列表中选择需要退货的商品...</h4>' +
                 '  </div>	' ;		
		} else {
		    html=   ' <table class="table table-striped table-bordered table-hover table-full-width  row-border order-column      " id="yt_table1"> '+ 
  				    '       <thead >'+
				    '         <tr>'+
					'						  <th>退货商品名称</th> '+
					'						  <th class="yt_nodisplay" >名称id</th> '+
					'						  <th>商品分类</th>'+
					'						  <th  class="yt_nodisplay" >分类id</th>'+
					'						  <th>单位</th>'+
					'						  <th class="yt_text_right">退货数量</th>'+					
					'						  <th   class="yt_nodisplay" >最大数量</th>'+						
					'						  <th class="yt_text_right">退货单价</th>'+
					'						  <th class="yt_text_right">退货金额</th>'+									
					'						  <th >商品描述</th>	'+
					'						  <th >商品属性</th>	'+
					'					   </tr>'+
					'					</thead>	'+				
					'					<tbody>	'+ str+	
					'					</tbody>'+
					'				 </table> <br>';	
					
		}
		$("#goodslist").html(html);	 
		table_sum();
    });
		
 	function table_sum(){
     var i=0,j=0,k1=0,k2=0,k3=0,str="[";	 
		$("#yt_table1 tr").each(function(trindex,tritem){  //遍历表格行   "  >
            if  ( trindex!=0 ) {
     		  i=i+ ($(tritem).find('input').val()-0);  //累计数量
			  k1= ($(tritem).find('input').val()-0); //数量
			  k2= ($(tritem).find('td:eq(7)').html()-0); //单价
			  k3=(k1*k2).toFixed(2);	//数量*单价		  
			  $(tritem).find('td:eq(8)').html(k3);	 
			  j=j+ ($(tritem).find('td:eq(8)').html()-0);   //合计金额			  			  
			 if  (str.length==1) { str=str+"{"; }  else { str=str+",{"; }
				 str=str+"'goods_name':'"+ trim( $(tritem).find('td:eq(0)').html() ) + "',";
				 str=str+"'goods_name_id':'"+ trim( $(tritem).find('td:eq(1)').html() )  + "',";
				 str=str+"'goods_type':'"+ trim( $(tritem).find('td:eq(2)').html() )  + "',";
				 str=str+"'goods_type_id':'"+ trim( $(tritem).find('td:eq(3)').html() )  + "',";
				 str=str+"'goods_unit':'"+ trim( $(tritem).find('td:eq(4)').html() )  + "',";
				 str=str+"'goods_quantity':'"+ trim( $(tritem).find('input').val() )  + "',";
				 str=str+"'goods_unitprice':'"+ trim( $(tritem).find('td:eq(7)').html() )  + "',";
				 str=str+"'goods_money':'"+ trim( $(tritem).find('td:eq(8)').html() )  + "',";	
				 str=str+"'goods_memo':'"+ trim( $(tritem).find('td:eq(9)').html() )  +  "',";				 
				 str=str+"'property':'"+ trim(  $(tritem).find('td:eq(10)').html() )  + "'";					 
			 str=str+"}";			 
			}  
	    });	 		
	   j=j.toFixed(2) ;		
	  str=str+"]";
	  $("#return_json").val(str);  //退货记录明细json字符串 传到服务器端做处理
	  $("#return_quantity").val(i);  //退货数量值 传到服务器端做处理
	  $("#return_money").val(j);  //退货记录的金额值 传到服务器端做处理	
    };	