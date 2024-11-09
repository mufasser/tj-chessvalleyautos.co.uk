<?php

add_action( 'wp_ajax_mi_complete_valuation_action', 'mi_complete_valuation_action' );
add_action( 'wp_ajax_nopriv_mi_complete_valuation_action', 'mi_complete_valuation_action' );

function mi_complete_valuation_action() {

    $response = [
        "status" => false,
        "msg" => "Security check failed",
        'vehicleImageInfo'=> [],
        'vehicleInfo' => []
    ];
    
    // $nonce = sanitize_text_field($_POST['nonce']);
    $nonce = sanitize_text_field($_POST['nonce']);
    if ( ! wp_verify_nonce( $nonce, 'uk-vehicle-nonce' ) ) {
        die(json_encode($response));
    }else{
        $metadata = $_POST['metadata'];

        $vehiclePlateNumber = sanitize_text_field($_POST['vehicle_plate_number']);
        $userType = sanitize_text_field($_POST['user_type']);
        $firstName = sanitize_text_field($_POST['first_name']);
        $lastName = sanitize_text_field($_POST['last_name']);
        $email = sanitize_text_field($_POST['email']);
        // $postcode = sanitize_text_field($_POST['postcode']);
        $phone = sanitize_text_field($_POST['phone']);
        $phoneType = sanitize_text_field($_POST['phone_type']);
        
        

        $vehiclePoorPrice = sanitize_text_field($_POST['vehiclePoorPrice']);
        $vehicleAveragePrice = sanitize_text_field($_POST['vehicleAveragePrice']);

        $vehicleFullName = sanitize_text_field($_POST['vehicleFullName']);
        $vehicleImage = sanitize_text_field($_POST['vehicleImage']);
        $partExchange = sanitize_text_field($_POST['partExchange']);

       
        


        $html = "<div>First Name: $userType. $firstName</div>";
        $html .= "<div>Last Name: $lastName</div>";
        $html .= "<div>Email: $email</div>";
        // $html .= "<div>Postcode: $postcode</div>";
        $html .= "<div>Phone: $phone</div>";
        $html .= "<div>Phone Type: $phoneType</div>";
        $html .= "<br>";
        $html .= "<br>";
        $html .= "<table>";
            $html .= "<thead><tr><th>Name</th><th>Value</th></tr></thead>";
            $html .= '<tbody>';

  
            // $engine = $metadata['vdata']['generalData']['Engine'];   
            // $electricVehicleBattery = $metadata['vdata']['generalData']['ElectricVehicleBattery'];   

            // $technicalDetails = $metadata['vdata']['technicalDetails'];
            // $consumption = $metadata['vdata']['technicalDetails']['Consumption'];
            // $dimensions = $metadata['vdata']['technicalDetails']['Dimensions'];
            // $safety = $metadata['vdata']['technicalDetails']['Safety'];
            // $performance = $metadata['vdata']['technicalDetails']['Performance'];
            // $smmtDetails = $metadata['vdata']['smmtDetails'];
            
            
            // $html .= prepareTable($engine, "Engine");
            // $html .= prepareTable($vehicleRegistration, "Vehicle Registration");
            
            $vehicleRegistration = $metadata['vdata']['vehicleRegistration'];
            // echo json_encode($vehicleRegistration);

            $color = $vehicleRegistration['Colour'];
            $vehicleClass = $vehicleRegistration['VehicleClass'];
            $model = $vehicleRegistration['Model'];
            $makeModel = $vehicleRegistration['MakeModel'];
            $make = $vehicleRegistration['Make'];
            $vrm = $vehicleRegistration['Vrm'];
            $yearMonthFirstRegistered = $vehicleRegistration['YearMonthFirstRegistered'];
            $fuelType = $vehicleRegistration['FuelType'];
            $transmissionType = $vehicleRegistration['TransmissionType'];


            $html .= '<tr><td colspan="2"><h3>Vehicle Information</h3></td></tr>';

            $html .= "<tr><td>Colour</td><td>$color</td></tr>";
            $html .= "<tr><td>Vehicle Class</td><td>$vehicleClass</td></tr>";
            $html .= "<tr><td>Model</td><td>$model</td></tr>";
            $html .= "<tr><td>Make Model</td><td>$makeModel</td></tr>";
            $html .= "<tr><td>Make </td><td>$make</td></tr>";
            $html .= "<tr><td>VRM</td><td>$vrm</td></tr>";
            $html .= "<tr><td>Year Month First Registered</td><td>$yearMonthFirstRegistered</td></tr>";
            $html .= "<tr><td>FuelT ype</td><td>$fuelType</td></tr>";
            $html .= "<tr><td>Transmission Type</td><td>$transmissionType</td></tr>";
            
            
            
            $html .= '<tr><td colspan="2"><h3>Valuation Information</h3></td></tr>';
            $valuationData = $metadata['valuationData'];
            $vrm = $valuationData['Vrm'];
            $mileage = $valuationData['Mileage'];
            $plateYear = $valuationData['PlateYear'];

            $valuationList = $valuationData['ValuationList'];
            $otr = $valuationList['OTR'];
            $dealerForecourt = $valuationList['DealerForecourt'];
            $tradeRetail = $valuationList['TradeRetail'];
            $privateClean = $valuationList['PrivateClean'];
            $privateAverage = $valuationList['PrivateAverage'];
            $auction = $valuationList['Auction'];

            $partExchange = $valuationList['PartExchange'];
            $tradeAverage = $valuationList['TradeAverage'];
            $tradePoor = $valuationList['TradePoor'];
            

            $html .= "<tr><td>Mileage</td><td>$mileage</td></tr>";
            $html .= "<tr><td>Plate Year</td><td>$plateYear</td></tr>";
            $html .= "<tr><td>Vrm</td><td>$vrm</td></tr>";
            $html .= "<tr><td>OTR</td><td>$otr</td></tr>";


            $html .= "<tr><td>DealerForecourt</td><td>$dealerForecourt</td></tr>";
            $html .= "<tr><td>TradeRetail</td><td>$tradeRetail</td></tr>";
            $html .= "<tr><td>PrivateClean</td><td>$privateClean</td></tr>";
            $html .= "<tr><td>PrivateAverage</td><td>$privateAverage</td></tr>";
            $html .= "<tr><td>PartExchange</td><td>$partExchange</td></tr>";
            $html .= "<tr><td>Auction</td><td>$auction</td></tr>";
            $html .= "<tr><td>TradeAverage</td><td>$tradeAverage</td></tr>";
            $html .= "<tr><td>TradePoor</td><td>$tradePoor</td></tr>";


            $data['color'] =  $color;
            $data['vehicleClass'] =  $vehicleClass;
            $data['model'] =  $model;
            $data['yearMonthFirstRegistered'] =  $yearMonthFirstRegistered;
            $data['fuelType'] =  $fuelType;
            $data['makeModel'] =  $makeModel;
            $data['transmissionType'] =  $transmissionType;

            $data['mileage'] =  $mileage;
            $data['plateYear'] =  $plateYear;
            $data['vrm'] =  $vrm;
            $data['otr'] =  $otr;
            $data['dealerForecourt'] =  $dealerForecourt;
            $data['privateClean'] =  $privateClean;
            $data['privateAverage'] =  $privateAverage;
            $data['partExchange'] =  $partExchange;
            $data['auction'] =  $auction;
            $data['tradeRetail'] =  $tradeRetail;
            $data['tradeAverage'] =  $tradeAverage;
            $data['tradePoor'] =  $tradePoor;


             // save custom
        $postData = [
            'vehicleImage' => $vehicleImage,
            'vehicleFullName' => $vehicleFullName,
            'vehiclePlateNumber' => $vehiclePlateNumber,

            'vehicleAveragePrice' => $vehicleAveragePrice,
            'vehiclePoorPrice' => $vehiclePoorPrice,
            'vehiclePartExchangePrice' => $partExchange,
            
            'userType' => $userType,
            'firstName' => $firstName,
            'lastName' => $lastName,
            'email' => $email,
            'phone' => $phone,
            'phoneType' => $phoneType,
            'next_step' => ''
        ];

            $updatedPrices = getPercentages($tradePoor, $tradeAverage);
            $postData['vehiclePartExchangePrice'] = $updatedPrices['new_poor_price'];
            $partExchange = $updatedPrices['new_poor_price'];
            $data['partExchange'] = $updatedPrices['new_poor_price'];
            $data['tradePoor'] = $updatedPrices['new_poor_price'];

            $postData['vehiclePoorPrice'];
            $tradePoor = $updatedPrices['new_average_price'];;
            $data['tradeAverage'] = $updatedPrices['new_average_price'];
            // $data['tradeAverage'] = $updatedPrices['new_poor_price'];
            
            // print_r($postData); exit;
            // print_r($updatedPrices); exit;

            $post_id = saveVehicleValuation($postData);


            $customerMessage = '<div style="text-align:center">';
            $customerMessage .= '<img src="https://www.sellmycartoday.uk/smc/wp-content/uploads/2021/04/smctl.png" width="250">';
            $customerMessage .= "</div>";

            $customerMessage .= '<div style="text-align:center">';
            $customerMessage .= '<h3>Free instant payment and home visits available</h3>';
            $customerMessage .= "<br><hr><br>";
            $customerMessage .= "</div>";

            $customerMessage .= '<div style="text-align:center">';
            $customerMessage .= 'Dear '.$firstName.' '.$lastName.',<br><br>';

            $customerMessage .= '<p style="text-align:center">We recently valued your car at<br>
            Good Condition: <b>£'.$data['tradeAverage'].'</b><br>
            Average Condition: <b>£'.$data['tradePoor'].'</b><br>
            Sell your car in under an hour with a free home visit.<br>
            7 days price guarantee - <br>
            <h3></h3>Book your</h3>
            <b>Appointment Now!</b><br>
            Please call us directly on <a href="tel:+443337729283">03337 729 283</a>.</p>';
            $customerMessage .= "</div>";

            $html .= '</tbody>';
        $html .= "</table>";


        // Admin Email
        $adminEmail = 'tj@chessvalleyautos.co.uk';
        // $adminEmail = 'mufasseri@gmail.com';
        $emailResponse =  mi_send_email($adminEmail,"$vehiclePlateNumber - Valuation", $html);
        // Customer Email 
        $emailResponse =  mi_send_email($email,"$vehiclePlateNumber - Valuation", $customerMessage);

        $response = [
            "emailResponse" => $emailResponse,
            "status" => true,
            "msg" => "Email Sent",
            'data'=> $data,
            'post_id' => $post_id,
            "html" => $html
        ];

    }
    die(json_encode($response));

}

function getPercentages($poorPrice, $averagePrice){
    
    $pageId = 356;
    $return = ['poor_price' => $poorPrice, 'new_poor_price'=>$poorPrice, 'average_price'=>$averagePrice, 'new_average_price'=>$averagePrice];
    // poor
    $poorIncrementFor = get_field('field_645980d5cfe67',$pageId);
    $poorIncrementValue = (float) get_field('field_64597fe48e071',$pageId);
    $poorDecrementValue = (float) get_field('field_645980048e072',$pageId);

    switch($poorIncrementFor){
        case "Increment":
            $return['new_poor_price'] = $poorPrice + ($poorPrice * $poorIncrementValue)/100;
            
            break;
        case "Decrement":
            $return['new_poor_price'] = $poorPrice - ($poorPrice * $poorDecrementValue)/100;
            break;
        case "Decement":
            $return['new_poor_price'] = $poorPrice - ($poorPrice * $poorDecrementValue)/100;
            break;
    }
    $return['poor_price_action'] = $poorIncrementFor;
    

    // average
    $averageIncrementFor = get_field('field_645981951c80d',$pageId);
    $averageIncrementValue = get_field('field_645981b4edb68',$pageId);
    $averageDecrementValue = get_field('field_645981d0edb69',$pageId);
    // die($averageIncrementFor);
    switch($averageIncrementFor){
        case "Increment":
            $return['new_average_price'] = $averagePrice + ($averagePrice * $averageIncrementValue)/100;
            $return['average_price_action'] = 'Increment';
            break;
        case "Decrement":
            
            $return['new_average_price'] = $averagePrice - ($averagePrice * $averageDecrementValue)/100;
            $return['average_price_action'] = 'Decrement';
            break;
        case "Decement":
        
            $return['new_average_price'] = $averagePrice - ($averagePrice * $averageDecrementValue)/100;
            $return['average_price_action'] = 'Decrement';
            break;
    }
    
    
    return $return;
}


function saveVehicleValuation($data){

    
    //  echo json_encode($data); exit;
        // Create the post object
        $post_data = array(
          'post_title' => $data['vehicleFullName'],
          'post_status' => 'draft',
          'post_author' => get_current_user_id(),
          'post_type' => 'vehicle-variation'
        );
        
        // try{
        // Insert the post into the database
        $post_id = wp_insert_post( $post_data );
        // print_r($post_id); exit;
        
      
      
        // Saving in Advance Custom
        update_field( 'field_64485d1a90226', $data['vehicleImage'], $post_id); //vehicle_image
        update_field( 'field_64485d3490227', $data['vehicleFullName'], $post_id); // vehicle_full_name
        // Price 
        update_field( 'field_6455100772e7a', $data['vehiclePartExchangePrice'], $post_id); // vehicle_part_exchange_price
        update_field( 'field_64485d57e3710', $data['vehicleAveragePrice'], $post_id); // vehicle_average_price
        update_field( 'field_64485d65e3711', $data['vehiclePoorPrice'], $post_id); //vehicle_poor_price

        update_field( 'field_64485d71e3712', $data['userType'], $post_id); //user_type
        update_field( 'field_64485d8b2d01a', $data['firstName'], $post_id); //first_name
        update_field( 'field_64485d962d01b', $data['lastName'], $post_id); //last_name
        update_field( 'field_64485d9e2d01c', $data['email'], $post_id); //email
        update_field( 'field_64485da52d01d', $data['phone'], $post_id); //phone
        update_field( 'field_64485da92d01e', $data['phoneType'], $post_id); //phone_type
        update_field( 'field_64485dbb2d01f', $data['next_step'], $post_id); //next_step
      
        return $post_id;
        // Redirect to the newly created post
        // wp_redirect( get_permalink( $post_id ) );
    //   }
      
}

// update next step
add_action( 'wp_ajax_mi_complete_next_step_valuation_action', 'mi_complete_next_step_valuation_action' );
add_action( 'wp_ajax_nopriv_mi_complete_next_step_valuation_action', 'mi_complete_next_step_valuation_action' );

function mi_complete_next_step_valuation_action(){

    $response = [
        "status" => false,
        "msg" => "Security check failed",
    ];
    
    // $nonce = sanitize_text_field($_POST['nonce']);
    $nonce = sanitize_text_field($_POST['nonce']);
    if ( ! wp_verify_nonce( $nonce, 'uk-vehicle-last-step-nonce' ) ) {
        die(json_encode($response));
    }else{
        $post_id = sanitize_text_field($_POST['post_id']);
        $next_step = sanitize_text_field($_POST['contact_type']);
        $firstName = sanitize_text_field($_POST['first_name']);
        $lastName = sanitize_text_field($_POST['last_name']);
        // update_post_meta( $post_id, 'next_step', $next_step );
        update_field( 'field_64485dbb2d01f', $next_step, $post_id); //next_step
        $response = [
            "status" => true,
            "msg" => "Next step saved",
        ];

        // send email to admin to notify user finish his process.
        $subject = 'Last Step ';
        $message = 'Dear Admin,<br><br>';
        $message .= "$firstName $lastName wants to you contact to communicate  $next_step. you can view his car valuation information by <a href=\"https://www.chessvalleyautos.co.uk/wp-admin/post.php?post=$post_id&action=edit\">CLICK HERE</a>";
        $message .= "<br>Regards<br>".get_bloginfo('name');
        // mi_send_email('mufasseri@gmail.com', $subject, $message);
        mi_send_email('tj@chessvalleyautos.uk', $subject, $message);
    }
    die(json_encode($response));

}


function prepareTable($data, $heading){
    $html = '<tr><td colspan="2"><h3>'.$heading.'</h3></td></tr>';
    foreach ($data as $key => $value){
        $html .= "<tr><td>$key</td><td>$value</td></tr>";
    }
    return $html;
}

function mi_send_email($to, $subject, $message, $file_path=''){



    // Set the recipient email address
    // $to = 'recipient@example.com';

    // Set the subject line
    // $subject = 'Email with attachment';

    // From email
    $fromName = 'Chess Valley Autos';
    $fromEmail = 'info@chessvalleyautos.co.uk';

    // Set the email message
    // $message = 'Here is the attachment you requested.';

    if($file_path){
        // Set the attachment file path
        $file_path = '/path/to/attachment/file.pdf';

        // Get the file content and encode it for email
        $file_content = file_get_contents($file_path);
        $encoded_file_content = chunk_split(base64_encode($file_content));
    }
    // Set the email headers, including the attachment
    $headers = "From: $fromName <$fromEmail>\r\n";
    $headers .= "Reply-To: $fromEmail\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    if($file_path){
        $headers .= "Content-Type: multipart/mixed; boundary=\"boundary\"\r\n\r\n";
        $headers .= "--boundary\r\n";
        $headers .= "Content-Type: application/octet-stream; name=\"" . basename($file_path) . "\"\r\n";
        $headers .= "Content-Transfer-Encoding: base64\r\n";
        $headers .= "Content-Disposition: attachment; filename=\"" . basename($file_path) . "\"\r\n\r\n";
        $headers .= $encoded_file_content . "\r\n";
        $headers .= "--boundary\r\n";
    }

    // Send the email
    return wp_mail($to, $subject, $message, $headers);
    // return wp_mail("mufasseri@gmail.com", "my message for you", "this is car valuation report");

}

// set header html
function wpse27856_set_content_type(){
    return "text/html";
}
add_filter( 'wp_mail_content_type','wpse27856_set_content_type' );



add_action( 'wp_ajax_mi_get_vehicle_info_action', 'mi_get_vehicle_info_action' );
add_action( 'wp_ajax_nopriv_mi_get_vehicle_info_action', 'mi_get_vehicle_info_action' );

function mi_get_vehicle_info_action() {
    
    $response = [
        "status" => false,
        "msg" => "Security check failed",
        'vehicleImageInfo'=> [],
        'vehicleInfo' => []
    ];
    
    // $nonce = sanitize_text_field($_POST['nonce']);
    $nonce = $_POST['nonce'];
    
    if ( ! wp_verify_nonce( $nonce, 'uk-vehicle-nonce' ) ) {
        die(json_encode($response));
    }else{
        $vehicleNumber = sanitize_text_field($_POST['vehicle_plate_number']);
        $vehicleInformation = new VehicleInformation();

        $response['status'] = true;
        $response['msg'] = 'Security check passed.';

        // images
        $vehicleImageData = $vehicleInformation->vehicleImageData($vehicleNumber);
        $response['image']['status'] = $vehicleImageData['response']->Response->StatusCode;
        $response['image']['imageUrl'] = $vehicleImageData['response']->Response->DataItems->VehicleImages->ImageDetailsList[0]->ImageUrl;

        // vehicleData
        $vehicleImageData = $vehicleInformation->vehicleData($vehicleNumber);
        $response['vdata']['generalData'] = $vehicleImageData['response']->Response->DataItems->TechnicalDetails->General;
        $response['vdata']['status'] = $vehicleImageData['response']->Response->StatusCode;
        $response['vdata']['vehicleRegistration'] = $vehicleImageData['response']->Response->DataItems->VehicleRegistration;
        $response['vdata']['technicalDetails'] = $vehicleImageData['response']->Response->DataItems->TechnicalDetails;
        
        
        $valuationCanPrice = $vehicleInformation->valuationData($vehicleNumber);
        $response['valuationData'] = $valuationCanPrice['response']->Response->DataItems;




        // $response['vehicleImageInfo']['vdata']['vehicleClass'] = $vehicleImageData['response']->Response->DataItems->VehicleRegistration->VehicleClass;
        // $response['vehicleImageInfo']['vdata']['model'] = $vehicleImageData['response']->Response->DataItems->VehicleRegistration->Model;
        // $response['vehicleImageInfo']['vdata']['Vrm'] = $vehicleImageData['response']->Response->DataItems->VehicleRegistration->Vrm;
        // $response['vehicleImageInfo']['vdata']['ttransmissionType'] = $vehicleImageData['response']->Response->DataItems->VehicleRegistration->TransmissionType;
        // $response['vehicleImageInfo']['vdata']['FuelType'] = $vehicleImageData['response']->Response->DataItems->VehicleRegistration->FuelType;
        // $response['vehicleImageInfo']['vdata']['yearMonthFirstRegistered'] = $vehicleImageData['response']->Response->DataItems->VehicleRegistration->YearMonthFirstRegistered;
        // $response['vehicleImageInfo']['vdata']['vinLast5'] = $vehicleImageData['response']->Response->DataItems->VehicleRegistration->VinLast5;
        // $response['vehicleImageInfo']['vdata']['engineNumber'] = $vehicleImageData['response']->Response->DataItems->VehicleRegistration->EngineNumber;
        // $response['vehicleImageInfo']['vdata']['technicalDetails'] = $vehicleImageData['response']->Response->DataItems->TechnicalDetails;


        // 

        die(json_encode($response));
    }

}

// FTP
// QFi2((F)7N#O
// dev@sellmycartoday.uk