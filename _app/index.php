<?php
session_start();
if (@$_SESSION['LogIn'] == true) {
    header("location:_home/web.php");
}else{
    require_once('_function/url.php');
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8" />
        <title><?=title();?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="<?=Fav('');?>">

        <!-- App css -->
        <link href="<?=Assets('');?>/css/bootstrap-material.min.css" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
        <link href="<?=Assets('');?>/css/app-material.min.css" rel="stylesheet" type="text/css" id="app-default-stylesheet" />

        <link href="<?=Assets('');?>/css/bootstrap-material-dark.min.css" rel="stylesheet" type="text/css" id="bs-dark-stylesheet" disabled />
        <link href="<?=Assets('');?>/css/app-material-dark.min.css" rel="stylesheet" type="text/css" id="app-dark-stylesheet"  disabled />

        <link href="<?=Assets('');?>/css/icons.min.css" rel="stylesheet" type="text/css" />
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
        <script src="<?=Assets('');?>/js/vendor.min.js"></script>
    </head>

    <body class="auth-fluid-pages pb-0">

        <div class="auth-fluid">
            <!--Auth fluid left content -->
            <div class="auth-fluid-form-box">
                <div class="align-items-center d-flex pt-5">
                    <div class="card-body">

                        <div class="auth-brand text-center text-lg-left">
                            <div class="auth-logo">
                                <a href="index.php" class="logo logo-dark text-left">
                                    <span class="logo-lg">
                                        <img src="<?=Image('');?>/logo-dark.png" alt="" height="50" width='200'>
                                    </span>

                                </a>
                                <p>PT POS INDONESIA CABANG PALEMBANG</p>
                            </div>
                        </div>
                        <hr>


                        <!-- title-->
                        <h4 class="mt-0">Log In SI Perhitungan Tarif</h4>
                        <p class="text-muted mb-4">Masukkan Kode Login dan Password Anda.</p>

                        <!-- form -->
                        <form id="Login" method="post">
                            <div class="form-group">
                                <label for="emailaddress">Kode Login</label>
                                <input class="form-control" type="text" id="emailaddress" name='emailaddress' required="" placeholder="Kode Login Anda">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" name="password" class="form-control" placeholder="Password Anda.">
                                    <div class="input-group-append" data-password="false">
                                        <div class="input-group-text">
                                            <span class="password-eye"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group mb-0 text-center">
                                <button class="btn btn-primary btn-block" type="submit">Log In </button>
                            </div>

                        </form>
                    </div>
                </div> 
            </div>
            <div class="auth-fluid-right text-center">
                <div class="auth-user-testimonial">
                    <h2 class="mb-3 text-white">Kode Login</h2>
                    <p class="lead"><i class="mdi mdi-format-quote-open"></i> Admin = POS-1234  password = akamsi123<i class="mdi mdi-format-quote-close"></i>
                    </p>
                    <p class="lead"><i class="mdi mdi-format-quote-open"></i> Loket = POS-123  password = 123456<i class="mdi mdi-format-quote-close"></i>
                    </p>
                    <p class="lead"><i class="mdi mdi-format-quote-open"></i> Keuangan = POS-222  password = 123456<i class="mdi mdi-format-quote-close"></i>
                    </p>
                    <p class="lead"><i class="mdi mdi-format-quote-open"></i> Pimpinan = POS-321  password = 123456<i class="mdi mdi-format-quote-close"></i>
                    </p>
                    <h5 class="text-white">
                        - Yolanda (Bina Dharma 2020 Akuntansi)
                    </h5>
                </div> 
            </div>
        </div>


        <script src="<?=Assets('');?>/js/app.min.js"></script>
        <script>
            $("#Login").on('submit',(function(e) {
                e.preventDefault();
                $.ajax({
                    url: '_home/_login.php',
                    type: "POST",
                    data:  new FormData(this),
                    contentType: false,
                    cache: false,
                    processData:false,
                    dataType: "JSON",
                    success: function (respone) {
                        if (respone.status == 'success') {
                            swal.fire({
                                title: respone.status,
                                text: respone.message,
                                icon: respone.status
                            }).then(function(){ 
                                window.location = "_home/web.php";
                            }
                            );
                        } else{
                            swal.fire({
                                title: respone.status,
                                text: respone.message,
                                icon: respone.status
                            }).then(function(){ 
                                location.reload(true);
                            }
                            );
                        }
                    }
                });
            }));



        </script>
    </body>
    </html>
    <?php }?>