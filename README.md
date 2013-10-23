I have an idea, will implement this later on my free time.

This module introduce an other way for Drupal configuration, which is inspired
by Symfony2 framework.

Install
---

Spyc.php is needed to read yaml files.

  Download Spyc.php (http://goo.gl/kMwPil) to sites/all/libraries/spyc/Spyc.php

Planned Features:
---

- APC/Memcache cache
- Able to embed config from
- Glob imports
- Overridable configuration in module/theme

````ymal
# #####################
# @file sites/default/private/parameters.yml
# #####################
parameters:
  debug:
    email: webmaster@mywebsite.com
````

````ymal
# #####################
# @file sites/default/private/config.yml
# #####################

imports:
  - { resource: mail.yml }
  - { resource: %my_module%/mail.yml }

seo:
  pages:
    entity:
      node: [page, article]
  debug:
    recipients: %debug.email%
````

````php
# #####################
# @file my_module.module
# #####################

function my_function() {
  try {
    // Global configuration
    $config_value = at_config('seo.pages.entity', $refresh = FALSE);

    // Module/Theme configuration
    // This is overridable with configuration in /sites/default/private/my_module/config.yml
    $config_value = at_config('%my_module%/seo.pages.entity', $refresh = FALSE, $user_original = FALSE);
  }
  catch (\UnexpectedValueException $e) {
  }
}
````

````bash
# #####################
# Drush commands
# #####################

drush at-config-build
drush at-config-rebuild
````
