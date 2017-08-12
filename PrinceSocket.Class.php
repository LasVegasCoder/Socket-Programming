<?php
	defined('PRINCE_SOCKET')or die('no direct connect');
	/*
		Desc: Socket Programming Class that can connect to any TCP/IP, UDP host and port, or any socket application interface.
		Author: Prince Ademola Adeyemi
		Contact: YourVegasPrince@gmail.com
		FB:	facebook.com/YourVegasPrince@gmail
	*/
	
	if( !class_exists( 'PrinceSocket' ) )
	{
		private static var $_singleton = null;
		private var $_hostname;
		private var $_port;
		private var $_link;
		private var $_error_no;
		private var $_error_str;
		private var $_persist = false;
		private var $_timeout = 30;
		
		private static function __construct()
		{
			
		}
		
		public static function Singleton()
		{
			if( self::$_singleton == null || $_singleton != instanceof PrinceSocket )
			{
				self::$_singleton = new PrinceSocket();
			}
			
			return self::$_singleton;
		}
		
		public function _Connect( $host, $port )
		{
			$this->_hostname 	= ( !empty( $host ) ? $host : '' );
			$this->_port 		= ( !empty( $port ) ? $port : '' );
			$pconnect			= ( !empty( $this->_persist ) ? "pfsockopen" : "fsockopen" );
			$this->_timeout 	= 60;
			
			if( $this->_hostname && $this->_port )
			{
				$this->_link = new $pconnect( $this->_hostname, $this->_port, $this->_error_no, $this->_error_str, $this->_timeout );
				
				stream_set_blocking( $this->_link, 0 );
				return $this->_link;
			}
			else {
				return $this->PrinceError( 'Error occurred' );
			}
		}
		
		private function PrinceError( $errorMsg )
		{
			if( !empty( $errorMsg ) )
			{
				throw new Exception( $errorMsg );
			}
			else{
				//
			}
			return false;
		}
		
		private function PrinceCMD( $cmd )
		{
			if( $this->_link != false )
			{
				$cmd 	.= "\r\n";
				$result = fwrite( $this->_link, $cmd, strlen( $cmd ) );
				
				if( $result != '' )
				{
					return $result;
				}
			}
			else {
				$this->PrinceError('NO LINK ERROR');
			}
		}
		
		public function getResponse()
		{
			if( $this->_link )
			{
				$response = fread( $this->_link, 2048 );
				
				if( $response != '' )
				{
					return $response;
				}
			}
			else{
				$this->PrinceError( 'NO LINK' );
			}
		}
		
		public function _readLine()
		{
			$line = '';
			if( $this->_line )
			{
				$line = fgets( $this->_line, 1024 );
				
				if( strlen( $line >= 2 && substr( $line, -2 ) == "\r\n" ||  substr( $line, -1 ) == "\n" ) )
				{
					$line = rtrim( $line );
				}
				if( !empty( $line ) )
				{
					return $line;
				}
			}
		}
		
		public function getMultilinedResponse()
		{
			$data = '';
			while(($tmp = $this->_readLine()) != '.') 
			{
				if(substr($tmp, 0, 2) == '..') 
				{
					$tmp = substr($tmp, 1);
				}
				$data .= $tmp."\r\n";
			}

			return substr($data, 0, -2);
		}
	
		
		
	}// end PrinceSocket




?>