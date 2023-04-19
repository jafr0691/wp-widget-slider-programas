<?php

function isNullp($programa,$conductor,$enlace,$horai,$horaf,$img)
{
    if (strlen(trim($programa)) < 1 || strlen(trim($conductor)) < 1 || strlen(trim($enlace)) < 1 || strlen(trim($horai)) < 1 || strlen(trim($horaf)) < 1 || strlen(trim($img)) < 1) {
        return true;
    } else {
        return false;
    }
}

function Existep($key,$valor,$id='')
{
    global $wpdb;
    if ($id=='') {
        $valort = $wpdb->get_var("SELECT COUNT(*) FROM " . $wpdb->prefix . "Wgt_programacion where {$key}='{$valor}'");
    }else{
        $valort = $wpdb->get_var("SELECT COUNT(*) FROM " . $wpdb->prefix . "Wgt_programacion where id_programacion <> ".$id." and {$key}='{$valor}'");
    }
    if ($valort > 0) {
        return true;
    } else {
        return false;
    }
}

function resultBlockp($errors, $color)
{
    $html = '';
    if (count($errors) > 0) {
        $html .= "<div id='msg' class='alert alert-".$color."' role='alert'>
			<ul>";
        foreach ($errors as $error) {
            $html .= "<li>" . $error . "</li>";
        }
        $html .= "</ul>";
        $html .= "</div>";
    }
    return $html;
}

function registraProgramacion($programa, $conductor, $enlace, $horai, $horaf, $img)
{
    global $wpdb;
    $errors = array();
    
    $regisPro = $wpdb->insert(
        $wpdb->prefix . 'Wgt_programacion',
        array(
            'programa' => $programa,
            'conductores' => $conductor,
            'enlace' => $enlace,
            'horai' => $horai,
            'horaf' => $horaf,
            'img' => $img
        )
    );
    
    if ($regisPro) {
        $errors[] = "EXITO: La informacion del programa se guardo. " . $programa;
        $data = array(
            'res' => true,
            'programa' => $programa,
            'conductor' => $conductor,
            'enlace' => $enlace,
            'horai' => $horai,
            'horaf' => $horaf,
            'img' => $img,
            'id' => $wpdb->insert_id,
            'msg' => resultBlockp($errors, 'success')
        );
        return $data;
    } else {
        $errors[] = "ERROR: Del Servidor no se logro guardar, intente nuevamente. " . $programa;
        $data = array('res' => false, 'msg' => resultBlock($errors, 'danger'));
        return $data;
    }
}

function updateProgramacion($programa,$conductor,$enlace,$horai,$horaf,$img,$id)
{
    global $wpdb;
    $errors = array();
    $upd = $wpdb->update($wpdb->prefix . 'Wgt_programacion',
                array('programa'=> $programa,
            'conductores'=> $conductor,
            'enlace'=> $enlace,
            'horai'=> $horai,
            'horaf'=> $horaf,
            'img'=> $img),
                array('id_programacion' => $id)  );
    if($upd){
        $errors[] = "EXITO: Los campos fueron editados. ".$title;
        $data = array('res'=>true,'programa' => $programa, 'conductores'=> $conductor, 'enlace'=> $enlace, 'horai'=> $horai, 'horaf'=> $horaf, 'img'=> $img,'msg'=>resultBlock($errors,'success'));
        return $data;
    } else {
        $errors[] = "ERROR: Los campos no han cambiado o algun problema con en el servidor. ".$title;
        $data = array('res'=>false,'msg'=>resultBlock($errors,'danger'));
        return $data;
    }
}
