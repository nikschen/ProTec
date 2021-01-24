<?


function validateLogInSessionsAndCookies($email, $password)
{
    $login = \protec\model\Account::findOne('username = '."\"".$email. "\"");
    $passwordFromDatabase = $login->passwordHash;
    
    $decryptedPassword = decryptPassword($password);


    if(password_verify($decryptedPassword,$passwordFromDatabase))
    {

        return "1";
    }

    return "0";
}

function encryptPassword($password)
{
    
    $cipherMethod = "AES-256-CTR";
    $iv_length = openssl_cipher_iv_length($cipherMethod); 
    $options = 0; 
    $encryption_initVector= '1428570803198685';
    $encryption_Key= 'Niklasius';
    $encryptedPassword = openssl_encrypt($password, $cipherMethod, 
    $encryption_Key, $options, $encryption_initVector); 
    
    return $encryptedPassword;
}

function decryptPassword($passwordEncrypted)
{
    $cipherMethod = "AES-256-CTR";
    $options = 0; 
    $decryption_initVector= '1428570803198685';
    $decryption_Key= 'Niklasius';
    $decryptedPassword=openssl_decrypt ($passwordEncrypted, $cipherMethod,  
        $decryption_Key, $options, $decryption_initVector); 

    return $decryptedPassword;
}

















?>