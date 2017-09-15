var YtUiScripts = function () {

    var initTable1 = function() {  //客户搜索使用
			var nCloneTh = document.createElement( 'th' );
			var nCloneTd = document.createElement( 'td' );
			nCloneTd.innerHTML = '<span class="row-details row-details-close"></span>';
			 
			$('#yt_table thead tr').each( function () {
				this.insertBefore( nCloneTh, this.childNodes[0] );
			} );
			 
			$('#yt_table tbody tr').each( function () {
				this.insertBefore(  nCloneTd.cloneNode( true ), this.childNodes[0] );
			} );

			$('#yt_table').on('click', ' tbody td .row-details', function () {
				var nTr = $(this).parents('tr')[0];
				if ( oTable.fnIsOpen(nTr) )
				{
					/* This row is already open - close it */
					$(this).addClass("row-details-close").removeClass("row-details-open");
					oTable.fnClose( nTr );
				}
				else
				{
					/* Open this row */                
					$(this).addClass("row-details-open").removeClass("row-details-close");
					oTable.fnOpen( nTr, fnFormatDetails(oTable, nTr), 'details' );
				}
			});	
			
			var oTable = $('#yt_table').dataTable({    //2014.9.21  新加 取消搜索 分页
				"bStateSave": true,
				
				"fnStateLoaded": function (oSettings, oData) {  //表格状态 cooker 已经装完 然后回调这个函数 按cooker设置隐藏/显示列
					   var abVisColsArray = new Array();	
						   abVisColsArray = oData.abVisCols;	
					   var  i=YTtable_head_startnumber ;		//第0列：加号（详情）  第1列：操作		从第2列开始	
							$('input[name="showcolumn"]').each(function(){  
								$(this).prop("checked",abVisColsArray[i]);
								i=i+1;		
							});														
					   var aaSortingArray1 = new Array();
					   var aaSortingArray2 = new Array();
						   aaSortingArray1 = oData.aaSorting;
						   aaSortingArray2 = aaSortingArray1[0];
						   if ( ( Number( aaSortingArray2[0] ) < YTtable_head_startnumber ) || ( Number( aaSortingArray2[0] ) > YTtable_head_endnumber   ) )  {  //表头起始行号 截至行号
						      oTable.fnSort( [ [ YTsorter_number,YTsorter_ascordesc ] ] );  //强制排序		
							}										
				 },				 
				 "fnStateSaveParams": function (oSettings, oData) {  // 表格状态被修改保存到cooker 以后 回调这个函数把把排序的参数传递给后台
					   var aaSortingArray1 = new Array();
					   var aaSortingArray2 = new Array();
						   aaSortingArray1 = oData.aaSorting;
						   aaSortingArray2 = aaSortingArray1[0];
						//	alert(aaSortingArray2[0]+ '  ' +aaSortingArray2[1]);
						//	alert(YTsorter_number+ '  ' +YTsorter_ascordesc+'  sdd:'+aaSortingArray2[0]+ '  ' +aaSortingArray2[1]);
							if ( ( Number( aaSortingArray2[0] ) < YTtable_head_startnumber ) || ( Number( aaSortingArray2[0] ) > YTtable_head_endnumber   ) )  {  //表头起始行号 截至行号
							  return ;  //非法的初始排序数字
							}					
						   if ( ( aaSortingArray2[0]!=YTsorter_number ) || ( aaSortingArray2[1]!=YTsorter_ascordesc ) ) {							 
								window.location.href =YTself+'/sorter_number/'+aaSortingArray2[0]+'/sorter_ascordesc/'+aaSortingArray2[1];	
							}					
				 },	

				"bLengthChange":false,
				"bPaginate":false,   //分页的设置
				"bFilter":false,   //过滤器 页内搜索
				"bInfo":false,   //左下角 一共多少个数据
				"iCookieDuration": 60*60*24*30*6, //  60*60*24 1 day  设置成30*6=180天
				"aaSorting": [[ YTsorter_number,YTsorter_ascordesc ]],
				"bSortClasses": true,
				"aoColumnDefs": [{
						'bSortable': false,
						'aTargets': [0,1]
					}
				]  
		});   
			
        $('#yt_table_column_toggler input[type="checkbox"]').change(function(){  //隐藏或者显示列
            var iCol = parseInt($(this).attr("data-column"));
            var bVis = oTable.fnSettings().aoColumns[iCol].bVisible;
            oTable.fnSetColumnVis(iCol, (bVis ? false : true));
        });	
    } ;
	
    var initTablesales = function() {  //销售记录的排序和隐藏  initTablesales
			var nCloneTh = document.createElement( 'th' );
			var nCloneTd = document.createElement( 'td' );
			nCloneTd.innerHTML = '<span class="row-details row-details-close"></span>';
			 
			$('#yt_tablesales thead tr').each( function () {
				this.insertBefore( nCloneTh, this.childNodes[0] );
			} );
			 
			$('#yt_tablesales tbody tr').each( function () {
				this.insertBefore(  nCloneTd.cloneNode( true ), this.childNodes[0] );
			} );

			$('#yt_tablesales').on('click', ' tbody td .row-details', function () {
				var nTr = $(this).parents('tr')[0];
				if ( oTable.fnIsOpen(nTr) )
				{
					/* This row is already open - close it */
					$(this).addClass("row-details-close").removeClass("row-details-open");
					oTable.fnClose( nTr );
				}
				else
				{
					/* Open this row */                
					$(this).addClass("row-details-open").removeClass("row-details-close");
					oTable.fnOpen( nTr, fnFormatDetails(oTable, nTr), 'details' );
				}
			});	
			
			var oTable = $('#yt_tablesales').dataTable({    //2014.9.21  新加 取消搜索 分页
				"bStateSave": true,
				
				"fnStateLoaded": function (oSettings, oData) {  //表格状态 cooker 已经装完 然后回调这个函数 按cooker设置隐藏/显示列
					   var abVisColsArray = new Array();	
						   abVisColsArray = oData.abVisCols;	
					   var  i=YTtable_head_startnumber ;		//第0列：加号（详情）  第1列：操作		从第2列开始	
							$('input[name="showcolumn"]').each(function(){  
								$(this).prop("checked",abVisColsArray[i]);
								i=i+1;	
								
							});														
					   var aaSortingArray1 = new Array();
					   var aaSortingArray2 = new Array();					 
						   aaSortingArray1 = oData.aaSorting;
						   aaSortingArray2 = aaSortingArray1[0];
						   if ( ( Number( aaSortingArray2[0] ) < YTtable_head_startnumber ) || ( Number( aaSortingArray2[0] ) > YTtable_head_endnumber   ) )  {  //表头起始行号 截至行号
						      oTable.fnSort( [ [ YTsorter_number,YTsorter_ascordesc ] ] );  //强制排序		
							}										
				 },				 
				 "fnStateSaveParams": function (oSettings, oData) {  // 表格状态被修改保存到cooker 以后 回调这个函数把把排序的参数传递给后台
					   var aaSortingArray1 = new Array();
					   var aaSortingArray2 = new Array();
						   aaSortingArray1 = oData.aaSorting;
						   aaSortingArray2 = aaSortingArray1[0];
						//	alert(aaSortingArray2[0]+ '  ' +aaSortingArray2[1]);
						//	alert(YTsorter_number+ '  ' +YTsorter_ascordesc+'  sdd:'+aaSortingArray2[0]+ '  ' +aaSortingArray2[1]);
							if ( ( Number( aaSortingArray2[0] ) < YTtable_head_startnumber ) || ( Number( aaSortingArray2[0] ) > YTtable_head_endnumber   ) )  {  //表头起始行号 截至行号
							  return ;  //非法的初始排序数字
							}					
						   if ( ( aaSortingArray2[0]!=YTsorter_number ) || ( aaSortingArray2[1]!=YTsorter_ascordesc ) ) {							 
								window.location.href =YTself+'/sorter_number/'+aaSortingArray2[0]+'/sorter_ascordesc/'+aaSortingArray2[1];	
							}					
				 },	

				"bLengthChange":false,
				"bPaginate":false,   //分页的设置
				"bFilter":false,   //过滤器 页内搜索
				"bInfo":false,   //左下角 一共多少个数据
				"iCookieDuration": 60*60*24*30*6, //  60*60*24 1 day  设置成30*6=180天
				"aaSorting": [[ YTsorter_number,YTsorter_ascordesc ]],
				"bSortClasses": true,
				"aoColumnDefs": [{
						'bSortable': false,
						'aTargets': [0,1]
					}
				]  
		});   
			
        $('#yt_tablesales_column_toggler input[type="checkbox"]').change(function(){  //隐藏或者显示列
            var iCol = parseInt($(this).attr("data-column"));
            var bVis = oTable.fnSettings().aoColumns[iCol].bVisible;
            oTable.fnSetColumnVis(iCol, (bVis ? false : true));
        });	
    } ;
	
    var initTableservice = function() {  //售后记录的排序和隐藏  initTableservice
			var nCloneTh = document.createElement( 'th' );
			var nCloneTd = document.createElement( 'td' );
			nCloneTd.innerHTML = '<span class="row-details row-details-close"></span>';
			 
			$('#yt_tableservice thead tr').each( function () {
				this.insertBefore( nCloneTh, this.childNodes[0] );
			} );
			 
			$('#yt_tableservice tbody tr').each( function () {
				this.insertBefore(  nCloneTd.cloneNode( true ), this.childNodes[0] );
			} );

			$('#yt_tableservice').on('click', ' tbody td .row-details', function () {
				var nTr = $(this).parents('tr')[0];
				if ( oTable.fnIsOpen(nTr) )
				{
					/* This row is already open - close it */
					$(this).addClass("row-details-close").removeClass("row-details-open");
					oTable.fnClose( nTr );
				}
				else
				{
					/* Open this row */                
					$(this).addClass("row-details-open").removeClass("row-details-close");
					oTable.fnOpen( nTr, fnFormatDetails(oTable, nTr), 'details' );
				}
			});	
			
			var oTable = $('#yt_tableservice').dataTable({    //2014.9.21  新加 取消搜索 分页
				"bStateSave": true,
				
				"fnStateLoaded": function (oSettings, oData) {  //表格状态 cooker 已经装完 然后回调这个函数 按cooker设置隐藏/显示列
				
				 alert( 'gdfg d'  );
				
				
					   var abVisColsArray = new Array();	
						   abVisColsArray = oData.abVisCols;	
					   var  i=YTtable_head_startnumber ;		//第0列：加号（详情）  第1列：操作		从第2列开始	
							$('input[name="showcolumn"]').each(function(){  
								$(this).prop("checked",abVisColsArray[i]);
								 alert( i+'   '+abVisColsArray[i]  );
								i=i+1;		
							});														
					   var aaSortingArray1 = new Array();
					   var aaSortingArray2 = new Array();
					   
					   			
					   
					   
						   aaSortingArray1 = oData.aaSorting;
						   aaSortingArray2 = aaSortingArray1[0];
						   if ( ( Number( aaSortingArray2[0] ) < YTtable_head_startnumber ) || ( Number( aaSortingArray2[0] ) > YTtable_head_endnumber   ) )  {  //表头起始行号 截至行号
						      oTable.fnSort( [ [ YTsorter_number,YTsorter_ascordesc ] ] );  //强制排序		
							}										
				 },				 
				 "fnStateSaveParams": function (oSettings, oData) {  // 表格状态被修改保存到cooker 以后 回调这个函数把把排序的参数传递给后台
					   var aaSortingArray1 = new Array();
					   var aaSortingArray2 = new Array();
						   aaSortingArray1 = oData.aaSorting;
						   aaSortingArray2 = aaSortingArray1[0];
						//	alert(aaSortingArray2[0]+ '  ' +aaSortingArray2[1]);
						//	alert(YTsorter_number+ '  ' +YTsorter_ascordesc+'  sdd:'+aaSortingArray2[0]+ '  ' +aaSortingArray2[1]);
							if ( ( Number( aaSortingArray2[0] ) < YTtable_head_startnumber ) || ( Number( aaSortingArray2[0] ) > YTtable_head_endnumber   ) )  {  //表头起始行号 截至行号
							  return ;  //非法的初始排序数字
							}					
						   if ( ( aaSortingArray2[0]!=YTsorter_number ) || ( aaSortingArray2[1]!=YTsorter_ascordesc ) ) {							 
								window.location.href =YTself+'/sorter_number/'+aaSortingArray2[0]+'/sorter_ascordesc/'+aaSortingArray2[1];	
							}					
				 },	

				"bLengthChange":false,
				"bPaginate":false,   //分页的设置
				"bFilter":false,   //过滤器 页内搜索
				"bInfo":false,   //左下角 一共多少个数据
				"iCookieDuration": 60*60*24*30*6, //  60*60*24 1 day  设置成30*6=180天
				"aaSorting": [[ YTsorter_number,YTsorter_ascordesc ]],
				"bSortClasses": true,
				"aoColumnDefs": [{
						'bSortable': false,
						'aTargets': [0,1]
					}
				]  
		});   
			
        $('#yt_tableservice_column_toggler input[type="checkbox"]').change(function(){  //隐藏或者显示列
            var iCol = parseInt($(this).attr("data-column"));
            var bVis = oTable.fnSettings().aoColumns[iCol].bVisible;
            oTable.fnSetColumnVis(iCol, (bVis ? false : true));
        });	
    } ;	
	
	
    var initTable2 = function() {  //老客户添加销售记录/售后记录使用  销售记录的查询和显示页面
			var nCloneTh = document.createElement( 'th' );
			var nCloneTd = document.createElement( 'td' );
	        nCloneTd.innerHTML = '<span class="row-details row-details-close"></span>';
			 
			$('#yt_table thead tr').each( function () {
				this.insertBefore( nCloneTh, this.childNodes[0] );
			} );
			 
			$('#yt_table tbody tr').each( function () {
				this.insertBefore(  nCloneTd.cloneNode( true ), this.childNodes[0] );
			} );

			$('#yt_table').on('click', ' tbody td .row-details', function () {
				var nTr = $(this).parents('tr')[0];
				if ( oTable.fnIsOpen(nTr) )
				{
					/* This row is already open - close it */
					$(this).addClass("row-details-close").removeClass("row-details-open");
					oTable.fnClose( nTr );
				}
				else
				{
					/* Open this row */                
					$(this).addClass("row-details-open").removeClass("row-details-close");
					oTable.fnOpen( nTr, fnFormatDetails(oTable, nTr), 'details' );
				}
			});	
			
			var oTable = $('#yt_table').dataTable({    //2014.9.21  新加 取消搜索 分页
				"bLengthChange":false,
				"bPaginate":false,   //分页的设置
				"bFilter":false,   //过滤器 页内搜索
				"bSort": false,
				"bInfo":false   //左下角 一共多少个数据
		});   
			
    } ;	
	
    var initTable3 = function() {  //客户搜索使用
			var nCloneTh = document.createElement( 'th' );
			var nCloneTd = document.createElement( 'td' );
			nCloneTd.innerHTML = '<span class="row-details row-details-close"></span>';
			 
			$('#yt_table thead tr').each( function () {
				this.insertBefore( nCloneTh, this.childNodes[0] );
			} );
			 
			$('#yt_table tbody tr').each( function () {
				this.insertBefore(  nCloneTd.cloneNode( true ), this.childNodes[0] );
			} );

			$('#yt_table').on('click', ' tbody td .row-details', function () {
				var nTr = $(this).parents('tr')[0];
				if ( oTable.fnIsOpen(nTr) )
				{
					/* This row is already open - close it */
					$(this).addClass("row-details-close").removeClass("row-details-open");
					oTable.fnClose( nTr );
				}
				else
				{
					/* Open this row */                
					$(this).addClass("row-details-open").removeClass("row-details-close");
					oTable.fnOpen( nTr, fnFormatDetails(oTable, nTr), 'details' );
				}
			});	
			
			var oTable = $('#yt_table3').dataTable({    //2014.9.21  新加 取消搜索 分页
				"bStateSave": true,				
				"fnStateLoaded": function (oSettings, oData) {  //表格状态 cooker 已经装完 然后回调这个函数 按cooker设置隐藏/显示列
					   var abVisColsArray = new Array();	
						   abVisColsArray = oData.abVisCols;

                     alert('fdgfdgfdg');
						   
					   var  i=2 ;		//第0列：加号（详情）  第1列：操作		从第2列开始	
							$('input[name="showcolumn"]').each(function(){  
								$(this).prop("checked",abVisColsArray[i]);
								i=i+1;		
							});																							
				 },					 
				 "fnStateSaveParams": function (oSettings, oData) {  // 表格状态被修改保存到cooker 以后 回调这个函数把把排序的参数传递给后台
                        alert('1234567');				
				 },	
				 
				"bLengthChange":false,
				"bPaginate":false,   //分页的设置
				"bFilter":false,   //过滤器 页内搜索
				"bSort": false,
				"bInfo":false,   //左下角 一共多少个数据
				"iCookieDuration": 60*60*24*30*6 //  60*60*24 1 day  设置成30*6=180天

		});   
			
        $('#yt_table_column_toggler input[type="checkbox"]').change(function(){  //隐藏或者显示列
            var iCol = parseInt($(this).attr("data-column"));
            var bVis = oTable.fnSettings().aoColumns[iCol].bVisible;
            oTable.fnSetColumnVis(iCol, (bVis ? false : true));
        });	
    } ;	
	
    var initTable4 = function() {  //统计使用的查询和显示页面
			var oTable = $('#yt_table').dataTable({    //2014.9.21  新加 取消搜索 分页
				"bLengthChange":false,
				"bPaginate":false,   //分页的设置
				"bFilter":false,   //过滤器 页内搜索
				"bSort": false,
				"bInfo":false   //左下角 一共多少个数据
		});   			
    } ;		
	

    return {
        //main function to initiate the module
        initTable1: function () {      //客户表格的处理       
            if (!jQuery().dataTable) {
                return;
            }
            initTable1();
        } ,			
        initTable2: function () {            
            if (!jQuery().dataTable) {
                return;
            }
            initTable2();
        }	,		
        initTable3: function () {            
            if (!jQuery().dataTable) {
                return;
            }
            initTable3();
        },
        initTable4: function () {            
            if (!jQuery().dataTable) {
                return;
            }
            initTable4();
        },		
        initTablesales: function () {     //销售表格的处理         
            if (!jQuery().dataTable) {
                return;
            }
            initTablesales();
        } ,		
        initTableservice: function () {     //售后表格的处理         
            if (!jQuery().dataTable) {
                return;
            }
            initTableservice();
        } ,			
		

    };

}();