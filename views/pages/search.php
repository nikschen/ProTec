<body class="Site">
    <main class="Site-content">
    <?if(isset($products)) :?>
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
        <div class="categoryFilter">
        <?foreach($categoriesInSearch as $element) : ?>
        <label><input class="categoryCheckboxes" type="checkbox" name="<?=$element?>" <?=isset($_GET[$element]) ? 'checked' : ''?>><?=$element?><br></label>
        <?endforeach;?>
        </div>
     
    
        <label for="searchString">Suchbegriff</label>  
        <input type="text" name="searchString"<?if(isset($_GET['searchString'])){echo "value=".htmlspecialchars($_GET['searchString']);};?>><br>
        <label for="minPrice">Preis</label>  
        <input type="text" name="minPrice" placeholder="von"<?if(isset($_GET['minPrice'])){echo "value=".htmlspecialchars($_GET['minPrice']);};?>>
        <input type="text" name="maxPrice" placeholder="bis"<?if(isset($_GET['maxPrice'])){echo "value=".htmlspecialchars($_GET['maxPrice']);};?>><br>
        
        <label for="sorting">Sortierung:</label>
        <select name="sorting" id="sorting">
            <option value="">- keine -</option>
            <option value="asc"  <?=isset($_GET['sorting']) && $_GET['sorting']=='asc'? "selected":"" ?>>Preis: aufsteigend</option>
            <option value="desc" <?=isset($_GET['sorting']) && $_GET['sorting']=='desc'? "selected":"" ?>>Preis: absteigend</option>
         </select><br>
        <button type="submit" >Ergebnisse filtern</button><br>
    </form>
    <?php if(isset($errorMessage) && count($errorMessage) > 0) : ?>
     <div class="error-message" style ="width:100%;border-radius:5px;background-color: red; color: white">
     <ul>
         <?php foreach($errorMessage as $key => $value) : ?>
            <li><?=$value?></li>
            <?php endforeach?>
         </ul>
         </div>
         <?php endif; ?>
</div>
<?endif?>




        <div class="subCategoryContentContainer">

       
        <h2>Ihre Suchergebnisse</h2>
        <?=isset($filteredProducts) ? count($filteredProducts)." Treffer" : "";?>

        <div class="contentContainer">
            <div class="subcategoryContent">
            <?if(isset($filteredProducts) && !empty($filteredProducts)): ?>
                <?foreach($filteredProducts as $element) : ?>
                    <div class="element">
                        <a href="index.php?c=products&a=product&pid=<?=$element[0]->productID?>">
                        <img src="<?=IMAGESPATH?><?=$element[0]->productID?>.png"></a>
                        <p><?=$element[0]->prodName?></p>
                        <p><?=getProductPriceByID($element[0]->productID);?></p>
                    </div>
                <?endforeach;?> 
            <?else :?>
                <div class="searchResults-message" >
                    <br>
                    <p>Ihre Suchanfrage ergab leider keine Treffer</p><br>
                    <img src="<?=IMAGESPATH?>sadrobot1.png" alt="sadrobot"><br>
                    <p>Halb so schlimm...starten Sie einfach eine neue Suche...</p><br>
                    <form method="GET">
                    <input type="hidden" name="c" value="pages" >  
                    <input type="hidden" name="a" value="search">  
                    <input type="text" name="searchString" placeholder="neue Suche..."<?if(isset($_GET['searchString'])){echo "value=".htmlspecialchars($_GET['searchString']);};?>>
                    <input type="submit" value="Absenden"></input>
                    </form>
                </div>
            <?endif;?>
                 
            </div>
        </div>
        </div>
                   
    </main>
</body>