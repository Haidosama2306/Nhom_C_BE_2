<?php

namespace App\Services;

use App\Services\Interfaces\UserCatalogueServiceInterface;
use App\Repositories\Interfaces\UserCatalogueRepositoryInterface as UserCatalogueRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;



/**
 * Class UserService
 * @package App\Services
 */
class UserCatalogueService implements UserCatalogueServiceInterface
{
    protected $userCatalogueRepository;

    public function __construct(UserCatalogueRepository $userCatalogueRepository){
        $this->userCatalogueRepository=$userCatalogueRepository;
    }

    public function paginate($request){
        $condition['keyword']=addslashes($request->input('keyword'));
        $perpage=$request->integer('perpage', 20);
        $userCatalogues=$this->userCatalogueRepository->pagination(['id','name','description'], $condition,[], ['path'=> 'user/catalogue/index'], $perpage,['users']);
        return $userCatalogues;
    }
    public function createUserCatalogue($request){
        DB::beginTransaction();
        try{
            $payload = $request->except('_token','send');
            $userCatalogue=$this->userCatalogueRepository->create($payload);
            DB::commit();
            return true;
        }catch(\Exception $ex){
            DB::rollBack();
            echo $ex->getMessage();//die();
            return false;
        }
    }
   
    public function deleteAll($post=[]){
        DB::beginTransaction();
        try{
            $userCatalogues=$this->userCatalogueRepository->deleteByWhereIn('id',$post['id']);
            //echo 1; die();
            DB::commit();
            return true;
        }catch(\Exception $ex){
            DB::rollBack();
            echo $ex->getMessage();//die();
            return false;
        }
    }
}
