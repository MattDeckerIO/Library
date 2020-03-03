# Unique body class
> This code adds a body class to each page based on the given URL.
> This class is then used for styling of individual pages.
> As long as the URL doesn't change the css selector and styling will still apply.

[Source](https://drupal.stackexchange.com/questions/188200/how-can-i-dynamically-add-url-or-taxonomy-to-body-class)



### my_theme.theme
```php
function MY_THEME_preprocess_html(&$variables) {
  $current_path = \Drupal::service('path.current')->getPath();
  $variables['current_path'] = \Drupal::service('path.alias_manager')->getAliasByPath($current_path);
}
```

### html.html.twig
```twig
{%
  set body_classes = [
    logged_in ? 'user-logged-in',
    not root_path ? 'path-frontpage' : 'path-' ~ root_path|clean_class,
    node_type ? 'page-node-type-' ~ node_type|clean_class,
    db_offline ? 'db-offline',
    current_path ? 'context' ~ current_path|clean_class,
  ]
%}
<body{{ attributes.addClass(body_classes) }}>
```
