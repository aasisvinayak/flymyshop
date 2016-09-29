<?php


class AdminProductAccessTest extends TestCase
{
    /**
     * Test to make sure that admin can view products.
     */
    public function testAdminCanViewProducts()
    {
        $this->adminLogin();
        $this->visit('admin/products')
            ->assertViewHas('products');
    }

    /**
     * Test admin cannot add product without filling in all the details.
     */
    public function testAdminCannotAddProductWithOutFillingAllDetails()
    {
        $this->adminLogin();
        $this->visit('admin/products/create')
            ->type('Test Product No. 1', 'title')
            ->press('Add')
            ->seePageIs('/admin/products/create');
    }

    /**
     * Test that admin can add the product.
     */
    public function testAdminCanAddProduct()
    {
        $this->adminLogin();
        $this->visit('admin/products/create')
            ->type('Test Product No. 1', 'title')
            ->type('Test Product No. 1', 'make')
            ->type('100', 'stock')
            ->type('Test Product No. 1', 'description')
            ->type('Test Product No. 1', 'details')
            ->type('9.99', 'price')
            ->press('Add Product');
//            ->seePageIs('/admin/products/');
    }

    /**
     * Test admin can edit existing products.
     */
    public function testAdminCanEditProduct()
    {
        $this->adminLogin();
        $this->visit('admin/products/1/edit')
            ->see('Test Product No. 1')
           ->type('Test Product Item', 'title')
            ->submitForm('Edit Product');
//            ->press('Edit Product');
//            ->seePageIs('/admin/products/');
          //  ->see('Test Product Item');
    }

    /**
     * Test admin can change the product status to published.
     */
    public function testAdminCanPublishProduct()
    {
        $this->adminLogin();
        $this->visit('admin/products/')
            ->see('Test Product No. 1')
//            ->select('1','select1')
            ->press('updateButton1')
            ->seePageIs('/admin/products/')
            ->see('Product has been published!');
    }

//    public function testAdminCanUnPublishProduct()
//    {
//        $this->adminLogin();
//        $this->visit('admin/products/')
//            ->see('Test Product No. 1')
////            ->fillForm('updateButton1', array('status'=>'0')
//            ->select('1','selectStatus1')
//            ->press('updateButton1')
//            ->seePageIs('/admin/products')
//            ->see('Product has been un-published!');
//    }
}
