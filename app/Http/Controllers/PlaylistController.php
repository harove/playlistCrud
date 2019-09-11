<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Playlist;
use App\DetallePlaylist;
use Illuminate\Support\Facades\DB;

class PlaylistController extends Controller
{
    public function index( Request $request){
        
        $playlist = DB::table('playlist')->join('canales', 'playlist.id_canal', '=','canales.id')
        ->select('nombre_playlist','hora_inicio','hora_final','nombre_canal','id_canal','fecha_emision','playlist.id')->get();
        return ['playlist' => $playlist];
    }
    
   
    public function store(Request $request){
       
        try{
            DB::beginTransaction();

            $playlist = new Playlist();
            $playlist->id_usuario = $request->id_usuario;
            $playlist->id_canal = $request->id_canal;
            $playlist->hora_final = $request->hora_final;
            $playlist->nombre_playlist = $request->nombre_playlist;
            $playlist->hora_inicio = $request->hora_inicio;
            $playlist->fecha_emision = $request->fecha_emision;
            $playlist->loop = $request->loop;
            $playlist->auto_start = $request->auto_start;

            $playlist->save();

            $detalles_videos = $request->data;

            // foreach que recorre DetallePlylist
            foreach( $detalles_videos as $ep =>$det_video){

                $detalle_video = new DetallePlaylist;
                $detalle_video->id_playlist = $playlist->id; // el id del playlist insertado arriba en playlist
                $detalle_video->id_video = $det_video['id_video'];
                // $detalle_video->length_total = $det_video['length_total'];
                $detalle_video->save();

            }

            DB::commit();

        }catch(Exception $e){

            DB::rollback();
            
        }
    }
    public function delete($id){
        $playlist = Playlist::findOrFail($id);
        $playlist->delete();
        
    }
    public function update(Request $request, $id){
       
        try{
            DB::beginTransaction();

           
            $playlist = new Playlist();
            $playlist->id_usuario = $request->id_usuario;
            $playlist->id_canal = $request->id_canal;
            $playlist->hora_final = $request->hora_final;
            $playlist->nombre_playlist = $request->nombre_playlist;
            $playlist->hora_inicio = $request->hora_inicio;
            $playlist->fecha_emision = $request->fecha_emision;
            $playlist->loop = $request->loop;
            $playlist->auto_start = $request->auto_start;
            $playlist->save();

            DB::commit();

        } catch (Exception $e){
            DB::rollBack();
        }

    }
    public function edit($id){
   
        $playlist = Playlist::find($id);
        $playlistDetalle = DetallePlaylist::find($id);
        return  $playlist;
        //return view('edit');
    }
    public function mostrarDetallePlaylist($id){
        $playlist_detalle = Playlist::find($id)
        ->join('detalle_playlist', 'detalle_playlist.id_playlist', '=', 'playlist.id')
        ->join('video', 'video.id', '=', 'detalle_playlist.id_video')
        ->select('detalle_playlist.*','video.*')->where('playlist.id',$id)->get();
        //dd($playlist_detalle);
        return ['playlist_detalle' => $playlist_detalle];
       
    }
    public function mostrarPlaylist($id){
        $playlist = Playlist::find($id)
        ->join('canales','playlist.id_canal','=','canales.id')
        ->join('users','playlist.id_usuario','=','users.id')
        ->select('playlist.*','canales.*','users.*')->where('playlist.id', $id)->get();
        return ['playlist' => $playlist];
    }
    public function mostrarCanal($id){
        $playlist_canal = Playlist::find($id)
        ->join('canales','playlist.id_canal','=','canales.id')
        ->join('users','playlist.id_usuario','=','users.id')
        ->select('playlist.*','canales.*','users.*')->where('playlist.id', $id)->get();
        return ['playlist_canal' => $playlist_canal];

    }public function mostrarUsuario($id){
        $playlist_usuario = Playlist::find($id)
        ->join('users','playlist.id_usuario','=','users.id')
        ->select('users.*','playlist.*')->where('playlist.id', $id)->get();
        return ['playlist_usuario' => $playlist_usuario];

    }
}
