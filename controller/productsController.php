<?php


/**
 * Class ProductsController
 * provides all logic around the individual product pages, the productBasket and the checkout process
 */
class ProductsController extends \protec\core\Controller
{


    /**
     *  checks for given productID, provided by the url get params
     * provides the associated product and pricing data from the database
     */
    public function actionProduct()
    {

        if(isset($_POST['submit']))
        {
            $this->actionAddProduct(); //calls add product if corresponding button is pressed to add a product and the correct amount to the product basket
        }
        $productIDToBeSearchedFor = 'productID='.'"'.$_GET['pid'].'"';
        $product=protec\model\Product::findOne($productIDToBeSearchedFor);
        $pricingIDToBeSearchedFor='pricingID='.'"'.$_GET['pid'].'"';
        $pricingEntry=protec\model\Pricing::findOne($pricingIDToBeSearchedFor);
        $productPrice=number_format($pricingEntry->amount,2, ",",".").' '.$pricingEntry->currency;
        $title=$product->prodName;
        $this->setParam('title', $title);
        $this->setParam('product', $product);
        $this->setParam('productPrice',$productPrice);

    }

    /**
     *  provides view of the product basket items and the possibility to change the amount of products via select menu and possibility to clear the product basket entirely
     * also responsible to start the checkout process via button
     */
    public function actionProductBasket()
    {
        if(isset($_POST["getToCheckout"])) //check for button press to forward the user to the first checkout page
        {
            header("Location: index.php?c=products&a=checkoutAddress");
        }

        else if(isset($_POST['updateWantedQuantity'])) //checks for button press to initiate update of a product's wanted quantity
        {
            if(isset($_POST['toBeChangedProductID']))
            {
                $concerningProductID=$_POST['toBeChangedProductID'];
                $selectedQuantity=$_POST['quantityWanted'];
                    foreach($_SESSION['productBasket'] as $basketEntry)
                    {
                        if($basketEntry->productID==$concerningProductID)
                        {
                            $basketEntry->quantityWanted=$selectedQuantity;
                            break;
                        }
                    }
            }
        }

        else if(isset($_POST['resetProductBasket'])) //checks for button press to reset the product basket data
        {
            $_SESSION['productBasket']=null;
        }

        $title='ProTec > Ihr Warenkorb';
        $this->setParam('title', $title);
        $this->setParam('productBasket', $_SESSION['productBasket']);

    }


    /**
     * checks for button press on a product page, adds the product associated with the productID given by the get params to the virtual product basket together with the wanted quantity
     * adds up the wanted quantity of a product if given to add but already existing in the product basket
     */
    public function actionAddProduct()
    {
        if(isset($_POST['submit']))
        {

            $productID=$_GET['pid'] ?? null;
            $quantityWanted=$_POST['quantityWanted']?? null;


            if(!empty($productID)&&!empty($quantityWanted))
            {
                if(!empty($_SESSION['productBasket']))//checks for any amount greater than 0 of existing entries
                {
                    foreach($_SESSION['productBasket'] as $basketEntry) //checks for already existing entries of the current product
                    {
                        if($basketEntry->productID==$productID)
                        {
                            $basketEntry->quantityWanted+=$quantityWanted;
                            return;
                        }
                    }
                    
                }
                    $values=[
                        'productID'=>$productID,
                        'quantityWanted'=>$quantityWanted];
                    $productBasketEntry=new \protec\model\ProductBasketEntry($values);
                    array_push($_SESSION['productBasket'],$productBasketEntry);

                $amountOfBasketEntries=count($_SESSION['productBasket']); //counts the current amount of product basket entries, used for the text below the product basket symbol in the navigation bar
            }
        }
    }


    /**
     *  provides the current user's billing and shipping address(es) if logged in, else forwards to the login page
     *  if there is no billing address associated to the user yet, the shipping address will be used as the billing address as a prefill
     * prefills the form for the shipping and billing addresses with the mentioned values
     */
    public function actionCheckoutAddress()
    {
        if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']==true) //checks for user being logged in, because guests can not buy something yet without an account; users no being logged in will be forwarded to the login page
        {
            $sqlCustomer="email="."\"".$_SESSION["email"]."\"";
            $customer=\protec\model\Customer::findOne($sqlCustomer);
            $sqlAddress="addressID="."\"".$customer->customerID."\"";
            $address=\protec\model\Address::findOne($sqlAddress);
            $_SESSION['address']=$address;
            $_SESSION['customer']=$customer;
            $_SESSION['customerID']=$customer->customerID;
            $_SESSION['shippingAddress']=$address;

            $sqlPayDetail="customerID="."\"".$customer->customerID."\"";


            if(!empty(\protec\model\PayDetail::findOne($sqlPayDetail))) //checks for existing paydetails for the current user
            {
                $payDetail=\protec\model\PayDetail::findOne($sqlPayDetail);

                $sqlBillingAddress="addressID="."\"".$payDetail->billingAddressID."\"";


                if(!empty($billingAddress=\protec\model\Address::findOne($sqlBillingAddress)))
                {
                    $billingAddress=\protec\model\Address::findOne($sqlBillingAddress);
                    $_SESSION['billingAddress']=$billingAddress;
                }
                else
                {
                    $_SESSION['billingAddress']=$address;
                }


                $_SESSION['payDetail']=$payDetail;
                $this->setParam('billingAddress', $billingAddress);
            }
            else
            {
                $billingAddress=false;
                $this->setParam('billingAddress', false);
            }


        }
        else
        {
            header("Location: index.php?c=products&a=forwardToLogin");
        }




        if($billingAddress!=false) //if billing address is given, all attributes of it will be filled with the billing address values
        {
            $firstNameBillingValue=$customer->firstName;
            $lastNameBillingValue=$customer->lastName;
            $streetBillingValue=$billingAddress->street;
            $streetNoBillingValue=$billingAddress->streetNumber;
            $zipcodeBillingValue=$billingAddress->zipCode;
            $cityBillingValue=$billingAddress->city;
            $countryBillingValue=$billingAddress->country;
            $emailBillingValue=$customer->eMail;
        }
        else //if billing address is not given, all attributes of it will be filled with the shipping address values
        {
            $firstNameBillingValue=$customer->firstName;
            $lastNameBillingValue=$customer->lastName;
            $streetBillingValue=$address->street;
            $streetNoBillingValue=$address->streetNumber;
            $zipcodeBillingValue=$address->zipCode;
            $cityBillingValue=$address->city;
            $countryBillingValue=$address->country;
            $emailBillingValue=$customer->eMail;
        }

        $firstNameShippingValue=$customer->firstName;
        $lastNameShippingValue=$customer->lastName;
        $streetShippingValue=$address->street;
        $streetNoShippingValue=$address->streetNumber;
        $zipcodeShippingValue=$address->zipCode;
        $cityShippingValue=$address->city;
        $countryShippingValue=$address->country;
        $emailShippingValue=$customer->eMail;

        $this->setParam('firstNameBillingValue',$firstNameBillingValue);
        $this->setParam('lastNameBillingValue',$lastNameBillingValue);
        $this->setParam('streetBillingValue',$streetBillingValue);
        $this->setParam('streetNoBillingValue',$streetNoBillingValue);
        $this->setParam('zipcodeBillingValue',$zipcodeBillingValue);
        $this->setParam('cityBillingValue',$cityBillingValue);
        $this->setParam('countryBillingValue',$countryBillingValue);
        $this->setParam('emailBillingValue',$emailBillingValue);

        $this->setParam('firstNameShippingValue',$firstNameShippingValue);
        $this->setParam('lastNameShippingValue',$lastNameShippingValue);
        $this->setParam('streetShippingValue',$streetShippingValue);
        $this->setParam('streetNoShippingValue',$streetNoShippingValue);
        $this->setParam('zipcodeShippingValue',$zipcodeShippingValue);
        $this->setParam('cityShippingValue',$cityShippingValue);
        $this->setParam('countryShippingValue',$countryShippingValue);
        $this->setParam('emailShippingValue',$emailShippingValue);

        $title='ProTec > Checkout';
        $this->setParam('title', $title);
        $this->setParam('customer', $customer);
        $this->setParam('address', $address);
    }

    /**
     * only provides a message and a title as well as the forwarding functionality for this forwarding page
     */
    public function actionForwardToLogin()
    {
        $forwardingMessage="Sie müssen eingeloggt sein, um Käufe zu tätigen. <br> Sie werden nun weitergeleitet...";
        $this->setParam('forwardingMessage', $forwardingMessage);
        $title='ProTec > Weiterleitung';
        $this->setParam('title', $title);

        header("Refresh: 3; index.php?c=accounts&a=login");
    }

    /**
     *  checks for input in previous action
     * checks for existing billing or shipping addresses; creates and inserts new address into the database if not already existing
     */
    public function actionCheckoutPaymentAndShipping()
    {

        $db=$GLOBALS['db'];

        if(isset($_POST["submit"]))
        {
            $customer=$_SESSION['customer'];



            $valuesShippingAddress['firstName']=$_POST['firstNameShipping'];
            $valuesShippingAddress['lastName']=$_POST['lastNameShipping'];
            $valuesShippingAddress['street']=$_POST['streetShipping'];
            $valuesShippingAddress['streetNumber']=$_POST['streetNoShipping'];
            $valuesShippingAddress['zipCode']=$_POST['zipcodeShipping'];
            $valuesShippingAddress['city']=$_POST['cityShipping'];
            $valuesShippingAddress['country']=$_POST['countryShipping'];

            $shippingAddress=new \protec\model\Address($valuesShippingAddress);

            $valuesBillingAddress['firstName']=$_POST['firstNameBilling'];
            $valuesBillingAddress['lastName']=$_POST['lastNameBilling'];
            $valuesBillingAddress['street']=$_POST['streetBilling'];
            $valuesBillingAddress['streetNumber']=$_POST['streetNoBilling'];
            $valuesBillingAddress['zipCode']=$_POST['zipcodeBilling'];
            $valuesBillingAddress['city']=$_POST['cityBilling'];
            $valuesBillingAddress['country']=$_POST['countryBilling'];

            $billingAddress=new \protec\model\Address($valuesBillingAddress);
            $_SESSION["shippingAddress"]=$shippingAddress;
            $_SESSION["billingAddress"]=$billingAddress;

            $searchString = "";
            $connectionString = " AND ";

            foreach ($valuesShippingAddress as $element => $value) //generating searchstring for sql search command
                {
                    if($value!="" && $element!='firstName' && $element!='lastName')
                    {
                        $searchString .= $element ." = " . "\"".$value."\"" . $connectionString ;
                    }


                }
                $searchStringEnd =  rtrim($searchString,$connectionString);
                $allAddress = \protec\model\Address::findOne($searchStringEnd);

                if($allAddress !== null) //saves the found addressID if address already existed
                {
                    $shippingAddressID = $allAddress->addressID;
                }
                else //inserts the new address and saves the addressID if address did not already exist
                {
                    $shippingAddress->insert();
                    $shippingAddressID = $db->lastInsertId();
                }


            $searchString="";
                foreach ($valuesBillingAddress as $element => $value) //generating searchstring for sql search command
                {
                    if($value!="" && $element!='firstName' && $element!='lastName')
                    {
                        $searchString .= $element ." = " . "\"".$value."\"" . $connectionString ;
                    }
                }
                $searchStringEnd =  rtrim($searchString,$connectionString);
                $allAddress = \protec\model\Address::findOne($searchStringEnd);

                if($allAddress !== null)//saves the found addressID if address already existed
                {
                    $billingAddressID = $allAddress->addressID;
                }
                else //inserts the new address and saves the addressID if address did not already exist
                {
                    $billingAddress->insert();
                    $billingAddressID = $db->lastInsertId();
                }

                $billingAddress->addressID=$billingAddressID;
                $shippingAddress->addressID=$shippingAddressID;

                $_SESSION['shippingAddressID']=$shippingAddressID;
                $_SESSION['billingAddressID']=$billingAddressID;

        }

        $title='ProTec > Checkout';
        $this->setParam('title', $title);
    }


    /**
     * checks for input in previous action
     * checks for chosen payment and shipping methods and provides overview about the whole buying process and the chosen products, addresses and shipping and payment details
     */
    public function actionCheckoutCheckAndBuy()
    {
        $db=$GLOBALS['db'];

        $paymentMethod=$_POST['paymentMethod'];
        $shippingMethod=$_POST['shippingMethod'];


        $address=$_SESSION['shippingAddress'];
        $billingAddress=$_SESSION['billingAddress'];
        $customer=$_SESSION['customer'];
        $billingAddressID=$_SESSION['billingAddressID'];

        $valuesPayDetail['billingAddressID']=$billingAddressID;
        $valuesPayDetail['customerID']=$billingAddressID;
        $valuesPayDetail['paymentMethod']=$paymentMethod;


        if($paymentMethod!='Invoice') //checks for the payment method, if invoice, no payment details are needed
        {
            $paymentDetails=$_POST['paymentNumber'];
            $this->setParam('paymentDetails', $paymentDetails);

            $valuesPayDetail['paymentNumber']=$paymentDetails;

        }
        else //translates the paymentMethod name to german for output on the website
        {
            $paymentMethod="Rechnung";
        }

        $this->setParam('shippingMethod', $shippingMethod);
        $this->setParam('paymentMethod', $paymentMethod);


        $payDetail=new \protec\model\PayDetail($valuesPayDetail);

        $searchString = "";
        $connectionString = " AND ";

        foreach ($valuesPayDetail as $element => $value) //generates sql string for sql search command
        {
            if($value!="" && $element!='firstName' && $element!='lastName')
            {
                $searchString .= $element ." = " . "\"".$value."\"" . $connectionString ;
            }


        }
        $searchStringEnd =  rtrim($searchString,$connectionString);
        $allPaydetails = \protec\model\PayDetail::findOne($searchStringEnd);

        if($allPaydetails !== null) //checks for existing payDetails, otherwise inserts the new paydetails
    {
            $payDetailID = $allPaydetails->payDetailID;
        }
        else
        {

            $payDetail->insert();
            $payDetailID = $db->lastInsertId();
        }
        $_SESSION['payDetailID']=$payDetailID;

        switch($shippingMethod) //sets the shipping fee according to the chosen shipping method
        {
            case "DHL":  $this->setParam('shippingFee', '4.95'); break;
            case "UPS Standard":$this->setParam('shippingFee', '5.90'); break;
            case "UPS Saver Express":$this->setParam('shippingFee', '12.50'); break;
        }



        $this->setParam('payDetailID', $payDetailID);
        $this->setParam('customer', $customer);
        $this->setParam('billingAddress', $billingAddress);
        $this->setParam('address', $address);

        $title='ProTec > Checkout';
        $this->setParam('title', $title);
    }

    /**
     * takes the previous given details and finalizes the buying process by creating the purchase the product basket entries with the given data and updating the product's stored quantity as well as clearing the virtual product basket
     * at last forwards to the home page
     */
    public function actionCheckoutAfterPurchase()
    {

        $db = $GLOBALS["db"];
        $shippingAddress=$_SESSION['shippingAddress'];



        $values['customerID']=$_SESSION['customerID'];
        $payDetailID=$_SESSION['payDetailID'];
        $values['payDetailID']=$payDetailID;
        $values['shippingAddressID']=$shippingAddress->addressID;


        $purchase=new \protec\model\Purchase($values); //creation of the purchase according to the given customerID, payDetailID and shippingAddressID

        $purchase->insert();
        $purchaseID=$db->lastInsertId();


        foreach($_SESSION['productBasket'] as $productBasketEntry) // creates an entry into the productBasketEntry table for each virtual product basket entry stored in the session
        {

            $values= [
                'productID'=>$productBasketEntry->productID,
                'quantityWanted'=>$productBasketEntry->quantityWanted,
                'purchaseID'=>$purchaseID

            ];
            $toBeInsertedProductBasketEntry=new \protec\model\ProductBasketEntry($values);
            $toBeInsertedProductBasketEntry->insert();

            $sqlProduct="productID="."\"".$productBasketEntry->productID."\"";
            $productToBeUpdated=\protec\model\Product::findOne($sqlProduct);
            $oldQuantityStored=$productToBeUpdated->quantityStored;
            $newQuantityStored=$oldQuantityStored-$productBasketEntry->quantityWanted;
            $productValues[] = "quantityStored=\"$newQuantityStored\"";
            $productToBeUpdated->update($productValues, $productToBeUpdated->productID); //updates the stored quantity of every product bought according to the bought amount

        }


        $_SESSION['productBasket']=null; //clears the product basket
        $title='ProTec > Ihr Einkauf';
        $this->setParam('title', $title);
        header("Refresh: 3; index.php?c=pages&a=index");
    }


}