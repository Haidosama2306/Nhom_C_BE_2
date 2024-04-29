<?php

namespace App\Services\Interfaces;

/**
 * Interface PostServiceInterface
 * @package App\Services\Interfaces
 */
interface PostServiceInterface
{
    public function paginate($request);
    public function createPost($request);
    public function updatePost($id, $request);
    public function deletePost($id);
   
}
