<?
#	TAS Telefoon Registratie Systeem
#	Built: 11-May-2011   /  Created by: LR Design Websolutions Venray - Robert van Klooster

#	System functions
	defined('SYSTEMACCESS') or die('Geen directe toegang mogelijk!');

#	Modules
	class Modules
	{
		function groups($group)
		{
			switch($group)
			{
				case 0:
					$modules = array(
  						array('id' => '1',  'module_name' => Lang::menu('register-new-call')	, 'active' => 'yes', 'directory' => 'register-new-call'),
						array('id' => '2',  'module_name' => Lang::menu('register-edit-call')	, 'active' => 'yes', 'directory' => 'register-edit-call'),
						array('id' => '3',  'module_name' => Lang::menu('register-send-call')	, 'active' => 'yes', 'directory' => 'register-send-call'),
						array('id' => '4',  'module_name' => Lang::menu('register-archive-call'), 'active' => 'yes', 'directory' => 'register-archive-call')
					);
				break;
				case 1:
					$modules = array(
						array('id' => '5',  'module_name' => Lang::menu('service-customer-info'), 'active' => 'yes', 'directory' => 'service-customer-info'),
						array('id' => '6',  'module_name' => Lang::menu('service-departments')	, 'active' => 'yes', 'directory' => 'service-departments'),
						array('id' => '7',  'module_name' => Lang::menu('service-abbreviations'), 'active' => 'yes', 'directory' => 'service-abbreviations')
					);
				break;
				case 2:
					$modules = array(
						array('id' => '8',  'module_name' => Lang::menu('invoice-overview')		, 'active' => 'yes', 'directory' => 'invoice-overview')
					);
				break;
				case 3:
					$modules = array(
						array('id' => '9',  'module_name' => Lang::menu('users-control')		, 'active' => 'yes', 'directory' => 'users-control'),
						array('id' => '10',  'module_name' => Lang::menu('system-config')		, 'active' => 'yes', 'directory' => 'system-config'),
						array('id' => '11',  'module_name' => Lang::menu('system-backup')		, 'active' => 'yes', 'directory' => 'system-backup')
					);
				break;
			}
			return $modules;
		}
	}
?>