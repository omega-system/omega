<?php
namespace Omega\Repositories;


interface RepositoryInterface
{
    public function newInstance();

    public function create(array $parameters);

    public function getAll();

    public function paginate($collection = null);
}
