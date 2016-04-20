<?php
namespace Omega\Repositories;

interface UserRepositoryInterface extends RepositoryInterface
{
    public function getPaginatedWithRoles();

    public function getById($id);
}
