<?php

function clearComma($val){
    $value = str_replace(",","",$val);
    $value = str_replace(",","",$value);
    $value = str_replace(",","",$value);
    $value = str_replace(",","",$value);
    $value = str_replace(",","",$value);
    $value = str_replace(",","",$value);
    $value = str_replace(",","",$value);
    $value = str_replace(",","",$value);
    return $value;
}

// operator
add_action( 'wp_ajax_addFinancialAjax', 'addFinancialAjax' );
if( !function_exists('addFinancialAjax') ):
    function addFinancialAjax(){

        $technician = $_POST['technician'];
        $price = $_POST['price'];
        $price = clearComma($price);
        $description = $_POST['description'];
        $post_id = wp_insert_post(array(
            'post_title'=>'پرداخت بدهی',
            'post_type'=>'financial',
            'post_author' => $technician,
        ));

        if($post_id){
            $amount = $price;
            $add = update_post_meta($post_id,"payment_status",1);
            $add = update_post_meta($post_id,"wallet",1);
            $add = update_post_meta($post_id,"wallet_pay",$price);
            $add = update_post_meta($post_id,"refid",$description);
            $add = update_post_meta($post_id,"description",$description);

            $mobile = get_user_meta($technician,"mobile",true);
            $template = get_option("sms")["tech_wallet_charge"];
            $token = get_post_meta($technician,"first_name",true);
            $token2 = number_format($amount)."تومان";
            $sms = SendSMS($mobile,$template,$token,$token2);
            $status = true;
            $message = "سفارش با موفقیت ویرایش گردید";
            print json_encode(array("status" => $status , "message" => $message));
            exit();
        }
        else{
            $status = false;
            $message = "خطا لطفا دوباره تلاش نمایید.";
            print json_encode(array("status" => $status , "message" => $message));
            exit();
        }

    }
endif;




// operator
add_action( 'wp_ajax_addFinancialInternalAjax', 'addFinancialInternalAjax' );
if( !function_exists('addFinancialInternalAjax') ):
    function addFinancialInternalAjax(){

        $technician = $_POST['technician'];
        $price = $_POST['price'];
        $price = clearComma($price);
        $description = $_POST['description'];
        $post_id = wp_insert_post(array(
            'post_title'=>'پرداخت بدهی',
            'post_type'=>'financial_internal',
            'post_author' => $technician,
        ));

        if($post_id){
            $amount = $price;
            $add = update_post_meta($post_id,"payment_status",1);
            $add = update_post_meta($post_id,"wallet",1);
            $add = update_post_meta($post_id,"wallet_pay",$price);
            $add = update_post_meta($post_id,"refid",$description);
            $add = update_post_meta($post_id,"description",$description);

            $mobile = get_user_meta($technician,"mobile",true);
            $template = get_option("sms")["tech_wallet_charge"];
            $token = get_post_meta($technician,"first_name",true);
            $token2 = number_format($amount)."تومان";
            $sms = SendSMS($mobile,$template,$token,$token2);
            $status = true;
            $message = "حقوق با موفقیت اضافه گردید";
            print json_encode(array("status" => $status , "message" => $message));
            exit();
        }
        else{
            $status = false;
            $message = "خطا لطفا دوباره تلاش نمایید.";
            print json_encode(array("status" => $status , "message" => $message));
            exit();
        }

    }
endif;


// operator
add_action( 'wp_ajax_addFinancialRewardAjax', 'addFinancialRewardAjax' );
if( !function_exists('addFinancialRewardAjax') ):
    function addFinancialRewardAjax(){

        $technician = $_POST['technician'];
        $rewardType = $_POST['rewardType'];
        $rewardprice = $_POST['rewardprice'];
        $rewardprice = clearComma($rewardprice);
        $rewardDesc = $_POST['rewardDesc'];

        $post_id = wp_insert_post(array(
            'post_title'=>'فاکتور جدید',
            'post_type'=>'financial',
            'post_author' => $technician,
        ));
        if($post_id){

            $add = update_post_meta($post_id,"reward_type",$rewardType);
            $add = update_post_meta($post_id,"price_customer",0);
            $add = update_post_meta($post_id,"cost_price",0);
            $add = update_post_meta($post_id,"total_invoice",$rewardprice);
            $add = update_post_meta($post_id,"rewardDesc",$rewardDesc);
            $add = update_post_meta($post_id,"payment_status",1);

        }

        $status = true;
        $message = "پاداش / جریمه با موفقیت ویرایش گردید";
        print json_encode(array("status" => $status , "message" => $message));
        exit();

    }
endif;
//TECHNESIAN
add_action( 'wp_ajax_addInvoiceAjax', 'addInvoiceAjax' );
if( !function_exists('addInvoiceAjax') ):
    function addInvoiceAjax(){
        $technician = sanitize_text_field($_POST['technician']);
        $price_customer = sanitize_text_field($_POST['totalInvoice']);
        $price_customer = clearComma($price_customer);

        // ایجاد پست جدید
        $post_id = wp_insert_post(array(
            'post_title'=>'فاکتور جدید',
            'post_type'=>'invoice',
            'post_author' => $technician,
        ));
        if($post_id){
            // ذخیره متا دیتاهای مرتبط
            update_post_meta($post_id,"price_customer",$price_customer);
        }

        $status = true;
        $message = "فاکتور با موفقیت ذخیره شد.";
        print json_encode(array("status" => $status , "message" => $message));
        exit();
    }
endif;



// operator
add_action( 'wp_ajax_addFinancialRewardInternalAjax', 'addFinancialRewardInternalAjax' );
if( !function_exists('addFinancialRewardInternalAjax') ):
    function addFinancialRewardInternalAjax(){

        $technician = $_POST['technician'];
        $rewardType = $_POST['rewardType'];
        $rewardprice = $_POST['rewardprice'];
        $rewardprice = clearComma($rewardprice);
        $rewardDesc = $_POST['rewardDesc'];

        $post_id = wp_insert_post(array(
            'post_title'=>'فاکتور جدید',
            'post_type'=>'financial_internal',
            'post_author' => $technician,
        ));
        if($post_id){

            $add = update_post_meta($post_id,"reward_type",$rewardType);
            $add = update_post_meta($post_id,"price_customer",0);
            $add = update_post_meta($post_id,"cost_price",0);
            $add = update_post_meta($post_id,"total_invoice",$rewardprice);
            $add = update_post_meta($post_id,"rewardDesc",$rewardDesc);
            $add = update_post_meta($post_id,"payment_status",1);

        }

        $status = true;
        $message = "پاداش / جریمه با موفقیت ویرایش گردید";
        print json_encode(array("status" => $status , "message" => $message));
        exit();

    }
endif;


function loadAllDataFin(){

    $financial = get_posts( array(
        "post_type" => "financial",
        "posts_per_page" => -1,
        "post_status" => "any",
    ) );

    $all_price = 0;
    $all_income = 0;
    $tech_Income = 0;
    $reward = 0;
    $penalty = 0;
    $wallet_charge_tech = 0;

    $i = 0;
    foreach($financial as $item) {
        $i++;
        $uid = get_post_meta($item->ID, "order_id", true);
        $status = get_post_meta($uid,"status",true);
        $customer_id = get_post_meta($item->ID, "customer_id", true);
        $price_customer = get_post_meta($item->ID, "price_customer", true);
        $wallet = get_post_meta($item->ID, "wallet", true);
        $wallet_pay = get_post_meta($item->ID, "wallet_pay", true);
        $refid = get_post_meta($item->ID, "refid", true);
        $cost_price = get_post_meta($item->ID, "cost_price", true);
        $total_invoice = get_post_meta($item->ID, "total_invoice", true);
        $order_id = get_post_meta($item->ID, "order_id", true);


        $payment_status = get_post_meta($item->ID,"payment_status",true);
        $reward_type = get_post_meta($item->ID,"reward_type",true);
        $rewardDesc = get_post_meta($item->ID,"rewardDesc",true);
        $customer = get_post_meta($uid,"customer",true);
        $customer_first_name = get_user_meta($customer,"first_name",true);
        $sub_customer = + $customer + 10000;
        $author = $item->post_author;
        $percent = get_user_meta($author,"percent",true);
        if($status == 10){
            $percent = 100;
        }
        

        $tech_firstname = get_user_meta($item->post_author,"first_name",true);


        if($reward_type == 1){
            $total_invoice = convert2english($total_invoice);
            if($total_invoice == '' || empty($total_invoice)){$total_invoice = 0;}

            $reward = +$reward + $total_invoice;
        }
        if($reward_type == "0"){
            $total_invoice = convert2english($total_invoice);
            $penalty = + $penalty + $total_invoice;
        }
        if($wallet == 1){

            $wallet_charge_tech = +$wallet_charge_tech + $wallet_pay;
        }
        if($reward_type == "" && $wallet == ""){
            $total_invoice_customer = ($total_invoice / 100) * $percent;
            $total_invoice_co = $total_invoice - $total_invoice_customer;
            $all_income = +$all_income + $total_invoice;
            $all_price = + $all_price + $total_invoice + $cost_price;
            $tech_Income = +$tech_Income + $total_invoice_co;
        }


    }

    return array(
        "all_price" => $all_price,
        "all_income" => $all_income,
        "tech_Income" => $tech_Income,
        "reward" => $reward,
        "penalty" => $penalty,
        "wallet_charge_tech" => $wallet_charge_tech,
    );


}


function loadAllDataFinMonthly(){

    $financial = get_posts( array(
        "post_type" => "financial",
        "posts_per_page" => -1,
        "post_status" => "any",
        'date_query' => array(
            array(
                'after'   => '-1 month',
            ),
        ),
    ) );

    $all_price = 0;
    $all_income = 0;
    $tech_Income = 0;
    $reward = 0;
    $penalty = 0;
    $wallet_charge_tech = 0;

    $i = 0;
    foreach($financial as $item) {
        $i++;
        $uid = get_post_meta($item->ID, "order_id", true);
        $customer_id = get_post_meta($item->ID, "customer_id", true);
        $price_customer = get_post_meta($item->ID, "price_customer", true);
        $wallet = get_post_meta($item->ID, "wallet", true);
        $wallet_pay = get_post_meta($item->ID, "wallet_pay", true);
        $refid = get_post_meta($item->ID, "refid", true);
        $cost_price = get_post_meta($item->ID, "cost_price", true);
        $total_invoice = get_post_meta($item->ID, "total_invoice", true);
        $order_id = get_post_meta($item->ID, "order_id", true);


        $payment_status = get_post_meta($item->ID,"payment_status",true);
        $reward_type = get_post_meta($item->ID,"reward_type",true);
        $rewardDesc = get_post_meta($item->ID,"rewardDesc",true);
        $customer = get_post_meta($uid,"customer",true);
        $customer_first_name = get_user_meta($customer,"first_name",true);
        $sub_customer = + $customer + 10000;
        $author = $item->post_author;
        $percent = get_user_meta($author,"percent",true);

        $tech_firstname = get_user_meta($item->post_author,"first_name",true);


        if($reward_type == 1){
            $total_invoice = convert2english($total_invoice);
            if($total_invoice == '' || empty($total_invoice)){$total_invoice = 0;}

            $reward = +$reward + $total_invoice;
        }
        if($reward_type == "0"){
            $total_invoice = convert2english($total_invoice);
            $penalty = + $penalty + $total_invoice;
        }
        if($wallet == 1){

            $wallet_charge_tech = +$wallet_charge_tech + $wallet_pay;
        }
        if($reward_type == "" && $wallet == ""){
            $total_invoice_customer = ($total_invoice / 100) * $percent;
            $total_invoice_co = $total_invoice - $total_invoice_customer;
            $all_income = +$all_income + $total_invoice;
            $all_price = + $all_price + $total_invoice + $cost_price;
            $tech_Income = +$tech_Income + $total_invoice_co;
        }


    }

    return array(
        "all_price" => $all_price,
        "all_income" => $all_income,
        "tech_Income" => $tech_Income,
        "reward" => $reward,
        "penalty" => $penalty,
        "wallet_charge_tech" => $wallet_charge_tech,
    );


}

function loadAllDataFinَUser($uid){

    $financial = get_posts( array(
        "post_type" => "financial",
        "posts_per_page" => -1,
        "post_status" => "any",
        "author" => $uid,
    ) );
    $temp_per = get_user_meta($uid,"percent",true);
    $percent = get_user_meta($uid,"percent",true);
    $type_of_calc_tech = get_user_meta($uid,"type_of_calc_tech",true);
    $tech_per_of_all = get_user_meta($uid,"tech_per_of_all",true);
    $all_price = 0;
    $all_income = 0;
    $tech_Income = 0;
    $reward = 0;
    $penalty = 0;
    $wallet_charge_tech = 0;

    $i = 0;
    foreach($financial as $item) {
        $i++;
        $uid = get_post_meta($item->ID, "order_id", true);
        $status = get_post_meta($uid,"status",true);
        
        if($status == 10){
            $percent = 100;
        }else{
            $percent = $temp_per;
        }
        
        $wallet = get_post_meta($item->ID, "wallet", true);
        $wallet_pay = get_post_meta($item->ID, "wallet_pay", true);
        $cost_price = get_post_meta($item->ID, "cost_price", true);
        $total_invoice = get_post_meta($item->ID, "total_invoice", true);
        $reward_type = get_post_meta($item->ID,"reward_type",true);
        $customer = get_post_meta($uid,"customer",true);
        if($reward_type == 1){
            $total_invoice = convert2english($total_invoice);
            if($total_invoice == '' || empty($total_invoice)){$total_invoice = 0;}

            $reward = +$reward + $total_invoice;
        }
        if($reward_type == "0"){
            $total_invoice = convert2english($total_invoice);
            $penalty = + $penalty + $total_invoice;
        }
        if($wallet == 1){

            $wallet_charge_tech = +$wallet_charge_tech + $wallet_pay;
        }
        if($reward_type == "" && $wallet == ""){

            if($type_of_calc_tech == 1){

                $tech_per = 1 - ($tech_per_of_all / 100);
                $all_income = +$all_income + $total_invoice;
                $all_price = + $all_price + $total_invoice + $cost_price;
                $total_invoice_co = ($total_invoice + $cost_price) - (($total_invoice + $cost_price) * $tech_per);
                $tech_Income = +$tech_Income + $total_invoice_co;
            }else{


            
            $total_invoice_customer = ($total_invoice / 100) * $percent;
            $total_invoice_co = $total_invoice - $total_invoice_customer;
            $all_income = +$all_income + $total_invoice;
            $all_price = + $all_price + $total_invoice + $cost_price;
            $tech_Income = +$tech_Income + $total_invoice_co;
            }
        }
    }
    $tech_total_debt =  (+$wallet_charge_tech + $reward) - $penalty;
    $total_tech_total_debt = +$tech_total_debt - $tech_Income;

    return $total_tech_total_debt;


}

function loadAllDataFinInternal(){

    $financial = get_posts( array(
        "post_type" => "financial_internal",
        "posts_per_page" => -1,
        "post_status" => "any",
    ) );

    $all_price = 0;
    $all_income = 0;
    $tech_Income = 0;
    $reward = 0;
    $penalty = 0;
    $wallet_charge_tech = 0;

    $i = 0;
    foreach($financial as $item) {
        $i++;
        $uid = get_post_meta($item->ID, "order_id", true);
        $customer_id = get_post_meta($item->ID, "customer_id", true);
        $price_customer = get_post_meta($item->ID, "price_customer", true);
        $wallet = get_post_meta($item->ID, "wallet", true);
        $wallet_pay = get_post_meta($item->ID, "wallet_pay", true);
        $refid = get_post_meta($item->ID, "refid", true);
        $cost_price = get_post_meta($item->ID, "cost_price", true);
        $total_invoice = get_post_meta($item->ID, "total_invoice", true);
        $order_id = get_post_meta($item->ID, "order_id", true);


        $payment_status = get_post_meta($item->ID,"payment_status",true);
        $reward_type = get_post_meta($item->ID,"reward_type",true);
        $rewardDesc = get_post_meta($item->ID,"rewardDesc",true);
        $customer = get_post_meta($uid,"customer",true);
        $customer_first_name = get_user_meta($customer,"first_name",true);
        $sub_customer = + $customer + 10000;
        $author = $item->post_author;
        $percent = get_user_meta($author,"percent",true);

        $tech_firstname = get_user_meta($item->post_author,"first_name",true);


        if($reward_type == 1){
            $total_invoice = convert2english($total_invoice);
            if($total_invoice == '' || empty($total_invoice)){$total_invoice = 0;}

            $reward = +$reward + $total_invoice;
        }
        if($reward_type == "0"){
            $total_invoice = convert2english($total_invoice);
            $penalty = + $penalty + $total_invoice;
        }
        if($wallet == 1){

            $wallet_charge_tech = +$wallet_charge_tech + $wallet_pay;
        }
        if($reward_type == "" && $wallet == ""){
            $total_invoice_customer = ($total_invoice / 100) * $percent;
            $total_invoice_co = $total_invoice - $total_invoice_customer;
            $all_income = +$all_income + $total_invoice;
            $all_price = + $all_price + $total_invoice + $cost_price;
            $tech_Income = +$tech_Income + $total_invoice_customer;
        }


    }

    return array(
        "all_price" => $all_price,
        "all_income" => $all_income,
        "tech_Income" => $tech_Income,
        "reward" => $reward,
        "penalty" => $penalty,
        "wallet_charge_tech" => $wallet_charge_tech,
    );


}
function loadAllDataFinInternalMontly(){

    $financial = get_posts( array(
        "post_type" => "financial_internal",
        "posts_per_page" => -1,
        "post_status" => "any",
        'date_query' => array(
            array(
                'after'   => '-1 month',
            ),
        ),
    ) );

    $all_price = 0;
    $all_income = 0;
    $tech_Income = 0;
    $reward = 0;
    $penalty = 0;
    $wallet_charge_tech = 0;

    $i = 0;
    foreach($financial as $item) {
        $i++;
        $uid = get_post_meta($item->ID, "order_id", true);
        $customer_id = get_post_meta($item->ID, "customer_id", true);
        $price_customer = get_post_meta($item->ID, "price_customer", true);
        $wallet = get_post_meta($item->ID, "wallet", true);
        $wallet_pay = get_post_meta($item->ID, "wallet_pay", true);
        $refid = get_post_meta($item->ID, "refid", true);
        $cost_price = get_post_meta($item->ID, "cost_price", true);
        $total_invoice = get_post_meta($item->ID, "total_invoice", true);
        $order_id = get_post_meta($item->ID, "order_id", true);

        $invoice_descripotion = get_post_meta($uid,"invoice_descripotion",true);


        $payment_status = get_post_meta($item->ID,"payment_status",true);
        $reward_type = get_post_meta($item->ID,"reward_type",true);
        $rewardDesc = get_post_meta($item->ID,"rewardDesc",true);
        $customer = get_post_meta($uid,"customer",true);
        $customer_first_name = get_user_meta($customer,"first_name",true);
        $sub_customer = + $customer + 10000;
        $author = $item->post_author;
        $percent = get_user_meta($author,"percent",true);

        $tech_firstname = get_user_meta($item->post_author,"first_name",true);


        if($reward_type == 1){
            $total_invoice = convert2english($total_invoice);
            if($total_invoice == '' || empty($total_invoice)){$total_invoice = 0;}

            $reward = +$reward + $total_invoice;
        }
        if($reward_type == "0"){
            $total_invoice = convert2english($total_invoice);
            $penalty = + $penalty + $total_invoice;
        }
        if($wallet == 1){

            $wallet_charge_tech = +$wallet_charge_tech + $wallet_pay;
        }
        if($reward_type == "" && $wallet == ""){
            $total_invoice_customer = ($total_invoice / 100) * $percent;
            $total_invoice_co = $total_invoice - $total_invoice_customer;
            $all_income = +$all_income + $total_invoice;
            $all_price = + $all_price + $total_invoice + $cost_price;
            $tech_Income = +$tech_Income + $total_invoice_customer;
        }


    }

    return array(
        "all_price" => $all_price,
        "all_income" => $all_income,
        "tech_Income" => $tech_Income,
        "reward" => $reward,
        "penalty" => $penalty,
        "wallet_charge_tech" => $wallet_charge_tech,
    );


}

function loadAllDataFinَUserinternal($uid){

    $financial = get_posts( array(
        "post_type" => "financial_internal",
        "posts_per_page" => -1,
        "post_status" => "any",
        "author" => $uid,
    ) );
    $percent = get_user_meta($uid,"percent",true);
    $all_price = 0;
    $all_income = 0;
    $tech_Income = 0;
    $reward = 0;
    $penalty = 0;
    $wallet_charge_tech = 0;

    $i = 0;
    foreach($financial as $item) {
        $i++;
        $uid = get_post_meta($item->ID, "order_id", true);
        $wallet = get_post_meta($item->ID, "wallet", true);
        $wallet_pay = get_post_meta($item->ID, "wallet_pay", true);
        $cost_price = get_post_meta($item->ID, "cost_price", true);
        $total_invoice = get_post_meta($item->ID, "total_invoice", true);
        $reward_type = get_post_meta($item->ID,"reward_type",true);
        $customer = get_post_meta($uid,"customer",true);
        if($reward_type == 1){
            $total_invoice = convert2english($total_invoice);
            if($total_invoice == '' || empty($total_invoice)){$total_invoice = 0;}

            $reward = +$reward + $total_invoice;
        }
        if($reward_type == "0"){
            $total_invoice = convert2english($total_invoice);
            $penalty = + $penalty + $total_invoice;
        }
        if($wallet == 1){

            $wallet_charge_tech = +$wallet_charge_tech + $wallet_pay;
        }
        if($reward_type == "" && $wallet == ""){
            $total_invoice_customer = ($total_invoice / 100) * $percent;
            $total_invoice_co = $total_invoice - $total_invoice_customer;
            $all_income = +$all_income + $total_invoice;
            $all_price = + $all_price + $total_invoice + $cost_price;
            $tech_Income = +$tech_Income + $total_invoice_co;
        }
    }
    $tech_total_debt =  (+$wallet_charge_tech + $reward) - $penalty;
    $total_tech_total_debt = +$tech_total_debt - $tech_Income;

    return $total_tech_total_debt;


}


// LoadDebtTechFinExternal
add_action( 'wp_ajax_LoadDebtTechFinExternal', 'LoadDebtTechFinExternal' );
if( !function_exists('LoadDebtTechFinExternal') ):
    function LoadDebtTechFinExternal(){

        $data = loadAllDataFin();
        $all_price = $data["all_price"];
        $all_income = $data["all_income"];
        $tech_Income = $data["tech_Income"];
        $reward = $data["reward"];
        $penalty = $data["penalty"];
        $wallet_charge_tech = $data["wallet_charge_tech"];
        $tech_total_debt =  (+$wallet_charge_tech + $reward) - $penalty;
        $total_tech_total_debt = +$tech_total_debt - $tech_Income;
        if($total_tech_total_debt > 0){
            $fin_tech= $total_tech_total_debt;
        }else{
            $total_tech_total_debt = $total_tech_total_debt * -1;
            $fin_tech= $total_tech_total_debt;
        }

        print json_encode(array("status" => true , "message" => number_format($fin_tech)));
        exit();

    }
endif;


// LoadDebtTechFinExternal
add_action( 'wp_ajax_LoadDebtTechFinInternal', 'LoadDebtTechFinInternal' );
if( !function_exists('LoadDebtTechFinInternal') ):
    function LoadDebtTechFinInternal(){

        $data = loadAllDataFinInternal();
        $all_price = $data["all_price"];
        $all_income = $data["all_income"];
        $tech_Income = $data["tech_Income"];
        $reward = $data["reward"];
        $penalty = $data["penalty"];
        $wallet_charge_tech = $data["wallet_charge_tech"];
        $tech_total_debt =  (+$wallet_charge_tech + $reward) - $penalty;
        $total_tech_total_debt = +$tech_total_debt - $tech_Income;
        if($total_tech_total_debt > 0){
            $fin_tech= $total_tech_total_debt;
        }else{
            $total_tech_total_debt = $total_tech_total_debt * -1;
            $fin_tech= $total_tech_total_debt;
        }

        print json_encode(array("status" => true , "message" => number_format($fin_tech)));
        exit();

    }
endif;



add_action( 'wp_ajax_MoveTOTrash', 'MoveTOTrash' );
if( !function_exists('MoveTOTrash') ):
    function MoveTOTrash(){

        $id = $_POST["id"];
        $order_id = get_post_meta($id,'order_id',true);

        $post = get_post($id);
        $post_type = $post->post_type.'_trash';

        $update = wp_update_post(array(
            "ID" =>  $id,
            "post_type" => $post_type,
        ));


        $post_order = get_post($id);
        $post_order_type = $post_order->post_type.'_trash';

        $message = "حذف سند حسابداری";
        $content = 'سند حسابداری حذف شد' ;
        $subject = "حذف سند حسابداری";
        $status_title = "حذف سند حسابداری";
        $addContent = addStatusDescription($order_id,$subject,$content,get_current_user_id(),jdate("Y/m/d H:i"),$status_title);


        $update = wp_update_post(array(
            "ID" =>  $id,
            "post_type" => $post_order_type,
        ));
//        if($update){
            print json_encode(array("status" => true , "message" => "انتقال به زباله دان با موفقیت انجام شد" ));
            exit();
//        }else{
//            print json_encode(array("status" => false , "message" => "خطا! لطفا مجدد چک نمایید." ));
//            exit();
//        }


    }
endif;


add_action( 'wp_ajax_editFinancialInvoiceAjax', 'editFinancialInvoiceAjax' );
if( !function_exists('editFinancialInvoiceAjax') ):
    function editFinancialInvoiceAjax(){

        $oid = $_POST["oid"];
        $price_customer = $_POST["price_customer"];
        $cost_price = $_POST["cost_price"];
        $total_invoice = $_POST["total_invoice"];
        $invoice_descripotion= $_POST["invoice_descripotion"];
        if($invoice_descripotion == ''){
        $order_id = get_post_meta($oid,"order_id",true);
        $update = update_post_meta($oid,"cost_price",$cost_price);
        $update = update_post_meta($oid,"total_invoice",$total_invoice);
        $update = update_post_meta($order_id,"cost_price",$cost_price);
        $update = update_post_meta($order_id,"total_invoice",$total_invoice);
        }else{
            $update = update_post_meta($oid,"invoice_descripotion",$invoice_descripotion);
        }
        print json_encode(array("status" => true , "message" => "ویرایش با موفقیت انجام شد" ));
        exit();


    }
endif;

add_action( 'wp_ajax_editFinanciaDescriptionAjax', 'editFinanciaDescriptionAjax' );
if( !function_exists('editFinanciaDescriptionAjax') ):
    function editFinanciaDescriptionAjax(){

        $oid = $_POST["oid"];
        $invoice_descripotion = $_POST["invoice_descripotion"];

        $update = update_post_meta($oid,"invoice_descripotion",$invoice_descripotion);
        print json_encode(array("status" => true , "message" => "ویرایش با موفقیت انجام شد" ));
        exit();


    }
endif;

add_action( 'wp_ajax_editFinancialWalletAjax', 'editFinancialWalletAjax' );
if( !function_exists('editFinancialWalletAjax') ):
    function editFinancialWalletAjax(){

        $oid = $_POST["oid"];
        $wallet_pay = $_POST["wallet_pay"];
        $update = update_post_meta($oid,"wallet_pay",$wallet_pay);
        print json_encode(array("status" => true , "message" => "ویرایش با موفقیت انجام شد" ));
        exit();


    }
endif;

add_action( 'wp_ajax_EditFinancialAjax', 'EditFinancialAjax' );
if( !function_exists('EditFinancialAjax') ):
    function EditFinancialAjax(){

        $id = $_POST["id"];
        $reward_type = get_post_meta($id,"reward_type",true);
        $wallet = get_post_meta($id,"wallet",true);
        $price_customer = get_post_meta($id,"price_customer",true);
        $cost_price = get_post_meta($id,"cost_price",true);
        $total_invoice = get_post_meta($id,"total_invoice",true);
        $wallet_pay = get_post_meta($id,"wallet_pay",true);
        $invoice_descripotion = get_post_meta($id,"invoice_descripotion",true);
        if($reward_type == 1){

        }
        if($reward_type == "0"){

        }
        if($wallet == 1){
            $return = '
                <form action="#" id="FinancialWalletEdit">
                    <input type="hidden" id="oid" value="'.$id.'">
                    <h2>ویرایش شارژ کیف پول</h2>
                    <div class="form-group">
                        <label>کل صورتحساب</label>
                        <input type="text" class="form-control" id="wallet_pay" value="'.$wallet_pay.'">
                    </div>
                 
                    <input type="submit" class="btn" value="ذخیره">
                </form>
            ';
        }
        if($reward_type == "" && $wallet == ""){

            $return = '
                <form action="#" id="FinancialInvoiceEdit">
                    <input type="hidden" id="oid" value="'.$id.'">
                    <h2>ویرایش فاکتور</h2>
                    <div class="form-group" >
                        <label> ویرایش متن فاکتور ارسالی برای مشتری </label>
                         <textarea class="form-control" id="invoice_descripotion">'.$invoice_descripotion.'</textarea>
                    </div>
                    <input type="submit" class="btn" value="ارسال مجدد فاکتور">
                </form>
            ';

        }

        print json_encode(array("status" => true , "message" => $return ));
        exit();
    }
endif;


//filter_financial_list

add_action('wp_ajax_filter_financial_list', 'filter_financial_list_callback');
add_action('wp_ajax_nopriv_filter_financial_list', 'filter_financial_list_callback');

function filter_financial_list_callback() {
    // دریافت اطلاعات تاریخ از درخواست Ajax
    $start_date = isset($_POST['start_date']) ? sanitize_text_field($_POST['start_date']) : '';
    $end_date = isset($_POST['end_date']) ? sanitize_text_field($_POST['end_date']) : '';

    // تبدیل تاریخ‌ها به فرمت مناسب برای استفاده در query
    $start_timestamp = strtotime($start_date);
    $end_timestamp = strtotime($end_date);

    // تنظیمات query برای دریافت پست‌ها بر اساس تاریخ
    $args = array(
        'post_type' => 'financial',
        'posts_per_page' => -1,
        'post_status' => 'any',
        'author' => get_current_user_id(),
        'date_query' => array(
            array(
                'after'     => date('Y-m-d', $start_timestamp),
                'before'    => date('Y-m-d', $end_timestamp),
                'inclusive' => true,
            ),
        ),
        'meta_query' => array(
            array(
                'key' => 'payment_status',
                'value' => '3',
                'compare' => '!=',
            )
        )
    );

    $financial_posts = get_posts($args);

    if($financial_posts) {
        foreach($financial_posts as $item) {
            // کد HTML برای نمایش هر آیتم
            $uid = get_post_meta($item->ID, "order_id", true);
            $action_status = '<span class="action_status">وضعیت سفارش</span>'; // برای مثال
            echo '
                <ul class="list_of_data show_horizental">
                    <li>' . $uid . '</li>
                    <li>' . $action_status . '</li>
                    <!-- باقی فیلدهای مالی و اطلاعات دیگر اینجا -->
                </ul>
            ';
        }
    } else {
        echo '<p>هیچ نتیجه‌ای یافت نشد.</p>';
    }

    wp_die(); // پایان درخواست Ajax
}



add_action('wp_ajax_filter_financial_data', 'filter_financial_data_callback');
add_action('wp_ajax_nopriv_filter_financial_data', 'filter_financial_data_callback');

function filter_financial_data_callback() {
    global $wpdb;

    // بررسی داده‌های ارسال شده
    $filter = isset($_POST['filter']) ? sanitize_text_field($_POST['filter']) : 'all';
    $start_date = isset($_POST['start_date']) ? sanitize_text_field($_POST['start_date']) : '';
    $end_date = isset($_POST['end_date']) ? sanitize_text_field($_POST['end_date']) : '';

    // آماده‌سازی کوئری
    $args = array(
        'post_type' => 'financial',
        'post_status' => 'publish',
        'posts_per_page' => -1,
    );

    if ($filter === 'today') {
        $args['date_query'] = array(
            array(
                'year' => date('Y'),
                'month' => date('m'),
                'day' => date('d'),
            ),
        );
    } elseif ($filter === 'week') {
        $args['date_query'] = array(
            array(
                'after' => date('Y-m-d', strtotime('monday this week')),
                'before' => date('Y-m-d', strtotime('sunday this week')),
                'inclusive' => true,
            ),
        );
    } elseif ($filter === 'month') {
        $args['date_query'] = array(
            array(
                'year' => date('Y'),
                'month' => date('m'),
            ),
        );
    } elseif ($filter === 'custom_date' && !empty($start_date) && !empty($end_date)) {
        $args['date_query'] = array(
            array(
                'after' => $start_date,
                'before' => $end_date,
                'inclusive' => true,
            ),
        );
    }

    // اجرای کوئری
    $query = new WP_Query($args);

    if ($query->have_posts()) {
        ob_start();
        while ($query->have_posts()) {
            $query->the_post();
            echo '<div class="financial-item">';
            echo '<h3>' . get_the_title() . '</h3>';
            echo '<p>تاریخ: ' . get_the_date('Y/m/d') . '</p>';
            echo '</div>';
        }
        wp_reset_postdata();
        wp_send_json(ob_get_clean());
    } else {
        wp_send_json('<p>هیچ سفارشی یافت نشد.</p>');
    }

    wp_die();
}
