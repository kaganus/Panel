<?php

namespace Pterodactyl\Http\Controllers\Base;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Cache;
use Pterodactyl\Http\Controllers\Controller;
use Illuminate\Contracts\Config\Repository as ConfigRepository;

class LanguageController extends Controller
{

    /**
     * @var \Illuminate\Contracts\Config\Repository
     */
    protected $config;

    /**
     * LanguageController constructor.
     *
     * @param \Illuminate\Contracts\Config\Repository                      $config
     */
    public function __construct(
        ConfigRepository $config
    ) {
        $this->config = $config;
    }

    /**
     * Returns JavaScript translation strings
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function getTranslation(Request $request, string $lang)
    {
        $fallback_file = resource_path('lang/' . $this->config->get('app.fallback_locale') . '/js.php');
        $file = resource_path('lang/' . $lang . '/js.php');
        
        $strings = Cache::remember('lang/' . $lang . '.js', 60, function () use ($fallback_file, $file, $lang) {
            $strings = [];
            if ($lang != $this->config->get('app.fallback_locale')) {
                $strings['js'] = array_replace_recursive(require $fallback_file, require $file);
            } else {
                $strings['js'] = require $file;
            }

            return $strings;
        });
        
        return Response::make('window.i18n = ' . json_encode($strings) . ';', 200)
            ->header('Content-Type', 'application/javascript');
    }
}
