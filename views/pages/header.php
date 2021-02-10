<header class="header">
    <div class="headerContainer">
        <div class="navbar">
            <div class="protecLogoContainer">
                <a class="protecLogo" href="index.php?c=pages&a=index"><img class="protecLogo"  src="<?=ICONSPATH?>protec_transparent_logo_weiß_umrandet_protec_weiß.png" alt="Logo"></a>
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
           $sessionstatus ="";
            if(isset($_SESSION['email']) && isset($_SESSION['password']))
               {
                   $sessionstatus = "session";                   $email = $_SESSION['email'];
                    $password = $_SESSION['password'];
                    $validResult = validateLogInSessionsAndCookies($email, $password);

                    if($validResult== "1")
                    {
                        $actionLink = "?c=pages&a=logout";
                        $icon = "logoutIcon.png";
                        $text = "Logout";
                        $_SESSION['loggedIn']= 1;
                        $_SESSION['username'] = $_SESSION['email'];
                    }
                    else
                    {
                        $actionLink = "?c=pages&a=login";
                        $icon = "loginIcon.png";
                        $text = "Login";
                    }
                }
            else if(isset($_COOKIE['email']) && isset($_COOKIE['password']))
                {
                    $sessionstatus = "cookie";
                    $email = $_COOKIE['email'];
                    $password = $_COOKIE['password'];

                    
                    $validResult = validateLogInSessionsAndCookies($email, $password);

                    if($validResult == "1")
                    {
                    $actionLink = "?c=pages&a=logout";
                    $icon = "logoutIcon.png";
                    $text = "Logout";
                    $_SESSION['loggedIn']= 1;
                    $_SESSION['username'] = $_COOKIE['email'];//hier wird anders als bei Session der Email Name angezeigt, dass ist gewollt!!! als Debugging, wo kommt der Wert eigentlich her! :-)
                    $_SESSION['email'] = $_COOKIE['email'];
                    }
                    else
                    {
                      echo "<p>No Valid </p>";
                      $actionLink = "?c=pages&a=login";
                      $icon = "loginIcon.png";
                      $text = "Login";
                    } //hier könnte man direkt in logout gehen, aus Sicherheitsgründen, weil ja scheinbar irgendwas nicht stimmt(Manipulationsverhinderung)
                }
                else
                {
                        $actionLink = "?c=pages&a=login";
                        $icon = "loginIcon.png";
                        $text = "Login";
                }
                    ?>
                <a  href="<?=$_SERVER['SCRIPT_NAME']?><?=$actionLink?>"  ><img class="loginSymbol" src="<?=ICONSPATH?><?=$icon?>" alt="<?=$text?>"><br><span class="loginText"><?=$text?></span></a>
            
            </div>
            <div class="productBasketContainer">
                <a href="index.php?c=products&a=productBasket"><img class="productBasketIcon" src="<?=ICONSPATH?>productBasketIcon.png" alt="Warenkorb"><br><span class="productBasketText">Warenkorb</span><span class="productBasketText"> (<?=$amountOfBasketEntries?>)</span></a>
            </div>
            <?if(isset($_SESSION['loggedIn'])) {if($_SESSION['email']=='admin@protec.de'){?>
            <div class="administrationContainer">
                <a href="index.php?c=administrativeOperations&a=chooseOperation"><img class="administrationIcon" src="<?=ICONSPATH?>administrationIcon.png" alt="Administration"><br><span class="administrationText">Administration</span></a>
            </div>
            <?}}?>
            <?if(isset($_SESSION['loggedIn'])) {if($_SESSION['email']!='admin@protec.de'){?>
            <div class="userprofileContainer">
                <a href="index.php?c=accounts&a=profile"><img class="administrationIcon" src="<?=ICONSPATH?>userIcon.png" alt="Administration"><br><span class="userprofileText">Profil</span></a>
            </div>
            <?}}?>
        
    <div class="loginStatus">
            <?if(isset($_SESSION['loggedIn']))
                {
                    if($_SESSION['loggedIn']==1)
                    {
                        echo "<log style= font-size:60%>Willkommen </log><br>";
                        echo "<log style= font-size:60%>".$_SESSION['username'] .  "</log>";
                        echo "<log style= font-size:60%>"." source: ".$sessionstatus.  "</log>";
                        echo "<br><log style= font-size:60%>"." loggedInStatus: ".$_SESSION['loggedIn'].  "</log>";
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
