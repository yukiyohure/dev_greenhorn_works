var path = require('path');
const ExtractTextPlugin = require('extract-text-webpack-plugin');

module.exports = {
  devtool: 'inline-source-map',
  entry: {
    app: './resources/assets/css/custom.css',
  },
  output: {
    path: path.join(__dirname, 'public/css'),
    filename: 'custom.css'
  },
  module: {
    rules: [
      {
        test: /\.css$/,
        use: ExtractTextPlugin.extract({
          fallback: "style-loader",
          use: "css-loader?minimize"
        })
      },
    ]
  },
   plugins: [
    new ExtractTextPlugin('custom.css')
   ]
}
