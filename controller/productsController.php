<?php


class ProductsController extends \protec\core\Controller
{


    public function actionProduct()
    {

        if(isset($_POST['submit']))
        {
            $this->actionAddProduct();
        }
        $productIDToBeSearchedFor = 'productID='.'"'.$_GET['pid'].'"';
        $product=protec\model\Product::findOne($productIDToBeSearchedFor);
        $pricingIDToBeSearchedFor='pricingID='.'"'.$_GET['pid'].'"';
        $pricingEntry=protec\model\Pricing::findOne($pricingIDToBeSearchedFor);
        $productPrice=$pricingEntry->amount.' '.$pricingEntry->currency;
        $title=$product->prodName;
        $this->setParam('title', $title);
        $this->setParam('product', $product);
        $this->setParam('productPrice',$productPrice);

    }

    public function actionProductBasket()
    {
        if(isset($_POST["getToCheckout"]))
        {
            header("Location: index.php?c=products&a=checkoutAddress");
        }

        else if(isset($_POST['updateWantedQuantity']))
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

        else if(isset($_POST['resetProductBasket']))
        {
            $_SESSION['productBasket']=null;
        }

        $title='ProTec > Ihr Warenkorb';
        $this->setParam('title', $title);
        $this->setParam('productBasket', $_SESSION['productBasket']);

    }


    public function actionAddProduct()
    {
        if(isset($_POST['submit']))
        {

            $productID=$_GET['pid'] ?? null;
            $quantityWanted=$_POST['quantityWanted']?? null;


            if(!empty($productID)&&!empty($quantityWanted)) //prüft, ob überhaupt was eingegeben wurde ( eigentlich immer der fall, soblad der add to basket button gedrückt wird)
            {
                if(!empty($_SESSION['productBasket'])) //prüft, ob schon ein eintrag im warenkorb ist, wenn nicht, brauch es auch keiner überprüfung auf duplikate
                {
                    foreach($_SESSION['productBasket'] as $basketEntry) //foreach schleife durch alle warenkorbeinträge
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

                $amountOfBasketEntries=count($_SESSION['productBasket']); //Anzahl der Warenkorbeinträge, kommt unter das Warenkorbsymbol



            }
        }
    }


    public function actionCheckoutAddress()
    {
        if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']==true)
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


            if(!empty(\protec\model\PayDetail::findOne($sqlPayDetail)))
            {
                $payDetail=\protec\model\PayDetail::findOne($sqlPayDetail);
                $sqlBillingAddress="addressID="."\"".$payDetail->billingAdressID."\"";

                $billingAddress=\protec\model\Address::findOne($sqlBillingAddress);


                $_SESSION['payDetail']=$payDetail;
                $_SESSION['billingAddress']=$billingAddress;



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




        if($billingAddress!=false)
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
        else
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

    public function actionForwardToLogin()
    {
        $forwardingMessage="Sie müssen eingeloggt sein, um Käufe zu tätigen. <br> Sie werden nun weitergeleitet...";
        $this->setParam('forwardingMessage', $forwardingMessage);
        $title='ProTec > Weiterleitung';
        $this->setParam('title', $title);

        header("Refresh: 3; index.php?c=pages&a=login");
    }

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


            $searchString = "";
            $connectionString = " AND ";

            foreach ($valuesShippingAddress as $element => $value)
                {
                    if($value!="" && $element!='firstName' && $element!='lastName')
                    {
                        $searchString .= $element ." = " . "\"".$value."\"" . $connectionString ;
                    }


                }
                $searchStringEnd =  rtrim($searchString,$connectionString);
                $allAddress = \protec\model\Address::findOne($searchStringEnd);

                if($allAddress !== null)
                {
                    $shippingAddressID = $allAddress->addressID;
                }
                else
                {
                    $shippingAddress->insert();
                    $shippingAddressID = $db->lastInsertId();
                }


            $searchString="";
                foreach ($valuesBillingAddress as $element => $value)
                {
                    if($value!="" && $element!='firstName' && $element!='lastName')
                    {
                        $searchString .= $element ." = " . "\"".$value."\"" . $connectionString ;
                    }
                }
                $searchStringEnd =  rtrim($searchString,$connectionString);
                $allAddress = \protec\model\Address::findOne($searchStringEnd);

                if($allAddress !== null)
                {
                    $billingAddressID = $allAddress->addressID;
                }
                else
                {
                    $billingAddress->insert();
                    $billingAddressID = $db->lastInsertId();
                }

                $_SESSION["shippingAddressID"]=$shippingAddressID;
                $_SESSION["billingAddressID"]=$billingAddressID;

        }

        $title='ProTec > Checkout';
        $this->setParam('title', $title);
    }


    public function actionCheckoutCheckAndBuy()
    {
        $address=$_SESSION['address'];
        $customer=$_SESSION['customer'];

        /*if(!$billingAddress)
        {
            $this->setParam('billingAddress', $billingAddress);
        }
        else
        {
            $this->setParam('billingAddress', $address);
        }

        if(!empty($_SESSION['payDetail']))
        {
            $this->setParam('payDetail', $payDetail);
        }
        else
        {
            $this->setParam('payDetail', null);
        }*/




        $this->setParam('customer', $customer);
        $this->setParam('address', $address);

        $title='ProTec > Checkout';
        $this->setParam('title', $title);
    }

    public function actionCheckoutAfterPurchase()
    {

        $db = $GLOBALS["db"];

        $values['customerID']=$_SESSION['customerID'];
        $values['payDetailID']=$_SESSION['payDetailID'];
        
        $shippingAddress=$_SESSION['shippingAddress'];
           
        $values['shippingAddressID']=$shippingAddress->addressID;
        $purchase=new \protec\model\Purchase($values);
        $purchase->insert();
        $purchaseID=$db->lastInsertId();



        $values=[];

        foreach($_SESSION['productBasket'] as $productBasketEntry)
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
            $productToBeUpdated->update($productValues, $productToBeUpdated->productID);

        }


        $_SESSION['productBasket']=null;
        $title='ProTec > Ihr Einkauf';
        $this->setParam('title', $title);
    }


}