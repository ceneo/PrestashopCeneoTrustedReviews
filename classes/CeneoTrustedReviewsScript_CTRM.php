<?php

class CeneoTrustedReviewsScript_CTRM 
{
    public static function getScript($account_guid, $email, $order_id, $product_ids, $workdays_to_send)
    {                  
        return '<script type="text/javascript">
                <!--
                ceneo_client_email = \''.$email.'\';
                ceneo_order_id = \''.$order_id.'\';
                ceneo_shop_product_ids =\''.$product_ids.'\';
                ceneo_work_days_to_send_questionnaire = '.$workdays_to_send.';
                 //-->
                document.write(\'<scr\'+\'ipt type="text/javascript" src="https://ssl.ceneo.pl/transactions/track/v2/script.js?accountGuid='.$account_guid.'"></scr\'+\'ipt>\');
                </script>
                ';
    }
}
