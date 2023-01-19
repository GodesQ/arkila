<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VendorApiAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $token = DB::table('vendor_api_tokens')->where('token', $request->header('token'))->orWhere('token', $request->token)->first();

        if(!$token) {
            return response()->json([
                'status' => 401,
                'message' =>  'Not Authorized'
            ]);
        }

        return $next($request);
    }

    public function generateVendorToken($user_id) {
        $token = openssl_random_pseudo_bytes(16);
        $final_token = bin2hex($token);
        $save_token = DB::table('vendor_api_tokens')->insert([
            'user_id' => $user_id,
            'token' => $final_token,
            'created_at' => date('Y-m-d'),
            'updated_at' => date('Y-m-d')
        ]);
        return $final_token;
    }

    public function removeVendorToken($token) {
        $token = DB::table('vendor_api_tokens')->where('token', $token)->delete();
        return $token;
    }
}