<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 18/11/2019
 * Time: 10:33
 */

namespace App\Http\Middleware;

use Illuminate\Auth\AuthenticationException;

class Authenticate extends \Illuminate\Auth\Middleware\Authenticate
{
    protected function authenticate(array $guards)
    {
        if (empty($guards)) {
            return $this->auth->authenticate();
        }

        foreach ($guards as $guard) {
            if ($this->auth->guard($guard)->check()) {
                return $this->auth->shouldUse($guard);
            }
        }

        $data = array(
            "status"            => false,
            "is_expired_token"  => true
        );
        
        throw new AuthenticationException(\GuzzleHttp\json_encode($data), $guards);
    }
}