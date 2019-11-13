<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
/**
 * @SWG\Swagger(
 *   @SWG\Info(
 *     title="Site Title",
 *     version="1.0",
 *     description="Site description",
 *     @SWG\Contact(
 *         email="xyz@xyz.com"
 *     )
 *   )
 * )
 */
class Controller extends BaseController
{
    const DEFAULT_PAGE_SIZE = 10;
    const ORDER_BY_ASC  = 'ASC';
    const ORDER_BY_DESC = 'DESC';
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
