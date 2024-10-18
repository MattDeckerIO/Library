# How to install module-required libraries.

1. Install wikimedia/composer-merge-plugin
   - `composer require wikimedia/composer-merge-plugin`
   - When prompted, press y to trust composer merge plugin to execute code.

2. Search module directory for library files.
   - e.g:
   - `find web/modules/* | grep -i 'libraries.json'`
   - `find web/themes/* | grep -i 'libraries.json'`
   - `find web/* -type f -name '*lib*.json'`

3. Update composer.json to include libraries from contrib modules
   ```bash
   "extra": {
     "merge-plugin": {
       "include": [
         "web/modules/contrib/*/composer.libraries.json"
       ]
     }
   },
   ```

4. Re-require modules that contain libraries.
   - If a module contains a library file e.g.
   ```bash
   find web/modules/* -type f -name '*lib*.json'
   web/modules/contrib/webform/composer.libraries.json
   ```
   - `fin composer require 'drupal/webform:^VERSION' -W`
