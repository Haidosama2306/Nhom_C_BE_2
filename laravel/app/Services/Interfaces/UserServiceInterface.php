<?php

namespace App\Services\Interfaces;

/**
 * Interface UserServiceInterface
 * @package App\Services\Interfaces
 */
interface UserServiceInterface
{
    public function paginate($request);
    public function createUser($request);
    public function deleteUser($id);
    public function updateUser($id, $request);
}
