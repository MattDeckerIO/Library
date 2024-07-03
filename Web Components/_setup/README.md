# Web Component Setup

### Add required npm packages to the Dockerfile.
```Dockerfile
  # Install Web Component Tooling
  RUN npm install -g webpack webpack-cli to-string-loader css-loader sass-loader sass
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
/web/themes/custom/THEME/js/components/src/js/sample.js
/web/themes/custom/THEME/js/components/src/scss/sample.scss
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
            |───js
            |   sample.js
            |   second-component.js
            |
            |───scss
            |   sample.scss
            |   second-component.scss
```



# TODO
I would love for components to be in a single directory:

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
            |───component_1
            |   component_1.js
            |   component_1.scss
            |
            |───component_2
            |   component_2.js
            |   component_2.scss
```