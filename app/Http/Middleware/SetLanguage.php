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

        $validLangs = Language::pluck('code')->toArray();
        $host = $request->getHost();

        $defaultLang = $this->getDefaultLangByHost($host, $validLangs);

        // domain bazlı session key
        $sessionKey = 'lang_' . md5($host);

        $lang = null;

        // 1) URL'de lang varsa onu kullanıyoruz
        if ($request->has('lang')) {
            $lang = $request->get('lang');

            if (!in_array($lang, $validLangs)) {
                $lang = $defaultLang;
            }

            Session::put($sessionKey, $lang);

            App::setLocale($lang);

            // sadece tr ise URL'den kaldırıyoruz SEO için
            if ($lang === 'tr') {
                $query = $request->query();
                unset($query['lang']);

                return redirect()->to(
                    $request->url() . (count($query) ? '?' . http_build_query($query) : '')
                );
            }

            return $next($request);
        }

        // 2) URL'de lang yoksa bazlı session'dan alıyoruz
        $lang = Session::get($sessionKey);

        if (!$lang || !in_array($lang, $validLangs)) {
            $lang = $defaultLang;
            Session::put($sessionKey, $lang);
        }

        App::setLocale($lang);

        // 3) tr değilse URL'de lang zorunlu olsun
        if ($lang !== 'tr') {
            $query = $request->query();
            $query['lang'] = $lang;

            return redirect()->to(
                $request->url() . '?' . http_build_query($query)
            );
        }

        return $next($request);
    }

    private function getDefaultLangByHost(string $host, array $validLangs): string
    {
        if (str_ends_with($host, '.bg')) {
            return in_array('bg', $validLangs) ? 'bg' : 'en';
        }

        if (str_ends_with($host, '.tr')) {
            return in_array('tr', $validLangs) ? 'tr' : 'en';
        }

        return in_array('en', $validLangs) ? 'en' : 'tr';
    }

}