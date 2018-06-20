<?php

use App\User;
use App\Role;

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

Route::get('/create', function(){
    $user = User::find(1);

    $user->roles()->save(new Role(['name'=>'Administrator']));
});

Route::get('/read', function(){
    $user = User::findOrFail(1);
        return $user;
});

Route::get('/update', function(){
    $user = User::findOrFail(1);

    if($user->has('/roles')){
        foreach($user->roles as $role){

            if($role->name =='Administrator'){

                $role->name = "subscriber";

                $role->save();
            }
        }
    }
});


Route::get('/delete', function(){
    $user = User::findOrFail(1);

    foreach($user->roles as $role){
        $role->whereId(2)->delete();
    }
});

Route::get('attach', function(){
    $user = User::findOrFail(1);

    $user->roles()->attach(4);
});

Route::get('detach', function(){
    $user = User::findOrFail(1);

    $user->roles()->detach(1);
});

Route::get('sync', function(){
    $user = User::findOrFail(1);

    $user->roles()->sync([6,7]);
});