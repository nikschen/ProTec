<?

function getUserInformation($email)
{
    $db = $GLOBALS['db'];
    $sqlStr = "SELECT * FROM `customer` join address on customer.addressID = address.addressID where eMail = '$email'";

    //print_r($sqlStr);
    //exit(0);
    $results = [];
    try
    {
        $results = $db->query($sqlStr)->fetchAll();
    }
    catch(\PDOException $error)
    {
    print_r($error);
    }
    return $results;
}





function validateLogInSessionsAndCookies($email, $password)
{
    //print_r($email . " - " . $password);
    
    $login = \protec\model\Account::findOne("username = ". "\"".$email."\"");
    //print_r($login->passwordHash);
   
    $passwordFromDatabase = $login->passwordHash;
    
    $decryptedPassword = decryptPassword($password);
    //echo $decryptedPassword;
     //exit(0);
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

function getAllCategories()
{
    $db = $GLOBALS['db'];
    $sqlStr = 'SELECT DISTINCT `product`.`category` FROM `product`';
    $results = [];


    $results = $db->query($sqlStr)->fetchAll();
    foreach($results as $category)
    {
        $categories[]=$category["category"];

    }
        return $categories;
}

function getProductPriceByID($productID, $convert=true)
{
    $price = \protec\model\Pricing::findOne("pricingID = ". $productID);
    if($price->currency=="Euro"){$currency="€";}else{$currency = $price->$currency;};
    if($convert)
    {
        return number_format($price->amount,2,",","."). " " . $currency;
    }
    else
    {
        return $price->amount;
    }
}






function validateUploadedProductImage (&$errors)
{
    $extension = strtolower(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION));


    //Überprüfung der Dateiendung
    $allowed_extensions = array('png');
    if(!in_array($extension, $allowed_extensions)) {
        $errors[]="Ungültige Dateiendung. Nur png-Dateien sind erlaubt, um Transparenzen zu erhalten";
    }

    //Überprüfung der Dateigröße
    $max_size = 500*1024; //500 KB
    if($_FILES['file']['size'] > $max_size) {
        $errors[]="Es sind keine Dateien größer 500kb erlaubt";
    }

    if (empty($errors))
    {
        return true;
    }
    else
    {
        return false;
    }
}