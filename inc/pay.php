<?php

namespace saman{

 	class pay{
		
		function request($amount,$redirect,$merchant_id=MERCHANT_ID){

		    $resnum         = time();   # شماره سفارش
		    echo sprintf('<form action="https://sep.shaparak.ir/payment.aspx" method="post">
		                    <input type="hidden" name="Amount" value="%s" />
		                    <input type="hidden" name="ResNum" value="%s">
		                    <input type="hidden" name="RedirectURL" value="%s"/>
		                    <input type="hidden" name="MID" value="%s"/>
		                    <input type="submit" name="submit_payment" value="انتقال به درگاه پرداخت" class="Sep-submit"/>
		                </form>

		                <script type="text/javascript">
		                        window.onload = formSubmit; 
		                        function formSubmit() { document.forms[0].submit(); }
		                </script>
		          ', $amount,$resnum,$redirect,$merchant_id);
		}

		function  verify(){
		    if(req::post('State') == "OK"){

		        $soapclient =new \SoapClient('https://acquirer.samanepay.com/payments/referencepayment.asmx?WSDL');  
		        $res = $soapclient.VerifyTransaction(req::post('RefNum'), req::post('MID'));

		        if ($res <= 0 )
		            return  "Error {}".format($res);
		        else
		            return "The transaction was successful";

		    }
		}
	}

}


namespace zarinpal{

	class pay{

		function request($amount,$redirect,$merchant_id=MERCHANT_ID,$options=[])
		{
		    $dscr = $options['dscr'] or 'custom desciption...';  // Required
		    $email = $options['email']  or ''; // Optional
		    $mobile =$options['mobile'] or ''; // Optional

		    // URL also Can be https://ir.zarinpal.com/pg/services/WebGate/wsdl

		    $client = new \SoapClient('https://de.zarinpal.com/pg/services/WebGate/wsdl', 
		    						  ['encoding' => 'UTF-8']
		    						);

		    $result = $client->PaymentRequest(
		        array(
		            'MerchantID' => $merchant_id,
		            'Amount' => $amount,
		            'Description' => $dscr,
		            'Email' => $email,
		            'Mobile' => $mobile,
		            'CallbackURL' => $redirect
		        )
		    );

		    //Redirect to URL You can do it also by creating a form
		    if ($result->Status == 100) {
		        Header('Location: https://www.zarinpal.com/pg/StartPay/' . $result->Authority);
		    } else {

		        echo 'ERR: ' . $result->Status;
		    }
		}

		function verify($amount,$merchant_id=MERCHANT_ID)
		{

		    $authority = $_GET['Authority'];

		    if ($_GET['Status'] == 'OK') {
		        // URL also Can be https://ir.zarinpal.com/pg/services/WebGate/wsdl
		        $client = new \SoapClient('https://de.zarinpal.com/pg/services/WebGate/wsdl', array('encoding' => 'UTF-8'));

		        $result = $client->PaymentVerification(
		            array(
		                'MerchantID' => $merchant_id,
		                'Authority' => $authority,
		                'Amount' => $amount
		            )
		        );

		        if ($result->Status == 100) {
		            return true;
					// echo 'Transation success. RefID:' . $result->RefID;
		        } else {
		            return false;
					// echo 'Transation failed. Status:' . $result->Status;
		        }

		    } else {
		        return false;
				// echo 'Transaction canceled by user';
		    }
		}
	}

}