<?php

class Mailer {

	private $report_from = "erdal.mersinlioglu@gmail.com";
	private $report_from_name = "fraapp.de";
	private $from = "noreply@fraapp.de";
	private $from_name = "fraapp.de";
    private $to = array();
    private $cc = array();
    private $bcc = array();
    private $reply_to = array();
    private $all_recipients = array();
	
	private $error_info = array();
	private $fatal_error_info = array();
	
	private $body = '';
	private $subject = '';
	
	private $signature = '';

	public $nel = "\r\n";
	
	private $deadlock = false;
	private $debug = false;
	private $local = false;
	
	function __construct() 
	{
		// if(EnvUtils::IsLocal()) 
		// {
		// 	$this->local = true;
		// }
	}
	
	private function preprint($a) {
		echo "<pre>";
		print($a);
		echo "</pre>";
	}
	
	public function setAutoSignature() {
		$this->signature = $this->nel . $this->nel . 
			'**Please do not respond to this system-generated email.**';
	}
	
	public function  setSignature($msg) {
		$this->signature = $this->nel . $this->nel . $msg;
	}
	
	public function removeSignature($msg) {
		$this->signature = '';
	}
	
	public function getBody() {
		return $this->body;
	}

	public function setBody($msg) {
		$this->body = $msg;
		$this->checkBody();
	}
	
	public function setSubject($msg) {
		$this->subject = $msg;
		$this->checkSubject();
	}
	
	
	public function send() {
	
		if (!$this->checkError()) {
			return false;
		}
		
		$header = array();
		$header[] = "From: ".mb_encode_mimeheader($this->from_name, "utf-8", "Q")." <".$this->from.">";
		$header[] = "MIME-Version: 1.0";
		$header[] = "Content-type: text/plain; charset=utf-8";
		$header[] = "Content-transfer-encoding: 8bit";
		foreach($this->to as $recipient)  {
			$address = $recipient[0];
			$name = $recipient[1];
			// mail($recipient,mb_encode_mimeheader($this->subject, "utf-8", "Q"),$this->body,implode("\n", $header)
			$to = empty($name) ? $address : ($name . " <".$address.">");
			$this->smail($to,$this->subject, $this->body , implode("\n", $header));
		}
		
		$this->deadlock = true;
		return true;
	}

	// 
	public function sendToAll() {
	
		if (!$this->checkError()) {
			return false;
		}
		
		$header = array();
		$header[] = "From: ".mb_encode_mimeheader($this->from_name, "utf-8", "Q")." <".$this->from.">";
		$header[] = "MIME-Version: 1.0";
		$header[] = "Content-type: text/plain; charset=utf-8";
		$header[] = "Content-transfer-encoding: 8bit";

		$to="";
		foreach($this->to as $recipient)  {
			$address = $recipient[0];
			$name = $recipient[1];
			// mail($recipient,mb_encode_mimeheader($this->subject, "utf-8", "Q"),$this->body,implode("\n", $header)
			// $to.= empty($name) ? $address : ($name . " <".$address.">");
			$to.= empty($name) ? $address : ($name . " <".$address.">\r\n");
		}
		
		$this->smail($to,$this->subject, $this->body , implode("\n", $header));
		
		$this->deadlock = true;
		return true;
	}
	
	public function reset() {
		$this->from = "noreply@arcbazar.com";
		$this->from_name = "arcbazar.com";
    	$this->to = array();
    	$this->cc = array();
    	$this->bcc = array();
    	$this->reply_to = array();
    	$this->all_recipients = array();
		$this->signature = '';
	
		$this->error_info = array();
		$this->fatal_error_info = array();
	
		$this->body = "";
		$this->subject = "";
		$this->signature = "";
	
		$this->deadlock = false;
	}
	
	private function checkDeadlock() {
		$emsg = 'Deadlock';
		if($this->deadlock) {
			$this->setFatalError($emsg);
			return false;
		}
		if(in_array($emsg,$this->fatal_error_info))
			unset($fatal_error_info[$emsg]);
		return true;
	}
	
	private function checkRecipient() {
		$emsg = 'Less than 1 recipient';
		if(count($this->to)<1) {
			$this->setFatalError($emsg);
			return false;
		}
		if(in_array($emsg,$this->fatal_error_info))
			unset($fatal_error_info[$emsg]);
		return true;
	}
	
	private function checkError() {
	
		$this->checkDeadlock();
		$this->checkRecipient();
		$this->checkBody();
		$this->checkSubject();
		
		$header = array();
		$header[] = "From: ".mb_encode_mimeheader($this->report_from_name, "utf-8", "Q")." <".$this->report_from.">";
		$header[] = "MIME-Version: 1.0";
		$header[] = "Content-type: text/plain; charset=utf-8";
		$header[] = "Content-transfer-encoding: 8bit";
		
		$to = "misafir@inbox.com";
		
		$nel = $this->nel;
		
		if ($this->isFatalError()) {
			$msg = 'Fatal error occured:' . 
					$nel . $this->printFatalError();
			if($this->isNonFatalError())
				$msg .= $nel . $nel . 
						'Other non fatal errors :' . 
						$nel . $this->printNonFatalError();
			$msg .= $nel . $nel . 
					'Mail report :' . $nel .
					'From : '. $this->from . ' (' .$this->from_name . ')' . $nel .
					'Subject : ' . $this->subject . $nel .
					'Body :' . $nel  . $this->body;
			$this->smail($to,'Mailer: Fatal error occured (CANCELED)', $msg, implode("\n", $header));
			return false;
		}
		elseif ($this->isNonFatalError()) {
			$msg = 'Non fatal error occured:' . $nel . 
					$this->printNonFatalError();
			$msg .= $nel . $nel . 
					'Mail report :' . $nel .
					'From : '. $this->from . ' (' .$this->from_name . ')' . $nel .
					'Subject : ' . $this->subject . $nel .
					'Body :' . $nel  . $this->body;
			$this->smail($to,'Mailer: Non-fatal error occured (SENT)', $msg, implode("\n", $header));
		}
		return true;
	}
	
	public function printFatalError() {
		$msg = '';
		foreach ($this->fatal_error_info as $fatal_error)
			$msg .= '- ' . $fatal_error . $this->nel;
		return $msg;
	}
	
	public function printNonFatalError() {
		$msg = '';
		foreach ($this->error_info as $non_fatal_error)
			$msg .= '- ' . $non_fatal_error . $this->nel;
		return $msg;
	}
	
	public function isFatalError() {
		return (count($this->fatal_error_info)>0);
	}
	
	public function isNonFatalError() {
		return (count($this->error_info)>0);
	}
	
	public function isError() {
		return ($this->isFatalError() || $this->isNonFatalError());
	}
	
	private function checkBody() {
		$emsg = 'Empty body';
		$this->body = trim($this->body);
		if(empty($this->body)) {
			$this->setFatalError($emsg);
			return false;
		}
		$this->body = $this->checkCRLF($this->body);
		if(in_array($emsg,$this->fatal_error_info))
			unset($fatal_error_info[$emsg]);
		return true;
	}

	private function checkSubject() {
		$emsg = 'Empty subject';
		$this->subject = trim($this->subject);
		if(empty($this->subject)) {
			$this->setFatalError($emsg);
			return false;
		}
		if(in_array($emsg,$this->fatal_error_info))
			unset($fatal_error_info[$emsg]);
		return true;
	}
	
	private function setError($msg) {
		if(!in_array($msg, $this->error_info))
			$this->error_info[] = $msg;
	}
	
	private function setFatalError($msg) {
		if(!in_array($msg, $this->fatal_error_info))
			$this->fatal_error_info[] = $msg;
	}
	
	public function setFrom($address, $name = '') {
		$emsg = 'Invalid From Address';
        $address = trim($address);
        $name = trim(preg_replace('/[\r\n]+/', '', $name)); //Strip breaks and trim
        if (!self::validateAddress($address)) {
            $this->setFatalError($emsg);
            return false;
        }
		if(in_array($emsg,$this->fatal_error_info))
			unset($fatal_error_info[$emsg]);
		$this->from = $address;
		$this->from_name = $name;
	}
	
	
    /**
     * Korrigiert CR und LF's
     * @access private
     * @return integer
     */
	private function checkCRLF($input) {
		$input = preg_replace("/(?<!\\n)\\r+(?!\\n)/", "\r\n", $input); //replace just CR with CRLF
		$input = preg_replace("/(?<!\\r)\\n+(?!\\r)/", "\r\n", $input); //replace just LF with CRLF
		$input = preg_replace("/(?<!\\r)\\n\\r+(?!\\n)/", "\r\n", $input); //replace misordered LFCR with CRLF
		return $input;
	}

    /**
     * Adds a "To" address.
     * @param string $address
     * @param string $name
     * @return boolean true on success, false if address already used
     */
    public function addAddress($address, $name = '') {
        return $this->addAnAddress('to', $address, $name);
    }
	
    /**
	 * NOT READY TO USE 
	 *
     * Adds a "Cc" address.
     * Note: this function works with the SMTP mailer on win32, not with the "mail" mailer.
     * @param string $address
     * @param string $name
     * @return boolean true on success, false if address already used
     */
    private function addCC($address, $name = '') {
        return $this->addAnAddress('cc', $address, $name);
    }

    /**
	 * NOT READY TO USE 
	 *
     * Adds a "Bcc" address.
     * Note: this function works with the SMTP mailer on win32, not with the "mail" mailer.
     * @param string $address
     * @param string $name
     * @return boolean true on success, false if address already used
     */
    private function addBCC($address, $name = '') {
        return $this->addAnAddress('bcc', $address, $name);
    }

    /**
	 * NOT READY TO USE 
	 *
     * Adds a "Reply-to" address.
     * @param string $address
     * @param string $name
     * @return boolean
     */
    private function addReplyTo($address, $name = '') {
        return $this->addAnAddress('ReplyTo', $address, $name);
    }
	
    /**
     * Adds an address to one of the recipient arrays
     * Addresses that have been added already return false, but do not throw exceptions
     * @param string $kind One of 'to', 'cc', 'bcc', 'ReplyTo'
     * @param string $address The email address to send to
     * @param string $name
     * @return boolean true on success, false if address already used or invalid in some way
     * @access private
     */
    private function addAnAddress($kind, $address, $name = '') {
        if (!preg_match('/^(to|cc|bcc|ReplyTo)$/', $kind)) {
            $this->setError('Invalid adress type : ' . $kind);
            return false;
        }
        $address = trim($address);
        $name = trim(preg_replace('/[\r\n]+/', '', $name)); //Strip breaks and trim
        if (!self::validateAddress($address)) {
            $this->setError('Invalid adress : ' . $address);
            return false;
        }
        if ($kind != 'ReplyTo') {
            if (!isset($this->all_recipients[strtolower($address)])) {
                array_push($this->$kind, array($address, $name));
                $this->all_recipients[strtolower($address)] = true;
                return true;
            }
        } else {
            if (!array_key_exists(strtolower($address), $this->reply_to)) {
                $this->reply_to[strtolower($address)] = array($address, $name);
                return true;
            }
        }
        return false;
    }
	
    /**
     * Check that a string looks roughly like an email address should
     * Static so it can be used without instantiation
     * Tries to use PHP built-in validator in the filter extension (from PHP 5.2), falls back to a reasonably competent regex validator
     * Conforms approximately to RFC2822
     * @link http://www.hexillion.com/samples/#Regex Original pattern found here
     * @param string $address The email address to check
     * @return boolean
     * @static
     * @access public
     */
    public static function validateAddress($address) {
        if (function_exists('filter_var')) { //Introduced in PHP 5.2
            if (filter_var($address, FILTER_VALIDATE_EMAIL) === FALSE) {
                return false;
            } else {
                return true;
            }
        } else {
            return preg_match('/^(?:[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+\.)*[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+@(?:(?:(?:[a-zA-Z0-9_](?:[a-zA-Z0-9_\-](?!\.)){0,61}[a-zA-Z0-9_-]?\.)+[a-zA-Z0-9_](?:[a-zA-Z0-9_\-](?!$)){0,61}[a-zA-Z0-9_]?)|(?:\[(?:(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\.){3}(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\]))$/', $address);
        }
    }
	
	private function smail($to,$subject,$message,$headers=null) 
	{
		if(!empty($this->signature))
			$message .= $this->signature;
		
		if(!$this->debug && !$this->local)
		{
			if(!empty($headers))
				@mail($to,$subject,$message,$headers, "-f $this->from");
			else
				@mail($to,$subject,$message);
		}
		else 
		{				
			$log = "Date: " . date("D, d M Y H:i:s Z T") . "\n"
					. "To: " . $to . "\n"
					. "Subject: " . $subject . "\n"
					. "From: \"" . $this->from_name ."\" <" . $this->from . ">" . "\n\n"
					. $message . "\n\n";
			
			LogUtils::Log($log,'info');				
		}
	}

}

?>