<?php

namespace Whitecube\LaravelCookieConsent\Http\Controllers;

use Illuminate\Http\Request;

class ScriptController
{
    public function __invoke(Request $request)
    {
        $content = str_replace('{config}', $this->generateConfig(), file_get_contents(LCC_ROOT . '/dist/cookies.js'));

        return response($content)->header('Content-Type', 'application/javascript');
    }

    protected function generateConfig(): string
    {
        return '{'
            . '"accept.all": "' . route('cookieconsent.accept.all') . '",'
            . '"accept.essentials": "' . route('cookieconsent.accept.essentials') . '",'
            . '"accept.configuration": "' . route('cookieconsent.accept.configuration') . '",'
            . '"reset": "' . route('cookieconsent.reset') . '",'
            . '"more": "' . __('cookieConsent::cookies.details.more') . '",'
            . '"less": "' . __('cookieConsent::cookies.details.less') . '"'
            . '}';
    }
}
