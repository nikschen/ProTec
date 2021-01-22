<?php


class ProductsController extends \protec\core\Controller
{
    public function actionProduct()
    {
        //$productBasket=&$_SESSION['productBasket'];
        $amountOfBasketEntries=count($_SESSION['productBasket']);
        $this->setParam('amountOfBasketEntries',$amountOfBasketEntries);
        //echo"<pre>";
        //print_r($productBasket);
        //echo"</pre>";

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
        $productBasket=$_SESSION['productBasket'];
        $title='ProTec > Ihr Warenkorb';
        $this->setParam('title', $title);
        $this->setParam('productBasket', $productBasket);
    }

    public function actionAddProduct()
    {
        if(isset($_POST['submit']))
        {
            /*echo"<pre>";
            print_r($_SESSION['productBasket']);
            echo"</pre>";*/
            //$productBasket=&$_SESSION['productBasket'];
            $productID=$_GET['pid'] ?? null;
            $quantityWanted=$_POST['quantityWanted']?? null;
            $values=[
                'productID'=>$productID,
                'quantityWanted'=>$quantityWanted];
            $productBasketEntry=new \protec\model\ProductBasketEntry($values);
            array_push($_SESSION['productBasket'],$productID);
            //array_push($_SESSION['productBasket'],$productBasketEntry);
            echo"<pre>";
            print_r($_SESSION['productBasket']);
            echo"</pre>";

            $amountOfBasketEntries=count($_SESSION['productBasket']);
            $this->setParam('productID',$productID);
            $this->setParam('quantityWanted',$quantityWanted);
            $this->setParam('amountOfBasketEntries',$amountOfBasketEntries);
        }
    }

}