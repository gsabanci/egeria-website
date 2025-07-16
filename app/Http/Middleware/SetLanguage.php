<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use App\Models\Language;

class SetLanguage
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->is('admin/*')) {
            return $next($request);
        }

        // 1) Desteklenen dil kodlarını al
        $validLangs = Language::pluck('code')->toArray(); // ['tr','en',...]

        // 2) Eğer URL’de lang parametresi varsa, onu al ve valide et
        if ($request->has('lang')) {
            $lang = $request->get('lang');
            if (!in_array($lang, $validLangs)) {
                $lang = 'tr';
            }
            App::setLocale($lang);
            Session::put('lang', $lang);
        }
        // 3) URL’de lang parametresi yoksa, session’daki değeri kullan ve redirect et
        else {
            $lang = Session::get('lang', 'tr');
            // Eğer session’dan gelen dil desteklenmiyorsa default’a düş
            if (!in_array($lang, $validLangs)) {
                $lang = 'tr';
            }
            // Şu anki URL’e lang parametresini ekle ve yönlendir
            $currentUrl = $request->url();
            $query = array_merge($request->query(), ['lang' => $lang]);
            return redirect()->to($currentUrl . '?' . http_build_query($query));
        }

        // 4) Devam et
        return $next($request);
    }

}