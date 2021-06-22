<?php

class loginState 
{

    public static function createRecord($dbh, $usr_email, $user_acctNo)
    {

        // $dbh->prepare('DELETE FROM tbl_sessions WHERE sessions_userid= :ssionUserId;')->execute();

        $token = loginState::createString(32);
        $serial = loginState::createString(32);

        loginState::createCookie($usr_email, $user_acctNo, $token, $serial);
        loginState::createSession($usr_email, $user_acctNo, $token, $serial);

        $stmt = $dbh->prepare('INSERT INTO `tbl_sessions`(`sessions_id`, `sessions_userid`, `sessions_token`, `sessions_serial`, `sessions_date`) VALUES (null, :usr_acctNo, :token, :serial, "18/11/2019")');
        $stmt->execute(array (':usr_email' => $usr_email, ':token' => $token, ':serial' => $serial));
    }

    public static function createCookie($usr_email, $user_acctNo, $token, $serial)
    {
        setcookie('usr_acctNo', $user_acctNo, time() + (86400) * 30, "/");
        setcookie('usr_email', $usr_email, time() + (86400) * 30, "/");
        setcookie('token', $token, time() + (86400) * 30, "/");
        setcookie('serial', $serial, time() + (86400) * 30, "/");
    }

    public static function createSession($usr_email, $user_acctNo, $token, $serial)
    {
        if (!isset($_SESSION['id']) || !isset($_COOKIE['PHPSESSID']))
        {
            session_start();
        }
        $_SESSION['usr_email'] =  $usr_email;
    }



    public static function checkLoginState($dbh)
    {
        if (!isset($_SESSION['id']) || !isset($_COOKIE['PHPSESSID']))
        {
            session_start();
        }
        if (isset($_COOKIE['id']) && isset($_COOKIE['token']) && isset($_COOKIE['serial']))
        {
            $userid = $_COOKIE['userid'];
            $token = $_COOKIE['token'];
            $serial = $_COOKIE['serial'];

            $stmt = $dbh->prepare("SELECT * FROM tbl_sessions WHERE sessions_userid = :userid AND sessions_token = :token AND sessions_serial = :serial");
            $stmt->execute(array(':userid' => $userid, ':token' => $token, ':serial' => $serial));

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if($row['sessions_userid'] > 0)
            {
                if (
                    $row['sessions_userid'] == $_COOKIE['userid'] &&
                    $row['sessions_token'] == $_COOKIE['token'] &&
                    $row['sessions_serial'] == $_COOKIE['serial']
                )
                {
                    if (
                        $row['sessions_userid'] == $_SESSION['userid'] &&
                        $row['sessions_token'] == $_SESSION['token'] &&
                        $row['sessions_serial'] == $_SESSION['serial']
                    ){
                        return true;
                    }
                }
            }
        }
    }

    public static function createString($len)
    {
        $string = "lqay2wsx3edc4rfv5tgbzhn7ujm8ik9olpAQWSXEDCVFRTGBNHYUJMKILOP";
        $s = '';
        $r_new = '';
        $r_old = '';

        for ($i = 1; $i < $len; $i++){
            while ($r_old == $r_new)
            {
                $r_new = rand(0, 60);
            }
            $r_old = $r_new;

            $s = $s.$string[$r_new];
        }

        return $s;
    }

   

}


?>