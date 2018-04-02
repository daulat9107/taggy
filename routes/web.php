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
use App\Lesson;
use App\Topic;
use Daulat\Taggy\Models\Tag;
Route::get('/', function () {
	
  $tags= Tag::usedGte(1);

  dd($tags->get());



});
