




$( document ).ready(function() {
    $('#reloj').datetimepicker({
            format: 'hh:mm A'
        });
        
        
         $('#relojfin').datetimepicker({
            format: 'hh:mm A'
        });
});

$('#cursosTable').DataTable({
                    "ordering": false,
                    orderCellsTop: true,
                    fixedHeader: true,
                    "processing": true,
                    "ajax": {
                        "type": "POST",
                        "url": "getInformacionCursos.php"
                    },
                    "columns": [{
                        "data": "conce",
                        "class": "conce-table"
                    }, {
                        "data": "nombreCurso",
                        "class": "nombreCurso-table"
                    }, {
                        "data": "fecha",
                        "class": "fecha-table"
                    },{
                        "data": "horario",
                        "class": "horario-table"
                    },{
                    	 "data": "acciones",
                        "class": "acciones-table"
                    	
                    }],
                    language: {
                        processing: "Procesando...",
                        search: "Busqueda&nbsp;:",
                        lengthMenu: "Mostar _MENU_ registros",
                        info: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                        infoEmpty: "Mostrando registros del 0 al 0 de un total de 0 registros",
                        infoFiltered: "(filtrado de un total de  _MAX_ registros)",
                        infoPostFix: "",
                        loadingRecords: "Cargando...",
                        zeroRecords: "No hay registros que mostrar",
                        emptyTable: "No hay datos disponibles en la tabla",
                        paginate: {
                            first: "Primero",
                            previous: "Anterior",
                            next: "Siguente",
                            last: "Ultimo"
                        },
                        aria: {
                            sortAscending: ": Activar para ordenar la columna de manera ascendente",
                            sortDescending: ": Activar para ordenar la columna de manera descendente"
                        }
                    }
                });  
                

$("#nuevoCursos").click(function(){
   $("#modalNewSession").modal("show"); 
   
});            





$("#gratuitoCheck").change(function(e){
    if( $('#gratuitoCheck').is(':checked') ) {
 
       $("#costoPrecioEstudiante").attr('readonly',true); 
       $("#costoResidentes").attr('readonly',true); 
       $("#costoProfesionales").attr('readonly',true); 
       
     /*  $("#costoPrecioEstudiante").val(0); 
        $("#costoResidentes").val(1); 
       $("#costoProfesionales").val(2); */
    
    }else{
        $("#costoPrecioEstudiante").attr('readonly',false); 
         $("#costoResidentes").attr('readonly',false); 
       $("#costoProfesionales").attr('readonly',false); 
       
       /* $("#costoPrecioEstudiante").val(""); 
         $("#costoResidentes").val(""); 
       $("#costoProfesionales").val("");*/ 
    }
});


$("#generateCurso").click(function(e){
     e.preventDefault();
      var validacionCampos = validarInput('textSessionVirtuales'); 
      if(validacionCampos == 0)
      {
            var statusCosto =  $('#gratuitoCheck').is(':checked') ? 1 : 0;
            
            var url = "guardar_cursos.php"; 
            var parametros=new FormData(document.getElementById("form_curso"));
            parametros.append('freee',statusCosto); 
               $.ajax({
                'type': "POST",
                'url': url,
                'async': true,
                'data': parametros,
                'contentType': false, 
                'processData': false, 
                'dataType': "json",
                success: function (data) {
                console.log(data); 
                    if(data.response == "ok")
                    {
                      alert("pasa")
                    }else{
                      alert("no pasa"); 
                    }
                },
                error: function (r) {
                    alert("Error en el servidor de  de nueva Sesión"); 
                   // toastr.error("Error en el servidor de  de nueva Sesión ");
                }
            });
        
      }else{
          alert("Revisar los campos en rojo"); 
      }
    
});


  function validarInput(classInput) {
        var inputNone = 0;
        $("." + classInput).each(function(indexValidacion, input) {
            if ($(input).val() == '' ||  $(input).length <= 0 ) {
                inputNone++;
                $(this).css("border-color", "#ff3333");
            } else {
                $(this).css("border-color", "#ccc");
            }
        });
        return inputNone;
    }