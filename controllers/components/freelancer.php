<?php
/*
 * Freelancer.com Provider Component for CakePHP
 * Copyright (c) 2010 Eduardo Silva Pereira
 * http://edsiper.linuxchile.cl
 *
 * @author      Eduardo Silva <edsiper@gmail.com>
 * @version     1.0
 * @license     GPL
 *
 */

/* Add path to vendor classes */
$path = getcwd().'/../vendors/freelancer/';
set_include_path(get_include_path() . PATH_SEPARATOR . $path);

/* Import Freelancer vendor library */
App::import('Vendor', 'Freelancer', array('file' => 'freelancer/SnowTigerLib.php'));

class FreelancerComponent extends Object {
  function FreelancerComponent() {
  }

  function init($token = null, $verifier = null) {
    if ($token != null && $verifier != null) {
      $this->lib = new SnowTigerLib($token, $verifier);
    }
    else {
      $this->lib = new SnowTigerLib();
    }
  }

  /* Auth methods */
  function get_access_key($oauth_verifier) {
    return $this->lib->getRequestAccessToken($oauth_verifier);
  }

  function get_token() {
    return $this->lib->getRequestToken();
  }
  
  function get_auth_url() {
    return $this->lib->getAuthorizeURL();
  }

  /* Public methods */
  function get_account_details() {
    return $this->lib->getAccountDetails()->getArrayData();
  }
  
  function get_job_list() {
    return $this->lib->getJobList()->getArrayData();
  }

  function get_my_job_list() {
    return $this->lib->getMyJobList()->getArrayData();
  }
}
