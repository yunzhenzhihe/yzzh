<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>成功提示</title>
<style type="text/css">
body  {
   font: 16px/20px Verdana, Helvetica, Arial, sans-serif; 
}
</style>
  <link rel="shortcut icon" href="/yzzh/Public/assets/img/yt.ico" />  
</head>
<body>

<div id="leftbar" align=center style='margin-top:75px;'>   
    <IMG src="./Public/images/success.png" height=169  width=292><BR>
</div>   
    
<div  align=center  style='margin-top:55px;' >  
       <h3> <?php echo($message); ?>  </h3>
	   <?php echo ($jump_memo); ?>  <br></br>
	   <span id='return_href'>
	   <?php if(($jump_flag == "true" )): ?>页面自动 <a id="href" href="<?php echo($jumpUrl); ?>">跳转</a> 等待时间：
		   <?php if(($waittime == null )): ?><b id="wait"><?php echo(5); ?>	
			<?php else: ?>	 	
				  <b id="wait"><?php echo($waittime); endif; endif; ?> 	  
	   </span> 
</div>

<script type="text/javascript">
(function(){
		var wait = document.getElementById('wait'),href = document.getElementById('href').href;
		var interval = setInterval(function(){
			var time = --wait.innerHTML;
			if(time <= 0) {
				location.href = href;
				clearInterval(interval);
			};
		}, 1000);
		})();
		
     var history_length=history.length;
	 if  ( history_length==1 ) {
	       document.getElementById('return_href').style.display = "none";
	 }	
		
	
</script>
</body>
</html>