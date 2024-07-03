# Web Component Setup

### Add required npm packages to the Dockerfile.
```Dockerfile
  # Install Web Component Tooling
  RUN npm install -g webpack webpack-cli to-string-loader css-loader sass-loader babel-loader sass
```

### Add to root package.json
```json
{
  "config": {
    "components": "./path/to/js/components"
  },
  "scripts": {
    "build-components": "echo 'Building Web Components'; (cd $npm_package_config_components && webpack); echo 'Done!'",
  }
}
```

### Copy setup directory to theming directory

e.g. Drupal /web/themes/custom/THEME/js/components
```
/web/themes/custom/THEME/js/components/webpack.config.js
/web/themes/custom/THEME/js/components/dist/.gitkeep
/web/themes/custom/THEME/js/components/src/sample/sample.js
/web/themes/custom/THEME/js/components/src/sample/sample.scss
```


```markdown
THEME
│   THEME.info.yml
│
└───js
    │
    └───components
        │   webpack.config.js
        │
        │───dist
        │   .gitkeep
        │
        │───src
            |
            |───sample
            |   sample.js
            |   sample.scss
            |
            |───second_component
            |   second_component.js
            |   second_component.scss
```