<body class="Site">
    <main class="Site-content">

<div class="filterOptions" id="filter" style=color:black;>
 
    <?//Diese Anzeige dient der Auswahl einer Kategorie nachdem die Suchanfrage dies bereits eingeschränkt hat?>
    <?$categoriesInSearch=[];          ?>
    <?foreach($products as $element) : ?>
        <?if(in_array($element->category,$categoriesInSearch)){}else{array_push($categoriesInSearch,$element->category);}  ?>
    <?endforeach;?> 
    <?foreach($categoriesInSearch as $element) : ?>
    <input class="categorieFilter" type="checkbox" name="<?=$element?>"><?=$element?><br>
    <?endforeach;?>
    <form method="post">
        <label for="minPrice">Preis</label>  
        <input type="text" name="minPrice" placeholder="von">
        <input type="text" name="maxPrice" placeholder="bis"><br>
        <button type="submit" name="searchString">Ergebnisse filtern</button><br>
    </form>
</div>




        <div class="subCategoryContentContainer">

       
        <h2>Ihre Suchergebnisse</h2>
        <div class="contentContainer">
            <div class="subcategoryContent">
            <?if(isset($products) && !empty($products)): ?>
                
                <?foreach($products as $element) : ?>
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
                    <input type="text" name="searchString" placeholder="neue Suche..."<?if(isset($_POST['searchString'])){echo "value=".htmlspecialchars($_POST['searchString']);};?>>
                    </form>
                </div>
            <?endif;?>
            
            
            </div>
        </div>
        </div>
    </main>
</body>