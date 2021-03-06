var express = require('express')
var webpack = require('webpack')
var webpackConfig = require('./webpack.config')({dev: true})
var path = require('path')

var app = express();

// webpack编译器
var compiler = webpack(webpackConfig);

// webpack-dev-server中间件
var devMiddleware = require('webpack-dev-middleware')(compiler, {
    publicPath: webpackConfig.output.publicPath,
    stats: {
        colors: true,
        chunks: false
    }
});

// fix loaderUtils.parseQuery() received.
process.noDeprecation = true

app.use(devMiddleware)

app.get('/favicon.ico', function(req, res, next) {
    res.end();
});

// 路由
app.get('/:viewname?', function(req, res, next) {

    var viewname = req.params.viewname 
        ? req.params.viewname + '.html' 
        : 'backend.html';

    var filepath = path.join(compiler.outputPath, viewname);

    // 使用webpack提供的outputFileSystem
    compiler.outputFileSystem.readFile(filepath, function(err, result) {
        if (err) {
            // something error
            return next(err);
        }
        res.set('content-type', 'text/html');
        res.send(result);
        res.end();
    });
});

module.exports = app.listen(port=8082, function(err) {
    if (err) {
        // do something
        return;
    }

    console.log('Listening at http://localhost:' + port + '\n')
})