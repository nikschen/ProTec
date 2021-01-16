<header class="header">
    <div class="headerContainer">
        <div class="navbar">
            <div class="protecLogoContainer">
                <a class="protecLogo" href="index.php?c=pages&a=index"><img class="protecLogo"  src="src/icons/protec_transparent_weiß_umrandet.png" alt="Logo"></a>
                <a class="protecLogoMinimal" href="index.php?c=pages&a=index"><img class="protecLogoMinimal"  src="src/icons/protecMinimal.png" alt="Logo"></a>
            </div>
            <div class="navigation">
                <div class="dropdown">
                    <li class="dropbtn"> <a href="index.php?c=pages&a=categoryElectronic"><img class="categoryLogo" id="logo" src="src/icons/categories/elektronikIcon.png" alt="Elek." ><span class="categoryTitle">Elektronik</span></a></li>

                    <div class=dropdown-content>
                        <a href="index.php?c=pages&a=subcategory&cat=Kabel">Kabel</a>
                        <a href="index.php?c=pages&a=subcategory&cat=Werkzeug">Werkzeug</a>
                        <a href="index.php?c=pages&a=subcategory&cat=Bauteile">Bauteile</a>
                        <a href="index.php?c=pages&a=subcategory&cat=Zubehör">Zubehör</a>
                    </div>


                </div>
                <div class="dropdown">
                    <li class="dropbtn"> <a href="index.php?c=pages&a=categoryRaspi"><img class="categoryLogo" id="logo" src="src/icons/categories/raspberryPiIcon.png" alt="RasPi." ><span class="categoryTitle">RaspberryPi</span></a></li>

                    <div class=dropdown-content>
                        <div class=dropdownContentElement>
                            <a href="index.php?c=pages&a=subcategory&cat=Pi-1/2/3/4/Zero">Pi-1/2/3/4/Zero</a>
                        </div>
                        <div class=dropdownContentElement>
                            <a href="index.php?c=pages&a=subcategory&cat=Gehäuse">Gehäuse</a>
                        </div>
                    </div>


                </div>
                <div class="dropdown">
                    <li class="dropbtn"> <a href="index.php?c=pages&a=categoryComputer"><img class="categoryLogo" id="logo" src="src/icons/categories/computerIcon.png" alt="Comp." ><span class="categoryTitle">Computer</span></a></li>

                    <div class=dropdown-content>
                        <a href="index.php?c=pages&a=subcategory&cat=Barebones">Barebones</a>
                        <a href="index.php?c=pages&a=subcategory&cat=Komplett-PCs">Komplett-PCs</a>
                        <a href="index.php?c=pages&a=subcategory&cat=Arbeitsspeicher">Arbeitsspeicher</a>
                    </div>


                </div>
                <div class="dropdown">
                    <li class="dropbtn"> <a href="index.php?c=pages&a=categoryNew"><img class="categoryLogo" id="logo" src="src/icons/categories/neuIcon.png" alt="Neu" ><span class="categoryTitle">Neu</span></a></li>

                    <div class=dropdown-content>
                        <a href="index.php?c=pages&a=subcategory&cat=Kabel">Kabel</a>
                        <a href="index.php?c=pages&a=subcategory&cat=Werkzeug">Werkzeug</a>
                        <a href="index.php?c=pages&a=subcategory&cat=Verbinder">Verbinder</a>
                        <a href="index.php?c=pages&a=subcategory&cat=Bauteile">Bauteile</a>
                        <a href="index.php?c=pages&a=subcategory&cat=Zubehör">Zubehör</a>
                    </div>
                    </li>

                </div>
                <div class="dropdown">
                    <li class="dropbtn"> <a href="index.php?c=pages&a=categorySensors"><img class="categoryLogo" id="logo" src="src/icons/categories/sensorenIcon.png" alt="Sens." ><span class="categoryTitle">Sensoren</span></a></li>

                    <div class=dropdown-content>
                        <a href="index.php?c=pages&a=subcategory&cat=Temperatursensoren">Temperatursensoren</a>
                        <a href="index.php?c=pages&a=subcategory&cat=Bewegungsmelder">Bewegungsmelder</a>
                        <a href="index.php?c=pages&a=subcategory&cat=Strommesser">Strommesser</a>
                        <a href="index.php?c=pages&a=subcategory&cat=GyroSensor">GyroSensor</a>
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
                <a  href="<?=$_SERVER['SCRIPT_NAME']?>?c=pages&a=login"  ><img class="loginSymbol" src="src/icons/loginIcon.png"><br><span class="loginText">Login</span></a>
            </div>
        </div>
        <div class="searchNavContainerMinimal">
            <div class="searchContainerMinimal">
                <form method="post">
                    <input type="text" placeholder="Produktsuche...">
                    <button type="submit"><img src="src/icons/searchIcon.png"/></button>
                </form>
            </div>
        </div>

    </div>
</header>
<body class="Site">
