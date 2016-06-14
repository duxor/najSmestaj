<?php
/*Kontroller PrivatnikC sadrži funkcije koje se koriste za privatnike*/
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PrivatnikC extends Controller
{
    public function getIndex(){
        return 1;
    }
}
