<?php

require_once "models/examendata.model.php";
function run()
{
  $estadoPlugins = obtenerEstados();
  $selectedEst = 'ACT';
  $mode = "";
  $errores=array();
  $hasError = false;
  $modeDesc = array(
    "DSP" => "PLUGIN ",
    "INS" => "Creando Nuevo Plugin",
    "UPD" => "Actualizando Plugin",
    "DEL" => "Eliminando Plugin"
  );
  $viewData = array();
  $viewData["showJamh_codigo"] = true;
  $viewData["showBtnConfirmar"] = true;
  $viewData["readonly"] = '';
  $viewData["selectDisable"] = '';

  if (isset($_POST["xcfrt"]) && isset($_SESSION["xcfrt"]) &&  $_SESSION["xcfrt"] !== $_POST["xcfrt"]) {
      redirectWithMessage(
          "Petición Solicitada no es Válida",
          "index.php?page=examenlist"
      );
      die();
  }
  $viewData["xcfrt"] = $_SESSION["xcfrt"];
  if (isset($_POST["btnDsp"])) {
      $mode = "DSP";
      $plugin = obtenerPluginPorId($_POST["jamh_codigo"]);
      $selectedEst=$plugin["jamh_estado"];
      $viewData["showBtnConfirmar"] = false;
      $viewData["readonly"] = 'readonly';
      $viewData["selectDisable"] = 'disabled';
      mergeFullArrayTo($plugin, $viewData);
      $viewData["modeDsc"] = $modeDesc[$mode] . $viewData["dscplugin"];
  }
  if (isset($_POST["btnUpd"])) {
      $mode = "UPD";
      $plugin = obtenerPluginPorId($_POST["jamh_codigo"]);
      $selectedEst=$plugin["jamh_estado"];
      mergeFullArrayTo($plugin, $viewData);
      $viewData["modeDsc"] = $modeDesc[$mode] . $viewData["dscplugin"];
  }
  if (isset($_POST["btnDel"])) {
      $mode = "DEL";
      //Vamos A Cargar los datos
      $plugin = obtenerPluginPorId($_POST["jamh_codigo"]);
      $selectedEst=$plugin["jamh_estado"];
      $viewData["readonly"] = 'readonly';
      $viewData["selectDisable"] = 'disabled';
      mergeFullArrayTo($plugin, $viewData);
      $viewData["modeDsc"] = $modeDesc[$mode] . $viewData["dscplugin"];
  }
  if (isset($_POST["btnIns"])) {
      $mode = "INS";
      $viewData["modeDsc"] = $modeDesc[$mode];
       $viewData["showJamh_codigo"]  = false;
  }

  if (isset($_POST["btnConfirmar"])) {
      $mode = $_POST["mode"];
      $selectedEst = $_POST["jamh_estado"];
       mergeFullArrayTo($_POST, $viewData);
      switch($mode)
      {
      case 'INS':
          $viewData["showJamh_codigo"] = false;
          $viewData["modeDsc"] = $modeDesc[$mode];

          agregarNuevoPlugin(
              $viewData["dscplugin"],
              $viewData["estplugin"],
              $viewData["jamh_urlhomepage"],
              $viewData["jamh_urlcdn"]
          )
          ) {
              redirectWithMessage(
                  "Plugin Guardado Exitosamente",
                  "index.php?page=examenlist"
              );
              die();
          }
          break;
      case 'UPD':
          $viewData["modeDsc"] = $modeDesc[$mode] . $viewData["dscplugin"];
          if (modificarPlugin(
            $viewData["jamh_codigo"],
            $viewData["dscplugin"],
            $viewData["estplugin"],
            $viewData["jamh_urlhomepage"],
            $viewData["jamh_urlcdn"]
          )
          ) {
              redirectWithMessage(
                  "Plugin Actualizado Exitosamente",
                  "index.php?page=examenlist"
              );
              die();
          }
          break;
      case 'DEL':
          $viewData["modeDsc"] = $modeDesc[$mode] . $viewData["dscplugin"];
          $viewData["readonly"] = 'readonly';
          $viewData["selectDisable"] = 'disabled';
          if (eliminarPlugin(
              $viewData["jamh_codigo"]
          )
          ) {
              redirectWithMessage(
                  "Plugin Eliminado Exitosamente",
                  "index.php?page=examenlist"
              );
              die();
          }
          break;
      }
  }
  $viewData["mode"] = $mode;
  $viewData["estplugin"] = addSelectedCmbArray($estadoPlugins, 'cod', $selectedEst);
  $viewData["hasErrors"] = $hasError;
  $viewData["errores"] = $errores;
  renderizar("examenform", $viewData);

}

run();
?>
