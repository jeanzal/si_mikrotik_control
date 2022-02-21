<div class="container-fluid">
	<p>User > <a href="<?= base_url('daftar_user') ?>">Daftar User Aktif</a> </p>
	<?php
		$flashmessage = $this->session->flashdata('message');
		echo ! empty($flashmessage) ? '<div class="alert alert-success alert-dismissible" role="alert">' . $flashmessage . '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>': '';
	?>
	<table class="table table-hover" width="100%">
		<thead class="thead-dark">
			<tr>
				<th class="text-center">#</th>
				<th class="text-center">Address</th>
				<th class="text-center">User</th>
				<th class="text-center">MAC Address</th>
				<th class="text-center">Rx Rate / Tx Rate</th>
				<th class="text-center">Action</th>
			</tr>
		</thead>
		<?php
			$no = 1;
			foreach ($daftar as $d) { 
		?>

			<tbody>
				<tr>
					<th scope="row"><?= $no++; ?></th>
					<td><?= $d['address'] ?></td>	
					<td><?= $d['user'] ?></td>	
					<td><?= $d['mac-address'] ?></td>
					<td class="text-center"><?= $d['bytes-in'] ?> / <?= $d['bytes-out'] ?></td>
					<td class="text-center"><a href="<?php echo base_url(). 'daftar_user/hapus_user/'.$d['.id'] ?>" class="btn btn-sm btn-danger"><li class="fas fa-trash"></li> Remove</a></td>
				</tr>
			</tbody>
		
		<?php } ?>
	</table>

</div>