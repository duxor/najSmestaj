<?php
/*
 * Kontroller PrivatnikC sadrži metode koje se koriste za funkcionalnosti
 * koje sprovode vlasnici privatnih smještaja (kuća, stanova)
 *
 * */
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PrivatnikC extends Controller{
    public function __construct(){
        $this->middleware('PravaPristupaMid:4,1');
    }
    public function getIndex(){
        return view('privatnik.index');
    }
}
