<?php
namespace Omega\Repositories;

interface RoleRepositoryInterface extends RepositoryInterface
{
    public function getBySlug($slug);
}
