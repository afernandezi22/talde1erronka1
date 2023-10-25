<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/grafiko.css">
    <link rel="icon" href="../img/favicon2.ico" type="image/x-icon">
    <link rel="shortcut icon" href="../img/favicon2.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.0/chart.min.js"> -->

    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>
    <title>Ekipamendua</title>
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

        <!-- TABLA -->
        <div class="content">
            <h1>EKIPAMENDUA</h1>
            <div class="botoiak">
                <form action="">
                    <button type="submit"><i class="fa-solid fa-circle-plus"></i></button>
                    <button type="submit"><i class="fa-solid fa-pencil"></i></button>
                    <button type="submit"><i class="fa-solid fa-trash"></i></button>
                    <select name="bilaketa" id="bilaketa">
                        <option value="etiketa">Etiketa</option>
                        <option value="gela">Gela</option>
                        <option value="hasieraData">Hasiera Data</option>
                        <option value="amaieraData">Amaiera Data</option>
                    </select>
                    <input type="text" placeholder="Bilatu...">
                    <button class="lupa" type="submit"><i class="fa fa-search"></i></button>
                </form>
            </div>

            <table id="ekipamenduaTable">
                <tr>
                    <th></th>
                    <th>ID</th>
                    <th>Izena</th>
                    <th>Deskribapena</th>
                    <th>Marka</th>
                    <th>Modelo</th>
                    <th>Stock</th>
                </tr>

                <tbody id="showDataEkipamendua"></tbody>
            </table>

            <div class="tab-control">
                <img src="../img/flecha-izquierda.png" id="previous" onclick="paginarEkipamendua(-1)" />
                <span id="page-number">1</span> / <span id="total-pages">-</span>
                <img src="../img/flecha-derecha.png" id="next" onclick="paginarEkipamendua(1)" />
            </div>
        </div>

        <script src="../js/viewTableEkipamendua.js"></script>
        <!-- <script src="../js/viewTableEkipamendua.js"></script> -->

        <!-- FOOTER -->
        <div class="footer">
            <a href="https://www.fpsanjorge.com/" target="_blank">
                <img class="sanjorge" src="../img/logo-san-jorge.png" alt="Logo San Jorge" />
            </a>
            <p>&copy; 2023 San Jorge. Eskubide guztiak erreserbatuta.</p>
            <a href="mailto:sanjorge@fpsanjorge.com" target="_blank">
                <img class="correo" src="../img/correo-electronico-vacio.png" alt="Helbide Elektronikoa" />
            </a>
            <a href="https://twitter.com/CIFPSanJorge" target="_blank">
                <img class="twitter" src="../img/logo-black.png.twimg.1920.png" alt="X" />
            </a>
            <a href="https://www.facebook.com/cifpsanjorgelhii" target="_blank">
                <img class="facebook" src="../img/logofacebook.png" alt="Facebook" />
            </a>
            <a href="https://www.instagram.com/cifpsanjorge/" target="_blank">
                <img class="instagram" src="../img/instagram-logo.png" alt="Instagram" />
            </a>
        </div>
    </div>
</body>

</html>
