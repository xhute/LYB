<?php
/*
����goldcode.php

���ܣ����ɶһ���
���룺act=gencode&pwd=123&value=100.0&amount=1&game=��������&room=����֮��&generator=xhute
�����{ "ret":"0",
	"game":"��������",
	"room":"����֮��",
	"value":"6.00",
	"codes":["asdfadsf","qerqwer"]
}
0	�ɹ�
1	���벻��ȷ
2	game/room������

���ܣ�ʹ�öһ���
���룺act=usecode&code=adfadsf&user=xhute&game=��������&room=����֮��
�����{ "ret":"0",
	"game":"��������",
	"room":"����֮��",
	"value":"6.00"
	}
0	�ɹ�
1	code������
2	code��game\room�Բ���
3	code��ʹ��
4	user������
5	��������
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
		$result["msg"] = "�������";
		echo json_encode($result);
		exit();
	}
	if( ''== $game) $game = "��������";
	if( '' == $room) $room = "����֮��";

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
		$result['msg'] = "�һ��벻��ȷ������ʹ��";
	}
}else{
	
}

echo json_encode($result);
?>