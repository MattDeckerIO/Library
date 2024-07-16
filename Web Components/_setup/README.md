# Web Components Setup Instructions

- [Installation](#npm)
  1. [Add required npm packages to the Dockerfile](#npm)
  1. [Copy setup directory to theming directory](#theme)
  1. [Add to root package.json](#package) *(optional)*
- [Usage](#usage)
  1. [Prepare HTML](#prepare)
  1. [Compile Web Components](#compile)
      - [Docker](#compile-docker)
      - [Docksal](#compile-docksal)


## Installation
<a name="npm"></a>
### Add required npm packages to the Dockerfile
```Dockerfile
# Install Web Component Tooling
RUN npm install -g webpack webpack-cli to-string-loader css-loader sass-loader babel-loader sass
```

<a name="theme"></a>
### Copy setup directory to theming directory

e.g. Drupal /web/themes/custom/THEME/js/components
```markdown
/web/themes/custom/THEME/js/components/webpack.config.js
/web/themes/custom/THEME/js/components/dist/.gitkeep
/web/themes/custom/THEME/js/components/src/sample/sample.js
/web/themes/custom/THEME/js/components/src/sample/sample.scss

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

<a name="package"></a>
### Add to root package.json *(optional)*
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
<br/>

<br/>

<a name="usage"></a>
## Usage
<a name="prepare"></a>
### Prepare HTML
Web Components consist of new HTML tags. e.g. `<your-component>...</your-component>`

 1. In Drupal
    1. Add a new library: \
       **your_theme.libraries.yml**
        ```markdown
        your-component:
          js:
            components/dist/your-component.bundle.js: {}
        ```

    1. Add a new template file for the element: \
       **block--views-block--block_machine_name.html.twig**
        ```markdown
        {{ attach_library('your_theme/your-component') }}

        <your-component>
          {% block content %}
            {{ content }}
          {% endblock %}
        </your-component>
        ```
    1. Clear Drupal caches to apply new library and template.

<a name="compile"></a>
### Compile Web Components
When a Web Component is successfully compiled a new file will
exist in the `dist` directory named `WEBCOMPONENT.bundle.js`. This file should
be committed to the repository as it is required for the application
to function properly.

<img src="../../../media/icons/exclamation-mark.png?raw=true" width="20" align="center"><img src="../../../media/icons/exclamation-mark.png?raw=true" width="20" align="center">**You must recompile the web component after every change.**<img src="../../../media/icons/exclamation-mark.png?raw=true" width="20" align="center"><img src="../../../media/icons/exclamation-mark.png?raw=true" width="20" align="center">

<a name="compile-docker"></a>
#### Docker
1. Exec into the docker container
1. Go to the directory containing webpack.config.js
1. Run `webpack`. \
You should see output with no errors:
   ```markdown
   { 'your-component': './src/your-component/your-component.js' }
   webpack compiled successfully
   ```

<a name="compile-docksal"></a>
#### Docksal
- **PREFERRED:** If the project has a [package.json](#package) in the root: \
  **.docksal/commands/build**
  ```markdown
  fin exec npm run build-components
  ```
  `fin build`
  <br/>
  > This method is preferred because the docksal configuration is consistent across projects.
  > Only the project-specific [package.json](#package) is updated and Docksal is able to locate the
  > web component directory.
  <br/>

- Add a command to build web components: \
  **.docksal/commands/build**
  ```markdown
  cd /var/www/web/themes/custom/your_theme/js/components && webpack
  ```
  `fin build`
