<?php

namespace Softpyramid\Authorization\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Contracts\Auth\Factory as Auth;

class AuthorizeRequestMiddleware {
	public static $except = [
		'root',
		'home',
		'login',
		'logout',

	];

	/**
	 * The authentication factory instance.
	 *
	 * @var \Illuminate\Contracts\Auth\Factory
	 */
	protected $auth;

	/**
	 * The gate instance.
	 *
	 * @var \Illuminate\Contracts\Auth\Access\Gate
	 */
	protected $gate;

	/**
	 * Create a new middleware instance.
	 *
	 * @param  \Illuminate\Contracts\Auth\Factory $auth
	 * @param  \Illuminate\Contracts\Auth\Access\Gate $gate
	 * @return void
	 */
	public function __construct(Auth $auth, Gate $gate) {
		$this->auth = $auth;
		$this->gate = $gate;
	}

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \Closure $next
	 * @return mixed
	 */
	public function handle($request, Closure $next) {

		$route_name = request()->route()->getName();

		if ($this->auth->check() && $route_name != ''  && !in_array($route_name, $this::$except)) {
			$this->gate->authorize($route_name);
		}

		return $next($request);
	}
}
