<?php
global $wpdb;

if ($_POST['acti']=='savePrograma') {
	$errors = array();
	if(!empty($_POST))
	{
		$programa = $_POST['programa'];
		$conductor = $_POST['conductor'];
        $enlace = $_POST['enlace'];
        $horai = $_POST['horai'];
        $horaf = $_POST['horaf'];
        $img = $_POST['img'];
		if(isNullp($programa,$conductor,$enlace,$horai,$horaf,$img))
		{
			$errors[] = "Debe llenar todos los campos";
		}
        if(Existep('programa',$programa))
        {
            $errors[] = "Programa ya exite";
        }
		if(Existep('enlace',$enlace))
		{
			$errors[] = "Enlace ya exite";
		}
		if(count($errors) == 0)
		{
			$registro =  registraProgramacion($programa,$conductor,$enlace,$horai,$horaf,$img);
			if($registro['res'])
			{
				exit(json_encode($registro));
				} else {
				$errors[] = "Error al Registrar el Programa";
			}
		}else{
		    $data = array('res' => false, 'msg'=>resultBlockp($errors,'danger'));
	        exit(json_encode($data));
		}
	}

    
}else if ($_POST['acti']=='updatPrograma') {
    $errors = array();
    if(!empty($_POST))
    {
        $programa = $_POST['programaed'];
        $conductor = $_POST['conductored'];
        $enlace = $_POST['enlaceed'];
        $horai = $_POST['horaied'];
        $horaf = $_POST['horafed'];
        $img = $_POST['imged'];
        $idp = $_POST['ideditar'];
        if(isNullp($programa,$conductor,$enlace,$horai,$horaf,$img,$idp))
        {
            $errors[] = "Debe llenar todos los campos";
        }

        if(Existep('programa',$programa,$idp))
        {
            $errors[] = "Programa ya exite";
        }
        if(Existep('enlace',$enlace,$idp))
        {
            $errors[] = "Enlace del Programa ya exite";
        }

        if(count($errors) == 0)
        {
            $updatslip =updateProgramacion($programa,$conductor,$enlace,$horai,$horaf,$img,$idp);
            if($updatslip['res'])
            {
                exit(json_encode($updatslip));
            } else {
                $errors[] = "Error al Editar el Programa";
            }
        }
    }

    $data = array('res' => false, 'msg'=>resultBlockp($errors,'danger'));
    exit(json_encode($data));
}else if ($_POST['acti']=='deletPrograma') {

    $wpdb->delete($wpdb->prefix . 'Wgt_programacion', array('id_programacion' => $_POST['id']));

}