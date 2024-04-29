<?php
namespace App\Repositories;

use App\Repositories\Interfaces\PostCatalogueChildrenRepositoryInterface;
use App\Models\PostCatalogueChildren;
use App\Repositories\BaseRepository;

/**
 * Class PostCatalogueChildrenService
 * @package App\Services
 */
class PostCatalogueChildrenRepository extends BaseRepository implements PostCatalogueChildrenRepositoryInterface
{
    protected $model;
    public function __construct(PostCatalogueChildren $model){
        $this->model=$model;
    }
    public function pagination(
        array $column=['*'],
        array $condition=[],
        int $perpage=0, 
        array $extend=[],
        array $orderBy=['id', 'DESC'],
        array $join=[],
        array $relations=[],
        array $rawQuery = []
        ) {
        $query = $this->model->select($column)->where(function ($query) use ($condition) {
            if (isset($condition['keyword']) && !empty($condition['keyword'])) {
                $query->where(function ($query) use ($condition) {
                    $query->where('post_catalogues_children.name', 'LIKE', '%' . $condition['keyword'] . '%')
                    ->orWhere('tb2.name', 'LIKE', '%' . $condition['keyword'] . '%');                
                });
            }
            if (isset($condition['post_catalogue_parent_id'])) {
                $query->where('tb2.id', '=', $condition['post_catalogue_parent_id']);
            }
        })->with('post_catalogues_parent');
        if(isset($rawQuery['whereRaw']) && count($rawQuery['whereRaw'])){
            foreach($rawQuery['whereRaw'] as $key => $val){
                $query->whereRaw($val[0], $val[1]);
            }
        }
        if(isset($relations)&&!empty($relations)){
            foreach($relations as $relation){
                $query->withCount($relation);
            }
        }
        if(isset($join)&&is_array($join)&&count($join)){
            foreach($join as $key =>$val){
                $query->join($val[0],$val[1],$val[2],$val[3]);
            }
        }
        if(isset($orderBy)&&!empty($orderBy)){
            $query->orderBy($orderBy[0], $orderBy[1]);
        }
        //echo $query->toSql(); die();
        return $query->paginate($perpage)->withQueryString()->withPath(env('APP_URL') . $extend['path']);
    }    
}
