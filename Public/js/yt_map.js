	
var	map= null,
	layer= null, //实时交通
	latLng= null, // 鼠标移动点的经纬度
	markersArray1 = null, //客户地址 标记点
	markersArray3 = null, //范围 标记点

    searchService = null, //按照客户标注点 检索 地址 
    geocoder = null, //按照客户标注点 解析 地址 
	init  = null;

    markersArray1 = [], //客户 起始地址 标记点
    markersArray3 = []; //范围 标记点 */
	maxradius=0 ;  //最大范围
	radius1000= false ;  //1000范围没有显示的时候: false   显示了:true 
	radius3000= false ;  //3000范围没有显示的时候: false   显示了:true 
	radius5000= false ;  //5000范围没有显示的时候: false   显示了:true 
	radius10000= false ;  //10000范围没有显示的时候: false   显示了:true 
	
	markersArray2 = null, //订单 标记点
	markersArray2_Listener1 = null, //订单 标记点的监听事件 当司机的标注被删除的时候,这个监听事件也被移除
	markersArray2_Listener2 = null, //订单 标记点的监听事件 当司机的标注被删除的时候,这个监听事件也被移除
	markersArray2_Listener3 = null, //订单 标记点的监听事件 当司机的标注被删除的时候,这个监听事件也被移除
	ordeinfo = null, // 订单的信息	
    markersArray2 = [], //订单 标记点
	markersArray2_Listener1 = [], //订单 标记点的监听事件 当司机的标注被删除的时候,这个监听事件也被移除
	markersArray2_Listener2 = [], //订单 标记点的监听事件 当司机的标注被删除的时候,这个监听事件也被移除
	markersArray2_Listener3 = []; //订单 标记点的监听事件 当司机的标注被删除的时候,这个监听事件也被移除	
	
var map_init = function() {	
    var center = new soso.maps.LatLng($("#city_lat").val(),$("#city_lng").val());  //这个坐标点 在登录的时候,设置在cook里面的,
    map = new soso.maps.Map(document.getElementById('map'),{
        center: center,
        zoomLevel: parseInt($("#city_zoomLevel").val())   //12
    });	
	
    ordeinfo = new soso.maps.InfoWindow({  //点击订单的图标以后,显示的信息
        map: map
    });	
	
	layer = new soso.maps.TrafficLayer(); //实时交通图层

   searchService = new soso.maps.SearchService();	//按照客户标注点 检索 地址 
   geocoder = new soso.maps.Geocoder();	
  //地图上鼠标右键菜单
		var contextMenu=new soso.maps.ContextMenuControl();  //地图上鼠标右键菜单
			contextMenu.setMap(map);
			contextMenu.addItem("标注客户地址",addCustomerMarker1);  //标记客户地址
			contextMenu.addSeparator();
			contextMenu.addItem("标注客户地址1公里范围",showCircle1000);
			contextMenu.addSeparator();
            contextMenu.addItem("标注客户地址3公里范围",showCircle3000);
			contextMenu.addSeparator();
            contextMenu.addItem("标注客户地址5公里范围",showCircle5000);
			contextMenu.addSeparator();
            contextMenu.addItem("标注客户地址10公里范围",showCircle10000);					
			contextMenu.addSeparator();
			contextMenu.addItem("移除范围标注",removeCircle);	//移除客户范围					            
			contextMenu.addSeparator();
			contextMenu.addItem("移除客户地址",deleteCustomerMarker);  //移除客户起始位置	      			
			contextMenu.addTarget(map);

	   //注册一个右键事件 鼠标右键点击以后 记录经纬度 
	   soso.maps.Event.addListener(map,'rightclick',function(event) {
			latLng = event.latLng;
		});	
		
		//添加地图导航平移控件
		var navControl = new soso.maps.NavigationControl({
			align: soso.maps.ALIGN.TOP_LEFT,
			margin: new soso.maps.Size(5, 15),
			map: map
		});		
	
		//添加谷歌地图图层及数据版权
		var  worldBounds=new soso.maps.LatLngBounds(
			new soso.maps.LatLng(-90,-180),
			new soso.maps.LatLng(90, 180)
		),
		copyrights=new soso.maps.CopyrightCollection('&nbsp;&nbsp地图数据&copy; ');
		copyrights.addCopyright(new soso.maps.Copyright("google",worldBounds, 1));

		//实现谷歌地图图层类
		var GoogleLayer = function(options) {};
		//继承TileLayer类
		GoogleLayer.prototype = new soso.maps.TileLayer();
		//自定义图块地址
		GoogleLayer.prototype = new soso.maps.TileLayer({
			tileUrlTemplate:'http://{s}.google.com/vt/lyrs=m@159000000&'+
				'hl=zh-CN&gl=cn&x={x}&y={y}&z={z}&s=Gali',
			tileSubdomains:'mt0,mt1,mt2,mt3',
			copyrights:copyrights
		});

		var googleLayer = new GoogleLayer();
		var mapType = new soso.maps.MapType(
			{
				name : '谷歌地图',
				alt : '谷歌街道图层',
				layers : [googleLayer]
			}
		)
		//注册地图类型
	//	map.mapTypes.set('g_roadmap',mapType);
		//设置地图类型为g_roadmap
	//	map.setMapTypeId('g_roadmap');	 
}

var map_onlyshow_init = function() {	
    var center = new soso.maps.LatLng($("#city_lat").val(),$("#city_lng").val());  //这个坐标点 在登录的时候,设置在cook里面的,
    map = new soso.maps.Map(document.getElementById('map'),{
        center: center,
        zoomLevel: parseInt($("#city_zoomLevel").val())   //12
    });	
	
    ordeinfo = new soso.maps.InfoWindow({  //点击订单的图标以后,显示的信息
        map: map
    });		
	
	layer = new soso.maps.TrafficLayer(); //实时交通图层

   searchService = new soso.maps.SearchService();	//按照客户标注点 检索 地址 
   geocoder = new soso.maps.Geocoder();	
  //地图上鼠标右键菜单
		var contextMenu=new soso.maps.ContextMenuControl();  //地图上鼠标右键菜单
			contextMenu.setMap(map);
			contextMenu.addItem("标注客户地址1公里范围",showCircle1000);
			contextMenu.addSeparator();
            contextMenu.addItem("标注客户地址3公里范围",showCircle3000);
			contextMenu.addSeparator();
            contextMenu.addItem("标注客户地址5公里范围",showCircle5000);
			contextMenu.addSeparator();
            contextMenu.addItem("标注客户地址10公里范围",showCircle10000);					
			contextMenu.addSeparator();
			contextMenu.addItem("移除范围标注",removeCircle);	//移除客户范围					                 			
			contextMenu.addTarget(map);

	   //注册一个右键事件 鼠标右键点击以后 记录经纬度 
	   soso.maps.Event.addListener(map,'rightclick',function(event) {
			latLng = event.latLng;
		});	
		
    soso.maps.Event.addListener(map,'zoomlevel_changed',function() {  //监听地图缩放
        $("#zoom_level").val(map.getZoomLevel())  ;   //写入地图的级别
    });			
		
		
		//添加地图导航平移控件
		var navControl = new soso.maps.NavigationControl({
			align: soso.maps.ALIGN.TOP_LEFT,
			margin: new soso.maps.Size(5, 15),
			map: map
		});		
	
		//添加谷歌地图图层及数据版权
		var  worldBounds=new soso.maps.LatLngBounds(
			new soso.maps.LatLng(-90,-180),
			new soso.maps.LatLng(90, 180)
		),
		copyrights=new soso.maps.CopyrightCollection('&nbsp;&nbsp地图数据&copy; ');
		copyrights.addCopyright(new soso.maps.Copyright("google",worldBounds, 1));

		//实现谷歌地图图层类
		var GoogleLayer = function(options) {};
		//继承TileLayer类
		GoogleLayer.prototype = new soso.maps.TileLayer();
		//自定义图块地址
		GoogleLayer.prototype = new soso.maps.TileLayer({
			tileUrlTemplate:'http://{s}.google.com/vt/lyrs=m@159000000&'+
				'hl=zh-CN&gl=cn&x={x}&y={y}&z={z}&s=Gali',
			tileSubdomains:'mt0,mt1,mt2,mt3',
			copyrights:copyrights
		});

		var googleLayer = new GoogleLayer();
		var mapType = new soso.maps.MapType(
			{
				name : '谷歌地图',
				alt : '谷歌街道图层',
				layers : [googleLayer]
			}
		)
		//注册地图类型
	//	map.mapTypes.set('g_roadmap',mapType);
		//设置地图类型为g_roadmap
	//	map.setMapTypeId('g_roadmap');	 
}

var YTmap_showorder_init = function() {	
    var center = new soso.maps.LatLng($("#city_lat").val(),$("#city_lng").val());  //这个坐标点 在登录的时候,设置在cook里面的,
    map = new soso.maps.Map(document.getElementById('map'),{
        center: center,
        zoomLevel: parseInt($("#city_zoomLevel").val())   //12
    });	
	
    ordeinfo = new soso.maps.InfoWindow({  //点击订单的图标以后,显示的信息
        map: map
    });		
	
	layer = new soso.maps.TrafficLayer(); //实时交通图层

    geocoder = new soso.maps.Geocoder();	

		//添加地图导航平移控件
		var navControl = new soso.maps.NavigationControl({
			align: soso.maps.ALIGN.TOP_LEFT,
			margin: new soso.maps.Size(5, 15),
			map: map
		});		
	
		//添加谷歌地图图层及数据版权
		var  worldBounds=new soso.maps.LatLngBounds(
			new soso.maps.LatLng(-90,-180),
			new soso.maps.LatLng(90, 180)
		),
		copyrights=new soso.maps.CopyrightCollection('&nbsp;&nbsp地图数据&copy; ');
		copyrights.addCopyright(new soso.maps.Copyright("google",worldBounds, 1));

		//实现谷歌地图图层类
		var GoogleLayer = function(options) {};
		//继承TileLayer类
		GoogleLayer.prototype = new soso.maps.TileLayer();
		//自定义图块地址
		GoogleLayer.prototype = new soso.maps.TileLayer({
			tileUrlTemplate:'http://{s}.google.com/vt/lyrs=m@159000000&'+
				'hl=zh-CN&gl=cn&x={x}&y={y}&z={z}&s=Gali',
			tileSubdomains:'mt0,mt1,mt2,mt3',
			copyrights:copyrights
		});

		var googleLayer = new GoogleLayer();
		var mapType = new soso.maps.MapType(
			{
				name : '谷歌地图',
				alt : '谷歌街道图层',
				layers : [googleLayer]
			}
		)
		//注册地图类型
	//	map.mapTypes.set('g_roadmap',mapType);
		//设置地图类型为g_roadmap
	//	map.setMapTypeId('g_roadmap');	 
}




	function addCustomerMarker1(){  //网页的右键菜单  标记客户地址		 
      addCustomerMarker(latLng.getLat().toFixed(5),latLng.getLng().toFixed(5)) ;
	}
	
	function addCustomerMarker(lat,lng){  //标记客户地址
        var latLng=new soso.maps.LatLng(lat,lng) ; 
    	if ( markersArray1.length != 0) { removeCustomerMarker(); } // 先移除标记过的点				
		var anchor = new soso.maps.Point(10, 10),
			size = new soso.maps.Size(24, 24),
		//	icon = new soso.maps.MarkerImage("http://api.map.soso.com/doc/sample/img/center.gif", size, anchor);  
			icon = new soso.maps.MarkerImage($("#url_public").val()+'/images/center_red.gif', size, anchor);	 //自定义图片
	//	var anchor = new soso.maps.Point(11, 32),
	//		size = new soso.maps.Size(23, 32),			
	//		icon = new soso.maps.MarkerImage($("#url_public").val()+'/images/maker_red32.png', size, anchor);	 //自定义图片
		var marker = new soso.maps.Marker({
			position: latLng,
			draggable: true,
			icon: icon,
			map: map  
		});					
		soso.maps.Event.addListener(marker, 'dragend', function() {  //注册了一个拖拽结束以后触发的事件
				 map.moveTo( marker.getPosition() )  ;  //地图移到标记点为中心
				 moveCircle(); //范围标注 也随之移动
				 return_latLng("address_start");	//返回 起始地址 标注点的经纬度 (返回客户端使用用)
				 
		 }); 

		markersArray1.push(marker);	
		map.moveTo( latLng )  ;  //地图移到标记点为中心	
		moveCircle(); //范围标注 也随之移动
		return_latLng();	//返回 地址的经纬度
	}	
	
	
	function addCustomerMarker2(lat,lng){  //标记客户地址  修改客户那里使用
        var latLng=new soso.maps.LatLng(lat,lng) ; 
    	if ( markersArray1.length != 0) { removeCustomerMarker(); } // 先移除标记过的点				
		var anchor = new soso.maps.Point(10, 10),
			size = new soso.maps.Size(24, 24),
		//	icon = new soso.maps.MarkerImage("http://api.map.soso.com/doc/sample/img/center.gif", size, anchor);  
			icon = new soso.maps.MarkerImage($("#url_public").val()+'/images/center_red.gif', size, anchor);	 //自定义图片
	//	var anchor = new soso.maps.Point(11, 32),
	//		size = new soso.maps.Size(23, 32),			
	//		icon = new soso.maps.MarkerImage($("#url_public").val()+'/images/maker_red32.png', size, anchor);	 //自定义图片
		var marker = new soso.maps.Marker({
			position: latLng,
			draggable: true,
			icon: icon,
			map: map  
		});					
		soso.maps.Event.addListener(marker, 'dragend', function() {  //注册了一个拖拽结束以后触发的事件
				 map.moveTo( marker.getPosition() )  ;  //地图移到标记点为中心
				 moveCircle(); //范围标注 也随之移动
				 return_latLng();	//返回 起始地址 标注点的经纬度 (返回客户端使用用)
				 
		 }); 

		markersArray1.push(marker);	
		map.moveTo( latLng )  ;  //地图移到标记点为中心	
		moveCircle(); //范围标注 也随之移动
	//	return_latLng();	//返回 地址的经纬度
	}		
	
	
	function showCustomerMarker(lat,lng){  //显示客户标记点
        var latLng=new soso.maps.LatLng(lat,lng) ;
    	if ( markersArray1.length != 0) { removeCustomerMarker(); } // 先移除标记过的点				
		var anchor = new soso.maps.Point(10, 10),
			size = new soso.maps.Size(24, 24),
		//	icon = new soso.maps.MarkerImage("http://api.map.soso.com/doc/sample/img/center.gif", size, anchor);  
			icon = new soso.maps.MarkerImage($("#url_public").val()+'/images/center_red.gif', size, anchor);	 //自定义图片
	//	var anchor = new soso.maps.Point(11, 32),
	//		size = new soso.maps.Size(23, 32),			
	//		icon = new soso.maps.MarkerImage($("#url_public").val()+'/images/maker_red32.png', size, anchor);	 //自定义图片
		var marker = new soso.maps.Marker({
			position: latLng,
			draggable: false,
			icon: icon,
			map: map  
		});					
		
		markersArray1.push(marker);	
		map.moveTo( latLng )  ;  //地图移到标记点为中心	
		moveCircle(); //范围标注 也随之移动
	//	return_latLng();	//返回 地址的经纬度
	}	
	
	function moveToCenter(lat,lng){  //把标注点移动到中心点
	   var latLng=new soso.maps.LatLng(lat,lng) ;
		map.moveTo( latLng )  ;  //地图移到标记点为中心	
		moveCircle(); //范围标注 也随之移动	   
	}
	
	function return_latLng(){	//返回标注点的经纬度
	    var latLng_jsonstr='', latLng='' , order_string;	
			if ( markersArray1.length != 0) { 
				latLng = markersArray1[0].getPosition() ;	
  				order_string="web4" ;   
			} else {
				return;
			}

		 latLng_jsonstr = '"Lat":"'+latLng.getLat().toFixed(5)+'"';
		 latLng_jsonstr = latLng_jsonstr+',"Lng":"'+latLng.getLng().toFixed(5)+'"';		 
		 $("#customer_marker_lat").val(latLng.getLat().toFixed(5))	;
		 $("#customer_marker_lng").val(latLng.getLng().toFixed(5))	;			 
		 
		 geocoder.geocode({'location': latLng}, function(results, status) {
			if (status == soso.maps.GeocoderStatus.OK) {
					 var address = results.address ; //去掉解析回来的中国XXX市  市以前的字符串 比如解析回来的  中国北京市石景山区   市以前的字符串全删除					 							 
					 address = address.substr(address.indexOf("中国")+2)	
					 latLng_jsonstr = latLng_jsonstr+',"Address":"'+address+'"';
					 latLng_jsonstr='{'+latLng_jsonstr+'}'; 
                     $("#address").val(address)	;					 
					// alert(order_string+latLng_jsonstr)	; 
			} else {
					 latLng_jsonstr = latLng_jsonstr+',"Address":""';
					 latLng_jsonstr='{'+latLng_jsonstr+'}';  
					// alert(order_string+latLng_jsonstr)	; 
			}
		  });	       			
	}

	function return_latLng_null(){	//删除客户标注点以后,修改客户端的经纬度为空
	    var latLng_jsonstr='', order_string;						
		 latLng_jsonstr = '"Lat":""';
		 latLng_jsonstr = latLng_jsonstr+',"Lng":""';
		 latLng_jsonstr = latLng_jsonstr+',"Address":""';
		 latLng_jsonstr='{'+latLng_jsonstr+'}';
		// alert(order_string+latLng_jsonstr)	;   
		 $("#customer_marker_lat").val('')	;
		 $("#customer_marker_lng").val('')	;	
		
	}
		
	function deleteCustomerMarker() {  
		removeCustomerMarker() ; // 移除客户地址标注
		removeCircle();  //移除范围标注
	}
	
	function removeCustomerMarker() {   // 移除客户地址标注
		if (markersArray1) {
			for (var i in markersArray1) {
				markersArray1[i].setMap(null);
			}
			markersArray1.length = 0;
		}
       return_latLng_null();	//删除客户标注点以后,修改客户端的经纬度为空				
	}	

	function showCircle1000() {  //显示1公里范围
		if ( radius1000 == false ) {  //1000范围没有显示的时候: false   显示了:true 
			 showCircle( 1000 ) ;
			 radius1000 = true;
		 }
	 }

	function showCircle3000() {  //显示3公里范围
		if ( radius3000 == false ) {  //3000范围没有显示的时候: false   显示了:true 
			 showCircle( 3000 ) ;
			 radius3000 = true;
		 }
	}			

	function showCircle5000() {   //显示5公里范围
		if ( radius5000 == false ) {  //5000范围没有显示的时候: false   显示了:true 
			 showCircle( 5000 ) ;
			 radius5000 = true;
		 }
	}	
	
	function showCircle10000() {  //显示10公里范围
		if ( radius10000 == false ) {  //10000范围没有显示的时候: false   显示了:true 
			 showCircle( 10000 ) ;
			 radius10000 = true;
		 }
	}	
	
	function removeCircle() {   //移除范围标注
		if (markersArray3) {
			for (var i in markersArray3) {
				markersArray3[i].setMap(null);
			}
			markersArray3.length = 0;
			maxradius=0;  //最大范围清零
			radius1000= false ;  //1000范围没有显示的时候: false   显示了:true 
			radius3000= false ;  //3000范围没有显示的时候: false   显示了:true 
			radius5000= false ;  //5000范围没有显示的时候: false   显示了:true 
			radius10000= false ;  //10000范围没有显示的时候: false   显示了:true 						
		}
	}				
	
	function moveCircle(){   //范围标注移动 
		if (markersArray3) {
			for (var i in markersArray3) {  
				markersArray3[i].setCenter(markersArray1[0].getPosition());
			}									
		}
	}		
	
	function showCircle( radius ){  //显示一个圆形的区域
			if (markersArray1) {
				var circle=new soso.maps.Circle({  //圆形的区域显示
					map:map,
					center:markersArray1[0].getPosition(),
					radius:radius,
					fillColor:"#00f",
					fillOpacity:0.1,
					strokeWeight:1
				});					
				circle.setMap(map);	
                circle.setStrokeDashStyle("solid");		 //solid  :圆滑   dash:带节点	
				markersArray3.push(circle);	
				map.moveTo( markersArray1[0].getPosition() )  ;  //地图移到标记点为中心		
		  }	
    }

	function changeMapType(){	//改变地图的类别
        if ( map.getMapTypeId() == 'hybrid' ) {
             map.setMapTypeId(soso.maps.MapTypeId.SATELLITE); //卫星地图
		}			
		else{   
             map.setMapTypeId(soso.maps.MapTypeId.HYBRID);  //卫星地图(路网)					 
		}	
	}

	function changeMap(from){   //改变地图的类别  google or  soso
		if(from == 'google'){
			map.setMapTypeId('g_roadmap');
		}else{        
			map.setMapTypeId(soso.maps.MapTypeId.ROADMAP);
		}

	}	
	
	function changeLayer(){  //实时交通
        if ( layer.getMap() == null ) {
             layer.setMap(map); //加载这个图层
		}else{        			
			layer.setMap(null);  //删除这个图层
		}
	}

	function YTmap_resize(v_height){  //修改地图的高度来适应窗口的大小  高度    初始 v_height=-135  高差
		var height= $(window).height()+v_height ;
			$( "#map" ).css("height", height);	 //调整地图的高度
	}	
	
	function YTmap_showorder()	 {   //显示售后订单地图
	   var anchor = new soso.maps.Point(11, 32),
		   size = new soso.maps.Size(23, 32),			
		   icon = new soso.maps.MarkerImage($("#url_public").val()+'/images/maker_red32.png', size, anchor),	 //自定义图片 
		   icon1 = new soso.maps.MarkerImage($("#url_public").val()+'/images/maker_green32.png', size, anchor);	 //自定义图片    
	   var ytleft=111110,ytright=0,yttop=0,ytbottom=111110,ytLng=0,ytLat=0;				
		$("#yt_table tr").each(function(trindex,tritem){  //遍历表格行
			if ( $(tritem).find('td:eq(3)').text() ) {   //如果不是空行 显示订单的坐标	  				 				     
						   var  marker = new soso.maps.Marker({
								position: new soso.maps.LatLng($(tritem).find('td:eq(3)').text(),$(tritem).find('td:eq(4)').text()),
								icon: icon,
								map: map  
							});	
						 
							var  ordeinfostr= '<div style="width:350px;"> 预约时间: '+ $(tritem).find('td:eq(0)').text() + '<br/>'  +
																		  '订单状态: '+ $(tritem).find('td:eq(5)').text() + '<br/>'  +
																		  '售后单号: <a  href= "JavaScript:YTserviceorder_info( '+$(tritem).find('td:eq(8)').text() +' );" >'+$(tritem).find('td:eq(1)').text() +' </a> <br/> '+	
																		  '售后人员: <a  href= "JavaScript:YTmap_servicestaff_recordlist('+$(tritem).find('td:eq(10)').text() +');" >'+$(tritem).find('td:eq(2)').text() +' </a> <br/> '+									                       
																		  '售后商品: '+ $(tritem).find('td:eq(6)').text()  +'<br/> '+
																		   '客户资料: <a  href= "JavaScript:YTcustomer_info('+$(tritem).find('td:eq(9)').text() +');" >'+$(tritem).find('td:eq(7)').text() +' </a> <br/> </div>';
																																					
							var markerListener1 = soso.maps.Event.addListener(marker, 'click', function() {
								ordeinfo.open(ordeinfostr, marker);							
							});	
							
							var markerListener2 = soso.maps.Event.addListener(marker, 'mouseover', function() {						      
								  marker.setIcon(icon1) ;	
								  $(tritem).find("td").css("background-color","#c1ebff");  									
							});	

							var markerListener3 = soso.maps.Event.addListener(marker, 'mouseout', function() {
								  marker.setIcon(icon);
								  $(tritem).find("td").css("background-color","");  
								// alert("mouseout" );												
							});	


							$(tritem)  //定义表格行的监听事件
								  .bind('mouseover', function (event) {
									  marker.setIcon(icon1) ;								  
								  })
								  .bind('mouseout', function (event) {
									  marker.setIcon(icon);
								  })
								  .bind('click', function (event) {
									   ordeinfo.open(ordeinfostr, marker);	
								  });
								  
						ytLng = $(tritem).find('td:eq(4)').text()+0;
						ytLat = $(tritem).find('td:eq(3)').text()+0;			  
						if ( ytright < ytLng ) {
							ytright = ytLng ;					
						}		  
						if ( ytleft > ytLng ) {
							ytleft = ytLng ;
						}	
						if ( yttop < ytLat ) {
							yttop = ytLat ;
						}	
						if ( ytbottom > ytLat ) {
							ytbottom = ytLat ;
						}	
						
						markersArray2.push(marker);	 //保存订单的标记点
						markersArray2_Listener1.push(markerListener1);	 //保存订单的监听事件	
						markersArray2_Listener2.push(markerListener2);	 //保存订单的监听事件	
						markersArray2_Listener3.push(markerListener3);	 //保存订单的监听事件	
			}
		});
		if  ( $("#yt_table tr").length > 2 ) {   //最少有两个订单 就自动设定范围
				map.fitBounds(new soso.maps.LatLngBounds(
					new soso.maps.LatLng(yttop,ytleft),
					new soso.maps.LatLng(ytbottom,ytright)
				));
		}
	}	
	
	function YTmap_showservicestaff()	 {   //显示售后人员地图
	   var anchor = new soso.maps.Point(11, 32),
		   size = new soso.maps.Size(23, 32),			
		   icon = new soso.maps.MarkerImage($("#url_public").val()+'/images/maker_red32.png', size, anchor),	 //自定义图片 
		   icon1 = new soso.maps.MarkerImage($("#url_public").val()+'/images/maker_green32.png', size, anchor);	 //自定义图片    
	   var ytleft=111110,ytright=0,yttop=0,ytbottom=111110,ytLng=0,ytLat=0;				
		$("#yt_table tr").each(function(trindex,tritem){  //遍历表格行
			if ( $(tritem).find('td:eq(2)').text() ) {   //如果不是空行 显示订单的坐标	  				 				     
						   var  marker = new soso.maps.Marker({
								position: new soso.maps.LatLng($(tritem).find('td:eq(2)').text(),$(tritem).find('td:eq(3)').text()),
								icon: icon,
								map: map  
							});	
						 
							var  ordeinfostr= '<div style="width:350px;"> '  +
                                                                          '售后人员: <a  href= "JavaScript:YTmap_servicestaff_recordlist( '+$(tritem).find('td:eq(6)').text() +' );" >'+$(tritem).find('td:eq(1)').text() +' </a> <br/> '+																		                       
																		  
																		  '电话号码: '+ $(tritem).find('td:eq(5)').text()  +'<br/></div> '+
																		  '员工编号: '+ $(tritem).find('td:eq(4)').text()  +'<br/> '+
																		  '定位时间: '+ $(tritem).find('td:eq(0)').text() + '<br/>';																		
							var markerListener1 = soso.maps.Event.addListener(marker, 'click', function() {
								ordeinfo.open(ordeinfostr, marker);							
							});	
							
							var markerListener2 = soso.maps.Event.addListener(marker, 'mouseover', function() {						      
								  marker.setIcon(icon1) ;	
								  $(tritem).find("td").css("background-color","#c1ebff");  									
							});	

							var markerListener3 = soso.maps.Event.addListener(marker, 'mouseout', function() {
								  marker.setIcon(icon);
								  $(tritem).find("td").css("background-color","");  
								// alert("mouseout" );												
							});	


							$(tritem)  //定义表格行的监听事件
								  .bind('mouseover', function (event) {
									  marker.setIcon(icon1) ;								  
								  })
								  .bind('mouseout', function (event) {
									  marker.setIcon(icon);
								  })
								  .bind('click', function (event) {
									   ordeinfo.open(ordeinfostr, marker);	
								  });
								  
						ytLng = $(tritem).find('td:eq(3)').text()+0;
						ytLat = $(tritem).find('td:eq(2)').text()+0;			  
						if ( ytright < ytLng ) {
							ytright = ytLng ;					
						}		  
						if ( ytleft > ytLng ) {
							ytleft = ytLng ;
						}	
						if ( yttop < ytLat ) {
							yttop = ytLat ;
						}	
						if ( ytbottom > ytLat ) {
							ytbottom = ytLat ;
						}	
						
						markersArray2.push(marker);	 //保存订单的标记点
						markersArray2_Listener1.push(markerListener1);	 //保存订单的监听事件	
						markersArray2_Listener2.push(markerListener2);	 //保存订单的监听事件	
						markersArray2_Listener3.push(markerListener3);	 //保存订单的监听事件	
			}
		});
		if  ( $("#yt_table tr").length > 2 ) {   //最少有两个订单 就自动设定范围
				map.fitBounds(new soso.maps.LatLngBounds(
					new soso.maps.LatLng(yttop,ytleft),
					new soso.maps.LatLng(ytbottom,ytright)
				));
		}
	}	
		