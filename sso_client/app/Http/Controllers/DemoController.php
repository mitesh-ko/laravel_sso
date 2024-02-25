<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use JetBrains\PhpStorm\NoReturn;

class DemoController extends Controller
{

    public function redirectTo()
    {
        $queries = http_build_query([
            'client_id' => '4',
            'redirect_uri' => 'http://sso.client:8000/sso/callback',
            'response_type' => 'code'
        ]);
        return redirect('http://sso.server:8001/oauth/authorize?'. $queries);
    }

    /**
     * @param Request $request
     * @return void
     */
    #[NoReturn] public function callback(Request $request)
    {
        $response = \Http::asForm()->post('http://sso.server:8001/oauth/token', [
            'grant_type' => 'authorization_code',
            'client_id' => '4',
            'client_secret' => 'WdTa0MEZVxnauvCZPxoJSe8Z7dm0i9WXzT9fIkLG',
            'redirect_uri' => 'http://sso.client:8000/sso/callback',
            'code' => $request->code
        ]);

        dd($response->json());
    }
}
