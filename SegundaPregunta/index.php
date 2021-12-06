<html>
<link href="estilosIndex.css" rel="stylesheet">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Iniciar Sesión</title>
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<body style="background-color:#222D32">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-2"></div>
            <div class="col-lg-6 col-md-8 login-box">
                <div class="col-lg-12 login-key">
                    <i class="fa fa-key" aria-hidden="true"></i>
                </div>
                <div class="col-lg-12 login-title">
                    INICIAR SESIÓN<br> CANDIDATO REGISTRADO<br>ADMINISTRACIÓN
                </div>

                <div class="col-lg-12 login-form">
                    <div class="col-lg-12 login-form">
                        <form action="controlIndex.php" method="$_GET">
                            <div class="form-group">
                                <label class="form-control-label">Usuario</label>
                                <input type="text" name="usuario" class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">Contraseña</label>
                                <input type="password" name="contrasenia" class="form-control" i>
                            </div>

                            <div class="col-lg-12 loginbttm">
                                <div class="col-lg-6 login-btm login-text">
                                    <!-- Mensaje de error -->
                                </div>
                                <div class="col-lg-6 login-btm login-button">
                                    <button type="submit" class="btn btn-outline-primary">INGRESAR</button>
                                    <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#myModal">REGISTRAR</button>
                                </div>

                                <!-- Modal de Registro -->
                                <div class="modal fade" id="myModal">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content" style="background-color: #222D32">

                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title">
                                                    <div class="col-lg-12 login-title">
                                                        REGISTRAR USUARIO
                                                    </div>
                                                </h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>

                                            <!-- Modal body -->
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-lg-3 col-md-3"></div>
                                                    <div class="col-lg-6 col-md-8 login-box">
                                                        <div class="col-lg-12 login-form">
                                                            <form action="controlIndex.php" method="$_GET">
                                                                <div class="form-group">
                                                                    <label class="form-control-label">Usuario</label>
                                                                    <input name="usuario_reg" type="text" class="form-control">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="form-control-label">Contraseña</label>
                                                                    <input name="contrasenia_reg" type="password" class="form-control" i>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="form-control-label">Confirma Contraseña</label>
                                                                    <input type="password" class="form-control" i>
                                                                </div>

                                                                <div class="col-lg-12 loginbttm">
                                                                    <div class="col-lg-6 login-btm login-text">
                                                                        <!-- Error Message -->
                                                                    </div>
                                                                    <div class="col-lg-6 login-btm login-button">
                                                                        <button type="submit" class="btn btn-outline-primary">REGISTRAR</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Modal footer -->
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-3 col-md-2"></div>
            </div>
        </div>
</body>

</html>