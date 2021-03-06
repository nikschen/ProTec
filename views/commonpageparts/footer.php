</body>
<footer class="footer">
    <div class="flex-container-footer">
        <ul class="footerItems">
            <li class="footerItemsPartOneContainer">
                <ul class="footerItemsPartOne">
                    <li class="footerItem1">
                        <div class="flex-container-content">
                            <label class="collapsible">
                                <input type="checkbox"/>
                                <span class="collapser"><span class="footerItemsTitle">Wir babbeln über uns</span></span>
                                <div class="collapsed">
                                    <p>ProTec</p>
                                    <p>sponsored by PiFoundation</p>
                                    <p>Wiemuthgasse 21</p>
                                    <p>47623 Kevelaer</p>
                                    <p>Tel: 0500 / 36 36 72 47</p>
                                    <p>info@protec.de</p>
                                </div>
                            </label>
                        </div>
                    </li>
                    <li class="footerItem2">
                        <div class="flex-container-content">
                            <label class="collapsible">
                                <input type="checkbox"/>
                                <span class="collapser"><span class="footerItemsTitle">Allgemeine Informationen</span></span>
                                <div class="collapsed">
                                    <a href="index.php?c=infopages&a=paymentAndShippingDetails">Versand- und Zahlungsbedingungen</a>
                                    <a href="index.php?c=infopages&a=rightOfWithdrawal">Widerrufsrecht</a>
                                    <a href="index.php?c=infopages&a=privacyGuidelines">Datenschutzbestimmungen</a>
                                    <a href="index.php?c=infopages&a=agb">AGB</a>
                                    <a href="index.php?c=infopages&a=impressum">Impressum</a>
                                    <a href="index.php?c=infopages&a=jobs">Jobangebote</a>
                                </div>
                            </label>
                        </div>
                    </li>
                </ul>
            </li>
            <li class="footerItemsPartTwoContainer">
                <ul class="footerItemsPartTwo">
                    <li class="footerItem3">
                        <div class="flex-container-content">
                            <label class="collapsible">
                                <input type="checkbox"/>
                                <span class="collapser"><span class="footerItemsTitle">Service</span></span>
                                <div class="collapsed">
                                    <a href="index.php?c=servicepages&a=customerpromotion">Kunden werben Kunden</a>
                                    <a href="index.php?c=servicepages&a=trustpoints">Treuepunkte</a>
                                    <a href="index.php?c=servicepages&a=businessdiscount">Geschäftskundenrabatte</a>
                                    <a href="index.php?c=servicepages&a=newsletter">Newsletter abonnieren</a>
                                    <a href="index.php?c=servicepages&a=contactform">Kontaktformular</a>
                                    <a href="index.php?c=servicepages&a=documentation">Dokumentation</a>
                                </div>
                            </label>
                        </div>
                    </li>
                    <li class="footerItem4">
                        <div class="flex-container-content" id="partners">
                            <label class="collapsible">
                                <input type="checkbox"/>
                                <span class="collapser"><span class="footerItemsTitle">Unsere Partner</span></span>
                                <div class="collapsed">
                                    <img class="partnerLogo" id="berrybaseLogo" src="<?=ICONSPATH?>partner\berrybase.png" alt="Logo Berrybase">
                                    <img class="partnerLogo" id="dhlLogo" src="<?=ICONSPATH?>partner\dhllogo.png" alt="Logo DHL">
                                    <img class="partnerLogo" id="opensourceLogo" src="<?=ICONSPATH?>partner\opensourcelogo.png" alt="Logo OpenSource">
                                </div>
                            </label>
                        </div>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
    <?if(!isset($_COOKIE['cookieStatus'])) :?>
    <div class="cookieBanner">
        <p>Wir nutzen <b>Cookies</b> für ein einmaliges Nutzererlebnis, wenn Sie diese Seite benutzen stimmen die den Konditionen zu</p>
        <a id="linkToInfo" href="index.php?c=infopages&a=privacyGuidelines">Datenschutzbestimmungen lesen</a>
        <form method="post">
            <button id="understoodButton" type="button" name="cookiesUnderstood">Verstanden</button>
        </form>
    </div>
    
    
    <?endif?>
    

</footer>
</html>
