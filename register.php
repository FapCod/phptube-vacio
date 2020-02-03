<?php 
$msg="";
$nombre="";
$email="";
$password="";
$repite_password="";

if ( isset($_POST['nombre']) && 
     isset($_POST['email']) && 
     isset($_POST['password']) && 
     isset($_POST['repite_password']) && 
     isset($_POST['de_acuerdo'])  
     ) {
   
  if ($_POST['nombre']=="") {
      $msg.="DEBE INGRESAR EL NOMBRE <br>";
      
    }
    if ($_POST['email']=="") {
      $msg.="DEBE INGRESAR EL EMAIL <br>";
    }
    if ($_POST['password']=="") {
      $msg.="DEBE INGRESAR EL PASSWORD <br>";
    }
    if ($_POST['repite_password']=="") {
      $msg.="DEBE REPETIR EL PASSWORD <br>";
    }
    $nombre=strip_tags($_POST['nombre']);
    $email=strip_tags($_POST['email']);
    $password=strip_tags($_POST['password']);
    $repite_password=strip_tags($_POST['repite_password']);

    if ($password != $repite_password) {
      $msg .= "LAS CLAVES NO COINCIDEN <br>";
    }else if(strlen($password)<8){
      $msg.= "LAS CLAVE DEBE TENER AL MENOS 8 CARACTERES <br>";
    }else {
      //conectamos a la db
      $con = mysqli_connect("localhost","root","","phptube");
      
      if ($con == false) {
        echo "PROBLEMA CON LA CONEXION DE DB";
        die();
      }
      $ip = $_SERVER['REMOTE_ADDR'];
      //revisamos si existe email en nuetra base de datos
      $resultado= $con->query("SELECT * FROM `users` WHERE `email_users`= '".$email."' ");
      $usuarios = $resultado->fetch_all(MYSQLI_ASSOC);
      //CUENTO CUANTOS HAY/FILAS
      $cantidad=count($usuarios);
      //ahora verificamos que sean cero la cantidad
      if ($cantidad==0 && strlen($msg)==0) {
        $password = sha1($password);
        $consulta="INSERT INTO `users` (`nombre_users`,`email_users`,`password_users`,`ip_users`) VALUES('".$nombre."','".$email."','".$password."','".$ip."')";
        $con -> query($consulta); 
        $msg.= "USUARIO CREADO CORRECTAMENTE";
        $nombre="";
        $email="";
        $password="";
        $repite_password="";
      }else{
        $msg.= "EL EMAIL YA EXISTE <br>";
      }
    }

}else {
  # code...
  // $msg="NO ENTRO AL IF";
 
}



?>



<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>PHPTUBE | REGISTRO</title>
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

<body class="hold-transition register-page">
    <div class="register-box">
        <div class="register-logo">
            <a href="register.php"><b>PHP</b>TUBE</a>
            <img width="70px" src="imagenes/seesmic.png" alt="">
        </div>

        <div class="register-box-body">
            <p class="login-box-msg">REGISTRARSE</p>

            <form action="register.php" method="POST">
                <div class="form-group has-feedback">
                    <input name="nombre" type="text" class="form-control" placeholder="Full name"
                        value="<?php echo $nombre; ?>" />
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input name="email" type="email" class="form-control" placeholder="Email"
                        value="<?php echo $email; ?>" />
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input name="password" type="password" class="form-control" placeholder="Password"
                        value="<?php echo $password; ?>" />
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input name="repite_password" type="password" class="form-control" placeholder="Retype password"
                        value="<?php echo $repite_password; ?>" />
                    <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                </div>
                <div class="row">
                    <div class="col-xs-8">
                        <div class="checkbox icheck">
                            <label>
                                <input name="de_acuerdo" type="checkbox" required /> Acepta <a href="#">terminos y
                                    condiciones</a>
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">
                            Registrar
                        </button>
                    </div>
                    <!-- /.col -->
                </div>
                <div style="color:red;">
                    <?php echo $msg; ?>
                </div>
            </form>



            <a href="login.php" class="text-center">ya tengo una cuenta</a>
        </div>
        <!-- /.form-box -->
    </div>
    <!-- /.register-box -->

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