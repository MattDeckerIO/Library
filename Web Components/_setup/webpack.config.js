const path = require('path');
const fs = require('fs');

module.exports = {
  mode: 'production', // Set mode to `development` for debugging
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
    const jsFiles = fs.readdirSync('./src/js').filter(file => file.endsWith('.js'));

    jsFiles.forEach(file => {
      const name = file.replace('.js', '');
      entries[name] = `./src/js/${file}`;
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
};

