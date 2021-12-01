<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Http\Requests\SignUpRequest;
use Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Manager;



class AuthController extends Controller
{
    //

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct(JWTAuth $jwt, Manager $manager)
    {

        $this->middleware('auth:api', ['except' => ['login', 'signup' , 'isValidToken']]);
        // $this->middleware('jwt.refresh', ['except' => ['refresh' ,'isValidToken' ]]);
        $this->jwt = $jwt;
        $this->manager = $manager;
      
    }
    protected $jwt;

    /**
     * @var Manager
     */
    protected $manager;

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth()->claims(['isAdmin'=> 'false'])->attempt($credentials)) {
            return response()->json(['error' => "Email or Pssword doesn't exist"], 401);
        }

        return $this->respondWithToken($token);
        
    }

    public function signup(SignUpRequest $request)
    {
        $user= User::create($request->all());
        return $this->login($user);
    }


    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me(Request $request)
    {
        // $user = JWTAuth::toUser(JWTAuth::getToken());
        $userData =
        [
            'user' =>  auth()->user() ,
            'payload' => auth()->payload()
        ];
        return $userData ;

    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());


        // try {

        //     return $this->json([
        //         'token' => $this->manager->refresh($this->jwt->getToken())->get()
        //     ]);

        // } catch (JWTException $e) {
        //     return $this->json($e->getMessage(), 500);
        // }
    }

    public function isValidToken(Request $request)
    {
        try 
        {
            if(JWTAuth::parseToken()->authenticate());
        } 
        catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e)
        {
  
          // do whatever you want to do if a token is expired

          $current_token  = JWTAuth::getToken();
        //   return auth()->refresh();
        //   return ($current_token);
        //   $token          = JWTAuth::refresh($current_token);
        // $newToken = $this->auth()->parseToken()->refresh();

            // return "expired" ;
            // dd($test);

          return $this->respondWithToken(auth()->refresh());
  
        }
        catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e)
        {
  
          // do whatever you want to do if a token is invalid
          return "invalid";
  
        }
        catch (\Tymon\JWTAuth\Exceptions\JWTException $e)
        {

            return "not present";
          // do whatever you want to do if a token is not present
        }
        // return response()->json(auth()->check());
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
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => auth()->user()->name
        ]);
    }
}
