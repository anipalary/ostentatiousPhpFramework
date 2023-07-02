<?php

class framework{
	
	public $views = "views";
	public $views_more = [];
	public $docs  = "documents";
	public $noimage = "framework/404.png";
	public $go = "views/shop.php";
	
	private $sql;
	
	public $host = "localhost";
	public $login = "root";
	public $password = "";
	public $db = "shop";
	
	public $sberlogin = "";
	public $sberpassword = "";
	
	public $mailHost = "";
	public $mailLogin = "";
	public $mailPassword = "";
	public $mailPort = "";
	public $mailFrom = "";
	
	
	public $t_c = "catalog";
	public $t_ca = "categorys";
	public $t_u = "users";
	public $t_o = "orders";
	public $t_p = "promotions";
	
	public $defhead = true;
	public $head = ["<link rel=\"stylesheet\" href=\"framework/style.css\"><script src=\"framework/script.js\"></script>"];
	
	function __construct($p = []){
		
		$this->views      = $p["views"]      ?? $this->views;
		$this->views_more = $p["views_more"] ?? $this->views_more;
		$this->docs       = $p["docs"]       ?? $this->docs;
		$this->noimage    = $p["noimage"]    ?? $this->noimage;
		$this->go         = $p["go"]         ?? $this->go;
		
		mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
		
		$this->host     = $p["sql_log"] ? explode(";", $p["sql_log"])[0] : ($p["host"]     ?? $this->host);
		$this->login    = $p["sql_log"] ? explode(";", $p["sql_log"])[1] : ($p["login"]    ?? $this->login);
		$this->password = $p["sql_log"] ? explode(";", $p["sql_log"])[2] : ($p["password"] ?? $this->password);
		$this->db       = $p["sql_log"] ? explode(";", $p["sql_log"])[3] : ($p["db"]       ?? $this->db);
		
		$this->sql = new mysqli($this->host, $this->login, $this->password, $this->db);
		$this->sql->set_charset('utf8mb4');
		
		$this->sberlogin    = $p["sberlogin"]    ?? $this->sberlogin;
		$this->sberpassword = $p["sberpassword"] ?? $this->sberpassword;
		
		$this->mailHost     = $p["mail_log"] ? explode(";", $p["mail_log"])[0] : ($p["mailHost"]     ?? $this->mailHost);
		$this->mailLogin    = $p["mail_log"] ? explode(";", $p["mail_log"])[1] : ($p["mailLogin"]    ?? $this->mailLogin);
		$this->mailPassword = $p["mail_log"] ? explode(";", $p["mail_log"])[2] : ($p["mailPassword"] ?? $this->mailPassword);
		$this->mailPort     = $p["mail_log"] ? explode(";", $p["mail_log"])[3] : ($p["mailPort"]     ?? $this->mailPort);
		$this->mailFrom     = $p["mail_log"] ? explode(";", $p["mail_log"])[4] : ($p["mailFrom"]     ?? $this->mailFrom);
		
		$this->t_c  = $p["t_c"]  ?? ($p["catalog"]      ?? $this->t_c);
		$this->t_ca = $p["t_ca"] ?? ($p["categorys"]    ?? $this->t_ca);
		$this->t_u  = $p["t_u"]  ?? ($p["users"]        ?? $this->t_u);
		$this->t_o  = $p["t_o"]  ?? ($p["orders"]       ?? $this->t_o);
		$this->t_p  = $p["t_p"]  ?? ($p["promotions"]   ?? $this->t_p);
		
		if($p["head"])if(gettype($p["head"])=="array")$this->head=array_merge($this->head, $p["head"]);else $this->head[1]=$p["head"];
	}
	
	public function shop(){
		$sql = $this->sql;
		$this->head();
		require $this->go;
	}
	
	private function head(){
		echo "<head>";
		if(!$this->defhead) array_shift($this->head);
		foreach($this->head as $val) echo $val;
		echo "</head>";
	}
	
	public function render($view, $query, $n = -1){
		$dir = "";
		
		foreach($this->views_more as $value)
			if(is_file($value.'/'.$view))
				$dir = $value;
		
		if($dir == "")
			$dir = $this->views;
		
		$view = $dir.'/'.$view;
		
		$result = $this->sql->query($query);
		
		if($n == -1){
			while($row = $result->fetch_assoc()){
				extract($row);
				require $view;
			}
		}else{
			for($i = 0; $i < $n; $i++) $result->fetch_assoc();
			extract($result->fetch_assoc());
			require $view;
		}
	}
	
	public function cart(){
		if($cart = $_COOKIE["cart"]){
			$cart = explode("-", $cart);
			$cart = array_filter($cart, function($element) {
				return $element !== "" and $element !== "undefined";
			});
			if(count($cart))
				return $cart;
			else
				return false;
		}else{
			return false;
		}
	}
	
	private function sber($id, $price){
		$vars = array();
		
		$vars['userName'] = $this->sberlogin;
		$vars['password'] = $this->sberpassword;
		
		$vars['orderNumber'] = $id;
		
		$vars['amount'] = $price * 100;
		
		$vars['returnUrl'] = "?pay=$id";
		
		$vars['failUrl'] = '?pay=0';
		
		$vars['description'] = 'Заказ №' . $id;
		
		$ch = curl_init('https://3dsec.sberbank.ru/payment/rest/register.do?' . http_build_query($vars));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_HEADER, false);
		$res = curl_exec($ch);
		curl_close($ch);

		$res = json_decode($res, JSON_OBJECT_AS_ARRAY);

		if (empty($res['orderId'])){
			$this->email($_GET["email"], "Заказ №".$id, "Изменение статуса заказа: oплатить заказ неудалось");
			echo "<script>alert('Оплата не прошла. Ошибка: ".$res['errorMessage']."')</script>";
			echo '<script>document.location.href = "?"</script>';
		} else {
			$this->email($_GET["email"], "Заказ №".$id, "Изменение статуса заказа: заказ оформлен, но не оплачен");
			echo '<script>clearCart();document.location.href = "' . $res['formUrl'] . '"</script>';
		}
	}
	
	private function email($to, $sub, $message){
		require_once "phpmailer/PHPMailerAutoload.php";
		
		$mail = new PHPMailer;
		
		$mail->CharSet = 'utf-8';
		$mail->SMTPDebug = 0;
		
		$mail->isSMTP();
		$mail->Host = $this->mailHost;
		$mail->SMTPAuth = true;
		$mail->Username = $this->mailLogin;                         
		$mail->Password = $this->mailPassword;                  
		$mail->SMTPSecure = 'tls';
		$mail->Port = $this->mailPort;
		
		$mail->setFrom($this->mailFrom);
		$mail->addAddress($to);
		
		$mail->isHTML(false);
		
		$mail->Subject = $sub;
		$mail->Body    = $message;
		
		if(!$mail->send()) {
			echo 'Message could not be sent.';
			echo 'Mailer Error: ' . $mail->ErrorInfo;
		}
	}
}


