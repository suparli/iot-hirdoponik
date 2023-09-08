<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Device;

class ApiKeyAuth
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
        $apiKey = $request->header('X-API-KEY'); // Ambil API key dari header
        $deviceId = $request->input('deviceId');
        $device= Device::where('id' , $deviceId)->first();
        
        if(!$device){
            return response()->json(['message' => 'Device id not found'], 401);
        }
        
        $apiKeyDb = $device->key;

        if ($apiKey !== $apiKeyDb) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        return $next($request);
    }
}
