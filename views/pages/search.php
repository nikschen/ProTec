<body class="Site">
    <main class="Site-content">
        <div class="subCategoryContentContainer">

        <h2>Ihre Suchergebnisse</h2>
        
        <div class="contentContainer">
            <div class="subcategoryContent">
                <?foreach($products as $element) : ?>
                    <div class="element">
                        <a href="index.php?c=products&a=product&pid=<?=$element->productID?>">
                        <img src="<?=IMAGESPATH?><?=$element->productID?>.png"></a>
                        <p><?=$element->prodName?></p>
                    </div>
                <?endforeach;?> 
            </div>
        </div>
        </div>
    </main>
</body>