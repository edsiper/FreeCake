<?

class OauthController extends AppController {
  /* global */
  var $components = Array('Freecake');
  var $name = 'Oauth';
  
  function index() {
    if ($this->Session->check('access_key') == False) {
      /* Freelancer object */
      $this->Freecake->init();

      /* token */
      $token = $this->Session->read('token');
      if($token == null) {
        $token = $this->Freecake->Auth->get_request_token();
        $this->Session->write('token', $token);
      }

      /* variables */
      $this->set('freelancer_logged', False);
      $this->set('auth_url', $this->Freelancer->Auth->get_auth_url());
    }
    else {
      $this->set('freelancer_logged', True);
      $this->redirect(array('controller' => 'Users', 'action' => 'index'));
    }
  }
  
  function callback() {
    /* The token is mandatory at this stage */
    if ($this->Session->check('token') == False) {
      //debug("Invalid callback token by consumer");
      $this->redirect(array('controller' => 'oauth', 'action' => 'logout'));
      exit;
    }

    if (!isset($this->params['url']['oauth_token']) || 
        !isset($this->params['url']['oauth_verifier'])) {
     
      debug("Invalid callback oauth_token/oauth_verifier by provider");
      $this->redirect(array('controller' => 'oauth', 'action' => 'logout'));
      exit;
    }

    /* Init for private access */
    $token = $this->Session->read('token');
    $this->Freelancer->init($token['oauth_token'], $token['oauth_token_secret']);

    $verifier = $this->params['url']['oauth_verifier'];

    /* access key */
    $access_key = $this->Freelancer->Auth->get_access_key($verifier);
    $this->Session->write('access_key', $access_key);
    $this->redirect(array('controller' => 'Users', 'action' => 'index'));
  }

  function nocallback() {
  }

  function logout() {
    $this->Session->delete('access_key');
    $this->Session->delete('token');

    /* set by users controller */
    $this->Session->delete('ss_user_info');

    $this->redirect(array('controller' => 'Oauth', 'action' => 'step_logout'));
  }

  function step_logout() {
    $this->redirect(array('controller' => '/', 'action' => 'index'));
  }

  function beforeFilter() {
    $this->Session->activate();
  }
}
