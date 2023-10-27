<?php
   session_start();
//    echo "<input type='hidden' id='erabiltzailea' value=" . $_SESSION["erabiltzailea"] . ">";
 ?>

<!DOCTYPE html>
<html lang="eu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="icon" href="../img/favicon2.ico" type="image/x-icon">
    <link rel="shortcut icon" href="../img/favicon2.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <title>Kategoria</title>
</head>

<body>
    <div class="container">
        <!-- MENU DE NAVEGACION -->
        <nav>
            <input type="checkbox" id="check"> 
            <label for="check" class="checkbtn">
                <i class="fas fa-bars"></i>
            </label>
            <div class="logo-container">
                <img class="logo" src="../img/julian cabeza.jpg" />
                <p>Julian (#erabiltzaile_izena)</p>
            </div>
            <ul class="nav-links">
                <li><a href="kokalekua.html">Kokalekua</a></li>
                <li><a href="ekipamendua.html">Ekipamendua</a></li>
                <li><a href="#">Kategoria</a></li>
                <li><a href="gela.html">Gela</a></li>
                <li><a href="inbentarioa.html">Inbentarioa</a></li>
                <li><a href="#">Erabiltzailea</a></li>
                <li><a href="#">Logout</a></li>
            </ul>
        </nav>

        <!--TAULA -->
        <div class="content">
            <h1>KATEGORIA</h1>
            <div class="botoiak">
                <button type="submit" id="gehitu"><i class="fa-solid fa-circle-plus"></i></button>
                <form action="">
                    <button type="submit"><i class="fa-solid fa-pencil"></i></button>
                    <button type="submit"><i class="fa-solid fa-trash"></i></button>
                    <select name="bilaketa" id="bilaketa">
                        <option value="id">ID</option>
                        <option value="izena">Izena</option>
                    </select>
                    <input type="text" placeholder="Bilatu...">
                    <button class="lupa" type="submit"><i class="fa fa-search"></i></button>
                </form>
            </div>

            <table id="inbentarioaTable">
                <tr>
                    <th></th>
                    <th>ID</th>
                    <th>Izena</th>
                </tr>

                <tbody id="showDataInbentarioa"></tbody>
            </table>

            <div class="popup-container" id="gehituContainer">
                <div class="popup">
                    <h2>Gehitu</h2>
                    <form id="gehituForm">
                        <label for="izena">Izena:</label>
                        <input type="text" id="izena" name="izena" required>
                        <br><br>
                        <button type="submit" id="gehituSubmit">Onartu</button>
                        <button type="button" id="itxiGehituPopup">Itxi</button>
                    </form>
                </div>
            </div>

            <script src="../js/kategoria.js"></script>

            <div class="tab-control">
                <img src="../img/flecha-izquierda.png" id="previous" onclick="paginarInbentarioa(-1)" />
                <span id="page-number">1</span> / <span id="total-pages">-</span>
                <img src="../img/flecha-derecha.png" id="next" onclick="paginarInbentarioa(1)" />
            </div>
        </div>        
        <div class="footer">
            <iframe src="footer.php" width="100%" height="70px" frameborder="0"></iframe>
        </div>
    </div>
    
</body>

</html>