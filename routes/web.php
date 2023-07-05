<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {

    // ------------ fetch all the users ------------
    // $users = DB::select("select * from users"); 
    // $usersById = DB::select("select * from users where id = 1");
    // $usersByName = DB::select("select * from users where name = ?", ['rahman']);
    $users = DB::table("users")->get(); 
    // $userById = DB::table("users")->where("id", 3)->get();

    // ------------ create a new user ------------
    // $newUser = DB::insert('insert into users (name, email, password) values (?, ?, ?)', [
    //     'max',
    //     'max@musterman.com',
    //     'password'
    // ]);
    // $newUser = DB::table('users')->insert([
    //     'name' => 'mahmut',
    //     'email' => 'mahmut@pasha.com',
    //     'password' => 'mahmutpasha'
    // ]);

    // ------------ update a user ------------
    // first way
    // $updateUser = DB::update("update users set email = 'maxyy@musterman.com' where name = ?", ['max']);
    // second way
    // $updateUser = DB::update("update users set email = ? where name = ?", [
    //     'maximal@musterman.com',
    //     'max'
    // ]);
    // $updateUser = DB::table('users')->where('id', 3)->update(['email' => 'maxyy@musterman.com']);

    // ------------ delete a user ------------
    // $deleteUser = DB::delete("delete from users where name = ?", ['mahmut']);
    // $deleteUser = DB::table('users')->where('id', 5)->delete();

    // ------------ getting first user ------------
    $firstUser = DB::table("users")->first(); 
    // ------------ getting a user by Id with find method ------------
    $user = DB::table('users')->find(3);

    dd($user->email);
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
