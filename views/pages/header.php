<header class="header">
    <div class="headerContainer">
        <div class="navbar">
            <div class="protecLogoContainer">
                <a class="protecLogo" href="index.php?c=pages&a=index"><img class="protecLogo"  src="<?=ICONSPATH?>protec_transparent_logo_weiß_umrandet.png" alt="Logo"></a>
                <a class="protecLogoMinimal" href="index.php?c=pages&a=index"><img class="protecLogoMinimal"  src="<?=ICONSPATH?>protecMinimal.png" alt="Logo"></a>
            </div>
            <div class="navigation">
                <div class="dropdown">
                    <div class="dropbtn"> <a href="index.php?c=pages&a=categoryElectronic"><img class="categoryLogo" id="logo" src="<?=ICONSPATH?>categories/elektronikIcon.png" alt="Elek." ><span class="categoryTitle">Elektronik</span></a></div>

                    <div class=dropdown-content>
                        <ul class="dropdownContentList">
                            <li class="dropdownContentListElement"><a href="index.php?c=pages&a=subcategory&subcat=Elektronik&cat=Kabel">Kabel</a></li>
                            <li class="dropdownContentListElement"><a href="index.php?c=pages&a=subcategory&subcat=Elektronik&cat=Werkzeug">Werkzeug</a></li>
                            <li class="dropdownContentListElement"><a href="index.php?c=pages&a=subcategory&subcat=Elektronik&cat=Bauteile">Bauteile</a></li>
                            <li class="dropdownContentListElement"><a href="index.php?c=pages&a=subcategory&subcat=Elektronik&cat=Zubehör">Zubehör</a></li>
                        </ul>
                    </div>


                </div>
                <div class="dropdown">
                    <div class="dropbtn"> <a href="index.php?c=pages&a=categoryRaspi"><img class="categoryLogo" id="logo" src="<?=ICONSPATH?>categories/raspberryPiIcon.png" alt="RasPi." ><span class="categoryTitle">RaspberryPi</span></a></div>

                    <div class=dropdown-content>
                        <ul class="dropdownContentList">
                            <li class="dropdownContentListElement"><a href="index.php?c=pages&a=subcategory&subcat=RaspberryPi&cat=Pi-1/2/3/4/Zero">Pi-1/2/3/4/Zero</a></li>
                            <li class="dropdownContentListElement"><a href="index.php?c=pages&a=subcategory&subcat=RaspberryPi&cat=Gehäuse">Gehäuse</a></li>
                        </ul>
                    </div>


                </div>
                <div class="dropdown">
                    <div class="dropbtn"> <a href="index.php?c=pages&a=categoryComputer"><img class="categoryLogo" id="logo" src="<?=ICONSPATH?>categories/computerIcon.png" alt="Comp." ><span class="categoryTitle">Computer</span></a></div>

                    <div class=dropdown-content>
                        <ul class="dropdownContentList">
                            <li class="dropdownContentListElement"><a href="index.php?c=pages&a=subcategory&subcat=Computer&cat=Barebones">Barebones</a></li>
                            <li class="dropdownContentListElement"><a href="index.php?c=pages&a=subcategory&subcat=Computer&cat=Komplett-PCs">Komplett-PCs</a></li>
                            <li class="dropdownContentListElement"><a href="index.php?c=pages&a=subcategory&subcat=Computer&cat=Arbeitsspeicher">Arbeitsspeicher</a></li>
                        </ul>
                    </div>


                </div>
                <div class="dropdown">
                    <div class="dropbtn"><a href="index.php?c=pages&a=categoryNew"><img class="categoryLogo" id="logo" src="<?=ICONSPATH?>categories/neuIcon.png" alt="Neu" ><span class="categoryTitle">Neu</span></a></div></li>

                </div>
                <div class="dropdown">
                    <div class="dropbtn"> <a href="index.php?c=pages&a=categorySensors"><img class="categoryLogo" id="logo" src="<?=ICONSPATH?>categories/sensorenIcon.png" alt="Sens." ><span class="categoryTitle">Sensoren</span></a></div>
                    <div class=dropdown-content>
                        <ul class="dropdownContentList">
                            <li class="dropdownContentListElement"><a href="index.php?c=pages&a=subcategory&subcat=Sensoren&cat=Temperatursensoren">Temperatursensoren</a></li>
                            <li class="dropdownContentListElement"><a href="index.php?c=pages&a=subcategory&subcat=Sensoren&cat=Bewegungsmelder">Bewegungsmelder</a></li>
                            <li class="dropdownContentListElement"><a href="index.php?c=pages&a=subcategory&subcat=Sensoren&cat=Strommesser">Strommesser</a></li>
                            <li class="dropdownContentListElement"><a href="index.php?c=pages&a=subcategory&subcat=Sensoren&cat=GyroSensor">GyroSensor</a></li>
                        </ul>
                    </div>
                    </li>

                </div>
            </div>
            <div class="searchNavContainer">
                <div class="searchContainer">
                    <form method="post">
                        <input type="text" placeholder="Produktsuche...">
                        <button type="submit"><img src="<?=ICONSPATH?>searchIcon.png"/></button>
                    </form>
                </div>
            </div>
            <div class="loginContainer">
            <?
             if(isset($_SESSION['loggedIn']))
                {
                    if($_SESSION['loggedIn']==1)
                    {
                        $actionLink = "?c=pages&a=logout";
                        $icon = "logoutIcon.png";
                        $text = "Logout";
                    }
                    else 
                    {
                        $actionLink = "?c=pages&a=login";
                        $icon = "loginIcon.png";
                        $text = "Login";
                    }
                }
                else
                {
                        $actionLink = "?c=pages&a=login";
                        $icon = "loginIcon.png";
                        $text = "Login";
                }
                    ?>
                <a  href="<?=$_SERVER['SCRIPT_NAME']?><?=$actionLink?>"  ><img class="loginSymbol" src="<?=ICONSPATH?><?=$icon?>"><br><span class="loginText"><?=$text?></span></a>
            
            </div>
            <div class="productBasketContainer">
                <a href="index.php?c=products&a=productBasket"><img class="productBasketIcon" src="<?=ICONSPATH?>productBasketIcon.png"><br><span class="productBasketText">Warenkorb</span><span class="productBasketText"> (<?=$amountOfBasketEntries?>)</span></a>
            </div>
        
    <div class="loginStatus">
            <?if(isset($_SESSION['loggedIn']))
                {
                    if($_SESSION['loggedIn']==1)
                    {
                        echo "<log style= font-size:60%>Willkommen </log><br>";
                        echo "<log style= font-size:60%>".$_SESSION['username'] .  "</log>";
                    }
                };  ?>
            </div>
        </div>

        <div class="searchNavContainerMinimal">
            <div class="searchContainerMinimal">
                <form method="post">
                    <input type="text" placeholder="Produktsuche...">
                    <button type="submit"><img src="<?=ICONSPATH?>searchIcon.png"/></button>
                </form>
            </div>
        </div>

    </div>
</header>
<body class="Site">
