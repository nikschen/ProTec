<body class="Site">
<main class="Site-content">
    <div class="subCategoryContentContainer">
        <h3><?=$category?></h3>
        <div class="contentContainer">
            <div class="subcategoryContent">
            <?foreach($products as $product)
                {
                    $prodID=$product->productID;
                    $prodName=$product->prodName;?>

                    <div class="element">
                        <a href="index.php?c=pages&a=product&pid=<?=$prodID?>">
                        <img src="<?=IMAGESPATH?><?=$prodID?>.png">
                        <p><?=$prodName?></p></a>
                    </div>
            <?}?>
            </div>
        </div>
    </div>
</main>
</body>

