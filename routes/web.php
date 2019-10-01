<?php


Route::get('/', function () {
    return view('index');
});




//Falta colocar las rutas de autenticacion

//Users
  Route::get('/usuarios/selectUsuarios', 'UsuarioController@selectUsuarios');
 //Canales
  Route::get('/canales_ok','CanalController@index')->name('canales');
  route::post('/canales/registrar','CanalController@store')->name('canales/registrar');
  Route::get('/canales/selectCanales', 'CanalController@selectCanales');
 //Videos
  Route::post('/uploadFiles','VideoController@uploadFiles')->name('upload-files');
  route::get('/videos','VideoController@index')->name('videos');
  route::get('/videos/listarVideos','VideoController@listarVideo')->name('listarVideos');
  route::post('/videos/registrar','VideoController@store')->name('videos/registrar');
//Playlist
  route::get('/playlist/listarPlaylist','PlaylistController@index')->name('playlist');
  route::post('/playlist/registrar','PlaylistController@store')->name('playlist/registrar');
  route::delete('/playlist/{id}','PlaylistController@delete');
  route::get('edit/mostrar/playlist/lista/{id}','PlaylistController@mostrarPlaylist');
  route::get('edit/mostrar/detalle_playlist/lista/{id}','PlaylistController@mostrarDetallePlaylist');
  route::get('edit/edit/mostrar/detalle_playlist/lista/canal/{id}','PlaylistController@mostrarCanal');
  route::get('edit/edit/mostrar/detalle_playlist/lista/usuario/{id}','PlaylistController@mostrarUsuario');

 