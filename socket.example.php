<pre><?php

/**
 * This is an example of how to connect to your local email server.
 * The variables set in the class should be adjusted to your own environment
 */

include("socket.class.php");

/*
function my_handler($request, $id)
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

$socket = Socket::singleton();
if( $socket )
{
	$socket->connect(host, port);
	$cmd = $_REQUEST['cmd'];
	
	if( $cmd != '' )
	{
		$socket->sendCmd( $cmd ) 
			
		$result = $socket->getResponse();			
		echo $result;
	}
}

*/

$socket = Socket::singleton();

$socket->connect('192.168.43.150', '25');

$socket->sendCmd("ELHO localhost"); // (email login)

$ret = $socket->getResponse(); // S: +OK Password required.
// S: +OK Hello there.
echo print_r( $ret );

exit;

$socket->sendCmd("USER email@server.com"); // (email login)
echo $socket->getResponse(); // S: +OK Password required.

$socket->sendCmd("PASS superSecretPassWoRd"); // (email password)
echo $socket->getResponse(); // S: +OK logged in.

$socket->sendCmd("STAT");
echo $socket->getResponse(); // S: +OK 0 0

$socket->sendCmd("QUIT");
echo $socket->getResponse(); // S: +OK Bye-bye.

?></pre>