
<?php
/*Kontroller ManagerC sadrži funkcije koje se koriste za rad poslovodje*/
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ManagerC extends Controller
{
    public function getIndex(){
        return 1;
    }
}
