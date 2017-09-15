/*The MIT License (MIT)

Copyright (c) 2014 https://github.com/kayalshri/

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.*/

(function($){
        $.fn.extend({
            tableExport: function(options) {
                var defaults = {
						separator: ',',
						ignoreColumn: [],
						tableName:'yourTableName',
						type:'csv',
						pdfFontSize:14,
						pdfLeftMargin:20,
						escape:'true',
						htmlContent:'false',
						consoleLog:'false',
						fileName:'云天软件.xls' , //导出文件名   defaults.fileName
						tableTitle:'' , //表格标题
						tableEnd:''  //表格尾
				};
                
				var options = $.extend(defaults, options);
				var el = this;
				
                if(defaults.type == 'excel' || defaults.type == 'doc'|| defaults.type == 'powerpoint'  ){
					//console.log($(this).html());
					var excel="<table>";	
					var tableHead= '';
					var i=0;
					
					$(el).find('thead').find('tr').each(function() {
						tableHead += "<tr>";
						$(this).filter(':visible').find('th').each(function(index,data) {
							if ($(this).css('display') != 'none'){					
								if(defaults.ignoreColumn.indexOf(index) == -1){
									tableHead += "<td>" + parseString($(this))+ "</td>";
									i +=1 ;
								}
							}
						});	
						tableHead += '</tr>';						
						
					});					
					
					if  ( defaults.tableTitle !=  '' ) {
						excel += "<tr>";
						excel += "<td colspan='"+i+"'>"+defaults.tableTitle+"</td> ";
					    excel += '</tr>';
					}
					
					excel += tableHead;
					
					// Row Vs Column
					var rowCount=1;
					$(el).find('tbody').find('tr').each(function() {
						excel += "<tr>";
						var colCount=0;
						$(this).filter(':visible').find('td').each(function(index,data) {
							if ($(this).css('display') != 'none'){	
								if(defaults.ignoreColumn.indexOf(index) == -1){
								   excel += "<td style='vnd.ms-excel.numberformat:@'>"+parseString($(this))+"</td>";
								//excel += "<td >"+parseString($(this))+"</td>";
									/* 
									excel支持的格式。下面就列出常用的一些格式：
									1） 文本：vnd.ms-excel.numberformat:@
									2） 日期：vnd.ms-excel.numberformat:yyyy/mm/dd
									3） 数字：vnd.ms-excel.numberformat:#,##0.00
									4） 货币：vnd.ms-excel.numberformat:￥#,##0.00
									5） 百分比：vnd.ms-excel.numberformat: #0.00%
									这些格式你也可以自定义，比如年月你可以定义为：yy-mm等等
									*/								
								}
							}
							colCount++;
						});															
						rowCount++;
						excel += '</tr>';
					});
					
					if  ( defaults.tableEnd !=  '' ) {
						excel += "<tr>";
						excel += "<td colspan='"+i+"'>"+defaults.tableEnd+"</td> ";
					    excel += '</tr>';
					}
					
					excel += '</table>'
					
					if(defaults.consoleLog == 'true'){
						console.log(excel);
					}
					
					var excelFile = "<html xmlns:o='urn:schemas-microsoft-com:office:office' xmlns:x='urn:schemas-microsoft-com:office:"+defaults.type+"' xmlns='http://www.w3.org/TR/REC-html40'>";
					excelFile += "<head > <meta content='charset=gb2312'> ";
					excelFile += "<!--[if gte mso 9]>";
					excelFile += "<xml>";
					excelFile += "<x:ExcelWorkbook>";					
					excelFile += "<x:ExcelWorksheets>";
					excelFile += "<x:ExcelWorksheet>";
					excelFile += "<x:Name>";
					excelFile += "worksheet";
					excelFile += "</x:Name>";
					excelFile += "<x:WorksheetOptions>";
					excelFile += "<x:DisplayGridlines/>";
					excelFile += "</x:WorksheetOptions>";
					excelFile += "</x:ExcelWorksheet>";
					excelFile += "</x:ExcelWorksheets>";
					excelFile += "</x:ExcelWorkbook>";
					excelFile += "</xml>";
					excelFile += "<![endif]-->";
					excelFile += "</head>";
					excelFile += "<body>";
					excelFile += excel;
					excelFile += "</body>";
					excelFile += "</html>";
					
				//	 alert(excelFile);  
					var base64data = "base64," + $.base64({data:excelFile,type:0});
					
					var ua = window.navigator.userAgent;  //判断浏览器的类型 做不同的导出  这里要做一个判断浏览器的通用函数 很多地方都需要判断支持 ie 苹果 chrom  等等这些
					var msie = ua.indexOf("MSIE"); 
					if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./))      // 判断浏览器是不是 Internet Explorer
					{
						var d=window.open('','globalexcelTmpIframe');
							d.document.writeln(excelFile);
							d.document.close(); 
							d.document.execCommand('Saveas', true, defaults.fileName); 
							d.close(); 			
					}  
					else   {     //别的浏览器 other browser not tested on IE 11					
							var downloadLink = document.createElement("a");
							downloadLink.href = 'data:application/vnd.ms-excel;fileName=a.xls;' + base64data;
							downloadLink.download = defaults.fileName;  //下载文件名
							document.body.appendChild(downloadLink);
							downloadLink.click();
							document.body.removeChild(downloadLink);					
					       //	window.open('data:application/vnd.ms-excel;fileName=a.xls;' + base64data);
					}            
				}

				function parseString(data){
				
					if(defaults.htmlContent == 'true'){
						//content_data = data.html().trim();
						content_data = trim( data.html() );
					}else{
						//content_data = data.text().trim();
					    content_data = trim( data.text() );
					} 
					if(defaults.escape == 'true'){
						content_data = escape(content_data);
					}
					return content_data;
				}
			
			}
        });
    })(jQuery);
        
