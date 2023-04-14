<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum AlertType: int
{
    use EnumToArray;

    case Primary = 0;
    case Secondary = 1;
    case Success = 2;
    case Danger = 3;
    case Warning = 4;
    case Info = 5;
    case Light = 6;
    case Dark = 7;

    public function name(): string
    {
        return match ($this) {
            self::Primary => 'Primary',
            self::Secondary => 'Secondary',
            self::Success => 'Success',
            self::Danger => 'Danger',
            self::Warning => 'Warning',
            self::Info => 'Info',
            self::Light => 'Light',
            self::Dark => 'Dark',
        };
    }

    public function style(): string
    {
        return match ($this) {
            self::Primary => 'alert-primary',
            self::Secondary => 'alert-secondary',
            self::Success => 'alert-success',
            self::Danger => 'alert-danger',
            self::Warning => 'alert-warning',
            self::Info => 'alert-info',
            self::Light => 'alert-light',
            self::Dark => 'alert-dark',
        };
    }
}
