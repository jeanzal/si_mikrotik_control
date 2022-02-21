<div class="container-fluid">
	<h5>Form Tambah User Staf</h5>
	<hr>
		<form class="form-horizontal" action="<?php echo base_url(). 'staf/add_user' ?>" method="post">
			<div class="form-group row">
				<label class="col-md-2 control-label">Server</label>
				<div class="col-md-4">
					<input class="form-control" type="text" name="server" value="hotspot1" id="server" placeholder="hotspot1" required readonly>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-md-2 control-label">Username</label>
				<div class="col-md-4">
					<input class="form-control" type="text" name="name" id="name" placeholder="Username.." required>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-md-2 control-label">Password</label>
				<div class="col-md-4">
					<input class="form-control" type="text" name="password" placeholder="Password.." required>
					<input class="form-control" type="hidden" name="disabled" value="yes">
				</div>
			</div>
			<div class="form-group row">
				<label class="col-md-2 control-label">Profile</label>
				<div class="col-md-4">
					<input class="form-control" type="text" name="profile" value="staf" id="profile" placeholder="Staf" required readonly>
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-8 float-right">
					<a class="btn btn-sm btn-dark" href="<?php echo base_url(). 'staf' ?>" ><i class="fas fa-undo"></i> Batal</a>
					<button type="submit" class="btn btn-sm btn-primary" ><i class="fas fa-plus"></i> Tambah</button>
				</div>
			</div>

			<div>&nbsp;</div>
		</form>
	<br>
</div>