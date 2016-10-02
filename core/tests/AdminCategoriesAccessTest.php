<?php


class AdminCategoriesAccessTest extends TestCase
{
    /**
     * Test admin can view list of shop categories
     *
     * @return void
     */
    public function testAdminCanViewCategories()
    {
        $this->adminLogin();
        $this->visit('admin/categories')
            ->assertViewHas('categories');
    }

    /**
     * Test admin can add a new category
     *
     * @return void
     */
    public function testAdminCanAddCategory()
    {
        $this->adminLogin();
        $this->visit('admin/categories/create')
            ->type('Test category', 'title')
            ->press('Add')
            ->seePageIs('/admin/categories')
            ->see('Category added!');
    }

    /**
     * Test that admin can edit can existing category
     *
     * @return void
     */
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

    /**
     * Test that admin can delete an existing category
     *
     * @return void
     */
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
