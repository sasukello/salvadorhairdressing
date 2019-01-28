<style type="text/css">
  #campo23, #campo25, #campo26, #campo28, #campo30, #campo31 {
    display: none;
  }
</style>

<div class="col-sm-12">
  <div class="form-group cuestionario inner-addon left-addon">
    <h6 for="quest21"><?php echo _('¿Cómo supo de nosotros?'); ?></h6>
    <i class="far fa-dot-circle" id="icon-input"></i>
    <select class="left-addon" name="quest21" id="quest21">
      <option value="">Seleccione una opción</option>
      <option value="opt-1">Es cliente</option>
      <option value="opt-2">Por un amigo</option>
      <option value="opt-3">Página web</option>
      <option value="opt-4">Buscador</option>
      <option value="opt-5">Otros</option>
    </select>
    <span id="errorquest21"></span>
  </div>
</div>

<div class="col-sm-12">
  <div class="form-group cuestionario inner-addon left-addon">
    <h6 for="quest22"><?php echo _('¿En cuál país desea abrir su negocio?'); ?></h6>
    <i class="fas fa-globe" id="icon-input"></i>
    <select class="form-control bfh-countries" id="quest22" name="quest22" data-country="0"></select>
    <span id="errorquest22"></span>
  </div>
</div>

<div class="col-sm-12">
  <div class="form-group cuestionario  inner-addon left-addon">
    <h6 for="quest23"><?php echo _('¿Está interesado en invertir solo o con un socio, cuantos? <small>Si la respuesta es si, indique cuantos. </small>'); ?></h6>
    <div class="text-left">
      <div class="col-sm-6 ps-0">
        <input name="quest23" type="radio" id="21" onclick="campo(this.value)" value="21" /><label for="21"><?php echo _('Si'); ?></label>
        <input name="quest23" type="radio" id="22" onclick="campo(this.value)" value="22" /><label for="22"><?php echo _('No'); ?></label>
      </div>
      <div class="col-sm-6 ps-0">

        <span id="campo23">
          <select class="left-addon" name="ansq23" id="ansq23">
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
    <span id="errorquest23"></span>
  </div>
</div>

<div class="col-sm-12">
  <div class="form-group cuestionario  inner-addon left-addon">
    <h6 for="quest24"><?php echo _('¿Cuánto estaría dispuesto a invertir en su unidad de negocio?'); ?></h6>
    <i class="far fa-money-bill-alt" id="icon-input"></i>
    <select class="left-addon" name="quest24" id="quest24">
      <option value="">Seleccione una opción</option>
      <option value="opt-6">$ 0 - 100.000,00</option>
      <option value="opt-7">$ 100.001,00 - 200.000,00</option>
      <option value="opt-8">$ 200.001,00 - más</option>
    </select>
    <span id="errorquest24"></span>
  </div>
</div>

<div class="col-sm-12">
  <div class="form-group cuestionario  inner-addon left-addon">
    <h6 for="quest25"><?php echo _('¿Es usted propietario de algún negocio o franquicia? <small>Si la respuesta es sí, por favor especifique el nombre. </small>'); ?></h6>
    <div class="text-left">
      <div class="col-sm-6 ps-0">
        <input name="quest25" type="radio" id="23" onclick="campo(this.value)" value="23" /><label for="23"><?php echo _('Si'); ?></label>
        <input name="quest25" type="radio" id="24" onclick="campo(this.value)" value="24" /><label for="24"><?php echo _('No'); ?></label>
      </div>
      <div class="col-sm-6 ps-0">

        <span id="campo25">
          <input type='text' name='ansq25' id='ansq25' class='form-control' placeholder='Ingrese su Respuesta'>
        </span>

      </div>
    </div>                                    
    <span id="errorquest25"></span>
  </div>
</div>

<div class="col-sm-12">
  <div class="form-group cuestionario  inner-addon left-addon">
    <h6 for="quest26"><?php echo _('¿Conoce a algún franquiciado de Salvador? <small>Si la respuesta es sí, por favor indique el nombre. </small>'); ?></h6>
    <div class="text-left">
      <div class="col-sm-6 ps-0">
        <input type="radio" name="quest26" id="25" onclick="campo(this.value)" value="25" /><label for="25"><?php echo _('Si'); ?></label>
        <input type="radio" name="quest26" id="26" onclick="campo(this.value)" value="26" /><label for="26"><?php echo _('No'); ?></label>
      </div>
      <div class="col-sm-6 ps-0">

        <span id="campo26">
          <input type='text' name='ansq26' id='ansq26' class='form-control' placeholder='Ingrese su Respuesta'>
        </span>

      </div>
    </div>                                    
    <span id="errorquest26"></span>
  </div>
</div>


<div class="col-sm-12">
  <div class="form-group cuestionario  inner-addon left-addon">
    <h6 for="quest27"><?php echo _('¿Estaría usted dispuesto al aprendizaje para el manejo de la franquicia?'); ?></h6>
    <div class="text-left">
      <input name="quest27" type="radio" id="27" value="27"/><label for="27"><?php echo _('Si'); ?></label>
      <input name="quest27" type="radio" id="28" value="28"/><label for="28"><?php echo _('No'); ?></label>
    </div>                                    
    <span id="errorquest27"></span>
  </div>
</div>

<div class="col-sm-12">
  <div class="form-group cuestionario  inner-addon left-addon">
    <h6 for="quest28"><?php echo _('¿Tiene personal considerado para llevar a cabo la operación? <small>Si la respuesta es sí, por favor especifique. </small>'); ?></h6>
    <div class="text-left">
      <div class="col-sm-6 ps-0">  
        <input name="quest28" type="radio" onclick="campo(this.value)" id="29" value="29"/><label for="29"><?php echo _('Si'); ?></label>
        <input name="quest28" type="radio" onclick="campo(this.value)" id="30" value="30"/><label for="30"><?php echo _('No'); ?></label>
      </div>
      <div class="col-sm-6 ps-0">

        <span id="campo28">
          <input type='text' name='ansq28' id='ansq28' class='form-control' placeholder='Ingrese su Respuesta'>
        </span>

      </div>
    </div>                                    
    <span id="errorquest28"></span>
  </div>
</div>

<div class="col-sm-12">
  <div class="form-group cuestionario  inner-addon left-addon">
    <h6 for="quest29"><?php echo _('¿En cuánto tiempo quiere aperturar su negocio?'); ?></h6>
    <i class="far fa-clock" id="icon-input"></i>
    <select class="left-addon" name="quest29" id="quest29">
      <option value="">Seleccione una opción</option>
      <option value="opt-9">3 meses</option>
      <option value="opt-10">5 meses</option>
      <option value="opt-11">1 año</option>
    </select>
    <span id="errorquest29"></span>
  </div>
</div>

<div class="col-sm-12">
  <div class="form-group cuestionario  inner-addon left-addon">
    <h6 for="quest30"><?php echo _('¿Está interesado en operar toda una región o país? <small>Si la respuesta es sí, por favor especifique. </small>'); ?></h6>
    <div class="text-left">
      <div class="col-sm-6 ps-0">  
        <input name="quest30" type="radio" onclick="campo(this.value)" id="31" value="31"/><label for="31"><?php echo _('Si'); ?></label>
        <input name="quest30" type="radio" onclick="campo(this.value)" id="32" value="32"/><label for="32"><?php echo _('No'); ?></label>
      </div>
      <div class="col-sm-6 ps-0">

        <span id="campo30">
          <input type='text' name='ansq30' id='ansq30' class='form-control' placeholder='Ingrese su Respuesta'>
        </span>

      </div>
    </div>                                    
    <span id="errorquest30"></span>
  </div>
</div>

<div class="col-sm-12">
  <div class="form-group cuestionario  inner-addon left-addon">
    <h6 for="quest31"><?php echo _('¿Cuenta con un lugar para la franquicia? <small>Si la respuesta es sí, por favor indique la dirección del local. </small>'); ?></h6>
    <div class="text-left">
      <div class="col-sm-12 ps-0">
        <input name="quest31" type="radio" id="33" onclick="campo(this.value)" value="33" /><label for="33"><?php echo _('Si'); ?></label>
        <input name="quest31" type="radio" id="34" onclick="campo(this.value)" value="34" /><label for="34"><?php echo _('No'); ?></label>
      </div>
      <div class="col-sm-12 ps-0">

        <span id="campo31">
          <input type='text' name='ansq31' id='ansq31' class='form-control' placeholder='Ingrese su Respuesta'>
        </span>

      </div>
    </div>                                    
    <span id="errorquest31"></span>
  </div>
</div>
<input type="hidden" id="origen" value="F02">
