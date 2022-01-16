<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use Jackiedo\DotenvEditor\Facades\DotenvEditor;

class SettingsController extends Controller
{
    private array $allowedToggles = [
        "TOURNEY_SIGNUPS",
        "FORCE_LOCK",
        "DISCORD_BOT"
    ];

    public function page()
    {
        $pageData[] = "";
        $pageData['seo']['title'] = "Settings";

        return view('admin/settings/settings', $pageData);
    }

    public function toggleBoolean($key)
    {
        if(!in_array($key, $this->allowedToggles)) return back();

        DotenvEditor::autoBackup(false);
        $value = DotenvEditor::getKeys([$key]);
        $value = filter_var($value[$key]['value'], FILTER_VALIDATE_BOOLEAN);

        // Convert to string due to DotenvEditor bug
        if(!$value) $value = "true";
        else $value = "false";

        DotenvEditor::setKey($key, $value)->save();

        // Reset app cache
        \Artisan::call('config:clear');

        return back();
    }
}
