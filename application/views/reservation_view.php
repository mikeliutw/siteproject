
<div class="starter-template ">
	
			<h2>Reservation <? echo $query2->name?></h2>
			<form id="normalform" action="<?php echo $currurl; ?>index.php/reservation/post" method="post">
				<label class="form-label required"> Poeple </label>
				<select name="people" >
					<?for ($i = 1; $i < 5; $i++) {?>
					<option value="<?=$i?>"><?=$i?></option>
					<?}?>
				</select>
				<label class="form-label"> Date: </label>
				<select name="date" >
				<?for ($i = 1125; $i <= 1130; $i++) {?>
  					<option value="<?=$i?>"><?=$i?></option>
				<?}?>
				</select>
				<label class="form-label"> Time: </label>
				<select name="time" >
				<?for ($i = 1100; $i <= 1430; $i += 30) {?>
					<option value="<?=$i?>"><?=$i?></option>
				<?}?>
				</select>
				<input type='hidden' name="id" value="<?php echo $id?>"/>
				<br>
				<input type="submit" class="btn btn-primary" value="Reservation" />
			</form>
	
</div>
