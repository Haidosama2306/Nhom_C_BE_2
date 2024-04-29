<?php

namespace App\Services\Interfaces;

/**
 * Interface PostCatalogueServiceParentInterface
 * @package App\Services\Interfaces
 */
interface PostCatalogueParentServiceInterface
{
    public function paginate($request);
    public function createPostCatalogueParent($request);
    
}
