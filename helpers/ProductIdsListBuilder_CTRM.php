<?php

class ProductIdsListBuilder_CTRM
{
    public static function Build($order_products, $seperator = '#')
    {
        $product_ids = '';

        foreach ($order_products as $product) 
        {
            for($i = 0; $i < $product['product_quantity']; $i++)
            {
                $product_ids .= $seperator . $product['product_id'];
            }
        }
        
        return $product_ids;
    }
}