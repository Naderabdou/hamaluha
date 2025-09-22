<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckWebType
{
    /**
     * Handle an incoming request.
     *
     * @param  mixed  ...$roles  // قائمة الأدوار المسموح بها
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$type)
    {
        $user = auth()->user();

        if (! $user) {
            return redirect()->route('site.home')->with('error', __('You are not authorized to access this page'));
        }

        if (! in_array(needle: $user->type, haystack: $type)) {
            return redirect()->route('site.home')->with('error', __('You are not authorized to access this page'));

        }

        return $next($request);
    }
}
