<?php 
//conectamos a la db
      $con = mysqli_connect("localhost","root","","phptube");
      
      if ($con == false) {
        echo "PROBLEMA CON LA CONEXION DE DB";
        die();
      }

function obtieneVideos(Type $var = null)
{
    $con = $GLOBALS['con'];
    $resultado=$con->query("SELECT * FROM `usuarios_y_videos` WHERE 1");
    $videos=$resultado->fetch_all(MYSQLI_ASSOC);
    // echo "<pre>";
    // print_r($videos);
    // die();
    return $videos;
          
}
function grabaVideo($archivo)
{
   $con = $GLOBALS['con'];
   $msg="";
   $target_dir="archivos/";
   $target_file= $target_dir . basename($archivo['archivo']['name']);
   $uploadOk=1;
   $videoFileType= strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
   
   //si esque ya hay archivo con ese nombre
   if (file_exists($target_file)) {
       $msg.= "EL VIDEO YA EXISTE <br>";
       $uploadOk=1;
   }
   //TAMANO MAXIMO DEL VIDEO
   if ($archivo['archivo']['size']>500000000) {
       $msg.="LO SIENTO EL ARCHIVO ES MUY GRANDE <br>";
       $uploadOk=0;
   }
   //FORMATOS AUTORIZADOS
   if ($videoFileType!= "mp4" ) {
       # code...
       $msg.="LO SIENTO SOLO MP4. <br>";
       $uploadOk=0;
   }
   //comparamos uploadok
   if ($uploadOk==0) {
       $msg .="LO SIENTO EL VIDEO NO PUDEO SUBIRSE. <br>";
   }else {
        if (move_uploaded_file($archivo['archivo']['tmp_name'], $target_file)) {
            $msg .= "EL VIDEO ".basename($archivo['archivo']['name']). " FUE SUBIDO.";
            $con->query("INSERT INTO `videos` (`url_videos`,`usuarioid_videos`) VALUES('".$target_file."','".$_SESSION['id_users']."') ");
        }else {
            $msg.="LO SIENTO HUBO UN ERROR EN LA GRABACION DE DISCO.";
        }
   }
   return $msg;

}
 function grabaImagen($archivo)
{
   $con = $GLOBALS['con'];
   $msg="";
   $target_dir="archivos/";
   $target_file= $target_dir . basename($archivo['archivo']['name']);
   $uploadOk=1;
   $imageFileType= strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
   
   //si esque ya hay archivo con ese nombre
   if (file_exists($target_file)) {
       $msg.= "LA IMAGEN YA EXISTE <br>";
       $uploadOk=1;
   }
   //TAMANO MAXIMO DE LA IMAGEN
   if ($archivo['archivo']['size']>500000) {
       $msg.="LO SIENTO EL ARCHIVO ES MUY GRANDE <br>";
       $uploadOk=0;
   }
   //FORMATOS AUTORIZADOS
   if ($imageFileType!= "jpg" && $imageFileType!= "png" && $imageFileType!= "jpeg" && $imageFileType!= "gif" ) {
       # code...
       $msg.="LO SIENTO SOLO JPG,PNG,GIF,JPEG <br>";
       $uploadOk=0;
   }
   //comparamos uploadok
   if ($uploadOk==0) {
       $msg .="LO SIENTO LA IMAGEN NO PUDEO SUBIRSE. <br>";
   }else {
        if (move_uploaded_file($archivo['archivo']['tmp_name'], $target_file)) {
            $msg .= "LA IMAGEN ".basename($archivo['archivo']['name']). " FUE SUBIDA.";
            $con->query("UPDATE `users` SET `imagen_users`='".$target_file."' WHERE `id_users`='".$_SESSION['id_users']."'  ");
        }else {
            $msg.="LO SIENTO HUBO UN ERROR EN LA GRABACION DE DISCO.";
        }
   }
   return $msg;

}
function obtenerImagenUsuario()
{
    
    $con = $GLOBALS['con'];
    $consulta= "SELECT `imagen_users` FROM `users` WHERE `id_users` = '".$_SESSION['id_users']."' ";
    $resultado= $con->query($consulta);
    $fila=$resultado->fetch_assoc();
    $ruta = $fila['imagen_users'];
    return $ruta;
}

function cambiarContrasena($password,$repite_password)
{
    $msg2="";
    $con = $GLOBALS['con'];
    if ($password != $repite_password) {
        $msg2 .= "LAS CLAVES NO SON IGUALES <br>";
    }else if(strlen($password)<8){
        $msg2 .= "LAS CLAVES DEBEN TENER MINIMO 8 CARACTERES. <br>";
    }else {
        $password=sha1($password);
        $con->query("UPDATE `users` SET `password_users`='".$password."' WHERE `id_users`='".$_SESSION['id_users']."'  ");
        $msg2.="LA CLAVE HA SIDO ACTUALIZADA CORRECTAMENTE"; 
    }
    return $msg2;
}




?>