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
            $_SESSION['customerID']=$customer->customerID;
            $_SESSION['shippingAddress']=$address;

            $sqlPayDetail="customerID="."\"".$customer->customerID."\"";
            $sqlBillingAddress="addressID="."\"".$customer->customerID."\"";

            if(!empty(\protec\model\PayDetail::findOne($sqlPayDetail)))
            {
                $payDetail=\protec\model\PayDetail::findOne($sqlPayDetail);
                $billingAddress=\protec\model\Address::findOne($sqlBillingAddress);

                $this->setParam('payDetail', $payDetail);
                $this->setParam('billingAddress', $billingAddress);
            }
            else
            {
                $this->setParam('billingAddress', false);
            }


        }
        else
        {
            header("Location: index.php?c=products&a=forwardToLogin");
        }

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

        $title='ProTec > Checkout';
        $this->setParam('title', $title);
    }
    public function actionCheckoutCheckAndBuy()
    {

        $title='ProTec > Checkout';
        $this->setParam('title', $title);
    }
    public function actionCheckoutAfterPurchase()
    {
        $db = $GLOBALS["db"];

        $values['customerID']=$_SESSION['customerID'];
        $shippingAddress=$_SESSION['shippingAddress'];
        $values['shippingAddressID']=$shippingAddress->addressID;
        $purchase=new \protec\model\Purchase($values);
        $purchase->insert();
        $purchaseID=$db->lastInsertId();


        $values=[];

        foreach($_SESSION['productBasket'] as $productBasketEntry)
        {
            $productBasketEntry->purchaseID=$purchaseID;

            echo "<pre>";
            print_r($productBasketEntry);
            echo "</pre>";
            foreach($productBasketEntry as $key=>$value)
            {
                $values[$key]=$value;
                echo $key;
                echo $value;
                exit(1);
            }
            echo "<pre>";
            print_r($values);
            echo "</pre>";
            exit(1);
            $productBasketEntry->insert($values);
        }


        $_SESSION['productBasket']=null;
        $title='ProTec > Ihr Einkauf';
        $this->setParam('title', $title);
    }


}