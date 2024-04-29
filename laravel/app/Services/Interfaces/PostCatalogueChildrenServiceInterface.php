<?php

namespace App\Services\Interfaces;

/**
 * Interface PostCatalogueServiceChildrenInterface
 * @package App\Services\Interfaces
 */
interface PostCatalogueChildrenServiceInterface
{
    public function paginate($request);
    public function createPostCatalogueChildren($request);
}
