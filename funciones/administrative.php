<?php
@session_start();

include './connect.php';

function is_administrator($login, $password){
    
    $administrator = mysql_query("SELECT login,password FROM administradores WHERE login ='".$login."' AND password ='".$password."' ");
    $rowAdmin = mysql_fetch_array($administrator,MYSQL_NUM);
        
    $users = @mysql_query("SELECT nickName,pass FROM usuarios WHERE nickName = '".$login."' AND pass = '".$password."' ");
    $rowusers = mysql_fetch_array($users,MYSQL_NUM);
   
    if($rowAdmin[0] == $login && $rowAdmin[1] == $password ){
            
        $_SESSION['nickName'] = $login;
        
        header('location:loggedin.php');
        
        
    }  elseif ($rowusers[0] == $login && $rowusers[1] == $password) {
        
         $_SESSION['nickName'] = $login;
        
         header('location:loggedin.php');
        
    }  else {
        
        include './header.inc';
        
        print "<p> you'rent registered yet U_U ";
        
        include './footer.inc';
        
    }
    
    
}

function spam_scrubber($value) {
    
    $very_bad = array('to:', 'cc:','bcc:', 'content-type:','mime-version:','multipart-mixed:','content-transfer-encoding:');
    
    foreach ($very_bad as $v) {
        
        if (stripos($value, $v) !== false)
                
                return '';
        
        $value = str_replace(array( "\r","\n", "%0a", "%0d"), ' ', $value);
        
        return trim($value);

}
    
}


?>