<?php
namespace Omega\Repositories;

use Bican\Roles\Models\Role;

class DbRoleRepository extends DbRepository implements RoleRepositoryInterface
{
    /**
     * DbUserRepository constructor.
     * @param Role $entity
     */
    public function __construct(Role $entity)
    {
        parent::__construct($entity);
    }

    public function getBySlug($slug)
    {
        return $this->entity->whereSlug($slug)->firstOrFail();
    }
}
