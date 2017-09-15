
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
		 //   layer.alert(n + " 长度必须在" + min + "--" + max + "之间", {icon: 2});
			return false;
	} else {
			return true;
	}	
	return true;
}
//孤鸿寡鹄
function checkEmpty( o , n ) {   // 弹出添加 修改数据框 提交前做 空 验证 
	if ( trim(o.val()).length < 1 ) {
			alert( n + " 不能为空 " ); 
		//	layer.alert( n + " 不能为空 " , {icon: 2});
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





























//参数设置或者其他函数
function YTsetup_goods(flag)	{   //商品名称设置  拉选种类  显示这个种类下的所有商品
	window.open(YTapp+'/Setgoods/goods_list/flag/'+flag);
};	



//参数设置或者其他函数  结束






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
	  if  ( flag == '6') { //售后单打印（填全数据）
		  window.open( YTapp+'/Utilreport/utilprint_allservicerecord'+url);  
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

//alert(lat+" "+lng+' '+zoom_level); 

	return { lat: lat, lng: lng,zoom_level: zoom_level } ;
}

function YTmap_setupsoftmap(url) {  //设置软件的默认初始地图参数
    ajax_universalsubmit(url,YTmap_ajaxsetupsoftmapdata(),'') ;	
}


//地图结束

//登陆 login
function YTlogin_resetVerifyCode(){  //刷新验证码
  //var url = YTurl+'/verify';	
  //document.getElementById('verifyImage').src= YTurl+'/verify';	

//	document.getElementById('verifyImage').src= url;	
//	document.getElementById('verifyImage1').src= url;	
 //   var url = YTurl+'/verify/t/'+Math.random();	 //解决firefox 和 ie 因为缓存造成不刷新的问题
//	document.getElementById('verifyImage').src= YTurl+'/verify/t/'+Math.random();	
//	document.getElementById('verifyImage1').src= url;	

  $("#verifyImage").attr("src", YTurl+'/verify/t/'+Math.random());

}

function YTlogin_resetVerifyCode1(){  //刷新验证码
 // $("#verifyImage1").attr("src", YTurl+'/verify/t/'+Math.random());
  document.getElementById('verifyImage1').src= YTurl+'/verify/t/'+Math.random();
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
   ajax_verifysubmit(url,YTlogin_ajaxlogindata(),YTapp+'/Index/index_menu','1') ;	
} 

function YTlogin_doforget(url){   //忘记密码
	ajax_verifysubmit(url,YTlogin_ajaxforgetdata(),YTapp+'/User/login','2') ;		
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
 //   ajax_universalsubmit(url,YTlogin_ajaxregisterdata(),YTapp+'/User/login') ;	 //注册成功自动转登录界面
//	YTlogin_resetVerifyCode();  //刷新验证码
	
	 ajax_verifysubmit(url,YTlogin_ajaxregisterdata(),YTapp+'/User/login','1') ;	 //注册成功自动转登录界面	
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







