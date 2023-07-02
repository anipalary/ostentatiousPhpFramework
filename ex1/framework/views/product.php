<a href='?tvr=<?=$id?>'>
	<div class=tvr>
		<table class="tvr-img">
			<tr>
				<td align=center valign=center>
					<img src='<?=file_exists($img) ? $img : $this->noimage?>'>
				</td>
			</tr>
		</table>
		<?=$price?>₽
		<hr>
		<table class="tvr-name">
			<tr>
				<td align=center valign=center>
					<?=$name?>
				</td>
			</tr>
		</table>
	</div>
</a>