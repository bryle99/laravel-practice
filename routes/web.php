<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Models\Post;
use App\Models\User;
use App\Models\Country;

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

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/about', function () {
//     return 'about us';
// });

// Route::get('/contact', function () {
//     return 'contact us';
// });

// Route::get('/post/{id}/{name}', function ($id, $name) {
//     return "Yo " . $id . " and " . $name;
// });

// Route::get('/admin/posts/example', array('as' => 'admin.home', function () {
//     $url = route('admin.home');

//     return "this url is " . $url;
// }));

// Route::get('/posts/{id}', '\App\Http\Controllers\PostsController@index');

// Route::resource('posts', '\App\Http\Controllers\PostsController');

Route::get('/contact', '\App\Http\Controllers\PostsController@contact');

Route::get('posts/{id}/{anme}', '\App\Http\Controllers\PostsController@show_posts');

// raw sql insert
// Route::get('/insert', function () {

//     DB::insert('insert into posts (title, content) values (?, ?)', ['posts2 of the day', 'yoyoyoyoyo wats uppp']);
// });

// raw sql read
// Route::get('/read', function () {

//     $result = DB::select('select * from posts',);
//     $a = '';

//     foreach ($result as $item) {
//         $a .= '<li>' . $item->title . '</li>';
//     }

//     return $a;
// });

// raw sql update
// Route::get('/update', function () {
//     $result = DB::update('update posts set title = "title2" where id = ?', ['3']);

//     return $result;
// });

// raw sql delete
// Route::get('/delete/{id}', function ($id) {
//     DB::delete('delete from posts where id = ?', [$id]);
// });

// ELOQUENT ORM USAGE
Route::get('/read', function () {

    $posts = Post::all();
    $a = '';
    foreach ($posts as $post) {
        $a .= '<li>' . $post->title . '</li>';
    }
    return $a;
});

Route::get('/find/{id}', function ($id) {

    $post = Post::find($id);

    if ($post) {
        return '<li>' . $post->title . '</li>';
    }
});

Route::get('/findwhere', function () {
    $post = Post::where('id', 1)->orderBy('id', 'ASC')->take(1)->get();

    return $post;
});

Route::get('/findmore', function () {
    $post = Post::findOrFail(1);

    // return $post;

    // $post = Post::where('users_count', '<', 50)->firstorFail();
});

Route::get('/basicinsert', function () {

    $post = new Post;

    $post->title = 'new Orm Title 3';
    $post->user_id = '1';
    $post->content = 'New conententnrtententent 3';

    $post->save();
});

Route::get('/basicupdate', function () {

    $post = Post::find(1);

    $post->title = 'ayayaya';
    $post->content = 'New conententnrtententent';

    $post->save();
});


Route::get('/create', function () {
    Post::create(['user_id' => 1, 'title' => 'the create method2', 'content' => 'yoyoyo watsterot']);
});

Route::get('/update', function () {
    Post::where('id', 9)->where('is_admin', 0)->update(['title' => 'updated title2', 'content' => 'updated content']);
});

Route::get('/delete', function () {
    $post = Post::find(9);
    $post->delete();
    // Post::where('is_admin', 0)->delete();
});

Route::get('/delete2', function () {
    Post::destroy([4, 5]);
});

Route::get('/softdelete', function () {
    Post::find(14)->delete();
});

Route::get('/readsoftdelete', function () {
    // return Post::withTrashed()->get();

    return Post::onlyTrashed()->get();
});

Route::get('/restore', function () {
    Post::onlyTrashed()->restore();
});

Route::get('/forcedelete', function () {
    Post::onlyTrashed()->forceDelete();
});

// one to one relationship user => post
Route::get('/user/{id}/post', function ($id) {
    return User::find($id)->post;

    // return $user_post;
});

// inverse relation post => user
Route::get('/post/{id}/user', function ($id) {
    return Post::find($id)->user;
});

// one to many relationship user => post
Route::get('/user/{id}/posts', function ($id) {
    $user_posts = User::find($id);
    $ret = '';

    foreach ($user_posts->posts as $post) {
        $ret .= '<li>' . $post->title . '</li>';
    }

    return $ret;
});

// many to many relationship user => role
Route::get('/user/{id}/role', function ($id) {
    // $user = User::find($id);

    // foreach ($user->roles as $role) {
    //     echo $role->name;
    // }
    $user = User::find($id)->roles()->get();

    return $user;
});

// many to many relationship user => role
Route::get('/user/all_roles', function () {
    $users = User::all();

    foreach ($users as $user) {
        foreach ($user->roles as $role) {
            echo $role->name . '<br>';
        }
    }
});

// accessing the intermediate table / pivot
Route::get('/user/pivot', function () {
    $user = User::find(1);

    foreach ($user->roles as $role) {
        echo $role->pivot;
    }
});

Route::get('/user/country', function () {
    $country = Country::find('1');

    foreach ($country->posts as $post) {
        echo $post->title . '<br>';
    }
});
