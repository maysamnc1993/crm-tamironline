<?php


// brands
add_action( 'wp_ajax_brand', 'brand' );

if( !function_exists('brand') ):

    function brand(){


        $type_action = $_POST['type_action'];
        $uid = $_POST['uid'];
        $name = $_POST['name'];

        if($type_action == "add"){

            $add = wp_insert_term( $name, 'brand', array( 'slug' => $name ) );
            $status = true;
            $message = "برند با موفقیت ثبت گردید";

        }
        else if($type_action == "update"){

            $update = wp_update_term( $uid, 'brand', array(
                'name' => $name,
                'slug' => $name
            ) );

            $status = true;
            $message = "برند با موفقیت به روز رسانی شد.";
        }

        print json_encode(array("status" => $status , "message" => $message));
        exit();

    }
endif;

// device
add_action( 'wp_ajax_device', 'device' );

if( !function_exists('device') ):

    function device(){


        $type_action = $_POST['type_action'];
        $uid = $_POST['uid'];
        $name = $_POST['name'];

        if($type_action == "add"){

            $add = wp_insert_term( $name, 'device', array( 'slug' => $name ) );
            $status = true;
            $message = "دستگاه با موفقیت ثبت گردید";

        }
        else if($type_action == "update"){

            $update = wp_update_term( $uid, 'device', array(
                'name' => $name,
                'slug' => $name
            ) );

            $status = true;
            $message = "دستگاه با موفقیت به روز رسانی شد.";
        }

        print json_encode(array("status" => $status , "message" => $message));
        exit();

    }
endif;

// State
add_action( 'wp_ajax_state', 'state' );

if( !function_exists('state') ):

    function state(){


        $type_action = $_POST['type_action'];
        $uid = $_POST['uid'];
        $name = $_POST['name'];

        if($type_action == "add"){

            $add = wp_insert_term( $name, 'state', array( 'slug' => $name ) );
            $status = true;
            $message = "استان با موفقیت ثبت گردید";

        }
        else if($type_action == "update"){

            $update = wp_update_term( $uid, 'state', array(
                'name' => $name,
                'slug' => $name
            ) );

            $status = true;
            $message = "استان با موفقیت به روز رسانی شد.";
        }

        print json_encode(array("status" => $status , "message" => $message));
        exit();

    }
endif;

// city
add_action( 'wp_ajax_city', 'city' );

if( !function_exists('city') ):

    function city(){


        $type_action = $_POST['type_action'];
        $uid = $_POST['uid'];
        $name = $_POST['name'];

        if($type_action == "add"){

            $add = wp_insert_term( $name, 'city', array( 'slug' => $name ) );
            $status = true;
            $message = "شهر با موفقیت ثبت گردید";

        }
        else if($type_action == "update"){

            $update = wp_update_term( $uid, 'city', array(
                'name' => $name,
                'slug' => $name
            ) );

            $status = true;
            $message = "شهر با موفقیت به روز رسانی شد.";
        }

        print json_encode(array("status" => $status , "message" => $message));
        exit();

    }
endif;

?>