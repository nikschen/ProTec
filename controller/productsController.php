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
        if(isset($_POST['resetProductBasket']))
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


            if(!empty($productID)&&!empty($quantityWanted))
            {
                if(!empty($_SESSION['productBasket']))
                {
                    foreach($_SESSION['productBasket'] as $outerBasketEntry)
                    {
                        $indicesOfDuplicates=[];
                        $currentProductID=$outerBasketEntry->productID;
                        foreach ($_SESSION['productBasket'] as $currentIndex=>$innerBasketEntry)
                        {
                            if ($innerBasketEntry->productID==$currentProductID)
                            {
                                $indicesOfDuplicates[]=$currentIndex;
                            }
                        }
                        if(!isset($indicesOfDuplicates) || count($indicesOfDuplicates)==1)
                        {
                            $values=[
                                'productID'=>$productID,
                                'quantityWanted'=>$quantityWanted];
                            $productBasketEntry=new \protec\model\ProductBasketEntry($values);
                            array_push($_SESSION['productBasket'],$productBasketEntry);
                        }
                        else
                        {
                           for($idxOfIndicesOfDuplicates=1;$idxOfIndicesOfDuplicates<count($indicesOfDuplicates);++$idxOfIndicesOfDuplicates)
                           {
                               $outerBasketEntry->quantityWanted+=$_SESSION['productBasket'][$indicesOfDuplicates[$idxOfIndicesOfDuplicates]]->quantityWanted;
                           }
                           for($idxOfIndicesOfDuplicates=1;$idxOfIndicesOfDuplicates<count($indicesOfDuplicates);++$idxOfIndicesOfDuplicates)
                           {
                               unset($_SESSION['productBasket'][$idxOfIndicesOfDuplicates]);
                           }
                        }
                    }
                    echo "<pre>";
                    print_r($_SESSION['productBasket']);
                    echo "</pre>";
                }
                else
                {
                    $values=[
                        'productID'=>$productID,
                        'quantityWanted'=>$quantityWanted];
                    $productBasketEntry=new \protec\model\ProductBasketEntry($values);
                    array_push($_SESSION['productBasket'],$productBasketEntry);
                }

                $amountOfBasketEntries=count($_SESSION['productBasket']);
                $this->setParam('productID',$productID);
                $this->setParam('quantityWanted',$quantityWanted);
                $this->setParam('amountOfBasketEntries',$amountOfBasketEntries);

            }
        }
    }

}