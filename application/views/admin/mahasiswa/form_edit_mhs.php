<div class="container-fluid">
	<h5>Form Edit User Mahasiswa</h5>
	<hr>
		<form class="form-horizontal" action="<?php echo base_url(). 'mahasiswa/update_mhs' ?>" method="post">
			<?php foreach($edit as $e){ 
			?>
			<div class="form-group row">
				<label class="col-md-2 control-label">Server</label>
				<div class="col-md-4">
					<input class="form-control" type="text" name="server" value="hotspot1" id="server" placeholder="hotspot1" required readonly>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-md-2 control-label">Username</label>
				<div class="col-md-4">
					<input class="form-control" type="hidden" name="id_mysql" id="id_mysql" value="<?= $e['name'] ?>">
					<input class="form-control" type="text" name="name" id="name" value="<?= $e['name'] ?>" placeholder="Username.." required>
					<input class="form-control" type="hidden" name="id" id="id" value="<?= $e['.id'] ?>">
				</div>
			</div>
			<div class="form-group row">
				<label class="col-md-2 control-label">Password</label>
				<div class="col-md-4">
					<input class="form-control" type="text" name="password" value="<?= $e['password'] ?>" placeholder="Password.." required>
					<input class="form-control" type="hidden" name="disabled" value="yes">
				</div>
			</div>
			<div class="form-group row">
				<label class="col-md-2 control-label">Profile</label>
				<div class="col-md-4">
					<input class="form-control" type="text" name="profile" value="mahasiswa" id="profile" placeholder="Mahasiswa" required readonly>
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-8 float-right">
					<a class="btn btn-sm btn-dark" href="<?php echo base_url(). 'mahasiswa' ?>" ><i class="fas fa-undo"></i> Batal</a>
					<button type="submit" class="btn btn-sm btn-warning" ><i class="fas fa-edit"></i> Edit</button>
				</div>
			</div>
		<?php } ?>
			<div>&nbsp;</div>
		</form>
	<br>
</div>