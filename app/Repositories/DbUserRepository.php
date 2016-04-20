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

    public function getAllWithRoles()
    {
        return $this->entity->with('roles');
    }

    public function getById($id)
    {
        return $this->entity->findOrFail($id);
    }
}
