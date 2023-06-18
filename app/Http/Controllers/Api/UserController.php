<?php

namespace App\Http\Controllers\Api;

use App\Constant\Constant;
use App\Http\Controllers\Controller;
use App\QueryFilters\Active;
use App\Http\Resources\UserCollection;
use App\Models\User;
use App\QueryFilters\Sort;
use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;

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

    public function getUsers()
    {
        $users = app(Pipeline::class)
            ->send(User::query())
            ->through([
                Active::class,
                Sort::class,
            ])
            ->thenReturn()
            ->paginate(5);

        return (new UserCollection($users))->additional([
            'status' => true,
            'message' => 'Users fetched successfully'
        ]);
    }
}
