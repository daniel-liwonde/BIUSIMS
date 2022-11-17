<?php
	//Start session
	//session_start();
	
	//Check whether the session variable SESS_MEMBER_ID is present or not
	if(!isset($_COOKIE['id']) || (trim($_COOKIE['id']) == '')) {
		header("location:../index.php");
		exit();
	}
        $session_id=$_COOKIE['id'];
?>