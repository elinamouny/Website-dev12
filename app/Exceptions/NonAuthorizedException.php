<?php

namespace App\Exceptions;

use App\MyStaff\ResponseHelper;
use Exception;
use Illuminate\Http\Request;

class NonAuthorizedException extends Exception
{
    /**
     * This method specify how the excemption should be rendered in the client's view
     */
    public function render(Request $request)
    {
        return ResponseHelper::json([
            'error' => trans('You are not authorized to access this resource.')
        ], 401);
    }
}
