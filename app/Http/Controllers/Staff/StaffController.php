<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class StaffController extends Controller
{

    public static array $staff = array(
        'organisers' => array(7, 26),
        'spreadsheeters' => array(293),
        'graphics' => array(313219),
        'mappoolers' => array(43490, 42898, 1084, 3970, 3245),
        'mappers' => array(43490, 42898, 1084, 656, 1661, 1268, 35265, 380),
        'referees' => array(
            356, 426, 34006, 978, 20747, 73520, 144645, 37458, 9, 1084, 38118, 45749, 7, 26, 318028,
            320714, 339, 150708, 37991, 224013, 16627, 3233, 255100, 281907, 7067, 3245, 27392, 130540
        ),
        'streamers' => array(
            5, 7104, 26, 129205, 314237, 9, 41404, 318006, 255100, 229727, 328273, 201845, 1313, 3245
        ),
        'commentators' => array(
            356, 73939, 7, 129205, 1628, 29951, 45749, 37991, 146579, 154725, 23935, 1313, 215596, 84, 229727,
            63235, 3245, 127028
        )
    );

    public static function fetchStaff()
    {
        return Cache::rememberForever('staff', function () {
            $staff = [];

            foreach (self::$staff as $name => $type) {
                if (is_array($type) && count($type)) {
                    $staff[$name] = [];
                    foreach ($type as $player) {
                        $response = Http::get('https://api.quavergame.com/v1/users?id='.$player);

                        $staff[$name][] = $response->json()['users'][0];
                    }
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
