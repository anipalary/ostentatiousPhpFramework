<table class="outt">
	<tr>
		<td align=center>
			<?php require "header.php"; ?>
			<?php if($_GET["doc"]): ?><iframe src="<?=$this->docs."\\".$_GET["doc"].".html"?>" style="width: 99%; height: 1000px; background-color: white;"></iframe>
			<?php elseif($_GET["tvr"]): $this->render("productpage.php", "SELECT * FROM ".$this->t_c." WHERE id = ".$_GET["tvr"], 0); ?>
			<?php elseif($_GET["cat"] or $_GET["search"]): ?>
			<table>
				<tr>
					<td valign=top>
						<?php
						if($_GET["cat"]){
							$this->render("categhead.php", "SELECT * FROM ".$this->t_ca." WHERE id = ".$_GET["cat"]);
							$this->render("product.php", "SELECT * FROM ".$this->t_c." WHERE category = ".$_GET["cat"]);
						}
						if($_GET["search"]){
							$this->render("product.php", "SELECT * FROM ".$this->t_c." WHERE name LIKE '%".$_GET["search"]."%'");
						}
						?>
					</td>
					<?php if(!$_GET["cat"]): ?>
					<td valign=top>
						<h3>Категории:</h3>
						<?php
						$this->render("category.php", "SELECT * FROM ".$this->t_ca."");
						?>
					</td>
					<?php endif; ?>
				</tr>
			</table>
			<?php elseif($_GET["cart"]): ?>
			<table>
				<tr>
					<td valign=top>
					<?php 
					if($cart = $this->cart()){
					?><table><tr><td valign=top><input type="button" value="Очистить корзину" onclick="clearCart()"></td><td><?php
						$sum = 0;
						foreach($cart as $id){
							$this->render("cartprod.php", "SELECT * FROM catalog WHERE id = $id", 0);
							$sum += $sql->query("SELECT * FROM catalog WHERE id = $id")->fetch_assoc()["price"];
						}
						?>
						Итого: <?=$sum?> р.
						</td>
						</tr></table>
						<details>
						<summary>К оформлению</summary>
						<form>
							<input name="email" placeholder="email для связи"><br>
							<input name="name" placeholder="Имя получателя"><br>
							<input type="submit" value="К оплате">
						</form>
						</details>
						<?php
					}else{
						echo "Корзина пуста";
					}
					?>
					</td>
				</tr>
			</table>
			<?php else: ?>
			<table>
				<tr>
					<td valign=top>
					<h1 style="text-align: center;"><?php $this->render("categanim.php", "SELECT * FROM ".$this->t_ca.""); ?></h1>
					<?php $this->render("product.php", "SELECT * FROM ".$this->t_c." ORDER BY RAND() LIMIT 12"); ?>
					<br><br><a href="?tvr=6" class="half-hover"><img src="img/1080.png"></a><br><br>
					<?php $this->render("product.php", "SELECT * FROM ".$this->t_c." ORDER BY RAND() LIMIT 18"); ?>
					</td>
				</tr>
			</table>
			<?php endif; ?>
		</td>
	<tr>
</table>
<?php require __DIR__ . "/../action.php" ?>