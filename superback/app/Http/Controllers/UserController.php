<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function login(Request $request){
//        return $request->only('celular','password');
        if (!Auth::attempt($request->only('celular','password'))){
            return response()->json(['res'=>'El numero de celular o password no encontrado'],400);
        }
//        return 'a';
        if (User::where('celular',$request->celular)->whereDate('fechalimite','>',now())->get()->count()==0){
            return response()->json(['res'=>'Su usuario sobre paso el limite de ingreso'],400);
        }
        $user=User::where('celular',$request->celular)->firstOrFail();
        $token=$user->createToken('auth_token')->plainTextToken;
        return response()->json(['token'=>$token,'user'=>$user],200);;
    }
    public function register(Request $request){
//        if (!Auth::attempt($request->only('celular','password'))){
//            return response()->json(['res'=>'El numero de celular o password no encontrado'],400);
//        }
        $request->validate([
            'email'=>'required|unique:users|email',
            'celular'=>'required|unique:users',
            'carnet'=>'required|unique:users',
//            'cinit'=>'required|string',
            'direccion'=>'required|string',
            'lat'=>'required',
            'lng'=>'required',
//            'password'=>'required',
        ]);
//        return $request;
        $user=new User();
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password=Hash::make( $request->carnet);
        $user->celular=$request->celular;
        $user->carnet=$request->carnet;
        $user->tipo='CLIENTE';
        $user->save();
        $cliente=new Cliente();
        $cliente->cinit=$request->carnet;
        $cliente->nombre=$request->name;
        $cliente->telefono=$request->celular;
        $cliente->direccion=$request->direccion;
        $cliente->lat=$request->lat;
        $cliente->lng=$request->lng;
        $cliente->user_id=$user->id;
        $cliente->save();

        if (User::where('celular',$request->celular)->whereDate('fechalimite','>',now())->get()->count()==0){
            return response()->json(['res'=>'Su usuario sobre paso el limite de ingreso'],400);
        }
        $user=User::where('celular',$request->celular)->firstOrFail();
        $token=$user->createToken('auth_token')->plainTextToken;
        return response()->json(['token'=>$token,'user'=>$user],200);;
    }
    public function store(Request $request){
        $user=new User();
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password= Hash::make($request->password) ;
        $user->fechalimite=$request->fechalimite;
//        $user->codigo= strtoupper( substr($request->name,0,3));
        $user->save();
//        $permisos= array();
//        foreach ($request->permisos as $permiso){
////            echo $permiso['estado'].'  ';
//            if ($permiso['estado']==true)
//                $permisos[]=$permiso['id'];
//        }
//        $permiso = Permiso::find($permisos);
//        $user->permisos()->attach($permiso);

    }
    public function update(Request $request,User $user){
        $user->update($request->all());
        return $user;
    }
    public function updatepermisos(Request $request,User $user){
        $permisos= array();
        foreach ($request->permisos as $permiso){
            if ($permiso['estado']==true)
                $permisos[]=$permiso['id'];
        }
        $permiso = Permiso::find($permisos);
        $user->permisos()->detach();
        $user->permisos()->attach($permiso);
    }
    public function pass(Request $request,User $user){
        $user->update([
            'password'=>Hash::make($request->password)
        ]);
        return $user;
    }
    public function destroy(User $user){
        $user->delete();
    }
    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();
        return response()->json(['res'=>'salido exitosamente'],200);
    }
    public function me(Request $request){
//        $user=$request->user()->with('unid')->with('permisos')->firstOrFail();
//        $user=$request->user()
        $user=User::where('id',$request->user()->id)->firstOrFail();
        return $user;
//        return User::where('id',1)->with('unid')->get();
    }
}
