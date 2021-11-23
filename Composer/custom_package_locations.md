# Move a package to a custom location
> This allows for putting a package in a custom location.

1. Check to see if the package you need exists on [Packagist](https://packagist.org/)
2. Add the destination and package name to extra installer-paths.
```bash
{
  "extra": {
    "installer-paths": {
      "web/libraries/{$name}": ["politsin/jquery-ui-touch-punch"]
    }
  }
}
```

3. Require the package
```bash
composer require politsin/jquery-ui-touch-punch
```

## Alternatively
> If the above does not provide enough control it is possible to
> automatically execute commands after installing packages.

1. Add the necessary commands under scripts post-update-cmd.

```bash
  "scripts": {
    "post-update-cmd": [
      "mkdir -p web/libraries/bootstrap",
      "cp -R vendor/twbs/bootstrap/dist web/libraries/bootstrap"
    ]
  },
```

2. Require the package that contains the files. The post-update-cmd will run after the package files have been downloaded.

```bash
composer require drupal/bootstrap_barrio
```