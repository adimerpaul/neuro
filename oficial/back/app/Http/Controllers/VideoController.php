<?php

namespace App\Http\Controllers;

use App\Models\UserVideo;
use App\Models\Video;
use App\Http\Requests\StoreVideoRequest;
use App\Http\Requests\UpdateVideoRequest;
use Illuminate\Http\Request;

class VideoController extends Controller{
    function videosAll(){
        $videos = Video::orderBy('date', 'desc')->get();
        return response()->json($videos);
    }
    function expositores(){
        $expositores = Video::orderBy('subtitle')
            ->orderBy('date')
            ->get();
        return response()->json($expositores);
    }
    public function index(Request $request){
        $date = $request->get('date');

        if ($date == 't'){
            return Video::where('tipo','Taller')->get();
        }

        $videos = Video::whereDate('date', $date)->where('tipo','Jornada')->get();
        return response()->json($videos);
    }
    public function verVideo(Request $request){
        $user_id = $request->user()->id;
        $video = Video::find($request->id);
        $find = UserVideo::where('user_id', $user_id)->where('video_id', $video->id)->first();
        if ($find) {
            $find->date = date('Y-m-d');
            $find->time = date('H:i:s');
            $find->save();
        } else {
            UserVideo::create([
                'user_id' => $user_id,
                'video_id' => $video->id,
                'date' => date('Y-m-d'), // date('Y-m-d H:i:s'
                'time' => date('H:i:s')
            ]);
        }
        $videosActivos = Video::where('button', 1)->count();
        $userCantidad = UserVideo::where('user_id', $user_id)->count();
        $porcentaje = $userCantidad * 100 / $videosActivos;
        return round($porcentaje, 2);
    }
}
