<link rel="stylesheet"  type="text/css" href="<?php echo ARCProgramas; ?>css/bootstrap.min.css">
    <!--datables CSS básico-->
    <link rel="stylesheet" type="text/css" href="<?php echo ARCProgramas; ?>js/datatables.min.css"/>
    <!--datables estilo bootstrap 4 CSS-->
    <link rel="stylesheet"  type="text/css" href="<?php echo ARCProgramas; ?>js/DataTables-1.10.20/css/dataTables.bootstrap4.css">
    <style type="text/css">
      table tr {
        text-align: center;
      }
    </style>
    <?php
        global $wpdb;
        $listProgramas  = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "Wgt_programacion");
     ?>
    <br>
    <br>
    <div class="container-fluid">
<nav class="navbar navbar-default">
  <img src="<?php echo ARCProgramas; ?>images/logo.png" width="72" height="72" style="float:left; margin:7px">
    <h2>Programas</h2>
  <p>Complete la configuración necesaria a continuación para que el Widget de Programas funcione correctamente.</p>
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
     <button type="button" class="btn btn-success navbar-btn" id="registraPrograma">Agregar Imagen</button> 
    </div>
  </div>
</nav>
<div class="row">
      <div class="col-lg-12">
        <div id="msgprogramas"></div>
       <div class="table-responsive">
        <table id="datatableprograma" class="table table-striped table-bordered"  style="width:100%">
         <thead id='TableProgramas'>
          <tr>
           <th scope="col">Programa</th>
           <th scope="col">Conductores</th>
           <th scope="col">Enlace</th>
           <th scope="col">Hora Incio</th>
           <th scope="col">Hora Fin</th>
           <th scope="col">Imagen</th>
           <th scope="col">Editar</th>
           <th scope="col">Eliminar</th>
         </tr>
       </thead>
       <tbody id="listbusqueda">
        <?php
        foreach ($listProgramas as $programaswgt) {
         ?>
         <tr id="listprogramaid<?php echo $programaswgt->id_programacion; ?>">
          <td><?php echo $programaswgt->programa; ?></td>
          <td><?php echo $programaswgt->conductores; ?></td>
          <td><?php echo $programaswgt->enlace; ?></td>
          <td><?php echo $programaswgt->horai; ?></td>
          <td><?php echo $programaswgt->horaf; ?></td>
          <td style="padding: 0;"><img  src="<?php echo $programaswgt->img;?>" height="70" width="80"></td>
          <td>
            <span class="glyphicon glyphicon-edit btn text-primary" id="id<?php echo $programaswgt->id_programacion; ?>" onclick="verEditar()">
            </span>
          </td>
          <td>
            <span data-programa='<?php echo $programaswgt->programa; ?>' class='text-danger btn deletPrograma glyphicon glyphicon-trash' data-conductor='<?php echo $programaswgt->conductores; ?>' data-id='<?php echo $programaswgt->id_programacion; ?>' id='delet<?php echo $programaswgt->id_programacion; ?>' title='Eliminar' data-toggle='modal' data-target='#programaDelet'></span>
          </td>
        </tr>
      <?php }?>
    </tbody>
  </table>
</div>
</div>

<div class="modal fade" id="programaDelet" role="dialog">
  <div class="modal-dialog modal-md">
   <div class="modal-content">
    <div class="modal-header">

     <h4 class="modal-title" id="prodelettitle"></h4>
   </div>
   <div class="modal-body text-center" id="imp1">
     <p id="conductordelet"></p>
   </div>
   <div class="modal-footer">
     <button type="button" class="close mr-5" data-dismiss="modal">x</button>
     <div id="btnprogramadelet"></div>
   </div>
 </div>
</div>
</div>

<div class="modal fade" id="verEdiPrograma" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Editar Widget</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="formprogramaed">
      <div class="modal-body">
        <div class="form-horizontal">
          <div id="msgtpdiariosedi"></div>
          <div class="form-group">
            <label for="programaed" class="col-md-5 control-label">Programa</label>
            <div class="col-md-7">
              <input type="text" class="form-control" id="programaed" name="programaed" placeholder="Programa" required autocomplete="off">
            </div>
          </div>
          <div class="form-group">
            <label for="imged" class="col-md-5 control-label">Imagen</label>
            <div class="col-md-7" style="text-align:center;">
              <img src="<?php echo ARCProgramas; ?>images/2154830.svg" height="90" width="90" alt="img" id="imged">
              <button class="btn btn-success" id="btnimged">Seleccionar <span class="glyphicon glyphicon-picture text-default"></span></button>
            </div>
          </div>
          <div class="form-group">
            <label for="conductored" class="col-md-5 control-label">Conductores</label>
            <div class="col-md-7">
              <input type="text" class="form-control" id="conductored" name="conductored" placeholder="Conductores" required autocomplete="off">
            </div>
          </div>
          <div class="form-group">
            <label for="enlaceed" class="col-md-5 control-label">Enlace</label>
            <div class="col-md-7">
              <input type="text" class="form-control" id="enlaceed" name="enlaceed" placeholder="Enlace del programa" required autocomplete="off">
            </div>
          </div>
          <div class="form-group">
            <label for="horaied" class="col-md-5 control-label">Hora Inicio</label>
            <div class="col-md-7">
              <input type="text" class="form-control" id="horaied" name="horaied" placeholder="Hora Inicio" required autocomplete="off">
            </div>
          </div>
            <div class="form-group">
                <label for="horafed" class="col-md-5 control-label">
                    Hora Inicio
                </label>
                <div class="col-md-7">
                  <input type="text" class="form-control" id="horafed" name="horafed" placeholder="Hora Inicio" required autocomplete="off">
                </div>
            </div>
            <div class="form-groupcol-md-12 text-center">
                <img src='' height='120' width='115' id="imgedi">
            </div>
          <input type="hidden" name="ideditar" id="ideditar">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
        <button type="submit" id="tpdiariosedi" class="btn btn-success">Guardar</button>
        <img style="display: none;" src="<?php echo ARCTPDiarios; ?>/images/carga.gif" id="tpdiarioscarga" width="100px" height="60px">
      </div>
    </div>
    </form>
  </div>
</div>
  <p><?php __('Este plugin fue desarrollado por', 'TPTapa'); ?> <a href="https://www.evolucionstreaming.com" target="_blank" title="<?php __('Evolucion Streaming - Servicios Informáticos', 'TPTapa'); ?>"><?php __('Evolucion Streaming - Servicios Informáticos', 'TPTapa'); ?></a>.</p>
  
<script src="<?php echo ARCProgramas; ?>js/datatables.min.js"></script> 
<script src="<?php echo ARCProgramas; ?>js/maindatatable.js"></script> 

<script type="text/javascript">

document.addEventListener("DOMContentLoaded", function(){
  let touchEvent = 'ontouchstart' in window ? 'touchstart' : 'click';
  var idsave = 0;
  
  
  document.getElementById('registraPrograma').addEventListener(touchEvent,()=>{
    var trregsli = document.createElement("tr");
    trregsli.setAttribute('id', 'formid'+idsave);
    var tdprograma = document.createElement("td");
    var inputprograma = document.createElement("input");
    inputprograma.setAttribute('type', 'text');
    inputprograma.setAttribute('name', 'programa');
    inputprograma.setAttribute('value', '');
    inputprograma.setAttribute('id', 'programaid'+idsave);
    inputprograma.setAttribute('placeholder', 'Programa');
    trregsli.appendChild(tdprograma);
    tdprograma.appendChild(inputprograma);
    
    var tdcoductor = document.createElement("td");
    var inputconductor = document.createElement("input");
    inputconductor.setAttribute('type', 'text');
    inputconductor.setAttribute('name', 'conductor');
    inputconductor.setAttribute('value', '');
    inputconductor.setAttribute('id', 'conductorid'+idsave);
    inputconductor.setAttribute('placeholder', 'Conductor');
    trregsli.appendChild(tdcoductor);
    tdcoductor.appendChild(inputconductor);
    
    var tdenlace = document.createElement("td");
    var inputenlace = document.createElement("input");
    inputenlace.setAttribute('type', 'text');
    inputenlace.setAttribute('name', 'enlace');
    inputenlace.setAttribute('value', '');
    inputenlace.setAttribute('id', 'enlaceid'+idsave);
    inputenlace.setAttribute('placeholder', 'Enlace del Programa');
    trregsli.appendChild(tdenlace);
    tdenlace.appendChild(inputenlace);
    
    var tdhorai = document.createElement("td");
    var inputhorai = document.createElement("input");
    inputhorai.setAttribute('type', 'time');
    inputhorai.setAttribute('name', 'inicio');
    inputhorai.setAttribute('value', '');
    inputhorai.setAttribute('id', 'inicioid'+idsave);
    inputhorai.setAttribute('placeholder', 'Hora de inicio');
    trregsli.appendChild(tdhorai);
    tdhorai.appendChild(inputhorai);
    
    var tdhoraf = document.createElement("td");
    var inputhoraf = document.createElement("input");
    inputhoraf.setAttribute('type', 'time');
    inputhoraf.setAttribute('name', 'final');
    inputhoraf.setAttribute('value', '');
    inputhoraf.setAttribute('id', 'finalid'+idsave);
    inputhoraf.setAttribute('placeholder', 'Hora de final');
    trregsli.appendChild(tdhoraf);
    tdhoraf.appendChild(inputhoraf);
    
    var tdimg = document.createElement("td");
    tdimg.setAttribute('style', 'padding: 0;');
    var img = document.createElement("img");
    img.setAttribute('src', '<?php echo ARCProgramas; ?>images/2154830.svg');
    img.setAttribute('id', 'imgid'+idsave);
    img.setAttribute('height', '70');
    img.setAttribute('width', '80');
    img.setAttribute('alt', 'img');
    trregsli.appendChild(tdimg);
    tdimg.appendChild(img);
    
    var tdbtnimg = document.createElement("td");
    var btnimg = document.createElement("button");
    btnimg.setAttribute('id', 'id'+idsave);
    btnimg.textContent = ' Imagen ';
    btnimg.setAttribute('class', 'btn btn-success');
    var spanimg = document.createElement("span");
    spanimg.setAttribute('class', 'glyphicon glyphicon-picture text-default');
    trregsli.appendChild(tdbtnimg);
    tdbtnimg.appendChild(btnimg);
    btnimg.appendChild(spanimg);
    
    var tdsave = document.createElement("td");
    var btnsave = document.createElement("button");
    btnsave.setAttribute('id', 'id'+idsave);
    btnsave.textContent = ' Guardar ';
    btnsave.setAttribute('class', 'btn btn-success');
    var spansave = document.createElement("span");
    spansave.setAttribute('class', 'glyphicon glyphicon-save text-default');
    trregsli.appendChild(tdsave);
    tdsave.appendChild(btnsave);
    btnsave.appendChild(spansave);
    
    document.getElementById("listbusqueda").appendChild(trregsli);
    var wkMedia;
    btnimg.onclick = function(e) {
        e.preventDefault();
        var imgid = 'img'+e.target.id;
        console.log(imgid,e.target.id);
        if (wkMedia) {
          wkMedia.open();
          return;
        }

        wkMedia = wp.media.frames.file_frame = wp.media({
          title: 'Select media',
          button: {
          text: 'Select media'
        }, multiple: false });
        
        wkMedia.on('select', function() {
          var attachment = wkMedia.state().get('selection').first().toJSON();
          document.getElementById(imgid).src = attachment.url;
        });
        
        wkMedia.open();
    };

    btnsave.onclick = function(e) {
        var id = e.target.id;
        console.log(id);
        var progra = document.getElementById("programa"+id).value, conduct = document.getElementById("conductor"+id).value, hi = document.getElementById("inicio"+id).value, hf = document.getElementById("final"+id).value, img = document.getElementById("img"+id).src, enlace = document.getElementById("enlace"+id).value;
        var data = {programa:progra, conductor: conduct,enlace: enlace, horai:hi, horaf:hf, img:img,acti:'savePrograma',action:'sqlprograma'};
        jQuery.ajax({
            url: sqlprograma.sqlajaxpage,
            type: "post",
            data: data,
            success: function(dato) {
              var dat = JSON.parse(dato);
              console.log(dat);
              if (dat['res']) {
                document.getElementById('msgprogramas').innerHTML = dat['msg'];
                document.getElementById('form'+id).innerHTML = `<td>`+dat['programa']+`</td>
            <td>`+dat['conductor']+`</td>
            <td>`+dat['enlace']+`</td>
            <td>`+dat['horai']+`</td>
            <td>`+dat['horaf']+`</td>
            <td style='padding: 0;'><img src='`+dat['img']+`' height='70' width='80'></td>
            <td>
            <span class='glyphicon glyphicon-edit btn text-primary' onclick='editar(`+dat['id_programacion']+`)'>
            </span>
          </td>
          <td><span data-programa='`+dat['programa']+`' class='text-danger btn deletPrograma glyphicon glyphicon-trash' data-id='`+dat['id_programacion']+`' data-conductor='`+dat['conductores']+`' id='delet`+dat['id_programacion']+`' title='Eliminar' data-toggle='modal' data-target='#programaDelet'></span></td>`;
              }else{
                document.getElementById('msgprogramas').innerHTML = dat['msg'];
              }
            }
        });
    };
    

    idsave++;
  });
  
    var wkMediaed;
    jQuery("#btnimged").click(function() {
        if (wkMediaed) {
          wkMediaed.open();
          return;
        }

        wkMediaed = wp.media.frames.file_frame = wp.media({
          title: 'Select media',
          button: {
          text: 'Select media'
        }, multiple: false });
        
        wkMediaed.on('select', function() {
            var attachment = wkMedia.state().get('selection').first().toJSON();
            document.getElementById('imged').src = attachment.url;
        });
        
        wkMedia.open();
    });
    
});
</script>