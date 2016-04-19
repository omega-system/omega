<?php
namespace Omega\Repositories;

interface UserRepositoryInterface extends RepositoryInterface
{
    public function getPaginated();

    public function getById($id);
}
