function envioProceso(valor) {
    $("#procesoid").val(valor);
}

function tareasProceso(valor) {
var url = $('#listtarea').val();
var data = {
    procesoid:  valor,    
    
}
$(".cargaTareas").html('');
$('.loader_bg').attr('style','display: true;');
$.ajax({
    url: url,
    type: "post",
    data: data,
})
    .done(function(res){
        $('.loader_bg').attr('style','display: none;');
        $(".cargaTareas").html(res);
    });
}

function vistaProceso(valor) {
    var url = $('#verProcesourl').val();
    var data = {
        procesoid:  valor, 
        accion:    'vista',   
        
    }
    $(".cargaProceso").html('');
    $('.loader_bg').attr('style','display: true;');
    $.ajax({
        url: url,
        type: "post",
        data: data,
    })
        .done(function(res){
            $('.loader_bg').attr('style','display: none;');
            $(".cargaProceso").html(res);
        });
}

function logProceso(valor) {
    var url = $('#logProcesourl').val();
    var data = {
        procesoid:  valor,        
    }
    $(".cargaLogs").html('');
    $.ajax({
        url: url,
        type: "post",
        data: data,
    })
        .done(function(res){
            $(".cargaLogs").html(res);
        });
}

function editarProceso(valor) {
    var url = $('#verProcesourl').val();
    var data = {
        procesoid:  valor,
        accion: 'editar',    
        
    }
    $(".cargarEditar").html('');
    $('.loader_bg').attr('style','display: true;');
    $.ajax({
        url: url,
        type: "post",
        data: data,
    })
        .done(function(res){
            $('.loader_bg').attr('style','display: none;');
            $(".cargarEditar").html(res);
        });
}

$(document).ready(function() {
    $('.btn-cancelar').on('click', function (e) {
        e.preventDefault();
        location.reload(true);
    });

    $('.btn-close').on('click', function (e) {
        e.preventDefault();
        location.reload(true);
    });

    $('#tabProcesos').DataTable({language: {
        url: "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
      }});
      
      $('.tabLogs').DataTable({language: {
        url: "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
      }});   

    $(document).on('change', '.recurrencia', function() {
        var recurId = $(this).find(":selected").val();
        var varid   = $('.variableIni').find(":selected").val();
        if(varid == 5)
        {
            $('.div-antelacion').attr('style','display: true;');
            $('.div-antes').attr('style','display: true;');
            $('.div-alta').attr('style','display: none;');
        }
        else
        {
            $('.div-antelacion').attr('style','display: true;');
            $('.div-antes').attr('style','display: none;');
            $('.div-alta').attr('style','display: none;');
        }
        if(recurId == 1)
        {
            $('.div-dias').attr('style','display: true;');  
            $('.div-mes').attr('style','display: none;');
            $('.div-semana').attr('style','display: none;');
            //$('.div-antes').attr('style','display: none;');
        }
        else
        {
            if(recurId == 2)
            {
                $('.div-dias').attr('style','display: true;'); 
                //$('.div-antelacion').attr('style','display: true;');
                $('.div-mes').attr('style','display: true;');
                $('.div-semana').attr('style','display: none;');
                $('.lab-mes').html('<b>Mes</b>');
                //$('.div-antes').attr('style','display: none;');
            }
            else
            {
                if(recurId == 3)
                {
                    $('.div-dias').attr('style','display: true;'); 
                    $('.div-antelacion').attr('style','display: none;');
                    $('.div-mes').attr('style','display: none;');
                    $('.div-semana').attr('style','display: none;');
                    //$('.div-antes').attr('style','display: none;');
                }
                else
                {
                    if(recurId == 4)
                    {
                        $('.div-dias').attr('style','display: none;'); 
                        $('.div-antelacion').attr('style','display: none;');
                        $('.div-mes').attr('style','display: none;');
                        $('.div-semana').attr('style','display: true;');
                        //$('.div-antes').attr('style','display: none;');
                    }
                    else
                    {
                        if(recurId == 5)
                        {
                            $('.div-dias').attr('style','display: true;'); 
                            $('.div-antelacion').attr('style','display: true;');
                            $('.div-mes').attr('style','display: true;');
                            $('.div-semana').attr('style','display: none;');
                            $('.lab-mes').html('<b>Mes de Inicio</b>');
                            //$('.div-antes').attr('style','display: none;');
                        }
                        else
                        {
                            if(recurId == 6)
                            {
                                $('.div-dias').attr('style','display: true;'); 
                                $('.div-antelacion').attr('style','display: true;');
                                $('.div-mes').attr('style','display: true;');
                                $('.div-semana').attr('style','display: none;');
                                $('.lab-mes').html('<b>Mes de Inicio</b>');
                                //$('.div-antes').attr('style','display: none;');
                            }
                            else
                            {
                                $('.div-dias').attr('style','display: none;'); 
                                $('.div-antelacion').attr('style','display: none;');
                                $('.div-mes').attr('style','display: none;');
                                $('.div-semana').attr('style','display: none;');
                                //$('.div-antes').attr('style','display: none;'); 
                            }
                        }
                    }
                }
            }
        }
    });

    $(document).on('change', '.tipoproceso', function() {
        console.log("Funciona el evento change");
        var tipoid = $(this).val();
        var data = {
            tipoid: tipoid
        };
        var url = '/cat/proceso/variable';
        $.ajax({
            type: 'post',
            url: url,
            data: data,
            success: function(data) {
                var $variable_selector = $('.variableIni');
                $variable_selector.html('<option value="0">--Seleccionar Variable--</option>');

                for (var i = 0, total = data.length; i < total; i++) {
                    $variable_selector.append('<option value="' + data[i].id + '">' + data[i].variable + '</option>');
                }

                var $frecuencia_selector = $('.recurrencia');
                $frecuencia_selector.html('<option>--Seleccionar Recurrencia--</option>');
            }
        });

        /*if(tipoid == 2)
        {*/
            $('.div-frecuencia').attr('style','display: none;'); 
        //}
        $('.div-dias').attr('style','display: none;'); 
        $('.div-antelacion').attr('style','display: none;');
        $('.div-mes').attr('style','display: none;');
        $('.div-semana').attr('style','display: none;');
        $('.div-habil').attr('style','display: none;');
        $('.div-antes').attr('style','display: none;');
        $('.div-alta').attr('style','display: none;');
    });

    $(document).on('change', '.variableIni', function() {
        var variableid = $(this).val();

        if(variableid == 4 || variableid == 5 || variableid == 0)
        {
            var data = {
                    variableid: variableid
                };
                var url = '/cat/recurrencia/seleccion';
                $.ajax({
                    type: 'post',
                    url: url,
                    data: data,
                    success: function(data) {
                        var $frecuencia_selector = $('.recurrencia');
                        $frecuencia_selector.html('<option>--Seleccionar Recurrencia--</option>');
            
                        for (var i = 0, total = data.length; i < total; i++) {
                            $frecuencia_selector.append('<option value="' + data[i].id + '">' + data[i].recurrencia + '</option>');
                        }
                        $('.div-frecuencia').attr('style','display: true;');  
                    }
                });
                $('.div-dias').attr('style','display: none;'); 
                $('.div-antes').attr('style','display: none;');
                $('.div-antelacion').attr('style','display: none;');
                $('.div-alta').attr('style','display: none;');
        }
        else
        {
            $('.div-frecuencia').attr('style','display: none;'); 
            $('.div-dias').attr('style','display: true;'); 
            $('.div-antelacion').attr('style','display: true;');
            if(variableid == 1)
            {
                $('.div-alta').attr('style','display: true;');
                $('.div-antes').attr('style','display: none;');
            }
            else
            {
                $('.div-antes').attr('style','display: true;');
                $('.div-alta').attr('style','display: none;');
            }
        }
        
        //$('.div-antelacion').attr('style','display: none;');
        $('.div-mes').attr('style','display: none;');
        $('.div-semana').attr('style','display: none;');
        $('.div-habil').attr('style','display: true;');
        //$('.div-antes').attr('style','display: none;');
        if(variableid == 0)
        {
            $('.div-frecuencia').attr('style','display: none;'); 
            $('.div-dias').attr('style','display: none;'); 
            $('.div-antes').attr('style','display: none;');
            $('.div-antelacion').attr('style','display: none;');
            $('.div-mes').attr('style','display: none;');
            $('.div-semana').attr('style','display: none;');
            $('.div-habil').attr('style','display: none;');
            $('.div-alta').attr('style','display: none;');
        }

        $('.dia').val(0); 
        $('.antelacion').val(0);
        $('#chk-alta').val(0);
        //$('.recurrencia').
        
    });
})    