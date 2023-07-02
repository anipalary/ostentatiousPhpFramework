<table style="margin: auto;">
	<tr>
		<td><img src='<?=file_exists($img) ? $img : $this->noimage?>' width=400 height=400></td>
		<td><h1><?=$name?></h1><?=$price?> рублей
		<input type="button" value="Добавить в корзину" onclick="addToCart('<?=$id?>')"></td>
	</tr>
</table>