<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ChangePasswordFirstTime
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->password_updated_at !== null) {
            // Arahkan pengguna berdasarkan role
            return redirect($this->getRedirectUrl(Auth::user()->role))
                ->withErrors(['error' => 'Password already updated for the first time!']);
        }

        return $next($request);
    }

    private function getRedirectUrl(string $role): string
    {
        return match ($role) {
            'admin' => route('admin.dashboard.index'),
            'head' => route('head.dashboard.index'),
            'technician' => route('technician.dashboard.index'),
        };
    }
}
