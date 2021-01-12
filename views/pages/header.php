<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/styleFixedHeader.css">
</head>

<body>
   
<div class="square"></div>
<div class="border"></div>
<div class="navbar">

<a class="ProtecLogo" href="index.php?c=pages&a=index"><img id="logo" src="src/icons/protec_transparent_weiß_umrandet.png" alt="Logo" height=50px></a>
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
                <a href="./index.html">Pi-1/2/3//4/Zero</a>
                <a href="./index.html">Gehäuse</a>
              
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
                <a href="./index.html">Strommesser</a>
                <a href="./index.html">GyroSensor</a>
            </div>
        </li>

    </div>
    <li>
    <div class="Search">
        <form method="post">
            <input type="text" placeholder="Produktsuche...">
            <button type="submit"><img src="src/icons/searchIcon.png" height="15em" /> Go</button>

        </form>
     </div>
    </li>
    <li id="Login-Smart">
    <a href="<?=$_SERVER['SCRIPT_NAME']        ?>?c=pages&a=login"  >Login</a>
    </li>

    
    
    
    
    
    
  </div>
  
  
</div>


<div class="navigationsContainer"> 

      












</div>

