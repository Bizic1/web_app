<?php
require_once __DIR__ .'/../tabele/Korisnik.php';
require_once __DIR__ .'/../tabele/Uloga.php';
$korisnici = Korisnik::getAll();
$uloge = Uloga::getAll();
?>
<script>
	$(function(){
		$('.brisanje').on('click', function() {
			var id = $(this).attr('id').split('_')[1];
			var red = $(this).parent().parent();
			$.ajax({
				'url':'logika/obrisi_korisnika.php',
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
			var ime_prezime = red.find('td')[1].innerHTML;
			var username = red.find('td')[2].innerHTML;
			var email = red.find('td')[3].innerHTML;
			var uloga_id = red.find('td')[4].getAttribute('data-ulogaid');
			$('#ime_prezime').val(ime_prezime)
			$('#username').val(username)
			$('#email').val(email)
		    $('#korisnik_id').val(id)
		    $('#uloga_id').val(uloga_id)
			$('form').attr('action', 'logika/izmeni_korisnika.php')
        
		})
});
</script>
<h2>Uloge korisnika</h2>
<form action=logika/dodaj_korisnika.php method="post">
	<input type="text" name="ime_prezime" id="ime_prezime" placeholder="Unesite ime i prezime">
	<input type="text" name="username" id="username" placeholder="Unesite korisnicko ime">
	<input type="email" name="email" id="email" placeholder="Unesite email">		
	<input type="password" name="password" id="password" placeholder="Unesite lozinku">
	<select name="uloga_id" id="uloga_id">
	<?php foreach($uloge as $uloga):?>
		<option value="<?= $uloga->id ?>"><?= $uloga->naziv?></option>
	<?php endforeach ?>
    </select>
	<input type="hidden" name="korisnik_id" id="korisnik_id">
	<input type="submit" value="Snimi">
</form>
<table>
	<thead>
		<tr>
			<th>Id</th>
			<th>Ime i prezime</th>
			<th>Korisnicko ime</th>
			<th>Email</th>
			<th>Uloga</th>
		    <th>Izmeni</th>
			<th>Obrisi</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($korisnici as $korisnik): ?>
			<tr>
				<td><?= $korisnik->id ?></td>
				<td><?= $korisnik->ime_prezime ?></td>
				<td><?= $korisnik->username ?></td>
				<td><?= $korisnik->email ?></td>

				
				<?php if($korisnik->uloga_id !== null): ?>
					<td data-ulogaid="<?= $korisnik->getUloga()->id?>">
				<?= $korisnik->getUloga()->naziv ?>
					</td>
				<?php else: ?>
					<td><td?
			<?php endif ?>
				
		
				<td><button id="izmeni_<?= $korisnik->id ?>" class="izmena">Izmeni</button></td>
				<td><button id="obrisi_<?= $korisnik->id ?>" class="brisanje">Obrisi</button></td>

			</tr>
		<?php endforeach ?>
	</tbody>
</table>