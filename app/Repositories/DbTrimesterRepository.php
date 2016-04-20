<?php
namespace Omega\Repositories;

use Omega\Trimester;

class DbTrimesterRepository extends DbRepository implements TrimesterRepositoryInterface
{
    /**
     * DbUserRepository constructor.
     * @param Trimester $entity
     */
    public function __construct(Trimester $entity)
    {
        parent::__construct($entity);
    }

    public function getPaginated()
    {
        return $this->entity->paginate(env('OMEGA_PAGINATE', 10));
    }

    public function getById($id)
    {
        return $this->entity->findOrFail($id);
    }
}
