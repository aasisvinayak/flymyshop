<?php

/**
 * Class CategoryTest.
 */
class CategoryTest extends TestCase
{
    /**
     * Test see category item is visible.
     *
     * @return void
     */
    public function testCategoriesVisible()
    {
        $this->visit('/')
            ->see('CAT 1');
    }
}
