<?php 
session_start();
$_SESSION['autorizado']=false;

$msg="";
$email="";
if (isset($_POST['email']) && isset($_POST['password'])) {

    if ($_POST['email']=="") {
        $msg .= "DEBE INGRESAR UN EMAIL <br>";
    }else if ($_POST['password']=="") {
        $msg .= "DEBE INGRESAR UNA CONTRASENA <br>";
    }else {
        $email =strip_tags($_POST['email']);
        $password =sha1(strip_tags($_POST['password']));
        $con = mysqli_connect("localhost","root","","phptube");
        if ($con==false) {
            echo "HUBO UN ERROR EN LA CONEXION DE DB";
            die();
        }
        $resultado= $con->query("SELECT * FROM `users` WHERE `email_users`='".$email."' AND `password_users`='".$password."' ");
        $usuarios = $resultado->fetch_all(MYSQLI_ASSOC);
        $_SESSION['id_users']=$usuarios[0]['id_users'];
        $_SESSION['nombre_users']=$usuarios[0]['nombre_users'];
        $_SESSION['email_users']=$usuarios[0]['email_users'];
        $_SESSION['ultimo_login_users']=$usuarios[0]['ultimo_login_users'];
        
        
        //cuenta cuantos elemntos hay
        $cantidad=count($usuarios);
        if ($cantidad==1) {
            $hoy = date("Y-m-d H:i:s");
            $consulta="UPDATE `users` SET `ultimo_login_users`= '".$hoy."' WHERE `email_users`='".$email."'  ";
            $resultado= $con->query($consulta);
            $msg .="EXITO";
            $_SESSION['autorizado']=true;
            echo " <meta http-equiv='refresh' content='0; url=index.php'>";
        }else {
            
            $msg .= "ACCESO DENEGADO";
            $_SESSION['autorizado']=false;
        }

    }

}



?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>AdminLTE 2 | Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport" />
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css" />
    <!-- Ionicons -->
    <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css" />
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css" />
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/iCheck/square/blue.css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic" />
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="login.php"><b>PHP</b>TUBE</a>
            <img width="70px" src="imagenes/seesmic.png" alt="">
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg">Iniciar session</p>

            <form action="login.php" method="post">
                <div class="form-group has-feedback">
                    <input name="email" type="email" class="form-control" placeholder="Email" />
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input name="password" type="password" class="form-control" placeholder="Password" />
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">
                    <div class="col-xs-8">
                        <div class="checkbox icheck">

                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">
                            Ingresar
                        </button>
                    </div>
                    <!-- /.col -->
                </div>
                <div style="color:red;">
                    <?php echo $msg; ?>
                </div>
            </form>


            <!-- /.social-auth-links -->

            <a href="#">Olvide mi contrasena</a><br />
            <a href="register.php" class="text-center">Registrarme</a>
        </div>
        <!-- /.login-box-body -->
    </div>
    <!-- /.login-box -->

    <!-- jQuery 3 -->
    <script src="bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="plugins/iCheck/icheck.min.js"></script>
    <script>
    $(function() {
        $("input").iCheck({
            checkboxClass: "icheckbox_square-blue",
            radioClass: "iradio_square-blue",
            increaseArea: "20%" /* optional */
        });
    });
    </script>
</body>

</html>