<?php
/**
* A test controller for themes.
*
* @package LydiaCore
*/
class CCTheme extends CObject implements IController {


  /**
   * Constructor
   */
  public function __construct() { parent::__construct();
    $this->views->AddStyle('body:hover{background:#fff url('.$this->request->base_url.'themes/grid/grid_12_60_20.png) repeat-y center top;}');
  }

  /**
   * Display what can be done with this controller.
   */
  public function Index() {
	// $this->SomeRegionsGissa();
	$this->OneRegion();
	// $this->views->SetTitle('Theme')
				// ->AddInclude(__DIR__ . '/index.tpl.php', array(
				  // 'theme_name' => $this->config['theme']['path'],
				  // 'stylesheet' => $this->config['theme']['stylesheet'],
				// ),'primary');

  }
  
  
  /**
   * Put content in some regions.
   */
  public function SomeRegionsGissa() {
    $this->views->SetTitle('Theme display content for some regions')
				->AddString("This is region: featured-middle", array(), 'featured-middle')
				->AddString("This is region: sidebar", array(), 'sidebar')
				->AddString("This is region: triptych-last", array(), 'triptych-last')
				->AddString("This is region: footer-column-one", array(), 'footer-column-one')
                ->AddString('This is the primary region', array(), 'primary')
                ->AddStyle('#'.'primary'.'{background-color:hsla(0,0%,70%,0.5);}');

    if(func_num_args()) {
      foreach(func_get_args() as $val) {
        $this->views->AddString("This is region: $val", array(), $val)
                    ->AddStyle('#'.$val.'{background-color:hsla(0,0%,90%,0.5);}');
      }
    }
  }
  
 
   /**
   * Put content in all regions.
   */
  public function AllRegions() {
    $this->views->SetTitle('Theme display content for all regions');
    foreach($this->config['theme']['regions'] as $val) {
      $this->views->AddString("This is region: $val", array(), $val)
                  ->AddStyle('#'.$val.'{background-color:hsla(0,0%,90%,0.5);}');
    }
  }
  
   /**
   * Put content in one region.
   */
  public function OneRegion() {
    $this->views->SetTitle('Theme display content for H1H6')
                ->AddInclude(__DIR__ . '/h1h6.tpl.php', array(), 'primary');
  }
 
  
  
}
?>