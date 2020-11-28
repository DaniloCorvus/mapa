<?php

namespace App\Http\Controllers;

use App\Video;
use Illuminate\Http\Request;
use DB;

class VideoController extends Controller
{
    public function __construct()
    {
        $this->middleware('permiss', ['except'=> ['index']], 'auth', ['except'=> ['index']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $videos = DB::table('videos')->get();
        return view('videos.index', compact('videos'));
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

        try {
            $video = new Video();
            $video->pdf_path = str_replace('https://youtu.be/','https://www.youtube.com/embed/', $request->link);
            $video->nombre = $request->title;
            $video->descripcion = $request->description;
            $video->save();
            return redirect()->route( 'video.index');
        } catch (\Throwable $th) {
            return response($th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function show(Video $video)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function edit(Video $video)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Video $video)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function destroy($video)
    {
        try {
            $video =  Video::find($video);
            $video ->delete();
            return redirect()->route( 'video.index');
         } catch (\Throwable $th) {
             return $th;
         }
    }
}
