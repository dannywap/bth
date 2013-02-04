<?php
/**
* A user controller to manage login and view edit the user profile.
*
* @package LydiaCore
*/
class CCUser extends CObject implements IController {


  /**
* Constructor
*/
  public function __construct() {
    parent::__construct();
  }


  /**
* Show profile information of the user.
*/
  public function Index() {
    $this->views->SetTitle('User Controller')
                ->AddInclude(__DIR__ . '/index.tpl.php', array(
                  'is_authenticated'=>$this->user['isAuthenticated'],
                  'user'=>$this->user,
                ),'primary');
  }
  

  /**
* View and edit user profile.
*/
  public function Profile() {
    $form = new CFormUserProfile($this, $this->user);
    $form->Check();
	$users = new CMUser();
	
	if($this->user['isAuthenticated']){
		$this->views->SetTitle('User Profile')
                ->AddInclude(__DIR__ . '/profile.tpl.php', array(
                  'is_authenticated'=>$this->user['isAuthenticated'],
                  'user'=>$this->user,
                  'profile_form'=>$form->GetHTML(),
				  ),'primary')
				  ->AddInclude(__DIR__ . '/profile_sidebar.tpl.php', array(
                  'is_authenticated'=>$this->user['isAuthenticated'],
                  'user'=>$this->user,
				  'isAdmin'=>$this->user['hasRoleAdmin'],
				  'user_list_admins'=>$users->list_users(1),
				  'user_list_users'=>$users->list_users(2),
                  'profile_form'=>$form->GetHTML(),
				  ),'sidebar');
	}
	
  }
  
	/**
	* Make user an Admin.
	*/
	public function DoMakeAdmin($user) {
		$users = new CMUser();
		if($this->user['hasRoleAdmin']) {
			if($users->UserMakeAdmin($user)){
				$this->AddMessage('success', "Successfully added {$user} to Admins role.");
			}else{
				$this->AddMessage('error', "Failed to add {$user} to Admins role.");
			}
		}
		$this->RedirectToController('profile');
	}
	
	/**
	* Remove user from Admin.
	*/
	public function DoRemoveAdmin($user) {
		$users = new CMUser();
		if($this->user['hasRoleAdmin']) {
			if($users->UserRemoveAdmin($user)){
				$this->AddMessage('success', "Successfully removed {$user} from Admins role.");
			}else{
				$this->AddMessage('error', "Failed to remove {$user} from Admins role.");
			}
		}
		$this->RedirectToController('profile');
	}

  	/**
	* Delete user Completely.
	*/
	public function DoDeleteUser($user) {
		$users = new CMUser();
		if($this->user['hasRoleAdmin']) {
			$users->UserDeleteUser($user)>0;
			$this->AddMessage('success', "Successfully deleted {$user} forever and ever.");
		}
		$this->RedirectToController('profile');
	}

  
  

  /**
* Change the password.
*/
  public function DoChangePassword($form) {
    if($form['password']['value'] != $form['password1']['value'] || empty($form['password']['value']) || empty($form['password1']['value'])) {
      $this->AddMessage('error', 'Password does not match or is empty.');
    } else {
      $ret = $this->user->ChangePassword($form['password']['value']);
      $this->AddMessage($ret, 'Saved new password.', 'Failed updating password.');
    }
    $this->RedirectToController('profile');
  }
  

  /**
* Save updates to profile information.
*/
  public function DoProfileSave($form) {
    $this->user['name'] = $form['name']['value'];
    $this->user['email'] = $form['email']['value'];
    $ret = $this->user->Save();
    $this->AddMessage($ret, 'Saved profile.', 'Failed saving profile.');
    $this->RedirectToController('profile');
  }
  

 /**
   * Authenticate and login a user.
   */
  public function Login() {
    $form = new CFormUserLogin($this);
    if($form->Check() === false) {
      $this->AddMessage('notice', 'Some fields did not validate and the form could not be processed.');
      $this->RedirectToController('login');
    }
    $this->views->SetTitle('Login')
                ->AddInclude(__DIR__ . '/login.tpl.php', array(
					'login_form'=>$form,
					'allow_create_user' => CLydia::Instance()->config['create_new_users'],
					'create_user_url' => CLydia::Instance()->request->CreateUrl(null, 'create')),
					'primary');     
  }  

  /**
* Perform a login of the user as callback on a submitted form.
*/
  public function DoLogin($form) {
    if($this->user->Login($form['acronym']['value'], $form['password']['value'])) {
      $this->AddMessage('success', "Welcome {$this->user['name']}.");
      $this->RedirectToController('profile');
    } else {
      $this->AddMessage('error', "Failed to login, user does not exist or password does not match.");
      $this->RedirectToController('login');
    }
  }
  

  /**
* Logout a user.
*/
  public function Logout() {
    $this->user->Logout();
    $this->RedirectToController();
  }
  
  /**
   * Create a new user.
   */
  public function Create() {
    $form = new CFormUserCreate($this);
    if($form->Check() === false) {
      $this->AddMessage('notice', 'You must fill in all values.');
      $this->RedirectToController('Create');
    }
    $this->views->SetTitle('Create user')
                ->AddInclude(__DIR__ . '/create.tpl.php', array('form' => $form->GetHTML()),'primary');     
  }  

  /**
   * Perform a creation of a user as callback on a submitted form.
   *
   * @param $form CForm the form that was submitted
   */
  public function DoCreate($form) {   
    if($form['password']['value'] != $form['password1']['value'] || empty($form['password']['value']) || empty($form['password1']['value'])) {
      $this->AddMessage('error', 'Password does not match or is empty.');
      $this->RedirectToController('create');
    } else if($this->user->Create($form['acronym']['value'],
                           $form['password']['value'],
                           $form['name']['value'],
                           $form['email']['value']
                           )) {
      $this->AddMessage('success', "Welcome {$this->user['name']}. Your have successfully created a new account.");
      $this->user->Login($form['acronym']['value'], $form['password']['value']);
      $this->RedirectToController('profile');
    } else {
      $this->AddMessage('notice', "Failed to create an account.");
      $this->RedirectToController('create');
    }
  }  
  
  
  /**
* Init the user database.
*/
  public function Init() {
    $this->user->Init();
    $this->RedirectToController();
  }
  

} 
?>
