# Password Disable for Drupal 10
This module overrides the user login submit handler to allow any user to log in with any (or no) password.

## Why? ##
This is intended for local development or if e-mail based password reset is not possible.

## How to enable? ##
1. Enable the module.
2. Add `$config['pass_disable.settings']['enabled'] = TRUE;` on the settings for your target environment.
3. :warning: **Only add the enabled flag to non-production environments.**