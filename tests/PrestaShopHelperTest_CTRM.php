<?php

require_once(__CENEO_TR_MODULE_PATH__ . 'helpers' . DIRECTORY_SEPARATOR . 'PrestaShopHelper_CTRM.php'); 

class PrestaShopTrusteReviewsHelperTest extends PHPunit_Framework_Testcase
{
    public function test_GetPSVersionBasePart_ShouldReturnProperVersion()
    {
        $this->assertEquals(PrestaShopHelper_CTRM::GetPSVersionBasePart("1.5.6.7"), "1.5");
        $this->assertEquals(PrestaShopHelper_CTRM::GetPSVersionBasePart("1"), "1");
    }
}
