<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function seedDebugNonce(string ...$data): string
    {
        $data = implode(':', collect($data)->map(function ($seed) {
            try {
                return str($seed);
            } catch (\Throwable $th) {
                return '';
            }
        })->toArray());
        $hash = hash('sha256', $data);
        session(['debug_nonce' => $hash]);

        return $hash;
    }
}
