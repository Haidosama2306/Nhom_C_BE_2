<?php

namespace App\Services\Interfaces;

/**
 * Interface UserCatalogueServiceInterface
 * @package App\Services\Interfaces
 */
interface UserCatalogueServiceInterface
{
    public function paginate($request);
    public function createUserCatalogue($request);
    public function updateUserCatalogue($id, $request);
    public function deleteUserCatalogue($id);
}
