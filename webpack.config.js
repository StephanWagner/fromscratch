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

  // Entry src
  const entryJs = `./themes/${themeName}/src/js/main.js`;
  const entryJsAdmin = `./themes/${themeName}/src/js/admin/main.js`;
  const entryJsAdminBlocks = `./themes/${themeName}/src/js/admin/blocks.js`;
  const entryJsAdminBlockOptions = `./themes/${themeName}/src/js/admin/block-options.js`;
  const entryScss = `./themes/${themeName}/src/scss/main.scss`;
  const entryScssAdmin = `./themes/${themeName}/src/scss/admin.scss`;

  // Output directory
  const outputDirJs = path.resolve(__dirname, `themes/${themeName}/js`);
  const outputDirScss = path.resolve(__dirname, `themes/${themeName}/css`);

  // Webpack setup
  return [
    // Frontend
    {
      entry: entryJs,
      output: {
        path: outputDirJs,
        filename: isProduction ? `main.min.js` : `main.js`
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
    },
    // Admin
    {
      entry: entryJsAdmin,
      output: {
        path: outputDirJs,
        filename: isProduction ? `admin.min.js` : `admin.js`
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
    },
    // Admin blocks
    {
      entry: entryJsAdminBlocks,
      output: {
        path: outputDirJs,
        filename: isProduction ? `admin-blocks.min.js` : `admin-blocks.js`
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
    },
    // Admin block options
    {
      entry: entryJsAdminBlockOptions,
      output: {
        path: outputDirJs,
        filename: isProduction
          ? `admin-block-options.min.js`
          : `admin-block-options.js`
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
    },

    // SCSS Configuration
    {
      entry: entryScss,
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
          filename: isProduction ? `main.min.css` : `main.css`
        }),
        new CleanupPlugin()
      ],
      mode: argv.mode || 'production'
    },
    {
      entry: entryScssAdmin,
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
          filename: isProduction ? `admin.min.css` : `admin.css`
        }),
        new CleanupPlugin()
      ],
      mode: argv.mode || 'production'
    }
  ];
};
