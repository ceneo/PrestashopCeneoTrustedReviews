<?php

require_once(__CENEO_TR_MODULE_PATH__ . 'helpers' . DIRECTORY_SEPARATOR . 'ProductIdsListBuilder_CTRM.php'); 

class ProductIdsListBuilder_CTRMTest extends PHPunit_Framework_Testcase
{
    public function test_Build_ShouldReturnProperProductIdsListForSingleProducts()
    {
        $this->assertEquals(ProductIdsListBuilder::Build($this->getOrderSingleProducts()), '#145#235#1288');
    }
    
    public function test_Build_ShouldReturnProperProductIdsListForMultipleProducts()
    {
        $this->assertEquals(ProductIdsListBuilder::Build($this->getOrderMultipleProducts()), '#44#44#12#12#12#442');
    }
    
    private function getOrderSingleProducts()
    {
        return array(
            array(
                'product_quantity'  => 1,
                'product_id'        => 145
            ),
            array(
                'product_quantity'  => 1,
                'product_id'        => 235
            ),
            array(
                'product_quantity'  => 1,
                'product_id'        => 1288
            )
        );
    }
    
    private function getOrderMultipleProducts()
    {
        return array(
            array(
                'product_quantity'  => 2,
                'product_id'        => 44
            ),
            array(
                'product_quantity'  => 3,
                'product_id'        => 12
            ),
            array(
                'product_quantity'  => 1,
                'product_id'        => 442
            )
        );
    }
}
