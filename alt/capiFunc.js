
$(document).on("change", ".capi", function() {
    var sum = 0; 
    $(".capi").each(function(){
        sum += parseFloat(+$(this).val(),10);
    });
    $("#TotalCapitados").val(sum);
});

$(document).on("change", ".pago", function() {
    var sum = 0;
    $(".pago").each(function(){
        sum += parseFloat(+$(this).val(),10);
    });
    $("#TotalPagos").val(sum);
});

$(document).on("change", ".total", function() {
    // alert('hola');
    if($("#TotalPagos").val() >= 0 && $("#TotalCapitados").val() >= 0)
        $('#btnSometer').prop('disabled', false);
});

$(document).ready(function() {
    //on submit form to edit CC description via ajax
    $(function(){
    $('#editCC').submit(function(e){
        e.preventDefault();
        var form = $(this);
        var post_url = form.attr('action');
        var post_data = form.serialize();
        $('#editCC', form).html('<center><img src="1487.gif" /></center>       Please wait...');
        $.ajax({
            type: 'POST',
            url: post_url, 
            data: post_data,
            success: function(msg) {
                $(form).fadeOut(800, function(){
                    form.html(msg).fadeIn().delay(5000);
                });
                location.reload();
            }
        });
    });
    });

});
$(document).ready(function() {
    //on submit form to create cost center
    $(function(){
    $('#nuevoCC').submit(function(e){
        e.preventDefault();
        var form = $(this);
        var post_url = form.attr('action');
        var post_data = form.serialize();
        // alert("sometiendo");
        $('#nuevoCC', form).html('<center><img src="1487.gif" /></center>       Please wait...');
        $.ajax({
            type: 'POST',
            url: post_url, 
            data: post_data,
            success: function(msg) {
                $(form).fadeOut(800, function(){
                    form.html(msg).fadeIn().delay(5000);
                });
                location.reload();
            }
        });
    });
    });
});

function updTotRCC(data){
    var rtc = 0;
    //alert(data.value);
    if ($("#TOTCS").val() > 0 && $("#TOTCH").val() > 0) {
        rtc = $("#TOTCS").val() / $("#TOTCH").val();
        $("#total").html(commaSeparateNumber(rtc));
        $("#RCCTOT").val(rtc);
    }
}

function commaSeparateNumber(val){
    //convert to currency format  with , an decimal
    while (/(\d+)(\d{3})/.test(val.toString())){
    val = val.toString().replace(/(\d+)(\d{3})/, '$1'+','+'$2');
    }
    return val;
};


