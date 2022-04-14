$('#tableComprobantes').DataTable({
                    "ordering": false,
                    orderCellsTop: true,
                    fixedHeader: true,
                    "processing": true,
                    "ajax": {
                        "type": "POST",
                        "url": "getInformacionComprobantes.php"
                    },
                    "columns": [{
                        "data": "conce",
                        "class": "conce-table"
                    }, {
                        "data": "nombre",
                        "class": "nombre-table"
                    }, {
                        "data": "curso",
                        "class": "curso-table"
                    },{
                        "data": "estatus",
                        "class": "estatus-table"
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
                
                
                
    function ModalConfirmacion(idCursoRegistrado,statusCambio)
    {
     
       $('#exampleModalConfirmacion').modal('show');  
        if(statusCambio == 1 ) {
          $("#palabraText").html("Aceptar");
        }else{
          $("#palabraText").html("Rechazar");
        } 
        
        $("#idRegistroMod").val(idCursoRegistrado); 
        $("#statusMod").val(statusCambio); 
 
    }
                
                
                
                
    function cambioEstatus(){
        var idCursoRegistrado =  $("#idRegistroMod").val(); 
        var statusCambio = $("#statusMod").val(); 
        var data      = {
                            'idSession': idCursoRegistrado,
                            'statusCambio': statusCambio,
                          }
          $.ajax({
            async:true,
            type:"POST",
            dataType:"json", 
            url:"cambioEstatusRegistro.php",
            data:data,
            success : function(data){
               if(data.response == "ok")
               {
               //  toastr.success(data.message);
                  alert(data.message); 
                 $("#tableComprobantes").DataTable().ajax.reload(null,false);
                 $("#idRegistroMod").val(""); 
                 $("#statusMod").val(""); 
                 $('#exampleModalConfirmacion').modal('hide'); 
                 //window.open('aplication/excel/reportesesion.php?idSession='+idSession, '_blank');  
               }else{
                   alert(data.message); 
                // toastr.error(data.message);
               }
            },
             timeout: 100000,
            error: function(data) {
                toastr.error('Error del servidor en ver la  session');
            }
            
          }); 
    }   
    
    
    function cerrarModal()
    {
        $("#idRegistroMod").val(""); 
        $("#statusMod").val("");  
        $('#exampleModalConfirmacion').modal('hide'); 
    }
    
    
    
  /*  function  descagarArchivo(idSession)
    {
        var data      = {
                            'idSession': idCursoRegistrado,
                          }
          $.ajax({
            async:true,
            type:"POST",
            dataType:"json", 
            url:"imprimirComprobante.php",
            data:data,
            success : function(data){
               if(data.response == "ok")
               {
               //  toastr.success(data.message);
                  alert(data.message); 
                 $("#tableComprobantes").DataTable().ajax.reload(null,false);
                 //window.open('aplication/excel/reportesesion.php?idSession='+idSession, '_blank');  
               }else{
                   alert(data.message); 
                // toastr.error(data.message);
               }
            },
             timeout: 100000,
            error: function(data) {
                toastr.error('Error del servidor en ver la  session');
            }
            
          });    
        
        
    }*/