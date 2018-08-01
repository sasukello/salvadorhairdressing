<?php



function urlsafe_b64encode($string) {

    $data = base64_encode($string);

    $data = str_replace(array('+','/','='),array('-','_','.'),$data);

    return $data;

}



//********************************

//***    TOTAL DE VENTAS       ***

//********************************

function ventatotal($desde, $hasta){

        //Valida las fechas indicadas

        $fechacreada = date_create($desde);
        $desde = "'".date_format($fechacreada, 'm/d/Y')."'";

        $fechacreada = date_create($hasta);
        $hasta = "'".date_format($fechacreada, 'm/d/Y')."'";
        $arsql = array();

        //Total resumen de venta
        $sql = "Select sum(Neto) as neto, sum(MontoIva) as montoimpuesto, sum(Total) as total, sum(Efec) as efectivo, sum(Tdb) as TarjetaDebito,

       sum(Tdc) as taarjetacredito, sum(Che) as cheque, sum(Cre) as credito, sum(Pro) as propina, sum(EfectivoCxC) CxCEfectivo,

       sum(ChequeCxC) as CxCCheque from

                            (Select

                               FechaVenta,

                               Neto,

                               MontoIva,

                               Total,

                               Efec,

                               Tdb,

                               Tdc,

                               Che,

                               Cre,

                               Pro,

                               FechaIngreso,

                               EfectivoCxC,

                               ChequeCxC

                            from

                               (select

                                  F.FechaVenta,

                                  F.Neto - Coalesce(D.Neto, 0) as Neto,

                                  F.MontoIva - Coalesce(D.MontoIva, 0) as MontoIva,

                                  F.Total - Coalesce(D.Total, 0) as Total,

                                  F.Efec - Coalesce(D.Efec, 0) as Efec,

                                  F.Tdb - Coalesce(D.Tdb, 0) as Tdb,

                                  F.Tdc - Coalesce(D.Tdc, 0) as Tdc,

                                  F.Che - Coalesce(D.Che, 0) as Che,

                                  F.Cre - Coalesce(D.Cre, 0) as Cre,

                                  Coalesce(F.Pro, 0) - Coalesce(D.Pro, 0) as Pro

                               from

                                  (Select

                                     FechaVenta,

                                     Sum(Total - MontoIva) as Neto,

                                     Sum(MontoIva) as MontoIva,

                                     Sum(Total) as Total,

                                     Sum(Efectivo) as EFEC,

                                     Sum(TDebito) as TDB,

                                     Sum(TCredito) as TDC,

                                     Sum(Cheque) as CHE,

                                     Sum(Credito) as CRE,

                                     Sum((Select Sum(Monto) from ventaspropinas

                                       where CorrelativoVta = vta.Correlativo and TipoDocumento = vta.Tipo)) as PRO

                                  from

                                     vta

                                  where

                                     tipo = 'FAC' and

                                     fechaventa >= $desde and

                                     fechaventa <= $hasta

                                  group by Fechaventa) as F



                                  left join



                               (Select FechaVenta,

                                       Sum(Total - MontoIva) as Neto,

                                       Sum(MontoIva) as MontoIva,

                                       Sum(Total) as Total,

                                       Sum(Efectivo) as EFEC,

                                       Sum(TDebito) as TDB,

                                       Sum(TCredito) as TDC,

                                       Sum(Cheque) as CHE,

                                       Sum(Credito) as CRE,

                                       Sum((Select Sum(Monto) from ventaspropinas

                                       where CorrelativoVta = vta.Correlativo and TipoDocumento = vta.Tipo)) as PRO

                                from

                                   vta

                                where

                                   tipo = 'DEV' and

                                   fechaventa >= $desde and

                                   fechaventa <= $hasta

                                group by Fechaventa) as D



                                on F.FechaVenta = D.FechaVenta) FAC



                                left join



                                (select FechaIngreso,

                                        Coalesce(Sum(Efectivo), 0) as EfectivoCxC,

                                        CoalEsce(Sum(Cheque), 0) as ChequeCxC

                                    from cxc where fechaingreso >= $desde and FechaIngreso <= $hasta group by FechaIngreso) CXC

                                on FAC.FechaVenta = CXC.FechaIngreso) CCD



                                Left Join



                                (Select fechaventa, sum(Total) as TotalGcr from vta

                                where tipo = 'GCR' and fechaventa >= $desde and fechaventa <= $hasta

                                group by FechaVenta) GCR

                            on

                               CCD.FechaVenta = Gcr.FechaVenta";

        

        $arsql[] = $sql;

        

        //Total Inventario

        $sql = "Select

                       Sum(case vtadte.Tipo when 'DEV' then

                                (((vtadte.PrecioSinIva -  vtadte.descuento) * vtadte.Cantidad) -

                                (((vtadte.PrecioSinIva -  vtadte.descuento) * vtadte.Cantidad) *

                                (((vta.descuento * 100) / (vta.SubTotal - vta.desclineas)) / 100)) ) * -1

                               else

                                ((vtadte.PrecioSinIva -  vtadte.descuento) * vtadte.Cantidad) -

                                (((vtadte.PrecioSinIva -  vtadte.descuento) * vtadte.Cantidad) *

                                (((vta.descuento * 100) / (vta.SubTotal - vta.desclineas)) / 100)) end) as Inventario

                    from

                       vta, vtadte

                    where

                       vta.correlativo = vtadte.correlativoprincipal and

                       vta.Tipo = vtadte.tipo and

                       vta.fechaventa >= $desde and

                       vta.fechaventa <= $hasta and

                       vtadte.TipoProducto = 'P' and

                       vta.tipo in ('DEV', 'FAC') and

                       vta.subtotal <> 0 and 

                       vtadte.cantidad <> 0 and

                       vtadte.PRECIOSINIVA <> 0";



        $arsql[] = $sql;

        

        //Total Servicio

        $sql = "Select

                       Sum(case vtadte.Tipo when 'DEV' then

                                (((vtadte.PrecioSinIva -  vtadte.descuento) * vtadte.Cantidad) -

                                (((vtadte.PrecioSinIva -  vtadte.descuento) * vtadte.Cantidad) *

                                (((vta.descuento * 100) / (vta.SubTotal - vta.desclineas)) / 100)) ) * -1

                               else

                                ((vtadte.PrecioSinIva -  vtadte.descuento) * vtadte.Cantidad) -

                                (((vtadte.PrecioSinIva -  vtadte.descuento) * vtadte.Cantidad) *

                                (((vta.descuento * 100) / (vta.SubTotal - vta.desclineas)) / 100)) end) as Servicios

                    from

                       vta, vtadte

                    where

                       vta.correlativo = vtadte.correlativoprincipal and

                       vta.Tipo = vtadte.tipo and

                       vta.fechaventa >= $desde and

                       vta.fechaventa <= $hasta and

                       vtadte.TipoProducto = 'S' and

                       vta.tipo in ('DEV', 'FAC') and

                       vta.subtotal <> 0 and

                       vtadte.cantidad <> 0 and

                       vtadte.PRECIOSINIVA <> 0";



        $arsql[] = $sql;

        

        return urlsafe_b64encode(serialize($arsql));        

} //funcion venta total





//********************************

//***    TOTAL DE VENTAS por dia       ***

//********************************

function ventadia($desde, $hasta, $filtro){

        //La variable filtro puede ser

        //A: Ambos, muestra toda la informacion

        //I: Solo los totales de inventario

        //S: Solo los totales de servicio

        // 

        //Valida las fechas indicadas

        $fechacreada = date_create($desde);

        $desde = "'".date_format($fechacreada, 'm/d/Y')."'";

        

        $fechacreada = date_create($hasta);

        $hasta = "'".date_format($fechacreada, 'm/d/Y')."'";

        $arsql = array();

        //Total resumen de venta

        if ($filtro == "A"){

            $sql = "select fechaventa, sum(efectivo) as efectivo, sum(cheque) as cheque, sum(TDebito) as tdebito, sum(Tcredito) as tcredito, sum(Credito) as credito, 

       sum(subtotal) as subtotal, sum(descuento) as descuento, sum(desclineas) as desclineas, sum(montoneto) as montoneto, sum(montoiva) as montoiva, sum(total) as total, sum (coalesce(propina, 0)) as tpropina

from (Select vta.fechaventa,

       vta.tipo,

       vta.Correlativo,

       vta.ColetillaTipo,

       vta.ClienteNombre,

       vta.ClienteRIF,

       vta.FacturaFiscal,

       case vta.Tipo when 'FAC' then

          vta.Efectivo

       else

          vta.Efectivo * -1 end as Efectivo,

       case vta.Tipo when 'FAC' then

          vta.Cheque

       else

          vta.Cheque * -1 end as Cheque,

       case vta.Tipo when 'FAC' then

          vta.TDebito

       else

          vta.TDebito * -1 end as TDebito,

       case vta.Tipo when 'FAC' then

          vta.TCredito

       else

          vta.TCredito * -1 end as TCredito,

       case vta.Tipo when 'FAC' then

          vta.Credito

       else

          vta.Credito * -1 end as Credito,

       case vtadte.Tipo when 'FAC' then

          (vtadte.PRECIOSINIVA * vtadte.CANTIDAD)

       else

          (vtadte.PRECIOSINIVA * vtadte.CANTIDAD * -1) end as SubTotal,

       case vtadte.Tipo when 'FAC' then

          ((vtadte.PRECIOSINIVA * vtadte.CANTIDAD) * (((vta.Descuento*100)/(vtadte.PRECIOSINIVA * vtadte.CANTIDAD))/100))

       else

          (vtadte.PRECIOSINIVA * vtadte.CANTIDAD) * (((vta.Descuento*100)/(vtadte.PRECIOSINIVA * vtadte.CANTIDAD))/100) * -1 end as Descuento,

       case vtadte.Tipo when 'FAC' then

          (CoalEsce((vtadte.DESCUENTO + vtadte.DESCUENTOPUNTOS) * vtadte.CANTIDAD , 0))

       else

          (CoalEsce((vtadte.DESCUENTO + vtadte.DESCUENTOPUNTOS) * vtadte.CANTIDAD, 0) * -1) end as DescLineas,

       case vta.Tipo when 'FAC' then

          (vtadte.PRECIOSINIVA - ((vtadte.PRECIOSINIVA) * (((vta.Descuento*100)/(vtadte.PRECIOSINIVA))/100)) - (vtadte.DESCUENTO + vtadte.DESCUENTOPUNTOS)) * vtadte.CANTIDAD

       else

          (vtadte.PRECIOSINIVA - ((vtadte.PRECIOSINIVA) * (((vta.Descuento*100)/(vtadte.PRECIOSINIVA))/100)) - (vtadte.DESCUENTO + vtadte.DESCUENTOPUNTOS)) * vtadte.CANTIDAD * -1 end as MontoNeto,

       case vta.Tipo when 'FAC' then

          ((vtadte.PRECIOSINIVA - ((vtadte.PRECIOSINIVA) * (((vta.Descuento*100)/(vtadte.PRECIOSINIVA))/100)) - (vtadte.DESCUENTO + vtadte.DESCUENTOPUNTOS)) * vtadte.CANTIDAD) * (vtadte.PORCIVA / 100)

       else

          ((vtadte.PRECIOSINIVA - ((vtadte.PRECIOSINIVA) * (((vta.Descuento*100)/(vtadte.PRECIOSINIVA))/100)) - (vtadte.DESCUENTO + vtadte.DESCUENTOPUNTOS)) * vtadte.CANTIDAD) * (vtadte.PORCIVA / 100) * -1

       end as MontoIva,

       case vta.Tipo when 'FAC' then

          ((vtadte.PRECIOSINIVA - ((vtadte.PRECIOSINIVA) * (((vta.Descuento*100)/(vtadte.PRECIOSINIVA))/100)) - (vtadte.DESCUENTO + vtadte.DESCUENTOPUNTOS)) * vtadte.CANTIDAD) + (((vtadte.PRECIOSINIVA - ((vtadte.PRECIOSINIVA) * (((vta.Descuento*100)/(vtadte.PRECIOSINIVA))/100)) - (vtadte.DESCUENTO + vtadte.DESCUENTOPUNTOS)) * vtadte.CANTIDAD) * (vtadte.PORCIVA / 100))

       else

          ((vtadte.PRECIOSINIVA - ((vtadte.PRECIOSINIVA) * (((vta.Descuento*100)/(vtadte.PRECIOSINIVA))/100)) - (vtadte.DESCUENTO + vtadte.DESCUENTOPUNTOS)) * vtadte.CANTIDAD) + (((vtadte.PRECIOSINIVA - ((vtadte.PRECIOSINIVA) * (((vta.Descuento*100)/(vtadte.PRECIOSINIVA))/100)) - (vtadte.DESCUENTO + vtadte.DESCUENTOPUNTOS)) * vtadte.CANTIDAD) * (vtadte.PORCIVA / 100)) * -1 end as Total,

       case vta.Tipo when 'FAC' then

          (Select Sum(Monto) from ventaspropinas

           where CorrelativoVta = vta.Correlativo and TipoDocumento = vta.Tipo)

       else

          (Select Sum(Monto) from ventaspropinas

           where CorrelativoVta = vta.Correlativo and TipoDocumento = vta.Tipo)  * -1

       end as Propina

from

                       vta, vtadte

                    where

                       vta.correlativo = vtadte.correlativoprincipal and

                       vta.Tipo = vtadte.tipo and

                       vta.fechaventa >= $desde and

                       vta.fechaventa <= $hasta and

                       vta.tipo in ('DEV', 'FAC') and

                       vta.subtotal <> 0 and

                       vtadte.cantidad <> 0 and

                       vtadte.PRECIOSINIVA <> 0)

group by fechaventa";



                $arsql[] = $sql;

        }

        elseif ($filtro=='I') {

            $sql = "select fechaventa, sum(efectivo) as efectivo, sum(cheque) as cheque, sum(TDebito) as tdebito, sum(Tcredito) as tcredito, sum(Credito) as credito, 

       sum(subtotal) as subtotal, sum(descuento) as descuento, sum(desclineas) as desclineas, sum(montoneto) as montoneto, sum(montoiva) as montoiva, sum(total) as total, sum (coalesce(propina, 0)) as tpropina

from (Select vta.fechaventa,

       vta.tipo,

       vta.Correlativo,

       vta.ColetillaTipo,

       vta.ClienteNombre,

       vta.ClienteRIF,

       vta.FacturaFiscal,

       case vta.Tipo when 'FAC' then

          vta.Efectivo

       else

          vta.Efectivo * -1 end as Efectivo,

       case vta.Tipo when 'FAC' then

          vta.Cheque

       else

          vta.Cheque * -1 end as Cheque,

       case vta.Tipo when 'FAC' then

          vta.TDebito

       else

          vta.TDebito * -1 end as TDebito,

       case vta.Tipo when 'FAC' then

          vta.TCredito

       else

          vta.TCredito * -1 end as TCredito,

       case vta.Tipo when 'FAC' then

          vta.Credito

       else

          vta.Credito * -1 end as Credito,

       case vtadte.Tipo when 'FAC' then

          (vtadte.PRECIOSINIVA * vtadte.CANTIDAD)

       else

          (vtadte.PRECIOSINIVA * vtadte.CANTIDAD * -1) end as SubTotal,

       case vtadte.Tipo when 'FAC' then

          ((vtadte.PRECIOSINIVA * vtadte.CANTIDAD) * (((vta.Descuento*100)/(vtadte.PRECIOSINIVA * vtadte.CANTIDAD))/100))

       else

          (vtadte.PRECIOSINIVA * vtadte.CANTIDAD) * (((vta.Descuento*100)/(vtadte.PRECIOSINIVA * vtadte.CANTIDAD))/100) * -1 end as Descuento,

       case vtadte.Tipo when 'FAC' then

          (CoalEsce((vtadte.DESCUENTO + vtadte.DESCUENTOPUNTOS) * vtadte.CANTIDAD , 0))

       else

          (CoalEsce((vtadte.DESCUENTO + vtadte.DESCUENTOPUNTOS) * vtadte.CANTIDAD, 0) * -1) end as DescLineas,

       case vta.Tipo when 'FAC' then

          (vtadte.PRECIOSINIVA - ((vtadte.PRECIOSINIVA) * (((vta.Descuento*100)/(vtadte.PRECIOSINIVA))/100)) - (vtadte.DESCUENTO + vtadte.DESCUENTOPUNTOS)) * vtadte.CANTIDAD

       else

          (vtadte.PRECIOSINIVA - ((vtadte.PRECIOSINIVA) * (((vta.Descuento*100)/(vtadte.PRECIOSINIVA))/100)) - (vtadte.DESCUENTO + vtadte.DESCUENTOPUNTOS)) * vtadte.CANTIDAD * -1 end as MontoNeto,

       case vta.Tipo when 'FAC' then

          ((vtadte.PRECIOSINIVA - ((vtadte.PRECIOSINIVA) * (((vta.Descuento*100)/(vtadte.PRECIOSINIVA))/100)) - (vtadte.DESCUENTO + vtadte.DESCUENTOPUNTOS)) * vtadte.CANTIDAD) * (vtadte.PORCIVA / 100)

       else

          ((vtadte.PRECIOSINIVA - ((vtadte.PRECIOSINIVA) * (((vta.Descuento*100)/(vtadte.PRECIOSINIVA))/100)) - (vtadte.DESCUENTO + vtadte.DESCUENTOPUNTOS)) * vtadte.CANTIDAD) * (vtadte.PORCIVA / 100) * -1

       end as MontoIva,

       case vta.Tipo when 'FAC' then

          ((vtadte.PRECIOSINIVA - ((vtadte.PRECIOSINIVA) * (((vta.Descuento*100)/(vtadte.PRECIOSINIVA))/100)) - (vtadte.DESCUENTO + vtadte.DESCUENTOPUNTOS)) * vtadte.CANTIDAD) + (((vtadte.PRECIOSINIVA - ((vtadte.PRECIOSINIVA) * (((vta.Descuento*100)/(vtadte.PRECIOSINIVA))/100)) - (vtadte.DESCUENTO + vtadte.DESCUENTOPUNTOS)) * vtadte.CANTIDAD) * (vtadte.PORCIVA / 100))

       else

          ((vtadte.PRECIOSINIVA - ((vtadte.PRECIOSINIVA) * (((vta.Descuento*100)/(vtadte.PRECIOSINIVA))/100)) - (vtadte.DESCUENTO + vtadte.DESCUENTOPUNTOS)) * vtadte.CANTIDAD) + (((vtadte.PRECIOSINIVA - ((vtadte.PRECIOSINIVA) * (((vta.Descuento*100)/(vtadte.PRECIOSINIVA))/100)) - (vtadte.DESCUENTO + vtadte.DESCUENTOPUNTOS)) * vtadte.CANTIDAD) * (vtadte.PORCIVA / 100)) * -1 end as Total,

       case vta.Tipo when 'FAC' then

          (Select Sum(Monto) from ventaspropinas

           where CorrelativoVta = vta.Correlativo and TipoDocumento = vta.Tipo)

       else

          (Select Sum(Monto) from ventaspropinas

           where CorrelativoVta = vta.Correlativo and TipoDocumento = vta.Tipo)  * -1

       end as Propina

from

                       vta, vtadte

                    where

                       vta.correlativo = vtadte.correlativoprincipal and

                       vta.Tipo = vtadte.tipo and

                       vta.fechaventa >= $desde and

                       vta.fechaventa <= $hasta and

                       vtadte.TipoProducto = 'P' and

                       vta.tipo in ('DEV', 'FAC') and

                       vta.subtotal <> 0 and

                       vtadte.cantidad <> 0 and

                       vtadte.PRECIOSINIVA <> 0)

group by fechaventa";

                      

            

            $arsql[] = $sql;

           

        }

        elseif ($filtro=='S') {

            $sql = "select fechaventa, sum(efectivo) as efectivo, sum(cheque) as cheque, sum(TDebito) as tdebito, sum(Tcredito) as tcredito, sum(Credito) as credito, 

       sum(subtotal) as subtotal, sum(descuento) as descuento, sum(desclineas) as desclineas, sum(montoneto) as montoneto, sum(montoiva) as montoiva, sum(total) as total, sum (coalesce(propina, 0)) as tpropina

from (Select vta.fechaventa,

       vta.tipo,

       vta.Correlativo,

       vta.ColetillaTipo,

       vta.ClienteNombre,

       vta.ClienteRIF,

       vta.FacturaFiscal,

       case vta.Tipo when 'FAC' then

          vta.Efectivo

       else

          vta.Efectivo * -1 end as Efectivo,

       case vta.Tipo when 'FAC' then

          vta.Cheque

       else

          vta.Cheque * -1 end as Cheque,

       case vta.Tipo when 'FAC' then

          vta.TDebito

       else

          vta.TDebito * -1 end as TDebito,

       case vta.Tipo when 'FAC' then

          vta.TCredito

       else

          vta.TCredito * -1 end as TCredito,

       case vta.Tipo when 'FAC' then

          vta.Credito

       else

          vta.Credito * -1 end as Credito,

       case vtadte.Tipo when 'FAC' then

          (vtadte.PRECIOSINIVA * vtadte.CANTIDAD)

       else

          (vtadte.PRECIOSINIVA * vtadte.CANTIDAD * -1) end as SubTotal,

       case vtadte.Tipo when 'FAC' then

          ((vtadte.PRECIOSINIVA * vtadte.CANTIDAD) * (((vta.Descuento*100)/(vtadte.PRECIOSINIVA * vtadte.CANTIDAD))/100))

       else

          (vtadte.PRECIOSINIVA * vtadte.CANTIDAD) * (((vta.Descuento*100)/(vtadte.PRECIOSINIVA * vtadte.CANTIDAD))/100) * -1 end as Descuento,

       case vtadte.Tipo when 'FAC' then

          (CoalEsce((vtadte.DESCUENTO + vtadte.DESCUENTOPUNTOS) * vtadte.CANTIDAD , 0))

       else

          (CoalEsce((vtadte.DESCUENTO + vtadte.DESCUENTOPUNTOS) * vtadte.CANTIDAD, 0) * -1) end as DescLineas,

       case vta.Tipo when 'FAC' then

          (vtadte.PRECIOSINIVA - ((vtadte.PRECIOSINIVA) * (((vta.Descuento*100)/(vtadte.PRECIOSINIVA))/100)) - (vtadte.DESCUENTO + vtadte.DESCUENTOPUNTOS)) * vtadte.CANTIDAD

       else

          (vtadte.PRECIOSINIVA - ((vtadte.PRECIOSINIVA) * (((vta.Descuento*100)/(vtadte.PRECIOSINIVA))/100)) - (vtadte.DESCUENTO + vtadte.DESCUENTOPUNTOS)) * vtadte.CANTIDAD * -1 end as MontoNeto,

       case vta.Tipo when 'FAC' then

          ((vtadte.PRECIOSINIVA - ((vtadte.PRECIOSINIVA) * (((vta.Descuento*100)/(vtadte.PRECIOSINIVA))/100)) - (vtadte.DESCUENTO + vtadte.DESCUENTOPUNTOS)) * vtadte.CANTIDAD) * (vtadte.PORCIVA / 100)

       else

          ((vtadte.PRECIOSINIVA - ((vtadte.PRECIOSINIVA) * (((vta.Descuento*100)/(vtadte.PRECIOSINIVA))/100)) - (vtadte.DESCUENTO + vtadte.DESCUENTOPUNTOS)) * vtadte.CANTIDAD) * (vtadte.PORCIVA / 100) * -1

       end as MontoIva,

       case vta.Tipo when 'FAC' then

          ((vtadte.PRECIOSINIVA - ((vtadte.PRECIOSINIVA) * (((vta.Descuento*100)/(vtadte.PRECIOSINIVA))/100)) - (vtadte.DESCUENTO + vtadte.DESCUENTOPUNTOS)) * vtadte.CANTIDAD) + (((vtadte.PRECIOSINIVA - ((vtadte.PRECIOSINIVA) * (((vta.Descuento*100)/(vtadte.PRECIOSINIVA))/100)) - (vtadte.DESCUENTO + vtadte.DESCUENTOPUNTOS)) * vtadte.CANTIDAD) * (vtadte.PORCIVA / 100))

       else

          ((vtadte.PRECIOSINIVA - ((vtadte.PRECIOSINIVA) * (((vta.Descuento*100)/(vtadte.PRECIOSINIVA))/100)) - (vtadte.DESCUENTO + vtadte.DESCUENTOPUNTOS)) * vtadte.CANTIDAD) + (((vtadte.PRECIOSINIVA - ((vtadte.PRECIOSINIVA) * (((vta.Descuento*100)/(vtadte.PRECIOSINIVA))/100)) - (vtadte.DESCUENTO + vtadte.DESCUENTOPUNTOS)) * vtadte.CANTIDAD) * (vtadte.PORCIVA / 100)) * -1 end as Total,

       case vta.Tipo when 'FAC' then

          (Select Sum(Monto) from ventaspropinas

           where CorrelativoVta = vta.Correlativo and TipoDocumento = vta.Tipo)

       else

          (Select Sum(Monto) from ventaspropinas

           where CorrelativoVta = vta.Correlativo and TipoDocumento = vta.Tipo)  * -1

       end as Propina

from

                       vta, vtadte

                    where

                       vta.correlativo = vtadte.correlativoprincipal and

                       vta.Tipo = vtadte.tipo and

                       vta.fechaventa >= $desde and

                       vta.fechaventa <= $hasta and

                       vtadte.TipoProducto = 'S' and

                       vta.tipo in ('DEV', 'FAC') and

                       vta.subtotal <> 0 and 

                       vtadte.cantidad <> 0 and

                       vtadte.PRECIOSINIVA <> 0)

group by fechaventa";           

            $arsql[] = $sql;           

        }

        else {

            echo "Error Filtro no reconocido";

        }                 

        return urlsafe_b64encode(serialize($arsql));

} //funcion venta dia



//********************************

//***   DETALLE DE CAJA POR DIAS       ***

//********************************

function ventadetalle($fechas, $filtro){

        //La variable filtro puede ser

        //A: Ambos, muestra toda la informacion

        //I: Solo los totales de inventario

        //S: Solo los totales de servicio

        //

        //Valida las fechas indicadas

        $rango = "";

        foreach($fechas as $fecha){

           if ($rango!="")

               $rango .= ",";

           

           $fechacreada = date_create($fecha);

           $rango .= "'".date_format($fechacreada, 'm/d/Y')."'";

        }

        

        

        $arsql = array();

        //Total resumen de venta para ambos

        if ($filtro=='A') { 

            $sql = "select fechaventa,

                           tipo,

                           Correlativo,

                           ColetillaTipo,

                           ClienteNombre,

                           ClienteRIF,

                           FacturaFiscal,

                           case Tipo when 'FAC' then

                              (SubTotal)

                           else

                              (SubTotal * -1) end as SubTotal,

                           case Tipo when 'FAC' then

                              (CoalEsce(Descuento, 0))

                           else

                              (CoalEsce(Descuento, 0) * -1) end as Descuento,

                           case Tipo when 'FAC' then

                              (CoalEsce(DescLineas + MontoRedimido , 0))

                           else

                              (CoalEsce(DescLineas + MontoRedimido, 0) * -1) end as DescLineas,

                           case Tipo when 'FAC' then

                              (SubTotal - Coalesce(Descuento, 0) - CoalEsce(DescLineas + MontoRedimido, 0))

                           else

                              (SubTotal - Coalesce(Descuento, 0) - CoalEsce(DescLineas + MontoRedimido,  0)) * -1 end as MontoNeto,

                           case Tipo when 'FAC' then

                              MontoIVa

                           else

                              MontoIva * -1

                           end as MontoIva,

                           case Tipo when 'FAC' then

                              Total

                           else

                              Total * -1 end as Total,

                           case Tipo when 'FAC' then

                              (Select Sum(Monto) from ventaspropinas

                               where CorrelativoVta = vta.Correlativo and TipoDocumento = vta.Tipo)

                           else

                              (Select Sum(Monto) from ventaspropinas

                               where CorrelativoVta = vta.Correlativo and TipoDocumento = vta.Tipo)  * -1

                           end as Propina,

                           case Tipo when 'FAC' then

                              Efectivo

                           else

                              Efectivo * -1 end as Efectivo,

                           case Tipo when 'FAC' then

                              Cheque

                           else

                              Cheque * -1 end as Cheque,

                           case Tipo when 'FAC' then

                              TDebito

                           else

                              TDebito * -1 end as TDebito,

                           case Tipo when 'FAC' then

                              TCredito

                           else

                              TCredito * -1 end as TCredito,

                           case Tipo when 'FAC' then

                              Credito

                           else

                              Credito * -1 end as Credito

                    from vta

                    where fechaventa in ($rango) and tipo in ('FAC', 'DEV') order by Tipo, Correlativo";

        }

        elseif ($filtro == "I"){

           //Total resumen de venta para inventario

           $sql = "select fechaventa, tipo, correlativo, coletillatipo, clientenombre, clienterif, facturafiscal, efectivo, cheque, TDebito, Tcredito, Credito, Propina,

       sum(subtotal) as subtotal, sum(descuento) as descuento, sum(desclineas) as desclineas, sum(montoneto) as montoneto, sum(montoiva) as montoiva, sum(total) as total, sum (coalesce(propina, 0)) as tpropina

from (Select vta.fechaventa,

       vta.tipo,

       vta.Correlativo,

       vta.ColetillaTipo,

       vta.ClienteNombre,

       vta.ClienteRIF,

       vta.FacturaFiscal,

       case vta.Tipo when 'FAC' then

          vta.Efectivo

       else

          vta.Efectivo * -1 end as Efectivo,

       case vta.Tipo when 'FAC' then

          vta.Cheque

       else

          vta.Cheque * -1 end as Cheque,

       case vta.Tipo when 'FAC' then

          vta.TDebito

       else

          vta.TDebito * -1 end as TDebito,

       case vta.Tipo when 'FAC' then

          vta.TCredito

       else

          vta.TCredito * -1 end as TCredito,

       case vta.Tipo when 'FAC' then

          vta.Credito

       else

          vta.Credito * -1 end as Credito,

       case vtadte.Tipo when 'FAC' then

          (vtadte.PRECIOSINIVA * vtadte.CANTIDAD)

       else

          (vtadte.PRECIOSINIVA * vtadte.CANTIDAD * -1) end as SubTotal,

       case vtadte.Tipo when 'FAC' then

          ((vtadte.PRECIOSINIVA * vtadte.CANTIDAD) * (((vta.Descuento*100)/(vtadte.PRECIOSINIVA * vtadte.CANTIDAD))/100))

       else

          (vtadte.PRECIOSINIVA * vtadte.CANTIDAD) * (((vta.Descuento*100)/(vtadte.PRECIOSINIVA * vtadte.CANTIDAD))/100) * -1 end as Descuento,

       case vtadte.Tipo when 'FAC' then

          (CoalEsce((vtadte.DESCUENTO + vtadte.DESCUENTOPUNTOS) * vtadte.CANTIDAD , 0))

       else

          (CoalEsce((vtadte.DESCUENTO + vtadte.DESCUENTOPUNTOS) * vtadte.CANTIDAD, 0) * -1) end as DescLineas,

       case vta.Tipo when 'FAC' then

          (vtadte.PRECIOSINIVA - ((vtadte.PRECIOSINIVA) * (((vta.Descuento*100)/(vtadte.PRECIOSINIVA))/100)) - (vtadte.DESCUENTO + vtadte.DESCUENTOPUNTOS)) * vtadte.CANTIDAD

       else

          (vtadte.PRECIOSINIVA - ((vtadte.PRECIOSINIVA) * (((vta.Descuento*100)/(vtadte.PRECIOSINIVA))/100)) - (vtadte.DESCUENTO + vtadte.DESCUENTOPUNTOS)) * vtadte.CANTIDAD * -1 end as MontoNeto,

       case vta.Tipo when 'FAC' then

          ((vtadte.PRECIOSINIVA - ((vtadte.PRECIOSINIVA) * (((vta.Descuento*100)/(vtadte.PRECIOSINIVA))/100)) - (vtadte.DESCUENTO + vtadte.DESCUENTOPUNTOS)) * vtadte.CANTIDAD) * (vtadte.PORCIVA / 100)

       else

          ((vtadte.PRECIOSINIVA - ((vtadte.PRECIOSINIVA) * (((vta.Descuento*100)/(vtadte.PRECIOSINIVA))/100)) - (vtadte.DESCUENTO + vtadte.DESCUENTOPUNTOS)) * vtadte.CANTIDAD) * (vtadte.PORCIVA / 100) * -1

       end as MontoIva,

       case vta.Tipo when 'FAC' then

          ((vtadte.PRECIOSINIVA - ((vtadte.PRECIOSINIVA) * (((vta.Descuento*100)/(vtadte.PRECIOSINIVA))/100)) - (vtadte.DESCUENTO + vtadte.DESCUENTOPUNTOS)) * vtadte.CANTIDAD) + (((vtadte.PRECIOSINIVA - ((vtadte.PRECIOSINIVA) * (((vta.Descuento*100)/(vtadte.PRECIOSINIVA))/100)) - (vtadte.DESCUENTO + vtadte.DESCUENTOPUNTOS)) * vtadte.CANTIDAD) * (vtadte.PORCIVA / 100))

       else

          ((vtadte.PRECIOSINIVA - ((vtadte.PRECIOSINIVA) * (((vta.Descuento*100)/(vtadte.PRECIOSINIVA))/100)) - (vtadte.DESCUENTO + vtadte.DESCUENTOPUNTOS)) * vtadte.CANTIDAD) + (((vtadte.PRECIOSINIVA - ((vtadte.PRECIOSINIVA) * (((vta.Descuento*100)/(vtadte.PRECIOSINIVA))/100)) - (vtadte.DESCUENTO + vtadte.DESCUENTOPUNTOS)) * vtadte.CANTIDAD) * (vtadte.PORCIVA / 100)) * -1 end as Total,

       case vta.Tipo when 'FAC' then

          (Select Sum(Monto) from ventaspropinas

           where CorrelativoVta = vta.Correlativo and TipoDocumento = vta.Tipo)

       else

          (Select Sum(Monto) from ventaspropinas

           where CorrelativoVta = vta.Correlativo and TipoDocumento = vta.Tipo)  * -1

       end as Propina

from

                       vta, vtadte

                    where

                       vta.correlativo = vtadte.correlativoprincipal and

                       vta.Tipo = vtadte.tipo and

                       vta.fechaventa in ($rango) and

                       vtadte.TipoProducto = 'P' and

                       vta.tipo in ('DEV', 'FAC') and

                       vta.subtotal <> 0 and 

                       vtadte.cantidad <> 0 and

                       vtadte.PRECIOSINIVA <> 0)

group by fechaventa, tipo, correlativo, coletillatipo, clientenombre, clienterif, facturafiscal, efectivo, cheque, TDebito, Tcredito, Credito, Propina";

        }

        elseif ($filtro == "S"){

           //Total resumen de venta para inventario

           $sql = "select fechaventa, tipo, correlativo, coletillatipo, clientenombre, clienterif, facturafiscal, efectivo, cheque, TDebito, Tcredito, Credito, Propina,

       sum(subtotal) as subtotal, sum(descuento) as descuento, sum(desclineas) as desclineas, sum(montoneto) as montoneto, sum(montoiva) as montoiva, sum(total) as total, sum (coalesce(propina, 0)) as tpropina

from (Select vta.fechaventa,

       vta.tipo,

       vta.Correlativo,

       vta.ColetillaTipo,

       vta.ClienteNombre,

       vta.ClienteRIF,

       vta.FacturaFiscal,

       case vta.Tipo when 'FAC' then

          vta.Efectivo

       else

          vta.Efectivo * -1 end as Efectivo,

       case vta.Tipo when 'FAC' then

          vta.Cheque

       else

          vta.Cheque * -1 end as Cheque,

       case vta.Tipo when 'FAC' then

          vta.TDebito

       else

          vta.TDebito * -1 end as TDebito,

       case vta.Tipo when 'FAC' then

          vta.TCredito

       else

          vta.TCredito * -1 end as TCredito,

       case vta.Tipo when 'FAC' then

          vta.Credito

       else

          vta.Credito * -1 end as Credito,

       case vtadte.Tipo when 'FAC' then

          (vtadte.PRECIOSINIVA * vtadte.CANTIDAD)

       else

          (vtadte.PRECIOSINIVA * vtadte.CANTIDAD * -1) end as SubTotal,

       case vtadte.Tipo when 'FAC' then

          ((vtadte.PRECIOSINIVA * vtadte.CANTIDAD) * (((vta.Descuento*100)/(vtadte.PRECIOSINIVA * vtadte.CANTIDAD))/100))

       else

          (vtadte.PRECIOSINIVA * vtadte.CANTIDAD) * (((vta.Descuento*100)/(vtadte.PRECIOSINIVA * vtadte.CANTIDAD))/100) * -1 end as Descuento,

       case vtadte.Tipo when 'FAC' then

          (CoalEsce((vtadte.DESCUENTO + vtadte.DESCUENTOPUNTOS) * vtadte.CANTIDAD , 0))

       else

          (CoalEsce((vtadte.DESCUENTO + vtadte.DESCUENTOPUNTOS) * vtadte.CANTIDAD, 0) * -1) end as DescLineas,

       case vta.Tipo when 'FAC' then

          (vtadte.PRECIOSINIVA - ((vtadte.PRECIOSINIVA) * (((vta.Descuento*100)/(vtadte.PRECIOSINIVA))/100)) - (vtadte.DESCUENTO + vtadte.DESCUENTOPUNTOS)) * vtadte.CANTIDAD

       else

          (vtadte.PRECIOSINIVA - ((vtadte.PRECIOSINIVA) * (((vta.Descuento*100)/(vtadte.PRECIOSINIVA))/100)) - (vtadte.DESCUENTO + vtadte.DESCUENTOPUNTOS)) * vtadte.CANTIDAD * -1 end as MontoNeto,

       case vta.Tipo when 'FAC' then

          ((vtadte.PRECIOSINIVA - ((vtadte.PRECIOSINIVA) * (((vta.Descuento*100)/(vtadte.PRECIOSINIVA))/100)) - (vtadte.DESCUENTO + vtadte.DESCUENTOPUNTOS)) * vtadte.CANTIDAD) * (vtadte.PORCIVA / 100)

       else

          ((vtadte.PRECIOSINIVA - ((vtadte.PRECIOSINIVA) * (((vta.Descuento*100)/(vtadte.PRECIOSINIVA))/100)) - (vtadte.DESCUENTO + vtadte.DESCUENTOPUNTOS)) * vtadte.CANTIDAD) * (vtadte.PORCIVA / 100) * -1

       end as MontoIva,

       case vta.Tipo when 'FAC' then

          ((vtadte.PRECIOSINIVA - ((vtadte.PRECIOSINIVA) * (((vta.Descuento*100)/(vtadte.PRECIOSINIVA))/100)) - (vtadte.DESCUENTO + vtadte.DESCUENTOPUNTOS)) * vtadte.CANTIDAD) + (((vtadte.PRECIOSINIVA - ((vtadte.PRECIOSINIVA) * (((vta.Descuento*100)/(vtadte.PRECIOSINIVA))/100)) - (vtadte.DESCUENTO + vtadte.DESCUENTOPUNTOS)) * vtadte.CANTIDAD) * (vtadte.PORCIVA / 100))

       else

          ((vtadte.PRECIOSINIVA - ((vtadte.PRECIOSINIVA) * (((vta.Descuento*100)/(vtadte.PRECIOSINIVA))/100)) - (vtadte.DESCUENTO + vtadte.DESCUENTOPUNTOS)) * vtadte.CANTIDAD) + (((vtadte.PRECIOSINIVA - ((vtadte.PRECIOSINIVA) * (((vta.Descuento*100)/(vtadte.PRECIOSINIVA))/100)) - (vtadte.DESCUENTO + vtadte.DESCUENTOPUNTOS)) * vtadte.CANTIDAD) * (vtadte.PORCIVA / 100)) * -1 end as Total,

       case vta.Tipo when 'FAC' then

          (Select Sum(Monto) from ventaspropinas

           where CorrelativoVta = vta.Correlativo and TipoDocumento = vta.Tipo)

       else

          (Select Sum(Monto) from ventaspropinas

           where CorrelativoVta = vta.Correlativo and TipoDocumento = vta.Tipo)  * -1

       end as Propina

from

                       vta, vtadte

                    where

                       vta.correlativo = vtadte.correlativoprincipal and

                       vta.Tipo = vtadte.tipo and

                       vta.fechaventa in ($rango) and

                       vtadte.TipoProducto = 'S' and

                       vta.tipo in ('DEV', 'FAC') and

                       vta.subtotal <> 0 and

                       vtadte.cantidad <> 0 and

                       vtadte.PRECIOSINIVA <> 0)

group by fechaventa, tipo, correlativo, coletillatipo, clientenombre, clienterif, facturafiscal, efectivo, cheque, TDebito, Tcredito, Credito, Propina";

        }

        else {

            echo "Error Filtro no reconocido";

        }

        $arsql[] = $sql;

        

        return urlsafe_b64encode(serialize($arsql));

} //funcion venta detalle



//********************************

//*** FACTURAS DE VENTA        ***

//********************************

function facturaventa($correlativos,$tipo){

        //tipo puede contener los valores 

        //FAC, DEV, GCR 

        //Arma los correlativos recibidos

        $arsql = array();

        foreach($correlativos as $correlativo){

           

            $rango = "'".$correlativo."'";

        

            //cabeceras de las facturas

            $sql = "select * from vta where correlativo = $rango and tipo = '".$tipo."'";

            $arsql[] = $sql;



            //detalles de las facturas

            $sql = "select VTADTE.*, (PRECIOSINIVA * CANTIDAD) AS PRECIOTOTAL from vtadte where correlativoprincipal = $rango and tipo = '".$tipo."'";

            $arsql[] = $sql;



            //monto de la propina

            $sql = "Select Sum (Monto) as Propina from VentasPropinas where CorrelativoVta = $rango and TipoDocumento = '".$tipo."'";

            $arsql[] = $sql;

        }

        return urlsafe_b64encode(serialize($arsql));

} //funcion factura de venta

//********************************

//*** CLIENTES EN ESPERA       ***

//********************************

function detalleclienteespera($correlativos){
        

        //Arma los correlativos recibidos

        $arsql = array();

        foreach($correlativos as $correlativo){

           

            $rango = "'".$correlativo."'";

        

            //cabeceras de las facturas
            $sql = "select * from vtatemp where correlativo = $rango";
            $arsql[] = $sql;



            //detalles de las facturas
            $sql = "select VTATEMPDTE.*, (SELECT NOMBRE FROM ASOCIADOS WHERE ASOCIADOS.CODIGO = VTATEMPDTE.ASOCIADO ) as NOMBREASOCIADO from VTATEMPDTE where correlativoprincipal = $rango";
            $arsql[] = $sql;

        }

        return urlsafe_b64encode(serialize($arsql));

} //funcion DETALLE CLIENTE ESPERA



//********************************

//*** INVENTARIO ESTADISTICO   ***

//********************************

function inventarioestadistico($marca, $linea){

      $sql =  "select Marca,

              Linea,

              Codigo,

              Descripcion, (SELECT EXISTENCIAMINIMA FROM PRODUCTOS WHERE PRODUCTOS.codigo = productoexistenciaactual.CODIGO) AS EXISTENCIAMINIMA, 

              Cast(ExistenciaActual as Numeric(15,2)) as Existencia_Actual,

              (Select Sum(Coalesce(Case TIPO when 'DEV' then Coalesce(Cantidad, 0) * -1 else Coalesce(Cantidad, 0) end, 0)) as SellOut from vtadte where (Select Max(FechaVenta) from vta where Correlativo = CorrelativoPrincipal and vta.Tipo = vtadte.Tipo) >= current_date - 30 and CodigoProducto = codigo) as SellOut,

              (Select Max(FechaCompra) from (Select FCM.FechaCompra, FCMDET.CodigoProducto from FCM, FCMDET where correlativo = correlativoprincipal and FCM.tipo = FCMDET.tipo) where codigoproducto = codigo) AS FechaCompra,

              (Select Max(FechaVenta) from (Select VTA.FechaVenta, VTADTE.CodigoProducto from VTA, VTADTE where correlativo = correlativoprincipal and VTA.tipo = VTADTE.tipo) where codigoproducto = codigo) AS FechaVenta,

              (Select Count(*) from VentasPerdidas where FechaSolicitud >= current_date - 30 and CodigoProducto = Codigo) as VentasPerdidas,

              Descontinuado

              from productoexistenciaactual ";

      

      

      if ($marca == 0) {

              $sql .= "where (descontinuado = 'F' or ExistenciaActual <> 0) order by Marca, Linea, Descripcion";

      }

      else{

              if ($linea != 0) {

                 $sql .= "where (descontinuado = 'F' or ExistenciaActual <> 0) and codmarca = $marca and codlinea = $linea order by Marca, Linea, Descripcion";

              }

              else {

                 $sql .= "where (descontinuado = 'F' or ExistenciaActual <> 0) and codmarca = $marca order by Marca, Linea, Descripcion";

              }

      }

      

      $arsql = array();

        $arsql[] = $sql;

        return urlsafe_b64encode(serialize($arsql));

} //funcion inventario estadistico


//********************************

//***  ANALISIS PROMOCION      ***

//********************************

function analisispromocion($tipo, $nombrepromo){

        //tipo puede contener los valores 

        //T Total 

        //D Detalles

        //

        //Nombre promo puede estar en blanco al tratarse de un total

        if ($tipo == "T") {

            //monto de la propina

            $sql = "select * from ANALISISPROMOCIONESTOTAL";

        }

        else {

            //monto de la propina

            $sql = "select * from ANALISISPROMOCIONESDETALLE('".strtoupper($nombrepromo)."')";

        }

        $arsql = array();
        
        $arsql[] = $sql;

        return urlsafe_b64encode(serialize($arsql));

} //funcion analisis promocion



//********************************

//***     PRODUCTOS TOTAL      ***

//********************************

function productostotal($desde, $hasta, $tipo){

        //

        //$tipo:  I = Inventario   S = Servicios 

   if ($tipo == "I") 

       $tipo = "P";

   else 

       $tipo = "S";

   

   

   $sql = "Select codigoproducto, descripcion,

                  sum(iif(tipo= 'FAC', cantidad, cantidad*-1)) as Cantidad,

                  sum(iif(tipo= 'FAC', Total, Total*-1)) as TotalSinImpuesto

           from

              (select codigoproducto,

                      descripcion,

                      cantidad,

                      (PrecioSinIva - Descuento - DescuentoPuntos) * Cantidad as Total,

                      tipo, tipoproducto

               from vtadte

               where (Select  fechaventa from vta

                      where correlativo = correlativoprincipal and vta.tipo = vtadte.tipo) >= '". $desde ."'   and

                     (Select fechaventa from vta

                      where correlativo = correlativoprincipal and vta.tipo = vtadte.tipo) <= '". $hasta ."'  and

                            TipoProducto='". $tipo."') group by codigoproducto, Descripcion order by Descripcion";

         

        

        $arsql = array();

        $arsql[] = $sql;

        

        //Primero lo mas vendidos

        $sql =

        "select  diasemana, codigoproducto, descripcion, vendidos from

        (select extract(weekday from fechaventa) as DiaSemana, codigoproducto, trim(descripcion) as descripcion, sum(iif(vtadte.tipo='DEV',cantidad*-1, cantidad)) as Vendidos from vta, vtadte where correlativo = correlativoprincipal and vta.tipo = vtadte.tipo and tipoproducto = '".$tipo."' and fechaventa >= $desde and fechaventa <= $hasta group by Diasemana,  codigoproducto, descripcion)

        order by diasemana ASC, vendidos DESC";         

        $arsql[] = $sql;

        

        return urlsafe_b64encode(serialize($arsql));

} //funcion productos total



//********************************

//***     PRODUCTOS LISTA      ***

//********************************

function productoslista($idproductos, $desde, $hasta, $tipo){

        //idservicios es un array con los servicios seleccionados

        //

        //$tipo:  I = Inventario   S = Servicios 

   if ($tipo == "I") 

       $tipo = "P";

   else 

       $tipo = "S";

   

   $rango = "";

   foreach($idproductos as $id){

       if ($rango!="")

           $rango .= ",";

       $rango .= "'".$id."'";

   }

   

   $sql = "Select Fecha, codigoproducto, descripcion,

                  sum(iif(tipo= 'FAC', cantidad, cantidad*-1)) as Cantidad,

                  sum(iif(tipo= 'FAC', Total, Total*-1)) as TotalSinImpuesto

           from

              (select (Select FechaVenta from vta where correlativo = correlativoprincipal and vta.tipo = vtadte.tipo) as Fecha,

                      codigoproducto,

                      descripcion,

                      cantidad,

                      (PrecioSinIva - Descuento - DescuentoPuntos) * Cantidad as Total,

                      tipo, tipoproducto

               from vtadte

               where (Select  fechaventa from vta

                      where correlativo = correlativoprincipal and vta.tipo = vtadte.tipo) >= '". $desde ."'   and

                     (Select fechaventa from vta

                      where correlativo = correlativoprincipal and vta.tipo = vtadte.tipo) <= '". $hasta ."'  and

                            TipoProducto='". $tipo."'";

        

        if ($rango != ""){

           $sql .= " and codigoproducto in ($rango)";

        }

   

        $sql .=   ") group by Fecha, codigoproducto, Descripcion order by Fecha, Descripcion";

         

        

        $arsql = array();

        $arsql[] = $sql;

        

        

        return urlsafe_b64encode(serialize($arsql));

} //funcion productos lista



//********************************

//***         DEUDA TOTAL      ***

//********************************

function deudatotal($tipo){

        //

        //$tipo:  C = CxC   P = CxP 

  

   if ($tipo == 'C') {

      $sql = "

         select

   C.CodigoCliente,

   C.NombreCliente,

   C.Cargos,

   P.Pagos,

   C.Cargos - P.Pagos as Saldo

from

   (select

      CodigoCliente,

      NombreCliente,

      Coalesce(Sum(MontoTotal), 0) as Cargos

    from

       CxC

    where

       tipodocumento = 'FAC' or tipodocumento = 'NDB'

    group by CodigoCliente, NombreCliente) C



    left join



    (select

       CodigoCliente,

       NombreCliente,

       Coalesce(Sum(MontoTotal), 0) as Pagos

     from

       cxc

     where

        tipodocumento = 'PAG' or tipodocumento = 'NDC'

     group by CodigoCliente, NombreCliente) P



     on C.CodigoCliente = P.CodigoCliente and C.NombreCliente = P.NombreCliente



where C.Cargos - P.Pagos >0.004999



order by NombreCliente"; 

   }     

   else if ($tipo == "P"){

       $sql = "

           select

   C.CodigoProveedor,

   C.NombreProveedor,
   
   C.DivisionProveedor,
   
   (Select PD.NOMBREDIVISION from PROVEEDORDIVISION PD where PD.CODIGODIVISION = C.divisionproveedor) as NombreDivision,

   C.Cargos,

   P.Pagos,

   C.Cargos - P.Pagos as Saldo

from

   (select

      CodigoProveedor,

      NombreProveedor,
      
      DivisionProveedor,

      Coalesce(Sum(MontoTotal), 0) as Cargos

    from

       CxP

    where

       tipodocumento = 'FCM' or tipodocumento = 'NDB'

    group by CodigoProveedor, NombreProveedor, DivisionProveedor) C



    left join



    (select

      CodigoProveedor,

      NombreProveedor,
      
      DivisionProveedor,

      Coalesce(Sum(MontoTotal), 0) as Pagos

    from

       CxP

    where

       tipodocumento = 'PAG' or tipodocumento = 'NDC'

    group by CodigoProveedor, NombreProveedor, DivisionProveedor) P



     on C.CodigoProveedor = P.CodigoProveedor and C.NombreProveedor = P.NombreProveedor and C.DivisionProveedor= P.DivisionProveedor



where C.Cargos - P.Pagos >0.004999



order by NombreProveedor 

           ";

   }

        

        

   $arsql = array();

   $arsql[] = $sql;

   return urlsafe_b64encode(serialize($arsql));

} //funcion productos total

function movimientosdeudas($clientescodigos, $clientesnombres, $tipo){
   //$clientescodigos es un array con los codigos de los clientes
   //$clientesnombres es un array con los nombres de los clientes, debe estar en el mismo orden que los codigos
   //$tipo:  C = CxC   P = CxP 
   //Devuelve un array con una consulta por cada cliente con su movimiento 
   $sql = "";
   $arsql = array();   
   $i=0;
   foreach ($clientescodigos as $codigo){
    if ($tipo == "C"){
      $sql = "select 
         Correlativo, nombrecliente, Documento, TipoDocumento, 
                FechaIngreso, iif(tipodocumento = 'NDC', MontoTotal* -1, MOntototal)as MOntoTotal, MontoCancelado, 
                iif(tipodocumento = 'NDC', (MontoTotal - MontoCancelado)* -1, MontoTotal - MontoCancelado) as Saldo 
         from cxc 
         where (tipodocumento = 'FAC' or  tipodocumento = 'NDB' or  tipodocumento = 'NDC') and 
               (abs(MontoCancelado - MontoTotal) > 0.1) and 
               (CoalEsce(estatus, 'A') = 'A') and 
               (CodigoCliente = '".$codigo."') and 
               (nombrecliente = '".$clientesnombres[$i]."') 
        order by nombrecliente, FechaIngreso Asc"; 
      $arsql[] = $sql;}
    else{
      $divisiones = implode(",", $clientesnombres);
      $sql = "select Correlativo, NombreProveedor || ' - '|| (Select NombreDivision from PROVEEDORDIVISION where CODIGODIVISION = cxp.divisionproveedor) as NombreProveedor, Documento, 
       TipoDocumento, FechaIngreso, 
       MontoTotal, MontoCancelado, 
       MontoTotal - MontoCancelado as Saldo 
from cxp 
where (tipodocumento = 'FCM' or  tipodocumento = 'NDB') and 
      (abs(MontoCancelado - MontoTotal) > 0.1) and (CoalEsce(estatus, 'A') = 'A') and 
      (CodigoProveedor = '".$codigo."') and 
      (DivisionProveedor in (".$divisiones.")) 
order by nombreproveedor, FechaIngreso Asc"; 
      $arsql[] = $sql;}      
      $i++;
   } //Cierra el for each
   return urlsafe_b64encode(serialize($arsql));
} //MOvimiento sobre deuda

function consultadatossalon(){
   $sql = "SELECT first 1 * FROM EMPRESA";
   $arsql[] = $sql;
   return urlsafe_b64encode(serialize($arsql));
} //Consulta nombre salon


function listamarcas(){
   $sql = "SELECT * FROM MARCA order by NOMBRE";
   $arsql[] = $sql;
   return urlsafe_b64encode(serialize($arsql));
} //Consulta Lista Marca

function listalineas($marca){
   $sql = "SELECT * FROM LINEA WHERE CODIGOMARCA = ".$marca . " order by NOMBRE";
   $arsql[] = $sql;
   return urlsafe_b64encode(serialize($arsql));
} //Consulta Lista de lineas segun marcas

function nombremarca($codigomarca){
   $sql = "SELECT NOMBRE FROM MARCA where CODIGO = $codigomarca";
   $arsql[] = $sql;
   return urlsafe_b64encode(serialize($arsql));
} //Consulta nombre

function nombrelinea($codigolinea){
   $sql = "SELECT * FROM LINEA WHERE CODIGO = ".$codigolinea;
   $arsql[] = $sql;
   return urlsafe_b64encode(serialize($arsql));
} //Consulta nombre linea

function clientesenespera(){
   $sql = "select correlativo, clientenombre, clientecodigo, clientetelf, clientecorreo, horaimpresion, (Select count(*) from vta where vta.ClienteCodigo=vtatemp.ClienteCodigo) as Visitas from VTATEMP where fechaventa = current_date";
   $arsql[] = $sql;
   return urlsafe_b64encode(serialize($arsql));
} //Consulta los clientes en espera

function listadoclientes($desde, $hasta){  
   $sql = "select * from
(select * from
        (select codigo, nombre, telefono, direccion, fechanacimiento,
               correo, iif(coalesce(clientecodigobarra, '') = '', 'F', 'V') as tieneclientcard
        from (select distinct(clientecodigo) as codigocliente from vta where fechaventa >= ".$desde." and fechaventa <= ".$hasta." and tipo = 'FAC') cp

         left join

             clientes
        on cp.codigocliente = clientes.codigo) datoscliente

        left join

       (Select clientecodigo, count(*) as visitasperiodo from vta where fechaventa >= ".$desde." and fechaventa <= ".$hasta." group by clientecodigo) vp

on
datoscliente.codigo = vp.clientecodigo) datosconvp

left join

(Select clientecodigo, avg(total) as gastopromedioperiodo from vta where fechaventa >= ".$desde." and fechaventa <= ".$hasta." group by clientecodigo) promgasto

on
datosconvp.codigo = promgasto.clientecodigo";
   $arsql[] = $sql;
   return urlsafe_b64encode(serialize($arsql));
} //Consulta LISTADO DE CLIENTES

function listadoclientesdetalles($clientes){  
   $sql = "select periodo, clientecodigo, ayo, mes, coalesce(vp, 0) as Visitas, coalesce(promgasto, 0) as PromGastos, NOMBRE, TELEFONO, CORREO from
(select clientecodigo, ayo, mes, cast(ayo as varchar(4))||cast(mes as varchar(2)) as Periodo,
       (Select count(*) as visitasperiodo from vta where extract(year from fechaventa) = ayo and extract(month from fechaventa) = mes and vta.clientecodigo = listado.clientecodigo) vp,
       (Select avg(total) as gastopromedioperiodo from vta where extract(year from fechaventa) = ayo and extract(month from fechaventa) = mes and vta.clientecodigo = listado.clientecodigo) promgasto
from (select distinct clientecodigo, ayo, mes
from
(
select clientecodigo,
        extract(year from fechaventa) as Ayo,
        lpad(extract(month from fechaventa), 2, '0') as Mes
 from vta where clientecodigo in ($clientes) order by Ayo, mes)
) listado) lista

 left join

 clientes

 on

 lista.clientecodigo = clientes.codigo
 order by clientecodigo ASC, periodo DESC";
   $arsql[] = $sql;
   return urlsafe_b64encode(serialize($arsql));
} //Consulta de detalles de clientes

function clientesservicios($clientes){  
   $sql = "select clientecodigo, NOMBRE, TELEFONO, CORREO, nombreasociados, descripcion, serviciosrealizados from
(select clientecodigo, ASOCIADOs.nombre as nombreasociados, descripcion, serviciosrealizados
from
(select clientecodigo,
        ASOCIADO, descripcion, count(*) as serviciosrealizados
 from vta, vtadte
 where correlativo = correlativoprincipal and vta.tipo = vtadte.tipo and
clientecodigo in (".$clientes.")
group by clientecodigo,
        ASOCIADO, descripcion
order by clientecodigo) listado

left join

asociados

on listado.asociado = asociados.codigo) listaasociados

left join

clientes

on listaasociados.clientecodigo = clientes.codigo

order by clientecodigo, nombreasociados, descripcion";
   $arsql[] = $sql;
   return urlsafe_b64encode(serialize($arsql));
} //Consulta de servicios de clientes



function clientesperdidos($dias, $visitas){
   //Ubica los clientes que tengan mas de $dias sin ir al salon
   //y mas de $visitas  visitas
   $sql = "select * from (
select codigo, nombre,
       telefono,
       correo,
       direccion,
       fechanacimiento,
       iif(coalesce(clientecodigobarra, '') = '', 'F', 'V') as tieneclientcard,
       (Select max(fechaventa) from vta where clientecodigo = clientes.codigo) as UltimaVisita,
       DATEDIFF(DAY FROM (Select max(fechaventa) from vta where clientecodigo = clientes.codigo) to CURRENT_DATE) as DiasUltimaVisita,
       (Select count(*)  from vta where clientecodigo = clientes.codigo) as visitastotal
from clientes  )
where DiasUltimaVisita >= ".$dias." and
      visitastotal >= ".$visitas."
order by nombre";
   $arsql[] = $sql;
   return urlsafe_b64encode(serialize($arsql));
} //Consulta los clientes en espera

function asociadosactivos(){
   //Ubica los clientes activos en el salon
   // Devuelve un primer arreglo con los asociados que tengan servicio en el dia
   // Un segundo arreglo con los asociados activos y los trabajos realizados por cada uno
  $arsql = array();
   $sql = "select coalesce(TRABAJADO, 0) as TRABAJADO from ( Select count(*) as TRABAJADO from (
           Select Distinct asociado
           from vta,  vtadte
           where vta.correlativo = vtadte.correlativoprincipal and
           vta.tipo = vtadte.tipo and
           vta.fechaventa = current_date))";
   $arsql[] = $sql;

   $sql = "select codigo, nombre, coalesce(telefono, '') as TELEFONO, coalesce(trabajos, 0) as trabajos
from (select * from asociados where porcservicio > 0 and estatus  ='A') as asoci
   left join
(Select asociado, count(*) as trabajos
from  vta,  vtadte
where vta.correlativo = vtadte.correlativoprincipal and
      vta.tipo = vtadte.tipo and
      vta.fechaventa = current_date
group by asociado) listatrabajos
   on asoci.codigo = listatrabajos.asociado
order by trabajos DESC";
   $arsql[] = $sql;

   return urlsafe_b64encode(serialize($arsql));
} //Consulta los clientes en espera

function listadocomisiones($desde1, $hasta1){ 

  $desde = "'".$desde1."'";
  $hasta = "'".$hasta1."'";
  $arsql = array();
 
   //PAra el total de comisiones 
   $sql = "select Codigo,
   Nombre,
   PorcServicio,
   TipoAsociado, estatus,
   sum(Total) as total,
   sum(Neto) as neto,
   sum(Comision) as comision,
   sum(Serviciosrealizados) as serviciosrealizados,
   sum(Coalesce(MontoGcr, 0)) as montogcr,
   sum(coalesce(ComisionGcr, 0)) as ComisionGCR
from
(select Codigo,
   coalesce(Nombre, 'No Info Asociado') as Nombre,
   PorcServicio,
   Total,
   Neto,
   Comision,
   serviciosrealizados,
   TipoAsociado,
   estatus,
   Coalesce(MontoGcr, 0) as montogcr,
   coalesce(ComisionGcr, 0) as ComisionGCR
from
(select
   F.Asociado as Codigo,
   A.Nombre,
   A.PorcServicio,
   A.tipoasociado, A.estatus,
   Sum(case when tipo = 'DEV' then
          ((coalesce(preciosiniva, 0) - descuento - descuentopuntos) * cantidad) * (1 + (PorcIva /100)) * -1
       else
          ((coalesce(preciosiniva, 0) - descuento - descuentopuntos) * cantidad) * (1 + (PorcIva /100))
       end) as Total,
   Sum(case when tipo = 'DEV' then
          ((coalesce(preciosiniva, 0) - descuento -  descuentopuntos) * cantidad) * -1
       else
          ((coalesce(preciosiniva, 0) - descuento - descuentopuntos) * cantidad) end) as Neto,
   Sum(case when tipo = 'DEV' then
          (((coalesce(preciosiniva, 0) - descuento - descuentopuntos) * cantidad) * (PorcCom / 100)) * -1
       else
          (((coalesce(preciosiniva, 0) - descuento - descuentopuntos) * cantidad) * (PorcCom / 100))
       end) as Comision,
   Sum(case when tipo = 'DEV' then
          (coalesce(cantidad, 0)) * -1
       else
          coalesce(cantidad, 0)
       end) as ServiciosRealizados
from
      (Select vta.fechaventa, vtadte.* from vta
         left join
       VTAdte
          on
       vta.correlativo = vtadte.correlativoprincipal
       and vta.Tipo = vtadte.Tipo

       where TipoProducto = 'S'
       and vtadte.tipo in ('FAC', 'DEV')) F

          left join

       Asociados A on F.Asociado = A.Codigo

where F.fechaventa >= ".$desde." and F.fechaventa <= ".$hasta." group by F.Asociado, A.Nombre, a.PorcServicio, a.tipoasociado, a.estatus order by A.Nombre) CCD

left join

(Select        asociado as aso,
               Coalesce(Sum(coalesce(vtadte.Total, 0)), 0) as MontoGcr,
               coalesce(Sum((((coalesce(vtadte.preciosiniva, 0) - vtadte.descuento) * cantidad) * (PorcCom / 100))), 0) as ComisionGcr
        from vta left join vtadte on vta.correlativo = vtadte.correlativoprincipal and vta.tipo = vtadte.tipo
        where vta.tipo = 'GCR'
        and vtadte.tipoproducto = 'S'
        and fechaventa >= ".$desde."
        and fechaventa <= ".$hasta."
        group by aso) GCR
on

CCD.Codigo = Gcr.Aso)


group by
Codigo, Nombre, PorcServicio, TipoAsociado, estatus";

$arsql[] = $sql;
   

return urlsafe_b64encode(serialize($arsql));
} //Consulta las comisiones asociados


function listadocomisionesdetalles($desde1, $hasta1, $asociados){ 
  //$asociados, string separado por comas que tiene la lista de asociados seleccionados
  $desde = "'".$desde1."'";
  $hasta = "'".$hasta1."'";
  $arsql = array();

  
  //Para el detalle diario de comisiones
  $sql="select Codigo,
   Nombre,
   PorcServicio,
   TipoAsociado,
   estatus,
   FechaVenta,
   sum(Total) as total,
   sum(Neto) as neto,
   sum(Comision) as comision,
   sum(Serviciosrealizados) as serviciosrealizados,
   sum(Coalesce(MontoGcr, 0)) as montogcr,
   sum(coalesce(ComisionGcr, 0)) as ComisionGCR
from
(select Codigo,
   coalesce(Nombre, 'No Info Asociado') as Nombre,
   PorcServicio,
   FechaVenta,
   Total,
   Neto,
   Comision,
   Serviciosrealizados,
   TipoAsociado,
   estatus,
   Coalesce(MontoGcr, 0) as montogcr,
   coalesce(ComisionGcr, 0) as ComisionGCR
from
(select
   F.Asociado as Codigo,
   A.Nombre,
   A.PorcServicio,
   A.tipoasociado,
   A.estatus,
   F.Fechaventa,
   Sum(case when tipo = 'DEV' then
          ((coalesce(preciosiniva, 0) - descuento - descuentopuntos) * cantidad) * (1 + (PorcIva /100)) * -1
       else
          ((coalesce(preciosiniva, 0) - descuento - descuentopuntos) * cantidad) * (1 + (PorcIva /100))
       end) as Total,
   Sum(case when tipo = 'DEV' then
          ((coalesce(preciosiniva, 0) - descuento -  descuentopuntos) * cantidad) * -1
       else
          ((coalesce(preciosiniva, 0) - descuento - descuentopuntos) * cantidad) end) as Neto,
   Sum(case when tipo = 'DEV' then
          (((coalesce(preciosiniva, 0) - descuento - descuentopuntos) * cantidad) * (PorcCom / 100)) * -1
       else
          (((coalesce(preciosiniva, 0) - descuento - descuentopuntos) * cantidad) * (PorcCom / 100))
       end) as Comision,
   Sum(case when tipo = 'DEV' then
          (coalesce(cantidad, 0)) * -1
       else
          coalesce(cantidad, 0)
       end) as ServiciosRealizados
from
      (Select vta.fechaventa, vtadte.* from vta
         left join
       VTAdte
          on
       vta.correlativo = vtadte.correlativoprincipal
       and vta.Tipo = vtadte.Tipo

       where TipoProducto = 'S'
       and vtadte.tipo in ('FAC', 'DEV')) F

          left join

       Asociados A on F.Asociado = A.Codigo

where F.fechaventa >= ".$desde." and F.fechaventa <= ".$hasta." group by F.asociado, A.Nombre, a.PorcServicio, a.tipoasociado, a.estatus, F.Fechaventa order by A.Nombre) CCD

left join

(Select        asociado as aso,
               fechaventa as fv,
               Coalesce(Sum(coalesce(vtadte.Total, 0)), 0) as MontoGcr,
               coalesce(Sum((((coalesce(vtadte.preciosiniva, 0) - vtadte.descuento) * cantidad) * (PorcCom / 100))), 0) as ComisionGcr
        from vta left join vtadte on vta.correlativo = vtadte.correlativoprincipal and vta.tipo = vtadte.tipo
        where vta.tipo = 'GCR'
        and vtadte.tipoproducto = 'S'
        and fechaventa >= ".$desde."
        and fechaventa <= ".$hasta."
        group by aso, fechaventa) GCR
on

CCD.Codigo = Gcr.Aso and ccd.fechaventa = gcr.fv)

where codigo in (".$asociados.")

group by
Codigo, Nombre, PorcServicio, TipoAsociado, estatus, fechaventa";
   
$arsql[] = $sql;
return urlsafe_b64encode(serialize($arsql));
} //Consulta las comisiones asociados detalle diario


function conciliaciondiaria($fecha, $asociados){ 
  //$asociados, string separado por comas que tiene la lista de asociados seleccionados
  $fecha = "'".$fecha."'";  
  $asociados = "'".$asociados."'";  
  $arsql = array();

  
  //Para el detalle diario de comisiones
  $sql="Select
   Asociado,
   iif(tipo = 'DEV', ((coalesce(preciosiniva, 0) - descuento - descuentopuntos) * cantidad) * (1 + (PorcIva /100)) * -1, ((coalesce(preciosiniva, 0) - descuento - descuentopuntos) * cantidad) * (1 + (PorcIva /100))) as Monto,
   Tipo,
   Descripcion,
   CorrelativoPrincipal,
   (Select ClienteNombre from vta
    where correlativo = correlativoprincipal and vta.tipo = vtadte.tipo) as Cliente,
   (Select Correlativopos from vta
    where correlativo = correlativoprincipal and vta.tipo = vtadte.tipo) as Control

from
   vtadte
where
   (Select max(fechaventa) from vta
   where correlativo = correlativoprincipal and vta.tipo = vtadte.tipo) = ".$fecha." and
         asociado = ".$asociados;
   
$arsql[] = $sql;
return urlsafe_b64encode(serialize($arsql));
} //Consulta las comisiones asociados detalle diario

function serviciosasociados($desde, $hasta, $asociados){ 
  //$asociados, string separado por comas que tiene la lista de asociados seleccionados
  $desde = "'".$desde."'";  
  $hasta = "'".$hasta."'";  

  $arsql = array();
  //Para el detalle diario de comisiones
  $sql="select vd.asociado as CODIGO,
       (Select Nombre from asociados a  where a.codigo = vd.asociado) as Nombre,
       (Select Estatus from asociados a  where a.codigo = vd.asociado) as Estatus,
       vd.codigoproducto,
       vd.descripcion,
       sum(iif(vd.tipo = 'DEV', cantidad * -1, cantidad)) as Realizados
from vta v, vtadte vd
where v.correlativo = vd.correlativoprincipal and
      v.fechaventa >= ".$desde." and
      v.fechaventa <= ".$hasta." and
      vd.asociado in (".$asociados.")
group by vd.asociado,
       vd.codigoproducto,
       vd.descripcion
order by Asociado, Realizados DESC";
   
$arsql[] = $sql;
return urlsafe_b64encode(serialize($arsql));
} //Consulta los servicios de los asociados

function clientesatendidos($desde, $hasta, $asociados){ 
  //$asociados, string separado por comas que tiene la lista de asociados seleccionados
  $desde = "'".$desde."'";  
  $hasta = "'".$hasta."'";  

  $arsql = array();
  //Para el detalle diario de comisiones
  $sql="select vd.asociado as CODIGO,
       (Select Nombre from asociados a  where a.codigo = vd.asociado) as Nombre,
       (Select Estatus from asociados a  where a.codigo = vd.asociado) as Estatus,
       v.clientecodigo,
       V.clientenombre,
       (Select Telefono from clientes c  where c.codigo = v.clientecodigo) as Telefono,
       (Select Correo   from clientes c  where c.codigo = v.clientecodigo) as Correo,
       sum(iif(vd.tipo = 'DEV', cantidad * -1, cantidad)) as Realizados
from vta v, vtadte vd
where v.correlativo = vd.correlativoprincipal and
      v.fechaventa >= ".$desde." and
      v.fechaventa <= ".$hasta." and
      vd.asociado in (".$asociados.")
group by vd.asociado,
       v.clientecodigo,
       V.clientenombre
order by Asociado, Realizados DESC";
   
$arsql[] = $sql;
return urlsafe_b64encode(serialize($arsql));
} //Consulta los clientes de los asociados

/********************************************
***** CONSULTAS DE SERVICIOS         ********
********************************************/
function serviciosactivos(){ 
  
  $arsql = array();
  //Para los servicios activos
  $sql="select Descripcion, sum(cantidad) as Realizados 
from vta, vtadte 
where correlativo = correlativoprincipal and 
      vta.tipo = vtadte.tipo and 
      fechaventa = current_date and
      vtadte.tipoproducto = 'S' and
      vta.total <> 0
group by Descripcion
order by Realizados DESC";
   
$arsql[] = $sql;
return urlsafe_b64encode(serialize($arsql));
} //Consulta los clientes de los asociados

function listadoservicios($desde, $hasta){
  $desde = "'".$desde."'";
  $hasta = "'".$hasta."'";
  $arsql = array();
  $sql   = "
select Descripcion, 
       vtadte.tipo,
       sum(cantidad) as Realizados, 
       sum(vtadte.PRECIOSINIVA * vtadte.cantidad) as PreciosinImpuesto, 
       sum(vtadte.DESCUENTO * vtadte.cantidad) as DescLineas,
       sum(((vtadte.PRECIOSINIVA * vtadte.cantidad) - (vtadte.DESCUENTO * vtadte.cantidad)) *  (((vta.DESCUENTO * 100)/subtotal)/100)) as DescuentoGlobal,
       sum(((vtadte.PRECIOSINIVA * vtadte.cantidad) - (vtadte.DESCUENTO * vtadte.cantidad)) *  ((vta.PORCPUNTOS/100))) as MontoRedimido
from vta, vtadte 
where correlativo = correlativoprincipal and 
      vta.tipo = vtadte.tipo and 
      fechaventa >= ".$desde." and fechaventa <= ".$hasta." and 
      vtadte.tipoproducto = 'S' and
      vta.total <> 0
group by Descripcion, Tipo
order by Realizados DESC";
$arsql[] = $sql;
return urlsafe_b64encode(serialize($arsql));
}







?>

