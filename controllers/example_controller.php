<?

class ExampleController extends AppController {

  var $name = 'Example';
  var $components = array('Freecake');

  function index() {
    if ($this->_validate() == False) {
      $this->redirect(array('controller' => 'Oauth', 'action' => 'logout'));
    }
    
    /* Validate user_info session cache */
    if ($this->Session->check('ss_user_info') == False) {
      $this->freecake_init();

      /* Retrieve Freelancer.com profile info */
      $user_info = $this->Freecake->Profile->get_account_details();
      $this->Session->write('ss_user_info', $user_info);
    }
    else {
      $user_info = $this->Session->read('ss_user_info');
    }
    
    /* Export session data to view */
    $this->set('user_info', $user_info);
  }

  /* Init Freelancer object with session keys stored */
  function freecake_init() {
    $k = $this->_get_session_keys();
    return $this->Freecake->init($k['access_key']['oauth_token'], 
                                 $k['access_key']['oauth_token_secret']);
  }
        
  /* Validate user approved session */
  function _validate() {
    $k = $this->_get_session_keys();
   
    if (!$k['token'] || !$k['access_key']) {
      return False;
    }
    
    if (!isset($k['token']['oauth_token']) || 
        !isset($k['token']['oauth_token_secret'])) {
      return False;
    }
    
    if (!isset($k['access_key']['oauth_token']) || 
        !isset($k['token']['oauth_token_secret'])) {
      return False;
    }
    
    return True;
  }
  
  /* Read freelancer session data */
  function _get_session_keys() {
    $token = $this->Session->read('token');
    $access_key = $this->Session->read('access_key');
    
    return array('token' => $token, 'access_key' => $access_key);
  }
        
  function beforeFilter() {
    $this->Session->activate();
  }
}
