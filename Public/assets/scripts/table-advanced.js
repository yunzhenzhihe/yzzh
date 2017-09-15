var TableAdvanced = function () {

    var initTable1 = function() {

        /* Formatting function for row details */
        function fnFormatDetails ( oTable, nTr )
        {
            var aData = oTable.fnGetData( nTr );
            var sOut = '<table>';
            sOut += '<tr><td>Platform(s):</td><td>'+aData[2]+'</td></tr>';
            sOut += '<tr><td>Engine version:</td><td>'+aData[3]+'</td></tr>';
            sOut += '<tr><td>CSS grade:</td><td>'+aData[4]+'</td></tr>';
            sOut += '<tr><td>Others:</td><td>Could provide a link here</td></tr>';
            sOut += '</table>';
             
            return sOut;
        }

        /*
         * Insert a 'details' column to the table
         */
        var nCloneTh = document.createElement( 'th' );
        var nCloneTd = document.createElement( 'td' );
        nCloneTd.innerHTML = '<span class="row-details row-details-close"></span>';
         
        $('#sample_1 thead tr').each( function () {
            this.insertBefore( nCloneTh, this.childNodes[0] );
        } );
         
        $('#sample_1 tbody tr').each( function () {
            this.insertBefore(  nCloneTd.cloneNode( true ), this.childNodes[0] );
        } );
         
        /*
         * Initialize DataTables, with no sorting on the 'details' column
         */
     


	 var oTable = $('#sample_1').dataTable( {
            "aoColumnDefs": [
                {"bSortable": false, "aTargets": [ 0 ] }
            ],
            "aaSorting": [[1, 'asc']],
             "aLengthMenu": [
                [5, 15, 20, -1],
                [5, 15, 20, "All"] // change per page values here
            ],
            // set the initial value
            "iDisplayLength": 10,
        });

        jQuery('#sample_1_wrapper .dataTables_filter input').addClass("form-control input-small"); // modify table search input
        jQuery('#sample_1_wrapper .dataTables_length select').addClass("form-control input-small"); // modify table per page dropdown
        jQuery('#sample_1_wrapper .dataTables_length select').select2(); // initialize select2 dropdown
         
        /* Add event listener for opening and closing details
         * Note that the indicator for showing which row is open is not controlled by DataTables,
         * rather it is done here
         */
        $('#sample_1').on('click', ' tbody td .row-details', function () {
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
    }

     var initTable2 = function() {
    /*    var oTable = $('#sample_2').dataTable( {           
            "aoColumnDefs": [
                { "aTargets": [ 0 ] }
            ],
            "aaSorting": [[1, 'asc']],
             "aLengthMenu": [
                [5, 15, 20, -1],
                [5, 15, 20, "All"] // change per page values here
            ],
            // set the initial value
            "iDisplayLength": 10,
        });
		
		
	var oTable = $('#example').dataTable({              
           "bStateSave": false, //保存状态到cookie ******很重要 ， 当搜索的时候页面一刷新会导致搜索的消失。使用这个属性设置为true就可避免了           
           "bPaginate": true,// 是否使用分页
           "bProcessing": true, //是否显示正在处理的提示 
           "bLengthChange": false,//是否启用设置每页显示记录数                                                     
           "iDisplayLength":100,//默认每页显示的记录数
           "bFilter": true,    //是否使用搜索      
           "bJQueryUI": true, //页面风格使用jQuery.
          // "sScrollY": 200,//竖向滚动条 tbody区域的高度
           "sScrollX": "100%",//横向滚动条              
           "sScrollXInner": "100%",
           "bScrollCollapse": true,                  
           "oLanguage": {//语言国际化
                             "sUrl": "<%=path %>/css/datatables/dt.txt"
                          },           
           "sPaginationType": "full_numbers",//分页样式
           "bAutoWidth":true, //列的宽度会根据table的宽度自适应   
           "bSort": true,//是否使用排序   
           "aaSorting": [[ 0, "desc" ]],//默认按 第一列desc排序 这里以数组的形式表示 所以是序列是0   

			"bPaginate": true, //翻页功能  
			"bLengthChange": true, //改变每页显示数据数量  
			"bFilter": true, //过滤功能  
			"bSort": true, //排序功能  
			"bInfo": true,//页脚信息  
			"bAutoWidth": true,//自动宽度  
            "aaSortingFixed": [[5,'asc']],  //固定排序的列
		   
        });   	
		
		
		
   */

            var oTable = $('#sample_2').dataTable({    //2014.9.21  新加 取消搜索 分页
			    "bStateSave": true,
			    "bLengthChange":false,
				"bPaginate":false,   //分页的设置
				"bFilter":false,   //过滤器 页内搜索
				"bInfo":false,   //左下角 一共多少个数据
			//	"bJQueryUI":true,
			    "aaSorting": [[1, 'asc']],
                "aoColumnDefs": [{
                        'bSortable': false,
                        'aTargets': [2,3]
                    }
                ]
            });   
   
   
   
        jQuery('#sample_2_wrapper .dataTables_filter input').addClass("form-control input-small"); // modify table search input
        jQuery('#sample_2_wrapper .dataTables_length select').addClass("form-control input-small"); // modify table per page dropdown
        jQuery('#sample_2_wrapper .dataTables_length select').select2(); // initialize select2 dropdown

        $('#sample_2_column_toggler input[type="checkbox"]').change(function(){
            /* Get the DataTables object again - this is not a recreation, just a get of the object */
			
			alert( $(this).attr("data-column") ); 
			alert(  $(this).attr("checked") ); 
			
            var iCol = parseInt($(this).attr("data-column"));
            var bVis = oTable.fnSettings().aoColumns[iCol].bVisible;
            oTable.fnSetColumnVis(iCol, (bVis ? false : true));
        });
    }

    return {

        //main function to initiate the module
        init: function () {
            
            if (!jQuery().dataTable) {
                return;
            }

            initTable1();
          //  initTable2();
        }

    };

}();