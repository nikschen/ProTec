<?php


/**
 * Class PagesController
 * Provides all logics for the common pages
 */
class PagesController extends \protec\core\Controller
{


    /**
     * Only provides the page title because of the absence of dynamic elements
     */
    public function actionIndex()
	{

        $title='ProTec > Home';
        $this->setParam('title', $title);
	}

    /**
     *  Checks for input of a search string to show correct results of a search in the database
     *  provides error if a given number is not numeric
     */
    public function actionSearch()
	{

        $title='ProTec > Searching';
        $this->setParam('title', $title);
        
        if(isset($_GET['searchString']) && $_GET['searchString'] !== "")
        {
        $searchString = $_GET['searchString'];
        $products = \protec\model\Product::find("prodName LIKE " . "\"%" . $searchString ."%\"");
   
        $categoriesInSearch=[];
        foreach($products as $element)
        {
           if(!in_array($element->category, $categoriesInSearch))
           {
               array_push($categoriesInSearch, $element->category);
           }
        }

        $isCategoryFilterSet=false;
        $isPriceFilterSet=false;
        

        $resultArrayPrice=[];
        $resultArrayCategory=[];
        $errorMessage=[];

        //checking if a Filter is set
        foreach($_GET as $key => $value) 
        {
            if ($value=="on")
            {
                $isCategoryFilterSet=true;
            }
            if ($key=="minPrice" || $key=="maxPrice")
            {
                if($value>0 || $value!="")
                {
                $isPriceFilterSet=true;
                }
            }
        }
       
        //do the filtering for the Category->if element is in category list on which the checkbox is "checked" will be added to the resultarray
        if($isCategoryFilterSet)
        {
            foreach($products as $element)
            {
                if(!empty($_GET[$element->category]))
                {
                    array_push($resultArrayCategory,$element);
                }
            }
        }
        else
        {
            $resultArrayCategory=$products;
        }
        //if there is a entry in one of the price max or min field this is set true and the list will be filtered by the price entries
        if($isPriceFilterSet)
        {   
                 //Replace german "," by international "." to make number-check, make numbers according to german system
                 $replaceMaxSeperator = str_replace(",",".",htmlspecialchars($_GET['maxPrice']));
                 $replaceMinSeperator = str_replace(",",".",htmlspecialchars($_GET['minPrice']));
            
            //check if one String was empty, set zero, because an empty string is not numeric
            if($_GET['maxPrice']=="")
            {
                $replaceMaxSeperator=0;
            }
            elseif($_GET['minPrice']=="")
            {
                $replaceMinSeperator=0;
            }

            //check if user-entry is a valid number, if not do not perform any filtering by price and give message to user
            if(is_numeric($replaceMaxSeperator) && is_numeric($replaceMinSeperator))
            {
                //make price entries to clean float value
                $maxPrice = floatval($replaceMaxSeperator);
                $minPrice = floatval($replaceMinSeperator);

                if($minPrice>0 && $maxPrice>0)
                {
                    foreach($products as $element)
                    {
                        $productPrice= getProductPriceByID($element->productID,false);

                        if($productPrice<=$maxPrice && $productPrice>=$minPrice)
                        {
                            array_push($resultArrayPrice,$element);
                        }
                    }
                }
                elseif($minPrice>0 && $maxPrice=="")
                {
                    foreach($products as $element)
                    {
                        $productPrice= getProductPriceByID($element->productID,false);

                        if($productPrice>=$minPrice)
                        {
                            array_push($resultArrayPrice,$element);
                        }
                    }
                }
                elseif($maxPrice>0 && $minPrice=="")
                {
                    foreach($products as $element)
                    {
                        $productPrice= getProductPriceByID($element->productID,false);

                        if($productPrice<=$maxPrice)
                        {
                            array_push($resultArrayPrice,$element);
                        }
                    }
                }
            }
            else
            {
                $resultArrayPrice=$products;
                $errorMessage['NotANumber']="Ungültige Zahl im Preisfilter";
            }
        }
        else
        {
            $resultArrayPrice=$products;
        }
            //merge the arrays by the elements occuring in both lists
            $superEndArray=[];
            foreach($products as $element) 
            {
                if(in_array($element,$resultArrayPrice) && in_array($element, $resultArrayCategory))
                {
                    array_push($superEndArray,$element);
                }
            }

            //create multidimensional array for later use in the sorting
            $productsAndTheirPrice=[];
            foreach ($superEndArray as $element)
            {
                $productToAdd=[];
                $productPrice= getProductPriceByID($element->productID,false);
                array_push($productToAdd,$element,$productPrice);
                array_push($productsAndTheirPrice,$productToAdd);
            }

            //Sortieren des Arrays nach Kundenwunsch anhand des Preises
            if(isset($_GET['sorting']))
            {
            if( $_GET['sorting']==='asc' || $_GET['sorting']==='desc')
            {
          
                $sortingDirection = "";
                if($_GET['sorting']==='asc')
                {
                    $sortingDirection = SORT_ASC;
                }
                elseif($_GET['sorting']==='desc')
                {
                    $sortingDirection = SORT_DESC;
                }
                $volume = array_column($productsAndTheirPrice, 1);
                array_multisort($volume, $sortingDirection, $productsAndTheirPrice);
            }
            }

            $this->setParam('products', $products);
            $this->setParam('filteredProducts', $productsAndTheirPrice);
            $this->setParam('errorMessage', $errorMessage);
        }
	}


    public function actionCategoryRaspi()
    {
        $title='ProTec > RaspberryPi';
        $this->setParam('title', $title);
	}

    /**
     * Only provides page title because of the absence of dynamic elements
     */
    public function actionCategoryElectronic()
    {
        $title='ProTec > Elektronik';
        $this->setParam('title', $title);
	}

    /**
     * Only provides page title because of the absence of dynamic elements
     */
    public function actionCategoryComputer()
    {
        $title='ProTec > Computer';
        $this->setParam('title', $title);
	}

    /**
     * Only provides page title because of the absence of dynamic elements
     */
    public function actionCategoryNew()
    {
        $title='ProTec > Neu';
        $this->setParam('title', $title);

        $newProducts = protec\model\Product::getNewest(5);
        
        $this->setParam('newProducts', $newProducts);

	}

    /**
     * Only provides page title because of the absence of dynamic elements
     */
    public function actionCategorySensors()
    {
        $title='ProTec > Computer';
        $this->setParam('title', $title);
    }

    /**
     * Provides page title according to the category given in the url
     * fills the product array with products of the correct subcategory name
     */
    public function actionSubcategory()
    {
        $category = $_GET['cat'];
        $subcategory = $_GET['subcat'];
        $categoryToBeSearchedFor='category='.'"'.$category.'"';

        $products=protec\model\Product::find($categoryToBeSearchedFor);

        $title='ProTec > '.$subcategory.' > '.$category;
        $this->setParam('title', $title);
        $this->setParam('products', $products);
        $this->setParam('category', $category);
    }






}