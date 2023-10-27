<!DOCTYPE html>
<html lang="es">

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
    <!-- <script>
        function load_menu(){
            document.getElementsByClassName("container")[0].innerHTML='<object type="text/html" data="menu.html"><object>';
        }
    </script> -->

    <title>Kokalekua</title>
</head>

<body>
    <div class="container">

        <nav class="navbar">
            
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
        <!-- <div id="menu-container">
            
            
        </div> -->
        <!-- <script>
            load_menu();
        </script> -->

        <div class="content">
            <h1>KOKALEKUA</h1>

            <div class="botoiak">
                <iframe src="botoiak.html" width="100%" height="120px" frameborder="0"></iframe>
            </div>

            <table id="kokalekuaTable">
                <tr>
                    <th></th>
                    <th>Etiketa</th>
                    <th>ID Gela</th>
                    <th>Hasiera Data</th>
                    <th>Amaiera Data</th>
                </tr>

                <tbody id="showData_kokalekua"></tbody>

                
            </table>

            <div class="tab-control">
                <img src="../img/flecha-izquierda.png" id="previous" onclick="paginar(-1)" />
                <span id="page-number">1</span> / <span id="total-pages">-</span>
                <img src="../img/flecha-derecha.png" id="next" onclick="paginar(1)" />
            </div>
        </div>
        <script src="../js/viewTables.js"></script>

        <h1>ORDENAGAILUEN EGOERA</h1>

        <canvas id="grafikoa"></canvas>

        <script>
            // Obtén el contexto del canvas
            var ctx = document.getElementById('grafikoa').getContext('2d');
        
            // Datos del gráfico
            var datos = {
            labels: ['Libre', 'Hartuta'],
            datasets: [{
                label: 'Ordenagailuak',
                data: [12, 19], // Datos para el gráfico de rosquilla
                backgroundColor: [
                    'rgba(80, 135, 236, 0.7)', // Color de fondo para el primer dato
                    'rgba(255, 99, 132, 0.7)', // Color de fondo para el segundo dato
                    
                ],
                borderColor: [
                    'rgba(80, 135, 236, 1)', // Color del borde para el primer dato
                    'rgba(255, 99, 132, 1)', // Color del borde para el segundo dato
                ],
                borderWidth: 1 // Ancho del borde del gráfico de rosquilla
            }]
        };
        
            // Configuración del gráfico
            var config = {
            type: 'doughnut', // Tipo de gráfico (gráfico de rosquilla)
            data: datos,
            options: {
                responsive: true,
            }
            };
        
            // Crea el gráfico
            var miGrafico = new Chart(ctx, config);
        </script>
        
        <div class="footer">
            <iframe src="footer.html" width="100%" height="70px" frameborder="0"></iframe>
        </div>
    </div>
    
</body>

</html>