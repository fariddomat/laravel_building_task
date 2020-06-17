<?php

namespace App\Http\Controllers;


use App\Buildings;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;


/**
 * @group Owner Building Controller
 * handle owners tasks
 */
class BuildingsController extends Controller
{


    /**
     * Display a listing of the buildings that belong to the owner.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * @OA\post(
     *   path="/api/owner/buildings/index",
     *   tags={"Owner buildings controller"},
     * 
     *   summary="display a listing of the buildings that belong to the owner.",
     *   operationId="getBuildings",
     * 
     *   @OA\Parameter(
     *      parameter="token",
     *      in="query",
     *      name="token",
     *      description="user token",
     *      @OA\Schema(
     *          type="string",
     *      )
     *   ),
     *   @OA\Response(response=200, description="successful operation"),
     *   @OA\Response(response=406, description="not acceptable"),
     *   @OA\Response(response=500, description="internal server error")
     * )
     *
     */
    public function index()
    {
        $buildings = Buildings::where('user_id', auth()->user()->id)->orderBy('id', 'desc')->get();
        return json_encode($buildings);
    }


    /**
     * Store a newly created builging in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string $city, $town, $type, $description
     * @param  double $price
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Post(
     *   path="/api/owner/buildings/store",
     *   tags={"Owner buildings controller"},
     *   summary="Store a newly created builging in storage",
     *   operationId="SearchBuildings",
     * 
     *   @OA\Parameter(
     *      parameter="token",
     *      in="query",
     *      name="token",
     *      description="user token",
     *      @OA\Schema(
     *          type="string",
     *      )
     *   ),
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
     *      parameter="price",
     *      in="query",
     *      name="price",
     *      description="price",
     *      @OA\Schema(
     *          type="double",
     *      )
     *   ),
     * 
     *   @OA\Parameter(
     *      parameter="description",
     *      in="query",
     *      name="description",
     *      description="description",
     *      @OA\Schema(
     *          type="string",
     *      )
     *   ),
     *   @OA\Response(response=200, description="successful operation"),
     *   @OA\Response(response=406, description="not acceptable"),
     *   @OA\Response(response=500, description="internal server error")
     * )
     *
     */
    public function store(Request $request)
    {



        if (auth()->user()->hasRole('owner')) {

            $this->validate($request, [
                'city' => 'required',
                'town' => 'required',
                'type' => 'required',
                'price' => 'required',
                'description' => 'required',
            ]);

            Buildings::create([
                'city' => request('city'),
                'town' => request('town'),
                'type' => request('type'),
                'price' => request('price'),
                'description' => request('description'),
                'user_id' => auth()->user()->id
            ]);

            return json_encode('Added successfully, waiting admin aprroval');
        } else {
            return json_encode("you do not have permission to do this");
        }
    }

    /**
     * Display the specified building.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\post(
     *   path="/api/owner/buildings/show/{id}",
     *   tags={"Owner buildings controller"},
     *   summary="Display the specified building.",
     *   operationId="show buildings",
     * 
     *   @OA\Parameter(
     *      parameter="token",
     *      in="query",
     *      name="token",
     *      description="user token",
     *      @OA\Schema(
     *          type="string",
     *      )
     *   ),
     *   @OA\Parameter(
     *      parameter="id",
     *      in="query",
     *      name="id",
     *      description="building id",
     *      @OA\Schema(
     *          type="integer",
     *      )
     *   ),
     *   @OA\Response(response=200, description="successful operation"),
     *   @OA\Response(response=406, description="not acceptable"),
     *   @OA\Response(response=500, description="internal server error")
     * )
     *
     */
    public function show($id)
    {
        //
        if (auth()->user()->hasRole('owner')) {

            $building = Buildings::find($id);
            return json_encode($building);
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @param  string $city, $town, $type, $description
     * @param  double $price
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Post(
     *   path="/api/owner/buildings/update/{id}",
     *   tags={"Owner buildings controller"},
     *   summary="Update the specified building in storage",
     *   operationId="update buildinsg",
     * 
     * 
     *   @OA\Parameter(
     *      parameter="token",
     *      in="query",
     *      name="token",
     *      description="user token",
     *      @OA\Schema(
     *          type="string",
     *      )
     *   ),
     *   @OA\Parameter(
     *      parameter="id",
     *      in="query",
     *      name="id",
     *      description="building id",
     *      @OA\Schema(
     *          type="integer",
     *      )
     *   ),
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
     *      parameter="price",
     *      in="query",
     *      name="price",
     *      description="price",
     *      @OA\Schema(
     *          type="double",
     *      )
     *   ),
     * 
     *   @OA\Parameter(
     *      parameter="description",
     *      in="query",
     *      name="description",
     *      description="description",
     *      @OA\Schema(
     *          type="string",
     *      )
     *   ),
     *   @OA\Response(response=200, description="successful operation"),
     *   @OA\Response(response=406, description="not acceptable"),
     *   @OA\Response(response=500, description="internal server error")
     * )
     *
     */
    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'city' => 'required',
            'town' => 'required',
            'type' => 'required',
            'price' => 'required',
            'description' => 'required',
        ]);

        if (auth()->user()->hasRole('owner')) {
            $building = Buildings::find($id);
            $building->update(request()->all());
            return json_encode('Updated successfuly');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\post(
     *   path="/api/owner/buildings/destroy/{id}",
     *   tags={"Owner buildings controller"},
     *   summary="Remove the specified building.",
     *   operationId="remove building",
     * 
     *   @OA\Parameter(
     *      parameter="token",
     *      in="query",
     *      name="token",
     *      description="user token",
     *      @OA\Schema(
     *          type="string",
     *      )
     *   ),
     *   @OA\Parameter(
     *      parameter="id",
     *      in="query",
     *      name="id",
     *      description="building id",
     *      @OA\Schema(
     *          type="integer",
     *      )
     *   ),
     *   @OA\Response(response=200, description="successful operation"),
     *   @OA\Response(response=406, description="not acceptable"),
     *   @OA\Response(response=500, description="internal server error")
     * )
     *
     */
    public function destroy($id)
    {
        $building = Buildings::find($id);
        if (auth()->user()->id == $building->user_id) {

            $building->delete();

            return json_encode('deleted successfuly');
        }
    }
}
