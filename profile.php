<?php
session_start();
include("dbconnection.php");
include("checklogin.php");
check_login();
if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $aemail = $_POST['alt_email'];
    $mobile = $_POST['phone'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    // Nuevo campo para modificar el número de teléfono (mobile)
    $new_mobile = isset($_POST['new_mobile']) ? $_POST['new_mobile'] : '';

    // Si se proporciona un nuevo número, actualizarlo
    if (!empty($new_mobile)) {
        $mobile = $new_mobile;
    }

    $a = mysqli_query($con, "update user set name='$name',mobile='$mobile',gender='$gender',alt_email='$aemail',address='$address' where email='" . $_SESSION['login'] . "'");
    if ($a) {
        echo "<script>alert('Tu perfil ha sido actualizado correctamente');location.replace(document.referrer)</script>";
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="utf-8" />
    <title>CWEB Perfil de Usuario</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta content="" name="description" />
    <meta content="" name="author" />

    <link href="assets/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="assets/plugins/boostrapv3/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/boostrapv3/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/animate.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/jquery-scrollbar/jquery.scrollbar.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/style.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/custom-icon-set.css" rel="stylesheet" type="text/css" />
</head>

<body class="">
    <?php include("header.php"); ?>
    <div class="page-container row-fluid">
        <?php include("leftbar.php"); ?>
        <div class="clearfix"></div>
    </div>
    </div>
    <a href="#" class="scrollup">Scroll</a>
    <div class="footer-widget">
        <div class="progress transparent progress-small no-radius no-margin">
            <div data-percentage="79%" class="progress-bar progress-bar-success animate-progress-bar"></div>
        </div>
        <div class="pull-right">
        </div>
    </div>
    <div class="page-content">
        <div id="portlet-config" class="modal hide">
            <div class="modal-header">
                <button data-dismiss="modal" class="close" type="button"></button>
                <h3>Widget Settings</h3>
            </div>
            <div class="modal-body"> Widget settings form goes here </div>
        </div>
        <div class="clearfix"></div>
        <div class="content">
            <div class="page-title">
                <h3>Saludos, <?php echo $_SESSION['name']; ?></h3>
                <?php
                $query = mysqli_query($con, "select * from user where email='" . $_SESSION['login'] . "'");
                while ($row = mysqli_fetch_array($query)) {
                ?>

                    <div class="row">
                        <div class="col-md-12">

                            <form class="form-horizontal" method="post" enctype="multipart/form-data">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title"><strong>Mi Perfil</h3>
                                        <div align="right">
                                            Fecha de Registro: <?php echo $row['posting_date']; ?>
                                        </div>
                                    </div>

                                    <div class="panel-body bg-white">

                                        <div class="form-group">
                                            <label class="col-md-3 col-xs-12 control-label">Nombre </label>
                                            <div class="col-md-6 col-xs-12">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                    <input type="text" name="name" value="<?php echo $row['name']; ?>" class="form-control" />
                                                </div>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 col-xs-12 control-label">Correo Principal </label>
                                            <div class="col-md-6 col-xs-12">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                    <input type="text" name="email" value="<?php echo $row['email']; ?>" disabled="disabled" class="form-control" />
                                                </div>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 col-xs-12 control-label">Correo Alternativo </label>
                                            <div class="col-md-6 col-xs-12">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                    <input type="text" name="alt_email" value="<?php echo $row['alt_email']; ?>" class="form-control" />
                                                </div>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 col-xs-12 control-label"># Contacto </label>
                                            <div class="col-md-6 col-xs-12">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                    <input type="text" name="phone" value="<?php echo $row['mobile']; ?>" maxlength="10" class="form-control" />
                                                </div>


                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label class="col-md-3 col-xs-12 control-label">Género </label>
                                            <div class="col-md-6 col-xs-12">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                    <select class="form-control select" name="gender">
                                                        <option value="male" <?= $row['gender'] == 'male' ? "selected" : "" ?>>Male</option>
                                                        <option value="female" <?= $row['gender'] == 'female' ? "selected" : "" ?>>Female</option>
                                                    </select>
                                                    </select>
                                                </div>

                                            </div>
                                        </div>




                                        <div class="form-group">
                                            <label class="col-md-3 col-xs-12 control-label">Dirección</label>
                                            <div class="col-md-6 col-xs-12">
                                                <textarea class="form-control" name="address" rows="5"><?php echo $row['address']; ?></textarea>

                                            </div>
                                        </div>

                                        <!-- Nuevo apartado para modificar el número de teléfono -->
                                        <div class="form-group">
                                            <label class="col-md-3 col-xs-12 control-label">Modificar Número de Teléfono</label>
                                            <div class="col-md-6 col-xs-12">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><span class="fa fa-phone"></span></span>
                                                    <input type="text" name="new_mobile" maxlength="10" class="form-control" placeholder="Nuevo número de teléfono" />
                                                </div>
                                                <span class="help-block">Si deseas cambiar tu número de teléfono, ingrésalo aquí.</span>
                                            </div>
                                        </div>







                                    </div>
                                <?php } ?>
                                <div class="panel-footer">
                                    <button class="btn btn-default" type="reset">Resetear</button>
                                    <input type="submit" value="Actualizar" name="update" class="btn btn-primary pull-right">
                                </div>
                                </div>
                            </form>

                        </div>
                    </div>


            </div>
        </div>
    </div>

    </div>
    <script src="assets/plugins/jquery-1.8.3.min.js" type="text/javascript"></script>
    <script src="assets/plugins/jquery-ui/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="assets/plugins/breakpoints.js" type="text/javascript"></script>
    <script src="assets/plugins/jquery-unveil/jquery.unveil.min.js" type="text/javascript"></script>
    <script src="assets/plugins/jquery-block-ui/jqueryblockui.js" type="text/javascript"></script>
    <script src="assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js" type="text/javascript"></script>
    <script src="assets/plugins/pace/pace.min.js" type="text/javascript"></script>
    <script src="assets/plugins/jquery-numberAnimate/jquery.animateNumbers.js" type="text/javascript"></script>
    <script src="assets/js/core.js" type="text/javascript"></script>
    <script src="assets/js/chat.js" type="text/javascript"></script>
    <script src="assets/js/demo.js" type="text/javascript"></script>

</body>

</html>