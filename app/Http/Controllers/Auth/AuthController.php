<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterFormRequest;
use App\Mail\RegisterMail;
use App\Repositories\Auth\AuthRepository;
use Illuminate\Http\Request;
use mysql_xdevapi\Exception;

class AuthController extends Controller
{
    protected $repo;

    public function __construct(AuthRepository $authRepository)
    {
       $this->repo = $authRepository;
    }
    /**
     * Store a newly created resource in storage.
     * @POST api/v1/register
     * @param  \Illuminate\Http\Request  $request
     * @return
     * @register function
     * public route
     */
    public function register(RegisterFormRequest $request)
    {
        $input = $request->all();
        $input["password"] = bcrypt($input["password"]);
        try {
            $user = $this->repo->createUser($input);
        }
        catch (\Exception $e){
            return response()->json(['error' => $e],422);
        }
        return response()->json(['success'=>$user],201);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}



