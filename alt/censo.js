/*****************************************************************************************/
//actualizar totales del empleado seleccionado y el anterior al hacer click en el dropbox
$(document).on("click", ".ddman", function() {
  var ddl = $(this);
  var id = $(this).attr('id');
  var previous = ddl.data('previous');
  var dval = $(this).val();
  ddl.data('previous', ddl.val());
  sum = totRevision(dval);
  $('#revi' + dval).val(sum);
  if(ddl != previous) {
    sum = totRevision(previous);
    $('#revi' + previous).val(sum);
  }
});

$(document).on("click", ".ddplan", function() {
  var dd2 = $(this);
  var id = $(this).attr('id');
  var previous = dd2.data('previous');
  var dval = $(this).val();
  dd2.data('previous', dd2.val());
  sum = totPlanificacion(dval);
  $('#plan' + dval).val(sum);
  if(dd2 != previous) {
    sum = totPlanificacion(previous);
    $('#plan' + previous).val(sum);
  }
});
/*****************************************************************************************/
/*****************************************************************************************/
/********************************************************************************/
////////////////// funcion para actualizar los totales de revision////////////////
/********************************************************************************/
function totRevision(dval) {
  sum = 0;
  $('.ddman').each(function() {
    var selected = $(this)[0].value;
    var ddid = $(this)[0].id;
    var idn = ddid.substring(0,10);
    let id =  ddid.substring(10, ddid.length);
    if (selected == dval) {
      if(idn == 'manejadora') sum += parseFloat(+$('#qtya' + id).val());
      if(idn == 'manejadorb') sum += parseFloat(+$('#qtyb' + id).val());
    }
  })
  return sum;
}
/********************************************************************************/
///////////// funcion para actualizar los totales de planificacion////////////////
/********************************************************************************/
function totPlanificacion(dval) {
  sum = 0;
  $('.ddplan').each(function() {
    var selected = $(this)[0].value;
    var ddid = $(this)[0].id;
    var idn = ddid.substring(0,13);
    let id =  ddid.substring(13, ddid.length);
    if (selected == dval) {
      if(idn == 'planificadora') sum += parseFloat(+$('#qtyc' + id).val());
      if(idn == 'planificadorb') sum += parseFloat(+$('#qtyd' + id).val());
    }
  })
  return sum;
}

$(document).on("change", ".manejador", function() {
    var sum = $(this).val();
    var but = $(this).attr('id');
    let id = but.substring(4, but.length);
    let idn = but.substring(0, 4);
    let hid = $('#hid' + id).attr('value');

    ///////////////////////////////////////////////////////////////////////// calc ///////////////////////////////////////////////////////////////////////
    //////////////////////////////////////// Cuadra la cantidad de pacientes con relacion al total de pacientes //////////////////////////////////////////
    /////////////////////////////////////// (cantidad pacientes manejador 1) = (total de pacientes) - (cant. pacientes manejador 2) //////////////////////
     
    if (idn == 'qtyb') {
      let dd1 = $('#manejadorb' + id).val();
      $('#qtya' + id).val(hid - sum);

      var dd2 = $('#manejadora' + id).val();
      tot = totRevision(dd2);
      $('#revi' + dd2).val(tot);
      tot = totRevision(dd1);
      $('#revi' + dd1).val(tot);
    }
    if (idn == 'qtya') {
      let dd1 = $('#manejadora' + id).val();
      tot = totRevision(dd1);
      $('#revi' + dd1).val(tot);

      let dd2 = $('#manejadorb' + id).val();
      if(dd2 > 0){
        $('#qtyb' + id).val(hid - sum);
      }
      tot = totRevision(dd2);
      $('#revi' + dd2).val(tot);
    }
    //*******************************************************************************************************************************************************
    /////////////////////////////////////////////////////// set pacient value to change circle to red ////////////////////////////////////////////////////
    // Rango manejador de casos (25-30) Verde < 25 / Amarillo(25-30) / Rojo > 30
    // Rango Planificador - (40-50) Verde < 40 / Amarillo(40-50) / Rojo > 50
    //*******************************************************************************************************************************************************
    $minPacientes = 25;
    $maxPacientes = 30;
    if($(this).val() > $maxPacientes){
      $(this).css("background-color", "red");
      $(this).css("color", "white");
    }
    if($(this).val() >= $minPacientes && $(this).val() <= $maxPacientes) {
      $(this).css("background-color", "gold"); 
      $(this).css("color", "black");
    }
    if($(this).val() < $minPacientes) {
      $(this).css("background-color", "white");
      $(this).css("color", "black");
    }
    setCircle(id);
});

//*******************************************************************************************************************************************************
//*************************** asignar el color del circulo **********************************************************************************************
//*******************************************************************************************************************************************************
function setCircle(id){
  var qty = $('#qtya' + id).val();
  $minPacientes = 25;
  $maxPacientes = 30;
  if(qty > $maxPacientes){
    $('#circle'+id).css("background-color", "red");
    $('#qtya' + id).css("background-color", "red");
    $('#qtya' + id).css("color", "white");
  }
  if(qty >= $minPacientes && qty <= $maxPacientes) {
    $('#circle'+id).css("background-color", "gold");
    $('#qtya' + id).css("background-color", "gold"); 
    $('#qtya' + id).css("color", "black");
  }
  if(qty < $minPacientes && qty > 0 ) {
    $('#circle'+id).css("background-color", "green");
    // $('#qtya' + id).css("background-color", "white");
    // $('#qtya' + id).css("color", "black");
  }
  if(qty < 1 ) {
   $('#circle'+id).css("background-color", "lightgray");
  //  $('#qtya' + id).css("background-color", "white");
  //  $('#qtya' + id).css("color", "black");
  }
}

$(document).on("change", ".planificador", function() {
  var qty = $(this).val();
  var but = $(this).attr('id');
  let id = but.substring(4, but.length);
  let idn = but.substring(0, 4);
  let hid = $('#hid' + id).attr('value');
  $minPacientes = 40;
  $maxPacientes = 50;
  
  /***********************************************************************************/
  // obtener num de empleado y llamar funcion para actualizar total de planificacion //
  /***********************************************************************************/
  if(qty > $maxPacientes){
    $(this).css("background-color", "red");
    $(this).css("color", "white");
    console.log('qty mayor = ' + qty);
  }
  if(qty >= $minPacientes && qty <= $maxPacientes) {
    $(this).css("background-color", "gold"); 
    $(this).css("color", "black");
    console.log('qty entre = ' + qty);
  }
  if(qty < $minPacientes && qty > 0 ) {
    $(this).css("background-color", "white");
    $(this).css("color", "black");
    console.log('qty entre 0 = ' + qty);
  }

  if (idn == 'qtyc') {
    let dd1 = $('#planificadora' + id).val();
    $('#qtyd' + id).val(hid - qty);

    var dd2 = $('#planificadorb' + id).val();
    tot = totPlanificacion(dd2);
    $('#plan' + dd2).val(tot);
    tot = totPlanificacion(dd1);
    $('#plan' + dd1).val(tot);
  }

  if (idn == 'qtyd') {
    let dd1 = $('#planificadorb' + id).val();
    tot = totPlanificacion(dd1);
    $('#plan' + dd1).val(tot);

    let dd2 = $('#planificadora' + id).val();
    if(dd2 > 0){
      $('#qtyc' + id).val(hid - qty);
    }
    tot = totPlanificacion(dd2);
    $('#plan' + dd2).val(tot);
  }
});

function myFunction() {
    var x = document.getElementById("enabler");
    //element.classList.toggle("mystyle");
    if (x.style.display === "white") {
        x.style.display = "block";
      } else {
        x.style.display = "white";
      }
}

$(document).ready(function() {
    $("#EmpEnabled").click(function() {
        var x = document.getElementById("enabler");
        if (x.style.display === "white") {
          x.style.display = "block";
        } else {
          x.style.display = "white";
        }
    });

    $(".editar").click(function() {
      var eid = $(this).attr("data-btnid");
      var n = $(this).attr("data-eName");
      var a = $(this).attr("data-eActive");
      $("#hempid").val(eid);
      $("#ename").val(n);
      a == 1 ? $('input:radio[name=eactive]')[0].checked = true : $('input:radio[name=eactive]')[1].checked = true;
    });

    $(document).on('click','.salvar',function(e) {
      var empid = $('#hempid').val();
      var ename = $('#ename').val();
      var eactive = $("input[name='eactive']:checked").val();
      var opt = $('#opta').val();
      // var nombre = $("#frmE").serialize();
      $.ajax({
        type:'POST',
        url: "employees.php",
        dataType: "json",
        data: {empid:empid,eactive:eactive,ename:ename},
          success: function(dataResult){
                  var dataResult = JSON.parse(dataResult);
                  if(dataResult.statusCode=='ok'){
                      //$('#editEmployeeModal').modal('hide');
                      alert('Data updated successfully !'); 
                      location.reload();						
                  }
                  else if(dataResult.statusCode=='error'){
                     alert(dataResult);
                  }
          }
      });
  });

  $(document).on('click','.actual',function() {
    let empid = this.id.substring(3,this.id.length);
    //alert(empid);
    var ename = $('#nombre'+empid).val();
    var eactive = $("input[name='eactive"+empid+"']:checked").val();
    // var nombre = $("#frmE"+empid).serialize();
    $.ajax({
      type:'POST',
      url: "employees.php",
      dataType: "json",
      data: {empid:empid,eactive:eactive,ename:ename},
        success: function(dataResult){
                var dataResult = JSON.parse(dataResult);
                if(dataResult.statusCode=='ok'){
                    //$('#editEmployeeModal').modal('hide');
                    // alert('Data updated successfully !'); 
                    //location.reload();						
                }
                else if(dataResult.statusCode=='error'){
                    alert(dataResult);
                }
        }
    });
  });

  $(document).on('click','.register',function() {
    var desde = $('#desde').val();
    // alert(desde);
    var hasta = $('#hasta').val();
    var opt = $('#optb').val();
    // alert(hasta);
    // var nombre = $("#frmEAu").serialize();
    var auid = $('#auid option:selected').val();
    // console.log(auid);
    var empida = $('#empida option:selected').val();
    // var empid = 
    $.ajax({
      type:'POST',
      url: "employees.php",
      dataType: "json",
      data: {desde:desde,hasta:hasta,auid:auid,empida:empida,opt:opt},
        success: function(dataResult){
                var dataResult = JSON.parse(dataResult);
                if(dataResult.statusCode=='ok'){
                    //$('#editEmployeeModal').modal('hide');
                    //alert('Data updated successfully !'); 
                    location.reload();						
                }
                else if(dataResult.statusCode=='error'){
                   //alert(dataResult);
                }
        }
    });
});

$(document).ready(function () {
  $('#desde').on('change', function() { 
    var datearray = $('#desde').val();
    $('#hasta').attr('min',datearray);
  });
});
});

