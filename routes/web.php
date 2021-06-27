<?php

Auth::routes();
Route::get('/','ArticleController@index')->name('articles.index');
Route::resource('/articles', 'ArticleController')->except(['index', 'show'])->middleware('auth');
Route::resource('/articles', 'ArticleController')->only(['show']);
Route::prefix('articles')->name('articles.')->group(function(){
    Route::put('/{article}/like', 'ArticleController@like')->name('like')->middleware('auth');
    Route::delete('/{article}/like', 'ArticleController@unlike')->name('unlike')->middleware('auth');
});
Route::get('/tags/{name}', 'TagController@show')->name('tags.show');
Route::prefix('users')->name('users.')->group(function () {
    Route::get('/search', 'UserController@search')->name('search');
    Route::get('/{name}', 'UserController@show')->name('show');
    Route::get('/{name}/likes', 'UserController@likes')->name('likes');
    Route::get('/{name}/followings', 'UserController@followings')->name('followings');
    Route::get('/{name}/followers', 'UserController@followers')->name('followers');
    Route::middleware('auth')->group(function () {
        Route::put('/{name}/follow', 'UserController@follow')->name('follow');
        Route::delete('/{name}/follow', 'UserController@unfollow')->name('unfollow');
    });
});
Route::group(['middleware' => 'auth'], function() {
    Route::get('/folders/{id}/tasks', 'TaskController@index')->name('tasks.index');
    Route::get('/folders/{id}/tasks/create', 'TaskController@create')->name('tasks.create');
    Route::post('/folders/{id}/tasks/create', 'TaskController@store')->name('tasks.store');
    Route::get('/folders/{id}/tasks/{task_id}/edit', 'TaskController@edit')->name('tasks.edit');
    Route::put('/folders/{id}/tasks/{task_id}/edit', 'TaskController@update')->name('tasks.update');
    Route::delete('/folders/{id}/tasks', 'TaskController@destroy')->name('tasks.destroy');

    Route::get('/folders/create', 'FolderController@create')->name('folders.create');
    Route::post('/folders/create', 'FolderController@store')->name('folders.store');
    Route::get('/folders/{id}/edit', 'FolderController@edit')->name('folders.edit');
    Route::put('/folders/{id}/edit', 'FolderController@update')->name('folders.update');
    // Route::delete('/folders/{id}/tasks', 'FolderController@destroy')->name('folders.destroy');
});
