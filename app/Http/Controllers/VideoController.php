<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Video;
use Mhor\MediaInfo\MediaInfo;
//use SebastianBergmann\Environment\Console;
//require_once('getid3.php');
use getID3;

class VideoController extends Controller
{
    public function index( Request $request){
        
        $videos = Video::all();
        return ['videos' => $videos];
    }

    public function listarVideo( Request $request){
        
        $videos = Video::all();
        return ['videos' => $videos];
    }

    public function store(Request $request){
       
        try{
            DB::beginTransaction();

            $video = new Video();
            $video->id_canal = $request->id_canal;
            $video->nombre_video = $request->nombre_video;
            $video->length = $request->length;

            $video->save();

            DB::commit();

        }catch(Exception $e){

            DB::rollback();
            
        }
    }

    // private function f($arg)
    // {
    //     var_dump($arg);
    //     console.log($arg);
    //     return $arg;
    // }


    public function uploadFiles(Request $request){
    
        //return 'uploadFiles';

        if ($request->input('dzuuid')!=null) {




            //$chunk = isset($_REQUEST["chunk"]) ? intval($_REQUEST["chunk"]) : 0;
            //dump(isset($_REQUEST["dzuuid"]));
            dump($_REQUEST);
            //dump($_FILES["file"]);
            // dump(Input::file('file')->guessClientExtension());
            // dump(Input::file('file')->getClientOriginalName());
            // dump(__DIR__);
            // dump(Input::file('file')->getRealPath());
            // dump($_FILES['file']);
            // dump(Input::file('file'));
            //$dzchunkindex = $request->get('dzchunkindex');
            //dump($dzchunkindex);

            // $rules = array(
            //     'file' => 'mimes:mp4,x-flv,x-mpegURL,MP2T,3gpp,quicktime,x-msvideo,x-ms-wmv|max:1000000'
            // );
            // $validation = Validator::make($input, $rules);        
            // //dump($validation->fails());
            // if ($validation->fails()) {
            //     return Response::make($validation->errors()->first(), 400);
            // }
    
            // if (Input::file('file')->getClientOriginalExtension() == 'mp4'){
            // }    
            $chunk = isset($_REQUEST["dzchunkindex"]) ? intval($_REQUEST["dzchunkindex"]) : 0;
            $chunks = isset($_REQUEST["dztotalchunkcount"]) ? intval($_REQUEST["dztotalchunkcount"]) : 0;
            $size =  isset($_REQUEST["dztotalfilesize"]) ? intval($_REQUEST["dztotalfilesize"]) : 0;  


            $fileName = isset($_REQUEST["name"]) ? $_REQUEST["name"] : $_FILES["file2"]["name"];
            $filePath = "uploads/$fileName";

            $out = @fopen("{$filePath}.part", $chunk == 0 ? "wb" : "ab");
            if ($out) {
              // Read binary input stream and append it to temp file
              $in = @fopen($_FILES['file2']['tmp_name'], "rb");
             
              if ($in) {
                while ($buff = fread($in, 512))
                  fwrite($out, $buff);
              } else
                die('{"OK": 0, "info": "Failed to open input stream."}');
             
              @fclose($in);
              @fclose($out);
              
             
              @unlink($_FILES['file']['tmp_name']);
            } else
              die('{"OK": 0, "info": "Failed to open output stream."}');
             
             
            // Check if file has been uploaded
            if (!$chunks || $chunk == $chunks - 1) {
              // Strip the temp .part suffix off
                rename("{$filePath}.part", $filePath);
            }


            if ( $chunk == $chunks-1) 
            {

            // exec('mediainfo --Inform="General;%Duration%" ' . $filePath, $output);  
            // $durationInSec = ceil(ceil($output[0])/1000);      

            $getID3 = new getID3;
            $video_file = $getID3->analyze($filePath);   
            $duration_seconds = $video_file['playtime_seconds']; 

            //dump(getcwd());
            //dump($durationInSec);
            //die();
            // $mediaInfo = new MediaInfo();
            // $mediaInfoContainer = $mediaInfo->getInfo($filePath);
            // $format = $mediaInfoContainer->get('format');


        //    echo 'format = ', f($format)  ;
            


            $video = new Video();
            $video->nombre_video = $fileName;
            $video->id_categoria = 1;
            $video->size = $size;
            $video->lenght = $duration_seconds;
  
            $video->save();

            }


            //return($filePath);
            //return array($filePath,$fileName);
            


            
            




            //die('{"OK": 1, "info": "Upload successful."}');

           

      //$extension = Input::file('file')->getClientOriginalExtension(); 
                //$fileName = rand(11111, 99999) . '_' . $dzchunkindex . '.' . $extension; // renameing image
                //$fileName = Input::file('file')->getClientOriginalName() . '_' . $dzchunkindex . '.' . Input::file('file')->getClientOriginalExtension();
                //$destinationPath = 'uploads';
                //$fileName = Input::file('file')->getClientOriginalName();
                //dump($fileName);
                //$path = public_path().'/uploads/';
                //return $file->move($path, $filename);
                
                //dump($fileNameFullPath);
                //$fileNameFullPath = 'uploads/' . $fileName;
                //$storage_path = storage_path() . '/public';
                //$fileNameFullPath = $storage_path . '/' . $fileName;
                //dump($storage_path);

                //dump($disk);
                
                // if ($dzchunkindex == 0) {
                //     // create new file
                //     Storage::putFileAs('public',$request->file('file'),'movie.mp4');
                // }


                //$disk = Storage::disk('local'); 

                // $fout = fopen('movie.mp4','ab');
                // dump($fout);
                // $fin = fopen($request->file('file'),'rb');
                // dump($fin);
                // $buff = fread($fin,1001006);
                // dump($buff);
                // fwrite($fout,$buff);
                // dump(fwrite($fout,$buff));
                
                // fclose($fin);
                // fclose($fout);
                
                //$disk->put('movie.mp4',$fh);


                //$appended = $disk->append('movie.mp4',fopen($request->file('file'),'a+b'));   //ok first chunk

                //$appended = $disk->append('movie.mp4',$request->file('file'));
              
                //file_put_contents('movie.mp4', stream_get_contents($request->file('file')), FILE_APPEND);
                //$appended = Storage::append('movie.mp4', $request->file('file'));
                //dump($appended);



                //Storage::putFile($fileName, new File($storage_path));
                //$path = public_path().'/uploads/';
                //return $file->move($path, $filename);

               
                //dump(Storage::exists($request->file('file')));

                //$path = $request->file('file')->store('files');

                //dump($path);

                //Storage::append($request->file('file'), 'public/coco.mp4' );
             
                

                //$file = fopen(Storage::disk('local'), "a+b");

                
                //file_put_contents ( $fileNameFullPath , $fileName, FILE_APPEND );
                //if file name exist in folder entonces apendear en el file

              

                //apendear 

                //$upload_success = Input::file('file')->move($destinationPath, $fileName); // uploading file to given path
                // if ($upload_success) {
                //     return Response::json('success', 200);
                // } else {
                //     return Response::json('error', 400);
                // }
                
        

            }  // check is chunk


    
    }
    







}
