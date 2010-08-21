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
App::import('Vendor', 'Freecake', array('file' => 'freecake/SnowTigerLib.php'));

class FreecakeComponent extends Object {

  function FreecakeComponent() {
    
  }

  function init($token = null, $verifier = null) {
    if ($token != null && $verifier != null) {
      $lib = new SnowTigerLib($token, $verifier);
    }
    else {
      $lib = new SnowTigerLib();
    }

    /* Subclasses for organized Freelancer.com API methods */
    $this->Auth = new FreelancerAuth($lib);
    $this->User = new FreelancerUser($lib);
    $this->Job  = new FreelancerJob($lib);
    $this->Profile = new FreelancerProfile($lib);
    $this->Employer = new FreelancerEmployer($lib);
    $this->Freelancer = new FreelancerFreelancer($lib);
    $this->Common = new FreelancerCommon($lib);
    $this->Payment = new FreelancerPayment($lib);
    $this->Notification = new FreelancerNotification($lib);
    $this->Project = new FreelancerProject($lib);
    $this->Message = new FreelancerMessage($lib);

    $this->lib = $lib;
  }
}

class FreelancerBase {
  function FreelancerBase($library) {
    $this->lib = $library;
  }
}

/* Auth class/methods */
class FreelancerAuth extends FreelancerBase {

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
}

/* User class/methods */
class FreelancerUser extends FreelancerBase {
  function get_users_by_search($param = array()) {
    return $this->lib->getUsersBySearch($param)->getArrayData();
  }

  function get_user_feedback($param = array()) {
    return $this->lib->getUserFeedback($param)->getArrayData();
  }

  function get_pending_feedback($type = 'B') {
    return $this->lib->getPendingFeedback($type)->getArrayData();
  }

  function get_user_details($param = array()) {
    return $this->lib->getUserDetails($param)->getArrayData();
  }
}

/* Job class/methods */
class FreelancerJob extends FreelancerBase {

  function get_job_list() {
    return $this->lib->getJobList()->getArrayData();
  }

  function get_my_job_list() {
    return $this->lib->getMyJobList()->getArrayData();
  }

  function get_category_job_list() {
    return $this->lib->getCategoryJobList()->getArrayData();
  }

}

/* Profile class/methods */
class FreelancerProfile extends FreelancerBase {

  function get_account_details() {
    return $this->lib->getAccountDetails()->getArrayData();
  }

  function get_profile_info($userid) {
    return $this->lib->getProfileInfo($userid)->getArrayData();
  }

  function set_profile_info($param = array()) {
    return $this->lib->setProfileInfo($param)->getArrayData();
  }
}

/* Employer class/methods */
class FreelancerEmployer extends FreelancerBase {

  function post_new_project($param = array()) {
    return $this->lib->postNewProject($param)->getArrayData();
  }

  function post_new_trial_project($param = array()) {
    return $this->lib->postNewTrialProject($param)->getArrayData();
  }
  
  function post_new_draft_project($param = array()) {
    return $this->lib->postNewDraftProject($param)->getArrayData();
  }

  function choose_winner_for_project($projectid, $useridcsv) {
    return $this->lib->chooseWinnerForProject($projectid, $useridcsv)->getArrayData();
  }

  function get_posted_project_list($param = array()) {
    return $this->lib->getPostedProjectList($param = array())->getArrayData();
  }

  function invite_user_for_project($param = array()) {
    return $this->lib->inviteUserForProject($param)->getArrayData();
  }
  
  function update_project_details($param = array()) {
    return $this->lib->updateProjectDetails($param)->getArrayData();
  }

  function elegible_for_trial_project() {
    return $this->lib->elegibleForTrialProject()->getArrayData();
  }
}

/* Freelancer class/methods */
class FreelancerFreelancer extends FreelancerBase {

  function get_project_list_for_placed_bids($param = array()) {
    return $this->lib->getProjectListForPlacedBids($param)->getArrayData();
  }

  function place_bid_on_project($param = array()) {
    return $this->lib->placeBidOnProject($param)->getArrayData();
  }

  function retract_bid_from_project($projectid) {
    return $this->lib->retractBidFromProject($projectid)->getArrayData();
  }
}

/* Common class/methods */
class FreelancerCommon extends FreelancerBase {

  function accept_bid_won($projectid, $state = 1) {
    return $this->lib->acceptBidWon($projectid, $state)->getArrayData();
  }

  function request_cancel_project($param = array()) {
    return $this->lib->requestCancelProject($param)->getArrayData();
  }

  function post_feedback($param = array()) {
    return $this->lib->postFeedback($param)->getArrayData();
  }

  function post_reply_for_feedback($param = array()) {
    return $this->lib->postReplyForFeedback($param)->getArrayData();
  }

  function request_withdraw_feedback($param = array()) {
    return $this->lib->requestWithdrawFeedback($param)->getArrayData();
  }

  function get_config_version($function) {
    return $this->lib->getConfigVersion($function)->getArrayData();
  }

  function get_terms() {
    return $this->lib->getTerms()->getArrayData();
  }
}

/* Payment class/methods */
class FreelancerPayment extends FreelancerBase {

  function get_account_balance_status() {
    return $this->lib->getAccountBalanceStatus()->getArrayData();
  }

  function get_account_transaction_list($param = array()) {
    return $this->lib->getAccountTransactionList($param)->getArrayData();
  }

  function request_withdrawal($param = array()) {
    return $this->lib->requestWithdrawal($param)->getArrayData();
  }

  function create_milestone_payment($param = array()) {
    return $this->lib->createMilestonePayment($param)->getArrayData();
  }

  function transfer_money($param = array()) {
    return $this->lib->transferMoney($param)->getArrayData();
  }

  function request_cancel_withdrawal($withdrawal_id) {
    return $this->lib->requestCancelWithdrawal($withdrawal_id)->getArrayData();
  }

  function cancel_milestone($transaction_id) {
    return $this->lib->cancelMilestone($transaction_id)->getArrayData();
  }

  function get_account_milestone_list($type = 'Incoming', $count = 50, $page = 0) {
    return $this->lib->getAccountMilestoneList($type, $count, $page)->getArrayData();
  }

  function get_account_withdrawal_list($type = 'Incoming', $count = 50, $page = 0) {
    return $this->lib->getAccountWithdrawalList($type, $count, $page)->getArrayData();
  }

  function request_release_milestone($transaction_id) {
    return $this->lib->requestReleaseMilestone($transaction_id)->getArrayData();
  }

  function release_milestone($transaction_id, $fullname) {
    return $this->lib->releaseMilestone($transaction_id, $fullname)->getArrayData();
  }

  function prepare_transfer($project_id, $amount, $to_user_id, $reason_type = 'full') {
    return $this->lib->prepareTransfer($project_id, $amount, $to_user_id, $reason_type)->getArrayData();
  }

  function get_balance() {
    return $this->lib->getBalance()->getArrayData();
  }

  function get_project_list_for_transfer() {
    return $this->lib->getProjectListForTransfer()->getArrayData();
  }

  function get_withdrawal_fees() {
    return $this->lib->getWithdrawalFees()->getArrayData();
  }
}

/* Notification class/methods */
class FreelancerNotification extends FreelancerBase {

  function get_notification() {
    return $this->lib->getNotification()->getArrayData();
  }

  function get_news() {
    return $this->lib->getNews()->getArrayData();
  }
}

/* Project class/methods */
class FreelancerProject extends FreelancerBase {

  function search_projects($param = array()) {
    return $this->lib->searchProjects($param)->getArrayData();
  }

  function get_project_fees() {
    return $this->lib->getProjectFees()->getArrayData();
  }

  function get_project_details($project_id) {
    return $this->lib->getProjectDetails($project_id)->getArrayData();
  }

  function get_bids_details($project_id) {
    return $this->lib->getBidsDetails($project_id)->getArrayData();
  }

  function get_public_messages($project_id) {
    return $this->lib->getPublicMessages($project_id)->getArrayData();
  }

  function post_public_message($param = array()) {
    return $this->lib->postPublicMessage($param)->getArrayData();
  }
}

/* Message class/methods */
class FreelancerMessage extends FreelancerBase {

  function get_inbox_messages($param = array()) {
    return $this->lib->getInboxMessages($param)->getArrayData();
  }

  function get_sent_messages($param = array()) {
    return $this->lib->getSentMessages($param)->getArrayData();
  }

  function get_unread_count() {
    return $this->lib->getUnreadCount()->getArrayData();
  }

  function send_message($param = array()) {
    return $this->lib->sendMessage($param)->getArrayData();
  }

  function mark_message_as_read($id) {
    return $this->lib->markMessageAsRead($id)->getArrayData();
  }

  function load_message_thread($param = array()) {
    return $this->lib->loadMessageThread($param)->getArrayData();
  }
}
