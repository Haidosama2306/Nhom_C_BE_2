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
        $data['posts']=Post::all();
        // $data['latest_posts']=Post::published()->orderBy('id', 'desc')->paginate(6);
        return view('client.index', $data);
    }
}
