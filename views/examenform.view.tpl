<h1>{{modeDsc}}</h1>
<section class="row">
<form action="index.php?page=examenform" method="post" class="col-8 col-offset-2">
  
  <input type="hidden" name="mode" value="{{mode}}"/>
  <input type="hidden" name="xcfrt" value="{{xcfrt}}" />
  <input type="hidden" name="btnConfirmar" value="Confirmar" />
  {{if showJamh_codigo}}
  <fieldset class="row">
    <label class="col-5" for="idplugin">Código de Plugin</label>
    <input type="text" name="idplugin" id="idplugin" readonly value="{{jamh_codigo}}" class="col-7" />
  </fieldset>
  {{endif showJamh_codigo}}
  <fieldset class="row">
    <label class="col-5" for="dscplugin">Plugin: </label>
    <input type="text" name="dscplugin" id="dscplugin" {{readonly}} value="{{jamh_plugin}}" class="col-7" />
  </fieldset>
  <fieldset class="row">
    <label class="col-5" for="estplugin">Estado de Plugin: </label>
    <select name="estplugin" id="estplugin" class="col-7" {{selectDisable}} {{readonly}} >
      {{foreach estadoPlugins}}
        <option value="{{cod}}" {{selected}}>{{dsc}}</option>
      {{endfor estadoPlugins}}
    </select>
  </fieldset>
  <fieldset class="row">
    <label class="col-5" for="urlhomeplug">URL HomePage: </label>
    <input type="text" name="urlhomeplug" id="urlhomeplug" {{readonly}} value="{{jamh_urlhomepage}}" class="col-7" />
  </fieldset>
  <fieldset class="row">
    <label class="col-5" for="urlcdnplug">URL CDN: </label>
    <input type="text" name="urlcdnplug" id="urlcdnplug" {{readonly}} value="{{jamh_urlcdn}}" class="col-7" />
  </fieldset>
  <fieldset class="row">
    <div class="right">
      {{if showBtnConfirmar}}
      <button type="button" id="btnConfirmar" >Confirmar</button>
      &nbsp;
      {{endif showBtnConfirmar}}
      <button type="button" id="btnCancelar">Cancelar</button>
    </div>
  </fieldset>
</form>
</section>
<script>
  $().ready(function(){
    $("#btnCancelar").click(function(e){
      e.preventDefault();
      e.stopPropagation();
      location.assign("index.php?page=examenlist");
    });
    $("#btnConfirmar").click(function(e){
      e.preventDefault();
      e.stopPropagation();
      document.forms[0].submit();
    });
  });
</script>
