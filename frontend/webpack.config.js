const resolve = require('path').resolve
const webpack = require('webpack')
const HtmlWebpackPlugin = require('html-webpack-plugin')
var CopyWebpackPlugin = require('copy-webpack-plugin');
const url = require('url')
const publicPath = ''
const glob = require('glob')
const path = require('path')

function getEntries(globPath) {
  var files = glob.sync(globPath),
    entries = {}

  files.forEach(function(filepath) {
    // 取倒数第二层(view下面的文件夹)做包名
    var split = filepath.split('/')
    var name = split[split.length - 2]

    entries[name] = './' + filepath
  });

  return entries
}

module.exports = (options = {dev: false}) => {
  var webpackConfig = {
    entry: {
      vendor: './src/main',
    },
    output: {
      path: resolve(__dirname, 'dist'),
      filename: options.dev ? 'js/[name].js' : 'js/[name].js?[chunkhash]',
      chunkFilename: '[id].js?[chunkhash]',
      publicPath: options.dev ? '/assets/' : publicPath
    },
    module: {
      rules: [{
          test: /\.vue$/,
          use: ['vue-loader']
        },
        {
          test: /\.js$/,
          use: ['babel-loader'],
          exclude: /node_modules/
        },
        {
          test: /\.css$/,
          use: ['style-loader', 'css-loader', 'postcss-loader']
        },
        {
          test: /\.(png|jpg|jpeg|gif)(\?.+)?$/,
          use: [{
            loader: 'url-loader',
            options: {
              limit: 10000,
              name: 'images/[hash].[ext]'
            }
          }]
        },
        {
          test: /\.(eot|ttf|woff|woff2|svg|svgz)(\?.+)?$/,
          use: [{
            loader: 'url-loader',
            options: {
              limit: 10000,
              name: 'fonts/[hash].[ext]'
            }
          }]
        }
      ]
    },
    plugins: [
      new webpack.ProvidePlugin({
        $: 'jquery',
        jQuery: 'jquery',
      }),
      new webpack.optimize.CommonsChunkPlugin({
        names: ['vendor', 'manifest']
      }),
      new CopyWebpackPlugin([{
          from: __dirname + '/src/public'
      }]),
    ],
    resolve: {
      alias: {
        '~': resolve(__dirname, 'src'),
        vue: 'vue/dist/vue.js',
        jquery: 'jquery/dist/jquery.js',
      }
    },
    devServer: {
      host: '127.0.0.1',
      port: 8010,
      proxy: {
        '/api/': {
          target: 'http://127.0.0.1:8080',
          changeOrigin: true,
          pathRewrite: {
            '^/api': ''
          }
        }
      },
      historyApiFallback: {
        index: url.parse(options.dev ? '/assets/' : publicPath).pathname
      }
    },
    devtool: options.dev ? '#eval-source-map' : false
  }

  var entries = getEntries('src/views/**/index.js')

  Object.keys(entries).forEach(function(name) {
    // 每个页面生成一个entry，如果需要HotUpdate，在这里修改entry
    webpackConfig.entry[name] = entries[name];

    // 每个页面生成一个html
    var plugin = new HtmlWebpackPlugin({
        // 生成出来的html文件名
        filename: name + '.html',
        // 每个html的模版，这里多个页面使用同一个模版
        template: './template.html',
        // 自动将引用插入html
        inject: true,
        // 每个html引用的js模块，也可以在这里加上vendor等公用模块
        chunks: [name, 'vendor', 'manifest']
    });
    webpackConfig.plugins.push(plugin);
  });

  return webpackConfig
}

