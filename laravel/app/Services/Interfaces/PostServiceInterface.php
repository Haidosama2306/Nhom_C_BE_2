<?php

namespace App\Services\Interfaces;

/**
 * Interface PostServiceInterface
 * @package App\Services\Interfaces
 */
interface PostServiceInterface
{
    public function paginate($request);//load dữ liệu user Catalogue theo trang
    public function createPost($request);//xử thêm user Catalogue từ view
   
}
