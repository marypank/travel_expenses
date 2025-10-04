<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controller as RoutingController;

/**
 * @OA\Info(
 *     title="Travel expenses",
 *     version="1.0",
 * ),
 * @OA\PathItem(
 *     path="/api"
 * ),
 * @OA\Components(
 *     @OA\SecurityScheme(
 *         securityScheme="bearer_token",
 *         type="http",
 *         scheme="bearer"
 *     )
 * )
 */
abstract class Controller extends RoutingController
{
    use AuthorizesRequests;
}
