<header class="header">
    <div class="headerContainer">
        <div class="navbar">
            <div class="protecLogoContainer">
                <a class="protecLogo" href="index.php?c=pages&a=index"><img class="protecLogo"  src="<?=ICONSPATH?>protec_transparent_weiß_umrandet.png" alt="Logo"></a>
                <a class="protecLogoMinimal" href="index.php?c=pages&a=index"><img class="protecLogoMinimal"  src="<?=ICONSPATH?>protecMinimal.png" alt="Logo"></a>
            </div>
            <div class="navigation">
                <div class="dropdown">
                    <li class="dropbtn"> <a href="index.php?c=pages&a=categoryElectronic"><img class="categoryLogo" id="logo" src="<?=ICONSPATH?>categories/elektronikIcon.png" alt="Elek." ><span class="categoryTitle">Elektronik</span></a></li>

                    <div class=dropdown-content>
                        <a href="index.php?c=pages&a=subcategory&subcat=Elektronik&cat=Kabel">Kabel</a>
                        <a href="index.php?c=pages&a=subcategory&subcat=Elektronik&cat=Werkzeug">Werkzeug</a>
                        <a href="index.php?c=pages&a=subcategory&subcat=Elektronik&cat=Bauteile">Bauteile</a>
                        <a href="index.php?c=pages&a=subcategory&subcat=Elektronik&cat=Zubehör">Zubehör</a>
                    </div>


                </div>
                <div class="dropdown">
                    <li class="dropbtn"> <a href="index.php?c=pages&a=categoryRaspi"><img class="categoryLogo" id="logo" src="<?=ICONSPATH?>categories/raspberryPiIcon.png" alt="RasPi." ><span class="categoryTitle">RaspberryPi</span></a></li>

                    <div class=dropdown-content>
                        <div class=dropdownContentElement>
                            <a href="index.php?c=pages&a=subcategory&subcat=RaspberryPi&cat=Pi-1/2/3/4/Zero">Pi-1/2/3/4/Zero</a>
                        </div>
                        <div class=dropdownContentElement>
                            <a href="index.php?c=pages&a=subcategory&subcat=RaspberryPi&cat=Gehäuse">Gehäuse</a>
                        </div>
                    </div>


                </div>
                <div class="dropdown">
                    <li class="dropbtn"> <a href="index.php?c=pages&a=categoryComputer"><img class="categoryLogo" id="logo" src="<?=ICONSPATH?>categories/computerIcon.png" alt="Comp." ><span class="categoryTitle">Computer</span></a></li>

                    <div class=dropdown-content>
                        <a href="index.php?c=pages&a=subcategory&subcat=Computer&cat=Barebones">Barebones</a>
                        <a href="index.php?c=pages&a=subcategory&subcat=Computer&cat=Komplett-PCs">Komplett-PCs</a>
                        <a href="index.php?c=pages&a=subcategory&subcat=Computer&cat=Arbeitsspeicher">Arbeitsspeicher</a>
                    </div>


                </div>
                <div class="dropdown">
                    <li class="dropbtn"><a href="index.php?c=pages&a=categoryNew"><img class="categoryLogo" id="logo" src="<?=ICONSPATH?>categories/neuIcon.png" alt="Neu" ><span class="categoryTitle">Neu</span></a></li></li>

                </div>
                <div class="dropdown">
                    <li class="dropbtn"> <a href="index.php?c=pages&a=categorySensors"><img class="categoryLogo" id="logo" src="<?=ICONSPATH?>categories/sensorenIcon.png" alt="Sens." ><span class="categoryTitle">Sensoren</span></a></li>

                    <div class=dropdown-content>
                        <a href="index.php?c=pages&a=subcategory&subcat=Sensoren&cat=Temperatursensoren">Temperatursensoren</a>
                        <a href="index.php?c=pages&a=subcategory&subcat=Sensoren&cat=Bewegungsmelder">Bewegungsmelder</a>
                        <a href="index.php?c=pages&a=subcategory&subcat=Sensoren&cat=Strommesser">Strommesser</a>
                        <a href="index.php?c=pages&a=subcategory&subcat=Sensoren&cat=GyroSensor">GyroSensor</a>
                    </div>
                    </li>

                </div>
            </div>
            <div class="searchNavContainer">
                <div class="searchContainer">
                    <form method="post">
                        <input type="text" placeholder="Produktsuche...">
                        <button type="submit"><img src="src/icons/searchIcon.png"/></button>
                    </form>
                </div>
            </div>
            <div class="loginContainer">
                <a  href="<?=$_SERVER['SCRIPT_NAME']?>?c=pages&a=login"  ><img class="loginSymbol" src="<?=ICONSPATH?>loginIcon.png"><br><span class="loginText">Login</span></a>
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
