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
<title>��������
</title>
<link rel="stylesheet" type="text/css" href="css.css" />
<script src="jquery.min.js"></script>
</head>
<body>

<form name="goodsForm" id="goodsForm" action="paybzzx.php" method="post">
<input  id="btnMoneyPay" type="button" class="btn" value="�ֻ�֧����ֵ"  />
<input  id="act" name="act" type="hidden" value="usecode"  />
<input  id="game" name="game" type="hidden" value="��������"  />
<input  id="room" name="room" type="hidden" value="����֮��"  />
<input  id="user" name="user" type="hidden" value="<?echo acc;?>"  />
<br/>
<input  id="btnCodePay" name="btnCodePay" type="button" class="btn" value="�һ����ֵ"  />
<br/>
<div id="inputPanel" class="viewwrap">
	<div class="userCard">
		<div class="userCardSub">
			<i class="bg_user"></i><i class="bg_split"></i>
			<input id="code" name="code" type="text" placeholder="������һ���">
			
		</div>
	</div>
	<input  id="btnOK" type="button" class="btn" value="ȷ�϶һ�"  />
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
			alert("�һ��벻��Ϊ�գ�");
		}else{
			$("#btnCodePay").val("�ύ��,���Ժ�...");
			$("#inputPanel").hide();
			$("#goodsForm").submit();
		}
	});
})
</script>

</body>
</html>