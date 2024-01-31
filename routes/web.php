<?php

use App\Http\Controllers\RegisterController;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;

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

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

Route::get('/', function () {
    return view('home', ['name' => 'pavan kalyan']);
    // return view('welcome');
});

Route::get('/register', function () {
    return view('register');
});

Route::get('/login', function () {
    return view('login');
});
Route::get('/dashboard', function () {
    return view('dashboard');
});

//  Auth::routes();
// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',
// ])->group(function () {
//     Route::get('/register', function () {
//         return Inertia::render('register');
//     })->name('register');
// });
// Route::get('/register', [RegisterController::class, 'register']);

Route::get('/redirect', function (Request $request) {
    $request->session()->put('state', $state = Str::random(40));
 
    $query = http_build_query([
        'client_id' => '3',
        'redirect_uri' => 'http://127.0.0.1:7000/api',
        'response_type' => 'code',
        'scope' => '',
        'state' => $state,
         'prompt' => '', // "none", "consent", or "login"
    ]);
// return 'redirect'.$request;
    return redirect('http://127.0.0.1:8000/oauth/authorize?'.$query);
});

 //calback
Route::get('/callback', function (Request $request) {
    $state = $request->session()->pull('state');
 
    throw_unless(
        strlen($state) > 0 && $state === $request->state,
        InvalidArgumentException::class,
        'Invalid state value.'
    );
 
    $response = Http::asForm()->post('http://127.0.0.1:8000/oauth/token', [
        'grant_type' => 'authorization_code',
        'client_id' => '4',
        'client_secret' => '7rfIyGMpbzycoSacoC5vJqtt1joJeWoxwWzeBzYQ',
        'redirect_uri' => 'http://127.0.0.1:7000/api',
        //http://third-party-app.com/callback
        'code' => $request->code,
    ]);
 return 'callback';
   // return $response->json();
});