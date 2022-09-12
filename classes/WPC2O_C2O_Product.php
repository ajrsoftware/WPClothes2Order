<?php

class WPC2O_C2O_Product
{
    /**
     * Format product from WC order to a shape we can send to C2O
     * @param WC_Order_Item $product 
     * @return void 
     */
    public function __construct(\WC_Order_Item $product)
    {
    }
}
//  {
//                 "sku": "594-117-15",
//                 "quantity": "2",
//                 "logos": {
//                     "logo": [
//                         {
//                             "unique_id": "TEST_02",
//                             "file": "http:\/\/www.clothes2order.com\/images\/c2o_new_2013\/layout\/carousel\/15.jpg",
//                             "position": "3",
//                             "width": "8",
//                             "type": "print"
//                         },
//                         {
//                             "unique_id": "TEST_03",
//                             "file": "http:\/\/www.clothes2order.com\/images\/c2o_new_2013\/layout\/carousel\/14.jpg",
//                             "position": "5",
//                             "width": "12",
//                             "type": "print"
//                         }
//                     ]
//                 }
//             },
