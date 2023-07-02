<?php

if($_GET["email"] and $_GET["name"]){
	if($cart = $this->cart()){
		$sum = 0;
			foreach($cart as $id)
				$sum += $sql->query("SELECT * FROM catalog WHERE id = $id")->fetch_assoc()["price"];
		$sql->query("INSERT INTO orders(prod, status, email) VALUES ('".$_COOKIE["cart"]."', 0, '".$_GET["email"]."', getdate())");
		$id = $sql->insert_id; 
		$this->sber($id, $sum);
	}
}
if($_GET["pay"]){
	$sql->query("UPDATE orders SET status = 1 WHERE id = ".$_GET["pay"]);
	$sql->query("");
	
	$this->email($_GET["email"], "Заказ №".$id, "Изменение статуса заказа: заказ оформлен, но не оплачен");
}