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


            if(!empty($productID)&&!empty($quantityWanted)) //prüft, ob überhaupt was eingegeben wurde ( eigentlich immer der fall, soblad der add to basket butotn gedrückt wird)
            {
                if(!empty($_SESSION['productBasket'])) //prüft, ob schon ein eintrag im warenkorb ist, wenn nicht, brauch es auch keiner überprüfung auf duplikate
                {
                    foreach($_SESSION['productBasket'] as $outerBasketEntry) //foreach schleife durch alle warenkorbeinträge
                    {
                        $indicesOfDuplicates=[];
                        $currentProductID=$outerBasketEntry->productID; //aktuelle prodID wird gespeicehrt, danach werden ja die duplikate geprüft
                        foreach ($_SESSION['productBasket'] as $currentIndex=>$innerBasketEntry)  //foreach schleife durch alle warenkorbeinträge, damit alle überprüft werden
                        {
                            if ($innerBasketEntry->productID==$currentProductID)  //löst aus, wenn ein anderer eintrag (und eben auch der eigene eintrag) die gleiche prodID besitzt
                            {
                                $indicesOfDuplicates[]=$currentIndex;  //fügt den index innerhalb des warenkorbs einem array hinzu, um später alle duplikate anhand des index aufrufen zu können
                            }
                        }
                        if(!isset($indicesOfDuplicates) || count($indicesOfDuplicates)==1) //prüft, ob es überhaupt zu duplikaten kam und ob es nicht nur ein duplikat(den ursprungseintrag selber) gab
                        { //hier passiert die normale hinzufügelogik, falls es nur einen oder keinen duplikatseintrag gibt
                            $values=[
                                'productID'=>$productID,
                                'quantityWanted'=>$quantityWanted];
                            $productBasketEntry=new \protec\model\ProductBasketEntry($values);
                            array_push($_SESSION['productBasket'],$productBasketEntry);
                        }
                        else //falls es zu duplikaten kam, gehts hier los mit der logik
                        {
                           for($idxOfIndicesOfDuplicates=1;$idxOfIndicesOfDuplicates<count($indicesOfDuplicates);++$idxOfIndicesOfDuplicates) // hier wird durch das indexOfDuplicatesarray iteriert
                           {
                               $outerBasketEntry->quantityWanted+=$_SESSION['productBasket'][$indicesOfDuplicates[$idxOfIndicesOfDuplicates]]->quantityWanted; //von jedem duplikatseintrag wird die gewünschte ANzahl gesogen und anschließend zur anzahl im ursprungsobjekt addiert
                           }
                           for($idxOfIndicesOfDuplicates=1;$idxOfIndicesOfDuplicates<count($indicesOfDuplicates);++$idxOfIndicesOfDuplicates) // hier wird nochmals durch das indexOfDuplicatesarray iteriert
                           {
                               unset($_SESSION['productBasket'][$idxOfIndicesOfDuplicates]); //hier werden im Anschluss alle EInträge gelöscht, die Duplikate waren, außer dem ursprungseintrag
                           }
                        }
                    }
                    echo "<pre>";
                    print_r($_SESSION['productBasket']);
                    echo "</pre>";
                }
                else //hier passiert die normale hinzufügelogik, falls es nur einen eintrag gibt
                {
                    $values=[
                        'productID'=>$productID,
                        'quantityWanted'=>$quantityWanted];
                    $productBasketEntry=new \protec\model\ProductBasketEntry($values);
                    array_push($_SESSION['productBasket'],$productBasketEntry);
                }

                $amountOfBasketEntries=count($_SESSION['productBasket']); //Anzahl der Warenkorbeinträge, kommt unter das Warenkorbsymbol



            }
        }
    }

}