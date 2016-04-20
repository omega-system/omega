<?php
namespace Omega\Repositories;

use Omega\Course;

class DbCourseRepository extends DbRepository implements CourseRepositoryInterface
{
    /**
     * DbUserRepository constructor.
     * @param Course $entity
     */
    public function __construct(Course $entity)
    {
        parent::__construct($entity);
    }

    public function getByCourseNumber($courseNumber)
    {
        return $this->entity->findOrFail($courseNumber);
    }
}
