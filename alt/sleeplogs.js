$(document).ready(function() {
    $(".cambia").click(function() {
        //esconder todos DIVs
        $(".content").hide();
        //obtener nombre del enlace
        nombre = $(this).attr("label");
        //mostrar el panel segun el nombre del enlace oprimido
        $("#" + nombre).show();
    });
});


function sortTabla(tabla,columnName){
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

$(document).on('change','#tb',function(){
    $('#txtValue').val('');
    $('#txtValue2').val('');
    $('#txtValue3').val('');
    
    v = this.value;
    $('.selField').empty();
    //añadir opciones a los dropdowns
    switch (v) {
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
            $('.selField').append('<option value="Oxigeno">Metro de Oxígeno</option>');
            $('.selField').append('<option value="Intercome">Intercome</option>');
            $('.selField').append('<option value="PC">PC</option>');
            $('.selField').append('<option value="Transcutaneo">Transcutaneo</option>');
            $('.selField').append('<option value="ETCO">ETCO2</option>');
            $('.selField').append('<option value="Accion_Tomada">Accion Tomada</option>');
            $('.selField').append('<option value="Iniciales_Tecnico">Iniciales del Tecnico</option>');
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
            $('.selField').append('<option value="Paciente">Nombre</option>');
            $('.selField').append('<option value="Visit_ID">Visit ID</option>');
            $('.selField').append('<option value="Fecha">Fecha</option>');
            $('.selField').append('<option value="Pasos_Adaptacion">Pasos de adaptación</option>');
            $('.selField').append('<option value="Firmado">Firmó documento?</option>');
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
            $('.selField').append('<option value="Departamento">Departamento</option>');//2
            $('.selField').append('<option value="Fecha_abierto">Fecha abierto</option>');//3
            $('.selField').append('<option value="No_usar_despues">Fecha de no usar despues de...</option>');//4
            $('.selField').append('<option value="Lote_Tirillas">Lote de Tirillas</option>');//6
            $('.selField').append('<option value="Resultado_Calidad">Resultado de Calidad</option>');//7
            $('.selField').append('<option value="Fecha_Prueba_Calidad">Fecha de Prueba de Calidad</option>');//8
            $('.selField').append('<option value="Probada_por">Probada por</option>');//9
            $('.selField').append('<option value="Visit_ID">Visit ID</option>');//10
            $('.selField').append('<option value="Fecha_Comienzo">Fecha de Comienzo</option>');//12
            $('.selField').append('<option value="Fecha_Expiracion">Fecha de Expiracion</option>');
            $('.selField').append('<option value="Fecha_Prueba_Solucion">Fecha de la prueba de la solucion</option>');//14
            $('.selField').append('<option value="Resultado_Solucion">Resultado Solucion</option>');//15
            $('.selField').append('<option value="Temperatura">Temperatura</option>');
            $('.selField').append('<option value="Ausencia_Turbidez">Ausencia Turbidez</option>');//17
            $('.selField').append('<option value="Ausencia_Materia">Ausencia Materia</option>');
            $('.selField').append('<option value="Accion">Accion</option>');//19
            $('.selField').append('<option value="Equipo">Equipo</option>');
            $('.selField').append('<option value="Fecha_Inmersion">Fecha de Inmersion</option>');//21
            $('.selField').append('<option value="Tiempo_inmersion">Tiempo_inmersion</option>');//21
            $('.selField').append('<option value="Liqueo">Liqueo</option>');
            $('.selField').append('<option value="Realizada_por">Realizada por</option>');//23
            $('.selField').append('<option value="Hora_Inmersion">Hora de Inmersion</option>');//24
            $('.selField').append('<option value="Created">Creado en</option>');
            $('.selField').append('<option value="CreatedBy">Creado por</option>');//26
            $('.selField').append('<option value="Modified">Modificado en</option>');
            $('.selField').append('<option value="ModifiedBy">Modificado por</option>');//28
        break;        
        case 'Sleep_Comunicacion_HSAT':
            $('.selField').append('<option value="Fecha">Fecha y Hora de llamada</option>');
            $('.selField').append('<option value="Nombre_Paciente">Nombre del Paciente</option>');
            $('.selField').append('<option value="Llama_al_centro">Persona que llama al centro</option>');
            $('.selField').append('<option value="Num_Identificacion">Numero de identificación del dispositivo</option>');
            $('.selField').append('<option value="Asunto">Asunto identificado o problema con el equipo</option>');
            $('.selField').append('<option value="Solucion">Recomendación brindada al paciente</option>');
            $('.selField').append('<option value="Tecnico">Tecnico</option>');
            $('.selField').append('<option value="Created">Creado en</option>');
            $('.selField').append('<option value="CreatedBy">Creado por</option>');
            $('.selField').append('<option value="Modified">Modificado en</option>');
            $('.selField').append('<option value="ModifiedBy">Modificado por</option>');
        break;  
        case 'Sleep_Registro_HSAT':
            $('.selField').append('<option value="Visit_id">Visit ID</option>');
            $('.selField').append('<option value="Fecha">Fecha y Hora de llamada</option>');
            $('.selField').append('<option value="Nombre_Paciente">Nombre del Paciente</option>');
            $('.selField').append('<option value="Equipo">Tipo de equipo prestado</option>');
            $('.selField').append('<option value="Fecha_Devolucion">Fecha y Hora de devolución del equipo</option>');
            $('.selField').append('<option value="Inspeccion">Inspeccion de rutina</option>');
            $('.selField').append('<option value="Comentarios">Comentarios</option>');
            $('.selField').append('<option value="Tecnico">Nombre del tecnico</option>');
            $('.selField').append('<option value="Created">Creado en</option>');
            $('.selField').append('<option value="CreatedBy">Creado por</option>');
            $('.selField').append('<option value="Modified">Modificado en</option>');
            $('.selField').append('<option value="ModifiedBy">Modificado por</option>');
        break;  
        case 'Sleep_HSAT':            
            $('.selField').append('<option value="Fecha">Fecha de desinfección</option>');
            $('.selField').append('<option value="Modelo">Modelo</option>');
            $('.selField').append('<option value="Tecnico">Nombre del Técnico</option>');
            $('.selField').append('<option value="Created">Creado en</option>');
            $('.selField').append('<option value="CreatedBy">Creado por</option>');
            $('.selField').append('<option value="Modified">Modificado en</option>');
            $('.selField').append('<option value="ModifiedBy">Modificado por</option>');
        break;
        case 'Sleep_Biomedica_Equipos':
            $('.selField').append('<option value="Equipo">Equipo</option>');
            $('.selField').append('<option value="Problema">Problema</option>');
            $('.selField').append('<option value="Reportado">Fecha reportado</option>');
            $('.selField').append('<option value="Reporto">Quién reportó</option>');
            $('.selField').append('<option value="Envio">Fecha del envío</option>');
            $('.selField').append('<option value="Tracking">Número de rastreo</option>');
            $('.selField').append('<option value="Recibido">Quién recibie el equipo</option>');
            $('.selField').append('<option value="Notas">Notas</option>');
            $('.selField').append('<option value="Tecnico">Nombre del biomédico</option>');
            $('.selField').append('<option value="Created">Creado en</option>');
            $('.selField').append('<option value="CreatedBy">Creado por</option>');
            $('.selField').append('<option value="Modified">Modificado en</option>');
            $('.selField').append('<option value="ModifiedBy">Modificado por</option>');
        break; 
        case 'Sleep_Mant_Cap':
            $('.selField').append('<option value="Fecha">Fecha del mantenimiento</option>');
            $('.selField').append('<option value="Equipo">Equipo</option>');
            $('.selField').append('<option value="Notas">Notas</option>');
            $('.selField').append('<option value="Tecnico">Nombre del tecnico</option>');
            $('.selField').append('<option value="Created">Creado en</option>');
            $('.selField').append('<option value="CreatedBy">Creado por</option>');
            $('.selField').append('<option value="Modified">Modificado en</option>');
            $('.selField').append('<option value="ModifiedBy">Modificado por</option>');
        break; 
        case 'Sleep_Mant_Equipos':
            $('.selField').append('<option value="Fecha">Fecha del mantenimiento</option>');
            $('.selField').append('<option value="Equipos">Equipo</option>');
            $('.selField').append('<option value="Notas">Notas</option>');
            $('.selField').append('<option value="Tecnico">Nombre del tecnico</option>');
            $('.selField').append('<option value="Created">Creado en</option>');
            $('.selField').append('<option value="CreatedBy">Creado por</option>');
            $('.selField').append('<option value="Modified">Modificado en</option>');
            $('.selField').append('<option value="ModifiedBy">Modificado por</option>');
        break; 
        case 'Sleep_Mant_HA':
            $('.selField').append('<option value="Fecha">Fecha del mantenimiento</option>');
            $('.selField').append('<option value="Headbox">Headbox</option>');
            $('.selField').append('<option value="Cama1">Cama</option>');
            $('.selField').append('<option value="Amplificadores">Amplificadores</option>');
            $('.selField').append('<option value="Cama2">Cama</option>');
            $('.selField').append('<option value="Notas">Notas</option>');
            $('.selField').append('<option value="Tecnico">Nombre del tecnico</option>');
            $('.selField').append('<option value="Created">Creado en</option>');
            $('.selField').append('<option value="CreatedBy">Creado por</option>');
            $('.selField').append('<option value="Modified">Modificado en</option>');
            $('.selField').append('<option value="ModifiedBy">Modificado por</option>');
        break; 
        case 'Sleep_Mant_PAP':
            $('.selField').append('<option value="Fecha">Fecha del mantenimiento</option>');
            $('.selField').append('<option value="Equipo">Equipo</option>');
            $('.selField').append('<option value="Cama">Cama</option>');
            $('.selField').append('<option value="Notas">Notas</option>');
            $('.selField').append('<option value="Tecnico">Nombre del tecnico</option>');
            $('.selField').append('<option value="Created">Creado en</option>');
            $('.selField').append('<option value="CreatedBy">Creado por</option>');
            $('.selField').append('<option value="Modified">Modificado en</option>');
            $('.selField').append('<option value="ModifiedBy">Modificado por</option>');
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

    $('.btnEdit').on('click', function () {
        id = this.id;
        // alert(id);
        $('.sp'+id).hide();
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
    document.getElementById("mySidebar").style.width = "350px";
    document.getElementById("main").style.marginLeft = "350px";
}

function closeNav() {
    document.getElementById("mySidebar").style.width = "0";
    document.getElementById("main").style.marginLeft= "0";
}