<?php

class crypt{

	private function crypt_action( $string, $action,$secret_key,$secret_iv) {
	    // you may change these values to your own
	 
	    $output = false;
	    $encrypt_method = "AES-256-CBC";
	    $key = hash( 'sha256', $secret_key );
	    $iv = substr( hash( 'sha256', $secret_iv ), 0, 16 );
	 
	    if( $action == 'e' ) {
	        $output = base64_encode( openssl_encrypt( $string, $encrypt_method, $key, 0, $iv ) );
	    }
	    else if( $action == 'd' ){
	        $output = openssl_decrypt( base64_decode( $string ), $encrypt_method, $key, 0, $iv );
	    }
	    return $output;
	}

	function encrypt($string,$secret_key = CRYPT_KEY,$secret_iv = CRYPT_IV){
			return self::crypt_action($string,'e',$secret_key = CRYPT_KEY,$secret_iv = CRYPT_IV);
	}

	function decrypt($string){
			return self::crypt_action($string,'d',$secret_key = CRYPT_KEY,$secret_iv = CRYPT_IV);
	}
	
}		