<?php

include('../../app/config/config.php');

$nombre = $_FILES['archivo']['name'];
$guardado = $_FILES['archivo']['tmp_name'];

//se captura el id del evento

$id_act = $_POST['id_actividad'];

//captura del numero de control del usuario
$num_control = $_POST['numero_control'];

$responsable = $_POST['responsable'];

$nombre_alumno = $_POST['nombre_alumno'];

//se verifica si existe la carpeta don de se guardará el archivo
if (!file_exists('Diseño de Software')) {
  //si no existe la carpeta, se crea
  mkdir('Diseño de Software', 0777, true);
  if (file_exists('Diseño de Software')) {
    //Se verifica que el archivo que se sube, no exista en la carpeta, si ya existe no se podrá subir otra vez
    if (file_exists('Diseño de Software/' . $num_control . '-' . $nombre_alumno . '-' . $id_act . '-' . 'DiseñoSoftware.pdf')) {
      echo '<script language="javascript">alert("El archivo ya existe");window.location.href="../agregar-credito-user.php"</script>';
    } else {
      //Una vez que se confirmó que no se ha subido antes el archivo, se guarda el que se está subiendo a la carpeta que le corresponde
      if (move_uploaded_file($guardado, 'Diseño de Software/' . $num_control . '-' . $nombre_alumno . '-' . $id_act . '-' . 'DiseñoSoftware.pdf')) {

        $inserta = "INSERT INTO evidencia(numero_control, id_evento, subido, ruta_doc, responsable) VALUES ('$num_control', '$id_act', 1, 'Diseño de Software/$num_control-$nombre_alumno-$id_act-DiseñoSoftware.pdf', '$responsable')";
        $resultado = mysqli_query($conexion, $inserta);
        if (!$resultado) {
          echo 'Error al insertar archivo';
        } else {
          echo '<script language="javascript">alert("Archivo guardado");window.location.href="../agregar-credito-user.php"</script>';
        }
        mysqli_close($conexion);
      } else {
        echo '<script language="javascript">alert("Archivo no guardado");window.location.href="../agregar-credito-user.php"</script>';
      }
    }
  }
} else {
  //Se verifica que el archivo que se sube, no exista en la carpeta, si ya existe no se podrá subir otra vez
  if (file_exists('Diseño de Software/' . $num_control . '-' . $nombre_alumno . '-' . $id_act . '-' . 'DiseñoSoftware.pdf')) {
    echo '<script language="javascript">alert("El archivo ya existe");window.location.href="../agregar-credito-user.php"</script>';
  } else {
    //Una vez que se confirmó que no se ha subido antes el archivo, se mueve el que se está subiendo a la carpeta que le corresponde
    if (move_uploaded_file($guardado, 'Diseño de Software/' . $num_control . '-' . $nombre_alumno . '-' . $id_act . '-' . 'DiseñoSoftware.pdf')) {

      $inserta = "INSERT INTO evidencia(numero_control, id_evento, subido, ruta_doc, responsable) VALUES ('$num_control', '$id_act', 1, 'Diseño de Software/$num_control-$nombre_alumno-$id_act-DiseñoSoftware.pdf', '$responsable')";
      $resultado = mysqli_query($conexion, $inserta);
      if (!$resultado) {
        echo 'Error al insertar archivo';
      } else {
        echo '<script language="javascript">alert("Archivo guardado");window.location.href="../agregar-credito-user.php"</script>';
      }
      mysqli_close($conexion);
    } else {
      echo '<script language="javascript">alert("Archivo no guardado");window.location.href="../agregar-credito-user.php"</script>';
    }
  }
}
