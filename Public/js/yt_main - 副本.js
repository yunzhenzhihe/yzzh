
     StringLength000 = 0;
	 StringLength001 = 1;
	 StringLength002 = 2;
	 StringLength010 = 10;
	 StringLength020 = 20;
	 StringLength050 = 50;
	 StringLength100 = 100;
	 StringLength150 = 150;
	 StringLength255 = 255;
	 StringLength500 = 500;  //变量当常量来使用 字符的宽度
	 
Date.prototype.Format = function (fmt) { //author: meizz 
    var o = {
        "M+": this.getMonth() + 1, //月份 
        "d+": this.getDate(), //日 
        "h+": this.getHours(), //小时 
        "m+": this.getMinutes(), //分 
        "s+": this.getSeconds(), //秒 
        "q+": Math.floor((this.getMonth() + 3) / 3), //季度 
        "S": this.getMilliseconds() //毫秒 
    };
    if (/(y+)/.test(fmt)) fmt = fmt.replace(RegExp.$1, (this.getFullYear() + "").substr(4 - RegExp.$1.length));
    for (var k in o)
    if (new RegExp("(" + k + ")").test(fmt)) fmt = fmt.replace(RegExp.$1, (RegExp.$1.length == 1) ? (o[k]) : (("00" + o[k]).substr(("" + o[k]).length)));
    return fmt;
}	 
	  
		
function checkLength( o, n, min, max ) {   // 弹出添加 修改数据框 提交前做数据宽度验证 
	if ( trim(o.val()).length > max || trim(o.val()).length < min ) {
			alert( n + " 长度必须在" + min + "--" + max + "之间" );  
			return false;
	} else {
			return true;
	}	
	return true;
}

function checkEmpty( o , n ) {   // 弹出添加 修改数据框 提交前做 空 验证 
	if ( trim(o.val()).length < 1 ) {
			alert( n + " 不能为空 " );  
			return false;
	} else {
			return true;
	}	
	return true;
}

function checkComparisons( o1 , o2 , n ) {   // 弹出添加 修改数据框 提交前做 比较大小 验证 
   var i1=0,i2=0;
   i1=(trim(o1.val())-0);  
   i2=(trim(o2.val())-0);  
	if ( i1>i2 ) {
			alert( n );  
			return false;
	} else {
			return true;
	}	
	return true;
}

function checkGreaterthanzero( o1 , n ) {   // 弹出添加 大于零  验证 
   var i1=0;
   i1=(trim(o1.val())-0);  
	if ( i1<0 ) {
			alert( n );  
			return false;
	} else {
			return true;
	}	
	return true;
}

function checkRegexp( o, regexp, n ) {     // 弹出添加 修改数据框 提交前做正则表达式验证 
		if ( !( regexp.test( trim(o.val()) ) ) ) {
		    if ( n.length>0 ) {
			    alert( n  );
			}			
			return false;
		} else {
			return true;
		}
}

function IsPC() {
    var userAgentInfo = navigator.userAgent;
    var Agents = ["Android", "iPhone",
                "SymbianOS", "Windows Phone",
                "iPad", "iPod"];
    var flag = true;
    for (var v = 0; v < Agents.length; v++) {
        if (userAgentInfo.indexOf(Agents[v]) > 0) {
            flag = false;
            break;
        }
    }
    return flag;
}


function arrTojson(arr){   //返回的是json字符串 不是json对象 在ajax里面 需要转换成对象 eval('('+arrTojson( 字符串数组 )+')');
	var i,jsonstr;
	jsonstr='{';
	for(i=0;i<arr.length;i++){
	    arr[i+1] = replaceEscape(arr[i+1].toString()); //把双引号，替换 
		jsonstr += "\"" + arr[i] + "\""+ ":" + "\"" + arr[i+1] + "\",";
		i++;
	}
	jsonstr = jsonstr.substring(0,jsonstr.lastIndexOf(','));
	jsonstr += '}';
	return jsonstr;
}

function replaceEscape(String){   //处理 json 字符串中的特殊字符  
	return  String.toString().replace(/"/g,"“").replace(/[\r]/g,"<br>").replace(/[\n]/g,"<br>").replace(/[\t]/g,"").replace(/[\f]/g,"").replace(/[\b]/g,"").replace(/[\\]/g,"\\\\");	 //把双引号，替换	  

     //  '\b':      //退格  “
     //  '\f':      //走纸换页
     //  '\n':      //换行
     //  '\r':      //回车
     //  '\t':      //横向跳格
	 
	}
		
function clickCheckbox() {    //全选
            if($("#checkall").attr("checked")) 
                { 
                    $("input[name='checkbox']").each(function() { 
                    $(this).attr("checked", true); 
                    }); 
                } 
                else 
                { 
                    $("input[name='checkbox']").each(function() { 
                    $(this).attr("checked", false); 
                    }); 
                 }            	
}
	


function showSelect(SelectName,SelectValue){   //遍历select 并且赋值	
  $(SelectName).each(function(){
       $(this).find("option").each(function(){
			if($(this).val() == SelectValue){ 
			   //  alert(SelectName+ ' '+SelectValue  );
				//	$(this).attr("selected","selected"); 
					$(this).attr("selected",true); 
					return false;
			}
       });
  });
}

function showDateBeginEnd(days){   //设置查询起始截至日期
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
   FormComponents.yt_handleDatePickers();	 //自己写的时间选择器 初始化的部分	
}

function trim(str)  {    //去掉字符串的左右空格
    return str.replace(/(^\s*)|(\s*$)/g, '');  
} 

  
function isEmpty(str)  {  //判断字符串为空 不等于空 返回true   否则 false 
    if(str != null && str.length > 0)  
    {  
        return true;  
    }  
    return false;  
}

function get_cookie(c_name) {  //获取某一个Cookie
		if (document.cookie.length>0)
		  {
		  var c_start=document.cookie.indexOf(c_name + "=") ;
		  if (c_start!=-1)
			{ 
				c_start=c_start + c_name.length+1 ;
				var c_end=document.cookie.indexOf(";",c_start);
				if (c_end==-1) c_end=document.cookie.length;
				return unescape(document.cookie.substring(c_start,c_end)) ;
			} 
		  }
		  return "";
}

function get_dx(num) {  //金额小写转大写
  var strOutput = "";  
  var strUnit = '仟佰拾亿仟佰拾万仟佰拾元角分';  
  num += "00";  
  var intPos = num.indexOf('.');  
  if (intPos >= 0)  
    num = num.substring(0, intPos) + num.substr(intPos + 1, 2);  
  strUnit = strUnit.substr(strUnit.length - num.length);  
  for (var i=0; i < num.length; i++)  
    strOutput += '零壹贰叁肆伍陆柒捌玖'.substr(num.substr(i,1),1) + strUnit.substr(i,1);  
    return strOutput.replace(/零角零分$/, '整').replace(/零[仟佰拾]/g, '零').replace(/零{2,}/g, '零').replace(/零([亿|万])/g, '$1').replace(/零+元/, '元').replace(/亿零{0,3}万/, '亿').replace(/^元/, "零元");  
};  

function getNowFormatDate(inc_day) // 当前的年月日  2012-11-14 这样的格式
{ 
	var day = new Date(); 	
	day.setDate(day.getDate()+inc_day);  //做加 减 天数
	var Year = 0; 
	var Month = 0; 
	var Day = 0; 
	var CurrentDate = ""; 
	//初始化时间 
	//Year= day.getYear();//有火狐下2008年显示108的bug 
	Year= day.getFullYear();//ie火狐下都可以 
	Month= day.getMonth()+1; 
	Day = day.getDate(); 
	//Hour = day.getHours(); 
	// Minute = day.getMinutes(); 
	// Second = day.getSeconds(); 
	CurrentDate += Year + "-"; 
	if (Month >= 10 ) 
	{ 
		CurrentDate += Month + "-"; 
	} 
	else 
	{ 
		CurrentDate += "0" + Month + "-"; 
	} 
	if (Day >= 10 ) 
	{ 
		CurrentDate += Day ; 
	} 
	else 
	{ 
		CurrentDate += "0" + Day ; 
	} 
	return CurrentDate; 
}


function getNowFormatDateTime() // 当前的年月日 时分  2012-11-14 03:20 这样的格式
{ 
	var day = new Date(); 	
	day.setDate(day.getDate());  //做加 减 天数
	var Year = 0; 
	var Month = 0; 
	var Day = 0; 
    var HH = 0;            //时
    var MM = 0;          //分		
	var CurrentDate = ""; 
	//初始化时间 
	//Year= day.getYear();//有火狐下2008年显示108的bug 
	Year= day.getFullYear();//ie火狐下都可以 
	Month= day.getMonth()+1; 
	Day = day.getDate(); 	
    HH = day.getHours();            //时
    MM = day.getMinutes();          //分	
	//Hour = day.getHours(); 
	// Minute = day.getMinutes(); 
	// Second = day.getSeconds(); 
	CurrentDate += Year + "-"; 
	if (Month >= 10 ) 
	{ 
		CurrentDate += Month + "-"; 
	} 
	else 
	{ 
		CurrentDate += "0" + Month + "-"; 
	} 
	if (Day >= 10 ) 
	{ 
		CurrentDate += Day+" "; ; 
	} 
	else 
	{ 
		CurrentDate += "0" + Day+" "; ; 
	} 
	
    if  ( HH < 10 )   CurrentDate += "0";   
     CurrentDate += HH + ":";
		
     if ( MM < 10 ) CurrentDate += '0'; 
     CurrentDate += MM; 	

	return CurrentDate; 
}

function getNowBeforDay(day) // 返回多少天前的日期 格式 2012-11-14 
{ 
  var nd = new Date();
   nd = nd.valueOf();
   nd = nd - day * 24 * 60 * 60 * 1000; //day 天前
   nd = new Date(nd); 
   return  nd.Format("yyyy-MM-dd");
}
function getYTself1() {    // 得到当前的YTself  用于排序 等  客户查询排序用
  var url = YTself+'/date_begin/'+$("#date_begin").val()+'/date_end/'+$("#date_end").val();	
	 if ( trim($( "#search_txt" ).val()).length > 0 ) {
		url = url + '/search_key/'+$("#search_key").val()+'/search_txt/'+trim($("#search_txt").val()) ; 
     }
	 
	 if ( trim($( "#searchcustomer_group" ).val()).length > 0 ) {
		url = url + '/searchcustomer_group/'+$("#searchcustomer_group").val() ; 
     }	
	return url;  
}

function getYTself2() {    // 得到当前的YTself  用于排序 等  销售排序用
  var url = YTself+'/date_begin/'+$("#date_begin").val()+'/date_end/'+$("#date_end").val();	
	 if ( trim($( "#search_txt" ).val()).length > 0 ) {
		url = url + '/search_key/'+$("#search_key").val()+'/search_txt/'+trim($("#search_txt").val()) ; 
     }
	 
  return url;  
}

function getYTself3() {    // 得到当前的YTself  用于排序 等  售后 查询使用 排序用
  var url = YTself+'/date_begin/'+$("#date_begin").val()+'/date_end/'+$("#date_end").val();	
      url=url+'/date_type/'+$('input:radio[name="data_type"]:checked').val();	 		
		 if ( trim($( "#search_txt" ).val()).length > 0 ) {
			url = url + '/search_key/'+$("#search_key").val()+'/search_txt/'+trim($("#search_txt").val())+'/flag/2';	
		 } else {
			url = url + '/flag/1';	
		 }
		if   ( $("#status1").prop('checked')) {
			url=url+'/status1/1';
		}
		if   ( $("#status2").prop('checked')) {
			url=url+'/status2/1';
		}
		if   ( $("#status3").prop('checked')) {
			url=url+'/status3/1';
		}
		if   ( $("#status4").prop('checked')) {
			url=url+'/status4/1';
		}	
        
	   return url;  
}

function search_checkdata( text_obj ) {   //  提交前做验证  Verify the results 搜索关键词不为空的验证
		 var checkvalid = true;		 
		 checkvalid = checkvalid && checkEmpty(  text_obj , "搜索关键词" );	 
		 return checkvalid;                                  
}


//客户管理 开始
function YTcustomer_edit(customer_id)	{   //修改客户资料
   window.open( YTapp+'/Customer/customer_edit/id/'+customer_id);
};	

function YTcustomer_sales(customer_guid,customer_info)	{   //查询客户名下销售记录
   window.open( YTapp+'/Sales/customersales_list/customer_guid/'+customer_guid+'/customer_info/'+customer_info);
};

function YTcustomer_service(customer_guid,customer_info)	{   //查询客户名下售后记录
   window.open( YTapp+'/Service/customerservice_list/customer_guid/'+customer_guid+'/customer_info/'+customer_info);
};	

function YTcustomer_calllist(customer_guid,customer_info)	{   //查询客户名下来电记录
   window.open( YTapp+'/Utilcustome/utilcustome_calllist/customer_guid/'+customer_guid+'/customer_info/'+customer_info);
};

//function YTcustomer_map(lat,lng,customer_info)	{   //查询客户地图
//  window.open( YTapp+'/Customer/customer_map/lat/'+lat+'/lng/'+lng+'/customer_info/'+customer_info);
//};  

function YTcustomer_info(guid)	{   //查询客户详情
  window.open( YTapp+'/Utilcustome/utilcustome_info/guid/'+guid);
};

function YTcustomer_regular_type()	{   //设置提醒日  是按年（生日） 还是按日
     if  ( $('input:radio[name="regular_type"]:checked').val() ==0 ) {	 //如果是按年
                 $("#regular_day_type").show();
			} else {
				$("#regular_day_type").hide();
			} 
};

function YTcustomer_statistics()	{   //客户统计   统计 距今多少天 没有来电  没有销售 没有售后  没有回访的 客户是那些
  var url = '';
      if  ( ( $("#status1").prop('checked')) || ( $("#status2").prop('checked')) || ( $("#status3").prop('checked')) || ( $("#status4").prop('checked'))  ){
			if   ( $("#status1").prop('checked')) {
				url=url+'/status1/1';
			}
			if   ( $("#status2").prop('checked')) {
				url=url+'/status2/1';
			}
			if   ( $("#status3").prop('checked')) {
				url=url+'/status3/1';
			}			
	  }   else {
		  alert(" 请选择统计条件（最少选择一个条件） "); 
          return;		  
	  } 
	  
	 if ( !checkRegexp( $( "#search_txt" ) , /^(-?\d+)?$/,"天数必须是整数" ) ) {		 
		  return ;
	 } else {
		  url=url+'/search_txt/'+trim($("#search_txt" ).val());
	 }
     location.href=YTapp+'/Customer/customer_statistics'+url;		
};

//客户管理 结束


$("#YTorder_chk").click(function(){  //全选,全不选的选择框 
		 $('input[name="order_chk"]').attr("checked",this.checked);  
});	
//审核的函数  开始	
function YTbatch_process() {    // 批量处理  审核 打印  完成 销售和售后的订单的状态的流转
	var str="[";
	   $("table input[name='order_chk']:checked").each(function(){ 
		 if  (str.length==1) { str=str+"{"; }  else { str=str+",{"; }
		 str=str+"'id':'"+  $(this).val() + "'";				 
		 str=str+"}";  			 
		});	
	str=str+"]";	
	if (str!="[]") {		
		YTbegin_process(str) ;
	} else {
		alert("请选择需要批量处理的订单（订单前面的方框打钩）");
	}
}

function YTsingle_process(id) {    // 单独处理  审核 打印  完成 销售和售后的订单的状态的流转
  var str="[{'id':'"+id+ "'}]"  ;
  YTbegin_process(str);
}	

function YTbegin_process(str) {    // 开始批量或者单独处理
  if (confirm("确认处理选中的记录？"))	{	 
	location.href=YTsaveurl+'/json/'+str;	
  }
}	
//审核的函数  结束	

//  入库订单处理的相关的函数  开始
function YTadd_stockin()	{   //添加新的入库商品记录 stockin
   window.open( YTapp+'/Stockin/stockin_addinfo');
};

function YTedit_stockin(id)	{   //修改新的入库商品记录 stockin
   window.open( YTapp+'/Stockin/stockin_editinfo/id/'+id );
};

function YTstockin_select_all()	{   //入库订单查询 全部状态
  location.href= YTapp+'/Stockin/stockinseclect_list/status/1/date_begin/'+$("#date_begin").val()+'/date_end/'+$("#date_end").val();	
};	

function YTstockin_select_pending()	{   //入库订单查询 待处理状态的订单
  location.href= YTapp+'/Stockin/stockinseclect_list/status/2/date_begin/'+$("#date_begin").val()+'/date_end/'+$("#date_end").val();		
};	

function YTstockin_select_confirm()	{   //入库订单查询 审核出库完成的订单
  location.href= YTapp+'/Stockin/stockinseclect_list/status/3/date_begin/'+$("#date_begin").val()+'/date_end/'+$("#date_end").val();	
};	

//  入库订单处理的相关的函数  结束

//  商品损耗订单处理的相关的函数  开始
function YTadd_stockloss()	{   //添加新的损耗记录 stockin
   window.open( YTapp+'/Stockloss/stockloss_addinfo');
};

function YTedit_stockloss(id)	{   //修改新的损耗记录记录 stockin
   window.open( YTapp+'/Stockloss/stockloss_editinfo/id/'+id );
};

function YTstockloss_select_all()	{   //损耗订单查询 全部状态
  location.href= YTapp+'/Stockloss/stocklossseclect_list/status/1/date_begin/'+$("#date_begin").val()+'/date_end/'+$("#date_end").val();	
};	

function YTstockloss_select_pending()	{   //损耗订单查询 待处理状态的订单
  location.href= YTapp+'/Stockloss/stocklossseclect_list/status/2/date_begin/'+$("#date_begin").val()+'/date_end/'+$("#date_end").val();		
};	

function YTstockloss_select_confirm()	{   //损耗订单查询 审核完成的订单
  location.href= YTapp+'/Stockloss/stocklossseclect_list/status/3/date_begin/'+$("#date_begin").val()+'/date_end/'+$("#date_end").val();	
};	
//  商品损耗订单处理的相关的函数 结束

//  售后人员领料  退料 订单处理的相关的函数  开始
function YTadd_stockservicestaffout()	{   //添加领料订单
   window.open( YTapp+'/Stockservicestaffout/stockservicestaffout_addinfo');
};

function YTedit_stockservicestaffout(id)	{   //修改领料订单
   window.open( YTapp+'/Stockservicestaffout/stockservicestaffout_editinfo/id/'+id );
};

function YTstockservicestaffout_select_all()	{   //领料订单查询 全部状态
  location.href= YTapp+'/Stockservicestaffout/stockservicestaffoutseclect_list/status/1/date_begin/'+$("#date_begin").val()+'/date_end/'+$("#date_end").val();	
};	

function YTstockservicestaffout_select_pending()	{   //领料订单查询 待处理状态的订单
  location.href= YTapp+'/Stockservicestaffout/stockservicestaffoutseclect_list/status/2/date_begin/'+$("#date_begin").val()+'/date_end/'+$("#date_end").val();		
};	

function YTstockservicestaffout_select_confirm()	{   //领料订单查询 审核出库完成的订单
  location.href= YTapp+'/Stockservicestaffout/stockservicestaffoutseclect_list/status/3/date_begin/'+$("#date_begin").val()+'/date_end/'+$("#date_end").val();	
};	

function YTadd_stockservicestaffin()	{   //添加退料订单
   window.open( YTapp+'/Stockservicestaffin/stockservicestaffin_addinfo');
};

function YTedit_stockservicestaffin(id)	{   //修改退料订单
   window.open( YTapp+'/Stockservicestaffin/stockservicestaffin_editinfo/id/'+id );
};

function YTstockservicestaffin_select_all()	{   //退料订单查询 全部状态
  location.href= YTapp+'/Stockservicestaffin/stockservicestaffinseclect_list/status/1/date_begin/'+$("#date_begin").val()+'/date_end/'+$("#date_end").val();	
};	

function YTstockservicestaffin_select_pending()	{   //退料订单查询 待处理状态的订单
  location.href= YTapp+'/Stockservicestaffin/stockservicestaffinseclect_list/status/2/date_begin/'+$("#date_begin").val()+'/date_end/'+$("#date_end").val();		
};	

function YTstockservicestaffin_select_confirm()	{   //退料订单查询 审核出库完成的订单
  location.href= YTapp+'/Stockservicestaffin/stockservicestaffinseclect_list/status/3/date_begin/'+$("#date_begin").val()+'/date_end/'+$("#date_end").val();	
};	

//  入库订单处理的相关的函数  结束



//售后订单生成中的   从销售订单生成售后订单  开始 
function YTsales2service_select(status)	{   //从销售订单生成售后订单  1:全部的销售订单  2:未售后的销售订单 3:已经售后的销售订单
  location.href= YTapp+'/Service/sales2service_list/status/'+status+'/date_begin/'+$("#date_begin").val()+'/date_end/'+$("#date_end").val();		
};	

function YTsales2service_add(customer_guid,sales_guid,goods_guid)	{   //从销售订单生成售后订单 添加新的售后记录
   window.open( YTapp+'/Service/sales2service_add/guid1/'+customer_guid+'/guid2/'+sales_guid+'/guid3/'+goods_guid);
};

function YTsales2service_select_search()  {   //搜索售后记录
	if ( search_checkdata( $( "#search_txt" ) ) ) { 
	  location.href= YTapp+'/Service/sales2service_list/status/1/search_key/'+$("#search_key").val()+'/search_txt/'+trim($("#search_txt").val()) +'/date_begin/'+$("#date_begin").val()+'/date_end/'+$("#date_end").val();		
  }		
} ;	
	
function YTsales2service_select_search1(event)  {   // 回车搜索
  if(event.keyCode==13){
      YTsales2service_select_search();
  }   		
} ;	



//售后订单生成中的   从销售订单生成售后订单  结束

//售后订单的查询 修改  删除  开始
function YTservice_select_all()	{   //查询全部的售后记录
  location.href= YTapp+'/Service/service_list/date_begin/'+$("#date_begin").val()+'/date_end/'+$("#date_end").val();	
};	

function YTservice_select_search()  {   //搜索售后记录
	if ( search_checkdata( $( "#search_txt" ) ) ) { 
	  location.href=YTapp+'/Service/service_list/search_key/'+$("#search_key").val()+'/search_txt/'+trim($("#search_txt").val()) +'/date_begin/'+$("#date_begin").val()+'/date_end/'+$("#date_end").val();		
  }		
} ;	
	
function YTservice_select_search1(event)  {   // 回车搜索
  if(event.keyCode==13){
      YTservice_select_search();
  }   		
} ;	

function YTadd_service(customer_guid)	{   //添加新的老客户售后记录
   window.open( YTapp+'/Service/service_addinfo/guid/'+customer_guid);
};

function YTedit_service(guid)	{   //修改售后记录
	window.open(YTapp+'/Service/service_editinfo/guid/'+guid);
};

function YTserviceprocess_completed()	{   //查询已经派工完成的订单
   location.href=YTapp+'/Serviceprocess/serviceprocess_completed/date_begin/'+$("#date_begin").val()+'/date_end/'+$("#date_end").val();		
};

function YTserviceprocess_completedinfo(guid)	{   //售后完成以后的数据录入
   window.open( YTapp+'/Serviceprocess/serviceprocess_completedinfo/guid/'+guid);
};	

function YTserviceprocess_confirmlist()	{   //查询已经完成的订单  需要审核的订单
   location.href=YTapp+'/Serviceprocess/serviceprocess_confirm/date_begin/'+$("#date_begin").val()+'/date_end/'+$("#date_end").val();		
};

function YTserviceprocess_confirm(guid)	{   //售后审核
  if (confirm("审核过的订单将不能做任何修改，确认审核？"))	{	 
	location.href=YTapp+'/Serviceprocess/Serviceprocess_confirmsave/guid/'+guid;	
  }
};

function YTserviceprocess_selectdispatch()	{   //派工查询  
  location.href= YTapp+'/Serviceprocess/serviceprocess_dispatch/date_begin/'+$("#date_begin").val()+'/date_end/'+$("#date_end").val();				
};	
							
//售后订单的查询 修改  删除  结束

//返厂操作 的查询 修改  删除  开始

function YTfactory_select_all(flag)	{   //查询全部的投诉记录  处理\审核
  location.href= YTapp+'/Factory/factory_factory_list/date_begin/'+$("#date_begin").val()+'/date_end/'+$("#date_end").val()+'/flag/'+flag;		
};	

function YTfactory_submit() {    // 开始提交处理结果  
	 if ( checkEmpty( $( "#memo" ) , "处理结果" ) ) {
		  var memo=trim( $("#memo").val() );
		  var guid=trim( $("#guid").val() );
		  var express_name=trim( $("#express_name").val() );
		  var express_number=trim( $("#express_number").val() );
		  location.href=YTapp+'/Factory/factory_submit/memo/'+memo+'/guid/'+guid+'/express_name/'+express_name+'/express_number/'+express_number;	
	  }
}

function YTfactory_completed_submit() {    // 开始提交完成结果 
    var guid=trim( $("#guid").val() );
	if (confirm("确认完成？数据将不能再做修改"))	{	 
	    location.href=YTapp+'/Factory/factory_submit/guid/'+guid;	
    }	
}

function YTadd_factory(guid)	{   //添加新的返厂记录
   window.open( YTapp+'/Factory/factory_addinfo/guid/'+guid);
};

function YTedit_factory(guid,order_guid)	{   //修改返厂操作
	window.open(YTapp+'/Factory/factory_editinfo/guid/'+guid+'/order_guid/'+order_guid);
};	

function YTfactory_info(guid,order_guid,flag)	{   //处理, 详情
	window.open(YTapp+'/Factory/factory_info/guid/'+guid+'/order_guid/'+order_guid+'/flag/'+flag);
};

//返厂操作 的查询 修改  删除  结束




//销售订单的查询 修改  删除  开始
function  YTsales_select_all()	{   //查询全部的销售记录
  location.href= YTapp+'/Sales/sales_list/date_begin/'+$("#date_begin").val()+'/date_end/'+$("#date_end").val();	
};	

function YTsales_select_search()  {   //搜索销售记录
	if ( search_checkdata( $( "#search_txt" ) ) ) { 
	  location.href=YTapp+'/Sales/sales_list/search_key/'+$("#search_key").val()+'/search_txt/'+trim($("#search_txt").val()) +'/date_begin/'+$("#date_begin").val()+'/date_end/'+$("#date_end").val();		
  }		
} ;	
	
function YTsales_select_search1(event)  {   // 回车搜索
  if(event.keyCode==13){
      YTsales_select_search();
  }   		
} ;	

function YTsalesprocess_select_all()	{   //查询全部的销售记录 过程管理里面的
  location.href= YTaction;	
};	
	
function YTsalesprocess_select_search()  {   //搜索销售记录 过程管理里面的
	if ( search_checkdata( $( "#search_txt" ) ) ) { 
	  location.href=YTaction+'/search_key/'+$("#search_key").val()+'/search_txt/'+trim($("#search_txt").val()) ;		
  }		
} ;	

function YTsalesprocess_select_search1(event)  {   // 回车搜索 过程管理里面的
  if(event.keyCode==13){
      YTsalesprocess_select_search();
  }   		
} ;	

function YTadd_sales(customer_guid,customer_info)	{   //添加新的销售记录
   window.open( YTapp+'/Sales/sales_addinfo/customer_guid/'+customer_guid+'/customer_info/'+customer_info);
};

function YTedit_sales(guid,customer_info)	{   //修改销售记录
	window.open(YTapp+'/Sales/sales_editinfo/guid/'+guid+'/customer_info/'+customer_info);
};	


//销售订单的查询 修改  删除  结束


//销售订单退货处理  开始 

function YTsales2return_add(customer_guid,sales_guid)	{   //从销售订单生成售后订单 添加新的售后记录
   window.open( YTapp+'/Salesreturn/sales2return_add/guid1/'+customer_guid+'/guid2/'+sales_guid);
};

function YTsales2return_submit() {    // 退货订单确认提交  
	  if  (  (table_checkdata2()) && (table_checkdata1())  && (table_checkdata3()) ){
		   if (confirm("确认数据正确？"))	{	
                var ajaxurl=YTapp+'/Salesreturn/sales2return_ajaxinsert';		   
                yt_ajaxsubmit_dialog(ajaxurl,0,0) ;// ajax提交数据  新增保存  url:ajax网址  ajaxtype：0  新增保存    1：修改保存  successtype=0 成功以后 刷新 可以继续录入新的数据  successtype=1 关闭当前页面 						
	        }
	  }
}
 
function YTsales2return_select(flag)	{   //查询全部的退货记录 用于删除
  location.href= YTapp+'/Salesreturn/return_returnlist/date_begin/'+$("#date_begin").val()+'/date_end/'+$("#date_end").val()+'/flag/'+flag;		
};	

function YTsales2return_select_confirm()	{   //查询全部的退货记录 用于审核入库
  location.href= YTapp+'/Salesreturn/return_confirmlist/date_begin/'+$("#date_begin").val()+'/date_end/'+$("#date_end").val();	
};	


function YTsales2return_confirm(guid)	{   //退货审核 入库
   if (confirm("确认审核入库？"))	{	 
	  location.href=YTapp+'/Salesreturn/return_confirm/guid/'+guid;							
	}
};
//销售订单退货处理  结束


// 订单回访
function YTvisit_sales()	{   //查询 销售完成没有回访过的订单
  location.href= YTapp+'/Visit/visit_sales_list';	
};	

function YTvisit_service()	{   //查询 售后完成没有回访过的订单
  location.href= YTapp+'/Visit/visit_service_list';	
};

function YTvisit_sales_info(guid) {    // 开始处理
 window.open(YTapp+'/Visit/visit_sales_info/guid/'+guid);	
}

function YTvisit_sales_submit() {    // 开始提交销售回访
  var deliveryman=$('input:radio[name="deliveryman"]:checked').val();
  var goods=$('input:radio[name="goods"]:checked').val();  
  var memo=trim( $("#memo").val() );
  var guid=trim( $("#guid").val() );
  location.href=YTapp+'/Visit/visit_sales_completed/deliveryman/'+deliveryman+'/goods/'+goods+'/memo/'+memo+'/guid/'+guid;	
}

function YTvisit_service_info(guid) {    // 开始处理
 window.open(YTapp+'/Visit/visit_service_info/guid/'+guid);	
}

function YTvisit_service_submit() {    // 开始提交售后回访
  var service=$('input:radio[name="service"]:checked').val();
  var money=$('input:radio[name="money"]:checked').val();    
  var memo=trim( $("#memo").val() );
  var guid=trim( $("#guid").val() );
  location.href=YTapp+'/Visit/visit_service_completed/service/'+service+'/money/'+money+'/memo/'+memo+'/guid/'+guid;	
}

function YTvisit_salesstatistics(flag)  {   //销售回访统计
	 var url = '/date_begin/'+$("#date_begin").val()+'/date_end/'+$("#date_end").val()+'/flag/'+flag;	 
	 if (  flag==2  ) {
		 location.href=YTapp+'/Visit/visit_salesstatistics/search_key1/'+trim($("#search_key1" ).val())+'/search_key2/'+trim($("#search_key2" ).val())+url;			 						
	 } else {
		 location.href=YTapp+'/Visit/visit_salesstatistics'+url;		 
	 }
}  ;

function YTvisit_servicestatistics(flag)  {   //售后回访统计
	var url = '/date_begin/'+$("#date_begin").val()+'/date_end/'+$("#date_end").val()+'/flag/'+flag+'/man/'+$('#man').val();	 
	location.href=YTapp+'/Visit/visit_servicestatistics'+url;		 
}  ;

// 订单回访结束


//投诉记录 的查询 修改  删除  开始
function YTcomplain_select_all()	{   //查询全部的投诉记录  修改\删除
  location.href= YTapp+'/Complain/complain_list/date_begin/'+$("#date_begin").val()+'/date_end/'+$("#date_end").val();	
};	

function YTcomplaincompleted_select_all(flag)	{   //查询全部的投诉记录  处理\审核
  location.href= YTapp+'/Complain/complain_completed_list/date_begin/'+$("#date_begin").val()+'/date_end/'+$("#date_end").val()+'/flag/'+flag;		
};	

function YTcomplain_info(guid,customer_info,flag)	{   //处理和审核
	window.open(YTapp+'/Complain/complain_info/guid/'+guid+'/customer_info/'+customer_info+'/flag/'+flag);
};	

function YTcomplain_completed_submit() {    // 开始提交处理结果  
	 if ( checkEmpty( $( "#memo" ) , "处理结果" ) ) {
		  var memo=trim( $("#memo").val() );
		  var guid=trim( $("#guid").val() );
		  location.href=YTapp+'/Complain/complain_completed/memo/'+memo+'/guid/'+guid;	
	  }
}

function YTcomplain_confirm_submit() {    // 开始提交审核结果 
    var guid=trim( $("#guid").val() );
	if (confirm("确认审核？"))	{	 
	    location.href=YTapp+'/Complain/complain_completed/guid/'+guid;	
    }	
}

function YTadd_complain(customer_guid)	{   //添加新的老客户投诉记录
   window.open( YTapp+'/Complain/complain_addinfo/guid/'+customer_guid);
};

function YTedit_complain(guid,customer_info)	{   //修改投诉记录
	window.open(YTapp+'/Complain/complain_editinfo/guid/'+guid+'/customer_info/'+customer_info);
};	

//投诉记录 的查询 修改  删除  结束


//应收账款 的处理  开始

function YTreceivablessales_select_all()	{   //查询全部应收的记录   flag 1：全部订单  2：有应收的订单  3：没有应收得订单
  location.href= YTapp+'/Receivables/receivablessales_list/date_begin/'+$("#date_begin").val()+'/date_end/'+$("#date_end").val();		
};	

function YTreceivablessales_info(guid) {    // 录入 销售 应收款
 window.open(YTapp+'/Receivables/receivablessales_info/guid/'+guid);	
}

function YTreceivablessales_submit() {    // 开始提交应收账款 处理结果  
	 if ( dialogcheckdata() ) {  //检查数据有没有错误
		   if (confirm("确认数据正确？"))	{	 
			  var order_number=trim( $("#order_number").val() );
			  var money=trim( $("#money").val() );
			  var date_received=trim( $("#date_received").val() );
			  var gestor=trim( $("#gestor").val() );
			  var buy_way=trim( $("#buy_way").val() );
			  var memo=trim( $("#memo").val() );
			  var guid=trim( $("#guid").val() );
			  location.href=YTapp+'/Receivables/receivables_submit/order_number/'+order_number+'/money/'+money+'/date_received/'+date_received+'/gestor/'+gestor+'/buy_way/'+buy_way+'/memo/'+memo+'/order_guid/'+guid;							
			}
	 }
}

function YTreceivablessales_selectpaysalesreturn_all()	{   //查询全部应付的记录   
  location.href= YTapp+'/Receivables/paysalesreturn_list/date_begin/'+$("#date_begin").val()+'/date_end/'+$("#date_end").val();		
};	

function YTreceivablessales_payinfo(guid) {    // 录入 应付款
 window.open(YTapp+'/Receivables/paysalesreturn_info/guid/'+guid);	
} 

function YTreceivablessales_paysubmit() {    // 开始提交应付账款 处理结果  
	 if ( dialogcheckdata() ) {  //检查数据有没有错误
		   if (confirm("确认数据正确？"))	{	 
			  var order_number=trim( $("#order_number").val() );
			  var money=trim( $("#money").val() );
			  var date_received=trim( $("#date_received").val() );
			  var gestor=trim( $("#gestor").val() );
			  var buy_way=trim( $("#buy_way").val() );
			  var memo=trim( $("#memo").val() );
			  var guid=trim( $("#guid").val() );
			  location.href=YTapp+'/Receivables/paysalesreturn_submit/order_number/'+order_number+'/money/'+money+'/date_received/'+date_received+'/gestor/'+gestor+'/buy_way/'+buy_way+'/memo/'+memo+'/order_guid/'+guid;							
			}
	 }
}

function YTreceivablesservice_select_all()	{   //查询全部应收的售后记录   flag 1：全部订单  2：有应收的订单  3：没有应收得订单
  location.href= YTapp+'/Receivables/receivablesservice_list/date_begin/'+$("#date_begin").val()+'/date_end/'+$("#date_end").val();		
};	

function YTreceivablesservice_info(guid) {    // 录入 售后 应收款
 window.open(YTapp+'/Receivables/receivablesservice_info/guid/'+guid);	
}

function YTreceivablesservice_submit() {    // 开始提交应收账款 处理结果  
	 if ( dialogcheckdata() ) {  //检查数据有没有错误
		   if (confirm("确认数据正确？"))	{	 
			  var order_number=trim( $("#order_number").val() );
			  var money=trim( $("#money").val() );
			  var date_received=trim( $("#date_received").val() );
			  var gestor=trim( $("#gestor").val() );
			  var buy_way=trim( $("#buy_way").val() );
			  var memo=trim( $("#memo").val() );
			  var guid=trim( $("#guid").val() );
			  location.href=YTapp+'/Receivables/receivablesservice_submit/order_number/'+order_number+'/money/'+money+'/date_received/'+date_received+'/gestor/'+gestor+'/buy_way/'+buy_way+'/memo/'+memo+'/order_guid/'+guid;							
			}
	 }
}


//应收账款 的查询 修改  删除  结束
function YTreceivablesstatistics_salesstatistics(flag)  {   //销售收款统计
	var url = '/date_begin/'+$("#date_begin").val()+'/date_end/'+$("#date_end").val()+'/flag/'+flag+'/gestor/'+$('#gestor').val()+'/buyway/'+$('#buyway').val();	  
	location.href=YTapp+'/Receivablesstatistics/salesstatistics'+url;		 
}  ;

function YTreceivablesstatistics_servicestatistics(flag)  {   //售后收款统计
	var url = '/date_begin/'+$("#date_begin").val()+'/date_end/'+$("#date_end").val()+'/flag/'+flag+'/gestor/'+$('#gestor').val()+'/buyway/'+$('#buyway').val()+'/man/'+$('#man').val();		  
	location.href=YTapp+'/Receivablesstatistics/servicestatistics'+url;		 
}  ;

function YTreceivablesstatistics_salesreturnstatistics(flag)  {   //退款付款统计
	var url = '/date_begin/'+$("#date_begin").val()+'/date_end/'+$("#date_end").val()+'/flag/'+flag+'/gestor/'+$('#gestor').val()+'/buyway/'+$('#buyway').val();	  
	location.href=YTapp+'/Receivablesstatistics/salesreturnstatistics'+url;		 
}  ;

// 收付款统计开始
// 收付款统计结束


//特殊权限 的处理  开始

function YTauthorization_delreceivablessales(guid)	{   // 删除销售应收账款录入记录
   if (confirm("确认删除？"))	{	 
	  location.href=YTapp+'/Authorization/delreceivablessales_submit/guid/'+guid;							
	}
};

function YTauthorization_errorconfirmsales(guid)	{   //销售订单审核错误更正
   if (confirm("确认更正？"))	{	 
	  location.href=YTapp+'/Authorization/errorconfirmsales_submit/guid/'+guid;							
	}
};

function YTauthorization_delpayrecord(guid)	{   // 删除退货  付款录入记录
   if (confirm("确认删除？"))	{	 
	  location.href=YTapp+'/Authorization/delpayrecord_submit/guid/'+guid;							
	}
};

function YTauthorization_errorconfirmreturnsales(guid)	{   //退货订单审核错误更正
   if (confirm("确认更正？"))	{	 
	  location.href=YTapp+'/Authorization/errorconfirmreturnsales_submit/guid/'+guid;							
	}
};

function YTauthorization_delreceivablesservice(guid)	{   // 删除销售应收账款录入记录
   if (confirm("确认删除？"))	{	 
	  location.href=YTapp+'/Authorization/delreceivablesservice_submit/guid/'+guid;							
	}
};

function YTauthorization_errorconfirmservice(guid)	{   //售后订单审核错误更正
   if (confirm("确认更正？"))	{	 
	  location.href=YTapp+'/Authorization/errorconfirmservice_submit/guid/'+guid;							
	}
};

function YTauthorization_watchdog()  {   //日志查询
	var url = '/date_begin/'+$("#date_begin").val()+'/date_end/'+$("#date_end").val();		  
	location.href=YTapp+'/Authorization/watchdog'+url;		 
}  ;

function YTauthorization_watchdog_sale()  {   //被删除销售订单日志查询
	var url = '/date_begin/'+$("#date_begin").val()+'/date_end/'+$("#date_end").val();		  
	location.href=YTapp+'/Authorization/watchdog_sale'+url;		 
}  ;

function YTauthorization_watchdog_ser()  {   //被删除售后订单日志查询
	var url = '/date_begin/'+$("#date_begin").val()+'/date_end/'+$("#date_end").val();		  
	location.href=YTapp+'/Authorization/watchdog_service'+url;		 
}  ;

function YTauthority_watchdog()  {   //用户管理与权限操作日志
	var url = '/date_begin/'+$("#date_begin").val()+'/date_end/'+$("#date_end").val();		  
	location.href=YTapp+'/Authority/watchdog_auth'+url;		 
}  ;


function YTauthorization_watchdoginfo(guid,flag)  {   //售后人员领料\退料统计
 if  ( ( flag == '1' ) || ( flag == '3' ) || ( flag == '4' )  || ( flag == '5' )  )	{
	 YTsalesorder_info( guid ) ;
 }
 
 if  ( ( flag == '2' ) || ( flag == '6' ) )	{
	YTserviceorder_info( guid ) ;
 }
} ;	

//特殊权限 的处理  结束

//参数设置或者其他函数
function YTsetup_goods(flag)	{   //商品名称设置  拉选种类  显示这个种类下的所有商品
	window.open(YTapp+'/Setgoods/goods_list/flag/'+flag);
};	



//参数设置或者其他函数  结束

//定期提醒
function YTsales_regularmaintenance()	{   //查询需要定期维护的商品
  var flag= $('input:radio[name="regular"]:checked').val();
  location.href=YTapp+'/Regular/regularmaintenance_list/flag/'+flag ;
};	

function YTcustomer_regularday()	{   //查询定期提醒的客户  按日
  var flag= $('input:radio[name="regular"]:checked').val();
  location.href=YTapp+'/Regular/regularday_list/flag/'+flag ;
};	

function YTcustomer_regularyear()	{   //查询定期提醒的客户  按年 生日提醒
  var flag= $('input:radio[name="regular"]:checked').val();
  location.href=YTapp+'/Regular/regularyear_list/flag/'+flag ;
};	

function YTcustomer_regular(id) {    // 标记
  if (confirm("标注为已处理 ？标记完成以后本条记录的基准时间用当前时间替换，开始准备下一次提醒"))	{	  
         var ajaxdataArray = new Array();	
			 ajaxdataArray.push(['id']);
			 ajaxdataArray.push([id]);	 
	    var data=jQuery.parseJSON(arrTojson( ajaxdataArray ))  ; 	
        ajax_submit(YTsaveurl,data)  ;
  }
}	

//结束定期提醒




function YTsalesorder_info( order_guid )	{   //销售订单详情 和订单追踪
  window.open( YTapp+'/Util/util_salesorder_info/order_guid/'+order_guid);
};	

function YTsalesgoods_info( guid )	{   //销售订单内的商品的操作追踪 修改质保截至  定期维护  定期回访
  window.open( YTapp+'/Util/util_salesgoods_info/guid/'+guid);
};

function YTserviceorder_info( order_guid )	{   //售后订单详情 和订单追踪
  window.open( YTapp+'/Util/util_serviceorder_info/order_guid/'+order_guid);
};

function YTstockinout_list( guid )	{   //商品出入库明细查询
  window.open( YTapp+'/Util/util_stockinout_list/guid/'+guid);
};

function YTcustomer_map(lat,lng,customer_info)	{   //查询客户地图
  window.open( YTapp+'/Util/util_customer_map/lat/'+lat+'/lng/'+lng+'/customer_info/'+customer_info);
};  
	
function YTsales2service_list( order_guid )	{   //某条销售转售后订单的列表 比如转了几次 什么时间转的   order_guid ：销售订单号
  window.open( YTapp+'/Util/util_sales2service_list/order_guid/'+order_guid);
};	

function YTnumberofrows(number)  {   //翻页
   var url=window.location.href.replace(/NumberOfRows/g,"NumberOfFlag").replace(/%2F/g,"/").replace(/&type=/g,"/type/").replace(/&p=/g,"/p/"); //替换	   %2f   &type=
   location.href= url+'/NumberOfRows/'+number;		
} ;	

function YTsearch_customer()  {   //搜索客户
	if ( search_checkdata( $( "#search_txt" ) ) ) { 
		location.href= YTaction+'/search_key/'+$("#search_key").val()+'/search_txt/'+trim( $("#search_txt").val() ) +'/date_begin/'+$("#date_begin").val()+'/date_end/'+$("#date_end").val();	
	}		
} ;	

function YTsearch_customer1(event)  {   //搜索客户  回车
	if(event.keyCode==13){
	 YTsearch_customer();
	 }   		
} ;

function YTsearch_allcustomer7()  {   //搜索最近5天录入的客户
    location.href= YTaction+'/allcustomer/abcde';		
} ;

function YTsearch_customergroup(searchcustomer_group)  {   //搜索客户
   location.href= YTaction+'/searchcustomer_group/'+searchcustomer_group +'/date_begin/'+$("#date_begin").val()+'/date_end/'+$("#date_end").val();		
} ;	


 function YTwizard_checkdata() {   // 导航框架在点下一步的时候验证  是否是有校的数字灯
	 var checkvalid = true;
	   if ( $("#money_materials").length>0 ) { 
	       checkvalid = checkvalid && checkRegexp( $( "#money_materials" ) , /^(-?\d+)(\.\d+)?$/,"备件费用必须是有效的数字" ) ;	 		
	   }
	   
	   if ( $("#money_transportation").length>0 ) { 
	       checkvalid = checkvalid && checkRegexp( $( "#money_transportation" ) , /^(-?\d+)(\.\d+)?$/,"交通费用必须是有效的数字" ) ;	 		
	   }

	   if ( $("#money_maintenance").length>0 ) { 
	       checkvalid = checkvalid && checkRegexp( $( "#money_maintenance" ) , /^(-?\d+)(\.\d+)?$/,"维修费用必须是有效的数字" ) ;	 		
	   }	
	   
	   if ( $("#money_other").length>0 ) { 
	       checkvalid = checkvalid && checkRegexp( $( "#money_other" ) , /^(-?\d+)(\.\d+)?$/,"其它费用必须是有效的数字" ) ;	 		
	   }	 

	   if ( $("#discount_money").length>0 ) { 
	       checkvalid = checkvalid && checkRegexp( $( "#discount_money" ) , /^(-?\d+)(\.\d+)?$/,"折扣金额必须是有效的数字" ) ;	 		
	   }	

	   if ( $("#sales_json").length>0 ) {   //销售商品明细 判断是否有重复的商品 
	     	var str1='',str2='';      
		    var  json=jQuery.parseJSON( $("#sales_json").val().replace(/'/g,'"') );
			for(var i=0; i<json.length; i++) 
			{ 
				str1=json[i].goods_name_id;
				str2=json[i].goods_name;							
				for(var j=(i+1);j<json.length;j++){  
					if ( str1==json[j].goods_name_id ) {
						alert(str2+" 重复了，商品名称不能重复"); 
						checkvalid =false;
						break;
					}					  
				}  							
		   }  			  
	   }	   
	   
	 return checkvalid;
  }

function YTsearchnumber_record()  {   //按单号搜索记录 有起始截至日期
	if ( search_checkdata( $( "#search_txt" ) ) ) { 
	  location.href=YTaction+'/search_key/'+$("#search_key").val()+'/search_txt/'+trim($("#search_txt").val()) +'/date_begin/'+$("#date_begin").val()+'/date_end/'+$("#date_end").val();		
  }		
} ;	
	
function YTsearchnumber_record1(event)  {   // 回车搜索  按单号搜索记录 有起始截至日期
  if(event.keyCode==13){ 
      YTsearchnumber_record();
  }   		
} ;	


function YTsearchnumber()  {   //按单号搜索记录 无起始截至日期
	if ( search_checkdata( $( "#search_txt" ) ) ) { 
	  location.href=YTaction+'/search_txt/'+trim($("#search_txt").val()) ;		
  }		
} ;	
	
function YTsearchnumber1(event)  {   // 回车搜索  按单号搜索记录 无起始截至日期
  if(event.keyCode==13){ 
      YTsearchnumber();
  }   		
} ;	


function YTselect_timeinterval()	{   //查询记录  带起始截至日期 
  location.href= YTaction+'/date_begin/'+$("#date_begin").val()+'/date_end/'+$("#date_end").val();	
};	

function YTsearch_timeinterval_key()  {   //搜索记录 带起始截至日期 有搜索关键字
	if ( search_checkdata( $( "#search_txt" ) ) ) { 
	  location.href=YTaction+'/search_key/'+$("#search_key").val()+'/search_txt/'+trim($("#search_txt").val()) +'/date_begin/'+$("#date_begin").val()+'/date_end/'+$("#date_end").val();		
  }		
} ;	

function YTsearch_timeinterval_key1(event)  {   // 回车搜索   带起始截至日期 有搜索关键字
  if(event.keyCode==13){ 
      YTsearch_timeinterval_key();
  }   		
} ;

function YTsearch_interval_key()  {   //搜索记录 不带带起始截至日期 有搜索关键字
	if ( search_checkdata( $( "#search_txt" ) ) ) { 
	  location.href=YTaction+'/search_key/'+$("#search_key").val()+'/search_txt/'+trim($("#search_txt").val()) ;		
  }		
} ;	

function YTsearch_interval_key1(event)  {   // 回车搜索   不带带起始截至日期 有搜索关键字
  if(event.keyCode==13){ 
      YTsearch_interval_key();
  }   		
} ;

function YTsearch_timeinterval_nokey()  {   //搜索记录 带起始截至日期 没有搜索关键字 
	if ( search_checkdata( $( "#search_txt" ) ) ) { 
	  location.href=YTaction+'/search_txt/'+trim($("#search_txt").val()) +'/date_begin/'+$("#date_begin").val()+'/date_end/'+$("#date_end").val();		
  }		
} ;	

function YTsearch_timeinterval_nokey1(event)  {   // 回车搜索   带起始截至日期 没有搜索关键字 
  if(event.keyCode==13){ 
      YTsearch_timeinterval_nokey();
  }   		
} ;

//销售统计开始’
function YTsalesstatistics_salesman(flag)  {   
  var url = '/date_begin/'+$("#date_begin").val()+'/date_end/'+$("#date_end").val();
      url=url+'/date_type/'+$('input:radio[name="data_type"]:checked').val();
	  url=url+'/salesman/'+$('#salesman').val();
      if  ( ( $("#status1").prop('checked')) || ( $("#status2").prop('checked'))  ){
			if   ( $("#status1").prop('checked')) {
				url=url+'/status1/1';
			}
			if   ( $("#status2").prop('checked')) {
				url=url+'/status2/1';
			}
		    location.href=YTapp+'/Salesstatistics/statistics_salesman/flag/'+flag+url;		
	  }   else {
		  alert(" 请选择订单状态 "); 
	  } 

} ;	

function YTsalesstatistics_salesunit(flag)  {   
  var url = '/date_begin/'+$("#date_begin").val()+'/date_end/'+$("#date_end").val();
      url=url+'/date_type/'+$('input:radio[name="data_type"]:checked').val();
	  url=url+'/salesunit/'+$('#salesunit').val();
      if  ( ( $("#status1").prop('checked')) || ( $("#status2").prop('checked'))  ){
			if   ( $("#status1").prop('checked')) {
				url=url+'/status1/1';
			}
			if   ( $("#status2").prop('checked')) {
				url=url+'/status2/1';
			}
		    location.href=YTapp+'/Salesstatistics/statistics_salesunit/flag/'+flag+url;		
	  }   else {
		  alert(" 请选择订单状态 "); 
	  } 

} ;	

function YTsalesstatistics_salesrecord(flag)  {   
  var url = '/date_begin/'+$("#date_begin").val()+'/date_end/'+$("#date_end").val();
      url=url+'/date_type/'+$('input:radio[name="data_type"]:checked').val();
      if  ( ( $("#status1").prop('checked')) || ( $("#status2").prop('checked'))  ){
			if   ( $("#status1").prop('checked')) {
				url=url+'/status1/1';
			}
			if   ( $("#status2").prop('checked')) {
				url=url+'/status2/1';
			}
		    location.href=YTapp+'/Salesstatistics/statistics_salesrecord/flag/'+flag+url;		
	  }   else {
		  alert(" 请选择订单状态 "); 
	  } 

} ;	

function YTsalesstatistics_salesgoods(flag)  {   
  var url = '/date_begin/'+$("#date_begin").val()+'/date_end/'+$("#date_end").val();
      url=url+'/date_type/'+$('input:radio[name="data_type"]:checked').val();
  	  url=url+'/goods_type/'+$('#goods_type_statistics').val();
	  url=url+'/goods_name/'+$('#goods_name_statistics').val();	  
      if  ( ( $("#status1").prop('checked')) || ( $("#status2").prop('checked'))  ){
			if   ( $("#status1").prop('checked')) {
				url=url+'/status1/1';
			}
			if   ( $("#status2").prop('checked')) {
				url=url+'/status2/1';
			}
		    location.href=YTapp+'/Salesstatistics/statistics_salesgoods/flag/'+flag+url;		
	  }   else {
		  alert(" 请选择订单状态 "); 
	  } 

} ;	


//销售统计结束

//售后统计开始’
function YTservicestatistics_servicerecord1(event)  {   // 售后订单查询  回车搜索  
  if(event.keyCode==13){ 
      YTservicestatistics_servicerecord(2);
  }   		
} ;	

function YTservicestatistics_servicerecord(flag)  {   //售后订单查询 模糊查询
	  var url = getServicesStatisticsUrl() ;
	  if  ( url ==  false  )  {
		  return ;
	  } 	  
	  if (flag==2) {  //模糊查询过来
			if ( search_checkdata( $( "#search_txt" ) ) ) { 
			  url=url+'/search_key/'+$("#search_key").val()+'/search_txt/'+trim($("#search_txt").val()) ;	
		  }	 else {
			  return;
		  }		  
	  }	  
      location.href=YTapp+'/Servicestatistics/statistics_servicerecord/flag/'+flag+url;	
} ;	

function YTservicestatistics_servicegoods(flag)  {   //按商品名称统计  flag：1 明细    2：模糊查询
	  var url = getServicesStatisticsUrl() ;
	  if  ( url ==  false  )  {
		  return ;
	  } else {
		  url=url+'/goods_type/'+$('#goods_type_statistics').val();
	      url=url+'/goods_name/'+$('#goods_name_statistics').val();	 
		  location.href=YTapp+'/Servicestatistics/statistics_servicegoods/flag/'+flag+url;
	  }
}  ;

function YTservicestatistics_servicestaff(flag)  {   //按售后人员统计  flag：1 明细    2：模糊查询 yt_left_menu_manage_service_statistics_servicetype
	  var url = getServicesStatisticsUrl() ;
	  if  ( url ==  false  )  {
		  return ;
	  } else {
		  url=url+'/man/'+$('#man').val();
		  location.href=YTapp+'/Servicestatistics/statistics_servicestaff/flag/'+flag+url;
	  }
}  ;

function YTservicestatistics_servicetype(flag)  {   //按售后类型统计  flag：1 明细    2：模糊查询 
	  var url = getServicesStatisticsUrl() ;
	  if  ( url ==  false  )  {
		  return ;
	  } else {
		  url=url+'/servicetype/'+$('#servicetype').val();		  
		  location.href=YTapp+'/Servicestatistics/statistics_servicetype/flag/'+flag+url;
	  }
}  ;

function YTservicestatistics_servicespeed()  {   //售后速度统计
	 if ( !checkRegexp( $( "#search_txt" ) , /^(-?\d+)?$/,"天数必须是整数" ) ) {
			return ;
	 }
	 var url = getServicesStatisticsUrl() ;
	 if  ( url ==  false  )  {
		  return ;
	  } else {
		  location.href=YTapp+'/Servicestatistics/statistics_servicespeed/search_txt/'+trim($("#search_txt" ).val())+'/search_key/'+trim($("#search_key" ).val())+url;
	  }
}  ;

function getServicesStatisticsUrl()  {   //得到售后统计条件的url售后订单统计
  var url = '/date_begin/'+$("#date_begin").val()+'/date_end/'+$("#date_end").val();
      url=url+'/date_type/'+$('input:radio[name="data_type"]:checked').val();	  

      if  ( ( $("#status1").prop('checked')) || ( $("#status2").prop('checked')) || ( $("#status3").prop('checked')) || ( $("#status4").prop('checked')) ){
			if   ( $("#status1").prop('checked')) {
				url=url+'/status1/1';
			}
			if   ( $("#status2").prop('checked')) {
				url=url+'/status2/1';
			}
			if   ( $("#status3").prop('checked')) {
				url=url+'/status3/1';
			}
			if   ( $("#status4").prop('checked')) {
				url=url+'/status4/1';
			}			
		    return url;		
	  }   else {
		  alert(" 请选择订单状态 "); 
		  return false ;
	  } 
} ;	

function YTservicestatistics_servicespareparts(flag)  {   //售后备件查询统计
	 var url = '/date_begin/'+$("#date_begin").val()+'/date_end/'+$("#date_end").val()+'/flag/'+flag;	 
	 if ( ( flag==3 ) || (  flag==4 ) ) {
		 	if ( search_checkdata( $( "#search_txt" ) ) ) {
		        location.href=YTapp+'/Servicestatistics/statistics_servicespareparts/search_txt/'+trim($("#search_txt" ).val())+'/search_key/'+trim($("#search_key" ).val())+url;			 				
			}			
	 } else {
		 location.href=YTapp+'/Servicestatistics/statistics_servicespareparts'+url;		 
	 }
}  ;

function YTservicestatistics_servicespareparts1(event)  {   // 回车搜索  售后备件查询统计
  if(event.keyCode==13){ 
      YTservicestatistics_servicespareparts(3);
  }   		
} ;	


//售后统计结束


//库存统计开始
function YTstockstatistics_stockinout(flag)  {   //出入库统计
  var url = '/date_begin/'+$("#date_begin").val()+'/date_end/'+$("#date_end").val();
      url=url+'/count_type/'+$('input:radio[name="count_type"]:checked').val();
   location.href=YTapp+'/Stockstatistics/statistics_stockinout/flag/'+flag+url;		
} ;	

function YTstockstatistics_stockinoutinfo(order_number,flag_inout,date_end)  {   
  var url =''; 
  var date_begin =''; 
  if (date_end=='') {  date_end = $("#date_end").val(); }
    
  var nd = new Date(date_end);
   nd = nd.valueOf();
   nd = nd - 90 * 24 * 60 * 60 * 1000; //90天前
   nd = new Date(nd);
   
  date_begin=nd.Format("yyyy-MM-dd");
  url = '/date_begin/'+date_begin+'/date_end/'+date_end;
  
   //出入库类型 标记 1：入库 2：退货入库 3：损耗  4：领料 5：退料 6：销售出库
  if  ( flag_inout=='1') { //商品入库
	  window.open( YTapp+'/Stockin/stockinseclect_list/search_txt/'+order_number+url);
  }  
  if  ( flag_inout=='3') { //损耗出库
	  window.open( YTapp+'/Stockloss/stocklossseclect_list/search_txt/'+order_number+url);
  } 
  if  ( flag_inout=='4') { //售后领料出库
	  window.open( YTapp+'/Stockservicestaffout/stockservicestaffoutseclect_list/search_txt/'+order_number+url);
  }
  if  ( flag_inout=='5') { //售后退料入库
	  window.open( YTapp+'/Stockservicestaffin/stockservicestaffinseclect_list/search_txt/'+order_number+url);
  }  
  if  ( flag_inout=='6') { //销售出库
	  window.open( YTapp+'/Sales/sales_list/search_key/order_number/search_txt/'+order_number+url);
  }   
  
 if  ( flag_inout=='2') { //退货入库
	  window.open( YTapp+'/Salesreturn/return_returnlist/flag/3'+url);
  } 
  
 // Salesreturn/return_returnlist/date_begin/2015-06-22/date_end/2015-07-02/flag/3
  
  
} ;	

function YTstockstatistics_stockin(flag)  {   //入库统计
  var url = '/date_begin/'+$("#date_begin").val()+'/date_end/'+$("#date_end").val();
      url=url+'/count_type/'+$('input:radio[name="count_type"]:checked').val();
	  url=url+'/gestor/'+$('#gestor_name').val();
	  url=url+'/supplier/'+$('#supplier_name').val();
   location.href=YTapp+'/Stockstatistics/statistics_stockin/flag/'+flag+url;		
} ;	

function YTstockstatistics_stockselect()  {   //实时库存查询 
  var url = '';
  	  url=url+'/goods_type/'+$('#goods_type_statistics').val();
	  url=url+'/goods_name/'+$('#goods_name_statistics').val();
  if ($('#search_key1').val()!='1') {
		 if ( !checkRegexp( $( "#search_txt" ) , /^(-?\d+)?$/,"天数必须是整数" ) ) {
				return ;
		 }
		 url=url+'/search_key1/'+$('#search_key1').val();
		 url=url+'/search_key2/'+$('#search_key2').val();
		 url=url+'/search_txt/'+$('#search_txt').val();
	}
   location.href=YTapp+'/Stockstatistics/statistics_stockselect/'+url;		
} ;	

function YTstockstatistics_stockservicestaff(flag)  {   //售后人员领料\退料统计
  var url = '/date_begin/'+$("#date_begin").val()+'/date_end/'+$("#date_end").val();
	  url=url+'/man/'+$('#man').val();
   location.href=YTapp+'/Stockstatistics/statistics_stockservicestaff/flag/'+flag+url;		
} ;	


//库存统计结束

//打印报表开始
function YTreport(flag,guid)  {   //打印报表
  var url='/guid/'+guid;
	  if  ( flag == '1') { //销售单打印
		  window.open( YTapp+'/Utilreport/utilprint_salesrecord'+url);  
	  } 
	  if  ( flag == '2') { //售后单打印
		  window.open( YTapp+'/Utilreport/utilprint_servicerecord'+url);  
	  } 	
	  if  ( flag == '3') { //入库单打印
		  window.open( YTapp+'/Utilreport/utilprint_stockinrecord'+url);  
	  } 	 
	  if  ( flag == '4') { //领料单打印
		  window.open( YTapp+'/Utilreport/utilprint_stockservicestaffoutrecord'+url);  
	  } 
	  if  ( flag == '5') { //退料单打印
		  window.open( YTapp+'/Utilreport/utilprint_stockservicestaffinrecord'+url);  
	  } 
	  if  ( flag == '9') { //退料单打印
		  window.open( YTapp+'/Utilreport/utilprint_url');  
	  } 
	  
	  
} ;	

function YTprintpreview() {	//开始预览打印
	CreatePage();
	LODOP.SET_SHOW_MODE("PREVIEW_IN_BROWSE",true); //预览界面内嵌到页面内
	LODOP.SET_SHOW_MODE("HIDE_QBUTTIN_PREVIEW","true");//隐藏关闭(叉)按钮	
	LODOP.SET_PRINT_COPIES(YTprinter_copies);  //设置打印份数
	if (  ( YTprinter_orient==1) ||  ( YTprinter_orient==2) ) {  //1:  纵向  2：横向
		LODOP.SET_PRINT_PAGESIZE (YTprinter_orient, 0, 0,"");  // 设置打印的方向
	}	
	LODOP.PREVIEW();
};	

function YTreporttoimg(flag) {	//报表保存到图片
 var str1='';
   if  ( flag == '1') { //销售单打印
	    str1='销售单号'+YTorder_number ;
   } 
   if  ( flag == '2') { //售后单打印
	    str1='售后单号'+YTorder_number ;
   } 	 
   if  ( flag == '3') { //入库单打印
	    str1='入库单号'+YTorder_number ;
   }   
   if  ( flag == '4') { //领料单打印
	    str1='领料单号'+YTorder_number ;
   } 
   if  ( flag == '5') { //退料单打印
	    str1='退料单号'+YTorder_number ;
   }    
   if  ( flag == '9') { //退料单打印
	    str1='网页' ;
   }    
   if (  YTreporttoimg_flag  ){
		var str=new Date().Format("yyyyMMddhhmmss")+str1+'.jpg';
		LODOP.SAVE_TO_FILE( str )  ;  //当前报表保存为图片	保存成功与否 写flag为false  不能再次保存了	
		YTreporttoimg_flag=false;		       	
   } else {
	    alert(" 报表已经保存过了，如果还需要再次报表保存为图片，请刷新后操作。"); 
   }		

};

//打印报表结束

//设计表格
function YTdisplaydesign() {	//开始设计界面	
	CreatePage();
	LODOP.SET_SHOW_MODE("DESIGN_IN_BROWSE",1);
	LODOP.SET_SHOW_MODE("SETUP_ENABLESS","11111111000000");//隐藏关闭(叉)按钮
	LODOP.SET_SHOW_MODE("HIDE_PBUTTIN_SETUP",true);//隐藏打印按钮
	LODOP.SET_SHOW_MODE("HIDE_ABUTTIN_SETUP",true);//隐藏暂存（应用）按钮
	if (  ( YTprinter_orient==1) ||  ( YTprinter_orient==2) ) {  //1:  纵向  2：横向
		LODOP.SET_PRINT_PAGESIZE (YTprinter_orient, 0, 0,"");  // 设置打印的方向
	}
	LODOP.PRINT_DESIGN();		
};

function YTgetdesign_programcodes() {	  //得到设计的程序代码	 保存到数据库
  if (confirm("确认以后将覆盖原来的格式，报表格式修改确认？"))	{	  
		var str=LODOP.GET_VALUE("ProgramCodes",0), str1 ='' , str2 =str ; 
		var i=str.indexOf('table') ;
		var j= str.indexOf('table',i+5) ;
		if (( i != -1 ) && ( j != -1) ) {   //表格用html替换 
           i1= str.lastIndexOf('"',i) ;
		   j1= str.indexOf('"',j) ;
		   var str1 = str.substring(i1, j1+1);	
		   var str2 = str.toString().replace(str1,'document.getElementById("YTdiv").innerHTML');
		//	alert(str1) ;
		//	alert(str2) ;
		}
		$("#report_programcodes").val( str2 );
		var url=YTapp+'/Utildesign/ajax_programcodes';			
		yt_ajaxsubmit(url,0,0);  // ajax提交数据  新增保存  ajaxtype：0  新增保存    1：修改保存  successtype=0 成功以后 刷新 可以继续录入新的数据  successtype=1 关闭当前页面 
  }  
}
  
function YTgetsystemdesign_programcodes() {	  //得到系统默认设计的程序代码
  if (confirm("恢复系统默认的模板？"))	{	  
		var url=YTapp+'/Utildesign/ajaxload_programcodes';			
		yt_ajaxsubmit(url,0,0) // ajax提交数据  新增保存  ajaxtype：0  新增保存    1：修改保存  successtype=0 成功以后 刷新 可以继续录入新的数据  successtype=1 关闭当前页面 
  }  

};	

//设计表格 结束

function YTgetLodop(oOBJECT,oEMBED){  //安装\卸载打印控件
    var LODOP;		
	try{	
		 //=====判断浏览器类型:===============
	     var isIE	 = (navigator.userAgent.indexOf('MSIE')>=0) || (navigator.userAgent.indexOf('Trident')>=0);
	     var is64IE  = isIE && (navigator.userAgent.indexOf('x64')>=0);		 
	     //=====如果页面有Lodop就直接使用，没有则新建:==========		 		 
         if (isIE) 
	         LODOP=oOBJECT; 
	     else 
	         LODOP=oEMBED;	 		 
	     //=====判断Lodop插件是否安装过，没有安装或版本过低就提示下载安装:==========
	     if ((LODOP==null)||(typeof(LODOP.VERSION)=="undefined")) {  //安装
	             if (navigator.userAgent.indexOf('Chrome')>=0)
	                  $( "#YTnoticeChrome" ).show(); 
	             if (navigator.userAgent.indexOf('Firefox')>=0)
	                  $( "#YTnoticeFireFox" ).show(); 
	             if (is64IE) {
				      $( "#YTinstall64" ).show(); 
				 }   else  if (isIE)  {
				      $( "#YTinstall32" ).show(); 
				 }  else {
				      $( "#YTinstall32" ).show(); 
				 }
	     } else if (LODOP.VERSION<"6.1.9.8") {  //升级
	             if (is64IE) {
				      $( "#YTupdate64" ).show(); 
				 }   else  if (isIE)  {
				      $( "#YTupdate32" ).show(); 
				 }  else {
				      $( "#YTupdate32" ).show(); 
				 }
	     } else {  //卸载
	             if (is64IE) {
				      $( "#YTuninstall64" ).show(); 
				 }   else  if (isIE)  {
				      $( "#YTuninstall32" ).show(); 
				 }  else {
				      $( "#YTuninstall32" ).show(); 
				 }		 
		 };
	} catch(err) {
		 if (is64IE) {
			  $( "#YTinstall64" ).show(); 
		 }   else  if (isIE)  {
			  $( "#YTinstall32" ).show(); 
		 }  else {
			  $( "#YTinstall32" ).show(); 
		 }
	};
}

//  obj:表格对象  ignoreColumn：集合 不显示的列的索引  flag：标志位怎么组织tableTitle 或者tableEnd  tableTitle：表头文字 第一行  tableEnd：表尾 最后一行
function YTtabletoexcel( obj,ignoreColumn,flag,tableTitle,tableEnd)  {   //表格--》excel  ignoreColumn   导出的时候 哪些列不要  ignoreColumn:[3,4,5]   3,4,5列不要
	var str = '';
	var fileName = tableTitle;
	var j = obj.find("tr").length;//表格的总行数 
    if  ( j<2)	 {   //表格的总行数 小于2 那就是没有数据 不能导出
		 alert("没有数据需要导出。"); 
		 return;  
	}

	if ( flag==1 ) {  //  有起始截止日期  如果是搜索的 取出搜索关键词
	  str='日期：'+$("#date_begin").val()+'----'+$("#date_end").val();
	  if  ($('#search_txt').val()!='') {
		str=str+'&nbsp;&nbsp;'+ $("#search_key").find("option:selected").text() +'&nbsp;关键词：'+ $('#search_txt').val() ;	
	  }
	  tableTitle=tableTitle+'&nbsp;&nbsp;'+str;
	}
	
	if ( flag==2 ) {  //  什么都不做 直接输出  tableTitle

	}	
	
	if ( flag==3 ) {  //  tableTitle=空  不要标题
	   tableTitle='';
	}	
	
	if ( flag==4 ) {  //  只要起始截止日期  
	  str='日期：'+$("#date_begin").val()+'----'+$("#date_end").val();
	  tableTitle=tableTitle+'&nbsp;&nbsp;'+str;
	}	
	
	if ( flag==5 ) {  //  只要起始截止日期  和search_txt 不要 search_key
	  str='日期：'+$("#date_begin").val()+'----'+$("#date_end").val();
	  if  ($('#search_txt').val()!='') {
		str=str+'&nbsp;&nbsp;关键词：'+ $('#search_txt').val() ;	
	  }
	  tableTitle=tableTitle+'&nbsp;&nbsp;'+str;
	}	
	
	fileName=fileName+new Date().Format("yyyyMMddhhmmss")+'.xls';  //下载文件名 
    obj.tableExport({ type:'excel', escape:'false' ,ignoreColumn:ignoreColumn ,tableTitle:tableTitle,tableEnd:tableEnd ,fileName:fileName});  	

} ;

//图片管理开始
function YTimages_select(flag)	{   //按类别查询图片
  location.href= YTapp+'/Showimages/images_list/flag/'+flag+'/date_begin/'+$("#date_begin").val()+'/date_end/'+$("#date_end").val();		
};	

function YTedit_image(guid,flag,info)	{   //通用图片管理   客户  售后  销售  图片管理   显示 编辑  上传  删除等操作   flag  2：客户的图片 3：售后订单的图片 4:销售图片  
  window.open( YTapp+'/Showimages/show_image/guid/'+guid+'/flag/'+flag+'/info/'+info);
};	
//图片管理结束
//
// 地图开始
function YTmap_servicerecord()  {   //售后订单地图查询
  var url = '/date_begin/'+$("#date_begin").val()+'/date_end/'+$("#date_end").val();
      if  ( ( $("#status1").prop('checked')) || ( $("#status2").prop('checked')) || ( $("#status3").prop('checked')) || ( $("#status4").prop('checked')) ){
			if   ( $("#status1").prop('checked')) {
				url=url+'/status1/1';
			}
			if   ( $("#status2").prop('checked')) {
				url=url+'/status2/1';
			}
			if   ( $("#status3").prop('checked')) {
				url=url+'/status3/1';
			}
			if   ( $("#status4").prop('checked')) {
				url=url+'/status4/1';
			}				
	  }   else {
		  alert(" 请选择订单状态 "); 
		  return 
	  } 

      location.href=YTapp+'/Utilmap/utilmap_servicerecord'+url;	
} ;	

function YTmap_servicestaff(search_key)  {   //售后人员地图查询
      if (	search_key != ''  ) {
		  location.href=YTapp+'/Utilmap/utilmap_servicestaff/search_key/'+search_key;	
	  } else {
		  location.href=YTapp+'/Utilmap/utilmap_servicestaff/';	
	  } 
} ;	

function YTmap_servicestaff_recordlist(name)  {   //售后人员地图查询 --   查询该售后人员 三个月的售后订单
  var date_begin =getNowBeforDay(90); 
  var date_end = getNowBeforDay(0); //返回多少天前的日期
  window.open( YTapp+'/Servicestatistics/statistics_servicestaff/flag/1/date_begin/'+date_begin+'/date_end/'+date_end+'/date_type/0/status1/1/status2/1/status3/1/status4/1/man/'+name);

} ;	

function YTmap_citytolnglat() { // ["省份","地级市","市、县"];  城市查询查询经纬度
  var city_name="";
 // alert(" hhhh ");
   if ( ( $("#s_county").val() =="市、县" ) &&  ( $("#s_city").val() =="地级市" ) ) {
		   $("#lng").val("");
		   $("#lat").val("");
	 } else {	 
		   if ( ( $("#s_county").val() =="市、县" ) || (  $("#s_county").val().indexOf("区")>=0  ) ){
			   city_name=$("#s_city").val() ;
		   } else {
			   city_name=$("#s_county").val() ;
		   }
		   //查询经纬度     
		   var geocoder = new soso.maps.Geocoder();		
				geocoder.geocode({'address': city_name}, function(results, status) {
					if (status == soso.maps.GeocoderStatus.OK) {			 
						$("#lng").val(results.location.getLng().toFixed(5))  ; 
						$("#lat").val(results.location.getLat().toFixed(5))  ;  	
					} else {
					   $("#lng").val(""); //地图上没有找到这个市 
					   $("#lat").val("");
					}
				});		     
	 } 
} 

function YTmap_ajaxsetupsoftmapdata() {   // ajax 数据
	var lat = $("#customer_marker_lat").val() ,	
		lng = $("#customer_marker_lng").val() ,		
		zoom_level = $("#zoom_level").val()  ;	

alert(lat+" "+lng+' '+zoom_level); 

		
	return { lat: lat, lng: lng,zoom_level: zoom_level } ;
}

function YTmap_setupsoftmap(url) {  //设置软件的默认初始地图参数
    ajax_universalsubmit(url,YTmap_ajaxsetupsoftmapdata(),'') ;	
}


//地图结束

//登陆 login
function YTlogin_resetVerifyCode(){  //刷新验证码
   var url = YTurl+'/verify';	
	//document.getElementById('verifyImage').src= YTurl+'/verify';	
	document.getElementById('verifyImage').src= url;	
	document.getElementById('verifyImage1').src= url;	
	
}

function YTlogin_ajaxlogindata() {   // ajax 登陆数据
	var username = $("input[name='username']") ,	
		password = $("input[name='password']") ,	
		companyid = $("input[name='companyid']") ,	
		authcode = $("input[name='authcode']") ,
		remember = $("input[name='remember']") ,	
		login_flag = $("input[name='login_flag']") ;  //web登录 还是pcclent登录的标志位 当时web登录的时候 应该为空	
	return {username: username[0].value, password: password[0].value,companyid: companyid[0].value,remember: remember[0].checked,authcode:authcode[0].value,login_flag:login_flag[0].value};
}	

function YTlogin_ajaxforgetdata() {   // ajax 忘记密码数据
	var authcode = $("input[name='authcode1']") ,
	    email = $("input[name='email']") ;					
	return {email: email[0].value,authcode:authcode[0].value};
}

function YTlogin_ajaxchangepassworddata() {   // ajax 修改密码确认
	var password = $("input[name='password']") ,	
		rpassword = $("input[name='rpassword']") ,	
		guid = $("input[name='guid']") ,	
		authcode = $("input[name='authcode']")  ;					
	return {password: password[0].value,rpassword: rpassword[0].value,guid: guid[0].value,authcode:authcode[0].value};
	
}

function YTlogin_ajaxregisterdata() {   // ajax 注册
	var name = $("input[name='name']") ,	
		phone = $("input[name='phone']") ,	
		email = $("input[name='email']") ,	
		remail = $("input[name='remail']") ,	
		company_name = $("input[name='company_name']") ,	
		company_address = $("input[name='company_address']") ,			
		authcode = $("input[name='authcode']")  ,			
        s_province=$("#s_province").val(),
		s_city=$("#s_city").val(),
		s_county=$("#s_county").val(),	
		lng=$("#lng").val(),			
		lat=$("#lat").val();		
	    if  ( s_county =="市、县" ) {
		   s_county='';
	    } 
	return {lng:lng,lat:lat,s_province:s_province,s_city:s_city,s_county:s_county,name: name[0].value,phone: phone[0].value,email: email[0].value,remail: remail[0].value,company_name: company_name[0].value,company_address: company_address[0].value,authcode:authcode[0].value};
}
	 
function YTlogin_dologin(url){   //登陆
    ajax_universalsubmit(url,YTlogin_ajaxlogindata(),YTapp+'/Index/index_menu') ;	
	YTlogin_resetVerifyCode();  //刷新验证码
} 

function YTlogin_doforget(url){   //忘记密码
    ajax_universalsubmit(url,YTlogin_ajaxforgetdata(),'') ;	
	YTlogin_resetVerifyCode(); //刷新验证码
} 

function YTlogin_dochangepassword(url){   //修改密码 确认
//alert( IsPC() );
   if  ( IsPC()  ) {
	   ajax_universalsubmit(url,YTlogin_ajaxchangepassworddata(),YTapp+'/User/login') ;	 //修改成功自动转登录界面  //pc处理
   } else {
	   ajax_universalsubmit(url,YTlogin_ajaxchangepassworddata(),'') ;	 //修改成功自动转登录界面   手机处理 
   }
  // ajax_universalsubmit(url,YTlogin_ajaxchangepassworddata(),YTapp+'/User/login') ;	 //修改成功自动转登录界面
  //	YTlogin_resetVerifyCode();  //刷新验证码
}

function YTlogin_doregister(url){   //新注册 
	var	s_province=$("#s_province").val(),
		s_city=$("#s_city").val(),
		s_county=$("#s_county").val();	
		if (  s_province=='省份' ) {
			alert(" 请选择省份 "); 
			return ;
		} else {			
		   if ( ( s_city =="地级市" ) &&  ( s_county =="市、县"  ) )   {
					alert(" 请选择地级市 "); 
					return ;
			 } 		
	   }
    ajax_universalsubmit(url,YTlogin_ajaxregisterdata(),YTapp+'/User/login') ;	 //注册成功自动转登录界面
	YTlogin_resetVerifyCode();  //刷新验证码
}



//登陆结束

//权限设置开始
function YTauth_chkall() {    //全选
	if($("#auth_chkall").attr("checked")) 
		{ 
			 $('input[type="checkbox"]').prop('checked', true);			
		} 
		else 
		{ 
			$('input[type="checkbox"]').prop('checked', false);
		 }            	
}

function YTauth_checkbox(o,id){
  var str='checkbox'+id;
	if(o.attr("checked")) 
		{ 
			   $("input[class='"+str+"']").each(function() { 
				   $(this).prop('checked', true);	
				  YTauth_checkbox_sub2($(this),$(this).val());
				  
			   }); 
		} 
		else 
		{ 			
			   $("input[class='"+str+"']").each(function() { 
				   $(this).prop('checked', false);	
				   YTauth_checkbox_sub2($(this),$(this).val());
			   }); 
			   $("#auth_chkall").prop('checked', false);	 //全选的选择框 设置为false				   
		 } 	
}	

function YTauth_checkbox_sub(o1,id,o2){ //o1:本级对象   o2：上级对象
  var str='checkbox'+id;
  var str1=o1.attr('class');
	if(o1.attr("checked")) 
		{ 
			   $("input[class='"+str+"']").each(function() { 
				   $(this).prop('checked', true);	
			   }); 
			   o2.prop('checked', true);	 //上级对象选择框 设置为true	
		}  
		else 
		{ 			
			   $("input[class='"+str+"']").each(function() { 
				   $(this).prop('checked', false);	
			   }); 
			   $("#auth_chkall").prop('checked', false);	 //全选的选择框 设置为false	
			   
			   var flag=false;
			   $("input[class='"+str1+"']").each(function() { 
				  if  ( $(this).attr("checked")) {  flag=true; }	
			   });
			   o2.prop('checked', flag);	 //上级对象选择框 设置为  当全是不选的话 那上一级也设置成不选 	  
		 } 	
}	

function YTauth_checkbox_sub1(o1,o2,o3){  //第三级 被点击以后o1:本级对象   o2：上级对象  o3：上上级对象
	if(o1.attr("checked")) 
		{ 
			 o2.prop('checked', true);	 //上级对象选择框 设置为true	
			 o3.prop('checked', true);	 //上上级对象选择框 设置为true	
		} 
		else 
		{ 			
			 $("#auth_chkall").prop('checked', false);	 //全选的选择框 设置为false				   
		 } 	
}

function YTauth_checkbox_sub2(o,id){ //
  var str='checkbox'+id;
	if(o.attr("checked")) 
		{ 
			   $("input[class='"+str+"']").each(function() { 
				   $(this).prop('checked', true);	
			   }); 
		} 
		else 
		{ 			
			   $("input[class='"+str+"']").each(function() { 
				   $(this).prop('checked', false);	
			   }); 
			   $("#auth_chkall").prop('checked', false);	 //全选的选择框 设置为false				   
		 } 	
}	

function YTauth_checkform(){  //检查数据完整性
	var title = $('#title').val();
	if(title == ''){
		alert('请输入组名称');
		return false;
	}	
	if (confirm("请确认？"))	{	  
		return true;
	}	
	return false;
}
//权限设置结束

//  答疑、建议、反馈  开始
function YTquestions_add()	{   //  保存 答疑、建议、反馈 
	var str1=$('input:radio[name="question_type"]:checked').val() ;	
	if (typeof(str1) == "undefined") { 
		alert('类型没有选择');
		return;
     }  	 
	var str2=replaceEscape(trim($("#memo").val())) ;
	if  ( str2=='' ) {
		alert('答疑、建议、反馈内容不能为空');
		return;
	} 
	var ajaxdataArray = new Array();
		ajaxdataArray.push(['question_type']);
		ajaxdataArray.push([str1]);	
		ajaxdataArray.push(['memo']);
		ajaxdataArray.push([str2]);			
	var data=jQuery.parseJSON(arrTojson( ajaxdataArray ))  ; 
	var url=YTapp+'/Setcompany/questions_add';  // 保存 答疑、建议、反馈 	
	ajax_submit(url,data);   //ajax 提交数据
};

function YTquestions_info(id){   // 答疑、建议、反馈处理
	window.open( YTapp+'/Setcompany/questions_info/id/'+id);
} ;
	
function YTquestions_save()	{   //  保存 答疑、建议、反馈 	 再补充几句
	var str2=replaceEscape(trim($("#memo").val())) ;
	if  ( str2=='' ) {
		alert('答疑、建议、反馈内容不能为空');
		return;
	} 
	var ajaxdataArray = new Array();
		ajaxdataArray.push(['guid']);
		ajaxdataArray.push([$("#guid").val()]);	
		ajaxdataArray.push(['memo']);
		ajaxdataArray.push([str2]);			
	var data=jQuery.parseJSON(arrTojson( ajaxdataArray ))  ; 
	var url=YTapp+'/Setcompany/questions_save';  // 再补充几句 保存 答疑、建议、反馈 	
	ajax_submit(url,data);   //ajax 提交数据
};
//  答疑、建议、反馈结束







