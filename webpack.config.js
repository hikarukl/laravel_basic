const path = require('path');
const fs = require('fs');
const Dotenv = require('dotenv-webpack');

module.exports = {
    target: 'node',
    resolve: {
        alias: {
            '@': path.resolve('resources/js'),
        },
    },
    module: {
        loaders: [
            {
                test: /\.js$/,
                exclude: 'node_modules',
                loader: 'babel',
                query: {presets: ['es2015']},
            }
        ]
    },
    plugins: [
        new Dotenv()
    ]
};
