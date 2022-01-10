<?php

if (!function_exists('urlIs')) {
    function urlIs($url)
    {
        return request()->url() === $url ? 'active' : null;
    }
}

if (!function_exists('routeIs')) {
    function routeIs($route, $params = null)
    {
        return request()->routeIs($route, $params) ? 'active' : null;
    }
}

if (!function_exists('routeIsWithin')) {
    function routeIsWithin($route, $params = null)
    {
        return request()->routeIs($route . '*', $params) ? 'active' : null;
    }
}

if(!function_exists('arrayCombine')) {
    function arrayCombine($array) {
        return array_combine($array, $array);
    }
}

if(!function_exists('gameModeToInt')) {
    function gameModeToInt() {
        if(config('app.game_mode') == "keys4")
            return 1;
        else
            return 2;
    }
}

if (!function_exists('timezoneList')) {
    function timezoneList()
    {
        return array(
            0 =>
                array(
                    'offset' => '-11:00',
                    'label' => '(GMT-11:00) Niue',
                    'tzCode' => 'Pacific/Niue',
                ),
            1 =>
                array(
                    'offset' => '-11:00',
                    'label' => '(GMT-11:00) Pago Pago',
                    'tzCode' => 'Pacific/Pago_Pago',
                ),
            2 =>
                array(
                    'offset' => '-10:00',
                    'label' => '(GMT-10:00) Hawaii Time',
                    'tzCode' => 'Pacific/Honolulu',
                ),
            3 =>
                array(
                    'offset' => '-10:00',
                    'label' => '(GMT-10:00) Rarotonga',
                    'tzCode' => 'Pacific/Rarotonga',
                ),
            4 =>
                array(
                    'offset' => '-10:00',
                    'label' => '(GMT-10:00) Tahiti',
                    'tzCode' => 'Pacific/Tahiti',
                ),
            5 =>
                array(
                    'offset' => '-09:30',
                    'label' => '(GMT-09:30) Marquesas',
                    'tzCode' => 'Pacific/Marquesas',
                ),
            6 =>
                array(
                    'offset' => '-09:00',
                    'label' => '(GMT-09:00) Alaska Time',
                    'tzCode' => 'America/Anchorage',
                ),
            7 =>
                array(
                    'offset' => '-09:00',
                    'label' => '(GMT-09:00) Gambier',
                    'tzCode' => 'Pacific/Gambier',
                ),
            8 =>
                array(
                    'offset' => '-08:00',
                    'label' => '(GMT-08:00) Pacific Time',
                    'tzCode' => 'America/Los_Angeles',
                ),
            9 =>
                array(
                    'offset' => '-08:00',
                    'label' => '(GMT-08:00) Pacific Time - Tijuana',
                    'tzCode' => 'America/Tijuana',
                ),
            10 =>
                array(
                    'offset' => '-08:00',
                    'label' => '(GMT-08:00) Pacific Time - Vancouver',
                    'tzCode' => 'America/Vancouver',
                ),
            11 =>
                array(
                    'offset' => '-08:00',
                    'label' => '(GMT-08:00) Pacific Time - Whitehorse',
                    'tzCode' => 'America/Whitehorse',
                ),
            12 =>
                array(
                    'offset' => '-08:00',
                    'label' => '(GMT-08:00) Pitcairn',
                    'tzCode' => 'Pacific/Pitcairn',
                ),
            13 =>
                array(
                    'offset' => '-07:00',
                    'label' => '(GMT-07:00) Mountain Time',
                    'tzCode' => 'America/Denver',
                ),
            14 =>
                array(
                    'offset' => '-07:00',
                    'label' => '(GMT-07:00) Mountain Time - Arizona',
                    'tzCode' => 'America/Phoenix',
                ),
            15 =>
                array(
                    'offset' => '-07:00',
                    'label' => '(GMT-07:00) Mountain Time - Chihuahua, Mazatlan',
                    'tzCode' => 'America/Mazatlan',
                ),
            16 =>
                array(
                    'offset' => '-07:00',
                    'label' => '(GMT-07:00) Mountain Time - Dawson Creek',
                    'tzCode' => 'America/Dawson_Creek',
                ),
            17 =>
                array(
                    'offset' => '-07:00',
                    'label' => '(GMT-07:00) Mountain Time - Edmonton',
                    'tzCode' => 'America/Edmonton',
                ),
            18 =>
                array(
                    'offset' => '-07:00',
                    'label' => '(GMT-07:00) Mountain Time - Hermosillo',
                    'tzCode' => 'America/Hermosillo',
                ),
            19 =>
                array(
                    'offset' => '-07:00',
                    'label' => '(GMT-07:00) Mountain Time - Yellowknife',
                    'tzCode' => 'America/Yellowknife',
                ),
            20 =>
                array(
                    'offset' => '-06:00',
                    'label' => '(GMT-06:00) Belize',
                    'tzCode' => 'America/Belize',
                ),
            21 =>
                array(
                    'offset' => '-06:00',
                    'label' => '(GMT-06:00) Central Time',
                    'tzCode' => 'America/Chicago',
                ),
            22 =>
                array(
                    'offset' => '-06:00',
                    'label' => '(GMT-06:00) Central Time - Mexico City',
                    'tzCode' => 'America/Mexico_City',
                ),
            23 =>
                array(
                    'offset' => '-06:00',
                    'label' => '(GMT-06:00) Central Time - Regina',
                    'tzCode' => 'America/Regina',
                ),
            24 =>
                array(
                    'offset' => '-06:00',
                    'label' => '(GMT-06:00) Central Time - Tegucigalpa',
                    'tzCode' => 'America/Tegucigalpa',
                ),
            25 =>
                array(
                    'offset' => '-06:00',
                    'label' => '(GMT-06:00) Central Time - Winnipeg',
                    'tzCode' => 'America/Winnipeg',
                ),
            26 =>
                array(
                    'offset' => '-06:00',
                    'label' => '(GMT-06:00) Costa Rica',
                    'tzCode' => 'America/Costa_Rica',
                ),
            27 =>
                array(
                    'offset' => '-06:00',
                    'label' => '(GMT-06:00) El Salvador',
                    'tzCode' => 'America/El_Salvador',
                ),
            28 =>
                array(
                    'offset' => '-06:00',
                    'label' => '(GMT-06:00) Galapagos',
                    'tzCode' => 'Pacific/Galapagos',
                ),
            29 =>
                array(
                    'offset' => '-06:00',
                    'label' => '(GMT-06:00) Guatemala',
                    'tzCode' => 'America/Guatemala',
                ),
            30 =>
                array(
                    'offset' => '-06:00',
                    'label' => '(GMT-06:00) Managua',
                    'tzCode' => 'America/Managua',
                ),
            31 =>
                array(
                    'offset' => '-05:00',
                    'label' => '(GMT-05:00) America Cancun',
                    'tzCode' => 'America/Cancun',
                ),
            32 =>
                array(
                    'offset' => '-05:00',
                    'label' => '(GMT-05:00) Bogota',
                    'tzCode' => 'America/Bogota',
                ),
            33 =>
                array(
                    'offset' => '-05:00',
                    'label' => '(GMT-05:00) Easter Island',
                    'tzCode' => 'Pacific/Easter',
                ),
            34 =>
                array(
                    'offset' => '-05:00',
                    'label' => '(GMT-05:00) Eastern Time',
                    'tzCode' => 'America/New_York',
                ),
            35 =>
                array(
                    'offset' => '-05:00',
                    'label' => '(GMT-05:00) Eastern Time - Iqaluit',
                    'tzCode' => 'America/Iqaluit',
                ),
            36 =>
                array(
                    'offset' => '-05:00',
                    'label' => '(GMT-05:00) Eastern Time - Toronto',
                    'tzCode' => 'America/Toronto',
                ),
            37 =>
                array(
                    'offset' => '-05:00',
                    'label' => '(GMT-05:00) Guayaquil',
                    'tzCode' => 'America/Guayaquil',
                ),
            38 =>
                array(
                    'offset' => '-05:00',
                    'label' => '(GMT-05:00) Havana',
                    'tzCode' => 'America/Havana',
                ),
            39 =>
                array(
                    'offset' => '-05:00',
                    'label' => '(GMT-05:00) Jamaica',
                    'tzCode' => 'America/Jamaica',
                ),
            40 =>
                array(
                    'offset' => '-05:00',
                    'label' => '(GMT-05:00) Lima',
                    'tzCode' => 'America/Lima',
                ),
            41 =>
                array(
                    'offset' => '-05:00',
                    'label' => '(GMT-05:00) Nassau',
                    'tzCode' => 'America/Nassau',
                ),
            42 =>
                array(
                    'offset' => '-05:00',
                    'label' => '(GMT-05:00) Panama',
                    'tzCode' => 'America/Panama',
                ),
            43 =>
                array(
                    'offset' => '-05:00',
                    'label' => '(GMT-05:00) Port-au-Prince',
                    'tzCode' => 'America/Port-au-Prince',
                ),
            44 =>
                array(
                    'offset' => '-05:00',
                    'label' => '(GMT-05:00) Rio Branco',
                    'tzCode' => 'America/Rio_Branco',
                ),
            45 =>
                array(
                    'offset' => '-04:00',
                    'label' => '(GMT-04:00) Atlantic Time - Halifax',
                    'tzCode' => 'America/Halifax',
                ),
            46 =>
                array(
                    'offset' => '-04:00',
                    'label' => '(GMT-04:00) Barbados',
                    'tzCode' => 'America/Barbados',
                ),
            47 =>
                array(
                    'offset' => '-04:00',
                    'label' => '(GMT-04:00) Bermuda',
                    'tzCode' => 'Atlantic/Bermuda',
                ),
            48 =>
                array(
                    'offset' => '-04:00',
                    'label' => '(GMT-04:00) Boa Vista',
                    'tzCode' => 'America/Boa_Vista',
                ),
            49 =>
                array(
                    'offset' => '-04:00',
                    'label' => '(GMT-04:00) Caracas',
                    'tzCode' => 'America/Caracas',
                ),
            50 =>
                array(
                    'offset' => '-04:00',
                    'label' => '(GMT-04:00) Curacao',
                    'tzCode' => 'America/Curacao',
                ),
            51 =>
                array(
                    'offset' => '-04:00',
                    'label' => '(GMT-04:00) Grand Turk',
                    'tzCode' => 'America/Grand_Turk',
                ),
            52 =>
                array(
                    'offset' => '-04:00',
                    'label' => '(GMT-04:00) Guyana',
                    'tzCode' => 'America/Guyana',
                ),
            53 =>
                array(
                    'offset' => '-04:00',
                    'label' => '(GMT-04:00) La Paz',
                    'tzCode' => 'America/La_Paz',
                ),
            54 =>
                array(
                    'offset' => '-04:00',
                    'label' => '(GMT-04:00) Manaus',
                    'tzCode' => 'America/Manaus',
                ),
            55 =>
                array(
                    'offset' => '-04:00',
                    'label' => '(GMT-04:00) Martinique',
                    'tzCode' => 'America/Martinique',
                ),
            56 =>
                array(
                    'offset' => '-04:00',
                    'label' => '(GMT-04:00) Port of Spain',
                    'tzCode' => 'America/Port_of_Spain',
                ),
            57 =>
                array(
                    'offset' => '-04:00',
                    'label' => '(GMT-04:00) Porto Velho',
                    'tzCode' => 'America/Porto_Velho',
                ),
            58 =>
                array(
                    'offset' => '-04:00',
                    'label' => '(GMT-04:00) Puerto Rico',
                    'tzCode' => 'America/Puerto_Rico',
                ),
            59 =>
                array(
                    'offset' => '-04:00',
                    'label' => '(GMT-04:00) Santo Domingo',
                    'tzCode' => 'America/Santo_Domingo',
                ),
            60 =>
                array(
                    'offset' => '-04:00',
                    'label' => '(GMT-04:00) Thule',
                    'tzCode' => 'America/Thule',
                ),
            61 =>
                array(
                    'offset' => '-03:30',
                    'label' => '(GMT-03:30) Newfoundland Time - St. Johns',
                    'tzCode' => 'America/St_Johns',
                ),
            62 =>
                array(
                    'offset' => '-03:00',
                    'label' => '(GMT-03:00) Araguaina',
                    'tzCode' => 'America/Araguaina',
                ),
            63 =>
                array(
                    'offset' => '-03:00',
                    'label' => '(GMT-03:00) Asuncion',
                    'tzCode' => 'America/Asuncion',
                ),
            64 =>
                array(
                    'offset' => '-03:00',
                    'label' => '(GMT-03:00) Belem',
                    'tzCode' => 'America/Belem',
                ),
            65 =>
                array(
                    'offset' => '-03:00',
                    'label' => '(GMT-03:00) Buenos Aires',
                    'tzCode' => 'America/Argentina/Buenos_Aires',
                ),
            66 =>
                array(
                    'offset' => '-03:00',
                    'label' => '(GMT-03:00) Campo Grande',
                    'tzCode' => 'America/Campo_Grande',
                ),
            67 =>
                array(
                    'offset' => '-03:00',
                    'label' => '(GMT-03:00) Cayenne',
                    'tzCode' => 'America/Cayenne',
                ),
            68 =>
                array(
                    'offset' => '-03:00',
                    'label' => '(GMT-03:00) Cuiaba',
                    'tzCode' => 'America/Cuiaba',
                ),
            69 =>
                array(
                    'offset' => '-03:00',
                    'label' => '(GMT-03:00) Fortaleza',
                    'tzCode' => 'America/Fortaleza',
                ),
            70 =>
                array(
                    'offset' => '-03:00',
                    'label' => '(GMT-03:00) Godthab',
                    'tzCode' => 'America/Godthab',
                ),
            71 =>
                array(
                    'offset' => '-03:00',
                    'label' => '(GMT-03:00) Maceio',
                    'tzCode' => 'America/Maceio',
                ),
            72 =>
                array(
                    'offset' => '-03:00',
                    'label' => '(GMT-03:00) Miquelon',
                    'tzCode' => 'America/Miquelon',
                ),
            73 =>
                array(
                    'offset' => '-03:00',
                    'label' => '(GMT-03:00) Montevideo',
                    'tzCode' => 'America/Montevideo',
                ),
            74 =>
                array(
                    'offset' => '-03:00',
                    'label' => '(GMT-03:00) Palmer',
                    'tzCode' => 'Antarctica/Palmer',
                ),
            75 =>
                array(
                    'offset' => '-03:00',
                    'label' => '(GMT-03:00) Paramaribo',
                    'tzCode' => 'America/Paramaribo',
                ),
            76 =>
                array(
                    'offset' => '-03:00',
                    'label' => '(GMT-03:00) Punta Arenas',
                    'tzCode' => 'America/Punta_Arenas',
                ),
            77 =>
                array(
                    'offset' => '-03:00',
                    'label' => '(GMT-03:00) Recife',
                    'tzCode' => 'America/Recife',
                ),
            78 =>
                array(
                    'offset' => '-03:00',
                    'label' => '(GMT-03:00) Rothera',
                    'tzCode' => 'Antarctica/Rothera',
                ),
            79 =>
                array(
                    'offset' => '-03:00',
                    'label' => '(GMT-03:00) Salvador',
                    'tzCode' => 'America/Bahia',
                ),
            80 =>
                array(
                    'offset' => '-03:00',
                    'label' => '(GMT-03:00) Santiago',
                    'tzCode' => 'America/Santiago',
                ),
            81 =>
                array(
                    'offset' => '-03:00',
                    'label' => '(GMT-03:00) Stanley',
                    'tzCode' => 'Atlantic/Stanley',
                ),
            82 =>
                array(
                    'offset' => '-02:00',
                    'label' => '(GMT-02:00) Noronha',
                    'tzCode' => 'America/Noronha',
                ),
            83 =>
                array(
                    'offset' => '-02:00',
                    'label' => '(GMT-02:00) Sao Paulo',
                    'tzCode' => 'America/Sao_Paulo',
                ),
            84 =>
                array(
                    'offset' => '-02:00',
                    'label' => '(GMT-02:00) South Georgia',
                    'tzCode' => 'Atlantic/South_Georgia',
                ),
            85 =>
                array(
                    'offset' => '-01:00',
                    'label' => '(GMT-01:00) Azores',
                    'tzCode' => 'Atlantic/Azores',
                ),
            86 =>
                array(
                    'offset' => '-01:00',
                    'label' => '(GMT-01:00) Cape Verde',
                    'tzCode' => 'Atlantic/Cape_Verde',
                ),
            87 =>
                array(
                    'offset' => '-01:00',
                    'label' => '(GMT-01:00) Scoresbysund',
                    'tzCode' => 'America/Scoresbysund',
                ),
            88 =>
                array(
                    'offset' => '+00:00',
                    'label' => '(GMT+00:00) Abidjan',
                    'tzCode' => 'Africa/Abidjan',
                ),
            89 =>
                array(
                    'offset' => '+00:00',
                    'label' => '(GMT+00:00) Accra',
                    'tzCode' => 'Africa/Accra',
                ),
            90 =>
                array(
                    'offset' => '+00:00',
                    'label' => '(GMT+00:00) Bissau',
                    'tzCode' => 'Africa/Bissau',
                ),
            91 =>
                array(
                    'offset' => '+00:00',
                    'label' => '(GMT+00:00) Canary Islands',
                    'tzCode' => 'Atlantic/Canary',
                ),
            92 =>
                array(
                    'offset' => '+00:00',
                    'label' => '(GMT+00:00) Casablanca',
                    'tzCode' => 'Africa/Casablanca',
                ),
            93 =>
                array(
                    'offset' => '+00:00',
                    'label' => '(GMT+00:00) Danmarkshavn',
                    'tzCode' => 'America/Danmarkshavn',
                ),
            94 =>
                array(
                    'offset' => '+00:00',
                    'label' => '(GMT+00:00) Dublin',
                    'tzCode' => 'Europe/Dublin',
                ),
            95 =>
                array(
                    'offset' => '+00:00',
                    'label' => '(GMT+00:00) El Aaiun',
                    'tzCode' => 'Africa/El_Aaiun',
                ),
            96 =>
                array(
                    'offset' => '+00:00',
                    'label' => '(GMT+00:00) Faeroe',
                    'tzCode' => 'Atlantic/Faroe',
                ),
            97 =>
                array(
                    'offset' => '+00:00',
                    'label' => '(GMT+00:00) GMT (no daylight saving)',
                    'tzCode' => 'Etc/GMT',
                ),
            98 =>
                array(
                    'offset' => '+00:00',
                    'label' => '(GMT+00:00) Lisbon',
                    'tzCode' => 'Europe/Lisbon',
                ),
            99 =>
                array(
                    'offset' => '+00:00',
                    'label' => '(GMT+00:00) London',
                    'tzCode' => 'Europe/London',
                ),
            100 =>
                array(
                    'offset' => '+00:00',
                    'label' => '(GMT+00:00) Monrovia',
                    'tzCode' => 'Africa/Monrovia',
                ),
            101 =>
                array(
                    'offset' => '+00:00',
                    'label' => '(GMT+00:00) Reykjavik',
                    'tzCode' => 'Atlantic/Reykjavik',
                ),
            102 =>
                array(
                    'offset' => '+01:00',
                    'label' => '(GMT+01:00) Algiers',
                    'tzCode' => 'Africa/Algiers',
                ),
            103 =>
                array(
                    'offset' => '+01:00',
                    'label' => '(GMT+01:00) Amsterdam',
                    'tzCode' => 'Europe/Amsterdam',
                ),
            104 =>
                array(
                    'offset' => '+01:00',
                    'label' => '(GMT+01:00) Andorra',
                    'tzCode' => 'Europe/Andorra',
                ),
            105 =>
                array(
                    'offset' => '+01:00',
                    'label' => '(GMT+01:00) Berlin',
                    'tzCode' => 'Europe/Berlin',
                ),
            106 =>
                array(
                    'offset' => '+01:00',
                    'label' => '(GMT+01:00) Brussels',
                    'tzCode' => 'Europe/Brussels',
                ),
            107 =>
                array(
                    'offset' => '+01:00',
                    'label' => '(GMT+01:00) Budapest',
                    'tzCode' => 'Europe/Budapest',
                ),
            108 =>
                array(
                    'offset' => '+01:00',
                    'label' => '(GMT+01:00) Central European Time - Belgrade',
                    'tzCode' => 'Europe/Belgrade',
                ),
            109 =>
                array(
                    'offset' => '+01:00',
                    'label' => '(GMT+01:00) Central European Time - Prague',
                    'tzCode' => 'Europe/Prague',
                ),
            110 =>
                array(
                    'offset' => '+01:00',
                    'label' => '(GMT+01:00) Ceuta',
                    'tzCode' => 'Africa/Ceuta',
                ),
            111 =>
                array(
                    'offset' => '+01:00',
                    'label' => '(GMT+01:00) Copenhagen',
                    'tzCode' => 'Europe/Copenhagen',
                ),
            112 =>
                array(
                    'offset' => '+01:00',
                    'label' => '(GMT+01:00) Gibraltar',
                    'tzCode' => 'Europe/Gibraltar',
                ),
            113 =>
                array(
                    'offset' => '+01:00',
                    'label' => '(GMT+01:00) Lagos',
                    'tzCode' => 'Africa/Lagos',
                ),
            114 =>
                array(
                    'offset' => '+01:00',
                    'label' => '(GMT+01:00) Luxembourg',
                    'tzCode' => 'Europe/Luxembourg',
                ),
            115 =>
                array(
                    'offset' => '+01:00',
                    'label' => '(GMT+01:00) Madrid',
                    'tzCode' => 'Europe/Madrid',
                ),
            116 =>
                array(
                    'offset' => '+01:00',
                    'label' => '(GMT+01:00) Malta',
                    'tzCode' => 'Europe/Malta',
                ),
            117 =>
                array(
                    'offset' => '+01:00',
                    'label' => '(GMT+01:00) Monaco',
                    'tzCode' => 'Europe/Monaco',
                ),
            118 =>
                array(
                    'offset' => '+01:00',
                    'label' => '(GMT+01:00) Ndjamena',
                    'tzCode' => 'Africa/Ndjamena',
                ),
            119 =>
                array(
                    'offset' => '+01:00',
                    'label' => '(GMT+01:00) Oslo',
                    'tzCode' => 'Europe/Oslo',
                ),
            120 =>
                array(
                    'offset' => '+01:00',
                    'label' => '(GMT+01:00) Paris',
                    'tzCode' => 'Europe/Paris',
                ),
            121 =>
                array(
                    'offset' => '+01:00',
                    'label' => '(GMT+01:00) Rome',
                    'tzCode' => 'Europe/Rome',
                ),
            122 =>
                array(
                    'offset' => '+01:00',
                    'label' => '(GMT+01:00) Stockholm',
                    'tzCode' => 'Europe/Stockholm',
                ),
            123 =>
                array(
                    'offset' => '+01:00',
                    'label' => '(GMT+01:00) Tirane',
                    'tzCode' => 'Europe/Tirane',
                ),
            124 =>
                array(
                    'offset' => '+01:00',
                    'label' => '(GMT+01:00) Tunis',
                    'tzCode' => 'Africa/Tunis',
                ),
            125 =>
                array(
                    'offset' => '+01:00',
                    'label' => '(GMT+01:00) Vienna',
                    'tzCode' => 'Europe/Vienna',
                ),
            126 =>
                array(
                    'offset' => '+01:00',
                    'label' => '(GMT+01:00) Warsaw',
                    'tzCode' => 'Europe/Warsaw',
                ),
            127 =>
                array(
                    'offset' => '+01:00',
                    'label' => '(GMT+01:00) Zurich',
                    'tzCode' => 'Europe/Zurich',
                ),
            128 =>
                array(
                    'offset' => '+02:00',
                    'label' => '(GMT+02:00) Amman',
                    'tzCode' => 'Asia/Amman',
                ),
            129 =>
                array(
                    'offset' => '+02:00',
                    'label' => '(GMT+02:00) Athens',
                    'tzCode' => 'Europe/Athens',
                ),
            130 =>
                array(
                    'offset' => '+02:00',
                    'label' => '(GMT+02:00) Beirut',
                    'tzCode' => 'Asia/Beirut',
                ),
            131 =>
                array(
                    'offset' => '+02:00',
                    'label' => '(GMT+02:00) Bucharest',
                    'tzCode' => 'Europe/Bucharest',
                ),
            132 =>
                array(
                    'offset' => '+02:00',
                    'label' => '(GMT+02:00) Cairo',
                    'tzCode' => 'Africa/Cairo',
                ),
            133 =>
                array(
                    'offset' => '+02:00',
                    'label' => '(GMT+02:00) Chisinau',
                    'tzCode' => 'Europe/Chisinau',
                ),
            134 =>
                array(
                    'offset' => '+02:00',
                    'label' => '(GMT+02:00) Damascus',
                    'tzCode' => 'Asia/Damascus',
                ),
            135 =>
                array(
                    'offset' => '+02:00',
                    'label' => '(GMT+02:00) Gaza',
                    'tzCode' => 'Asia/Gaza',
                ),
            136 =>
                array(
                    'offset' => '+02:00',
                    'label' => '(GMT+02:00) Helsinki',
                    'tzCode' => 'Europe/Helsinki',
                ),
            137 =>
                array(
                    'offset' => '+02:00',
                    'label' => '(GMT+02:00) Jerusalem',
                    'tzCode' => 'Asia/Jerusalem',
                ),
            138 =>
                array(
                    'offset' => '+02:00',
                    'label' => '(GMT+02:00) Johannesburg',
                    'tzCode' => 'Africa/Johannesburg',
                ),
            139 =>
                array(
                    'offset' => '+02:00',
                    'label' => '(GMT+02:00) Khartoum',
                    'tzCode' => 'Africa/Khartoum',
                ),
            140 =>
                array(
                    'offset' => '+02:00',
                    'label' => '(GMT+02:00) Kiev',
                    'tzCode' => 'Europe/Kiev',
                ),
            141 =>
                array(
                    'offset' => '+02:00',
                    'label' => '(GMT+02:00) Maputo',
                    'tzCode' => 'Africa/Maputo',
                ),
            142 =>
                array(
                    'offset' => '+02:00',
                    'label' => '(GMT+02:00) Moscow-01 - Kaliningrad',
                    'tzCode' => 'Europe/Kaliningrad',
                ),
            143 =>
                array(
                    'offset' => '+02:00',
                    'label' => '(GMT+02:00) Nicosia',
                    'tzCode' => 'Asia/Nicosia',
                ),
            144 =>
                array(
                    'offset' => '+02:00',
                    'label' => '(GMT+02:00) Riga',
                    'tzCode' => 'Europe/Riga',
                ),
            145 =>
                array(
                    'offset' => '+02:00',
                    'label' => '(GMT+02:00) Sofia',
                    'tzCode' => 'Europe/Sofia',
                ),
            146 =>
                array(
                    'offset' => '+02:00',
                    'label' => '(GMT+02:00) Tallinn',
                    'tzCode' => 'Europe/Tallinn',
                ),
            147 =>
                array(
                    'offset' => '+02:00',
                    'label' => '(GMT+02:00) Tripoli',
                    'tzCode' => 'Africa/Tripoli',
                ),
            148 =>
                array(
                    'offset' => '+02:00',
                    'label' => '(GMT+02:00) Vilnius',
                    'tzCode' => 'Europe/Vilnius',
                ),
            149 =>
                array(
                    'offset' => '+02:00',
                    'label' => '(GMT+02:00) Windhoek',
                    'tzCode' => 'Africa/Windhoek',
                ),
            150 =>
                array(
                    'offset' => '+03:00',
                    'label' => '(GMT+03:00) Baghdad',
                    'tzCode' => 'Asia/Baghdad',
                ),
            151 =>
                array(
                    'offset' => '+03:00',
                    'label' => '(GMT+03:00) Istanbul',
                    'tzCode' => 'Europe/Istanbul',
                ),
            152 =>
                array(
                    'offset' => '+03:00',
                    'label' => '(GMT+03:00) Minsk',
                    'tzCode' => 'Europe/Minsk',
                ),
            153 =>
                array(
                    'offset' => '+03:00',
                    'label' => '(GMT+03:00) Moscow+00 - Moscow',
                    'tzCode' => 'Europe/Moscow',
                ),
            154 =>
                array(
                    'offset' => '+03:00',
                    'label' => '(GMT+03:00) Nairobi',
                    'tzCode' => 'Africa/Nairobi',
                ),
            155 =>
                array(
                    'offset' => '+03:00',
                    'label' => '(GMT+03:00) Qatar',
                    'tzCode' => 'Asia/Qatar',
                ),
            156 =>
                array(
                    'offset' => '+03:00',
                    'label' => '(GMT+03:00) Riyadh',
                    'tzCode' => 'Asia/Riyadh',
                ),
            157 =>
                array(
                    'offset' => '+03:00',
                    'label' => '(GMT+03:00) Syowa',
                    'tzCode' => 'Antarctica/Syowa',
                ),
            158 =>
                array(
                    'offset' => '+03:30',
                    'label' => '(GMT+03:30) Tehran',
                    'tzCode' => 'Asia/Tehran',
                ),
            159 =>
                array(
                    'offset' => '+04:00',
                    'label' => '(GMT+04:00) Baku',
                    'tzCode' => 'Asia/Baku',
                ),
            160 =>
                array(
                    'offset' => '+04:00',
                    'label' => '(GMT+04:00) Dubai',
                    'tzCode' => 'Asia/Dubai',
                ),
            161 =>
                array(
                    'offset' => '+04:00',
                    'label' => '(GMT+04:00) Mahe',
                    'tzCode' => 'Indian/Mahe',
                ),
            162 =>
                array(
                    'offset' => '+04:00',
                    'label' => '(GMT+04:00) Mauritius',
                    'tzCode' => 'Indian/Mauritius',
                ),
            163 =>
                array(
                    'offset' => '+04:00',
                    'label' => '(GMT+04:00) Moscow+01 - Samara',
                    'tzCode' => 'Europe/Samara',
                ),
            164 =>
                array(
                    'offset' => '+04:00',
                    'label' => '(GMT+04:00) Reunion',
                    'tzCode' => 'Indian/Reunion',
                ),
            165 =>
                array(
                    'offset' => '+04:00',
                    'label' => '(GMT+04:00) Tbilisi',
                    'tzCode' => 'Asia/Tbilisi',
                ),
            166 =>
                array(
                    'offset' => '+04:00',
                    'label' => '(GMT+04:00) Yerevan',
                    'tzCode' => 'Asia/Yerevan',
                ),
            167 =>
                array(
                    'offset' => '+04:30',
                    'label' => '(GMT+04:30) Kabul',
                    'tzCode' => 'Asia/Kabul',
                ),
            168 =>
                array(
                    'offset' => '+05:00',
                    'label' => '(GMT+05:00) Aqtau',
                    'tzCode' => 'Asia/Aqtau',
                ),
            169 =>
                array(
                    'offset' => '+05:00',
                    'label' => '(GMT+05:00) Aqtobe',
                    'tzCode' => 'Asia/Aqtobe',
                ),
            170 =>
                array(
                    'offset' => '+05:00',
                    'label' => '(GMT+05:00) Ashgabat',
                    'tzCode' => 'Asia/Ashgabat',
                ),
            171 =>
                array(
                    'offset' => '+05:00',
                    'label' => '(GMT+05:00) Dushanbe',
                    'tzCode' => 'Asia/Dushanbe',
                ),
            172 =>
                array(
                    'offset' => '+05:00',
                    'label' => '(GMT+05:00) Karachi',
                    'tzCode' => 'Asia/Karachi',
                ),
            173 =>
                array(
                    'offset' => '+05:00',
                    'label' => '(GMT+05:00) Kerguelen',
                    'tzCode' => 'Indian/Kerguelen',
                ),
            174 =>
                array(
                    'offset' => '+05:00',
                    'label' => '(GMT+05:00) Maldives',
                    'tzCode' => 'Indian/Maldives',
                ),
            175 =>
                array(
                    'offset' => '+05:00',
                    'label' => '(GMT+05:00) Mawson',
                    'tzCode' => 'Antarctica/Mawson',
                ),
            176 =>
                array(
                    'offset' => '+05:00',
                    'label' => '(GMT+05:00) Moscow+02 - Yekaterinburg',
                    'tzCode' => 'Asia/Yekaterinburg',
                ),
            177 =>
                array(
                    'offset' => '+05:00',
                    'label' => '(GMT+05:00) Tashkent',
                    'tzCode' => 'Asia/Tashkent',
                ),
            178 =>
                array(
                    'offset' => '+05:30',
                    'label' => '(GMT+05:30) Colombo',
                    'tzCode' => 'Asia/Colombo',
                ),
            179 =>
                array(
                    'offset' => '+05:30',
                    'label' => '(GMT+05:30) India Standard Time',
                    'tzCode' => 'Asia/Kolkata',
                ),
            180 =>
                array(
                    'offset' => '+05:45',
                    'label' => '(GMT+05:45) Kathmandu',
                    'tzCode' => 'Asia/Kathmandu',
                ),
            181 =>
                array(
                    'offset' => '+06:00',
                    'label' => '(GMT+06:00) Almaty',
                    'tzCode' => 'Asia/Almaty',
                ),
            182 =>
                array(
                    'offset' => '+06:00',
                    'label' => '(GMT+06:00) Bishkek',
                    'tzCode' => 'Asia/Bishkek',
                ),
            183 =>
                array(
                    'offset' => '+06:00',
                    'label' => '(GMT+06:00) Chagos',
                    'tzCode' => 'Indian/Chagos',
                ),
            184 =>
                array(
                    'offset' => '+06:00',
                    'label' => '(GMT+06:00) Dhaka',
                    'tzCode' => 'Asia/Dhaka',
                ),
            185 =>
                array(
                    'offset' => '+06:00',
                    'label' => '(GMT+06:00) Moscow+03 - Omsk',
                    'tzCode' => 'Asia/Omsk',
                ),
            186 =>
                array(
                    'offset' => '+06:00',
                    'label' => '(GMT+06:00) Thimphu',
                    'tzCode' => 'Asia/Thimphu',
                ),
            187 =>
                array(
                    'offset' => '+06:00',
                    'label' => '(GMT+06:00) Vostok',
                    'tzCode' => 'Antarctica/Vostok',
                ),
            188 =>
                array(
                    'offset' => '+06:30',
                    'label' => '(GMT+06:30) Cocos',
                    'tzCode' => 'Indian/Cocos',
                ),
            189 =>
                array(
                    'offset' => '+06:30',
                    'label' => '(GMT+06:30) Rangoon',
                    'tzCode' => 'Asia/Yangon',
                ),
            190 =>
                array(
                    'offset' => '+07:00',
                    'label' => '(GMT+07:00) Bangkok',
                    'tzCode' => 'Asia/Bangkok',
                ),
            191 =>
                array(
                    'offset' => '+07:00',
                    'label' => '(GMT+07:00) Christmas',
                    'tzCode' => 'Indian/Christmas',
                ),
            192 =>
                array(
                    'offset' => '+07:00',
                    'label' => '(GMT+07:00) Davis',
                    'tzCode' => 'Antarctica/Davis',
                ),
            193 =>
                array(
                    'offset' => '+07:00',
                    'label' => '(GMT+07:00) Hanoi',
                    'tzCode' => 'Asia/Saigon',
                ),
            194 =>
                array(
                    'offset' => '+07:00',
                    'label' => '(GMT+07:00) Hovd',
                    'tzCode' => 'Asia/Hovd',
                ),
            195 =>
                array(
                    'offset' => '+07:00',
                    'label' => '(GMT+07:00) Jakarta',
                    'tzCode' => 'Asia/Jakarta',
                ),
            196 =>
                array(
                    'offset' => '+07:00',
                    'label' => '(GMT+07:00) Moscow+04 - Krasnoyarsk',
                    'tzCode' => 'Asia/Krasnoyarsk',
                ),
            197 =>
                array(
                    'offset' => '+08:00',
                    'label' => '(GMT+08:00) Brunei',
                    'tzCode' => 'Asia/Brunei',
                ),
            198 =>
                array(
                    'offset' => '+08:00',
                    'label' => '(GMT+08:00) China Time - Beijing',
                    'tzCode' => 'Asia/Shanghai',
                ),
            199 =>
                array(
                    'offset' => '+08:00',
                    'label' => '(GMT+08:00) Choibalsan',
                    'tzCode' => 'Asia/Choibalsan',
                ),
            200 =>
                array(
                    'offset' => '+08:00',
                    'label' => '(GMT+08:00) Hong Kong',
                    'tzCode' => 'Asia/Hong_Kong',
                ),
            201 =>
                array(
                    'offset' => '+08:00',
                    'label' => '(GMT+08:00) Kuala Lumpur',
                    'tzCode' => 'Asia/Kuala_Lumpur',
                ),
            202 =>
                array(
                    'offset' => '+08:00',
                    'label' => '(GMT+08:00) Macau',
                    'tzCode' => 'Asia/Macau',
                ),
            203 =>
                array(
                    'offset' => '+08:00',
                    'label' => '(GMT+08:00) Makassar',
                    'tzCode' => 'Asia/Makassar',
                ),
            204 =>
                array(
                    'offset' => '+08:00',
                    'label' => '(GMT+08:00) Manila',
                    'tzCode' => 'Asia/Manila',
                ),
            205 =>
                array(
                    'offset' => '+08:00',
                    'label' => '(GMT+08:00) Moscow+05 - Irkutsk',
                    'tzCode' => 'Asia/Irkutsk',
                ),
            206 =>
                array(
                    'offset' => '+08:00',
                    'label' => '(GMT+08:00) Singapore',
                    'tzCode' => 'Asia/Singapore',
                ),
            207 =>
                array(
                    'offset' => '+08:00',
                    'label' => '(GMT+08:00) Taipei',
                    'tzCode' => 'Asia/Taipei',
                ),
            208 =>
                array(
                    'offset' => '+08:00',
                    'label' => '(GMT+08:00) Ulaanbaatar',
                    'tzCode' => 'Asia/Ulaanbaatar',
                ),
            209 =>
                array(
                    'offset' => '+08:00',
                    'label' => '(GMT+08:00) Western Time - Perth',
                    'tzCode' => 'Australia/Perth',
                ),
            210 =>
                array(
                    'offset' => '+08:30',
                    'label' => '(GMT+08:30) Pyongyang',
                    'tzCode' => 'Asia/Pyongyang',
                ),
            211 =>
                array(
                    'offset' => '+09:00',
                    'label' => '(GMT+09:00) Dili',
                    'tzCode' => 'Asia/Dili',
                ),
            212 =>
                array(
                    'offset' => '+09:00',
                    'label' => '(GMT+09:00) Jayapura',
                    'tzCode' => 'Asia/Jayapura',
                ),
            213 =>
                array(
                    'offset' => '+09:00',
                    'label' => '(GMT+09:00) Moscow+06 - Yakutsk',
                    'tzCode' => 'Asia/Yakutsk',
                ),
            214 =>
                array(
                    'offset' => '+09:00',
                    'label' => '(GMT+09:00) Palau',
                    'tzCode' => 'Pacific/Palau',
                ),
            215 =>
                array(
                    'offset' => '+09:00',
                    'label' => '(GMT+09:00) Seoul',
                    'tzCode' => 'Asia/Seoul',
                ),
            216 =>
                array(
                    'offset' => '+09:00',
                    'label' => '(GMT+09:00) Tokyo',
                    'tzCode' => 'Asia/Tokyo',
                ),
            217 =>
                array(
                    'offset' => '+09:30',
                    'label' => '(GMT+09:30) Central Time - Darwin',
                    'tzCode' => 'Australia/Darwin',
                ),
            218 =>
                array(
                    'offset' => '+10:00',
                    'label' => '(GMT+10:00) Dumont D\\\'Urville',
                    'tzCode' => 'Antarctica/DumontDUrville',
                ),
            219 =>
                array(
                    'offset' => '+10:00',
                    'label' => '(GMT+10:00) Eastern Time - Brisbane',
                    'tzCode' => 'Australia/Brisbane',
                ),
            220 =>
                array(
                    'offset' => '+10:00',
                    'label' => '(GMT+10:00) Guam',
                    'tzCode' => 'Pacific/Guam',
                ),
            221 =>
                array(
                    'offset' => '+10:00',
                    'label' => '(GMT+10:00) Moscow+07 - Vladivostok',
                    'tzCode' => 'Asia/Vladivostok',
                ),
            222 =>
                array(
                    'offset' => '+10:00',
                    'label' => '(GMT+10:00) Port Moresby',
                    'tzCode' => 'Pacific/Port_Moresby',
                ),
            223 =>
                array(
                    'offset' => '+10:00',
                    'label' => '(GMT+10:00) Truk',
                    'tzCode' => 'Pacific/Chuuk',
                ),
            224 =>
                array(
                    'offset' => '+10:30',
                    'label' => '(GMT+10:30) Central Time - Adelaide',
                    'tzCode' => 'Australia/Adelaide',
                ),
            225 =>
                array(
                    'offset' => '+11:00',
                    'label' => '(GMT+11:00) Casey',
                    'tzCode' => 'Antarctica/Casey',
                ),
            226 =>
                array(
                    'offset' => '+11:00',
                    'label' => '(GMT+11:00) Eastern Time - Hobart',
                    'tzCode' => 'Australia/Hobart',
                ),
            227 =>
                array(
                    'offset' => '+11:00',
                    'label' => '(GMT+11:00) Eastern Time - Melbourne, Sydney',
                    'tzCode' => 'Australia/Sydney',
                ),
            228 =>
                array(
                    'offset' => '+11:00',
                    'label' => '(GMT+11:00) Efate',
                    'tzCode' => 'Pacific/Efate',
                ),
            229 =>
                array(
                    'offset' => '+11:00',
                    'label' => '(GMT+11:00) Guadalcanal',
                    'tzCode' => 'Pacific/Guadalcanal',
                ),
            230 =>
                array(
                    'offset' => '+11:00',
                    'label' => '(GMT+11:00) Kosrae',
                    'tzCode' => 'Pacific/Kosrae',
                ),
            231 =>
                array(
                    'offset' => '+11:00',
                    'label' => '(GMT+11:00) Moscow+08 - Magadan',
                    'tzCode' => 'Asia/Magadan',
                ),
            232 =>
                array(
                    'offset' => '+11:00',
                    'label' => '(GMT+11:00) Norfolk',
                    'tzCode' => 'Pacific/Norfolk',
                ),
            233 =>
                array(
                    'offset' => '+11:00',
                    'label' => '(GMT+11:00) Noumea',
                    'tzCode' => 'Pacific/Noumea',
                ),
            234 =>
                array(
                    'offset' => '+11:00',
                    'label' => '(GMT+11:00) Ponape',
                    'tzCode' => 'Pacific/Pohnpei',
                ),
            235 =>
                array(
                    'offset' => '+12:00',
                    'label' => '(GMT+12:00) Funafuti',
                    'tzCode' => 'Pacific/Funafuti',
                ),
            236 =>
                array(
                    'offset' => '+12:00',
                    'label' => '(GMT+12:00) Kwajalein',
                    'tzCode' => 'Pacific/Kwajalein',
                ),
            237 =>
                array(
                    'offset' => '+12:00',
                    'label' => '(GMT+12:00) Majuro',
                    'tzCode' => 'Pacific/Majuro',
                ),
            238 =>
                array(
                    'offset' => '+12:00',
                    'label' => '(GMT+12:00) Moscow+09 - Petropavlovsk-Kamchatskiy',
                    'tzCode' => 'Asia/Kamchatka',
                ),
            239 =>
                array(
                    'offset' => '+12:00',
                    'label' => '(GMT+12:00) Nauru',
                    'tzCode' => 'Pacific/Nauru',
                ),
            240 =>
                array(
                    'offset' => '+12:00',
                    'label' => '(GMT+12:00) Tarawa',
                    'tzCode' => 'Pacific/Tarawa',
                ),
            241 =>
                array(
                    'offset' => '+12:00',
                    'label' => '(GMT+12:00) Wake',
                    'tzCode' => 'Pacific/Wake',
                ),
            242 =>
                array(
                    'offset' => '+12:00',
                    'label' => '(GMT+12:00) Wallis',
                    'tzCode' => 'Pacific/Wallis',
                ),
            243 =>
                array(
                    'offset' => '+13:00',
                    'label' => '(GMT+13:00) Auckland',
                    'tzCode' => 'Pacific/Auckland',
                ),
            244 =>
                array(
                    'offset' => '+13:00',
                    'label' => '(GMT+13:00) Enderbury',
                    'tzCode' => 'Pacific/Enderbury',
                ),
            245 =>
                array(
                    'offset' => '+13:00',
                    'label' => '(GMT+13:00) Fakaofo',
                    'tzCode' => 'Pacific/Fakaofo',
                ),
            246 =>
                array(
                    'offset' => '+13:00',
                    'label' => '(GMT+13:00) Fiji',
                    'tzCode' => 'Pacific/Fiji',
                ),
            247 =>
                array(
                    'offset' => '+13:00',
                    'label' => '(GMT+13:00) Tongatapu',
                    'tzCode' => 'Pacific/Tongatapu',
                ),
            248 =>
                array(
                    'offset' => '+14:00',
                    'label' => '(GMT+14:00) Apia',
                    'tzCode' => 'Pacific/Apia',
                ),
            249 =>
                array(
                    'offset' => '+14:00',
                    'label' => '(GMT+14:00) Kiritimati',
                    'tzCode' => 'Pacific/Kiritimati',
                ),
        );
    }
}
