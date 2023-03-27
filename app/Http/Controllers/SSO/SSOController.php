<?php

namespace App\Http\Controllers\SSO;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class SSOController extends Controller
{
    public function getLogin(Request $request)
    {
        $request->session()->put('state', $state = Str::random(40));

        $query = http_build_query([
            'client_id' => '98c6c306-ce40-4fb5-8a9d-4119aa264c01',
            'redirect_uri' => 'http://laravel-auth.test/auth/callback',
            'response_type' => 'code',
            'scope' => '*',
            'state' => $state,
            // 'prompt' => '', // "none", "consent", or "login"
        ]);

        return redirect('http://laravel-auth.test/oauth/authorize?' . $query);
    }

    public function getCallback(Request $request)
    {
        $state = $request->session()->pull('state');

        throw_unless(
            strlen($state) > 0 && $state === $request->state,
            InvalidArgumentException::class
        );

        $response = Http::asForm()->post('http://laravel-auth.test/oauth/token', [
            'grant_type' => 'authorization_code',
            'client_id' => '98c6c306-ce40-4fb5-8a9d-4119aa264c01',
            'client_secret' => 'p2OcnunG7LaNbEc26jaf7IlO44I84cM8ZbWMAuY6',
            'redirect_uri' => 'http://laravel-auth.test/auth/callback',
            'code' => $request->code,
        ]);

        $request->session()->put($response->json());

        return to_route('sso.connect');
    }

    public function getUser(Request $request)
    {
        $accessToken = $request->session()->get('access_token');

        $response = Http::withHeaders([
            "Accept" => "application/json",
            "Authorization" => "Bearer " . $accessToken
        ])->get("http://laravel-auth.test/api/v1/user");

        return $response->json();
    }
}
