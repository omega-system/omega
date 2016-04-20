<?php
namespace Omega\Repositories;

interface UserRepositoryInterface extends RepositoryInterface
{
    public function getAllWithRoles();

    public function getById($id);
}
