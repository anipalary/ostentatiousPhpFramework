<?php

require "framework/framework.php";
$f = new framework([
	"mail_log" => "smtp.mail.ru;yashchik234@mail.ru;LigYTVmLzvpskZwasqKa;587;yashchik234@mail.ru",
	
	"sql_log" => ";;;", //your data
	
	"mailHost" => "",
	"mailLogin" => "",
	"mailPassword" => "",
	"mailPort" => "",
	"mailFrom" => "",
	
	"go" => "view/shop.php",
	"views_more" => ["views"],
	"head" => [
		'<link rel="stylesheet" href="view/style.css">',
		'<script src="js/jquery.js"></script>',
		'<script src="js/script.js"></script>'
		]
	]);

$f->shop();