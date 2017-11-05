
  PrinceSocket is a Singleton Socket Class written in PHP that is useful for any application.  
  
  You can connect to virtually any socket application, troubleshoot network devices and more.
	
	Usage is very simple. 
  Instantiate the socket class and send the Device Command to it, 
  You will response back from the device or application that you were conneted to. 
	
	Let me demonstrate your simple way to communicate or troubleshoot a mail server using passing mail command to PrinceSocket.
	Note that the Mail server running on port 25.  (Change the port your mail server is running on }
	
	As a rule of thumb: Never connect to any network or server that you do not own without prior written approval.
	
	
	`$socket = PrinceSocket::Singleton();
	
	$socket->_Connect('smtp.domain.com', '25');
	
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
	echo $socket::getResponse();`
	

