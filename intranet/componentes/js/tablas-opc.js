/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function() {
    $('#button-js').click(function () {
    var data = table.rows( {selected:true} ).data();
    var newarray=[];    
    var nombre=[];
    var division=[];
        for (var i=0; i < data.length ;i++){
           newarray.push(data[i][0]);
           nombre.push(data[i][1]);
           if (data[i].length > 1 ){               
               division.push(data[i][2]);               
           }
        }

    var sData = newarray.join();
    var arrayF = sData.split(',');
    var nombre1 = nombre.join();  
    var nombre2 = nombre1.split(',');    
    if (division.length > 0){
       var div1 = division.join();       
       var div2 = div1.split(',');       
    }
    
    document.getElementById("oculto").innerHTML = "<input type='hidden' name='is' id='is1' value='"+arrayF+"'><input type='hidden' name='noms' value='"+nombre2+"'>";
    if (div2.length > 0){
       document.getElementById("oculto").innerHTML = document.getElementById("oculto").innerHTML + "<input type='hidden' name='divs' value='"+div2+"'>";
    } //Agrega las divisiones en caso de existir
    } );

    //Inicializa la tabla 
    if (document.getElementById("cxp")){
    var table = $('#vt3').DataTable( {
        responsive: true,
        lengthChange: false,
        scrollX: true,
        select: {style: 'multi'},
        dom: 'Bfrtlip',
        buttons: [ 'copy', 'excel', 'pdf' ],
        "columnDefs": [
            {
                "targets": [ 2 ],
                "visible": false,
                "searchable": false
            }
        ]       
    });}
    else if (document.getElementById('cxxdet')){
        var table = $('#vt3').DataTable( {
        responsive: true,
        lengthChange: false,
        scrollX: true,
        select: {style: 'multi'},
        dom: 'Bfrtlip',
        buttons: [ 'copy', 'excel', 'pdf' ],
        "columnDefs": [
            { "visible": false, "targets": 1 }
        ],
        "order": [[ 1, 'asc' ]],
        "displayLength": 25,
        "drawCallback": function ( settings ) {
            var api = this.api();
            var rows = api.rows( {page:'current'} ).nodes();
            var last=null;
 
            api.column(1, {page:'current'} ).data().each( function ( group, i ) {
                if ( last !== group ) {
                    $(rows).eq( i ).before(
                        '<tr class="group"><td colspan="7">'+group+'</td></tr>'
                    );
 
                    last = group;
                }
            } );
        }


    });

    } //Si esta definida la tabla de CxC o CxP en detalle*/
    
    else{
    var table = $('#vt3').DataTable( {
        responsive: true,
        lengthChange: false,
        scrollX: true,
        select: {style: 'multi'},
        dom: 'Bfrtlip',
        buttons: [ 'copy', 'excel', 'pdf' ]        

    });}

    

    // Order by the grouping
    $('#vt3 tbody').on( 'click', 'tr.group', function () {
      if (document.getElementById('cxxdet')){          
        var currentOrder = table.order()[0];
        if ( currentOrder[0] === 1 && currentOrder[1] === 'asc' ) {
            table.order( [ 1, 'desc' ] ).draw();
        }
        else {
            table.order( [ 1, 'asc' ] ).draw();
        }
      }  
    } );


    table.buttons().container()
        .appendTo( '#vt3_wrapper .col-sm-6:eq(0)' );
});

function inicializatabla(){
   var table = $('#vt4').DataTable( {
        responsive: true,
        lengthChange: false,
        scrollX: true,
        select: {style: 'multi'},
        dom: 'Bfrtlip',
        buttons: [ 'copy', 'excel', 'pdf' ]
    });
    table.buttons().container()
        .appendTo( '#vt4_wrapper .col-sm-6:eq(0)' );
};

function PreSubmit(miform){
    /*var x;
    x = document.getElementById("is1").value;
    if (x == "") {
        alert("Enter a Valid Roll Number");
        return false;
    };*/

    if (miform.is === undefined || miform.is.value === "0" || miform.is.value === "") {
        alert("Debe seleccionar un valor para continuar. Si ya seleccionó un valor,intente de nuevo.");
        return false;
    } else if (miform.is != undefined || miform.is.value != "") { 
        return true; 
    }
}