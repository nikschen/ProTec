<body class="Site">
<main class="Site-content">
    <h3>Kabel</h3>
    <ul class="itemList">
        <? foreach ($prodNames as $prodID):
        ?>
            <div class="contentWrapper">
            <li>
                    <div class="element">
                        <a href="index.php?c=pages&a=categoryElectronic">
                            <img src="\src\images\1<?=$prodID?>.png" alt="Bild Zubehör">
                            <p><?=$prodName?></p></a>
                    </div>
            </li>
            </div>


        <?php endforeach?>
        <?echo "<pre>";

        //print_r ($products);

        echo "</pre>";
        ?>
    </ul>
</main>
</body>

