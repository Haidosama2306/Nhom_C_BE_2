<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;


class PostCatalogueChildren extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'post_catalogue_parent_id'
    ];

    protected $table='post_catalogues_children';
    public function posts()
    {
        return $this->hasMany(Post::class, 'post_catalogue_children_id', 'id');
    }
    public function post_catalogues_parent(){
        return $this->belongsTo(PostCatalogueParent::class,'post_catalogue_parent_id', 'id');
    }
}
