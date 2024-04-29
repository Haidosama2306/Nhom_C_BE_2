<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\PostCatalogueParentRepositoryInterface as PostCatalogueParentRepository;

use Illuminate\Http\Request;


class PostCatalogueController extends Controller
{
    protected $postCatalogueParentRepository;

    public function __construct(PostCatalogueParentRepository $postCatalogueParentRepository){
        $this->postCatalogueParentRepository=$postCatalogueParentRepository;
    }

    public function getPostCatalogue(Request $request){
        $html='';
        $get=$request->input();

        if($get['target']=='DTpostCatalogueChildren'){
            $ListPostCataloguesChildren=$this->postCatalogueParentRepository->findById($get['data']['post_catalogue_parent_id'],['id','name'],['post_catalogues_children']);
            $html=$this->renderHTML($ListPostCataloguesChildren->post_catalogues_children, '[Chọn nhóm bài viết con]');
        }
        $response=[
            'html'=>$html
        ];
        return response()->json($response);
    }
    public function renderHTML($ListPostCatalogues, $root=''){
        $html="<option value='0'>$root</option>";
        foreach($ListPostCatalogues as $postCatalogue){
            $html.="<option value='$postCatalogue->id'>$postCatalogue->name</option>";
        }
        return $html;
    }
}
