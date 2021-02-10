<body class="Site">
<main class="Site-content">
    <div class="manageProductsContainer">
        <ul class="manageProductsElements">
            <li class="addProductContainer">
                <h2>Produkt hinzufügen</h2>
                <div class="addProductFormularContainer">
                    <form method="POST" enctype="multipart/form-data">
                        <div class="firstRow">
                            <input class="quantityStored" type="number" name="quantityStored" placeholder="Anzahl">
                            <select class="category" name="category" required>
                                <option  hidden="hidden" disabled="disabled" selected="selected">Kategorie wählen</option>
                                <?foreach ($categories as $categoryName):?>
                                    <option value="<?=$categoryName?>" ><?=$categoryName?></option>
                                <?endforeach;?>
                            </select>
                        </div>
                            <textarea class="prodName" type="text" name="prodName" placeholder="Produktname" rows="3" required></textarea>
                            <textarea class="prodDescription" type="text"  name="prodDescription" placeholder="Produktbeschreibung" rows="7" required></textarea>
                            <input class="productImageUploadLabel" name="file" type="file" required/>

                        <div class="lastRow">
                            <input class="pricingAmount" type="number" step="0.01" name="amount" placeholder="Preis" required>
                            <input class="pricingCurrency" type="text" name="currency" placeholder="Währung" value="Euro" required>
                        </div>
                        <div class="passwordCheck">
                            <input class="adminPasswordCheck" type="password" name="password" placeholder="Administrator Passwort" required>
                        </div>
                        <div class="submitOperation">
                            <button type="submit" name="submit" value="addProduct">Produkt hinzufügen</button>
                            <button type="reset" name="resetAddProduct" value="reset">Zurücksetzen</button>
                        </div>
                    </form>
                </div>
                <div class="errorsContainer" style ="border-radius:5px; color: var(--orangeAccentColor)">
                    <?if (!empty($addProductErrors)):?>
                        <?foreach ($addProductErrors as $error):?>
                            <p class="manageProductsError"><?=$error?></p>
                        <?endforeach?>
                    <?endif?>
                </div>
                <div class="successContainer">
                    <?if (!empty($success)):?>
                        <?foreach ($success as $successMessage):?>
                            <p class="successEntry"><?=$successMessage?></p>
                        <?endforeach?>
                    <?endif?>
                </div>
            </li>
            <li class="changeProductContainer">
                <h2>Produktdaten ändern</h2>
                <div class="changeProductFormularContainer">

                    <form method="POST">
                        <div class="inputFields">
                            <input type="text" name="productID" placeholder="ID des zu ändernden Produkts" required>
                            <br>
                            <p>Zu ändernde Daten:</p>
                            <br>
                            <div class="firstRow">
                            <input class="quantityStored" type="number"  name="quantityStored" placeholder="Anzahl (gelagert)">
                                <select class="category" name="category">
                                    <option hidden="hidden" disabled="disabled" selected="selected">Kategorie wählen</option>
                                    <?foreach ($categories as $categoryName):?>
                                        <option value="<?=$categoryName?>" ><?=$categoryName?></option>
                                    <?endforeach;?>
                                </select>
                            </div>
                            <textarea class="prodName" type="text" name="prodName" placeholder="Produktname" rows="3"></textarea>
                            <textarea class="prodDescription" type="textarea" name="prodDescription" placeholder="Produktbeschreibung" rows="7"></textarea>
                            <input class="productImageUploadLabel" name="file" type="file"/>
                            <div class="lastRow">
                                <input class="pricingAmount" type="number" step="0.01" name="amount" placeholder="Preis">
                                <input class="pricingCurrency" type="text" name="currency" placeholder="Währung" value="Euro">
                            </div>
                            <div class="passwordCheck">
                                <input class="adminPasswordCheck" type="password" name="password" placeholder="Administrator Passwort" required>
                            </div>
                        <div class="submitOperation">
                            <button type="submit" name="submit" value="changeProduct">Produktdaten ändern</button>
                            <button type="reset" name="reset" value="reset">Zurücksetzen</button>
                        </div>
                    </form>
                </div>
                <div class="errorsContainer" style ="border-radius:5px; color: var(--orangeAccentColor)">
                    <?if (!empty($changeProductErrors)):?>
                        <?foreach ($changeProductErrors as $error):?>
                    <p class="manageProductsError"><?=$error?></p>
                        <?endforeach?>
                    <?endif?>
                </div>
                <div class="successContainer">
                    <?if (!empty($success)):?>
                        <?foreach ($success as $successMessage):?>
                            <p class="successEntry"><?=$successMessage?></p>
                        <?endforeach?>
                    <?endif?>
                </div>
            </li>
            <li class="deleteProductContainer">
                <h2>Produkt entfernen</h2>
                <div class="deleteProductFormularContainer">
                    <form method="POST">
                        <input type="text" name="productID" placeholder="ID des zu entfernenden Produkts">
                        <div class="passwordCheck">
                            <input class="adminPasswordCheck" type="password" name="password" placeholder="Administrator Passwort" required>
                        </div>
                        <div class="submitOperation">
                            <button type="submit" name="submit" value="deleteProduct">Produkt entfernen</button>
                            <button type="reset" name="reset" value="reset">Zurücksetzen</button>
                        </div>
                    </form>
                </div>
                <div class="errorsContainer">
                    <?if (!empty($deleteProductErrors)):?>
                        <?foreach ($deleteProductErrors as $error):?>
                            <p class="errorEntry"><?=$error?></p>
                        <?endforeach?>
                    <?endif?>
                </div>
                <div class="successContainer">
                    <?if (!empty($success)):?>
                        <?foreach ($success as $successMessage):?>
                            <p class="successEntry"><?=$successMessage?></p>
                        <?endforeach?>
                    <?endif?>
                </div>
            </li>
        </ul>
    </div>
</main>
</body>