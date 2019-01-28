<style type="text/css">
  #campo44, #campo46, #campo48, #campo50 {
    display: none;
  }
</style>

<div class="col-sm-12">
  <div class="form-group cuestionario inner-addon left-addon">
    <h6 for="quest41"><?php echo _('¿Cómo supo de nosotros?'); ?></h6>
    <i class="far fa-dot-circle" id="icon-input"></i>
    <select class="left-addon" name="quest41" id="quest41">
      <option value="">Seleccione una opción</option>
      <option value="opt-1">Es cliente</option>
      <option value="opt-2">Por un amigo</option>
      <option value="opt-3">Página web</option>
      <option value="opt-4">Buscador</option>
      <option value="opt-5">Otros</option>
    </select>
    <span id="errorquest41"></span>
  </div>
</div>

<div class="col-sm-12">
  <div class="form-group cuestionario inner-addon left-addon">
    <h6 for="quest42"><?php echo _('¿En qué zona, región o país desea desarrollar la marca?'); ?></h6>
    <i class="fas fa-globe" id="icon-input"></i>
    <input type="text" name="quest42" id="quest42" class="form-control" placeholder="<?php echo _('Ingrese la zona'); ?>">
    <span id="errorquest42"></span>
  </div>
</div>

<div class="col-sm-12">
  <div class="form-group cuestionario  inner-addon left-addon">
    <h6 for="quest43"><?php echo _('¿Su cónyuge participará?'); ?></h6>
    <div class="text-left">
      <input name="quest43" type="radio" id="41" value="41"/><label for="41"><?php echo _('Si'); ?></label>
      <input name="quest43" type="radio" id="42" value="42"/><label for="42"><?php echo _('No'); ?></label>
    </div>                                    
    <span id="errorquest43"></span>
  </div>
</div>

<div class="col-sm-12">
  <div class="form-group cuestionario  inner-addon left-addon">
    <h6 for="quest44"><?php echo _('¿Está interesado en invertir solo o con un socio, cuantos? <small>Si la respuesta es si, indique cuantos. </small>'); ?></h6>
    <div class="text-left">
      <div class="col-sm-6 ps-0">
        <input name="quest44" type="radio" id="43" onclick="campo(this.value)" value="43" /><label for="43"><?php echo _('Si'); ?></label>
        <input name="quest44" type="radio" id="44" onclick="campo(this.value)" value="44" /><label for="44"><?php echo _('No'); ?></label>
      </div>
      <div class="col-sm-6 ps-0">

        <span id="campo44">
          <select class="left-addon" name="ansq44" id="ansq44">
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
    <span id="errorquest44"></span>
  </div>
</div>

<div class="col-sm-12">
  <div class="form-group cuestionario  inner-addon left-addon">
    <h6 for="quest45"><?php echo _('¿Tiene perfectamente conocimiento de lo que es un franquiciado Master?'); ?></h6>
    <div class="text-left">
      <input name="quest45" type="radio" id="45" value="45" /><label for="45"><?php echo _('Si'); ?></label>
      <input name="quest45" type="radio" id="46" value="46" /><label for="46"><?php echo _('No'); ?></label>
    </div>                                    
    <span id="errorquest45"></span>
  </div>
</div>

<div class="col-sm-12">
  <div class="form-group cuestionario  inner-addon left-addon">
    <h6 for="quest46"><?php echo _('¿Es usted propietario de algún negocio o franquicia? <small>Si la respuesta es sí, por favor especifique el nombre. </small>'); ?></h6>
    <div class="text-left">
      <div class="col-sm-6 ps-0">
        <input name="quest46" type="radio" id="47" onclick="campo(this.value)" value="47" /><label for="47"><?php echo _('Si'); ?></label>
        <input name="quest46" type="radio" id="48" onclick="campo(this.value)" value="48" /><label for="48"><?php echo _('No'); ?></label>
      </div>
      <div class="col-sm-6 ps-0">

        <span id="campo46">
          <input type='text' name='ansq46' id='ansq46' class='form-control' placeholder='Ingrese su Respuesta'>
        </span>

      </div>
    </div>                                    
    <span id="errorquest46"></span>
  </div>
</div>

<div class="col-sm-12">
  <div class="form-group cuestionario inner-addon left-addon">
    <h6 for="quest47"><?php echo _('¿Cuántas unidades puede abrir?'); ?></h6>
    <i class="fas fa-globe" id="icon-input"></i>
    <input type="text" name="quest47" id="quest47" class="form-control" placeholder="<?php echo _('Ingrese la cantidad'); ?>">
    <span id="errorquest47"></span>
  </div>
</div>

<div class="col-sm-12">
  <div class="form-group cuestionario  inner-addon left-addon">
    <h6 for="quest48"><?php echo _('¿Tiene experiencia en el manejo de marcas? <small>Si la respuesta es sí, por favor especifique. </small>'); ?></h6>
    <div class="text-left">
      <div class="col-sm-6 ps-0">
        <input type="radio" name="quest48" id="49" onclick="campo(this.value)" value="49" /><label for="49"><?php echo _('Si'); ?></label>
        <input type="radio" name="quest48" id="50" onclick="campo(this.value)" value="50" /><label for="50"><?php echo _('No'); ?></label>
      </div>
      <div class="col-sm-6 ps-0">

        <span id="campo48">
          <input type='text' name='ansq48' id='ansq48' class='form-control' placeholder='Ingrese su Respuesta'>
        </span>

      </div>
    </div>                                    
    <span id="errorquest48"></span>
  </div>
</div>

<div class="col-sm-12">
  <div class="form-group cuestionario  inner-addon left-addon">
    <h6 for="quest49"><?php echo _('¿Dedicación a tiempo completo?'); ?></h6>
    <div class="text-left">
      <input name="quest49" type="radio" id="51" value="51"/><label for="51"><?php echo _('Si'); ?></label>
      <input name="quest49" type="radio" id="52" value="52" disabled /><label for="52"><?php echo _('No'); ?></label>
      <label>Para enviar este formulario es necesario que posea disponibilidad a tiempo completo.</label>
    </div>                                    
    <span id="errorquest49"></span>
  </div>
</div>

<div class="col-sm-12">
  <div class="form-group cuestionario  inner-addon left-addon">
    <h6 for="quest50"><?php echo _('¿Está interesado en operar toda una región o país? <small>Si la respuesta es sí, por favor especifique. </small>'); ?></h6>
    <div class="text-left">
      <div class="col-sm-12 ps-0">
        <input name="quest50" type="radio" id="53" onclick="campo(this.value)" value="53" /><label for="53"><?php echo _('Si'); ?></label>
        <input name="quest50" type="radio" id="54" onclick="campo(this.value)" value="54" /><label for="54"><?php echo _('No'); ?></label>
      </div>
      <div class="col-sm-12 ps-0">

        <span id="campo50">
          <input type='text' name='ansq50' id='ansq50' class='form-control' placeholder='Ingrese su Respuesta'>
        </span>

      </div>
    </div>                                    
    <span id="errorquest50"></span>
  </div>
</div>