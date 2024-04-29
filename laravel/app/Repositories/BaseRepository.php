<?php
namespace App\Repositories;

use App\Repositories\Interfaces\BaseRepositoryInterface;
use App\Models\Base;
use illuminate\Database\Eloquent\Model;

/**
 * Class BaseService
 * @package App\Services
 */
class BaseRepository implements BaseRepositoryInterface
{
    protected $model;
    public function __construct(Model $model){
        $this->model=$model;
    }
    public function all(){
        return $this->model->all();
    }
    public function pagination(array $column=['*'],array $condition=[],array $join=[],array $extend=[],int $perpage=0, array $relations=[]){
        $query=$this->model->select($column)->where(function($query) use($condition){
            if(isset($condition['keyword']) && !empty($condition['keyword'])){
                $query->where('name', 'LIKE', '%'.$condition['keyword'].'%');
            }
        });
        if(isset($relations)&&!empty($relations)){
            foreach($relations as $relation){
                $query->withCount($relation);
            }
        }
        if(!empty($join)){
            $query->join(...$join);
        }
        return $query->paginate($perpage)->withQueryString()->withPath(env('APP_URL').$extend['path']);
    }
    public function findById(int $id, array $column=['*'], array $relation =[]){
        return $this->model->select($column)->with($relation)->findOrFail($id);
    }
    public function findTableById(int $id = 0){
        return $this->model->where('id','=',$id)->get();
    }
    public function create(array $payload =[]){
        $model= $this->model->create($payload);
        return $model->fresh();
    }
    public function update(int $id=0, array $payload=[]){
        $model=$this->findById($id);
        return $model->update($payload);
    }
    public function updateByWhereIn(string $whereInField='', array $whereIn=[], array $payload=[]){
        return $this->model->whereIn($whereInField, $whereIn)->update($payload);
    }
    public function delete(int $id=0){
        return $this->findById($id)->delete();
    }
    public function forceDelete(int $id=0){
        return $this->findById($id)->forceDelete();
    }
    public function deleteByWhereIn(string $whereInField = '', array $whereIn = []) {
        return $this->model->whereIn($whereInField, $whereIn)->forceDelete();
    }
    
}
