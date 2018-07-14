<?php
function facventa($datos){
    foreach ($datos[0] as $item){

?>
<html>
    <header>
        <title>Factura de Venta</title>
    </header>
    <body>
            <div class="table-responsive">
            <table class="table table-responsive table-hover table-condensed">
                <tbody>
                    <tr>
                        <th colspan="8">
                            <h2 colspan="8">FACTURA DE VENTA</h2>
                        </th>
                    </tr>
                    <tr>
                        <td colspan="2"><b>Factura</b></td>
                        <td colspan="2"><?php echo $item['FACTURAFISCAL']; ?></td>
                        <td colspan="2"><b>SER:</b></td>
                        <td colspan="2"><?php echo $item['CORRELATIVO']; ?></td>
                    </tr>
                    <tr>
                        <td colspan="2"><b>Fecha de Venta:</b></td>
                        <td colspan="6"><?php echo $item['FECHAVENTA']; ?></td>
                    </tr>
                    <tr>
                        <td colspan="2"><b>Nombre:</b></td>
                        <td colspan="2"><?php echo $item['CLIENTENOMBRE']; ?></td>
                        <td colspan="2"><b>Cédula o RIF: </b></td>
                        <td colspan="2"><?php echo $item['CLIENTERIF']; ?></td>
                    </tr>
                    <tr>
                        <td colspan="2"><b>Dirección:</b></td>
                        <td colspan="6"><?php echo $item['CLIENTEDIRECCION']; ?></td>
                    </tr>
                </tbody>
            </table>
            </div>
            <div class="table-responsive">
            <table class="table table-hover table-condensed">
                <thead>
                    <tr style='text-align: left;'>
                        <th>Codigo</th>
                        <th>Desripción</th>
                        <th>Asociado</th>
                        <th>Cantidad</th>
                        <th>Precio Unitario</th>
                        <th>Precio Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        foreach ($datos[1] as $item2){
                            echo "<tr>";
                            echo "<td>".$item2['CODIGOPRODUCTO']."</td>
                        <td>".$item2['DESCRIPCION']."</td>
                        <td>".$item2['ASOCIADO']."</td>
                        <td>".$item2['CANTIDAD']."</td>
                        <td>".number_format((float)$item2['UNITARIO'], 2, '.', ',')."</td>
                        <td>".number_format((float)$item2['TOTAL'], 2, '.', ',')."</td>
                    </tr>";}
                            ?>
                    </tbody>
                    </table>
                </div>
            <div class="table-responsive">
            <table class="table table-responsive table-hover table-condensed">
                <tbody>
                    <tr>
                        <th colspan="8">
                            <h4 colspan="8">Formas de Pago:</h2>
                        </th>
                    </tr>
                    <tr>
                        <td colspan="2"><b>Efectivo</b></td>
                        <td colspan="2"><?php echo number_format((float)$item['EFECTIVO'], 2, '.', ','); ?></td>
                        <td colspan="2"><b>Subtotal:</b></td>
                        <td colspan="2"><?php echo number_format((float)$item['SUBTOTAL'], 2, '.', ','); ?></td>
                    </tr>
                    <tr>
                        <td colspan="2"><b>Cheque:</b></td>
                        <td colspan="2"><?php echo number_format((float)$item['CHEQUE'], 2, '.', ','); ?></td>
                        <td colspan="2"><b>Descuento Lineas:</b></td>
                        <td colspan="2"><?php echo "0"; ?></td>
                    </tr>
                    <tr>
                        <td colspan="2"><b>Tarjeta de Débito:</b></td>
                        <td colspan="2"><?php echo number_format((float)$item['TDEBITO'], 2, '.', ','); ?></td>
                        <td colspan="2"><b>Descuentos: </b></td>
                        <td colspan="2"><?php echo "0"; ?></td>
                    </tr>
                    <tr>
                        <td colspan="2"><b>Tarjeta de Crédito:</b></td>
                        <td colspan="2"><?php echo number_format((float)$item['TCREDITO'], 2, '.', ','); ?></td>
                        <td colspan="2"><b>IVA:</b></td>
                        <td colspan="2"><?php echo number_format((float)$item['MONTOIVA'], 2, '.', ','); ?></td>
                    </tr>
                    <tr>
                        <td colspan="2"><b>Crédito:</b></td>
                        <td colspan="2"><?php echo number_format((float)$item['CREDITO'], 2, '.', ','); ?></td>
                        <td colspan="2"><b>Total:</b></td>
                        <td colspan="2"><?php echo number_format((float)$item['TOTAL'], 2, '.', ','); ?></td>
                    </tr>
                    <tr>
                        <td colspan="2"></td>
                        <td colspan="2"></td>
                        <td colspan="2"><b>Propina:</b></td>
                        <td colspan="2"><?php echo "0"; ?></td>
                    </tr>
                </tbody>
            </table>
            </div>
    </body>
</html>
<?php }} 

function serviciosrealizados($datos){
    include $_SESSION["idiomaruta"].$_SESSION["idioma"]."/liveclientes.php";
    foreach ($datos[0] as $item){
   
        if ($_SESSION["datossalon"]["RIF"] != "") {
           echo "RIF: ".$_SESSION["datossalon"]["RIF"]."<br>";
        } 
        echo $trcllabeltelefono .": ".$_SESSION["datossalon"]["TELEFONO"]."<br>";        

        echo $trcllabelgciadmon;

?>



            

            <div class="table-responsive">

            <table class="table table-responsive table-hover table-condensed">

                <tbody>

                    <tr>

                        <th colspan="8">

                            <h2 colspan="8"><?php echo $trcltituloservicios ?></h2>

                        </th>

                    </tr>
                    

                    <tr>

                        <td colspan="2"><b><?php echo $trclcbnombrecliente ?>:</b></td>

                        <td colspan="2"><?php echo $item['CLIENTENOMBRE']; ?></td>                        

                    </tr>

                </tbody>

            </table>

            </div>

            <div class="table-responsive">


            <table class="table table-hover table-condensed">

                <thead>

                    <tr style='text-align: left;'>


                        <th><?php echo $trclcbdescripcion ?></th>

                        <th><?php echo $trclcbasociado ?></th>

                    </tr>

                </thead>

                <tbody>

                    <?php 

                        if (count($datos[1])==0) {
                           echo "<tr>";

                            echo "
                        <td>".$trclserviciosnocargados."</td>                        
                         </tr>";
                        }else{

                        foreach ($datos[1] as $item2){

                            echo "<tr>";

                            echo "
                        <td>".$item2['DESCRIPCION']."</td>

                        <td>".$item2['ASOCIADO']." - " . $item2['NOMBREASOCIADO']."</td>
                        

                    </tr>";}}

                            ?>

                    </tbody>

                    </table>

                </div>

            


<?php }} ?>