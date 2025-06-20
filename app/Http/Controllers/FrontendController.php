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


    public function about()
    {
        try {
            $data['committees'] = Committee::where('status', 'active')->latest()->take(4)->get();
            return view('frontend.pages.about', $data);
        } catch (Exception $e) {
            Log::error("Error occurred in FrontendController@about ({$e->getFile()}:{$e->getLine()}): {$e->getMessage()}");
            return view('frontend.pages.about', ['error' => 'Unable to retrieve frontend data.']);
        }
    }

    public function eventPage()
    {
        try {
            $data['events'] = Event::where('status', 'active')
                ->orderBy('event_date', 'desc')
                ->paginate(6);
            return view('frontend.pages.event', $data);
        } catch (Exception $e) {
            Log::error("Error occurred in FrontendController@eventPage ({$e->getFile()}:{$e->getLine()}): {$e->getMessage()}");
            return view('frontend.pages.event', ['error' => 'Unable to retrieve event data.']);
        }
    }


    public function eventDetails($id)
    {
        try {
            $data['event'] = Event::findOrFail($id);
            $data['relatedEvents'] = Event::where('status', 'active')->where('id', '!=', $id)->latest()->take(3)->get();
            return view('frontend.pages.event_details', $data);
        } catch (Exception $e) {
            Log::error("Error occurred in FrontendController@event_details ({$e->getFile()}:{$e->getLine()}): {$e->getMessage()}");
            return view('frontend.pages.event_details', ['error' => 'Unable to retrieve event details.']);
        }
    }

    public function committeePage()
    {
        try {
            $data['committees'] = Committee::where('status', 'active')
                ->latest()
                ->paginate(4);
            return view('frontend.pages.committee', $data);
        } catch (Exception $e) {
            Log::error("Error occurred in FrontendController@committee ({$e->getFile()}:{$e->getLine()}): {$e->getMessage()}");
            return view('frontend.pages.committee', ['error' => 'Unable to retrieve committee data.']);
        }
    }

    public function committeePageByType($committee_type_id)
    {
        try {
            $data['committees'] = Committee::where('committee_type_id', $committee_type_id)
                ->where('status', 'active')
                ->paginate(4); // or any number you prefer for pagination
            $data['committeeTypes'] = CommitteeType::all(); // Add this line
            return view('frontend.pages.committee', $data);
        } catch (Exception $e) {
            Log::error("Error occurred in FrontendController@committeePageByType ({$e->getFile()}:{$e->getLine()}): {$e->getMessage()}");
            return view('frontend.pages.committee', ['error' => 'Unable to retrieve committee data.']);
        }
    }


    public function gurdianPortfolio()
    {
        try {
           
            return view('frontend.pages.gurdian-dashboard');
        } catch (Exception $e) {
            Log::error("Error occurred in FrontendController@gurdianPortfolio ({$e->getFile()}:{$e->getLine()}): {$e->getMessage()}");
            return view('frontend.pages.gurdian-dashboard', ['error' => 'Unable to retrieve gurdianPortfolio data.']);
        }
    }







}
