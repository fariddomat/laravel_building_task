<?php

namespace App\Http\Controllers;

use App\Buildings;
use Illuminate\Http\Request;

/**
 * @OA\Swagger(
 *   basePath="/Buildings-api",
 * )
 */
class HomeController extends Controller
{
    /**
     * Get last 6 buildings from storage.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * @OA\Get(
     *   path="/api/index",
     *   tags={"Home"},
     * 
     *   summary="Get last 6 buildings from storage.",
     *   operationId="getBuildings",
     *   @OA\Response(response=200, description="successful operation"),
     *   @OA\Response(response=406, description="not acceptable"),
     *   @OA\Response(response=500, description="internal server error")
     * )
     *
     */
    public function index()
    {
        $buildings = Buildings::where('approverd', true)
            ->orderBy('id', 'desc')
            ->take(6)
            ->get();
        return json_encode($buildings);
    }

    /**
     * Search buildings.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $city,$town,$type
     * @param  double $price
     * @return \Illuminate\Http\Response
     */

    /**
     * @OA\Post(
     *   path="/api/search",
     *   tags={"Home"},
     * 
     *   summary="Search buildings",
     *   operationId="SearchBuildings",
     *   @OA\Parameter(
     *      parameter="city",
     *      in="query",
     *      name="city",
     *      description="The city name",
     *      @OA\Schema(
     *          type="string",
     *      )
     *   ),
     *   @OA\Parameter(
     *      parameter="town",
     *      in="query",
     *      name="town",
     *      description="The town name",
     *      @OA\Schema(
     *          type="string",
     *      )
     *   ),
     *   @OA\Parameter(
     *      parameter="type",
     *      in="query",
     *      name="type",
     *      description="The type",
     *      @OA\Schema(
     *          type="string",
     *      )
     *   ),
     *   @OA\Parameter(
     *      parameter="max_price",
     *      in="query",
     *      name="max_price",
     *      description="max price",
     *      @OA\Schema(
     *          type="double",
     *      )
     *   ),
     * 
     *   @OA\Parameter(
     *      parameter="min_price",
     *      in="query",
     *      name="min_price",
     *      description="min price",
     *      @OA\Schema(
     *          type="double",
     *      )
     *   ),
     *   @OA\Response(response=200, description="successful operation"),
     *   @OA\Response(response=406, description="not acceptable"),
     *   @OA\Response(response=500, description="internal server error")
     * )
     *
     */
    public function search(Request $request)
    {

        $buildings = Buildings::where('approverd', true)
            ->where('city', 'like', '%' . $request->city . '%')
            ->where('town', 'like', '%' . $request->town . '%')
            ->where('type', 'like', '%' . $request->type . '%')
            ->whereBetween('price', [$request->min_price, $request->max_price])
            ->get();

        if ($buildings->count() > 0) {
            return json_encode($buildings);
        } else {
            return json_encode('No recorde match search');
        }
    }
}
