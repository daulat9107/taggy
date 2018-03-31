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
Route::get('/', function () {
	
  $lesson=Lesson::find(1);
  $tag=\Daulat\Taggy\Models\Tag::where('slug','orange')->first();
  $lesson->tags()->attach($tag);
});
