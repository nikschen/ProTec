<header>
    <div class="headerContainer">
        <div class="navigationsContainer">

            <div class="navbar">
                <div class="protecLogoContainer">
                    <a class="protecLogo" href="index.php?c=pages&a=index"><img class="protecLogo"  src="src/icons/protec_transparent_schwarz_umrandet.png" alt="Logo"></a>
                </div>
                <div class="navigation">
                    <div class="dropdown">
                            <li class="dropbtn"> <a href="./index.html"><img class="categoryLogo" id="logo" src="src/icons/categories/elektronikIcon.png" alt="Elek." > Elektronik</a></li>

                                <div class=dropdown-content>
                                    <a href="./index.html">Kabel</a>
                                    <a href="./index.html">Werkzeug</a>
                                    <a href="./index.html">Bauteile</a>
                                    <a href="./index.html">Zubehör</a>
                                </div>


                        </div>
                    <div class="dropdown">
                            <li class="dropbtn"> <a href="./index.html"><img class="categoryLogo" id="logo" src="src/icons/categories/raspberryPiIcon.png" alt="RasPi." > RaspberryPi</a></li>

                                <div class=dropdown-content>
                                    <div class=dropdownContentElement>
                                        <a href="./index.html">Pi-1/2/3/4/Zero</a>
                                    </div>
                                    <div class=dropdownContentElement>
                                        <a href="./index.html">Gehäuse</a>
                                    </div>
                                </div>


                        </div>
                    <div class="dropdown">
                            <li class="dropbtn"> <a href="./index.html"><img class="categoryLogo" id="logo" src="src/icons/categories/computerIcon.png" alt="Comp." > Computer</a></li>

                                <div class=dropdown-content>
                                    <a href="./index.html">Barebones</a>
                                    <a href="./index.html">KomplettPCs</a>
                                    <a href="./index.html">Arbeitsspeicher</a>
                                </div>


                        </div>
                    <div class="dropdown">
                            <li class="dropbtn"> <a href="./index.html"><img class="categoryLogo" id="logo" src="src/icons/categories/neuIcon.png" alt="Neu" > Neu</a></li>

                                <div class=dropdown-content>
                                    <a href="./index.html">Kabel</a>
                                    <a href="./index.html">Werkzeug</a>
                                    <a href="./index.html">Verbinder</a>
                                    <a href="./index.html">Bauteile</a>
                                    <a href="./index.html">Zubehör</a>
                                </div>
                            </li>

                        </div>
                    <div class="dropdown">
                        <li class="dropbtn"> <a href="./index.html"><img class="categoryLogo" id="logo" src="src/icons/categories/sensorenIcon.png" alt="Sens." > Sensoren</a></li>

                            <div class=dropdown-content>
                                <a href="./index.html">Temperatursensoren</a>
                                <a href="./index.html">Bewegungsmelder</a>
                                <a href="./index.html" style="width:92%">Strommesser</a>
                                <a href="./index.html" style="width:92%">GyroSensor</a>
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
                <a  href="<?=$_SERVER['SCRIPT_NAME']?>?c=pages&a=login"  ><img class="loginSymbol" src="src/icons/loginIcon.png"> Login</a>
                </div>
            </div>
        </div>
    </div>
</header>
<body class="Site">
