<?php

namespace App\Http\Controllers\Api;

use App\Constant\Constant;
use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class LoginController extends Controller
{
    /**
     * @param Request $request
     *
     * @return JsonResource
     */
    public function login(Request $request): JsonResponse
    {
        try {
            $validateUser = Validator::make($request->all(),
            [
                'email' => 'required|email',
                'password' => 'required'
            ]);

            if($validateUser->fails()){
                return response()->json([
                    'status' => Constant::STATUS_FALSE,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], Response::HTTP_UNAUTHORIZED);
            }

            if(!Auth::attempt($request->only(['email', 'password']))){
                return response()->json([
                    'status' => Constant::STATUS_FALSE,
                    'message' => 'Email & Password does not match with our record.',
                ], Response::HTTP_UNAUTHORIZED);
            }

            $user = User::where('email', $request->email)->first();

            $abilities = ['get-details', 'verified-at'];
            // $abilities = ['verified-at'];
            $tokenResult = $user->createToken("API TOKEN", $abilities);
            return response()->json([
                'status' => Constant::STATUS_TRUE,
                'message' => 'User Logged In Successfully',
                'token' => $tokenResult->accessToken,
                'abilities' => $abilities,
                'expires_at' => Carbon::parse(
                    $tokenResult->token->expires_at
                 )->toDateTimeString()
            ], Response::HTTP_OK);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => Constant::STATUS_FALSE,
                'message' => $th->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    /**
     * Log the user out of the application.
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function logout(): JsonResponse
    {
        try {
            $user = request()->user();
            $user->currentAccessToken()->delete();

            return response()->json([
                'status' => Constant::STATUS_TRUE,
                'message' =>  'User Loggout Successfully',
            ], Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => Constant::STATUS_FALSE,
                'message' => $th->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    /**
     * Log the user out of the all device.
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function logoutFromAllOtherDevice(): JsonResponse
    {
        try {
            $user = request()->user();
            $user->tokens()->where('id','!=', $user->currentAccessToken()->id)->delete();
            
            return response()->json([
                'status' => Constant::STATUS_TRUE,
                'message' => 'Logout from all other device is successfully',
            ], Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => Constant::STATUS_FALSE,
                'message' => $th->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
