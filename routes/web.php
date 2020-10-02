<?php

use Illuminate\Http\Request;
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
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', 'WelcomeController@index');

//Rotas das Notificações de comentarios
Route::get('/notifications/index', 'NotificationsController@index'); 
Route::get('/notifications', 'NotificationsController@notifications'); //Primeira rota criada, preguiça de alterar todo o codigo :D
Route::get('/notifications/update', 'NotificationsController@updateNotifications');
Route::get('/notifications/destroy', 'NotificationsController@destroyNotifications');
Route::get('/notifications/show', 'NotificationsController@showNotifications');
//Rotas Admin
//Route::get('/admin', 'AdminController@index')->name('admin');

//Rotas das Categorias 
Route::get('/categorias', 'CategoriasController@index');
Route::post('/categorias/create', 'CategoriasController@create');
Route::put('/categorias/update/{id}', 'CategoriasController@update');
Route::post('/categorias/destroy/{id}', 'CategoriasController@destroy');

//Rotas De Noticias
Route::get('/teste', 'NoticiasController@index')->middleware('auth');
Route::post('/teste/create','NoticiasController@create')->middleware('auth');
Route::put('/teste/update/{id}', 'NoticiasController@update')->middleware('auth');
Route::get('/teste/destroy/{id}', 'NoticiasController@destroy')->middleware('auth');
Route::get('/teste/show/{id}', 'NoticiasController@show');
Route::get('/teste/ultimas_noticias', 'NoticiasController@lastNews');

//Rotas notificaçoes das notícias
/*Route::get('/send', function(){
    broadcast(new \App\Events\SendNoticia);
    return 'done';
});*/


//Rotas Dos comentários
Route::get('/comments', 'ComentariosController@index');
Route::post('/comment/store/{id}', 'ComentariosController@store');
Route::get('/comment/destroy/{id}', 'ComentariosController@destroy');
Route::post('/comment/destroyadmin/{id}', 'ComentariosController@destroyadmin')->middleware('auth');    

//Rotas de Respostas dos comentarios
Route::post('/reply/store/{id}', 'RespostaController@store');   
Route::post('/reply/destroy/{id}', 'RespostaController@destroy');
Route::post('/reply/destroyadmin/{id}', 'RespostaController@destroyadmin')->middleware('auth');

//Rotas das Denuncias dos comentarios
Route::post('/denuncia/store/{id}', 'DenunciaComentariosController@store');
Route::post('/denuncia/destroy/{id}', 'DenunciaComentariosController@destroy');

//Rotas das Denuncias das respostas 
Route::post('/denuncia_reply/store/{id}', 'DenunciaReplyController@store');
Route::post('/denuncia_reply/destroy/{id}', 'DenunciaReplyController@destroy');


//Rotas de upload de imagem
Route::get('/galeriaNoticias','UploadImgController@index');
Route::post('/teste/uploadImg/{id}', 'UploadImgController@upload');
Route::get('/teste/uploadImg/destroy/{id}', 'UploadImgController@destroy');

//Rotas da Galeria Notícias de Imagens
Route::post('teste/galeriaImg/{id}', 'UploadGaleriaController@upload');
Route::get('teste/galeriaImg/preview/{galeria}', 'UploadGaleriaController@preview');
Route::get('teste/galeriaImg/destroy/{id}', 'UploadGaleriaController@destroy');
Route::post('teste/galeriaImg/destroy_galeria/{nome_galeria}', 'UploadGaleriaController@destroy_galeria');

//Rotas de Upload de video
Route::post('/teste/upload_video/{id}', 'UploadVideoController@upload');
Route::post('/teste/video_destroy/{id}', 'UploadVideoController@destroy');


//Rotas da Galeria de videos
Route::post('/teste/upload_galeria_video/{id}', 'UploadGaleriaVideoController@upload');
Route::get('/teste/galeria_video/preview/{video}', 'UploadGaleriaVideoController@preview');
Route::post('/teste/galeria_video_destroy/{id}', 'UploadGaleriaVideoController@destroy');
Route::post('/teste/video_galeria_destroy/{id}', 'UploadGaleriaVideoController@destroy_video');



//Rotas Arte e cultura e eventos
Route::get('/arte_cultura', 'ArteCulturaController@index')->middleware('auth');
Route::post('/arte_cultura/create', 'ArteCulturaController@store')->middleware('auth');
Route::post('/arte_cultura/update/{id}', 'ArteCulturaController@update')->middleware('auth');
Route::post('/arte_cultura/destroy/{id}', 'ArteCulturaController@destroy')->middleware('auth');
Route::get('/arte_cultura/show/{id}', 'ArteCulturaController@show');

//Rotas da NewsLetter
Route::get('/newsletter', 'NewsletterController@index');
Route::get('/newsletter/assing', 'NewsletterController@assing');

//Rotas de Assinatura
Route::post('/newsletterAssing/assing/create', 'NewsletterAssingController@assing_create');
Route::put('/newsletterAssing/assing/update/{id}', 'NewsletterAssingController@assing_update')->middleware('auth');
Route::post('newsletterAssing/assing/destroy/{id}', 'NewsletterAssingController@assing_destroy')->middleware('auth');
Route::post('/newsletterAssing/assing/send_mail', 'NewsletterAssingController@sendMail')->middleware('auth');

//Rotas Do Historico da Newsletter
Route::post('/newsletterHistory/history/{id}', 'NewsletterHistoryController@destroy');

