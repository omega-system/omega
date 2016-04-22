<?php
namespace Omega\Repositories;

interface CourseClassRepositoryInterface extends RepositoryInterface
{
    public function getById($id);
}
