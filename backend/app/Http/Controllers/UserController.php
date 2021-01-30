<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\ResponseService;
use App\Transformers\User\UserResource;
use App\Transformers\User\UserResourceCollection;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this->rules($request));

        if ($validator->fails()) {
            return response()->json('Deu erro meu bom', 500);
        }
        User::create($request->all());
        $response = [
            'message' => "DEubom meu bom",
            'data'    => []
        ];

        return response()->json($response, 200);
    }
    private function rules(Request $request, $primaryKey = null, bool $changeMessages = false)
    {
        $rules = [
            'email' => 'unique:users,email|email|required',
            'name' => 'required',
            'password' => 'required',
        ];

        $messages = [];

        return !$changeMessages ? $rules : $messages;
    }
}
