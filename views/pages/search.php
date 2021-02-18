<body class="Site">
    <main class="Site-content">

<div class="filterOptions" id="filter">
 <h2>Filtern Sie hier Ihre Suchanfrage</h2>
    <?//Diese Anzeige dient der Auswahl einer Kategorie nachdem die Suchanfrage dies bereits eingeschränkt hat?>
    <?$categoriesInSearch=[];          ?>
    <?foreach($products as $element) : ?>
        <?if(in_array($element->category,$categoriesInSearch)){}else{array_push($categoriesInSearch,$element->category);}  ?>
    <?endforeach;?> 

    <form method="get">
        <input type="hidden" name="c" value="pages" >  
        <input type="hidden" name="a" value="search">  
        <?foreach($categoriesInSearch as $element) : ?>
        <input class="categorieFilter" type="checkbox" name="<?=$element?>" <?=isset($_GET[$element]) ? 'checked' : ''?>><?=$element?><br>
        <?endforeach;?>
    
        <label for="searchString">Suchbegriff</label>  
        <input type="text" name="searchString"<?if(isset($_GET['searchString'])){echo "value=".htmlspecialchars($_GET['searchString']);};?>><br>
        <label for="minPrice">Preis</label>  
        <input type="text" name="minPrice" placeholder="von"<?if(isset($_GET['minPrice'])){echo "value=".htmlspecialchars($_GET['minPrice']);};?>>
        <input type="text" name="maxPrice" placeholder="bis"<?if(isset($_GET['maxPrice'])){echo "value=".htmlspecialchars($_GET['maxPrice']);};?>><br>
        <button type="submit" >Ergebnisse filtern</button><br>
    </form>
</div>




        <div class="subCategoryContentContainer">

       
        <h2>Ihre Suchergebnisse</h2>
        <?=isset($filteredProducts) ? count($filteredProducts)." Treffer" : "";?>

        <div class="contentContainer">
            <div class="subcategoryContent">
            <?if(isset($filteredProducts) && !empty($filteredProducts)): ?>
                <?foreach($filteredProducts as $element) : ?>
                    <div class="element">
                        <a href="index.php?c=products&a=product&pid=<?=$element->productID?>">
                        <img src="<?=IMAGESPATH?><?=$element->productID?>.png"></a>
                        <p><?=$element->prodName?></p>
                        <p><?=getProductPriceByID($element->productID);?></p>
                    </div>
                <?endforeach;?> 
            <?else :?>
                <div class="searchResults-message" >
                    <br>
                    <p>Ihre Suchanfrage ergab leider keine Treffer</p><br>
                    <img src="<?=IMAGESPATH?>sadrobot1.png" alt="sadrobot"><br>
                    <p>Halb so schlimm...starten Sie einfach eine neue Suche...</p><br>
                    <form method="POST">
                    <input type="text" name="searchString" placeholder="neue Suche..."<?if(isset($_GET['searchString'])){echo "value=".htmlspecialchars($_GET['searchString']);};?>>
                    </form>
                </div>
            <?endif;?>
                 
            </div>
        </div>
        </div>
                    <p><?echo $_GET['searchString']?> </p>
                    <p><?echo $_GET['minPrice']?> </p>
                    <p><?=htmlspecialchars($_SERVER['QUERY_STRING'])?></p>
    </main>
</body>