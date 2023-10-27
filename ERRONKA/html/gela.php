<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="icon" href="../img/favicon2.ico" type="image/x-icon">
    <link rel="shortcut icon" href="../img/favicon2.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.0/chart.min.js">
    <link rel='stylesheet' href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' />

    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>

    <title>Gela</title>
</head>

<body>
    <div class="container">

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

        <div class="content">
            <h1>GELA</h1>

            <div class="botoiak">
                <iframe src="botoiak.html" width="100%" height="120px" frameborder="0"></iframe>
            </div>
            <!-- <div class="botoiak">
                <form action="">
                    <button type="submit"><i class="fa-solid fa-circle-plus"></i></button>
                    <button type="submit"><i class="fa-solid fa-pencil"></i></button>
                    <button type="submit"><i class="fa-solid fa-trash"></i></button>
                    <select name="bilaketa" id="bilaketa">
                        <option value="etiketa">Izena</option>
                        <option value="gela">Taldea</option>
                    </select>
                    <input type="text" placeholder="Bilatu...">
                    <button class="lupa" type="submit"><i class="fa fa-search"></i></button>
                </form>
            </div> -->

            <table>
                <tr>
                    <th></th>
                    <th>Izena</th>
                    <th>Taldea</th>
                </tr>
                <tr>
                    <td><input type="checkbox"></td>
                    <td>#123</td>
                    <td>123</td>
                </tr>
                <tr>
                    <td><input type="checkbox"></td>
                    <td>#456</td>
                    <td>456</td>
                </tr>
                <tr>
                    <td><input type="checkbox"></td>
                    <td>#789</td>
                    <td>789</td>
                </tr>
                <tr>
                    <td><input type="checkbox"></td>
                    <td>#000</td>
                    <td>000</td>
                </tr>
                <tr>
                    <td><input type="checkbox"></td>
                    <td>#456</td>
                    <td>456</td>
                </tr>
                <tr>
                    <td><input type="checkbox"></td>
                    <td>#789</td>
                    <td>789</td>
                </tr>
                <tr>
                    <td><input type="checkbox"></td>
                    <td>#000</td>
                    <td>000</td>
                </tr>
            </table>

            <div class="tab-control">
                <img src="../img/flecha-izquierda.png" id="previous" onclick="paginarEkipamendua(-1)" />
                <span id="page-number">1</span> / <span id="total-pages">-</span>
                <img src="../img/flecha-derecha.png" id="next" onclick="paginarEkipamendua(1)" />
            </div>
        </div>
        <div class="footer">
            <iframe src="footer.php" width="100%" height="70px" frameborder="0"></iframe>
        </div>
    </div>
    
</body>

</html>