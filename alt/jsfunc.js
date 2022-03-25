
$(document).on("change", ".rccs", function() {
    var sum = 0;
    $(".rccs").each(function(){
        sum += parseFloat(+$(this).val(),10);
    });
    //alert(commaSeparateNumber(sum));
    $("#total").html(commaSeparateNumber(sum));
    $("#RCCTOT").val(sum);
});

$(document).on("change", ".tcost", function() {
    var sum = 0;
    $(".tcost").each(function(){
        sum += parseFloat(+$(this).val(),10);
    });
    //alert(commaSeparateNumber(sum));
    //$("#total").html(commaSeparateNumber(sum));
    $("#TOTCS").val(sum);
});

$(document).ready(function() {
    $("#btEd").click(function() {
        //get dropdown costcenter info and set cost center values to textboxes
        var cc = $('#costcenter').val();
        
        $('#updCC').val(cc);
        $('#updCCd').val($("#lstCC option[value='" + $("#costcenter").val() + "']").attr("label"));
        $('#ccEdit').css("visibility", "visible").html($('#ddCC').val()).show();
        $('#ccNew').css("visibility", "hidden");
    });
    $("#btNw").click(function() {
        $('#ccNew').css("visibility", "visible");
        $('#ccEdit').css("visibility", "hidden");
    });

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

function updCCdata(data) {
    var e = document.getElementById("costcenter");
    var strUser = e.value;
    if(strUser>0){
        $('#ccDesc').val($("#costcenter").val());
        $('#lblCC').html(e.options[e.selectedIndex].text);
        //show edit button
        $('#btEd').css("visibility", "visible");
        $('.btnNewCC').attr('href','./chooseCC.php?cid=' + $("#costcenter").val());
        //hide plus or new button
        $('#ccEdit').css("visibility", "hidden");
    }else{
        $('#btEd').css("visibility", "hidden");
    }
}

function hideLbl(){
    $('#lblMain').css("visibility", "hidden");
    $('#lblReporte').css("visibility", "hidden");
}

