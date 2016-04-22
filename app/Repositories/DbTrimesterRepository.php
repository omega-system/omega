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

    public function getById($id)
    {
        return $this->entity->findOrFail($id);
    }

    public function getAllDesc()
    {
        return $this->entity
            ->orderBy('year', 'desc')
            ->orderBy('sequence', 'desc')
            ->get();
    }
}
