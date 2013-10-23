<?php
namespace Drupal\at_config;

class Config {
  /**
   * Config ID.
   *
   * @var string
   */
  private $id;

  /**
   * Detected module name.
   *
   * @var string
   */
  private $module;

  /**
   * Resolver.
   *
   * @var Resolver
   */
  private $resolver;

  /**
   * Fetched data.
   * @var mixed
   */
  private $config_data;

  public function __construct($id, ResolverInterface $resolver) {
    $this->id = $id;
    $resolver->setConfig($this);
    $this->resolver = $resolver;
    $this->module = $this->resolver->getModule();
  }

  public function getId() {
    return $this->id;
  }

  public function getModule() {
    return $this->module;
  }

  public function getPath() {
    return $this->resolver->getPath();
  }

  /**
   * Fetch configuration data.
   */
  private function fetchData() {
    $resolver = $this->resolver;
    $this->config_data = $resolver->fetchData();
    return;

    $options['ttl'] = '+ 1 year';
    $options['cache_id'] = "at_config:data:{$id}";
    $this->config_data = go_cache($options, function() use ($resolver) {
      return $resolver->fetchData();
    });
  }

  /**
   * Get configured value by key.
   *
   * @param  string $key Config key.
   * @return mixed
   */
  public function get($key) {
    if (!$this->config_data) {
      $this->fetchData();
    }

    if (!isset($this->config_data[$key])) {
      throw new NotFoundException();
    }

    return $this->config_data[$key];
  }
}