<?php

namespace App\Services;

use App\Services\Interfaces\PostCatalogueChildrenServiceInterface;
use App\Repositories\Interfaces\PostCatalogueChildrenRepositoryInterface as PostCatalogueChildrenRepository;
use Illuminate\Support\Facades\DB;

/**
 * Class UserService
 * @package App\Services
 */
class PostCatalogueChildrenService implements PostCatalogueChildrenServiceInterface
{
    protected $postCatalogueChildrenRepository;

    public function __construct(PostCatalogueChildrenRepository $postCatalogueChildrenRepository){
        $this->postCatalogueChildrenRepository=$postCatalogueChildrenRepository;
    }

    public function paginate($request){
        $condition['keyword']=addslashes($request->input('keyword'));
        $condition['post_catalogue_parent_id']=$request->input('post_catalogue_parent_id');
        if($condition['post_catalogue_parent_id']=='0'){
            $condition['post_catalogue_parent_id']=null;
        }
        $perpage=$request->integer('perpage', 20);
        $postCataloguesChildren=$this->postCatalogueChildrenRepository->pagination(
            $this->paginateSelect(),
            $condition,
            $perpage,
            ['path'=> 'post/catalogue/children/index'],
            [
                'post_catalogues_children.id', 'ASC'
            ],
            [
                ['post_catalogues_parent as tb2','tb2.id','=','post_catalogues_children.post_catalogue_parent_id']
            ],
            [
                ['posts'],
            ]
        );
        return $postCataloguesChildren;
    }
    public function createPostCatalogueChildren($request){
        DB::beginTransaction();
        try{
            $payload = $request->only($this->payload());
            $postCatalogueChildren=$this->postCatalogueChildrenRepository->create($payload);
            DB::commit();
            return true;
        }catch(\Exception $ex){
            DB::rollBack();
            echo $ex->getMessage();//die();
            return false;
        }
    }
    
    private function paginateSelect()
    {
        return [
            'post_catalogues_children.id',
            'post_catalogues_children.name AS child_name',
            'tb2.name AS parent_name'
        ];
    }
    
    private function payload(){
        return [
            'name',
            'post_catalogue_parent_id'
        ];
    }

   
}

