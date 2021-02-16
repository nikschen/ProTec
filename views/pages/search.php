<body class="Site">
    <main class="Site-content">
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
                    <img src="<?=IMAGESPATH?>sadrobot1.png" alt="sadrobot">
                </div>
            <?endif;?>
            
            
            </div>
        </div>
        </div>
    </main>
</body>