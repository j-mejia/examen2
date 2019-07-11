<section>
  <header>
    <h1>Plugins</h1>
  </header>
  <main>
    <table class="full-width">
      <thead>
        <tr>
          <th>Codigo</th>
          <th>Plugin</th>
          <th>Estado</th>
          <th>URL HomePage</th>
          <th>URL CDN</th>
          <th class="right">
            <form action="index.php?page=examenform" method="post">
            <input type="hidden" name="idplugin" value="" />
            <input type="hidden" name="xcfrt" value="{{~xcfrt}}" />
            <button type="submit" name="btnIns">Agregar</button>
          </form>
          </th>
        </tr>
      </thead>
      <tbody class="zebra">
        {{foreach plugins}}
        <tr>
          <td>{{jamh_codigo}}</td>
          <td>{{jamh_plugin}}</td>
          <td>{{jamh_estado}}</td>
          <td>{{jamh_urlhomepage}}</td>
          <td>{{jamh_urlcdn}}</td>
          <td class="right">
            <form action="index.php?page=examenform" method="post">
              <input type="hidden" name="idplugin" value="{{jamh_codigo}}"/>
              <input type="hidden" name="xcfrt" value="{{~xcfrt}}" />
              <button type="submit" name="btnDsp">Ver</button>
              <button type="submit" name="btnUpd">Editar</button>
              <button type="submit" name="btnDel">Eliminar</button>
            </form>
          </td>
        </tr>
        {{endfor plugins}}
      </tbody>
      <tfoot>
        <tr>
          <td colspan="6"> Paginación</td>
        </tr>
      </tfoot>
    </table>
  </main>
</section>
