<?php
/**
* A model for an authenticated user.
*
* @package LydiaCore
*/
class CMUser extends CObject implements IHasSQL, IModule, ArrayAccess {

  /**
* Properties
*/
  public $profile = array();


  /**
* Constructor
*/
  public function __construct($ly=null) {
    parent::__construct($ly);
    $profile = $this->session->GetAuthenticatedUser();
    $this->profile = is_null($profile) ? array() : $profile;
    $this['isAuthenticated'] = is_null($profile) ? false : true;
  }


  /**
* Implementing ArrayAccess for $this->profile
*/
  public function offsetSet($offset, $value) { if (is_null($offset)) { $this->profile[] = $value; } else { $this->profile[$offset] = $value; }}
  public function offsetExists($offset) { return isset($this->profile[$offset]); }
  public function offsetUnset($offset) { unset($this->profile[$offset]); }
  public function offsetGet($offset) { return isset($this->profile[$offset]) ? $this->profile[$offset] : null; }


  /**
* Implementing interface IHasSQL. Encapsulate all SQL used by this class.
*
* @param string $key the string that is the key of the wanted SQL-entry in the array.
*/
  public static function SQL($key=null) {
    $queries = array(
      'drop table user' => "DROP TABLE IF EXISTS User;",
      'drop table group' => "DROP TABLE IF EXISTS Groups;",
      'drop table user2group' => "DROP TABLE IF EXISTS User2Groups;",
      'create table user' => "CREATE TABLE IF NOT EXISTS User (id INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY, acronym TEXT, name TEXT, email TEXT, password TEXT, created TIMESTAMP default CURRENT_TIMESTAMP, updated TIMESTAMP NULL default NULL);",
      'create table group' => "CREATE TABLE IF NOT EXISTS Groups (id INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY, acronym TEXT, name TEXT, created TIMESTAMP default CURRENT_TIMESTAMP, updated TIMESTAMP NULL default NULL);",
      'create table user2group' => "CREATE TABLE IF NOT EXISTS User2Groups (idUser INTEGER, idGroups INTEGER, created TIMESTAMP default CURRENT_TIMESTAMP, PRIMARY KEY(idUser, idGroups));",
      'insert into user' => 'INSERT INTO User (acronym,name,email,password) VALUES (?,?,?,?);',
      'insert into group' => 'INSERT INTO Groups (acronym,name) VALUES (?,?);',
      'insert into user2group' => 'INSERT INTO User2Groups (idUser,idGroups) VALUES (?,?);',
      'check user password' => 'SELECT * FROM User WHERE password=? AND (acronym=? OR email=?);',
      'get group memberships' => 'SELECT * FROM Groups AS g INNER JOIN User2Groups AS ug ON g.id=ug.idGroups WHERE ug.idUser=?;',
      'update profile' => "UPDATE User SET name=?, email=?, updated=CURRENT_TIMESTAMP WHERE id=?;",
      'update password' => "UPDATE User SET password=?, updated=CURRENT_TIMESTAMP WHERE id=?;",
      'select users by type' => "SELECT acronym FROM `User` u join User2Groups u2g on u.id=u2g.idUser where u2g.idGroups=?;",
      'update user make admin' => "INSERT INTO User2Groups (idUser,idGroups) VALUES ((select id from User where acronym=?),1);",
      'update user remove admin' => "DELETE FROM User2Groups where idGroups=1 and idUser=(select id from User where acronym=?);",
      'delete user from all' => 'set @id=(SELECT id FROM `User` where acronym=?);delete from Content where idUser=@id; delete from User2Groups where idUser=@id;delete from User where id=@id;',

     );
    if(!isset($queries[$key])) {
      throw new Exception("No such SQL query, key '$key' was not found.");
    }
    return $queries[$key];
  }


  /**
* Init the database and create appropriate tables.
*/
  // public function Init() {
    // try {
      // $this->db->ExecuteQuery(self::SQL('drop table user2group'));
      // $this->db->ExecuteQuery(self::SQL('drop table group'));
      // $this->db->ExecuteQuery(self::SQL('drop table user'));
      // $this->db->ExecuteQuery(self::SQL('create table user'));
      // $this->db->ExecuteQuery(self::SQL('create table group'));
      // $this->db->ExecuteQuery(self::SQL('create table user2group'));
      // $this->db->ExecuteQuery(self::SQL('insert into user'), array('root', 'The Administrator', 'root@dbwebb.se', 'root'));
      // $idRootUser = $this->db->LastInsertId();
      // $this->db->ExecuteQuery(self::SQL('insert into user'), array('doe', 'John/Jane Doe', 'doe@dbwebb.se', 'doe'));
      // $idDoeUser = $this->db->LastInsertId();
      // $this->db->ExecuteQuery(self::SQL('insert into group'), array('admin', 'The Administrator Group'));
      // $idAdminGroup = $this->db->LastInsertId();
      // $this->db->ExecuteQuery(self::SQL('insert into group'), array('user', 'The User Group'));
      // $idUserGroup = $this->db->LastInsertId();
      // $this->db->ExecuteQuery(self::SQL('insert into user2group'), array($idRootUser, $idAdminGroup));
      // $this->db->ExecuteQuery(self::SQL('insert into user2group'), array($idRootUser, $idUserGroup));
      // $this->db->ExecuteQuery(self::SQL('insert into user2group'), array($idDoeUser, $idUserGroup));
      // $this->AddMessage('success', 'Successfully created the database tables and created a default admin user as root:root and an ordinary user as doe:doe.');
    // } catch(Exception$e) {
      // die("$e<br/>Failed to open database: " . $this->config['database'][0]['dsn']);
    // }
  // }

    /**
   * Implementing interface IModule. Manage install/update/deinstall and equal actions.
   *
   * @param string $action what to do.
   */
  public function Manage($action=null) {
    switch($action) {
      case 'install':
        try {
          $this->db->ExecuteQuery(self::SQL('drop table user2group'));
          $this->db->ExecuteQuery(self::SQL('drop table group'));
          $this->db->ExecuteQuery(self::SQL('drop table user'));
          $this->db->ExecuteQuery(self::SQL('create table user'));
          $this->db->ExecuteQuery(self::SQL('create table group'));
          $this->db->ExecuteQuery(self::SQL('create table user2group'));
          $this->db->ExecuteQuery(self::SQL('insert into user'), array('anonomous', 'Anonomous, not authenticated', null, null));
          $password = $this->CreatePassword('root');
          $this->db->ExecuteQuery(self::SQL('insert into user'), array('root', 'The Administrator', 'root@dbwebb.se', $password));
          $idRootUser = $this->db->LastInsertId();
          $password = $this->CreatePassword('doe');
          $this->db->ExecuteQuery(self::SQL('insert into user'), array('doe', 'John/Jane Doe', 'doe@dbwebb.se', $password));
          $idDoeUser = $this->db->LastInsertId();
          $this->db->ExecuteQuery(self::SQL('insert into group'), array('admin', 'The Administrator Group'));
          $idAdminGroup = $this->db->LastInsertId();
          $this->db->ExecuteQuery(self::SQL('insert into group'), array('user', 'The User Group'));
          $idUserGroup = $this->db->LastInsertId();
          $this->db->ExecuteQuery(self::SQL('insert into user2group'), array($idRootUser, $idAdminGroup));
          $this->db->ExecuteQuery(self::SQL('insert into user2group'), array($idRootUser, $idUserGroup));
          $this->db->ExecuteQuery(self::SQL('insert into user2group'), array($idDoeUser, $idUserGroup));
          return array('success', 'Successfully created the database tables and created a default admin user as root:root and an ordinary user as doe:doe.');
        } catch(Exception $e) {
          die("$e<br/>Failed to open database: " . $this->config['database'][0]['dsn']);
        }   
      break;
     
      default:
        throw new Exception('Unsupported action for this module.');
      break;
    }
  }

  
  
  
  
  
  
  /**
* Login by autenticate the user and password. Store user information in session if success.
*
* Set both session and internal properties.
*
* @param string $akronymOrEmail the emailadress or user akronym.
* @param string $password the password that should match the akronym or emailadress.
* @returns booelan true if match else false.
*/
  public function Login($akronymOrEmail, $password) {
    $password=self::CreatePassword($password);
    $user = $this->db->ExecuteSelectQueryAndFetchAll(self::SQL('check user password'), array($password, $akronymOrEmail, $akronymOrEmail));
    $user = (isset($user[0])) ? $user[0] : null;
    unset($user['password']);
    if($user) {
      $user['isAuthenticated'] = true;
      $user['groups'] = $this->db->ExecuteSelectQueryAndFetchAll(self::SQL('get group memberships'), array($user['id']));
      foreach($user['groups'] as $val) {
        if($val['id'] == 1) {
          $user['hasRoleAdmin'] = true;
        }
        if($val['id'] == 2) {
          $user['hasRoleUser'] = true;
        }
      }
      $this->profile = $user;
      $this->session->SetAuthenticatedUser($this->profile);
    }
    return ($user != null);
  }
  

  /**
* Logout. Clear both session and internal properties.
*/
  public function Logout() {
    $this->session->UnsetAuthenticatedUser();
    $this->profile = array();
    $this->AddMessage('success', "You have logged out.");
  }
  

  /**
* Save user profile to database and update user profile in session.
*
* @returns boolean true if success else false.
*/
  public function Save() {
    $this->db->ExecuteQuery(self::SQL('update profile'), array($this['name'], $this['email'], $this['id']));
    $this->session->SetAuthenticatedUser($this->profile);
    return $this->db->RowCount() === 1;
  }
  
  
  /**
* Change user password.
*
* @param $password string the new password
* @returns boolean true if success else false.
*/
  public function ChangePassword($password) {
    $password=self::CreatePassword($password);
    $this->db->ExecuteQuery(self::SQL('update password'), array($password, $this['id']));
    return $this->db->RowCount() === 1;
  }
  
  
  /**
   * Create password.
   *
   * $param $plain string the password plain text to use as base.
   */
  public function CreatePassword($plain) {
    $tmppassw = md5("De e la bara so himla fint va?".$plain);
	$tmppassw = substr($tmppassw,6).substr($tmppassw,0,5);
	return md5($plain);
  }
  
    /**
   * Create new user.
   *
   * @param $acronym string the acronym.
   * @param $password string the password plain text to use as base.
   * @param $name string the user full name.
   * @param $email string the user email.
   * @returns boolean true if user was created or else false and sets failure message in session.
   */
  public function Create($acronym, $password, $name, $email) {
    $pwd = $this->CreatePassword($password);
    $this->db->ExecuteQuery(self::SQL('insert into user'), array($acronym, $name, $email, $pwd));
    if($this->db->RowCount() == 0) {
      $this->AddMessage('error', "Failed to create user.");
      return false;
    }
    $this->db->ExecuteQuery(self::SQL('insert into user2group'), array($this->db->LastInsertId(), 2));
    if($this->db->RowCount() == 0) {
      $this->AddMessage('error', "Failed to create user.");
      return false;
    }
    return true;
  }
  
	/**
	* List users.
	*
	* @param $type int, the type of users to return
	* @returns array with users.
	*/
	public function list_users($type) {
		try {
			return $this->db->ExecuteSelectQueryAndFetchAll(self::SQL('select users by type'), array($type));
		} catch(Exception $e) {
			echo $e;
			return null;
		}
	}
	
	/**
	* Grant Admin rights.
	*
	* @param $user string, the acronym of user to add to admins
	* @returns boolean true if success else false.
	*/
	public function UserMakeAdmin($user) {
		$this->UserRemoveAdmin($user);
		$this->db->ExecuteQuery(self::SQL('update user make admin'), array($user));
		return $this->db->RowCount() === 1;
	}
	
	/**
	* Remove Admin rights.
	*
	* @param $user string, the acronym of user to remove from admins
	* @returns boolean true if success else false.
	*/
	public function UserRemoveAdmin($user) {
		$this->db->ExecuteQuery(self::SQL('update user remove admin'), array($user));
		return $this->db->RowCount() === 1;
	}
	
	/**
	* Delete User.
	*
	* @param $user string, the acronym of user to delete from all tables
	* @returns boolean true if success else false.
	*/
	public function UserDeleteUser($user) {
		$this->db->ExecuteQuery(self::SQL('delete user from all'), array($user));
		return $this->db->RowCount();
	}

	
  
}
?>