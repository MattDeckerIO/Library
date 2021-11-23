# Enables custom files to be installed via composer.
### Ensure the file or package does not exist on Packagist before proceeding.

### Git repository WITH composer.json
```bash
  "repositories": [
    {
      "url": "https://github.com/l3pp4rd/DoctrineExtensions.git",
      "type": "git"
    }
  ],
  "require": {
    "gedmo/doctrine-extensions": "~2.3"
  }
```

### Git repository WITHOUT composer.json
```bash
"repositories": [
  {
    "type":"package",
    "package": {
      "name": "l3pp4rd/doctrine-extensions",
      "version":"main",
      "source": {
        "url": "https://github.com/l3pp4rd/DoctrineExtensions.git",
        "type": "git",
        "reference":"main"
      }
    }
  }
],
"require": {
    "l3pp4rd/doctrine-extensions": "main"
}
```

### Zip File
```bash
"repositories": [
  "ckeditor.image": {
    "type": "package",
    "package": {
      "name": "ckeditor/image",
      "version": "4.15.1",
      "type": "drupal-library",
      "extra": {
        "installer-name": "ckeditor.image"
      },
      "dist": {
        "url": "https://download.ckeditor.com/image/releases/image_4.15.1.zip",
        "type": "zip"
      },
      "require": {
        "composer/installers": "~1.0"
      }
    }
  },
],
```

### Individual file
```bash
"repositories": [
  "algolia/places": {
    "type": "package",
    "package": {
      "name": "algolia/places",
      "version": "1.19.0",
      "type": "drupal-library",
      "extra": {
        "installer-name": "algolia.places"
      },
      "dist": {
        "url": "https://cdn.jsdelivr.net/npm/places.js",
        "type": "file"
      },
      "require": {
        "composer/installers": "~1.0"
      }
    }
  },
],
"require": {
  "algolia/places": "^1.19",
}
```