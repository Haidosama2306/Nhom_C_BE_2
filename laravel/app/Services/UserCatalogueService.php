<?php

namespace App\Services;

use App\Services\Interfaces\UserCatalogueServiceInterface;
use App\Repositories\Interfaces\UserCatalogueRepositoryInterface as UserCatalogueRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use App\Repositories\Interfaces\UserRepositoryInterface as UserRepository;


/**
 * Class UserService
 * @package App\Services
 */
class UserCatalogueService implements UserCatalogueServiceInterface
{
    protected $userCatalogueRepository;
    protected $userRepository;

    public function __construct(UserCatalogueRepository $userCatalogueRepository, UserRepository $userRepository){
        $this->userCatalogueRepository=$userCatalogueRepository;
        $this->userRepository=$userRepository;
    }

    public function paginate($request){
        $condition['keyword']=addslashes($request->input('keyword'));
        $perpage=$request->integer('perpage', 20);
        $userCatalogues=$this->userCatalogueRepository->pagination(
            $this->paginateSelect(), 
            $condition, 
            $perpage, 
            ['path'=> 'user/catalogue/index'], 
            [],
            [], 
            ['users']
        );
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

    public function updateUserCatalogue($id, $request){
        DB::beginTransaction();
        try{
            $payload = $request->except('_token','send');
            $userCatalogue=$this->userCatalogueRepository->update($id, $payload);
            DB::commit();
            return true;
        }catch(\Exception $ex){
            DB::rollBack();
            echo $ex->getMessage();//die();
            return false;
        }
    }
    public function convertBirthdayDate($birthday=''){
        $carbonDate=Carbon::createFromFormat('Y-m-d', $birthday);
        $birthday=$carbonDate->format('Y-m-d H:i:s');
        return $birthday;
    }
    public function deleteUserCatalogue($id){
        DB::beginTransaction();
        try{
            $userCatalogue=$this->userCatalogueRepository->delete($id);

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
            DB::commit();
            return true;
        }catch(\Exception $ex){
            DB::rollBack();
            echo $ex->getMessage();//die();
            return false;
        }
    }
    
    private function paginateSelect(){
        return [
            'id','name','description'
        ];
    }

    public function setPermission($request){
        DB::beginTransaction();
        try{
            $permissions = $request->input('permission');
            foreach($permissions as $key => $val){
                $userCatalogue = $this->userCatalogueRepository->findById($key);
                $userCatalogue->permissions()->sync($val);
            }
            DB::commit();
            return true;
        }catch(\Exception $ex){
            DB::rollBack();
            echo $ex->getMessage();//die();
            return false;
        }
    }
}
