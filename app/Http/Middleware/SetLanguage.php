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

        $validLangs = Language::pluck('code')->toArray(); // ['tr', 'en', ...]

        if ($request->has('lang')) {
            $lang = $request->get('lang');

            if (!in_array($lang, $validLangs)) {
                $lang = 'tr';
            }

            App::setLocale($lang);
            Session::put('lang', $lang);

            // Eğer seçilen dil Türkçeyse, lang parametresini URL'den kaldır
            if ($lang === 'tr') {
                $currentUrl = $request->url(); // sadece domain + path
                $query = $request->query();
                unset($query['lang']);
                return redirect()->to($currentUrl . (count($query) ? '?' . http_build_query($query) : ''));
            }
        } else {
            // lang parametresi yoksa session'dan al
            $lang = Session::get('lang', 'tr');

            if (!in_array($lang, $validLangs)) {
                $lang = 'tr';
            }

            App::setLocale($lang);

            // Eğer dil tr değilse ve URL'de lang yoksa, lang ekle
            if ($lang !== 'tr') {
                $currentUrl = $request->url();
                $query = array_merge($request->query(), ['lang' => $lang]);
                return redirect()->to($currentUrl . '?' . http_build_query($query));
            }
        }

        return $next($request);
    }

}