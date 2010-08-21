<?

class ExampleController extends AppController {
  /* global */
  var $name = 'Example';
  
  function index() {
  }

  function beforeFilter() {
    $this->Session->activate();
  }
}
