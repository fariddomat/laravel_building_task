<?php

namespace App\Http\Controllers;

use App\Buildings;
use App\User;
use Illuminate\Http\Request;

use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

/**
 * @group Admin controller
 * 
 * approve or un_approve buildings
 * mark user as Owners
 */
class AdminController extends Controller
{

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        

    }

    /**
     * show all buildings that added in the  storage
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\post(
     *   path="/api/admin/index",
     *   tags={"Admin controller"},
     *   summary="show all buildings that added in the  storage.",
     *   operationId="show buildings",
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
        
        if (auth()->user()->hasRole('admin') != null) {
        $buildings = Buildings::all();
        return json_encode($buildings);
    }else{
        return json_encode('you do not have access');
    }
    }

    /**
     * approve building.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     /**
     * @OA\post(
     *   path="/api/admin/approve/{id}",
     *   tags={"Admin controller"},
     *   summary="approve building.",
     *   operationId="approve building",
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
    public function approve($id)
    {
        if (auth()->user()->hasRole('admin')) {
            $building = Buildings::find($id);
            $building->update([
                'approverd' => 1
            ]);
            return json_encode('approved successfuly');
        }else{
            return json_encode('you do not have access');
        }
    }

    /**
     * un approve building.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
/**
     * @OA\post(
     *   path="/api/admin/un_approve/{id}",
     *   tags={"Admin controller"},
     *   summary="un approve building.",
     *   operationId="un approve building",
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
    public function un_approve($id)
    {
        if (auth()->user()->hasRole('admin')) {
            $building = Buildings::find($id);
            $building->update([
                'approverd' => 0
            ]);
            return json_encode('un approved successfuly');
        }else{
            return json_encode('you do not have access');
        }
    }

    /**
     * Make a customer as Owner.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     /**
     * @OA\post(
     *   path="/api/admin/makeOwner/{id}",
     *   tags={"Admin controller"},
     *   summary="Make a customer as Owner.",
     *   operationId="make owner",
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
     *      description="user id",
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
    public function makeOwner($id)
    {
        if (auth()->user()->hasRole('admin')) {
            $user = User::find($id);
            $role = Role::findByName('owner');
            $user->syncRoles($role);
            return json_encode('user mark as owner successfully');
        }else{
            return json_encode('you do not have access');
        }
    }
    /**
     * remove privellage from Owner.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
     /**
     * @OA\post(
     *   path="/api/admin/unMakeOwner/{id}",
     *   tags={"Admin controller"},
     *   summary="remove privellage from Owner.",
     *   operationId="un make owner",
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
     *      description="user id",
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
    public function unMakeOwner($id)
    {
        if (auth()->user()->hasRole('admin')) {
            $user = User::find($id);
            $role = Role::findByName('customer');
            $user->syncRoles($role);
            return json_encode('user un mark as owner successfully');
        }else{
            return json_encode('you do not have access');
        }
    }
}
