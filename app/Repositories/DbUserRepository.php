<?php
namespace Omega\Repositories;

use Omega\User;

class DbUserRepository extends DbRepository implements UserRepositoryInterface
{
    /**
     * DbUserRepository constructor.
     * @param User $entity
     */
    public function __construct(User $entity)
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
