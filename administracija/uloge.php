<?php
require_once __DIR__ .'/../tabele/Uloga.php';
$uloge = Uloga::getAll();
?>
<script>
	$(function(){
		$('.brisanje').on('click', function() {
			var id = $(this).attr('id').split('_')[1];
			var red = $(this).parent().parent();
			$.ajax({
				'url':'logika/obrisi.php',
				'method':'post',
				'data':{
					'id':id
				},
				'success': function(poruka){
					var p = JSON.parse(poruka);
					if(p.status === 'uspesno'){
						red.remove();
					} else {
						alert('Postoje korisnici za tu ulogu!');
					}
				}
			})
		});

		$('.izmena').on('click', function() {
			var id = $(this).attr('id').split('_')[1];
			var red = $(this).parent().parent();
			var naziv = red.find('td')[1].innerHTML;
			var prioritet = red.find('td')[2].innerHTML;
			$('#naziv').val(naziv)
			$('#prioritet').val(prioritet
		    $('#uloga_id').val(id)
			$('form').attr('action', 'logika/izmeni_ulogu.php')
        
		})
});
</script>
<h2>Uloge korisnika</h2>
<form action=logika/dodaj_ulogu.php method="post">
	<input type="text" name="naziv" id="naziv" placeholder="Unesite naziv uloge">	
	<input type="number" name="prioritet" id="prioritet" placeholder="Unesite prioritet">
	<input type="hidden" name="uloga_id" id="uloga_id">
	<input type="submit" value="Snimi">
</form>
<table>
	<thead>
		<tr>
			<th>Id</th>
			<th>Naziv</th>
			<th>Prioritet</th>
			<th>Izmeni</th>
			<th>Obrisi</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($uloge as $uloga): ?>
			<tr>
				<td><?= $uloga->id ?></td>
				<td><?= $uloga->naziv ?></td>
				<td><?= $uloga->prioritet ?></td>
				<td><button id="izmeni_<?= $uloga->id ?>" class="izmena">Izmeni</button></td>
				<td><button id="obrisi_<?= $uloga->id ?>" class="brisanje">Obrisi</button></td>

			</tr>
		<?php endforeach ?>
	</tbody>
</table>