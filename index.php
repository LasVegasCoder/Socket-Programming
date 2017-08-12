<pre><?php

/**
 * This is an example of how to connect to your local email server.
 * The variables set in the class should be adjusted to your own environment
 *
 *  
 */

 define('PRINCE_SOCKET', 'active'); 
 include("PrinceSocket.Class.php");

/*
function reqHandler($request, $id)
{
    if (1 === preg_match('/quit|exit/i', $request)) {
        return null;
    }

    if (1 === preg_match('/stop|halt/i', $request)) {
        return false;
    }

    echo sprintf('*** Got "%s" from %d', $request, $id) . PHP_EOL;
    return $request . PHP_EOL;
}


$socket = PrinceSocket::Singleton();
if( $socket )
{
	$socket->_Connect( $host, $port )
	$cmd = isset( $_REQUEST['cmd'] ) && !empty ( $_REQUEST['cmd']) ) ?  trim($_REQUEST['cmd']) : '';
	
	if( $cmd != '' )
	{
		$socket::PrinceCMD( $cmd );
			
		$result = $socket::getResponse();	
		if( !empty($result) )
		{
			echo $result;
		}
	}
}

*/

$socket = PrinceSocket::Singleton();

if( $socket->_Connect('smtp.domain.com', '25') )
{
	//echo "connected";
	echo $socket::getResponse(); 
	
	$socket::PrinceCMD("helo hostname"); 
	echo $socket::getResponse(); 
	
	$socket::PrinceCMD("AUTH LOGIN"); 
	echo $socket::getResponse();  // #: Login to your email;
	
	//prepare your user and pass encoded in base64.
	
	$user = base64_encode ("user@domain.com");
	$pass = base64_encode ("YourPass");
	
	$socket::PrinceCMD( $user ); 
	echo $socket::getResponse(); // #: +OK Password required.
	
	$socket::PrinceCMD( $pass );
	echo $socket::getResponse(); // #: +OK logged in.
	
	$socket::PrinceCMD("MAIL FROM:<user@domain.com>");
	echo $socket::getResponse();
	
	$socket::PrinceCMD("RCPT TO: <yourvegasprince@gmail.com>");
	echo $socket::getResponse();
	
	$socket::PrinceCMD("RCPT TO: <yourvegasprince@gmail.com>");
	echo $socket::getResponse();
	
	$socket::PrinceCMD("DATA testing email");
	echo $socket::getResponse();
	
}
else {
	echo "Not connected \n\r";
	
	echo $socket->getResponse(); // S: +OK Password required.	
}

?>