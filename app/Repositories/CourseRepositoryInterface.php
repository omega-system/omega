<?php
namespace Omega\Repositories;

interface CourseRepositoryInterface extends RepositoryInterface
{
    public function getByCourseNumber($courseNumber);
}
