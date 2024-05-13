<?php

namespace App\Http\Controllers;


use App\Models\PostCatalogueParent;
use App\Models\PostCatalogueChildren;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $data['post_catalogues_parent']=PostCatalogueParent::all();
        $data['post_catalogues_children']=PostCatalogueChildren::all();
        $data['latest_post']=Post::orderBy('created_at','desc')->limit(3)->get();
        $data['countrysnews']=Post::where('post_catalogue_parent_id',3)->get();

        return view('client.index', $data);
    }
}
