<?php

namespace Src\shop\repositories;

use Src\shop\entities\Category;
use Src\shop\value_objects\Id;

/**
 * @package Src\shop\repositories
 *
 * The objective of this interface is to provide a repository for the category
 */
interface CategoryRepository {
    
    /**
     * @param Id $id
     * @return ?Category
     */
    public function find(Id $id): ?Category;

    /**
     * @param Category $save
     * @return Category
     */
    public function save(Category $save): Category;

    /**
     * @param Category $category
     * @return ?Category
     */
    public function update(Category $category): ?Category;

    /**
     * @param Id $id
     * @return void 
     */
    public function delete(Id $id): void;
}
