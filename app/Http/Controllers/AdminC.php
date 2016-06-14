<?php
/*Kontroller AdminC sadrži funkcije koje se koriste za administraciju platforme*/
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AdminC extends Controller
{
    public function getIndex(){
        return 1;
    }
}
