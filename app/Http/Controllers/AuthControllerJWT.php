<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Hash;


use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

/**
 * @group JWT Auth controller
 * handle login, register, logout and me
 */

class AuthControllerJWT extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    /**
     * Get a JWT token via given credentials.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param $email,$password
     * @return \Illuminate\Http\JsonResponse
     * @return $token
     */
    /**
     * @OA\Post(
     *   path="/api/auth/login",
     *   tags={"Auth"},
     *   summary="JWT login",
     *   description="Login a user and generate JWT token",
     *   operationId="jwtLogin",
     *   @OA\RequestBody(
     *       required=true,
     *       @OA\MediaType(
     *           mediaType="application/json",
     *           @OA\Schema(
     *               type="object",
     *               @OA\Property(
     *                   property="email",
     *                   description="User email",
     *                   type="string",
     *                   example="ihamzehald@gmail.com"
     *               ),
     *               @OA\Property(
     *                   property="password",
     *                   description="User password",
     *                   type="string",
     *                   example="larapoints123"
     *               ),
     *           )
     *       )
     *   ),
     *  @OA\Response(
     *         response="200",
     *         description="ok",
     *         content={
     *             @OA\MediaType(
     *                 mediaType="application/json",
     *                 @OA\Schema(
     *                     @OA\Property(
     *                         property="access_token",
     *                         type="string",
     *                         description="JWT access token"
     *                     ),
     *                     @OA\Property(
     *                         property="token_type",
     *                         type="string",
     *                         description="Token type"
     *                     ),
     *                     @OA\Property(
     *                         property="expires_in",
     *                         type="integer",
     *                         description="Token expiration in miliseconds",
     *                         @OA\Items
     *                     ),
     *                     example={
     *                         "access_token": "eyJ0eXAiOiJKV1QiLCJhbGc...",
     *                         "token_type": "bearer",
     *                         "expires_in": 3600
     *                     }
     *                 )
     *             )
     *         }
     *     ),
     *   @OA\Response(response="401",description="Unauthorized"),
     * )
     */


    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if ($token = $this->guard()->attempt($credentials)) {
            return $this->respondWithToken($token);
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }

    /**
     * Create a JWT token via given credentials.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param $name,$email,$password
     * @return \Illuminate\Http\JsonResponse
     * @return $token
     */
    /**
 * @OA\Post(
 *   path="/api/auth/register",
 *   tags={"Auth"},
 *   summary="JWT Register",
 *   description="register a user and generate JWT token",
 *   operationId="jwtLogin",
 *   @OA\RequestBody(
 *       required=true,
 *       @OA\MediaType(
 *           mediaType="application/json",
 *           @OA\Schema(
 *               type="object",
 *              @OA\Property(
 *                   property="name",
 *                   description="User name",
 *                   type="string",
 *                   example="username"
 *               ),
 *               @OA\Property(
 *                   property="email",
 *                   description="User email",
 *                   type="string",
 *                   example="ihamzehald@gmail.com"
 *               ),
 *               @OA\Property(
 *                   property="password",
 *                   description="User password",
 *                   type="string",
 *                   example="larapoints123"
 *               ),
 *           )
 *       )
 *   ),
 *  @OA\Response(
 *         response="200",
 *         description="ok",
 *         content={
 *             @OA\MediaType(
 *                 mediaType="application/json",
 *                 @OA\Schema(
 *                     @OA\Property(
 *                         property="access_token",
 *                         type="string",
 *                         description="JWT access token"
 *                     ),
 *                     @OA\Property(
 *                         property="token_type",
 *                         type="string",
 *                         description="Token type"
 *                     ),
 *                     @OA\Property(
 *                         property="expires_in",
 *                         type="integer",
 *                         description="Token expiration in miliseconds",
 *                         @OA\Items
 *                     ),
 *                     example={
 *                         "access_token": "eyJ0eXAiOiJKV1QiLCJhbGc...",
 *                         "token_type": "bearer",
 *                         "expires_in": 3600
 *                     }
 *                 )
 *             )
 *         }
 *     ),
 *   @OA\Response(response="401",description="Unauthorized"),
 * )
 */


    public function register(Request $request)
    {

        // dd(request('name'));
        $user = User::create([
            'name' => request('name'),
            'email' => request('email'),
            'password' => Hash::make(request('password')),

        ]);

        $role = Role::findByName('customer');
        $user->assignRole($role);

        return $this->login(request());
    }

    /**
     * Get the authenticated User
     *
     * @return \Illuminate\Http\JsonResponse
     */
    /**
     * @OA\post(
     *   path="/api/auth/me",
     *   tags={"Auth"},
     *   summary=" Get the authenticated User",
     *   operationId="Get the authenticated User",
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
    public function me()
    {
        return response()->json($this->guard()->user());
    }

    /**
     * Log the user out (Invalidate the token)
     *
     * @return \Illuminate\Http\JsonResponse
     */
    /**
     * @OA\post(
     *   path="/api/auth/logout",
     *   tags={"Auth"},
     *   summary=" Logout the authenticated User",
     *   operationId="Logout the authenticated User",
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
    public function logout()
    {
        $this->guard()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken($this->guard()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $this->guard()->factory()->getTTL() * 60,
            'user' => auth()->user(),
            'roles' => auth()->user()->getRoleNames()
        ]);
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\Guard
     */
    public function guard()
    {
        return Auth::guard();
    }
}
