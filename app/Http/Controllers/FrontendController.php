<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Committee\Models\Committee;
// use App\Modules\Committee\Models\CommitteeType;
use App\Modules\Event\Models\Event;
use App\Modules\Instructor\Models\Instructor;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class FrontendController extends Controller
{

    public function home()
    {
        try {
            return view('frontend.pages.home');
        } catch (Exception $e) {
            Log::error("Error occurred in FrontendController@home ({$e->getFile()}:{$e->getLine()}): {$e->getMessage()}");
            return view('frontend.index', ['error' => 'Unable to retrieve frontend data.']);
        }
    }

    public function guardianPortfolio()
    {
        try {
            return view('frontend.pages.guardian-dashboard');
        } catch (Exception $e) {
            Log::error("Error occurred in FrontendController@guardianPortfolio ({$e->getFile()}:{$e->getLine()}): {$e->getMessage()}");
            return view('frontend.pages.guardian-dashboard', ['error' => 'Unable to retrieve guardianPortfolio data.']);
        }
    }







}
