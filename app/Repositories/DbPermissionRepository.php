<?php
namespace Omega\Repositories;

use Bican\Roles\Models\Permission;
use Omega\User;

class DbPermissionRepository extends DbRepository implements PermissionRepositoryInterface
{
    /**
     * DbUserRepository constructor.
     * @param User $entity
     */
    public function __construct(Permission $entity)
    {
        parent::__construct($entity);
    }
}
