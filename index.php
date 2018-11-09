<?php 
	session_start();

	require('display.php'); 
	require('req_sql.php'); 

	display();

	if(isset($_POST['rpseudo']))
	{
		register();
	} 
		if(isset($_POST['lpseudo']))
	{
		login();
	} 
		if(isset($_POST['message']))
	{
		post();
	} 
	    if (isset($_GET['quit']))
    {
		quit();
    }