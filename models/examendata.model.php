<?php
require_once "libs/dao.php";

// Elaborar el algoritmo de los solicitado aquí.

function obtenerListas()
{
    $sqlstr = "select `plugins`.`jamh_codigo`,
              `plugins`.`jamh_plugin`,
              `plugins`.`jamh_estado`,
              `plugins`.`jamh_urlhomepage`,
              `plugins`.`jamh_urlcdn`
          from `examen`.`plugins`";

    $plugin = array();
    $plugin = obtenerRegistros($sqlstr);
    return $plugin;
}

function obtenerPluginPorId($id)
{
  $sqlstr="select `plugins`.`jamh_codigo`,
            `plugins`.`jamh_plugin`,
            `plugins`.`jamh_estado`,
            `plugins`.`jamh_urlhomepage`,
            `plugins`.`jamh_urlcdn`
        from `examen`.`plugins` where jamh_codigo=%d";
  $plugin= array();
  $plugin=obtenerUnRegistro(sprintf($sqlstr, $id));
  return $plugin;
}

function obtenerEstadoPorId($id)
{
  $sqlstr="select `plugins`.`jamh_estado`
        from `examen`.`plugins` where jamh_codigo=%d";
  $plugin= array();
  $plugin=obtenerUnRegistro(sprintf($sqlstr, $id));
  return $plugin;
}


function obtenerEstados()
{
    return array(
        array("cod"=>"ACT", "dsc"=>"Activo"),
        array("cod"=>"INA", "dsc"=>"Inactivo"),
        array("cod"=>"PLN", "dsc"=>"En Planificación"),
        array("cod"=>"RET", "dsc"=>"Retirado"),
        array("cod"=>"SUS", "dsc"=>"Suspendido"),
        array("cod"=>"DES", "dsc"=>"Descontinuado")
    );
}

function agregarNuevoPlugin($dscplugin, $estplugin, $urlhome, $urlcdn) {
    $insSql = "INSERT INTO plugins(jamh_plugin, jamh_estado, jamh_urlhomepage, jamh_urlcdn)
      values ('%s', '%s', '%s','%s');";
      if (ejecutarNonQuery(
          sprintf(
              $insSql,
              $dscplugin,
              $estplugin,
              $urlhome,
              $urlcdn
          )))
      {
        return getLastInserId();
      } else {
          return false;
      }
}

function modificarPlugin($codplugin,$dscplugin, $estplugin, $urlhome, $urlcdn)
{
    $updSQL = "UPDATE plugins set jamh_plugin='%s', jamh_estado='%s',
    jamh_urlhomepage='%s',jamh_urlcdn='%s' where jamh_codigo=%d;";

    return ejecutarNonQuery(
        sprintf(
            $updSQL,
            $codplugin,
            $dscplugin,
            $estplugin,
            $urlhome,
            $urlcdn

        )
    );
}
function eliminarPlugin($idplugin)
{
    $delSQL = "DELETE FROM plugins where jamh_codigo=%d;";

    return ejecutarNonQuery(
        sprintf(
            $delSQL,
            $idplugin
        )
    );
}

?>
