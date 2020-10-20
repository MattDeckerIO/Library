# External IPs in Drupal Log
> This code changes the IP addresses of log messages to actual IPs 
> instead of false addresses due to proxying.

### settings.php
```php
$arr_reverse_proxy = [];
$arr_reverse_proxy = explode(", ", $_SERVER['HTTP_X_FORWARDED_FOR']);
array_shift($arr_reverse_proxy);
$arr_reverse_proxy[] = $_SERVER['REMOTE_ADDR'];

if (explode('.', VERSION)[0] == 7) {
  // Drupal 7 Reverse Proxy Configuration
  $conf['reverse_proxy'] = TRUE;
  $conf['reverse_proxy_addresses'] = $arr_reverse_proxy;
  $conf['reverse_proxy_header'] = 'HTTP_X_FORWARDED_FOR';
} else {
  // Drupal 8/9 Reverse Proxy Configuration
  $settings['reverse_proxy'] = TRUE;
  $settings['reverse_proxy_addresses'] = $arr_reverse_proxy;
  $settings['reverse_proxy_trusted_headers'] = 
    \Symfony\Component\HttpFoundation\Request::HEADER_X_FORWARDED_FOR |
    \Symfony\Component\HttpFoundation\Request::HEADER_X_FORWARDED_PROTO |
    \Symfony\Component\HttpFoundation\Request::HEADER_X_FORWARDED_PORT;
}
```