<style type="text/css">
  #campo64, #campo67 {
    display: none;
  }
</style>

<div class="col-sm-12">
  <div class="form-group cuestionario inner-addon left-addon">
    <h6 for="quest61"><?php echo _('¿Cómo supo de nosotros?'); ?></h6>
    <i class="far fa-dot-circle" id="icon-input"></i>
    <select class="left-addon" name="quest61" id="quest61">
      <option value="">Seleccione una opción</option>
      <option value="opt-1">Es cliente</option>
      <option value="opt-2">Por un amigo</option>
      <option value="opt-3">Página web</option>
      <option value="opt-4">Buscador</option>
      <option value="opt-5">Otros</option>
    </select>
    <span id="errorquest61"></span>
  </div>
</div>

<div class="col-sm-12">
  <div class="form-group cuestionario inner-addon left-addon">
    <h6 for="quest62"><?php echo _('¿En cuál país trabaja o tiene establecido su unidad de negocio?'); ?></h6>
    <i class="fas fa-globe" id="icon-input"></i>
    <select class="form-control bfh-countries" id="quest62" name="quest62" data-country="0"></select>
    <span id="errorquest62"></span>
  </div>
</div>

<div class="col-sm-12">
  <div class="form-group cuestionario  inner-addon left-addon">
    <h6 for="quest63"><?php echo _('¿Su cónyuge participará?'); ?></h6>
    <div class="text-left">
      <input name="quest63" type="radio" id="61" value="61"/><label for="61"><?php echo _('Si'); ?></label>
      <input name="quest63" type="radio" id="62" value="62"/><label for="62"><?php echo _('No'); ?></label>
    </div>                                    
    <span id="errorquest63"></span>
  </div>
</div>

<div class="col-sm-12">
  <div class="form-group cuestionario  inner-addon left-addon">
    <h6 for="quest64"><?php echo _('¿Está interesado en invertir solo o con un socio, cuantos? <small>Si la respuesta es si, indique cuantos. </small>'); ?></h6>
    <div class="text-left">
      <div class="col-sm-6 ps-0">
        <input name="quest64" type="radio" id="63" onclick="campo(this.value)" value="63" /><label for="63"><?php echo _('Si'); ?></label>
        <input name="quest64" type="radio" id="64" onclick="campo(this.value)" value="64" /><label for="64"><?php echo _('No'); ?></label>
      </div>
      <div class="col-sm-6 ps-0">

        <span id="campo64">
          <select class="left-addon" name="ansq64" id="ansq64">
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
    <span id="errorquest64"></span>
  </div>
</div>

<div class="col-sm-12">
  <div class="form-group cuestionario  inner-addon left-addon">
    <h6 for="quest65"><?php echo _('¿Cuánto estaría dispuesto a invertir en su unidad de negocio?'); ?></h6>
    <i class="far fa-money-bill-alt" id="icon-input"></i>
    <select class="left-addon" name="quest65" id="quest65">
      <option value="">Seleccione una opción</option>
      <option value="opt-6">$ 0 - 100.000,00</option>
      <option value="opt-7">$ 100.001,00 - 200.000,00</option>
      <option value="opt-8">$ 200.001,00 - más</option>
    </select>
    <span id="errorquest65"></span>
  </div>
</div>

<div class="col-sm-12">
  <div class="form-group cuestionario  inner-addon left-addon">
    <h6 for="quest66"><?php echo _('¿Tiene usted conocimiento de operaciones con franquicias?'); ?></h6>
    <div class="text-left">
      <input name="quest66" type="radio" id="65" value="65" /><label for="65"><?php echo _('Si'); ?></label>
      <input name="quest66" type="radio" id="66" value="66" /><label for="66"><?php echo _('No'); ?></label>
    </div>                                    
    <span id="errorquest66"></span>
  </div>
</div>

<div class="col-sm-12">
  <div class="form-group cuestionario  inner-addon left-addon">
    <h6 for="quest67"><?php echo _('¿Conoce a algún franquiciado de Salvador? <small>Si la respuesta es sí, por favor indique el nombre del franquiciado. </small>'); ?></h6>
    <div class="text-left">
      <div class="col-sm-6 ps-0">
        <input type="radio" name="quest67" id="67" onclick="campo(this.value)" value="67" /><label for="67"><?php echo _('Si'); ?></label>
        <input type="radio" name="quest67" id="68" onclick="campo(this.value)" value="68" /><label for="68"><?php echo _('No'); ?></label>
      </div>
      <div class="col-sm-6 ps-0">

        <span id="campo67">
          <input type='text' name='ansq67' id='ansq67' class='form-control' placeholder='Ingrese su Respuesta'>
        </span>

      </div>
    </div>                                    
    <span id="errorquest67"></span>
  </div>
</div>

<div class="col-sm-12">
  <div class="form-group cuestionario  inner-addon left-addon">
    <h6 for="quest68"><?php echo _('¿Dedicación a tiempo completo?'); ?></h6>
    <div class="text-left">
      <input name="quest68" type="radio" id="69" value="69" /><label for="69"><?php echo _('Si'); ?></label>
      <input name="quest68" type="radio" id="70" value="70" /><label for="70" disabled><?php echo _('No'); ?></label>
      <label>Para enviar este formulario es necesario que posea disponibilidad a tiempo completo.</label>
    </div>                                    
    <span id="errorquest68"></span>
  </div>
</div>