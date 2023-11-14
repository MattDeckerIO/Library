# Disable Drupal 8 Caching
> This configuration disables most caching to speed up development
> and ensure what is seen on the screen is actually the code and not the cache.

#### Ensure you are using the custom settings.php so that settings.local.php is loaded.

[Source](https://www.drupal.org/node/2598914)

### web/sites/default/settings.local.php
```php
<?php

$config_directories['sync'] = '../config/sync';

$databases['default']['default'] = array (
  'database' => 'project',
  'username' => 'project',
  'password' => 'project',
  'host' => 'mysql_container',
  'port' => '3306',
  'driver' => 'mysql',
  'prefix' => '',
  'collation' => 'utf8mb4_general_ci',
);

$settings['hash_salt'] = '676b67d780d83cf9cbe6eab3ce76c80f6460368b';

assert_options(ASSERT_ACTIVE, TRUE);
\Drupal\Component\Assertion\Handle::register();

$settings['cache']['bins']['render'] = 'cache.backend.null';
$settings['cache']['bins']['page'] = 'cache.backend.null';
$settings['cache']['bins']['dynamic_page_cache'] = 'cache.backend.null';
$settings['extension_discovery_scan_tests'] = FALSE;
$settings['rebuild_access'] = TRUE;
$settings['skip_permissions_hardening'] = TRUE;
$settings['container_yamls'][] = DRUPAL_ROOT . '/sites/development.services.yml';

$config['system.performance']['css']['preprocess'] = FALSE;
$config['system.performance']['js']['preprocess'] = FALSE;
$config['system.logging']['error_level'] = 'verbose';

$config['google_analytics.settings']['account'] = 'UA-0000000-00';

```

### web/sites/development.services.yml
```yml
parameters:
  http.response.debug_cacheability_headers: true
  twig.config:
    debug: true
    auto_reload: true
services:
  cache.backend.null:
    class: Drupal\Core\Cache\NullBackendFactory
```
