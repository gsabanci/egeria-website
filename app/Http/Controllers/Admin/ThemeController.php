<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Theme;
use Illuminate\Http\Request;

class ThemeController extends Controller
{
    public function themeColorChange(Request $r)
    {
        $theme = Theme::where('id', 1)->first();
        $theme->status =  $theme->status == 1 ? 0 : 1;
        $theme->save();
        return response()->json(true, 200);
    }
}
