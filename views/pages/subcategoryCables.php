<body class="Site">
<main class="Site-content">
    <h3>Kabel</h3>
    <ul class="itemList">
        <? foreach ($prodNames as list ($prodName,$prodID))
        {?>
            <div class="contentWrapper">
            <li>
                    <div class="element">
                        <a href="index.php?c=pages&a=categoryElectronic">
                            <img src="\src\images\1.png\" alt="Bild Zubehör">
                            <p><?=$prodName?></p></a>
                    </div>
            </li>
            </div>
            ;

        <? };?>

        <?print_r($products);?>
    </ul>
</main>
</body>

