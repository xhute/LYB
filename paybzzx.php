<?php

error_reporting(0);
// Include ezSQL core
include_once "ez_sql_core.php";
include_once "ez_sql_mysql.php";


$value = $_POST['value'];
$game = $_POST['game'];
$room = $_POST['room'];
$code = $_POST['code'];
$user = $_POST['user'];

$result = "";


// Initialise database object and establish a connection
// at the same time - db_user / db_password / db_name / db_host
$db = new ezSQL_mysql('root','root','lyb','127.0.0.1');

$sql = "SELECT `code`,`value` FROM goldcode where "
	." `code`='$code' and `valid`=1 and `game`='$game' and `room`='$room'";
$row = $db->get_row($sql);
//echo $sql;echo "<br/>";
if( null != $row ){
	$value = $row->value;
	pay($user,$value,$code);
	$sql ="UPDATE goldcode set `user` ='$user',`usetime`='',`valid`=0 WHERE `code`='$code'";
	//echo $sql;	echo "<br/>";
	$db->query($sql);
	
	echo "成功兑换价值".$value."元人民币的血精";
}else{
	echo "兑换码不正确，或已使用";
}
}
function pay($acc,$dj,$orderid){   //查询角色
	$acc = str_replace('-',',',$acc);

    $r = "http://219.234.6.156:28175?paydes={$acc}&amount={$dj}&orderid={$orderid}";
	$ch = curl_init();  
	$timeout = 5;  
	curl_setopt ($ch, CURLOPT_URL,$r);  
	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);  
	curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);  
	$file_contents = curl_exec($ch);  
	curl_close($ch);  
	//echo $file_contents;
	return 'Success';
}
?>