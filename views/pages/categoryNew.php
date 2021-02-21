<body class="Site">
    <main class="Site-content">
        <div class="categoryContentContainer">
            <h2>Zuletzt neu bei uns eingetroffen...</h2>
            <div class="contentWrapper">
            <?foreach($newProducts as $element) : ?>
                    <div class="element">
                        <a href="index.php?c=products&a=product&pid=<?=$element->productID?>">
                        <img src="<?=IMAGESPATH?><?=$element->productID?>.png"></a>
                        <p><?=$element->prodName?></p>
                        <p><?=getProductPriceByID($element->productID);?></p><br>
                        <div>Eingetroffen am: <?=date('d.m.Y' , strtotime($element->createdAt))?></div>
                    </div>
            <?endforeach;?>     

            </div>
        </div>
    </main>
</body>

