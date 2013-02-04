<?php
/**
* Sample controller for a site builder.
*/
class CCMycontroller extends CObject implements IController {

  /**
   * Constructor
   */
  public function __construct() { parent::__construct(); }
 

  /**
   * The page about me
   */
  public function Index() {
    $content = new CMContent(10);
    $this->views->SetTitle('My own controller ')
                ->AddInclude(__DIR__ . '/page.tpl.php', array(
                  'content' => $content,
                ),'primary')
                ->AddInclude(__DIR__ . '/sidebar.tpl.php', array(
                ),'sidebar');
  }


  /**
   * The blog.
   */
  public function Blog() {
    $content = new CMContent();
    $this->views->SetTitle('My blog')
                ->AddInclude(__DIR__ . '/blog.tpl.php', array(
                  'contents' => $content->ListAll(array('type'=>'post', 'order-by'=>'title', 'order-order'=>'DESC')),
                ),'primary')
                ->AddInclude(__DIR__ . '/sidebar.tpl.php', array(
                ),'sidebar');
  }


  /**
   * The guestbook.
   */
  public function Guestbook() {
    $guestbook = new CMGuestbook();
    $form = new CFormMyGuestbook($guestbook);
    $status = $form->Check();
    if($status === false) {
      $this->AddMessage('notice', 'The form could not be processed.');
      $this->RedirectToControllerMethod();
    } else if($status === true) {
      $this->RedirectToControllerMethod();
    }
   
    $this->views->SetTitle('My Guestbook')
				->AddInclude(__DIR__ . '/guestbook.tpl.php', array(
					'entries'=>$guestbook->ReadAll(),
					'form'=>$form,
				 ),'primary')
                ->AddInclude(__DIR__ . '/sidebar.tpl.php', array(
                ),'sidebar');
  }
 

}


/**
* Form for the guestbook
*/
class CFormMyGuestbook extends CForm {

  /**
   * Properties
   */
  private $object;

  /**
   * Constructor
   */
  public function __construct($object) {
    parent::__construct();
    $this->objecyt = $object;
    $this->AddElement(new CFormElementTextarea('data', array('label'=>'Add entry:')))
         ->AddElement(new CFormElementSubmit('add', array('callback'=>array($this, 'DoAdd'), 'callback-args'=>array($object))));
  }
 

  /**
   * Callback to add the form content to database.
   */
  public function DoAdd($form, $object) {
    return $object->Add(strip_tags($form['data']['value']));
  }


}
?>