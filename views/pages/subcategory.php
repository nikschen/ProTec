<body class="Site">
<main class="Site-content">
    <h3><?=$category?></h3>

        <div class="subcategoryContent">
        <?foreach($products as $key=>$value)
            {
                $prodID=$value['productID'];
                $prodName=$value['prodName'];?>


                    <div class="element">
                        <a href="index.php?c=pages&a=product&pid=<?=$prodID?>">
                            <img src="\src\images\<?=$prodID?>.png">
                            <p><?=$prodName?></p></a>
                    </div>



        <?}?>
        </div>
</main>
</body>

