<?php
namespace Drupal\at_config;

class Resolver implements ResolverInterface {
  /**
   * @var Config
   */
  private $config;

  public function setConfig($config) {
    $this->config = $config;
  }

  /**
   * [getPath description]
   * @return [type] [description]
   */
  public function getPath() {
    if ($path = $this->getOverridePath($this->config->getId(), $this->config->module)) {
      return $path;
    }
    return $this->getOriginalPath($this->config->getId(), $this->config->module);
  }

  /**
   * [getOriginalPath description]
   * @return [type] [description]
   */
  public function getOriginalPath() {
    $config_id = $this->config->getId();
    $path .= DRUPAL_ROOT . '/' . conf_path();
    if (module_exists($this->config->module)) {
      $config_id = trim($config_id, '/');
      $config_id = empty($config_id) ? $this->config->module : $config_id;
      $path = DRUPAL_ROOT . '/' . drupal_get_path('module', $this->config->module);
    }
    $config_id = trim(str_replace('.', '/', $config_id), '/');
    $path .= '/config/' . $config_id . '.yml';
    return is_file($path) ? $path : FALSE;
  }

  /**
   * [getOverridePath description]
   * @return [type] [description]
   */
  public function getOverridePath() {
  }

  /**
   * [fetchData description]
   *
   * @return [type] [description]
   */
  public function fetchData() {
    require_once DRUPAL_ROOT . '/sites/all/libraries/spyc/Spyc.php';
    return spyc_load_file($this->getPath());
  }
}
