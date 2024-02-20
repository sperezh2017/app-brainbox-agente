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

$('.btn-cancelar').on('click', function (e) {
    e.preventDefault();
    location.reload(true);
});

$('.btn-close').on('click', function (e) {
    e.preventDefault();
    location.reload(true);
});