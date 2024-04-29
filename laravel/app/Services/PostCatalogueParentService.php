<?php

namespace App\Services;

use App\Services\Interfaces\PostCatalogueParentServiceInterface;
use App\Repositories\Interfaces\PostCatalogueParentRepositoryInterface as PostCatalogueParentRepository;
use Illuminate\Support\Facades\DB;

/**
 * Class UserService
 * @package App\Services
 */
class PostCatalogueParentService implements PostCatalogueParentServiceInterface
{
    protected $postCatalogueParentRepository;

    public function __construct(PostCatalogueParentRepository $postCatalogueParentRepository){
        $this->postCatalogueParentRepository=$postCatalogueParentRepository;
    }

    public function paginate($request){
        $condition['keyword']=addslashes($request->input('keyword'));
        $perpage=$request->integer('perpage', 20);
        $postCataloguesParent=$this->postCatalogueParentRepository->pagination(
            $this->paginateSelect(),
            $condition,
            $perpage,
            ['path'=> 'post/catalogue/index'],
            [
                'post_catalogues_parent.id', 'ASC'
            ],
            [],
            ['post_catalogues_children']
        );
        return $postCataloguesParent;
    }
    public function createPostCatalogueParent($request){
        DB::beginTransaction();
        try{
            $payload = $request->only($this->payload());
            $postCatalogueParent=$this->postCatalogueParentRepository->create($payload);
            DB::commit();
            return true;
        }catch(\Exception $ex){
            DB::rollBack();
            echo $ex->getMessage();//die();
            return false;
        }
    }

   
    private function paginateSelect(){
        return[
            'post_catalogues_parent.id',
            'post_catalogues_parent.name',
        ];
    }
    private function payload(){
        return [
            'name'
        ];
    }

   
}

