<?php

require_once("db.php");




if (isset($_POST['accion'])) {
    switch ($_POST['accion']) {
            //casos de registros

        case 'acceso_user':
            acceso_user();
            break;

        case 'cambiar_clave':
            cambiar_clave();
            break;

        case 'insert_doctor':
            insert_doctor();
            break;

        case 'insert_cita':
            insert_cita();
            break;

        case 'insert_esp':
            insert_esp();
            break;

        case 'insert_horario':
            insert_horario();
            break;

        case 'insert_paciente':
            insert_paciente();
            break;

        case 'editar_user':
            editar_user();
            break;

        case 'editar_paciente':
            editar_paciente();
            break;

        case 'editar_esp':
            editar_esp();
            break;

        case 'editar_doctor':
            editar_doctor();
            break;


        case 'editar_hora':
            editar_hora();
            break;

        case 'editar_cita':
            editar_cita();
            break;

        case 'editar_micita':
            editar_micita();
            break;

        case 'editar_diagnostico':
            editar_diagnostico();
            break;
        case 'editar_midiagnostico':
            editar_midiagnostico();
            break;
    }
}


function acceso_user()
{
    include("db.php");
    extract($_POST);

    $nombre = $conexion->real_escape_string($_POST['nombre']);
    $password = $conexion->real_escape_string($_POST['password']);
    session_start();
    $_SESSION['nombre'] = $nombre;


    $consulta = "SELECT * FROM user where nombre='$nombre' and password='$password'";
    $resultado = mysqli_query($conexion, $consulta);
    $filas = mysqli_fetch_array($resultado);

    
  
        if(isset($filas['rol'])){ //enfermero
            $_SESSION['rol'] = $filas['rol'];
            $_SESSION['id'] = $filas['id'];

            if ($filas['rol']==3) {
                header('Location: ../views/index2.php');
            } else {
                header('Location: ../views/index.php');
            }

            

        } else {  

           echo "<script language='JavaScript'>
            alert('Usuario o Contraseña Incorrecta');
            location.assign('./_sesion/login.php');
            </script>"; 
            session_destroy();
        }

    
}

function cambiar_clave()
{
    include("db.php");
    extract($_POST);

    $clave1 = $conexion->real_escape_string($_POST['clave1']);
    $clave2 = $conexion->real_escape_string($_POST['clave2']);

    if($clave1===$clave2){
          $consulta = "UPDATE user SET  password='$clave1'  WHERE id = '$id'";
            $resultado = mysqli_query($conexion, $consulta);

            echo "<script language='JavaScript'>
        alert('la clave se cambio correctamente');
        location.assign('/');
        </script>";
    } else {
        echo "<script language='JavaScript'>
        alert('la clave no se cambio !!');
        location.assign('/');
        </script>";
    }

}

function insert_esp()
{
    include "db.php";
    extract($_POST);

    $consulta = "INSERT INTO especialidades (nombreespecialidad) VALUES ('$nombre')";
    $resultado = mysqli_query($conexion, $consulta);

    if ($resultado) {
        echo "<script language='JavaScript'>
        location.assign('../views/especialidades.php');
        </script>";
    } else {
        echo "<script language='JavaScript'>
         alert('Uy no! ya valio hablale al ing :v');
         location.assign('../views/especialidades.php');
         </script>";
    }
}

function insert_horario()
{
    include "db.php";
    extract($_POST);

    $consulta = "INSERT INTO horario (dias, id_doctor) VALUES ('$dias', '$id_doctor')";
    $resultado = mysqli_query($conexion, $consulta);

    if ($resultado) {
        echo "<script language='JavaScript'>
        location.assign('../views/horarios.php');
        </script>";
    } else {
        echo "<script language='JavaScript'>
         alert('Uy no! ya valio hablale al ing :v');
         location.assign('../views/horarios.php');
         </script>";
    }
}

function insert_paciente()
{
    include "db.php";
    extract($_POST);

    $consulta = "INSERT INTO pacientes (nombre, dni, sexo, correo, telefono, fechanacpac, estado, tiposangre, preexistencias, direccion, contacto, telfcontacto)
    VALUES ('$nombre', '$dni', '$sexo', '$correo', '$telefono','$fechanacpac', '$estado', '$tiposangre', '$preexistencias','$direccion','$nombrecontacto','$telfcontacto')";
    $resultado = mysqli_query($conexion, $consulta);

    if ($resultado) {
        echo "<script language='JavaScript'>
        location.assign('../views/pacientes.php');
        </script>";
    } else {
        echo "<script language='JavaScript'>
         alert('Uy no! ya valio hablale al ing :v');
         location.assign('../views/pacientes.php');
         </script>";
    }
}

function insert_cita()
{
    include "db.php";
    extract($_POST);

    $sql = "SELECT id_especialidad FROM doctor where iddoctor='$id_doctor' ";
    $resultado = mysqli_query($conexion, $sql);
    $especialidad = mysqli_fetch_array($resultado);
    $idespecialidad=$especialidad['id_especialidad'];

    $consulta = "INSERT INTO citas (fechacita, hora, id_paciente, id_doctor , id_especialidad, observacion, estadocita) VALUES ('$fecha', '$hora', '$id_paciente', '$id_doctor', '$idespecialidad', '$observacion', '$estado')";
    $resultado = mysqli_query($conexion, $consulta);
    $idcita=mysqli_insert_id($conexion);

     $consulta2 = "INSERT INTO diagnostico (resultadodiagnostico, recetadiagnostico, archivodiagnostico, idcita ) VALUES ('', '', '', '$idcita')";
    $resultado2 = mysqli_query($conexion, $consulta2);

if ($resultado) {
        echo "  <script language='JavaScript'>
         location.assign('../views/citas.php');
         </script>";
    } else {
        echo "<script language='JavaScript'>
         alert('Uy no! ya valio hablale al ing :v');
         location.assign('../views/citas.php');
         </script>";
    }
   
}

function insert_doctor()
{
    include "db.php";
    extract($_POST);
    $consulta = "INSERT INTO doctor (cedula, nombresdoc, id_especialidad, sexodoc,  telefonodoc, fechanacdoc, correodoc)
    VALUES ('$cedula', '$nombres', '$id_especialidad','$sexo', '$telefono',  '$fecha', '$correo')";
    $resultado = mysqli_query($conexion, $consulta);

    $hoy = date('Y-m-d');

    $consulta2 = "INSERT INTO user (nombre, correo, password, fecha, rol)
    VALUES ('$cedula', '$correo', '$cedula', '$hoy', '3' )";
    $resultado = mysqli_query($conexion, $consulta2);

    if ($resultado) {
        echo "<script language='JavaScript'>
        location.assign('../views/medicos.php');
        </script>";
    } else {
        echo "<script language='JavaScript'>
         alert('Uy no! ya valio hablale al ing :v');
         location.assign('../views/medicos.php');
         </script>";
    }
}


function editar_user()
{
    include "db.php";
    extract($_POST);
    $consulta = "UPDATE user SET nombre = '$nombre', correo = '$correo', password = '$password',
     rol ='$rol' WHERE id = '$id' ";
    $resultado = mysqli_query($conexion, $consulta);

    if ($resultado) {
        echo "<script language='JavaScript'>
        location.assign('../views/usuarios.php');
        </script>";
    } else {
        echo "<script language='JavaScript'>
         alert('Uy no! ya valio hablale al ing :v');
         location.assign('../views/usuarios.php');
         </script>";
    }
}

function editar_paciente()
{
    include "db.php";
    extract($_POST);
    $consulta = "UPDATE pacientes SET nombre = '$nombre', dni='$dni', sexo = '$sexo', correo = '$correo', 
    telefono = '$telefono', fechanacpac='$fechanacpac', estado ='Pendiente',  tiposangre='$tiposangre', preexistencias='$preexistencias', direccion='$direccion', contacto='$nombrecontacto', telfcontacto='$telfcontacto' WHERE id = '$id' ";
    $resultado = mysqli_query($conexion, $consulta);

    if ($resultado) {
        echo "<script language='JavaScript'>
        location.assign('../views/pacientes.php');
        </script>";
    } else {
        echo "<script language='JavaScript'>
         alert('Uy no! ya valio hablale al ing :v');
         location.assign('../views/pacientes.php');
         </script>";
    }
}

function editar_esp()
{
    include "db.php";
    extract($_POST);
    $consulta = "UPDATE especialidades SET nombreespecialidad = '$nombre' WHERE id = '$id' ";
    $resultado = mysqli_query($conexion, $consulta);
    
    if ($resultado) {
        echo "<script language='JavaScript'>
        location.assign('../views/especialidades.php');
        </script>";
    } else {
        echo "<script language='JavaScript'>
         alert('Uy no! ya valio hablale al ing :v');
         location.assign('../views/especialidades.php');
         </script>";
    }

}

function editar_doctor()
{
    include "db.php";
    extract($_POST);
    $consulta = "UPDATE doctor SET cedula = '$cedula', nombresdoc = '$nombres', id_especialidad = '$id_especialidad',  sexodoc = '$sexo',
    telefonodoc = '$telefono', fechanacdoc = '$fecha',  correodoc = '$correo' WHERE iddoctor = '$id' ";
    $resultado = mysqli_query($conexion, $consulta);

    if ($resultado) {
        echo "<script language='JavaScript'>
        location.assign('../views/medicos.php');
        </script>";
    } else {
        echo "<script language='JavaScript'>
        alert('Uy no! ya valio hablale al ing :v');
         location.assign('../views/medicos.php');
         </script>";
    }
}

function editar_hora()
{
    include "db.php";
    extract($_POST);
    $consulta = "UPDATE horario SET dias = '$dias', id_doctor = '$id_doctor' WHERE id = '$id' ";
    $resultado = mysqli_query($conexion, $consulta);

    if ($resultado) {
        echo "<script language='JavaScript'>
        location.assign('../views/horarios.php');
        </script>";
    } else {
        echo "<script language='JavaScript'>
         alert('Uy no! ya valio hablale al ing :v');
         location.assign('../views/horarios.php');
         </script>";
    }
}

function editar_cita()
{
    include "db.php";
    extract($_POST);

    $sql = "SELECT id_especialidad FROM doctor where iddoctor='$id_doctor' ";
    $resultado = mysqli_query($conexion, $sql);
    $especialidad = mysqli_fetch_array($resultado);
    $idespecialidad=$especialidad['id_especialidad'];


    $consulta = "UPDATE citas SET fechacita = '$fecha', hora = '$hora', id_paciente = '$id_paciente', id_doctor='$id_doctor', id_especialidad = '$idespecialidad', observacion = '$observacion' , estadocita= '$estado' 
    WHERE idcita = '$id' ";
    $resultado = mysqli_query($conexion, $consulta);


      if ($resultado) {
        echo "<script language='JavaScript'>
        location.assign('../views/citas.php');
        </script>";
    } else {
        echo "<script language='JavaScript'>
        alert('Uy no! ya valio hablale al ing :v');
         location.assign('../views/citas.php');
         </script>";
    }
   
}
function editar_micita()
{
    include "db.php";
    extract($_POST);

   $consulta = "UPDATE citas SET estadocita= '$estado' WHERE idcita = '$id' ";
    $resultado = mysqli_query($conexion, $consulta);

    if ($resultado) {
        echo "<script language='JavaScript'>
        location.assign('../views/miscitas.php');
        </script>";
    } else {
        echo "<script language='JavaScript'>
         alert('Uy no! ya valio hablale al ing :v');
         location.assign('../views/miscitas.php');
         </script>";
    }
}
function editar_diagnostico()
{
    include "db.php";
    extract($_POST);


    $uploaddir="archivo/";
    $filesize=$_FILES['archivo']['size'];
    $filename=$_FILES['archivo']['name'];
    $foto1=$filename;
    $destino="archivo/";
    $destino.=$foto1;

    if($filesize!=0){
        $consulta = "UPDATE diagnostico SET resultadodiagnostico='$diagnostico', recetadiagnostico= '$receta', archivodiagnostico='$destino' WHERE iddiagnostico = '$id' ";
        $resultado = mysqli_query($conexion, $consulta);

        $uploadfile="../".$uploaddir.$filename;
        move_uploaded_file($_FILES['archivo']['tmp_name'], $uploadfile);
    }else{
        $consulta = "UPDATE diagnostico SET resultadodiagnostico='$diagnostico', recetadiagnostico= '$receta' WHERE iddiagnostico = '$id' ";
    $resultado = mysqli_query($conexion, $consulta);

    }

   

    if ($resultado) {
        echo "<script language='JavaScript'>
        location.assign('../views/citas.php');
        </script>";
    } else {
        echo "<script language='JavaScript'>
        alert('Uy no! ya valio hablale al ing :v');
         location.assign('../views/citas.php');
         </script>";
    }
}
function editar_midiagnostico()
{
    include "db.php";
    extract($_POST);


    $uploaddir="archivo/";
    $filesize=$_FILES['archivo']['size'];
    $filename=$_FILES['archivo']['name'];
    $foto1=$filename;
    $destino="archivo/";
    $destino.=$foto1;

     if($filesize!=0){
        $consulta = "UPDATE diagnostico SET resultadodiagnostico='$diagnostico', recetadiagnostico= '$receta', archivodiagnostico='$destino' WHERE iddiagnostico = '$id' ";
        $resultado = mysqli_query($conexion, $consulta);

        $uploadfile="../".$uploaddir.$filename;
        move_uploaded_file($_FILES['archivo']['tmp_name'], $uploadfile);
    }else{
        $consulta = "UPDATE diagnostico SET resultadodiagnostico='$diagnostico', recetadiagnostico= '$receta' WHERE iddiagnostico = '$id' ";
    $resultado = mysqli_query($conexion, $consulta);

    }

    if ($resultado) {
        echo "<script language='JavaScript'>
        location.assign('../views/miscitas.php');
        </script>";
    } else {
        echo "<script language='JavaScript'>
         alert('Uy no! ya valio hablale al ing :v');
         location.assign('../views/miscitas.php');
         </script>";
    }
}