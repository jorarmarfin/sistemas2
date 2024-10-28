<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Persona;
use Carbon\Carbon;
use Auth;
use DB;

class AuthController extends Controller
{

    public function signUp(Request $request)
    {
        $request->request->add([
            'grant_type'    => 'password',
            'client_id'     => '3',
            'client_secret' => 's28UmSrFk6GhEkysSk9S2v4hdOXa6WYjp6cyZ21T',
            'scope' => '*'
        ]);

        $request->validate([
            'nombres' => 'required|string',
            'apellidos' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'tipo_documento' => 'required|integer',
            'documento' =>'required|string',
            'telefono' => 'required|string'
        ]);
        DB::beginTransaction();
        try{
            $user = User::create([
                'name' => $request->nombres.' '.$request->apellidos,
                'email' => $request->email,
            ]);

            Persona::create([
                    'nombres' => $request->nombres,
                    'apellidos' => $request->apellidos,
                    'id_documento' => $request->tipo_documento,
                    'id_usuario' => $user->id,
                    'documento' => $request->documento,
                    'tipo' => 'usuario_app',
                    'estatus' => 'activo',
                    'telefono' => $request->telefono
            ]);

            $user->assignRole('usuario_app');

            //$tokenResult = $user->createToken('Personal Access Token');
            $tokenResult = $user->createToken('APPLICATION');

            $token = $tokenResult->token;
            /*if ($request->remember_me)
                $token->expires_at = Carbon::now()->addDays(1);*/
            $token->save();
            DB::commit();
            return response()->json([
                'succes' => true,
                'message' => 'Usuario creado con exito!',
                'data' => [
                    'access_token' => $tokenResult->accessToken,
                    'token_type' => 'Bearer'
                ]
            ], 201);
            
        }catch(Exception $e){
             DB::rollback();
            return $e->getMessage();

        }
        
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me' => 'boolean'
        ]);

        $credentials = request(['email', 'password']);

        if (!Auth::attempt($credentials))
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);

        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');

        $token = $tokenResult->token;
        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addDays(1);
        $token->save();

        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse($token->expires_at)->toDateTimeString()
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }

    public function user(Request $request)
    {
        try{
            $user = $request->user();
            $persona = $user->getpersona;
            $documento = $persona->tipo_doc;

            $data = [
                'nombre' => $user->name,
                'email' => $user->email,
                'telefono' => $persona->teledono,
                'tipo_documento' => '('.$documento->codigo.')- '.$documento->nombre,
                'documento' => $persona->documento
            ];
            return response()->json($data);
        }catch(Exception $e){
            return response()->json($e);
        }
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
