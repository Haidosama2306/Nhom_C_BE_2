<?php

namespace App\Http\Controllers;

use App\Models\PostCatalogueParent;
use App\Models\PostCatalogueChildren;
use Illuminate\Http\Request;

class PostCataloguesParentController extends Controller
{
/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function list()
    {
        $postCataloguesParent=PostCatalogueParent::all();

        return view('layout.client.navbar', ['postCataloguesParent'=>$postCataloguesParent]);
    }
}
