<?
//import db.php
require('db.php');
mysql_select_db("facebookapi_project1");
//inserting question details
$ques_opt1 = "INSERT INTO question
			(QuesText, Option)
			VALUES
			('$question',
			'$op1')";
$ques_opt2 = "INSERT INTO question
			(QuesText, Option)
			VALUES
			('$question',
			'$op2')";
$ques_opt3 = "INSERT INTO question
			(QuesText, Option)
			VALUES
			('$question',
			'$op3')";

$result = mysql_query($ques_opt1);	//execute option1 insert
if($result){
	echo("<br>Option1 insert succeeded");
} else{
	echo("<br>Option1 insert failed");
}

$result = mysql_query($ques_opt2);	//execute option2 insert
if($result){
	echo("<br>Option2 insert succeeded");
} else{
	echo("<br>Option2 insert failed");
}

$result = mysql_query($ques_opt3);	//execute option3 insert
if($result){
	echo("<br>Option3 insert succeeded");
} else{
	echo("<br>Option3 insert failed");
}
?>
