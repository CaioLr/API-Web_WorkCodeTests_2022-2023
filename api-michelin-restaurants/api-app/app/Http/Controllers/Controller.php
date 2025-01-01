<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
/**
     * @OA\Info(
     *      version="1.0.0",
     *      title="API Michelin Restaurants",
     *      description="API para informações de restaurants que ganharam estralas Michelin",
     *      @OA\Contact(
     *          email="caioeduardodev@gmai.com"
     *      ),
     *      @OA\License(
     *          name="Apache 2.0",
     *          url="http://www.apache.org/licenses/LICENSE-2.0.html"
     *      )
     * )

     *
     * @OA\Server(
     *      url=L5_SWAGGER_CONST_HOST,
     * )

     *

     */
class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}
