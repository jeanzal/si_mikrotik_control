<div class="container-fluid">
	<p>User > <a href="<?= base_url('mahasiswa') ?>"> Mahasiswa</a> </p>
				<br>
			<a class="btn btn-sm btn-primary" href="<?php echo base_url(). 'mahasiswa/form_tambah_mhs' ?>" ><i class="fas fa-plus-circle"></i> Tambah</a>
			<br><br>
			<?php
				$flashmessage = $this->session->flashdata('message');
				echo ! empty($flashmessage) ? '<div class="alert alert-success alert-dismissible" role="alert">' . $flashmessage . '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>': '';
			?>
			<table class="table table-hover" width="100%">
				<thead class="thead-dark">
					<tr>
						<th class="text-center">No</th>
						<th class="text-center">Server</th>
						<th class="text-center">Username</th>
						<th class="text-center">Password</th>
						<th class="text-center">Profile</th>
						<th class="text-center">Mac Address</th>
						<th class="text-center" colspan="3">Action</th>
					</tr>
				</thead>
				<?php
					$no = 1;
					foreach ($user as $u) {
						if(isset($u['profile'])){
							if($u['profile'] == 'mahasiswa'){ ?>
					<tbody>
						<tr>
							<th scope="row"><?= $no++; ?></th>
							<?php 
								if(isset($u['server'] )){ ?>
									<td><?= $u['server'] ?></td>
								<?php }else{ ?>
									<td>&nbsp;</td>
							<?php }	?>
							<td><?= $u['name'] ?></td>
							<?php 
								if(isset($u['password'] )){ ?>
									<td><?= $u['password'] ?></td>
							<?php }else{ ?>
									<td>&nbsp;</td>
							<?php }	?>
							<?php 
								if(isset($u['profile'] )){ ?>
									<td><?= $u['profile'] ?></td>
							<?php }else{ ?>
									<td>&nbsp;</td>
							<?php }	?>
							<?php 
								if(isset($u['mac-address'] )){ ?>
									<td><?= $u['mac-address'] ?></td>
							<?php }else{ ?>
									<td>&nbsp;</td>
							<?php }	?>
							
								<?php 
									if($u['disabled'] == 'false' ){ ?>
										<td><a class="btn btn-sm btn-primary" href="<?php echo base_url().'mahasiswa/disabled_mhs/' . $u['.id'] ?>"><i class="fas fa-times"></i> Nonaktifkan</a></td>
								<?php }else{ ?>
										<td><a class="btn btn-sm btn-dark" href="<?php echo base_url().'mahasiswa/enabled_mhs/' . $u['.id'] ?>"><i class="fas fa-check"></i> Aktifkan</a></td>
								<?php }	?>
							<td><a class="btn btn-sm btn-warning" href="<?php echo base_url().'mahasiswa/form_edit_mhs/' . $u['name'] ?>"><i class="fas fa-edit"></i> Edit</a></td>
							<td><a class="btn btn-sm btn-danger" onclick="return confirm('Apakah yakin hapus data ?')" href="<?php echo base_url().'mahasiswa/delete_mhs/' . $u['name'] ?>"><i class="fas fa-trash"></i> Hapus</a></td>
							</td>
						</tr>
					</tbody>
				<?php }}} ?>
			</table><br>
		
	

</div>