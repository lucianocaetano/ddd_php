<?php

namespace Src\shop\repositories\dtos;

use Src\shop\entities\User;
use Src\shop\value_objects\Id;

/**
 * @package Src\shop\repositories
 *
 * The objective of this interface is to provide a repository for the user
 */
interface UserRepository {

    /**
     * @param Id $id
     * @return ?User
     */
    public function find(Id $id): ?User;

    /**
     * @param string $email
     * @return ?User
     */
    public function findByEmail(string $email): ?User;

    /**
     * @param User $user
     * @return ?User
     */
    public function update(User $user): ?User;

    /**
     * @param Id $id
     * @return void
     */
    public function delete(Id $id): void;
}
