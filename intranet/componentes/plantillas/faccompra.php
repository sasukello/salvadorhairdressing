<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<html>
    <header>
        <title>Factura de Compra</title>
    </header>
    <body>
        <table>
                <tbody>
                    <tr style="text-align: left;">
                        <th colspan="6">NOMBRESALON</th>
                        <td>Fecha de Impresión: </td>
                        <td><?php echo date('d-m-Y'); ?></td>
                    </tr>
                    <tr>
                        <td colspan="6">RIF: J-99999999-9</td>
                        <td>Hora de Impresión:</td>
                        <td><?php date_default_timezone_set('America/Caracas');echo date('h:i a'); ?></td>
                    </tr>
                    <tr>
                        <td colspan="4">TELF: 9999-9999999</td>
                    </tr>
                    <tr>
                        <td colspan="4">Gerencia de Administración</td>
                    </tr>
                </tbody>
        </table>
        
            <h2>FACTURA DE COMPRA</h2>
            <table>
                <tbody>
                    <tr>
                        <td colspan="2">Documento:</td>
                        <td colspan="3">9999999</td>
                        <td>Fecha de Compra: 99-99-9999</td>
                        <td>Factura: 99999999</td>
                    </tr>
                    <tr>
                        <td colspan="2">RIF:</td>
                        <td colspan="3">J-9999999-9</td>
                        <td>Proveedor: XXXXXXX XXXX</td>
                        <td>División: XXXXXXXX</td>
                    </tr>
                </tbody>
            </table>
            <br>
            <table>
                <thead>
                    <tr style="text-align: left;">
                        <th>Código</th>
                        <th>Desripción</th>
                        <th>Can.</th>
                        <th>Precio</th>
                        <th>Sub-total</th>
                        <th colspan="2">% Descuento<br>Estrc. ----- Prom.</th>
                        <th>Valor<br>Descuento</th>
                        <th><br>Neto</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>X99</td>
                        <td>XXX</td>
                        <td>99.99</td>
                        <td>99.99</td>
                        <td>9,999.99</td>
                        <td>0.00</td>
                        <td>0.00</td>
                        <td>9,999.99</td>
                        <td>99,999.99</td>
                    </tr>
                    <tr><td></td></tr>
                    <tr>
                        <th>Efectivo</th><td>9,999.99</td><td colspan="2"></td><th>Subtotal</th><td>9,999.99</td></tr>
                        <tr><th>Cheque</th><td>9,999.99</td><td colspan="2"></td><th>Descuento</th><td>9,999.99</td></tr>
                        <tr><th>Tarjeta de Débito</th><td>9,999.99</td><td colspan="2"></td><th>IVA (12.00%)</th><td>9,999.99</td></tr>
                        <tr><th>Tarjeta de Crédito</th><td>9,999.99</td><td colspan="2"></td><th>Fletes</th><td>99.99</td></tr>
                        <tr><th>Crédito</th><td>9,999.99</td><td colspan="2"></td><th>Total</th><td>99.99</td>
                    </tr>
                    
                    <tr>
                        <td colspan="4"></td><th>Unidades Recibidas</th><td>999.99</td>
                    </tr>
                </tbody>
            </table>
    </body>
</html>