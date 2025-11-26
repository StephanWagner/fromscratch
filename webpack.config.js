const path = require('path');
const fs = require('fs');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');

const themeName = 'fromscratch';

class CleanupPlugin {
  apply(compiler) {
    compiler.hooks.afterEmit.tap('CleanupPlugin', (compilation) => {
      const jsPath = path.resolve(__dirname, `themes/${themeName}/css/main.js`);
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

  // JS
  const js = [
    {
      entry: `./themes/${themeName}/src/js/main/main.js`,
      filename: 'main'
    },
    {
      entry: `./themes/${themeName}/src/js/admin/admin.js`,
      filename: 'admin'
    },
    {
      entry: `./themes/${themeName}/src/js/editor/editor.js`,
      filename: 'editor'
    }
  ];

  // SCSS
  const scss = [
    {
      entry: `./themes/${themeName}/src/scss/main.scss`,
      filename: 'main'
    },
    {
      entry: `./themes/${themeName}/src/scss/admin.scss`,
      filename: 'admin'
    }
  ];

  // Output directory
  const outputDirJs = path.resolve(__dirname, `themes/${themeName}/js`);
  const outputDirScss = path.resolve(__dirname, `themes/${themeName}/css`);

  // JS config
  const jsConfig = [];

  js.forEach((js) => {
    jsConfig.push({
      entry: js.entry,
      output: {
        path: outputDirJs,
        filename: isProduction ? `${js.filename}.min.js` : `${js.filename}.js`
      },
      module: {
        rules: [
          {
            test: /\.js$/,
            exclude: /node_modules/,
            use: {
              loader: 'babel-loader',
              options: {
                presets: ['@babel/preset-env', '@babel/preset-react']
              }
            }
          }
        ]
      },
      mode: argv.mode || 'production',
      optimization: {
        minimize: isProduction
      }
    });
  });

  // SCSS config
  const scssConfig = [];

  scss.forEach((scss) => {
    scssConfig.push({
      entry: scss.entry,
      output: {
        path: outputDirScss
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
                  url: false
                }
              },
              {
                loader: 'sass-loader',
                options: {
                  sassOptions: {
                    url: false
                  }
                }
              }
            ]
          }
        ]
      },
      plugins: [
        new MiniCssExtractPlugin({
          filename: isProduction
            ? `${scss.filename}.min.css`
            : `${scss.filename}.css`
        }),
        new CleanupPlugin()
      ],
      mode: argv.mode || 'production'
    });
  });

  // Webpack setup
  return [...jsConfig, ...scssConfig];
};
