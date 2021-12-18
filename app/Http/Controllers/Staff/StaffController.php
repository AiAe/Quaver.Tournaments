<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class StaffController extends Controller
{

    protected array $staff = array(
        'organisers' => array(7, 26),
        'spreadsheeters' => array(293),
        'graphics' => array(),
        'mappoolers' => array(43490, 3301, 1907, 49817, 4144, 1770, 170),
        'mappers' => array(170),
        'referees' => array(78, 356, 686, 978, 426, 72866),
        'streamers' => array(5, 41404, 7104, 72866, 65483),
        'commentators' => array(73939, 6143, 3087, 356, 1151, 686, 4144, 72866)
    );

    private function fetchStaff()
    {
        return Cache::rememberForever('staff', function () {
            $staff = [];

            foreach ($this->staff as $name => $type) {
                if (is_array($type) && count($type)) {
                    $prepareGet = "";
                    foreach ($type as $player) {
                        if (empty($prepareGet)) $prepareGet .= "?id=" . $player;
                        else $prepareGet .= "&id=" . $player;
                    }

                    $response = Http::get('https://api.quavergame.com/v1/users' . $prepareGet);

                    $staff[$name] = $response->json()['users'];
                }
            }

            return $staff;
        });
    }

    public function page()
    {
        $pageData[] = "";
        $pageData['seo']['title'] = "Staff";
        $pageData['seo']['description'] = "Official 4 Keys Tournament Registrations Open!";

        $pageData['staff'] = $this->fetchStaff();

        return view('staff.staff', $pageData);
    }

}
