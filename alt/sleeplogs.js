$(document).ready(function() {
    $(".cambia").click(function() {
        //esconder todos DIVs
        $(".content").hide();
        //obtener nombre del enlace
        nombre = $(this).attr("label");
        //mostrar el panel segun el nombre del enlace oprimido
        $("#" + nombre).show();
        //$("#Buscador").show();
        // alert(nombre);
    });
});

function sortTable(columnName){
    // alert("Table");
    var sort = $("#sort").val();
    
    $.ajax({
        url:'info_details.php',
        type:'post',
        data:{tabla:tabla,columnName:columnName,sort:sort},
        success: function(response){

        $("#empTable tr:not(:first)").remove();

        $("#empTable").append(response);
        if(sort == "asc"){
            $("#sort").val("desc");
        }else{
            $("#sort").val("asc");
        }

        }
    });
}
function sortTabla(tabla,columnName){
    // alert("Tabla");
    var sort = $("#sort").val();

    $.ajax({
        url:'info_details.php',
        type:'post',
        data:{tabla:tabla,columnName:columnName,sort:sort},
        success: function(response){

        $("#empTable tr:not(:first)").remove();

        $("#empTable").append(response);
        if(sort == "asc"){
            $("#sort").val("desc");
        }else{
            $("#sort").val("asc");
        }

        }
    });
}

$(document).on('change','#selTable',function(){
    // alert(this.value);
    v = this.value;
    $('.selField').empty()
    switch (v) {
        case 'Sleep_Studies_Results':
            $('.selField').append('<option value="Expediente">Num. Expediente</option>');
            $('.selField').append('<option value="Nombre">Nombre</option>');
            $('.selField').append('<option value="Apellidos">Apellidos</option>');
            $('.selField').append('<option value="Fecha_Estudio">Fecha de Estudio</option>');
            $('.selField').append('<option value="Fecha_Entrega">Fecha de Entrega</option>');
            $('.selField').append('<option value="Medico">Medico</option>');
            $('.selField').append('<option value="Visit_ID">Visit ID</option>');
            $('.selField').append('<option value="DED">DED</option>');
            $('.selField').append('<option value="Plan_Medico">Plan Medico</option>');
            $('.selField').append('<option value="Plan_Medico2">Plan Medico2</option>');
            $('.selField').append('<option value="Created">Creado en</option>');
            $('.selField').append('<option value="CreatedBy">Creado por</option>');
            $('.selField').append('<option value="Modified">Modified</option>');
            $('.selField').append('<option value="ModifiedBy">ModifiedBy</option>');
        break;
        case 'Sleep_Listado_Expedientes':
            $('.selField').append('<option value="num_expediente">Num. Expediente</option>');
            $('.selField').append('<option value="Nombre">Nombre</option>');
            $('.selField').append('<option value="Apelidos">Apelidos</option>');
            $('.selField').append('<option value="Telefono1">Telefono1</option>');
            $('.selField').append('<option value="Telefono2">Telefono2</option>');
            $('.selField').append('<option value="Created">Creado</option>');
            $('.selField').append('<option value="CreatedBy">Creado Por</option>');
            $('.selField').append('<option value="Modified">Modificado</option>');
            $('.selField').append('<option value="ModifiedBy">Modificado por </option>');
        break;
        case 'Sleep_Listado_Referidos':
            $('.selField').append('<option value="Num_expediente">Num. Expediente</option>');
            $('.selField').append('<option value="Nombre">Nombre</option>');
            $('.selField').append('<option value="Apellidos">Apelidos</option>');
            $('.selField').append('<option value="Dia_Estudio">Dia de Estudio</option>');
            $('.selField').append('<option value="Visit_ID">Visit ID</option>');
            $('.selField').append('<option value="Plan_Medico">Plan Medico</option>');
            $('.selField').append('<option value="Plan_Medico2">Otro Plan Medico</option>');
            $('.selField').append('<option value="Referido_Por_MD">Referido por Medico</option>');
            $('.selField').append('<option value="Created">Creado</option>');
            $('.selField').append('<option value="CreatedBy">Creado Por</option>');
            $('.selField').append('<option value="Modified">Modificado</option>');
            $('.selField').append('<option value="ModifiedBy">Modificado por</option>');
        break;
        case 'Sleep_Inspeccion_Rutina':
            $('.selField').append('<option value="Fecha_Inspeccion">Fecha Inspeccion</option>');
            $('.selField').append('<option value="Habitacion">Habitacion</option>');
            $('.selField').append('<option value="Amplificador">Amplificador</option>');
            $('.selField').append('<option value="Headbox">Headbox</option>');
            $('.selField').append('<option value="Oximetro">Oximetro</option>');
            $('.selField').append('<option value="CPAP">CPAP</option>');
            $('.selField').append('<option value="Cama">Cama</option>');
            $('.selField').append('<option value="Bandas">Bandas</option>');
            $('.selField').append('<option value="Sensores">Sensores</option>');
            $('.selField').append('<option value="Electrodos">Electrodos</option>');
            $('.selField').append('<option value="Oxigeno">Oxigeno</option>');
            $('.selField').append('<option value="Intercome">Intercome</option>');
            $('.selField').append('<option value="PC">PC</option>');
            $('.selField').append('<option value="Accion_Tomada">Accion Tomada</option>');
            $('.selField').append('<option value="Iniciales_Tecnico">Iniciales del Tecnico</option>');
            $('.selField').append('<option value="ETCO">ETCO</option>');
            $('.selField').append('<option value="Transcutaneo">Transcutaneo</option>');
            $('.selField').append('<option value="Created">Creado en</option>');
            $('.selField').append('<option value="CreatedBy">Creado Por ...</option>');
            $('.selField').append('<option value="Modified">Modificado en</option>');
            $('.selField').append('<option value="ModifiedBy">Modificado por </option>');
        break;
        case 'Sleep_Registro_Paciente':
            $('.selField').append('<option value="Nombre">Nombre</option>');
            $('.selField').append('<option value="Apellidos">Apellidos</option>');
            $('.selField').append('<option value="Fecha">Fecha</option>');
            $('.selField').append('<option value="Plan_Medico">Plan Medico</option>');
            $('.selField').append('<option value="Procedimiento">Procedimiento</option>');
            $('.selField').append('<option value="Otro_Procedimiento">Otro Procedimiento</option>');
            $('.selField').append('<option value="Referido">Referido</option>');
            $('.selField').append('<option value="Created">Creado en</option>');
            $('.selField').append('<option value="CreatedBy">Creado Por ...</option>');
            $('.selField').append('<option value="Modified">Modificado en</option>');
            $('.selField').append('<option value="ModifiedBy">Modificado por </option>');
        break;
        case 'Sleep_Valores_Criticos':
            $('.selField').append('<option value="Tecnico">Tecnico</option>');
            $('.selField').append('<option value="Fecha">Fecha</option>');
            $('.selField').append('<option value="Num_Paciente">Num. Paciente</option>');
            $('.selField').append('<option value="Valor_Critico">Valor Critico</option>');
            $('.selField').append('<option value="ReportadoA">Reportado a</option>');
            $('.selField').append('<option value="Accion">Accion</option>');
            $('.selField').append('<option value="Fecha_Reportado">Fecha Reportado</option>');
            $('.selField').append('<option value="Created">Creado en</option>');
            $('.selField').append('<option value="CreatedBy">Creado por</option>');
            $('.selField').append('<option value="Modified">Modificado en</option>');
            $('.selField').append('<option value="ModifiedBy">Modificado por</option>');
        break;        
        case 'Sleep_CPAP_Prestados':
            $('.selField').append('<option value="Num_Expediente">Num. Expediente</option>');
            $('.selField').append('<option value="Telefono">Telefono</option>');
            $('.selField').append('<option value="Fecha_Prestado">Fecha Prestado</option>');
            $('.selField').append('<option value="Fecha_Entrega">Fecha Entrega</option>');
            $('.selField').append('<option value="Pago">Pago</option>');
            $('.selField').append('<option value="Tecnico_Recibe">Tecnico Recibe</option>');
            $('.selField').append('<option value="Fecha_Recibo">Fecha Recibo</option>');
            $('.selField').append('<option value="Desinfectado">Desinfectado</option>');
            $('.selField').append('<option value="Fecha_Desinfectado">Fecha Desinfectado</option>');
            $('.selField').append('<option value="Equipo">Equipo</option>');
            $('.selField').append('<option value="Created">Creado en</option>');
            $('.selField').append('<option value="CreatedBy">Creado por</option>');
            $('.selField').append('<option value="Modified">Modificado en</option>');
            $('.selField').append('<option value="ModifiedBy">Modificado por</option>');
        break;        
        case 'Sleep_Comunicacion':
            $('.selField').append('<option value="Tecnico">Tecnico</option>');
            $('.selField').append('<option value="Equipo">Equipo</option>');
            $('.selField').append('<option value="Fecha_Entrega">Fecha Entrega</option>');
            $('.selField').append('<option value="Situacion">Situacion</option>');
            $('.selField').append('<option value="Created">Creado en</option>');
            $('.selField').append('<option value="CreatedBy">Creado por</option>');
            $('.selField').append('<option value="Modified">Modificado en</option>');
            $('.selField').append('<option value="ModifiedBy">Modificado por</option>');
        break;        
        case 'Sleep_Rechazo':
            $('.selField').append('<option value="Nombre">Nombre</option>');
            $('.selField').append('<option value="Visit_ID">Visit ID</option>');
            $('.selField').append('<option value="Fecha">Fecha</option>');
            $('.selField').append('<option value="Razon">Razon</option>');
            $('.selField').append('<option value="Tecnico">Tecnico</option>');
            $('.selField').append('<option value="Created">Creado en</option>');
            $('.selField').append('<option value="CreatedBy">Creado por</option>');
            $('.selField').append('<option value="Modified">Modificado en</option>');
            $('.selField').append('<option value="ModifiedBy">Modificado por</option>');
        break;        
        case 'Sleep_Endozime':
            $('.selField').append('<option value="Fecha_Preparacion">Fecha Preparacion</option>');
            $('.selField').append('<option value="Fecha_Expira">Fecha Expira</option>');
            $('.selField').append('<option value="Temperatura">Temperatura</option>');
            $('.selField').append('<option value="Razon">Razon</option>');
            $('.selField').append('<option value="Tecnico">Tecnico</option>');
            $('.selField').append('<option value="Created">Creado en</option>');
            $('.selField').append('<option value="CreatedBy">Creado por</option>');
            $('.selField').append('<option value="Modified">Modificado en</option>');
            $('.selField').append('<option value="ModifiedBy">Modificado por</option>');
        break;        
        case 'Sleep_Ojos':
            $('.selField').append('<option value="Fecha_Expira">Fecha Expira</option>');
            $('.selField').append('<option value="Tecnico">Tecnico</option>');
            $('.selField').append('<option value="Created">Creado en</option>');
            $('.selField').append('<option value="CreatedBy">Creado por</option>');
            $('.selField').append('<option value="Modified">Modificado en</option>');
            $('.selField').append('<option value="ModifiedBy">Modificado por</option>');
        break;        
        case 'Sleep_ETCO':
            $('.selField').append('<option value="Fecha_Expira">Fecha Expira</option>');
            $('.selField').append('<option value="Tecnico">Tecnico</option>');
            $('.selField').append('<option value="Created">Creado en</option>');
            $('.selField').append('<option value="CreatedBy">Creado por</option>');
            $('.selField').append('<option value="Modified">Modificado en</option>');
            $('.selField').append('<option value="ModifiedBy">Modificado por</option>');
        break;        
        case 'Sleep_Desinfeccion_CPAP':
            $('.selField').append('<option value="Fecha">Fecha</option>');
            $('.selField').append('<option value="Fecha_Filtro">Fecha Filtro</option>');
            $('.selField').append('<option value="Fecha_Cambio">Fecha Cambio</option>');
            $('.selField').append('<option value="Camas">Camas</option>');
            $('.selField').append('<option value="Tecnico">Tecnico</option>');
            $('.selField').append('<option value="Created">Creado en</option>');
            $('.selField').append('<option value="CreatedBy">Creado por</option>');
            $('.selField').append('<option value="Modified">Modificado en</option>');
            $('.selField').append('<option value="ModifiedBy">Modificado por</option>');
        break;        
        case 'Sleep_Frasco_Cidex':
            $('.selField').append('<option value="Fecha">Fecha</option>');//1
            $('.selField').append('<option value="Temperatura">Temperatura</option>');//2
            $('.selField').append('<option value="Lote_Solucion">Num. de Lote de la Solucion</option>');//3
            $('.selField').append('<option value="Fecha_Abierto_Solucion">Fecha Abierto Solucion</option>');//4
            $('.selField').append('<option value="Fecha_Expira_Solucion">Fecha Expira Solucion</option>');//5
            $('.selField').append('<option value="Lote_Tirillas">Num. de Lote de Tirillas</option>');//6
            $('.selField').append('<option value="Fecha_Abierto_Tirillas">Fecha Abierto frasco de Tirillas</option>');//7
            $('.selField').append('<option value="Fecha_Expira_Tirillas">Fecha de Expiracion Tirillas</option>');//8
            $('.selField').append('<option value="Resultado_Puro1">Resultado Puro1</option>');//9
            $('.selField').append('<option value="Resultado_Puro2">Resultado Puro2</option>');//10
            $('.selField').append('<option value="Resultado_Puro3">Resultado Puro3</option>');
            $('.selField').append('<option value="Resultado_Diluido1">Resultado Diluido1</option>');//12
            $('.selField').append('<option value="Resultado_Diluido2">Resultado Diluido2</option>');
            $('.selField').append('<option value="Resultado_Diluido3">Resultado Diluido3</option>');//14
            $('.selField').append('<option value="Acciones">Acciones</option>');
            $('.selField').append('<option value="Tecnico">Tecnico</option>');//16
            $('.selField').append('<option value="Fecha_Expira_Frasco_Sol">Fecha Expira Frasco Solucion</option>');
            $('.selField').append('<option value="Fecha_Expira_Frasco_Tir">Fecha Expira Frasco Tirillas</option>');//18
            $('.selField').append('<option value="Created">Creado en</option>');
            $('.selField').append('<option value="CreatedBy">Creado por</option>');//20
            $('.selField').append('<option value="Modified">Modificado en</option>');
            $('.selField').append('<option value="ModifiedBy">Modificado por</option>');//22
        break;        
        case 'Sleep_Solucion_Cidex':
            $('.selField').append('<option value="Fecha">Fecha</option>');//1
            $('.selField').append('<option value="Tecnico">Tecnico</option>');//2
            $('.selField').append('<option value="Fecha_abierto">Fecha_abierto</option>');//3
            $('.selField').append('<option value="Lote_Tirillas">Lote_Tirillas</option>');//4
            $('.selField').append('<option value="Fecha_Expira_Solucion">Fecha_Expira_Solucion</option>');//5
            $('.selField').append('<option value="Lote_Tirillas">Lote_Tirillas</option>');//6
            $('.selField').append('<option value="Resultado_Calidad">Resultado_Calidad</option>');//7
            $('.selField').append('<option value="Fecha_Prueba_Calidad">Fecha_Prueba_Calidad</option>');//8
            $('.selField').append('<option value="Probada_por">Probada_por</option>');//9
            $('.selField').append('<option value="Visit_ID">Visit_ID</option>');//10
            $('.selField').append('<option value="Fecha_Comienzo">Fecha_Comienzo</option>');//12
            $('.selField').append('<option value="Fecha_Expiracion">Fecha_Expiracion</option>');
            $('.selField').append('<option value="Fecha_Prueba_Solucion">Fecha_Prueba_Solucion</option>');//14
            $('.selField').append('<option value="Resultado_Solucion">Resultado_Solucion</option>');//15
            $('.selField').append('<option value="Temperatura">Temperatura</option>');
            $('.selField').append('<option value="Ausencia_Turbidez">Ausencia_Turbidez</option>');//17
            $('.selField').append('<option value="Ausencia_Materia">Ausencia_Materia</option>');
            $('.selField').append('<option value="Accion">Accion</option>');//19
            $('.selField').append('<option value="Equipo"Equipo</option>');
            $('.selField').append('<option value="Tiempo_inmersion">Tiempo_inmersion</option>');//21
            $('.selField').append('<option value="Liqueo">Liqueo</option>');
            $('.selField').append('<option value="Realizada_por">Realizada_por</option>');//23
            $('.selField').append('<option value="Hora_Inmersion">Hora_Inmersion</option>');//24
            $('.selField').append('<option value="Created">Creado en</option>');
            $('.selField').append('<option value="CreatedBy">Creado por</option>');//26
            $('.selField').append('<option value="Modified">Modificado en</option>');
            $('.selField').append('<option value="ModifiedBy">Modificado por</option>');//28
        break;        
        
        default:
            break;
    }
});

$(document).ready(function(){
    $('#btnBuscar').on('click', function () {
      $('#frmSearch').submit(function() {
        $.ajax({ // create an AJAX call...
        data: $(this).serialize(), // get the form data
        type: $(this).attr('method'), // GET or POST
        url: 'info_details.php', //$(this).attr('action'), // the file to call
        success: function(response) { // on success..
           $('div#resultados').html(response);
        }
        });
         return false; // cancel original event to prevent form submitting
     }); 
   });
});

function ShowHideF(){
    $('#head').toggle();
}

function DoNav(){
    m = $("#mySidebar").width();
    if (m > 0){
        document.getElementById("mySidebar").style.width = "0";
        document.getElementById("main").style.marginLeft= "0";
        // $("#lnk").show();
    }else{
        document.getElementById("mySidebar").style.width = "350px";
        document.getElementById("main").style.marginLeft = "350px";
        // $("#lnk").hide();
    }
}
function openNav() {
    // alert($("#mySidebar").width());
    document.getElementById("mySidebar").style.width = "350px";
    document.getElementById("main").style.marginLeft = "350px";
}

function closeNav() {
    // alert($("#mySidebar").width());
    // $("#lnk").show();
    document.getElementById("mySidebar").style.width = "0";
    document.getElementById("main").style.marginLeft= "0";
}