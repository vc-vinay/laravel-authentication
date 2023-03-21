<?php

namespace App\Http\Controllers\Api\Auth;

use App\Constant\Constant;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;
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
            $validateUser = Validator::make(
                $request->all(),
                [
                    'email' => 'required|email',
                    'password' => 'required'
                ]
            );

            if ($validateUser->fails()) {
                return response()->json([
                    'status' => Constant::STATUS_FALSE,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], Response::HTTP_UNAUTHORIZED);
            }

            if (!Auth::attempt($request->only(['email', 'password']))) {
                return response()->json([
                    'status' => Constant::STATUS_FALSE,
                    'message' => 'Email & Password does not match with our record.',
                ], Response::HTTP_UNAUTHORIZED);
            }
            
            $user = User::where('email', $request->email)->first();

            $abilities = ['get-details', 'verified-at'];
            $abilities = ['verified-at'];

            return response()->json([
                'status' => Constant::STATUS_TRUE,
                'message' => 'User Logged In Successfully',
                'token' => $user->createToken("API TOKEN", $abilities)->plainTextToken,
                'abilities' => $abilities,
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
            $user->tokens()->where('id', '!=', $user->currentAccessToken()->id)->delete();
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
