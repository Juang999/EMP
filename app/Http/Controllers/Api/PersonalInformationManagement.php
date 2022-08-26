<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PersonalInformationManagementRequest;
use Illuminate\Http\Request;

class PersonalInformationManagement extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(PersonalInformationManagementRequest $PIMRequest)
    {
        try {
            
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
