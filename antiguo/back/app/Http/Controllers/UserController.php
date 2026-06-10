<?php

namespace App\Http\Controllers;

use App\Models\Agencia;
use App\Models\Chat;
use App\Models\User;
use App\Models\UserVideo;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
class UserController extends Controller
{
    public function cambiarPass(Request $request){
        $user=User::findOrFail($request->user()->id);
        if (! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'password' => ['La contraseña actual es incorrecta'],
            ]);
        }
        if ($request->newPassword!=$request->confirmPassword) {
            throw ValidationException::withMessages([
                'confirmPassword' => ['La confirmación de la contraseña no coincide'],
            ]);
        }
        $user->update([
            'password'=>Hash::make($request->newPassword)
        ]);
        return response()->json([
            'message'=>'Contraseña actualizada correctamente'
        ],200);
    }
    public function index(Request $request){
        $users= User::where('id','!=',1)->where('id','!=',$request->user()->id)->get();
        $users->each(function ($user){
            $videosActivos = Video::where('button', 1)->count();
            $userCantidad = UserVideo::where('user_id', $user->id)->count();
            $porcentaje = $userCantidad * 100 / $videosActivos;
            $user->porcentaje=round($porcentaje,2);
        });
        return $users;
    }
    public function show($id,Request $request)
    {
        $user_id=$request->user()->id;
        $chats= Chat::whereRaw("(userEnviado_id=$user_id AND userRecibido_id=$id)OR(userEnviado_id=$id AND userRecibido_id=$user_id)")->get();
        return $chats;
    }
    public function login(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('ci', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            return response()->json([
                'message'=>'Las credenciales proporcionadas son incorrectas'
            ],401);
        }
        return response()->json([
            'token'=>$user->createToken('web')->plainTextToken,
            'user'=>$user
        ],200);
    }
    public function register(Request $request){
        $request->validate([
            'email'=>'required|unique:users|email',
//            'name'=>'required|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
//        $user=new User();
//        $user->name= ( $request->name);
//        $user->email=$request->email;
//        $user->password=Hash::make( $request->password);
////        $user->fechaLimite=date('Y-m-d', strtotime(now(). ' + 360 days'));
////        $user->fechaConexion=now();
//        $user->save();
        $request->merge([
            'password'=>Hash::make($request->password)
        ]);
        $request->merge([
            'celular'=>$request->phone
        ]);
        $request->merge([
            'correo'=>$request->correo
        ]);
        $user = User::create($request->all());
        $token=$user->createToken('web')->plainTextToken;
        return response()->json([
            'token'=>$token,
            'user'=>User::find($user->id)
        ],200);
    }
    public function store(Request $request){
        $this->validate($request, [
            'email' => 'required|unique:users',
            'password' => 'required',
        ]);
        $request->merge([
            'password'=>Hash::make($request->password)
        ]);
        return User::create($request->all());
    }
    public function update(Request $request,$id){
        $user=User::findOrFail($id);
        error_log(json_encode($request->all()));
        $this->validate($request, [
//            'name' => 'required',
            'email' => 'required|unique:users,email,'.$user->id,
        ]);
        $user->update($request->all());
        return $user;
    }

    public function updatePassword(Request $request,User $user){
        $this->validate($request, [
            'password' => 'required',
//            'password_confirmation' => 'required|same:password',
        ]);
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
        $user=User::where('id',$request->user()->id)->firstOrFail();
        $videosActivos = Video::where('button', 1)->count();
        $userCantidad = UserVideo::where('user_id', $user->id)->count();
        $porcentaje = $userCantidad * 100 / $videosActivos;
        return response()->json([
            'user'=>$user,
            'porcentaje'=>round($porcentaje,2)
        ],200);
    }
}
