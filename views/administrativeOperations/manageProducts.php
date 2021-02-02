<body class="Site">
<main class="Site-content">
    <div class="manageProductsContainer">
        <ul class="manageProductsElements">
            <li class="addProductContainer">
                <h2>Produkt hinzufügen</h2>
                <div class="addProductFormularContainer">
                    <form method="POST">
                        <input type="text" name="productID" placeholder="ID des zu ändernden Produkts">
                        <input type="text" name="quantityStored" placeholder="Anzahl (gelagert)"><br>
                        <input type="text" name="prodName" placeholder="Produktname"><br>
                        <input type="text" name="prodDescription" placeholder="Produktbeschreibung"><br>
                        <input type="text" name="category" placeholder="Kategorie"><br>
                        <input type="text" name="pricingAmount" placeholder="Preis"><br>
                        <input type="text" name="pricingCurrency" placeholder="Währung"><br>
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
                            <input type="text" name="quantityStored" placeholder="Anzahl (gelagert)"><br>
                            <input type="text" name="prodName" placeholder="Produktname"><br>
                            <input type="text" name="prodDescription" placeholder="Produktbeschreibung"><br>
                            <input type="text" name="category" placeholder="Kategorie"><br>
                            <input type="text" name="pricingAmount" placeholder="Preis"><br>
                            <input type="text" name="pricingCurrency" placeholder="Währung"><br>
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
                        <input type="text" name="productID" placeholder="ID des zu ändernden Produkts"><br>
                        <button type="submit" name="submit" value="deleteProduct">Produkt entfernen</button>
                    </form>
                </div>
            </li>
        </ul>
    </div>
</main>
</body>