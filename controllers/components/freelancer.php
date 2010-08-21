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

  function get_request_token() {
    return $this->lib->getRequestToken();
  }
  
  function get_request_token_verifier() {
    return $this->lib->getRequestTokenVerifier();
  }

  function get_authorize_url() {
    return $this->lib->getAuthorizeURL();
  }

  function get_request_access_token($oauth_verifier = '') {
    return $this->lib->getRequestAccessToken($oauth_verifier);
  }

  /* User methods */
  function get_users_by_search($param = array()) {
    return $this->lib->getUsersBySearch($param);
  }

  function get_user_feedback($param = array()) {
    return $this->lib->getUserFeedback($param);
  }

  function get_pending_feedback($type = 'B') {
    return $this->lib->getPendingFeedback($type);
  }

  function get_user_details($param = array()) {
    return $this->lib->getUserDetails($param);
  }

  /* Job Methods */
  function get_job_list() {
    return $this->lib->getJobList();
  }

  function get_my_job_list() {
    return $this->lib->getMyJobList();
  }

  function get_category_job_list() {
    return $this->lib->getCategoryJobList();
  }

  function get_profile_info($userid) {
    return $this->lib->getProfileInfo($userid);
  }

  /* Update user information */
  function set_profile_info($param = array()) {
    return $this->lib->setProfileInfo($param);
  }

  /* Employer */
  function post_new_project($param = array()) {
    return $this->lib->postNewProject($param);
  }

  function post_new_trial_project($param = array()) {
    return $this->lib->postNewTrialProject($param);
  }
  
  function post_new_draft_project($param = array()) {
    return $this->lib->postNewDraftProject($param);
  }

  function choose_winner_for_project($projectid, $useridcsv) {
    return $this->lib->chooseWinnerForProject($projectid, $useridcsv);
  }

  function get_posted_project_list($param = array()) {
    return $this->lib->getPostedProjectList($param = array());
  }

  function invite_user_for_project($param = array()) {
    return $this->lib->inviteUserForProject($param);
  }
  
  function update_project_details($param = array()) {
    return $this->lib->updateProjectDetails($param);
  }

  function elegible_for_trial_project() {
    return $this->lib->elegibleForTrialProject();
  }

  function get_project_list_for_placed_bids($param = array()) {
    return $this->lib->getProjectListForPlacedBids($param);
  }

  function place_bid_on_project($param = array()) {
    return $this->lib->placeBidOnProject($param);
  }

  function retract_bid_from_project($projectid) {
    return $this->lib->retractBidFromProject($projectid);
  }

  function accept_bid_won($projectid, $state = 1) {
    return $this->lib->acceptBidWon($projectid, $state);
  }

  function request_cancel_project($param = array()) {
    return $this->lib->requestCancelProject($param);
  }

  function post_feedback($param = array()) {
    return $this->lib->postFeedback($param);
  }

  function post_reply_for_feedback($param = array()) {
    return $this->lib->postReplyForFeedback($param);
  }

  function request_withdraw_feedback($param = array()) {
    return $this->lib->requestWithdrawFeedback($param);
  }

  function get_config_version($function) {
    return $this->lib->getConfigVersion($function);
  }

  function get_terms() {
    return $this->lib->getTerms();
  }

  /* Payment methods */

  function get_account_balance_status() {
    return $this->lib->getAccountBalanceStatus();
  }

  function get_account_transaction_list($param = array()) {
    return $this->lib->getAccountTransactionList($param);
  }

  function request_withdrawal($param = array()) {
    return $this->lib->requestWithdrawal($param);
  }

  function create_milestone_payment($param = array()) {
    return $this->lib->createMilestonePayment($param);
  }

  function transfer_money($param = array()) {
    return $this->lib->transferMoney($param);
  }

  function request_cancel_withdrawal($withdrawal_id) {
    return $this->lib->requestCancelWithdrawal($withdrawal_id);
  }

  function cancel_milestone($transaction_id) {
    return $this->lib->cancelMilestone($transaction_id);
  }

  function get_account_milestone_list($type = 'Incoming', $count = 50, $page = 0) {
    return $this->lib->getAccountMilestoneList($type, $count, $page);
  }

  function get_account_withdrawal_list($type = 'Incoming', $count = 50, $page = 0) {
    return $this->lib->getAccountWithdrawalList($type, $count, $page);
  }

  
}
