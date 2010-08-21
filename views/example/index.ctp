<?

if ($logged == True) {
  echo "User logged";
}
else {
  echo "No user session found.".$html->link("Start authentication process",
                                            array('controller' => 'Oauth', 
                                                  'action' => 'index'));
}