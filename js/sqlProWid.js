(function($) {

    let touchEvent = 'ontouchstart' in window ? 'touchstart' : 'click';
    if(document.querySelector(".deletPrograma")){
        for (var i = 0; i <= document.querySelectorAll(".deletPrograma").length - 1; i++) {
            document.querySelectorAll(".deletPrograma")[i].addEventListener(touchEvent, msjdeletProgramas);
        }
    }

    function msjdeletProgramas(e) {
        var programa = e.target.getAttribute('data-programa');
        var cond = e.target.getAttribute('data-conductor');
        var id = e.target.getAttribute('data-id');
        document.getElementById('prodelettitle').innerHTML = '<strong>' + cond + '</strong>';
        document.getElementById('conductordelet').innerHTML = 'Desea eliminar Programa <strong>' + programa + '</strong>?';
        document.getElementById('btnprogramadelet').innerHTML = '<button class="btn btn-default rounded" style="position: absolute; left:30px; bottom: 10px;" id="btndelet" data-dismiss="modal" data-id="' + id + '">Eliminar <span class="text-danger glyphicon glyphicon-trash"></span></button>';
        document.getElementById('btndelet').addEventListener(touchEvent, deletProgramas);
    }

    function deletProgramas() {
        var id = document.getElementById('btndelet').getAttribute('data-id');
        jQuery.ajax({
            url: sqlprograma.sqlajaxpage,
            type: "post",
            data: {
                action: 'sqlprograma',
                acti: 'deletPrograma',
                id: id
            },
            success: function(d) {
                if (d) {
                    document.getElementById('delet' + id).parentElement.parentElement.remove();
                }
            }
        });
    }
    
    jQuery('#btnprogramaedi').on(touchEvent, function(e) {
        var data = jQuery("#formprogramaed").serialize();
        var dat = jQuery("#formprogramaed").serializeArray();
        var camvac = 0;
        jQuery.each(dat, function(i, val) {
            if (val.value == "") {
                alert("Ningun campo puede estar vacio");
                camvac = 1;
            }
        });
        if (camvac == 0) {
            jQuery.ajax({
                url: sqlprograma.sqlajaxpage,
                type: 'post',
                data: data + '&acti=updatPrograma&action=sqlprograma',
                success: function(dato) {
                    var d = JSON.parse(dato);

                    if (d['res']==true) {
                        document.getElementById("msgprogramas").innerHTML=d['msg'];
                        document.getElementById("formprogramaed").reset();
                        location.reload();
                    } else {
                        document.getElementById("msgprogramas").innerHTML=d['msg'];
                    }
                }
            });
        }
        e.preventDefault();
    });
    function verEditar(e){
        var id = e.target.id;
        let IDs = id.slice(2)
    
        var datos  = document.getElementById("listprograma"+id);
        document.getElementById("programaed").value = datos.children[0].textContent;
        document.getElementById("conductored").value = datos.children[1].textContent;
        document.getElementById("enlaceed").value = datos.children[2].textContent;
        document.getElementById("horaied").value = datos.children[3].textContent;
        document.getElementById("horafed").value = datos.children[4].textContent;
        document.getElementById("imged").src = datos.children[5].children[0].src;
        document.getElementById("ideditar").value = IDs;
        
        jQuery('#verEdiPrograma').modal("show");
    
      }
})(jQuery);