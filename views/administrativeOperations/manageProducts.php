<body class="Site">
<main class="Site-content">
    <div class="manageProductsContainer">
        <ul class="manageProductsElements">
            <li class="addProductContainer">
                <h2>Produkt hinzufügen</h2>
                <div class="addProductFormularContainer">
                    <form method="POST">
                        <div class="firstRow">
                            <input class="productID" type="text" name="productID" placeholder="ID des hinzuzufügenden Produkts">
                            <input class="quantityStored" type="text" name="quantityStored" placeholder="Anzahl (gelagert)">
                        </div>
                            <textarea class="prodName" type="text" name="prodName" placeholder="Produktname" rows="3"></textarea>
                            <textarea class="prodDescription" type="text" name="prodDescription" placeholder="Produktbeschreibung" rows="7"></textarea>
                            <select class="category" name="category">
                            <?foreach ($categories as $categoryName):?>
                                <option value="<?=$categoryName?>"><?=$categoryName?></option>
                            <?endforeach;?>
                            </select>
                        <div class="lastRow">
                            <input class="pricingAmount" type="text" name="pricingAmount" placeholder="Preis">
                            <input class="pricingCurrency" type="text" name="pricingCurrency" placeholder="Währung">
                        </div>
                        <button type="submit" name="submit" value="addProduct">Produkt hinzufügen</button>
                    </form>
                </div>
            </li>
            <li class="changeProductContainer">
                <h2>Produktdaten ändern</h2>
                <div class="changeProductFormularContainer">

                    <form method="POST">
                        <div class="inputFields">
                            <input type="text" name="productID" placeholder="ID des zu ändernden Produkts">
                            <p>Zu ändernde Daten:</p>
                            <input type="text" name="quantityStored" placeholder="Anzahl (gelagert)">
                            <textarea type="text" name="prodName" placeholder="Produktname" rows="3"></textarea>
                            <textarea type="textarea" name="prodDescription" placeholder="Produktbeschreibung" rows="7"></textarea>
                            <input type="text" name="category" placeholder="Kategorie">
                            <input type="text" name="pricingAmount" placeholder="Preis">
                            <input type="text" name="pricingCurrency" placeholder="Währung">
                        </div>
                        <div class="submit">
                            <button type="submit" name="submit" value="changeProduct">Produktdaten ändern</button>
                        </div>
                    </form>
                </div>
            </li>
            <li class="deleteProductContainer">
                <h2>Produkt entfernen</h2>
                <div class="deleteProductFormularContainer">
                    <form method="POST">
                        <input type="text" name="productID" placeholder="ID des zu entfernenden Produkts">
                        <button type="submit" name="submit" value="deleteProduct">Produkt entfernen</button>
                    </form>
                </div>
            </li>
        </ul>
    </div>
</main>
</body>