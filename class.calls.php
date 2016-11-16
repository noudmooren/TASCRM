<?
#	TAS Telefoon Registratie Systeem
#	Built: 11-May-2011   /  Created by: LR Design Websolutions Venray - Robert van Klooster

#	System functions
	defined('SYSTEMACCESS') or die('Geen directe toegang mogelijk!');
	
	class Calls{
		
		public static function getCallObjectById($oId){
			
			$Database = new Database();
			$Calls = $Database->Select(
				"SELECT
				
					".CALLS.".`id` 'call_id',
					".CALLS.".`relationname` 'call_relationname',
					".CALLS.".`contactperson` 'call_contactperson',
					".CALLS.".`address` 'call_address',
					".CALLS.".`number` 'call_number',
					".CALLS.".`zipcode` 'call_zipcode',
					".CALLS.".`place` 'call_place',
					".CALLS.".`phonenumber` 'call_phonenumber',
					".CALLS.".`mobilenumber` 'call_mobilenumber',
					".CALLS.".`mailaddress` 'call_mailaddress',
					".CALLS.".`birthdate` 'call_birthdate',
					".CALLS.".`refid` 'call_refid',
					".CALLS.".`session` 'call_session',
					".CALLS.".`datecall` 'call_datecall',
					".CALLS.".`starttime` 'call_starttime',
					".CALLS.".`endtime` 'call_endtime',
					".CALLS.".`calltime` 'call_time',
					".CALLS.".`job` 'call_job',
					".CALLS.".`urgentie` 'call_urgentie',
					".CALLS.".`send` 'call_send',
					".CALLS.".`archief` 'call_archief',
					".CALLS.".`over` 'call_over',
					".CALLS.".`ready` 'call_ready',
					".CALLS.".`sendto` 'call_sendto',
					".CALLS.".`sended` 'call_sended',
					".CALLS.".`content` 'call_content',
					".CALLS.".`orderid` 'call_orderid',
					".CALLS.".`special` 'call_special',
					".CALLS.".`locked` 'call_locked',
					".CALLS.".`lock_user` 'call_lock_user',
					".CALLS.".`userid` 'call_userid',
					
					".LOGIN.".`name` 'user_name',
					
					".CUSTOMERS.".`id` 'customer_id',
					".CUSTOMERS.".`special` 'customer_special',
					".CUSTOMERS.".`customername` 'customer_customername',
					".CUSTOMERS.".`sms` 'customer_sms',
					".CUSTOMERS.".`mailaddress` 'customer_mailaddress',
					".CUSTOMERS.".`place` 'customer_place',
					".CUSTOMERS.".`phonenumber` 'customer_phonenumber',
					".CUSTOMERS.".`faxnumber` 'customer_faxnumber',
					".CUSTOMERS.".`required` 'customer_required',
					".CUSTOMERS.".`startpoint` 'customer_startpoint',
					".CUSTOMERS.".`customercode` 'customer_customercode',
					".CUSTOMERS.".`maildelivery` 'customer_maildelivery',
					".CUSTOMERS.".`maildeliverytime` 'customer_maildeliverytime',
					".CUSTOMERS.".`finishingprocess` 'customer_finishingprocess',
					".CUSTOMERS.".`currentinformation` 'customer_currentinformation',
					".CUSTOMERS.".`eenendertig` 'customer_eenendertig',
					".CUSTOMERS.".`refnr` 'customer_refnr',
					".CUSTOMERS.".`customid` 'customer_customid',
					".CUSTOMERS.".`active` 'customer_active',
					".CUSTOMERS.".`see` 'customer_see',
					".CUSTOMERS.".`subject` 'customer_subject',
					".CUSTOMERS.".`extracustomerinfo` 'customer_extracustomerinfo',
					".CUSTOMERS.".`searchonaddress` 'customer_searchonaddress',
					".CUSTOMERS.".`birthdateoption` 'customer_birthdateoption',
					".CUSTOMERS.".`directlinks` 'customer_directlinks',
					
					".RELATIONS.".`id` 'relation_id',
					".RELATIONS.".`relationname` 'relation_relationname',
					".RELATIONS.".`contactperson` 'relation_contactperson',
					".RELATIONS.".`address` 'relation_address',
					".RELATIONS.".`number` 'relation_number',
					".RELATIONS.".`zipcode` 'relation_zipcode',
					".RELATIONS.".`place` 'relation_place',
					".RELATIONS.".`phonenumber` 'relation_phonenumber',
					".RELATIONS.".`mobilenumber` 'relation_mobilenumber',
					".RELATIONS.".`mailaddress` 'relation_mailaddress',
					".RELATIONS.".`birthdate` 'relation_birthdate',
					".RELATIONS.".`refid` 'relation_refid',
					
					".RELATIONS.".`custom1` 'custom1',
					".RELATIONS.".`custom2` 'custom2',
					".RELATIONS.".`custom3` 'custom3',
					".RELATIONS.".`custom4` 'custom4',
					".RELATIONS.".`custom5` 'custom5',
					".RELATIONS.".`custom6` 'custom6',
					".RELATIONS.".`custom7` 'custom7',
					".RELATIONS.".`custom8` 'custom8',
					".RELATIONS.".`custom9` 'custom9',
					".RELATIONS.".`custom10` 'custom10'

				FROM
					`".CALLS."`
				JOIN
					`".CUSTOMERS."`
				ON
					".CUSTOMERS.".`id` = ".CALLS.".`companyid`
				LEFT JOIN
					`".RELATIONS."`
				ON
					".RELATIONS.".`id` = ".CALLS.".`relationid`
				LEFT JOIN
					`".LOGIN."`
				ON
					".LOGIN.".`id` = ".CALLS.".`userid`
				WHERE
					".(App::UserSee() ? CUSTOMERS.".`see` IN (".App::UserSee().") AND " : "" )."
					".CALLS.".`id` = '".$oId."'
				LIMIT 1
				", single_object);
			
			if(!count($Calls))
				return false;
			
			$Return = (object) array();
			
			$Return->call_id = $Calls->call_id;
			$Return->call_relationname = $Calls->call_relationname;
			$Return->call_contactperson = $Calls->call_contactperson;
			$Return->call_address = $Calls->call_address;
			$Return->call_number = $Calls->call_number;
			$Return->call_zipcode = $Calls->call_zipcode;
			$Return->call_place = $Calls->call_place;
			$Return->call_phonenumber = $Calls->call_phonenumber;
			$Return->call_mobilenumber = $Calls->call_mobilenumber;
			$Return->call_mailaddress = $Calls->call_mailaddress;
			$Return->call_birthdate = $Calls->call_birthdate;
			$Return->call_refid = $Calls->call_refid;
			$Return->call_session = $Calls->call_session;
			$Return->call_datecall = $Calls->call_datecall;
			$Return->call_starttime = $Calls->call_starttime;
			$Return->call_endtime = $Calls->call_endtime;
			$Return->call_time = $Calls->call_time;
			$Return->call_job = $Calls->call_job;
			
			if($Calls->customer_see == 4)
				$Return->call_job_name = Departmentsbd::getDepartmentsNameById($Calls->call_job);
			else
				$Return->call_job_name = Departments::getDepartmentsNameById($Calls->call_job);
			
			//$Return->call_extrafield = Customers::getExtraFieldsByCustomerId($Calls->customer_id);
			$Return->call_urgentie = $Calls->call_urgentie;
			$Return->call_send = $Calls->call_send;
			$Return->call_archief = $Calls->call_archief;
			$Return->call_over = $Calls->call_over;
			$Return->call_ready = $Calls->call_ready;
			$Return->call_sendto = $Calls->call_sendto;
			$Return->call_sended = $Calls->call_sended;
			$Return->call_content = $Calls->call_content;
			$Return->call_orderid = $Calls->call_orderid;
			$Return->call_special = $Calls->call_special;
			$Return->call_locked = $Calls->call_locked;
			$Return->call_lock_user = $Calls->call_lock_user;
			$Return->call_userid = $Calls->call_userid;
			
			$Return->customer_id = $Calls->customer_id;
			$Return->customer_special = $Calls->customer_special;
			$Return->customer_customername = $Calls->customer_customername;
			$Return->customer_sms = $Calls->customer_sms;
			$Return->customer_mailaddress = $Calls->customer_mailaddress;			
			$Return->customer_place = $Calls->customer_place;
			$Return->customer_phonenumber = $Calls->customer_phonenumber;
			$Return->customer_faxnumber = $Calls->customer_faxnumber;			
			$Return->customer_required = $Calls->customer_required;
			$Return->customer_startpoint = $Calls->customer_startpoint;
			$Return->customer_customercode = $Calls->customer_customercode;
			$Return->customer_maildelivery = $Calls->customer_maildelivery;
			$Return->customer_maildeliverytime = $Calls->customer_maildeliverytime;
			$Return->customer_finishingprocess = $Calls->customer_finishingprocess;
			$Return->customer_currentinformation = $Calls->customer_currentinformation;
			$Return->customer_eenendertig = $Calls->customer_eenendertig;
			$Return->customer_refnr = $Calls->customer_refnr;
			$Return->customer_customid = $Calls->customer_customid;
			$Return->customer_active = $Calls->customer_active;
			$Return->customer_see = $Calls->customer_see;
			$Return->customer_subject = $Calls->customer_subject;
			$Return->customer_extracustomerinfo = $Calls->customer_extracustomerinfo;
			$Return->customer_searchonaddress = $Calls->customer_searchonaddress;
			$Return->customer_birthdateoption = $Calls->customer_birthdateoption;
			$Return->customer_directlinks = $Calls->customer_directlinks;
			
			$Return->relation_id = $Calls->relation_id;
			$Return->relation_relationname = $Calls->relation_relationname;
			$Return->relation_contactperson = $Calls->relation_contactperson;
			$Return->relation_address = $Calls->relation_address;
			$Return->relation_number = $Calls->relation_number;
			$Return->relation_zipcode = $Calls->relation_zipcode;
			$Return->relation_place = $Calls->relation_place;
			$Return->relation_phonenumber = $Calls->relation_phonenumber;
			$Return->relation_mobilenumber = $Calls->relation_mobilenumber;
			$Return->relation_mailaddress = $Calls->relation_mailaddress;
			$Return->relation_birthdate = $Calls->relation_birthdate;
			$Return->relation_refid = $Calls->relation_refid;
			
			$Return->custom1 = $Calls->custom1;
			$Return->custom2 = $Calls->custom2;
			$Return->custom3 = $Calls->custom3;
			$Return->custom4 = $Calls->custom4;
			$Return->custom5 = $Calls->custom5;
			$Return->custom6 = $Calls->custom6;
			$Return->custom7 = $Calls->custom7;
			$Return->custom8 = $Calls->custom8;
			$Return->custom9 = $Calls->custom9;
			$Return->custom10 = $Calls->custom10;
			
			$Return->user_id = $Calls->call_userid;
			$Return->user_name = $Calls->user_name;
			
			$Return->actions = self::getActionsByCallId($Calls->call_id);
			
			return $Return;
			
		}
		
		public function getCallById($oId){
			
			$Database = new Database();
			$Calls = $Database->Select(
				"SELECT
				
					".CALLS.".`id` 'call_id',
					".CALLS.".`relationname` 'call_relationname',
					".CALLS.".`contactperson` 'call_contactperson',
					".CALLS.".`address` 'call_address',
					".CALLS.".`number` 'call_number',
					".CALLS.".`zipcode` 'call_zipcode',
					".CALLS.".`place` 'call_place',
					".CALLS.".`phonenumber` 'call_phonenumber',
					".CALLS.".`mobilenumber` 'call_mobilenumber',
					".CALLS.".`mailaddress` 'call_mailaddress',
					".CALLS.".`birthdate` 'call_birthdate',
					".CALLS.".`refid` 'call_refid',
					".CALLS.".`session` 'call_session',
					".CALLS.".`datecall` 'call_datecall',
					".CALLS.".`starttime` 'call_starttime',
					".CALLS.".`endtime` 'call_endtime',
					".CALLS.".`calltime` 'call_time',
					".CALLS.".`job` 'call_job',
					".CALLS.".`send` 'call_send',
					".CALLS.".`archief` 'call_archief',
					".CALLS.".`over` 'call_over',
					".CALLS.".`ready` 'call_ready',
					".CALLS.".`sendto` 'call_sendto',
					".CALLS.".`sended` 'call_sended',
					".CALLS.".`content` 'call_content',
					".CALLS.".`orderid` 'call_orderid',
					".CALLS.".`special` 'call_special',
					".CALLS.".`locked` 'call_locked',
					".CALLS.".`lock_user` 'call_lock_user',
					".CALLS.".`userid` 'call_userid',
					
					".LOGIN.".`name` 'user_name',
					
					".CUSTOMERS.".`id` 'customer_id',
					".CUSTOMERS.".`special` 'customer_special',
					".CUSTOMERS.".`customername` 'customer_customername',
					".CUSTOMERS.".`sms` 'customer_sms',
					".CUSTOMERS.".`mailaddress` 'customer_mailaddress',
					".CUSTOMERS.".`faxnumber` 'customer_faxnumber',
					".CUSTOMERS.".`required` 'customer_required',
					".CUSTOMERS.".`startpoint` 'customer_startpoint',
					".CUSTOMERS.".`customercode` 'customer_customercode',
					".CUSTOMERS.".`maildelivery` 'customer_maildelivery',
					".CUSTOMERS.".`maildeliverytime` 'customer_maildeliverytime',
					".CUSTOMERS.".`finishingprocess` 'customer_finishingprocess',
					".CUSTOMERS.".`currentinformation` 'customer_currentinformation',
					".CUSTOMERS.".`eenendertig` 'customer_eenendertig',
					".CUSTOMERS.".`refnr` 'customer_refnr',
					".CUSTOMERS.".`customid` 'customer_customid',
					".CUSTOMERS.".`active` 'customer_active',
					".CUSTOMERS.".`see` 'customer_see',
					".CUSTOMERS.".`extracustomerinfo` 'customer_extracustomerinfo',
					".CUSTOMERS.".`searchonaddress` 'customer_searchonaddress',
					".CUSTOMERS.".`birthdateoption` 'customer_birthdateoption',
					".CUSTOMERS.".`directlinks` 'customer_directlinks',
					
					".RELATIONS.".`id` 'relation_id',
					".RELATIONS.".`relationname` 'relation_relationname',
					".RELATIONS.".`contactperson` 'relation_contactperson',
					".RELATIONS.".`address` 'relation_address',
					".RELATIONS.".`number` 'relation_number',
					".RELATIONS.".`zipcode` 'relation_zipcode',
					".RELATIONS.".`place` 'relation_place',
					".RELATIONS.".`phonenumber` 'relation_phonenumber',
					".RELATIONS.".`mobilenumber` 'relation_mobilenumber',
					".RELATIONS.".`mailaddress` 'relation_mailaddress',
					".RELATIONS.".`birthdate` 'relation_birthdate',
					".RELATIONS.".`refid` 'relation_refid',
					".RELATIONS.".`comment` 'relation_comment',
					
					".RELATIONS.".`custom1` 'custom1',
					".RELATIONS.".`custom2` 'custom2',
					".RELATIONS.".`custom3` 'custom3',
					".RELATIONS.".`custom4` 'custom4',
					".RELATIONS.".`custom5` 'custom5',
					".RELATIONS.".`custom6` 'custom6',
					".RELATIONS.".`custom7` 'custom7',
					".RELATIONS.".`custom8` 'custom8',
					".RELATIONS.".`custom9` 'custom9',
					".RELATIONS.".`custom10` 'custom10'

				FROM
					`".CALLS."`
				JOIN
					`".CUSTOMERS."`
				ON
					".CUSTOMERS.".`id` = ".CALLS.".`companyid`
				LEFT JOIN
					`".RELATIONS."`
				ON
					".RELATIONS.".`id` = ".CALLS.".`relationid`
				LEFT JOIN
					`".LOGIN."`
				ON
					".LOGIN.".`id` = ".CALLS.".`userid`
				WHERE
					".CUSTOMERS.".`see` IN (".App::UserSee().")
				AND
					".CALLS.".`id` = '".$oId."'
				LIMIT 1
				", single_object);
			
			if(!count($Calls))
				return false;
			
			return $Calls;
			
		}
		
		static function getActionsByCallId($oId){
			
			$Database = new Database();
			$Actions = $Database->Select("
				SELECT
					".ACTIONS.".*,
					
					".ACTIONS.".`mechanic_name` 'mechanicname',
					".ACTIONS.".`mechanic_phone1` 'phonenumber',
					".ACTIONS.".`mechanic_phone2` 'mobilenumber',
					".ACTIONS.".`mechanic_mail` 'mailaddress',
					".ACTIONS.".`mechanic_phone3` 'sms',
					".MECHANICS.".`info`,
					
					".DEPARTMENTS.".`departmentcode`,
					".DEPARTMENTS.".`description`
				FROM
					`".ACTIONS."`
				JOIN
					`".MECHANICS."`
				ON
					".MECHANICS.".`id` = ".ACTIONS.".`mechanicid`
				LEFT JOIN
					`".DEPARTMENTS."`
				ON
					".DEPARTMENTS.".`id` = ".ACTIONS.".`rightjob`
				WHERE
					".ACTIONS.".`callid` = '".$oId."'
				ORDER BY
					".ACTIONS.".`rightdate`, ".ACTIONS.".`righttime`", rows_object);
			return $Actions;
			
		}
		
		static function getOpenCalls(){
			
			$Database = new Database();
			$Calls = $Database->Select("SELECT ".CALLS.".`id`, ".CUSTOMERS.".`customername` FROM `".CALLS."` JOIN `".CUSTOMERS."` ON ".CUSTOMERS.".`id` = ".CALLS.".`companyid` WHERE ".CALLS.".`session` = '1' AND ".CUSTOMERS.".`see` IN (".App::UserSee().") AND ".CALLS.".`userid` = '".$_SESSION['login']."' AND ".CALLS.".`active` != 'false'", rows_object);
			
			return $Calls;
			
		}
		
		static function getUnfinishedCalls(){
		
			$Database = new Database();
			$Calls = $Database->Select("SELECT ".CALLS.".`id`, ".CALLS.".`endtime`, ".CALLS.".`active`, ".CUSTOMERS.".`customername` FROM `".CALLS."` JOIN `".CUSTOMERS."` ON ".CUSTOMERS.".`id` = ".CALLS.".`companyid` WHERE ".CUSTOMERS.".`see` IN (".App::UserSee().") AND ".CALLS.".`userid` = '".$_SESSION['login']."' AND ".CALLS.".`ready` = '0' AND ".CALLS.".`active` != 'false'", rows_object);
			
			return $Calls;
			
		}
		
		static function getCallStatsByYear(){
		
			$Database = new Database();
			$Calls = $Database->Select("
				SELECT
					DATE_FORMAT(datecall, '%Y') as 'year',
					COUNT(id) as 'total'
				FROM
					`".CALLS."`
				WHERE
					DATE_FORMAT(datecall, '%Y') >= 2011
				GROUP BY
					DATE_FORMAT(datecall, '%Y')
				ORDER BY
					DATE_FORMAT(datecall, '%Y') ASC", rows_object);
			
			return $Calls;
			
		}
		
		static function getCallStatsByMonth($Year){
		
			$Database = new Database();
			$Calls = $Database->Select("
				SELECT
					DATE_FORMAT(datecall, '%m') as 'month',
					COUNT(id) as 'total'
				FROM
					`".CALLS."`
				WHERE
					DATE_FORMAT(datecall, '%Y') = '".$Year."'
				GROUP BY
					DATE_FORMAT(datecall, '%m')
				ORDER BY
					DATE_FORMAT(datecall, '%m') ASC", rows_object);
			
			return $Calls;
			
		}
		
		static function getCallStatsByDay($Year, $Month){
		
			$Database = new Database();
			$Calls = $Database->Select("
				SELECT
					".CALLS.".`datecall` 'date',
					".CALLS.".`starttime` 'time'
				FROM
					`".CALLS."`
				JOIN
					`".CUSTOMERS."`
				ON
					".CUSTOMERS.".`id` = ".CALLS.".`companyid`
				WHERE
				
					DATE_FORMAT(".CALLS.".`datecall`, '%Y%m') = '".$Year.$Month."'
					
					".(($_GET["customer"]) ? " AND ".CALLS.".`companyid` = '".$_GET["customer"]."'" : "")."
					".(($_GET["employee"]) ? " AND ".CALLS.".`userid` = '".$_GET["employee"]."'" : "")."
					".(($_GET["see"]) ? " AND ".CUSTOMERS.".`see` = '".$_GET["see"]."'" : "AND ".CUSTOMERS.".`see` != '6'")."
					
				ORDER BY
					".CALLS.".`datecall`, ".CALLS.".`starttime`
			", rows_object);
			
			App::debug($Calls);
			
			return $Calls;
			
		}
		
	}