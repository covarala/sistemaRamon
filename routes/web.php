<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('', function () {
    return view('comuns.inicial');
});
Route::get('home', function () {
    return view('comuns.inicial');
});
Route::get('/teste', 'ClienteController@teste');
Route::get('/testemaps', function () {

  $config['center'] = 'Montes Claros, MG';
  $config['zoom'] = '16';
  $config['map_heigth'] = '500px';
  // $config['map_width'] = '500px';
  $config['scrollwhell'] = false;
  $config['geocodeCaching'] = true;

  GMaps::initialize($config);

  $marker['position'] = 'Montes Claros, MG';
  $marker['infowindow_content'] = 'Montes Claros';
  GMaps::add_marker($marker);


  $circle['center'] = 'Montes Claros, MG';
  $circle['radius'] = '250';
  GMaps::add_circle($circle);

  $marker['position'] = 'Colegio Marista Sao Jose - Montes Claros';
  $marker['infowindow_content'] = 'Colégio Marista';
  $marker['icon'] = 'http://maps.google.com/mapfiles/kml/pal5/icon5.png';

  GMaps::add_marker($marker);


  $map = GMaps::create_map();

  return view('teste')->with('map', $map);
});

Route::get('/admin/dashboard', 'HomeController@index')->name('admin.dashboard');
Route::get('/admin/produtos', 'HomeController@produtos')->name('admin.produtos');
Route::get('/admin/clientes', 'HomeController@clientes')->name('admin.clientes');
Route::get('/admin/usuarios', 'HomeController@usuarios')->name('admin.usuarios');
Route::get('/admin/distribuidor', 'HomeController@distribuidor')->name('admin.distribuidor');
Route::get('/admin/relatorio', 'HomeController@relatorio')->name('admin.relatorio');
Route::get('/admin/visaocliente', 'HomeController@visaocliente')->name('admin.visaocliente');
Route::get('/admin/visaodistribuidor', 'HomeController@visaodistribuidor')->name('admin.visaodistribuidor');
Route::get('/admin/excluir/usuario', 'HomeController@visaodistribuidor')->name('excluir.usuario');

Auth::routes();

Route::post('/formulario/inicial', 'LoginController@login')->name('formulario.login');
Route::get('/logout', 'LoginController@deslogar')->name('logout');

Route::get('/inicial', 'MainController@inicial');
Route::get('/entrar', 'MainController@login')->name('entrar');
Route::post('/formulario/registrar', 'LoginController@register')->name('formulario.register');
Route::get('/registrar', 'MainController@register')->name('registrar');


Route::get('/inicial', 'MainController@inicial')->name('inicial');
Route::get('/produtos', 'MainController@produtos')->name('produtos');
Route::get('/sobre', 'MainController@sobre')->name('sobre');
Route::get('/contatos', 'MainController@contatos')->name('contatos');
// Route::get('/distribuidores', 'MainController@distribuidores')->name('distribuidores');
Route::get('/detalhes', 'MainController@detalhes')->name('detalhes');
