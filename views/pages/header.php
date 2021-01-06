<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/styleFixedHeader.css">
    <title>Header Übung</title>
</head>

<body>
   
<div class="square"></div>
<div class="navbar">
  
  <div class="navigation">
<ul>
  
    <img id="slide" src="src/images/LogoProtecTransparent.png" alt="Logo" width="10%" height="10%"  />
    <li> <a href="./index.html">Elektronik</a> </li>
    <li> <a href="./text-formatieren.html">RaspberryPi</a> </li>
    <li> <a href="./bilder-hinzufuegen.html">Computer</a> </li>
    <li> <a href="./links-erstellen.html">NeuEingetroffen</a> </li>
    <li> <a href="./listen-erstellen.html">Sensoren</a> </li>
</ul>
  </div>

  <div class="LoginFields">
    <form action="FixedHeader.php">
      <label for="fname">Login:</label>
      <input type="text" id="E-Mail" name="fname" placeholder="Username or E-Mail"><br><br>
      <label for="lname">Password:</label>
      <input type="text" id="Password" name="lname" placeholder="Password"><br><br>
      <button type="submit" id="LoginButton">Login</button> 
  </form> 
</div>
</div>