This module introduce an other way for Drupal configuration, which is inspired
by Symfony2 framework.

Install
---

Spyc.php is needed to read yaml files.

  Download Spyc.php (http://goo.gl/kMwPil) to sites/all/libraries/spyc/Spyc.php

Usages
---

```
echo at_config('%atest_config%')->get('foo'); // bar
```

Check more examples at At_Config_TestCase::testConfigGet()

Planned Features:
---

- Overridable configuration in module/theme
- Import other resources in yml files.
