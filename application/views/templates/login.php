    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-lg-7">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">SELAMAT DATANG</h1>
                                        <b>Sistem Informasi Mikrotik Admin Panel</b><br><br>
                                    </div>
                                    <?php
                                        if($this->routerosapi->connect('172.16.10.1', 'admin', 'jean')){
                                            ?>
                                            <div class='btn btn-success btn-user btn-block'>Terkoneksi dengan Mikrotik</div><br>
                                            <?= $this->session->flashdata('pesan'); ?>
                                            <form class="user" action="<?= base_url('auth') ?>" method="post">
                                                <div class="form-group">
                                                    <input type="text" class="form-control form-control-user" name="hostname" placeholder="Hostname : 192.168.....">
                                                    <?= form_error('hostname', '<small class="text-danger pl-3">', '</small>'); ?>
                                                </div>
                                                <div class="form-group">
                                                    <input type="username" class="form-control form-control-user" name="username" placeholder="Username ...">
                                                    <?= form_error('username', '<small class="text-danger pl-3">', '</small>'); ?>
                                                </div>
                                                <div class="form-group">
                                                    <input type="password" class="form-control form-control-user" name="password" placeholder="Password ...">
                                                </div>
                                                <input type="submit" class="btn btn-success btn-user btn-block" value="Login">
                                                <hr>
                                            </form>
                                            <?php
                                        }else{
                                            echo "<div class='btn btn-danger btn-user btn-block'>Tidak terkoneksi dengan Mikrotik</div><br>";
                                        }
                                    ?>
                                    
                                    
                                    <!-- <div class="text-center"> -->
                                        <!-- <a class="small" href="register.html">Create an Account!</a> -->
                                    <!-- </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

