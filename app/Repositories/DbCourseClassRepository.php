<?php
namespace Omega\Repositories;

use Bican\Roles\Models\Role;
use Omega\CourseClass;

class DbCourseClassRepository extends DbRepository implements CourseClassRepositoryInterface
{
    /**
     * DbUserRepository constructor.
     * @param CourseClass $entity
     */
    public function __construct(CourseClass $entity)
    {
        parent::__construct($entity);
    }

    public function getById($id)
    {
        return $this->entity->findOrFail($id);
    }
}
