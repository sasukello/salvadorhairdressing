<style type="text/css">
  #campo4, #campo6, #campo7, #campo8, #campo11 {
    display: none;
  }
</style>

<div class="col-sm-12">
  <div class="form-group cuestionario inner-addon left-addon">
    <h6 for="quest1"><?php echo _('¿Cómo supo de nosotros?'); ?></h6>
    <i class="far fa-dot-circle" id="icon-input"></i>
    <select class="left-addon" name="quest1" id="quest1">
      <option value="">Seleccione una opción</option>
      <option value="opt-1">Es cliente</option>
      <option value="opt-2">Por un amigo</option>
      <option value="opt-3">Página web</option>
      <option value="opt-4">Buscador</option>
      <option value="opt-5">Otros</option>
    </select>
    <span id="errorquest1"></span>
  </div>
</div>

<div class="col-sm-12">
  <div class="form-group cuestionario inner-addon left-addon">
    <h6 for="quest2"><?php echo _('¿En cuál país desea abrir su negocio?'); ?></h6>
    <i class="fas fa-globe" id="icon-input"></i>
    <select class="form-control bfh-countries" id="quest2" name="quest2" data-country="0"></select>
    <span id="errorquest2"></span>
  </div>
</div>

<div class="col-sm-12">
  <div class="form-group cuestionario  inner-addon left-addon">
    <h6 for="quest3"><?php echo _('¿Su cónyuge participará?'); ?></h6>
    <div class="text-left">
      <input name="quest3" type="radio" id="1" value="1"/><label for="1"><?php echo _('Si'); ?></label>
      <input name="quest3" type="radio" id="2" value="2"/><label for="2"><?php echo _('No'); ?></label>
    </div>                                    
    <span id="errorquest3"></span>
  </div>
</div>

<div class="col-sm-12">
  <div class="form-group cuestionario  inner-addon left-addon">
    <h6 for="quest4"><?php echo _('¿Está interesado en invertir solo o con un socio, cuantos? <small>Si la respuesta es si, indique cuantos. </small>'); ?></h6>
    <div class="text-left">
      <div class="col-sm-6 ps-0">
        <input name="quest4" type="radio" id="3" onclick="campo(this.value)" value="3" /><label for="3"><?php echo _('Si'); ?></label>
        <input name="quest4" type="radio" id="4" onclick="campo(this.value)" value="4" /><label for="4"><?php echo _('No'); ?></label>
      </div>
      <div class="col-sm-6 ps-0">

        <span id="campo4">
          <select class="left-addon" name="ansq4" id="ansq4">
            <option value="">Seleccione una opción</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
          </select>
        </span>

      </div>
    </div>                                    
    <span id="errorquest4"></span>
  </div>
</div>

<div class="col-sm-12">
  <div class="form-group cuestionario  inner-addon left-addon">
    <h6 for="quest5"><?php echo _('¿Cuánto estaría dispuesto a invertir en su unidad de negocio?'); ?></h6>
    <i class="far fa-money-bill-alt" id="icon-input"></i>
    <select class="left-addon" name="quest5" id="quest5">
      <option value="">Seleccione una opción</option>
      <option value="opt-6">$ 0 - 100.000,00</option>
      <option value="opt-7">$ 100.001,00 - 200.000,00</option>
      <option value="opt-8">$ 200.001,00 - más</option>
    </select>
    <span id="errorquest5"></span>
  </div>
</div>

<div class="col-sm-12">
  <div class="form-group cuestionario  inner-addon left-addon">
    <h6 for="quest6"><?php echo _('¿Es usted propietario de algún negocio o franquicia? <small>Si la respuesta es sí, por favor especifique el nombre. </small>'); ?></h6>
    <div class="text-left">
      <div class="col-sm-6 ps-0">
        <input name="quest6" type="radio" id="5" onclick="campo(this.value)" value="5" /><label for="5"><?php echo _('Si'); ?></label>
        <input name="quest6" type="radio" id="6" onclick="campo(this.value)" value="6" /><label for="6"><?php echo _('No'); ?></label>
      </div>
      <div class="col-sm-6 ps-0">

        <span id="campo6">
          <input type='text' name='ansq6' id='ansq6' class='form-control' placeholder='Ingrese su Respuesta'>
        </span>

      </div>
    </div>                                    
    <span id="errorquest6"></span>
  </div>
</div>

<div class="col-sm-12">
  <div class="form-group cuestionario  inner-addon left-addon">
    <h6 for="quest7"><?php echo _('¿Conoce a algún franquiciado de Salvador? <small>Si la respuesta es sí, por favor indique el nombre. </small>'); ?></h6>
    <div class="text-left">
      <div class="col-sm-6 ps-0">
        <input type="radio" name="quest7" id="7" onclick="campo(this.value)" value="7" /><label for="7"><?php echo _('Si'); ?></label>
        <input type="radio" name="quest7" id="8" onclick="campo(this.value)" value="8" /><label for="8"><?php echo _('No'); ?></label>
      </div>
      <div class="col-sm-6 ps-0">

        <span id="campo7">
          <input type='text' name='ansq7' id='ansq7' class='form-control' placeholder='Ingrese su Respuesta'>
        </span>

      </div>
    </div>                                    
    <span id="errorquest7"></span>
  </div>
</div>

<div class="col-sm-12">
  <div class="form-group cuestionario  inner-addon left-addon">
    <h6 for="quest8"><?php echo _('¿Estaría Ud. involucrado en la operación de franquicia? <small>Si la respuesta es sí, por favor escriba su nombre y apellido. </small>'); ?></h6>
    <div class="text-left">
      <div class="col-sm-6 ps-0">
        <input name="quest8" type="radio" id="9" onclick="campo(this.value)" value="9" /><label for="9"><?php echo _('Si'); ?></label>
        <input name="quest8" type="radio" id="10" onclick="campo(this.value)" value="10" /><label for="10"><?php echo _('No'); ?></label>
      </div>
      <div class="col-sm-6 ps-0">

        <span id="campo8">
          <input type='text' name='ansq8' id='ansq8' class='form-control' placeholder='Ingrese su Respuesta'>
        </span>

      </div>
    </div>                                    
    <span id="errorquest8"></span>
  </div>
</div>

<div class="col-sm-12">
  <div class="form-group cuestionario  inner-addon left-addon">
    <h6 for="quest9"><?php echo _('¿Dedicación a tiempo completo?'); ?></h6>
    <div class="text-left">
      <input name="quest9" type="radio" id="11" value="11" /><label for="11"><?php echo _('Si'); ?></label>
      <input name="quest9" type="radio" id="12" value="12" disabled/><label for="12"><?php echo _('No'); ?></label>
      <label>Para enviar este formulario es necesario que posea disponibilidad a tiempo completo.</label>
    </div>                                    
    <span id="errorquest9"></span>
  </div>
</div>

<div class="col-sm-12">
  <div class="form-group cuestionario  inner-addon left-addon">
    <h6 for="quest10"><?php echo _('¿En cuánto tiempo quiere aperturar su negocio?'); ?></h6>
    <i class="far fa-clock" id="icon-input"></i>
    <select class="left-addon" name="quest10" id="quest10">
      <option value="">Seleccione una opción</option>
      <option value="opt-9">3 meses</option>
      <option value="opt-10">5 meses</option>
      <option value="opt-11">1 año</option>
    </select>
    <span id="errorquest10"></span>
  </div>
</div>

<div class="col-sm-12">
  <div class="form-group cuestionario  inner-addon left-addon">
    <h6 for="quest11"><?php echo _('¿Cuenta con un lugar para la franquicia? <small>Si la respuesta es sí, por favor indique la dirección del local. </small>'); ?></h6>
    <div class="text-left">
      <div class="col-sm-12 ps-0">
        <input name="quest11" type="radio" id="13" onclick="campo(this.value)" value="13" /><label for="13"><?php echo _('Si'); ?></label>
        <input name="quest11" type="radio" id="14" onclick="campo(this.value)" value="14" /><label for="14"><?php echo _('No'); ?></label>
      </div>
      <div class="col-sm-12 ps-0">

        <span id="campo11">
          <input type='text' name='ansq11' id='ansq11' class='form-control' placeholder='Ingrese su Respuesta'>
        </span>

      </div>
    </div>                                    
    <span id="errorquest11"></span>
  </div>
</div>