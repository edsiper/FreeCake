<?

echo "<h1>Welcome ".$user_info['fullname']."</h1>";

echo "<br>".$html->link('Click here to close your session',
                        array('controller' => 'Oauth', 'action' => 'logout'));

echo "<br><br>";
echo "Your username is <b>".$user_info['username']."</b> and your GAF ID is <b>".$user_info['userid']."</b><br><br>";

debug($user_info);
