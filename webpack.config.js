const path = require('path');
const fs = require('fs');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');

class CleanupPlugin {
  apply(compiler) {
    compiler.hooks.afterEmit.tap('CleanupPlugin', (compilation) => {
      const jsPath = path.resolve(__dirname, 'essential-user-rights/assets/css/main.js');
      if (fs.existsSync(jsPath)) {
        fs.unlinkSync(jsPath);
        console.log('\x1b[35m%s\x1b[0m', 'Deleted unwanted file:', jsPath);
      }
    });
  }
}

module.exports = (env, argv) => {

  // Enviroment
  const isProduction = argv.mode === 'production';

  // Filename
  const filename = 'essential-user-rights';

  // Entry src
  const entryJs = './themes/fromscratch/src/js/main.js';
  const entryScss = './themes/fromscratch/src/scss/main.scss';

  // Output directory
  const outputDirJs = path.resolve(__dirname, 'themes/fromscratch/js');
  const outputDirScss = path.resolve(__dirname, 'themes/romscratch/css');

  // Webpack setup
  return [
    // JavaScript Configuration
    {
      entry: entryJs,
      output: {
        path: outputDirJs,
        filename: isProduction ? `${filename}-main.min.js` : `${filename}-main.js`,
      },
      module: {
        rules: [
          {
            test: /\.js$/,
            exclude: /node_modules/,
            use: {
              loader: 'babel-loader',
              options: {
                presets: ['@babel/preset-env', '@babel/preset-react'],
              },
            },
          },
        ],
      },
      mode: argv.mode || 'production',
      optimization: {
        minimize: isProduction,
      },
    },

    // CSS/SCSS Configuration
    {
      entry: entryScss,
      output: {
        path: outputDirScss,
      },
      module: {
        rules: [
          {
            test: /\.scss$/,
            use: [
              MiniCssExtractPlugin.loader,
              {
                loader: 'css-loader',
                options: {
                  url: false,
                }
              },
              {
                loader: 'sass-loader',
                options: {
                  sassOptions: {
                    url: false,
                  },
                },
              },
            ],
          },
        ],
      },
      plugins: [
        new MiniCssExtractPlugin({
          filename: isProduction ? `${filename}-main.min.css` : `${filename}-main.css`,
        }),
        new CleanupPlugin(),
      ],
      mode: argv.mode || 'production',
    },
  ];
};
