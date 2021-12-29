<?php
require_once __DIR__ .'/../tabele/Meni.php';
$meni = Meni::getAll();
?>
<script>
	$(function(){
		$('.brisanje').on('click', function() {
			var id = $(this).attr('id').split('_')[1];
			var red = $(this).parent().parent();
			$.ajax({
				'url':'logika/obrisi_meni.php',
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
			var natpis = red.find('td')[1].innerHTML;
			var slug = red.find('td')[2].innerHTML;
			var url = red.find('td')[3].innerHTML;
			$('#natpis').val(natpis)
			$('#slug').val(slug)
			$('#url').val(url)
		    $('#meni_id').val(id)
			$('form').attr('action', 'logika/izmeni_meni.php');
        
		})
});
</script>
<h2>Meni</h2>
<form action=logika/dodaj_meni.php method="post">
	<input type="text" name="natpis" id="natpis" placeholder="Unesite natpis">
	<input type="text" name="slug" id="slug" placeholder="Unesite slug">	
	<input type="text" name="url" id="url" placeholder="Unesite url">	
	<input type="hidden" name="meni_id" id="meni_id">
	<input type="submit" value="Snimi">
</form>
<table>
	<thead>
		<tr>
			<th>Id</th>
			<th>Natpis</th>
			<th>Slug</th>
			<th>URL</th>
			<th>Izmeni</th>
			<th>Obrisi</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($meni as $m): ?>
			<tr>
				<td><?= $m->id ?></td>
				<td><?= $m->natpis ?></td>
				<td><?= $m->slug ?></td>
				<td><?= $m->url ?></td>
				<td><button id="izmeni_<?= $m->id ?>" class="izmena">Izmeni</button></td>
				<td><button id="obrisi_<?= $m->id ?>" class="brisanje">Obrisi</button></td>

			</tr>
		<?php endforeach ?>
	</tbody>
</table>