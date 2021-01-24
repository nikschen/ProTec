<?


function validateLogInSessionsAndCookies($email, $password)
{
    $login = \protec\model\Account::findOne('username = '."\"".$email. "\"");
    $passwordFromDatabase = $login->passwordHash;
    
    if(password_verify($password,$passwordFromDatabase))
    {

        return "1";
    }










    return "0";
}















?>