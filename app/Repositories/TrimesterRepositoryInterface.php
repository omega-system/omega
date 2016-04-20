<?php
namespace Omega\Repositories;

interface TrimesterRepositoryInterface extends RepositoryInterface
{
    public function getPaginated();

    public function getById($id);
}
