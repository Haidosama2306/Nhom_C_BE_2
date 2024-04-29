<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;


class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'image',
        'content',
        'description',
        'image',
        'album',
        'user_id',
        'post_catalogue_parent_id',
        'post_catalogue_children_id',
    ];

    protected $table='posts';

}
