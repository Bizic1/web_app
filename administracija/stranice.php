<?php
require_once __DIR__ .'/../tabele/Stranica.php';
require_once __DIR__ .'/../tabele/Meni.php';
$stranice = Stranica::getAll();
$meni = Meni::getAll();
?>
<script>
	$(function(){
		$('.brisanje').on('click', function() {
			var id = $(this).attr('id').split('_')[1];
			var red = $(this).parent().parent();
			$.ajax({
				'url':'logika/obrisi_stranicu.php',
				'method':'post',
				'data':{
					'id':id
				},
				'success': function(poruka){
					var p = JSON.parse(poruka);
					if(p.status === 'uspesno'){
						red.remove();
					} else {
						alert('Doslo je do greske!');
					}
				}
			})
		});

		$('.izmena').on('click', function() {
			var id = $(this).attr('id').split('_')[1];
			var red = $(this).parent().parent();
			var naslov = red.find('td')[2].innerHTML;
			var kratki_sadrzaj = red.find('td')[3].innerHTML;
			var sadrzaj = red.find('td')[4].innerHTML;
			var meni_id = red.find('td')[1].getAttribute('data-meniid');
			$('#naslov').val(naslov)
			$('#kratki_sadrzaj').val(kratki_sadrzaj)
			$('#sadrzaj').val(sadrzaj)
			$('#meni_id').val(meni_id)
			$('#stranica_id').val(id)
			$('form').attr('action', 'logika/izmeni_stranicu.php')

		})
	});
</script>
<h2>Stranice</h2>
<form action=logika/dodaj_stranicu.php method="post" enctype="multipart/form-data">
	<input type="text" name="naslov" id="naslov" placeholder="Unesite naslov"><br>
	<input type="text" name="kratki_sadrzaj" id="kratki_sadrzaj" placeholder="Unesite kratki sadrzaj"><br>
	<textarea name="sadrzaj" id="sadrzaj" placeholder="Unesite sadrzaj"></textarea>	<br>
	<input type="file" name="slika" id="slika"><br>
	<select name="meni_id" id="meni_id">
		<?php foreach($meni as $m):?>
			<option value="<?= $m->id ?>"><?= $m->natpis?></option>
		<?php endforeach ?>
	</select><br>
	<input type="hidden" name="stranica_id" id="stranica_id">
	<input type="submit" value="Snimi">
</form>
<table>
	<thead>
		<tr>
			<th>Id</th>
			<th>Meni</th>
			<th>Naslov</th>
			<th>Kratak sadrzaj</th>
			<th>Sadrzaj</th>
			<th>Slika</th>
			<th>Izmeni</th>
			<th>Obrisi</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($stranice as $stranica): ?>
			<tr>
				<td><?= $stranica->id ?></td>
				<?php if($stranica->meni_id !== null): ?>
					<td data-meniid="<?=$stranica->getMeni()->id?>"><?= $stranica->getMeni()->natpis ?></td>
					<?php else: ?>
						<td></td>
					<?php endif ?>
					<td><?= $stranica->naslov ?></td>
					<td><?= $stranica->kratki_sadrzaj ?></td>

					<td class="sadrzaj"><?= $stranica->sadrzaj ?></td>
					<?php if(!empty($stranica->slika) && $stranica->slika !==null): ?>
						<td><img src="<?= $stranica->slika?>" alt="<?= $stranica->naslov?>">
						<?php else: ?>
						<td></td>
						<?php endif ?>
					</td>
					<td><button id="izmeni_<?= $stranica->id ?>" class="izmena">Izmeni</button></td>
					<td><button id="obrisi_<?= $stranica->id ?>" class="brisanje">Obrisi</button></td>

				</tr>
			<?php endforeach ?>
		</tbody>
	</table>