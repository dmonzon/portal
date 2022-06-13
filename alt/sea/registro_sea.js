

$(document).on("change", "#visitID", function() {
    var v = $('#visitID').val();
    $('#visit').val(v);
});
$(document).on("click", ".visit", function() {
    var v = $('#visitID').val();
    $('#visit').val(v);
});

$(document).ready(function() {
    //onload fill dropdowns
    $('.Situacion1').append('<option value="1">Asistencia Necesidades personales paciente</option>');
    $('.Situacion1').append('<option value="2">Asistencia a RN y/o MD</option>');
    $('.Situacion1').append('<option value="3">Asistencia asuntos de registración</option>');
    $('.Situacion1').append('<option value="4">Asistencia Laboratorio</option>');
    $('.Situacion1').append('<option value="4">Asistencia Radiología</option>');
    $('.Situacion1').append('<option value="5">Información de turno y/o estatus de paciente</option>');
    $('.Situacion1').append('<option value="6">Llamada de retención de paciente</option>');
    $('.Situacion1').append('<option value="7">Manejo de paciente disgustado</option>');
    $('.Situacion1').append('<option value="8">Presentación de Paciente a triage y/o MD</option>');
    $('.Situacion1').append('<option value="9">Gestión de Paciente de abandono</option>');
    $('.Situacion1').append('<option value="10">Localización Reubicación y/o traslado de pacientes</option>');
    $('.Situacion1').append('<option value="11">VIP</option>');
    $('.Situacion1').append('<option value="12">Otro</option>');

    // $('#visitID').on('change',function(
    //     $('#visit').val($('#visitID').value);
    // // ))
    // $(document).on('change','#visitID',function() {
    //     var v = $('#visit').val();
    //     $('#visit').val(v);
    // ));

    // $("#visitID").change(function() {
    //     var v = $('#visitID').val();
    //     $('#visit').val(v);      
    // });

});
