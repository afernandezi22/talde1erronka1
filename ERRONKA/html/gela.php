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

    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>

    <title>Gela</title>
</head>

<body>
    <div class="container">

        <div class="navbar">
            <div class="logo-container">
                <img class="logo" src="../img/julian cabeza.jpg">
                <a href="#"><strong>ITXI SESIOA</strong> </a>
            </div>
            <div class="nav-links">
                <a href="index.html">Kokalekua</a>
                <a href="#">Ekipamendua</a>
                <a href="#">Kategoria</a>
                <a href="gela.html"><strong><u>Gela</u></strong></a>
                <a href="#">Inbentarioa</a>
                <a href="#">Erabiltzailea</a>
            </div>
        </div>

        <div class="content">
            <h1>GELA</h1>

            <div class="botoiak">
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
            </div>

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

            <div class="orrialdeBotoiak">
                <button class="aurrekoBotoia" type="submit">Aurrekoa</button>
                <p>1/6</p>
                <button class="hurrengoBotoia" type="submit">Hurrengoa</button>
            </div>
        </div>
    </div>

    <div class="footer">
        <iframe src="footer.html" width="100%" height="70px" frameborder="0"></iframe>
    </div>
</body>

</html>
