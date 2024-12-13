<?php

namespace App\Http\Middleware;

use App\Models\TaskLog;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class LogTaskAction
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        // return $next($request);
        $response = $next($request);
        

        // Check if the request is related to task actions (create, update, delete)
        if ($request->isMethod('post')) {
            // Logging task creation
            TaskLog::create([
                'user_id' => Auth::id(),
                'action' => 'create',
                'endpoint' => $request->url(),
                'timestamp' => now(),
            ]);
        } elseif ($request->isMethod('put') ) {
            // Logging task update
            TaskLog::create([
                'user_id' => Auth::id(),
                'action' => 'update',
                'endpoint' => $request->url(),
                'timestamp' => now(),
            ]);
        } elseif ($request->isMethod('delete')) {
            // Logging task deletion
            TaskLog::create([
                'user_id' => Auth::id(),
                'action' => 'delete',
                'endpoint' => $request->url(),
                'timestamp' => now(),
            ]);
        }
        return $response;
    }
}
