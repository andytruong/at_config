<?php
namespace Drupal\at_config;

class Resolver {
  /**
   * [$id description]
   * @var [type]
   */
  private $id;

  /**
   * Path to configuration value.
   *
   * @var string
   */
  private $path;

  public function __construct($id) {
  }

  /**
   * [getPath description]
   * @return [type] [description]
   */
  public function getPath() {
    if (!$this->path) {
      if ($path = $this->getOverridePath()) {
        return $path;
      }
      return $this->getOriginalPath();
    }
    return $this->path;
  }

  /**
   * [getOriginalPath description]
   * @return [type] [description]
   */
  public function getOriginalPath() {
  }

  /**
   * [getOverridePath description]
   * @return [type] [description]
   */
  public function getOverridePath() {
  }

  /**
   * [getValue description]
   * @return [type] [description]
   */
  public function getConfigObject() {
    return new Config($path = $this->getPath());
  }
}
