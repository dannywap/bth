<?php
/**
* Main class for Lydia, holds everything.
*
* @package LydiaCore
*/
class CLydia implements ISingleton {

	/**
	* Members
	*/
	private static $instance = null;
	public $config = null;
	public $request = null;
	public $data = null;
	public $db = null;
	public $views = null;
	public $session = null;
	

	/**
	* Constructor
	*/
	protected function __construct() {
		// include the site specific config.php and create a ref to $ly to be used by config.php
		$ly = &$this;
		require(LYDIA_SITE_PATH.'/config.php');

	    // Start a named session
		session_name($this->config['session_name']);
		session_start();
		$this->session = new CSession($this->config['session_key']);
		$this->session->PopulateFromSession();

		// Set default date/time-zone
		date_default_timezone_set($this->config['timezone']);

		// Create a database object.
		if(isset($this->config['database'][0]['dsn'])) {
		   $this->db = new CMDatabase($this->config['database'][0]['dsn'],$this->config['database'][0]['user'],$this->config['database'][0]['password']);
		}
				
		// Create a container for all views and theme data
		$this->views = new CViewContainer();
		
		// Create a object for the user
		$this->user = new CMUser($this);
	}
	  
	  
	  /**
	* Singleton pattern. Get the instance of the latest created object or create a new one.
	* @return CLydia The instance of this class.
	*/
	public static function Instance() {
		if(self::$instance == null) {
			self::$instance = new CLydia();
		}
		return self::$instance;
	}


	/**
	* Frontcontroller, check url and route to controllers.
	*/
	public function FrontControllerRoute() {
		// Take current url and divide it in controller, method and parameters
		$this->request = new CRequest($this->config['url_type']);
		$this->request->Init($this->config['base_url'], $this->config['routing']);
		$controller = $this->request->controller;
		$method = $this->request->method;
		$arguments = $this->request->arguments;
		
		// Is the controller enabled in config.php?
		$controllerExists = isset($this->config['controllers'][$controller]);
		$controllerEnabled = false;
		$className	= false;
		$classExists = false;

		if($controllerExists) {
			$controllerEnabled = ($this->config['controllers'][$controller]['enabled'] == true);
			$className	= $this->config['controllers'][$controller]['class'];
			$classExists = class_exists($className);
		}
		
		// Check if controller has a callable method in the controller class, if then call it
		if($controllerExists && $controllerEnabled && $classExists) {
		  $rc = new ReflectionClass($className);
		  if($rc->implementsInterface('IController')) {
			 $formattedMethod = str_replace(array('_', '-'), '', $method);
			if($rc->hasMethod($formattedMethod)) {
			  $controllerObj = $rc->newInstance();
			  $methodObj = $rc->getMethod($formattedMethod);
			  if($methodObj->isPublic()) {
				$methodObj->invokeArgs($controllerObj, $arguments);
			  } else {
				die("404. " . get_class() . ' error: Controller method not public.');
			  }
			} else {
			  die("404. " . get_class() . ' error: Controller does not contain method.');
			}
		  } else {
			die('404. ' . get_class() . ' error: Controller does not implement interface IController.');
		  }
		}
		else {
		  die('404. Page is not found.');
		}
	}
	  
	  
	/**
	* ThemeEngineRender, renders the reply of the request to HTML or whatever.
	*/
	public function ThemeEngineRender() {
	    // ARRRGGH!!! Det var denna jag hade glömt!!!!:
		$this->session->StoreInSession();
	
	
		// Is theme enabled?
		if(!isset($this->config['theme'])) {  return; }
		if(isset($this->config['theme']['data'])) {
			extract($this->config['theme']['data']);
		}
		
		// Get the paths and settings for the theme, look in the site dir first
		$themePath  = LYDIA_INSTALL_PATH . '/' . $this->config['theme']['path'];
		$themeUrl   = $this->request->base_url . $this->config['theme']['path'];

		
		// Is there a parent theme?
		$parentPath = null;
		$parentUrl = null;
		if(isset($this->config['theme']['parent'])) {
			$parentPath = LYDIA_INSTALL_PATH . '/' . $this->config['theme']['parent'];
			$parentUrl  = $this->request->base_url . $this->config['theme']['parent'];
		}
		
		// Add stylesheet path to the $ly->data array
		// $this->data['stylesheet'] = "{$themeUrl}/style.css";
		// $this->data['stylesheet'] = "{$themeUrl}/".$this->config['theme']['stylesheet'];
		$this->data['stylesheet'] = $this->config['theme']['stylesheet'];

		// Make the theme urls available as part of $ly
		$this->themeUrl = $themeUrl;
		$this->themeParentUrl = $parentUrl;

		// Map menu to region if defined
		if(is_array($this->config['theme']['menu_to_region'])) {
			foreach($this->config['theme']['menu_to_region'] as $key => $val) {
				$this->views->AddString($this->DrawMenu($key), null, $val);
			}
		}

		// Include the global functions.php and the functions.php that are part of the theme
		$ly = &$this;
		// First the default Lydia themes/functions.php
		include(LYDIA_INSTALL_PATH . '/themes/functions.php');
		// Then the functions.php from the parent theme
		if($parentPath) {
			if(is_file("{$parentPath}/functions.php")) {
				include "{$parentPath}/functions.php";
			}
		}
		// And last the current theme functions.php
		if(is_file("{$themePath}/functions.php")) {
			include "{$themePath}/functions.php";
		}

		// Extract $ly->data to own variables and handover to the template file
		extract($this->data); // OBSOLETE, use $this->views->GetData() to set variables
		extract($this->views->GetData());
		if(isset($this->config['theme']['data'])) {
			extract($this->config['theme']['data']);
		}

		// Execute the template file
		$templateFile = (isset($this->config['theme']['template_file'])) ? $this->config['theme']['template_file'] : 'default.tpl.php';
		if(is_file("{$themePath}/{$templateFile}")) {
			include("{$themePath}/{$templateFile}");
		} else if(is_file("{$parentPath}/{$templateFile}")) {
			include("{$parentPath}/{$templateFile}");
		} else {
			throw new Exception('No such template file.');
		}
	}

	
	/**
	* Draw HTML for a menu defined in $ly->config['menus'].
	*
	* @param $menu string then key to the menu in the config-array.
	* @returns string with the HTML representing the menu.
	*/
	public function DrawMenu($menu) {
		$items = null;
		if(isset($this->config['menus'][$menu])) {
		  foreach($this->config['menus'][$menu] as $val) {
			$selected = null;
			if($val['url'] == $this->request->request || $val['url'] == $this->request->routed_from) {
			  $selected = " class='selected'";
			}
			$items .= "<li><a {$selected} href='" . $this->request->CreateUrl($val['url']) . "'>{$val['label']}</a></li>\n";
		  }
		} else {
		  throw new Exception('No such menu.');
		}     
		return "<ul class='menu {$menu}'>\n{$items}</ul>\n";
	}

	
	
}
?>
