<?php
namespace Omega\Repositories;

interface UserRepositoryInterface
{
    public function getAll();

    public function getPaginated();

    public function getById($id);
}
