<?php

require "framework/framework.php";
$f = new framework([
	"noimage" => "img/noimage.jpg", 
	"sql_log" => ";;;", //your data
	"mail_log" => "smtp.mail.ru;yashchik234@mail.ru;LigYTVmLzvpskZwasqKa;587;yashchik234@mail.ru"
	]);

$f->shop();