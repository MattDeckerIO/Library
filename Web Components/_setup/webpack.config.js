const path = require('path');
const fs = require('fs');

module.exports = {
  mode: 'production', // Set mode to development for debugging
  stats: {
    colors: true,
    hash: false,
    version: false,
    timings: false,
    assets: false,
    chunks: false,
    modules: false,
    reasons: false,
    children: false,
    source: false,
    errors: true,
    errorDetails: true,
    warnings: false,
    publicPath: false
  },
  entry: () => {
    const entries = {};
    
    // Define components directory and get all subdirectories
    const componentsDir = './src';
    const components = fs.readdirSync(componentsDir, { withFileTypes: true }).filter(dirent => dirent.isDirectory());
    
    // Loop through each component directory
    components.forEach(component => {
      const jsPath = `./${path.join(componentsDir, component.name, `${component.name}.js`)}`;
      const scssPath = `./${path.join(componentsDir, component.name, `${component.name}.scss`)}`;
      
      if (fs.existsSync(jsPath)) {
        entries[component.name] = jsPath;
      }
      
      // if (fs.existsSync(scssPath)) {
      //   entries[`${component.name}_style`] = scssPath;
      // }
    });

    console.log(entries);

    return entries;
  },
  output: {
    filename: '[name].bundle.js',
    path: path.resolve(__dirname, 'dist')
  },
  module: {
    rules: [
      {
        test: /\.js$/, // Match JavaScript files
        use: 'babel-loader',
      },
      {
        test: /\.scss$/, // Match SCSS files
        use: ['to-string-loader', 'css-loader', 'sass-loader'],
      },
    ]
  },
  resolveLoader: {
    modules: ['node_modules', '/usr/local/lib/node_modules']
  },
  watchOptions: {
    poll: true,
    ignored: /node_modules/
  }
};
