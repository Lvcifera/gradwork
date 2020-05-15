<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('tickets', 'TicketController@index')->name('tickets.index')->middleware('auth');
Route::get('tickets/vote', 'TicketController@vote')->name('tickets.vote')->middleware('auth');
Route::get('tickets/ad', 'TicketController@ad')->name('tickets.ad')->middleware('auth');
Route::get('tickets/create', 'TicketController@create')->name('tickets.create')->middleware('auth');
Route::post('tickets/', 'TicketController@store')->name('tickets.store');
Route::get('tickets/show/{id}', 'TicketController@show')->name('tickets.show');
Route::get('tickets/delete/{id}', 'TicketController@destroy')->name('tickets.delete');
Route::get('tickets/close/{id}', 'TicketController@close')->name('tickets.close');
Route::get('tickets/open/{id}', 'TicketController@open')->name('tickets.open');
Route::get('tickets/edit/{id}', 'TicketController@edit')->name('tickets.edit');
Route::patch('tickets/{id}', 'TicketController@update')->name('tickets.update');
Route::get('tickets/search', 'TicketController@search')->name('tickets.search');

Route::get('person/create', 'PersonController@create')->name('person.create');
Route::post('person', 'PersonController@store')->name('person.store');
Route::get('person/show/{id}', 'PersonController@show')->name('person.show');
Route::patch('person/{id}', 'PersonController@update')->name('person.update');
Route::get('person/mytickets', 'PersonController@showMyTickets')->name('person.showMyTickets');

Route::post('comments/create', 'CommentController@store')->name('comment.store');
Route::get('comments/{id}', 'CommentController@destroy')->name('comment.delete');

Route::patch('result_ticket/', 'ResultTicketController@store')->name('result_ticket.store');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
