<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Validator;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;

class JWTAuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['login']);
        // $this->middleware('log')->only(['login', 'store', 'update']);
    }

    /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|min:8|max:255',
            'username' => 'required|min:3|max:20|unique:users',
            'roles' => 'required',
            'password' => 'required|min:4'
        ];

        $request->validate($rules);
        $user = new User;
        $user->name = $request->input('name');
        $user->username = $request->input('username');
        $user->roles = $request->input('roles');
        $user->password = bcrypt($request->input('password'));
        $user->save();

        return response()->json(["status" => "success", "data" => $user]);
    }

    public function update(Request $request, User $users)
    {
        $user = $users::find($request->id);
        $password_reset = $request->password_reset;
        $username_changed = $user->username === $request->username ? false : true;

        $rules = [
            'name' => 'required|min:8|max:255',
            'username' => 'required|min:3|max:20',
            'roles' => 'required',
        ];

        if ($password_reset) {
            $rules['password'] = 'required|min:4';
        }

        if ($username_changed) {
            $rules['username'] = 'required|min:3|max:20|unique:users';
        }

        $request->validate($rules);
        $user->name = $request->name;
        $username_changed ? $user->username = $request->username : null;
        $user->roles = $request->roles;
        $password_reset ? $user->password = bcrypt($request->password) : null;
        $user->save();
        return response()->json(["status" => "success", "data" => $user]);
    }



    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');
        if ($token = $this->guard()->attempt($credentials)) {
            return response()->json(['status' => 'success'], 200)->header('Authorization', $token);
        }
        return response()->json(["status" => "Invalid credentials", 'errors' => ['username' => 'Invalid Credentials', 'password' => 'Invalid Credentials']], 401);
        // return response()->json(["status" => "Invalid credentials", 'errors' => $request->all()], 401);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function profile()
    {
        $user = auth()->user();
        return response()->json(["status" => "success", "data" => $user], 200);
    }

    public function get_user($id)
    {
        $user = User::find($id);
        return response()->json(["status" => "success", "data" => $user], 200);
    }   

    public function users()
    {
        $users = User::all();
        return response()->json(["status" => "success", "data" => $users], 200);
    }
    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out'], 200);
    }

    public function change_password(Request $request)
    {
        //password hash check
        $status = array(
            "success" => false,
            "confirmed" => false,
            "validated" => false,
            "message" => ""
        );
        
        // confirm current password
        $match = Hash::check($request->currentPassword,Auth::user()->getAuthPassword());
        if (!$match) 
        {
            $status = array(
                "success" => false,
                "confirmed" => false,
                "validated" => false,
                "message" => "Invalid Password!"
            );
            return response()->json($status);
        }

        // validate new password
        if (empty($request->newPassword)) {
            $status = array(
                "success" => false,
                "confirmed" => true,
                "validated" => false,
                "message" => "Please enter a password!"
            );
            return response()->json($status);
        }


        $request->user()->fill([
            'password' => Hash::make($request->newPassword)
        ])->save();

        $status = array(
            "success" => true,
            "confirmed" => true,
            "validated" => true,
            "message" => "Change successful!"
        );

        return response()->json($status);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        // return $this->createNewToken(auth()->refresh());
        if ($token = $this->guard()->refresh()) {
            return response()
                ->json(['status' => 'successs'], 200)
                ->header('Authorization', $token);
        }
        return response()->json(['error' => 'refresh_token_error'], 401);
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    // protected function createNewToken($token)
    // {
    //     return response()->json([
    //         'access_token' => $token,
    //         'token_type' => 'bearer',
    //         'expires_in' => auth()->factory()->getTTL() * 60
    //     ]);
    // }


    /**
     * Return auth guard
     */
    private function guard()
    {
        return Auth::guard();
    }
}
