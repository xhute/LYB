<?php
/*
程序：goldcode.php

功能：生成兑换码
输入：act=gencode&pwd=123&value=100.0&amount=1&game=兵锋王座&room=兵者之心&generator=xhute
输出：{ "ret":"0",
	"game":"兵锋王座",
	"room":"兵者之心",
	"value":"6.00",
	"codes":["asdfadsf","qerqwer"]
}
0	成功
1	密码不正确
2	game/room不存在

功能：使用兑换码
输入：act=usecode&code=adfadsf&user=xhute&game=兵锋王座&room=兵者之心
输出：{ "ret":"0",
	"game":"兵锋王座",
	"room":"兵者之心",
	"value":"6.00"
	}
0	成功
1	code不存在
2	code与game\room对不上
3	code已使用
4	user不存在
5	其它错误
*/
error_reporting(0);
header('Content-type: text/json');

// Include ezSQL core
include_once "ez_sql_core.php";
include_once "ez_sql_mysql.php";


$act = $_GET['act'];
$pwd = $_GET['pwd'];
$value = $_GET['value'];
$amount = $_GET['amount'];
$game = $_GET['game'];
$room = $_GET['room'];
$generator = $_GET['generator'];

$code = $_GET['code'];
$user = $_GET['user'];

$result = "";


function genCode(){
    mt_srand((double)microtime()*10000);//optional for php 4.2.0 and up.
    $charid = substr(strtoupper(md5(uniqid(rand(), true))),rand(0,18),rand(9,12));
    return $charid;
}


// Initialise database object and establish a connection
// at the same time - db_user / db_password / db_name / db_host
$db = new ezSQL_mysql('root','root','lyb','127.0.0.1');


if($act="gencode"){
	if( $pwd !="shuntong@" )
	{
		$result["ret"] = "-1";
		$result["msg"] = "密码错误";
		echo json_encode($result);
		exit();
	}
	if( ''== $game) $game = "兵锋王座";
	if( '' == $room) $room = "兵者之心";

	$result["ret"] = "0";
	$result["game"] = $game;
	$result["room"] = $room;
	$result["value"] = $value;
	$codes = array();
	for($i=0;$i<$amount;$i++){
		$code = genCode();
		$var = $db->get_var("SELECT count(*) FROM goldcode where code='$code'");
		if( 0 == $var ){
			$codes[$i] = $code;
			$db->query("INSERT INTO goldcode (code,value,game,room) VALUES ('$code','$value','$game','$room')");
		}else
			$i--;
	}
	$result["codes"] = $codes;
}else if($act="usecode"){
	$row = $db->get_row("SELECT `code`,`value` FROM goldcode where "
		." `code`='$code' and `valid`=1 and `game`='$game' and `room`='$room'");
	if( null != $row ){
		$result["ret"] = "0";
		$result["game"] = $game;
		$result["room"] = $room;
		$result["value"] = $row["value"];
		
		$db->query("UPDATE goldcode set `user` ='$user',`usetime`='',`valid`=0 WHERE `code`='$code'");
	}else{
		$result['ret'] = "2";
		$result['msg'] = "兑换码不正确，或已使用";
	}
}else{
	
}

echo json_encode($result);
?>