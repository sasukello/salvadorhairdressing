<div class="modal fade" id="BSParentModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <div class="modal-header bg-theme-colored">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title text-white" id="myModalLabel">Formulario de Registro</h4>
      </div>
      <div class="p-40">
        <!-- Reservation Form Start-->
          <form id="reservation_form_popup" name="reservation_form" class="reservation-form" method="post" action="includes/reservation.php"><h3 class="mt-0 line-bottom text-theme-colored mb-40">Inscríbete y Aprende un<span class="text-theme-colored font-weight-600"> Arte!</span></h3>
            <div class="row">
              <div class="col-sm-4">
                <div class="form-group mb-20">
                  <div class="styled-select">
                    <select id="carrr_select" name="identificacion" class="form-control" >
                      <option value="">- Identificación -</option>
                      <option value="ci">Cedula de Identidad</option>
                      <option value="pp">Pasaporte</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-sm-2">
                <div class="form-group mb-20">
                  <div class="styled-select">
                    <select id="carr_select" name="type_select" class="form-control" >
                      <option value=""> -- </option>
                      <option value="ven">V</option>
                      <option value="ven">E</option>
                      <option value="ven">P</option>
                      <option value="ven">J</option>
                      <option value="ven">G</option>
                      <option value="ven">I</option>
                      <option value="ven">M</option>
                      <option value="ven">R</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group mb-20">
                  <input placeholder="Número de Identificación" type="text" id="inscripcion_id" name="inscripcion_id" required="" class="form-control">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group mb-20">
                  <input placeholder="Nombres" type="text" id="inscripcion_nombre" name="inscripcion_nombre"  required="" class="form-control">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group mb-20">
                  <input placeholder="Apellidos" type="text" id="inscripcion_apellido" name="inscripcion_apellido" required="" class="form-control">
                </div>
              </div>
              <div class="col-sm-5">
                <div class="form-group mb-20">
                  <input name="inscripcion_fn" class="form-control required date-picker" type="text" placeholder="Fecha de Nacimiento" aria-required="true">
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group mb-20">
                  <select class="form-control bfh-countries" data-country="US"></select>
                  <!--input placeholder="Nacionalidad" type="text" id="inscripcion_nacionalidad" name="inscripcion_nacionalidad" required="" class="form-control"-->
                </div>
              </div>
              <div class="col-sm-3">
                <div class="form-group mb-20">
                  <div class="styled-select">
                    <select id="car_select" name="car_select" class="form-control" required="">
                      <option value="">- Sexo -</option>
                      <option value="ven">Masculino</option>
                      <option value="ven">Femenino</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group mb-20">
                  <input placeholder="Correo electrónico" type="email" id="inscripcion_correo" name="inscripcion_email" class="form-control" required="">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group mb-20">
                  <input placeholder="Teléfono de Habitación" type="text" id="inscripcion_telef1" name="inscripcion_telefono" class="form-control" required="">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group mb-20">
                  <input placeholder="Teléfono Celular 1" type="text" id="inscripcion_telef2" name="inscripcion_telefono" class="form-control" required="">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group mb-20">
                  <input placeholder="Teléfono Celular 2" type="text" id="inscripcion_telef3" name="inscripcion_telefono" class="form-control" required="">
                </div>
              </div>
              <div class="col-sm-12">
                <div class="form-group mb-20">
                  <textarea placeholder="Dirección de Residencia" name="form_address" class="form-control" cols="20" rows="2"></textarea>
                </div>
              </div>
              <div class="col-sm-12">
                <div class="form-group mb-0 mt-0">
                  <input name="form_botcheck" class="form-control" type="hidden" value="">
                  <button type="submit" class="btn btn-colored btn-theme-colored btn-lg btn-flat border-left-theme-colored-4px" data-loading-text="Please wait...">Registrar</button>
                </div>
              </div>
            </div>
          </form>
          <!-- Reservation Form End-->
      </div>
      <!-- Footer Scripts -->

    </div>
  </div>
</div>



<script>
  //reload date and time picker
  THEMEMASCOT.initialize.TM_datePicker();
</script>