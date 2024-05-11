<?php
  session_start();

  require '../Controler/database.php';

  if (isset($_SESSION['usuario_id'])) {
    $records = $conn->prepare('SELECT id, email, password FROM usuario WHERE id = :id');
    $records->bindParam(':id', $_SESSION['usuario_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $user = null;

    if (count($results) > 0) {
      $user = $results;
    }
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Bienvenido a Mynomina</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <script src="https://kit.fontawesome.com/162e2e5f40.js"></script>
    <link rel="stylesheet" href="../CSS/stilos.css">
    <link rel="stylesheet" href="../CSS/calc.css">
    <link rel="stylesheet" href="../CSS/resultados.css">
    <link rel="stylesheet" href="../CSS/footer.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>




  </head>
  <body>
  <div id="menuContainer" class="menu-container"></div>

   <!-- Start Navigation Bar -->
<div class="mobile-menu">
  <i class="fa fa-bars fa-3x js-menu-icon"></i>
</div>
<nav class="navbar js-navbar">
  <ul class="menu">
    <li>
      <a class="hasDropdown" href="#">Funciones <i class="fa fa-angle-down"></i></a>

      <ul class="container">
        <div class="container__list">
          <div class="container__listItem">
            <div>Nómina y Seguridad Social</div>
          </div>
          <div class="container__listItem">
            <div>Vinculación</div>
          </div>
          <div class="container__listItem">
            <div>Bienestar Financiero</div>
          </div>
        </div>
      </ul>
    </li>
    <li>
      <a class="hasDropdown" href="#">Recursos<i class="fa fa-angle-down"></i></a>
      <ul class="container has-multi">
        <div class="container__list container__list-multi">
          <div class="container__listItem">
            <div>Blog</div>
          </div>
          <div class="container__listItem">
            <div>Blibioteca</div>
          </div>
          <div class="container__listItem">
            <div>Centro de ayuda</div>
          </div>
      </ul>
    </li>
    <li>
      <a href="#">Porque My Nomina?</a>
    </li>
    <li>
      <a href="#">Precios</a>
    </li>
  </ul>
</nav>



    <?php if(!empty($user)): ?>
      <br> Bienvenido: <?= $user['email']; ?>
      <br>
<br>
      
      <h2>Contenido</h2>

      <br>


<a class="links" href="#" onclick="mostrarContenido('contenido1')">Liquidacion por Terminacion de contrato / </a>
<a class="links" href="#" onclick="mostrarContenido('contenido2')">Calcula tu Nomina</a>

<br><br>
<br>

<div id="contenido1" style="display: none;">


<nav class="calc">
    <div id="formulario">
        <h2>Calculadora de Nómina</h2>
        <label for="fechaInicio">Fecha de Inicio:</label>
        <input type="date" id="fechaInicio">

        <label for="fechaFinal">Fecha Final:</label>
        <input type="date" id="fechaFinal">

        <label for="auxilioTransporte">Auxilio de Transporte:</label>
        <input type="number" id="auxilioTransporte" placeholder="Ingrese el auxilio de transporte">

        <label for="pagosExtras">Pagos extras:</label>
        <input type="number" id="pagosExtras" placeholder="Ingrese sus pagos extras">

        <label for="salarioMensual">Salario Mensual:</label>
        <input type="number" id="salarioMensual" placeholder="Ingrese el salario mensual">

        <button onclick="calcularNomina()">Calcular Nómina</button>
    </div>

   
    <div id="resultados">
        <h2>Resultados</h2>
        <table id="tablaResultados">
            <thead>
                <tr>
                    <th>Cesantías</th>
                    <th>Intereses sobre Cesantías</th>
                    <th>Prima de Servicios</th>
                    <th>Vacaciones</th>
                    <th>Total a Pagar</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td id="cesantiasTotalResult" ></td>
                    <td id="interesesCesantiasTotalResult"></td>
                    <td id="primaServiciosTotalResult"></td>
                    <td id="vacacionesTotalResult"></td>
                    <td id="salarioTotalResult"></td>
                </tr>
            </tbody>
        </table>
    </div>
</nav>





</div>


</div>

<br>
<br>

<div id="contenido2" style="display: none;">
<nav class="calc">
<h1>Calculadora de Nómina</h1>
    <div id="formulario">
        <h2>Datos del Empleado</h2>
        <label for="salarioMensual">Salario Mensual:</label>
        <input type="number" id="salarioMensual" placeholder="Ingrese el salario mensual" required>

        <label for="auxilioTransporte">Auxilio de Transporte:</label>
        <input type="number" id="auxilioTransporte" placeholder="Ingrese el auxilio de transporte" required>

        <label for="pagosExtras">Pagos Extras:</label>
        <input type="number" id="pagosExtras" placeholder="Ingrese los pagos extras" required>

        <label for="deducciones">Deducciones:</label>
        <input type="number" id="deducciones" placeholder="Ingrese las deducciones" required>

        <label for="fechaInicio">Fecha de Inicio:</label>
        <input type="date" id="fechaInicio" required>

        <label for="fechaFinal">Fecha Final:</label>
        <input type="date" id="fechaFinal" required>

        <button onclick="calcularNomina()">Calcular Nómina</button>
    </div>

    <div id="resultados">
        <h2>Resultado</h2>
        <div id="salarioNetoResult"></div>
    </div>

  </nav>
 


</div>
<br><br>





                                
                                
<br>
<br>
      
      <a class="link-1" href="../Vista/salir.php">
        Salir
      </a>
    <?php else: ?>
        <?php endif; ?>
      <div id="container">
 
    
    <footer>
        <div class="row">
            <div class="col">
                <h1 class="logo2">My Nomina</h1>
                <p>Recibe las últimas actualizaciones y noticias directamente en tu correo electrónico</p>
            </div>
            <div class="col">
                <h3>Office <div class="underline"><span></span></div></h3>
                <p>ITPL Road</p>
                <p>Medellin, Antioquia</p>
                <p>PIN 650054, Colombia</p>
                <p class="email-id">MyNomina@gmail.com</p>
                <h4>+57 - 3242330008</h4>
            </div>
            <div class="col">
                <h3>Links <div class="underline"><span></span></div></h3>
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Services</a></li>
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Features</a></li>
                    <li><a href="#">Contacts</a></li>
                </ul>
            </div>
            <div class="col">
                <h3>Newsletter <div class="underline"><span></span></div></h3>
                <form action="">
                    <i class="fa-regular fa-envelope"></i>
                    <input type="email" placeholder="Enter your Email" required>
                    <button type="submit"><i class="fa-solid fa-arrow-right"></i></button>
                </form>
                <div class="social-icons">
                    <i class="fa-brands fa-facebook-f"></i>
                    <i class="fa-brands fa-twitter"></i>
                    <i class="fa-brands fa-whatsapp"></i>
                    <i class="fa-brands fa-pinterest"></i>
                </div>
            </div>
        </div>
        <hr>
        <p class="cop">My Nomina 2024 | All Rigths Reserved</p>
    </footer>
    
  </body>
  <script src="../JS/calcular.js"></script>
  <script src="../JS/calcular2.js"></script>
<script src="../JS/generar.js"></script>
<script src="../JS/nomina.js"></script>

</html>