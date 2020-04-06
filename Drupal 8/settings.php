<?php

// Set config directory
$settings['config_sync_directory'] = '../config/sync';

// Set default hash
$settings['hash_salt'] = 'Override this in value in settings.*.php';

// Disable update
$settings['update_free_access'] = FALSE;

// Permissions
$settings['file_chmod_directory'] = 0775;
$settings['file_chmod_file'] = 0664;

// Public path
# $settings['file_public_path'] = 'sites/default/files';

// Private path
# $settings['file_private_path'] = '';

// Temporary directory
# $settings['file_temp_path'] = '/tmp';

// Config overrides
$config['system.mail']['interface']['default'] = 'test_mail_collector';

// Services
$settings['container_yamls'][] = $app_root . '/' . $site_path . '/services.yml';

// Drupal ignore list
$settings['file_scan_ignore_directories'] = [
  'node_modules',
  'bower_components',
];

// Batch size
$settings['entity_update_batch_size'] = 50;

// Entity update backup
$settings['entity_update_backup'] = TRUE;

// Load environment overrides.
if (file_exists(__DIR__ . '/settings.local.php')) {
  include __DIR__ . '/settings.local.php';
}

if (file_exists(__DIR__ . '/settings.dev.php')) {
  include  __DIR__ . '/settings.dev.php';
}

if (file_exists(__DIR__ . '/settings.uat.php')) {
  include  __DIR__ . '/settings.uat.php';
}

if (file_exists(__DIR__ . '/settings.prod.php')) {
  include  __DIR__ . '/settings.prod.php';
}
