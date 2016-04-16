var elixir = require('laravel-elixir');

elixir(function (mix) {
  mix
    .styles([
      'login.css'
    ], 'public/dist/css')
    .version('dist/css/all.css');
});
