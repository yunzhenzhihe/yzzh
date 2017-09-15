
     StringLength000 = 0;
	 StringLength001 = 1;
	 StringLength002 = 2;
	 StringLength020 = 20;
	 StringLength050 = 50;
	 StringLength100 = 100;
	 StringLength150 = 150;
	 StringLength500 = 500;  //变量当常量来使用 字符的宽度
	  
$(document).ready(function(){    //鼠标滑过表格变色
          $(".tablesorter tr td").mouseover(function(){
              $(this).parent().find("td").css("background-color","#c1ebff");  	   
		    });	

          $(".tablesorter tr td").mouseout(function(){	
			 $(this).parent().find("td").css("background-color","");  	
            })			
})	

		
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

function checkRegexp( o, regexp, n ) {     // 弹出添加 修改数据框 提交前做正则表达式验证 
		if ( !( regexp.test( trim(o.val()) ) ) ) {
			alert( n  );
			return false;
		} else {
			return true;
		}
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
	


function ShowSelect(SelectName,SelectValue){   //遍历select 并且赋值	
  $(SelectName).each(function(){
       $(this).find("option").each(function(){
			if($(this).val() == SelectValue){ 
					$(this).attr("selected","selected"); 
					return false;
			}
       });
  });
}

function ShowLeftMenu( MenuText ) {     //  sidebar  #b7ba6b
   $('#sidebar a').each(function(){ 
          if ( $(this).html().indexOf(MenuText) !=-1){ 
		        $(this).css({'background' : '#cde6c7'});
          }   		  
   }); 
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



		
  



















