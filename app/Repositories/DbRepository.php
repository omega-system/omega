<?php
namespace Omega\Repositories;

class DbRepository
{
    protected $entity;

    /**
     * DbRepository constructor.
     * @param $entity
     */
    public function __construct($entity)
    {
        $this->entity = $entity;
    }
}
