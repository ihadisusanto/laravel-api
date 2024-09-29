<?php

namespace App\Http\Controllers\Api;

use App\Models\Anime;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\AnimeResource;
use Illuminate\Support\Facades\Validator;

class AnimeController extends Controller
{
    /**
     * index
     * @return void
     */

    public function index(){
        //get all animes
        $animes = Anime::latest()->paginate(5); //5 animes per page
        return new AnimeResource(true, 'List of all animes', $animes);
    }

    /**
     * store
     * @param Request $request
     * @return void
     */

    public function store(Request $request){
        //define validation rules for anime
        $validator = Validator::make($request->all(),[
            'title_japan' => 'required',
            'title_english' => 'required',
            'slug' => 'required',
            'episodes' => 'required',
            'studios' => 'required',
            'genre' => 'required',
            'release_year' => 'required',
            'image_url' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required',
            'rating' => 'required',
            'status' => 'required'
        ]);

        //if validation fails, return error message
        if($validator->fails()){
            return response()->json($validator->errors(),422);
        }

        //upload image
        $image = $request->file('image_url');
        $image->storeAs('public/anime_poster',$image->hashName());

        //create anime
        $anime = Anime::create([
            'title_japan' => $request->title_japan,
            'title_english' => $request->title_english,
            'slug' => $request->slug,
            'episodes' => $request->episodes,
            'studios' => $request->studios,
            'genre' => $request->genre,
            'release_year' => $request->release_year,
            'image_url' => $image->hashName(),
            'description' => $request->description,
            'rating' => $request->rating,
            'status' => $request->status
        ]);
        return new AnimeResource(true, 'Data Post Berhasil Ditambahkan!', $anime);
    }

    /**
     * show
     * @param mixed $id
     * @return void
     */

    public function show($id){
        //get anime by id
        $anime = Anime::find($id);
        if($anime){
            return new AnimeResource(true, 'Anime Ditemukan!', $anime);
        }
        return response()->json(['message' => 'Anime Tidak Ditemukan!'], 404);
    }

    
}
