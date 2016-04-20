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

    public function newInstance()
    {
        return new $this->entity;
    }

    public function create(array $parameters)
    {
        return $this->entity->create($parameters);
    }

    public function getAll()
    {
        return $this->entity->all();
    }

    public function paginate($collection = null)
    {
        if ($collection === null) {
            $collection = $this->entity;
        }
        return $collection->paginate(env('OMEGA_PAGINATE', 10));
    }
}
