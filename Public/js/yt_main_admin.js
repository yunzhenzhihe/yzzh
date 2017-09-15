
function YTSOFTadmin_company_select_all()	{   //查询全部
  location.href= YTapp+'/Admincompany/company_list/date_begin/'+$("#date_begin").val()+'/date_end/'+$("#date_end").val()+'/flag/1';	
};	

function YTSOFTadmin_company_select_search()  {   //搜索
	if ( search_checkdata( $( "#search_txt" ) ) ) { 
	  location.href=YTapp+'/Admincompany/company_list/search_key/'+$("#search_key").val()+'/search_txt/'+trim($("#search_txt").val()) +'/date_begin/'+$("#date_begin").val()+'/date_end/'+$("#date_end").val()+'/flag/2';		
  }		
} ;	
	
function YTSOFTadmin_company_select_search1(event)  {   // 回车搜索
  if(event.keyCode==13){
      YTSOFTadmin_company_select_search();
  }   		
} ;	

function YTSOFTadmin_company_select_moneyplan()	{   //查询套餐和数量
  location.href= YTapp+'/Admincompany/company_list/date_begin/'+$("#date_begin").val()+'/date_end/'+$("#date_end").val()+ '/search_moneyplan/'+$("#search_moneyplan").val()  + '/flag/3';	
};	

function YTSOFTadmin_getYTself(flag) {    // 得到当前的YTself  用于排序 等  查询客户使用
  var url = YTself+'/date_begin/'+$("#date_begin").val()+'/date_end/'+$("#date_end").val();	
  if  ( flag==1) {
	  url =url + '/flag/1';	
  } 
  if  ( flag==2) {
	  url = url + '/search_key/'+$("#search_key").val()+'/search_txt/'+trim($("#search_txt").val())  + '/flag/2';	
  }   
  if  ( flag==3) {
	  url = url + '/search_moneyplan/'+$("#search_moneyplan").val()  + '/flag/3';	
  }   
  
  return url;  
}


						
function YTSOFTadmin_company_info(id)  {   // 公司详情  id
	window.open( YTapp+'/Admincompany/company_info/id/'+id);
} ;	

function YTSOFTadmin_company_info_companyid(companyid)  {   // 公司详情  companyid
	window.open( YTapp+'/Admincompany/company_info/companyid/'+companyid);
} ;	

function YTSOFTadmin_company_info_select(){   // 公司详情
   var url=window.location.href.replace(/date_begin/g,"date_cancel").replace(/date_end/g,"date_cancel"); //替换	  
   location.href= url+'/date_begin/'+$("#date_begin").val()+'/date_end/'+$("#date_end").val();	
} ;	

function YTSOFTadmin_watchdog_company(){   // 公司管理操作日志
	location.href= YTapp+'/Admincompany/watchdog_company/date_begin/'+$("#date_begin").val()+'/date_end/'+$("#date_end").val();	
} ;	
						
function YTSOFTadmin_statistics_company(){   // 公司统计数据
	location.href= YTapp+'/Admincompany/statistics/date_begin/'+$("#date_begin").val()+'/date_end/'+$("#date_end").val();	
} ;	

function YTSOFTadmin_company_editinfo(id)  {   // 修改公司详情  id
	window.open( YTapp+'/Admincompany/company_editinfo/id/'+id);
} ;		

function YTSOFTadmin_planmoney_addinfo(id)  {   // 添加收款记录  id
	window.open( YTapp+'/Admincompany/planmoney_addinfo/id/'+id);
} ;		

function YTSOFTadmin_planmoney_del(id)  {   // 删除最近一条充值记录  id
    if (  $("#yt_table").length <1 ) {
		alert('没有需要删除的数据') ;		
	} else {
		del_record(id)
	}
} ;	

function YTSOFTadmin_moneystatistics(flag){   // 收费明细和汇总统计
	location.href= YTapp+'/Admincompany/moneystatistics/date_begin/'+$("#date_begin").val()+'/date_end/'+$("#date_end").val()+'/flag/'+flag;	
} ;	

function YTSOFTadmin_questions(flag){   // 答疑、建议、反馈处理
	location.href= YTapp+'/Admincompany/questions_list/date_begin/'+$("#date_begin").val()+'/date_end/'+$("#date_end").val()+'/flag/'+flag;	
} ;	

function YTSOFTadmin_questions_info(id){   // 答疑、建议、反馈处理
	window.open( YTapp+'/Admincompany/questions_info/id/'+id);
} ;	

function YTSOFTadmin_questions_submit() {    // 开始提交答疑、建议、反馈处理
	 if ( checkEmpty( $( "#memo" ) , "处理结果" ) ) {
		  var memo=trim( $("#memo").val() );
		  var guid=trim( $("#guid").val() );
		  var ajax_url=YTapp+'/Admincompany/questions_submit/';
	      var ajaxdataArray = new Array();	   
			  ajaxdataArray.push('guid');
			  ajaxdataArray.push(guid);	
			  ajaxdataArray.push('memo');
			  ajaxdataArray.push(memo);				 			 
	      var ajax_date = jQuery.parseJSON(arrTojson( ajaxdataArray ))  ; 	 //json文本转对象	  
		  ajax_submit(ajax_url,ajax_date);
	  }
}

function YTSOFTadmin_questions_del(id1,id2,flag,company_name) {    // 删除提交答疑、建议、反馈处理
   var str=''; 
    if  ( flag=='1') {
		str='删除本条答疑、建议、反馈处理,连带处理建议都会被全部删除，请确认？'; 
	} else  {
		 if ( flag=='2' ) {
		     str='删除处理结果或者补充问题，请确认？'; 
		 } else {
			 return;
		 }       
	} 
    if (confirm(str)) {		
		  location.href=YTapp+'/Admincompany/questions_del/id1/'+id1+'/id2/'+id2+'/flag/'+flag+'/company_name/'+company_name;					
	}	
}

function YTSOFTadmin_notice(){   // 系统日志
	location.href= YTapp+'/Admincompany/notice_list/date_begin/'+$("#date_begin").val()+'/date_end/'+$("#date_end").val();	
} ;	

function YTSOFTadmin_notice_del(id){   // 系统日志
  if (confirm('删除本条通知，请确认？')) {		
	 location.href= YTapp+'/Admincompany/notice_del/id/'+id;					
  }
	
} ;			
						


						
