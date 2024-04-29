<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;


class PostCatalogueParent extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name'
    ];

    protected $table='post_catalogues_parent';
    public function post_catalogues_children()
    {
        return $this->hasMany(PostCatalogueChildren::class, 'post_catalogue_parent_id', 'id');
    }
}
