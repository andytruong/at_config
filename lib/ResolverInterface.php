<?php
namespace Drupal\at_config;

interface ResolverInterface {
  public function setConfig($config);
  public function getPath();
  public function getModule();
  public function fetchData();
}
