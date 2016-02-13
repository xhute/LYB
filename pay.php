<?php
error_reporting(0);
$acc=$_GET['pid'];
$dj=$_GET['dj'];
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no" />
<meta content="yes" name="apple-mobile-web-app-capable" />
<meta content="black" name="apple-mobile-web-app-status-bar-style" />
<meta content="telephone=no" name="format-detection" />
<title>兵锋王座
</title>
<link rel="stylesheet" type="text/css" href="css.css" />
<script src="jquery.min.js"></script>
</head>
<body>

<form name="goodsForm" id="goodsForm" action="paybzzx.php" method="post">
<input  id="btnMoneyPay" type="button" class="btn" value="手机支付充值"  />
<input  id="act" name="act" type="hidden" value="usecode"  />
<input  id="game" name="game" type="hidden" value="兵锋王座"  />
<input  id="room" name="room" type="hidden" value="兵者之心"  />
<input  id="user" name="user" type="hidden" value="<?echo acc;?>"  />
<br/>
<input  id="btnCodePay" name="btnCodePay" type="button" class="btn" value="兑换码充值"  />
<br/>
<div id="inputPanel" class="viewwrap">
	<div class="userCard">
		<div class="userCardSub">
			<i class="bg_user"></i><i class="bg_split"></i>
			<input id="code" name="code" type="text" placeholder="请输入兑换码">
			
		</div>
	</div>
	<input  id="btnOK" type="button" class="btn" value="确认兑换"  />
</div>
</form>

<script type="text/javascript">
$(document).ready(function(){
	$('#btnMoneyPay').click(function(){
		window.location.href = "<?echo $url?>";
	});
	$('#btnCodePay').on('click',function(){
		$("#inputPanel").show(200);
	});
	$('#btnOK').on('click',function(){
		var code = $("#code").val();
		if( !code || "" == code){
			alert("兑换码不能为空！");
		}else{
			$("#btnCodePay").val("提交中,请稍后...");
			$("#inputPanel").hide();
			$("#goodsForm").submit();
		}
	});
})
</script>

</body>
</html>