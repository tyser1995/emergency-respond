<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Document;
use App\Models\Media;
use App\Models\ContentType;
use App\Models\Contact;
use App\Models\Region;
use App\Models\Country;
use App\Models\Nationality;
use App\Models\Hotel;
use App\Models\HotelGroup;
use App\Models\Role;
use App\Models\ContentDetailTab;
use App\Models\IncidentType;

use App\Events\MyEvent;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display all the static pages when authenticated
     *
     * @param string $page
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // curl -H "Content-Type: application/json" \
        // -H "Authorization: Bearer 45AE98AC900A80E398596B657277B3248F7B4C5A5B60FC469C993E3445291B3B" \
        // -X POST "https://66abf6c4-8600-4421-ad14-648cf8670345.pushnotifications.pusher.com/publish_api/v1/instances/66abf6c4-8600-4421-ad14-648cf8670345/publishes" \
        // -d '{"interests":["hello"],"web":{"notification":{"title":"Hello","body":"Hello, world!"}}}'

        event(new MyEvent('hello world'));

        $totals = [
        'usercount' => User::count(),
        'documentcount' => 23,
        'mediacount' => 2,
        'contentcount' => 3,
        'contactcount' => 5,
        'regioncount' => 2,
        'countrycount' => 3,
        'nationalitycount' => 2,
        'hotelcount' => 10,
        'hotelgroupcount' => 1,
        'userlastupdate' => 1,
        'documentlastupdate' => 2,
        'medialastupdate' => 3,
        'contentlastupdate' => 3,
        'contactlastupdate' => 5,
        'regionlastupdate' => 5,
        'countrylastupdate' => 5,
        'nationalitylastupdate' => 1,
        'hotellastupdate' => 23,
        'hotelgrouplastupdate' => 54,
        ];

        $incident_type = IncidentType::where('deleted_flag',0)
        ->orderBy('incident_name','asc')
        ->get();

        if (view()->exists("pages.dashboard")) {
            return view("pages.dashboard", [
                'totals' => $totals,
                'incident_type' => $incident_type
            ]);
        }

        return abort(404);
    }
}
