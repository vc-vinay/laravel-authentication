<?php

namespace App\Http\Controllers\Api;

use App\Constant\Constant;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getDetails(Request $request)
    {
        $this->authorize('getDetails', $request->user());
        return $request->user();
    }

    /**
     * Display a listing of the resource.
     */
    public function checkStatus(Request $request)
    {
        $this->authorize('checkStatus', $request->user());
        return Constant::STATUS_TRUE;
    }
}
