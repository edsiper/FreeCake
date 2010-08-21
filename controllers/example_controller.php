<?

class ExampleController extends AppController {

  var $name = 'Example';
  
  function index() {

    /* Validate a GAF user session */
    if ($this->Session->check('access_key') == False) {
      $this->set('logged', False);
    }
    else {
      $this->set('logged', True);
    }
  }

  function beforeFilter() {
    $this->Session->activate();
  }
}
