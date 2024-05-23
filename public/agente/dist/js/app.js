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
      },
      columnDefs: [
            {
                targets: [0,2],
                searchable: false
            }
        ],
        layout: {
            topStart: {
                buttons: [
                    {
                      extend: 'excelHtml5',
                      text: '<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="48" height="48" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M14 3v4a1 1 0 0 0 1 1h4"></path><path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z"></path><path d="M10 12l4 4m0 -4l-4 4"></path></svg>',
                      title: 'Lista Procesos',
                      titleAttr: 'Exportar a Excel',
                      className: 'bg-success text-white',
                    },
                    {
                      extend: 'pdfHtml5',
                      text: '<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M10 8v8h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-2z"></path><path d="M3 12h2a2 2 0 1 0 0 -4h-2v8"></path><path d="M17 12h3"></path><path d="M21 8h-4v8"></path></svg>',
                      title: 'Lista Procesos',
                      titleAttr: 'Exportar a PDF',
                      className: 'bg-danger text-white',
                    },
                    {
                      extend: 'print',
                      text: '<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2"></path><path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4"></path><path d="M7 13m0 2a2 2 0 0 1 2 -2h6a2 2 0 0 1 2 2v4a2 2 0 0 1 -2 2h-6a2 2 0 0 1 -2 -2z"></path></svg>',
                      title: 'Lista Procesos',
                      titleAttr: 'Imprimir',
                      className: 'bg-info text-white',
                    },
                  ],
            }
        }
    });

    $('#tabClientes').DataTable({language: {
        url: "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
      },
        layout: {
            topStart: {
                buttons: [
                    {
                      extend: 'excelHtml5',
                      text: '<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="48" height="48" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M14 3v4a1 1 0 0 0 1 1h4"></path><path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z"></path><path d="M10 12l4 4m0 -4l-4 4"></path></svg>',
                      title: 'Lista Procesos',
                      titleAttr: 'Exportar a Excel',
                      className: 'bg-success text-white',
                    },
                    {
                      extend: 'pdfHtml5',
                      text: '<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M10 8v8h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-2z"></path><path d="M3 12h2a2 2 0 1 0 0 -4h-2v8"></path><path d="M17 12h3"></path><path d="M21 8h-4v8"></path></svg>',
                      title: 'Lista Procesos',
                      titleAttr: 'Exportar a PDF',
                      className: 'bg-danger text-white',
                    },
                    {
                      extend: 'print',
                      text: '<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2"></path><path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4"></path><path d="M7 13m0 2a2 2 0 0 1 2 -2h6a2 2 0 0 1 2 2v4a2 2 0 0 1 -2 2h-6a2 2 0 0 1 -2 -2z"></path></svg>',
                      title: 'Lista Procesos',
                      titleAttr: 'Imprimir',
                      className: 'bg-info text-white',
                    },
                  ],
            }
        }
    });
      
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

function vistaCliente(valor) {
    var url = $('#verClienteurl').val();
    var data = {
        clienteid:  valor, 
        accion:    'vista',   
        
    }
    $(".cargaCliente").html('');
    $('.loader_bg').attr('style','display: true;');
    $.ajax({
        url: url,
        type: "post",
        data: data,
    })
        .done(function(res){
            $('.loader_bg').attr('style','display: none;');
            $(".cargaCliente").html(res);
        });
}