<?
#	TAS Telefoon Registratie Systeem
#	Built: 11-May-2011   /  Created by: LR Design Websolutions Venray - Robert van Klooster

#	System functions
	defined('SYSTEMACCESS') or die('Geen directe toegang mogelijk!');
	
	class Mail{
		
		private $oId;
		private $oFrom;
		private $oTo;
		private $oSubject;
		private $oContent;
		private $oAttachmentCall;
		private $oAttachmentFile;
		private $oCreateDate;
		private $oRead;
		private $oReply;
		private $oFolder;
		
		static function NewMail($oLimit = false){
		
			$Database = new Database();
			
			$Query = "SELECT ".MAIL.".* FROM `".MAIL."` WHERE ".MAIL.".`to` = '".$_SESSION["login"]."' AND ".MAIL.".`read` = 0";
			if($oLimit) $Query.= " LIMIT ".$oLimit;
			$Mails = $Database->Select($Query, rows_object);
			
			foreach($Mails as $oMail){
				$oData = new Mail();
				$oData->getMailById($oMail->id);
				$oReturn[] = $oData;
			}
			return $oReturn;
		
		}
		
		public function getMailById($oId){
		
			$Database = new Database();
			$oMail = $Database->Select(
				"SELECT
					".MAIL.".*
				FROM
					`".MAIL."`
				WHERE
					".MAIL.".id = '".$oId."'
				LIMIT 1", rows_object);
			
			if(!count($oMail))
				return false;
			
			foreach($oMail as $Mail){
				$this->oId = $Mail->id;
				$this->oFrom = $Mail->from;
				$this->oTo = $Mail->to;
				$this->oSubject = $Mail->subject;
				$this->oContent = $Mail->content;
				$this->oAttachmentCall = $Mail->attachment_call;
				$this->oAttachmentFile = $Mail->attachment_file;
				$this->oCreateDate = $Mail->create;
				$this->oRead = $Mail->read;
				$this->oReply = $Mail->back;
				$this->oFolder = $Mail->folder;
			}
			
			return true;
		
		}
		
		public function getId(){
			$this->oId;
		}
		
		public function getFrom(){
			$this->oFrom;
		}
		
		public function getTo(){
			$this->oTo;
		}
		
		public function getSubject(){
			$this->oSubject;
		}
		
		public function getContent(){
			$this->oContent;
		}
		
		public function getAttachmentCall(){
			$this->oAttachmentCall;
		}
		
		public function getAttachmentFile(){
			$this->oAttachmentFile;
		}
		
		public function getCreateDate(){
			$this->oCreateDate;
		}
		
		public function getRead(){
			$this->oRead;
		}
		
		public function getReply(){
			$this->oReply;
		}
		
		public function getFolder(){
			$this->oFolder;
		}
		

	}
?>