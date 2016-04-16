var elixir = require('laravel-elixir');

elixir(function (mix) {
  mix
    .styles([
      'common.css',
      'login.css'
    ], 'public/dist/css')
    .scripts([
      'common.js'
    ], 'public/dist/js')
    .version([
      'dist/css/all.css',
      'dist/js/all.js'
    ]);
});
