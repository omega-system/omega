<?php
namespace Omega\Repositories;

interface TrimesterRepositoryInterface extends RepositoryInterface
{
    public function getById($id);

    public function getAllDesc();
}
