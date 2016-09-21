<?php


class AdminCategoriesAccessTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */

    public function testAdminCanViewCategories()
    {
        $this->adminLogin();
        $this->visit('admin/categories')
            ->assertViewHas('categories');
    }

    public function testAdminCanAddCategory()
    {
        $this->adminLogin();
        $this->visit('admin/categories/create')
            ->type('Test category', 'title')
            ->press('Add')
            ->seePageIs('/admin/categories')
            ->see('Category added!');
    }

    public function testAdminCanEditCategory()
    {
        $this->adminLogin();
        $this->visit('admin/categories/1/edit')
            ->see('Cat 1')
            ->type('Test category', 'title')
            ->press('Update')
            ->seePageIs('/admin/categories')
            ->see('Category name has been updated!');
    }

    public function testAdminCanDeleteCategory()
    {
        $this->adminLogin();
        $this->visit('admin/categories/')
            ->see('Cat 1')
            ->press('deleteButton1')
            ->seePageIs('/admin/categories')
            ->see('Category has been deleted!');

    }
}


