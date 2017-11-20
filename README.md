
  	PrinceSocket is a Singleton Socket Class written in PHP.  PrinceSocket can connect to any socket application and more.  
  
  You can connect to any socket application, email server (smtp.domain.com:25), troubleshoot network devices in real time and more.
	
	Usage is very simple. 
  Instantiate the socket class and send the Device Command to it, 
  You will receive immediate response back from the device or application that you are conneted to.  Consult your device manual for list of commands available while connected.  Use of help command on the terminal maybe helpful.
	
Let us demonstrate a simple way to communicate or troubleshoot a mail server in a realtime. passing MAIL command to PrinceSocket.
For this demonstration, we assume that our mail server is currently running on port 25.
	
	As a rule of thumb: Never connect to any network or server that you do not have an approval to do so.
	
You can use the example below to connect to any socket device or application.  
Subtitute the commands with the application's commands
	
	
	$socket = PrinceSocket::Singleton();
	
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
	
	$socket::PrinceCMD("RCPT TO: <receiver@domain.com>");
	echo $socket::getResponse();
	
	$socket::PrinceCMD("DATA testing email");
	echo $socket::getResponse();
	

