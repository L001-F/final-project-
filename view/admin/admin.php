<?php 
$id=isset($_GET['id'])? $_GET['id']:'';
if(!$id){
    header("Location: index.php");
  }else{
    include('../../model/class.php') ;
    $adm=new Scolarite();

 if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['Confirmer'])) {
    $id = isset($_POST['id']) ? $_POST['id'] : '';
    $status = $_POST['status'];
    $adm->status($status, $id);}
}

?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="admin.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">


    <title>Document</title>
</head>
<body>
<header>
  <div class="header-container">
    <div class="user-actions">
      <nav class="navbar bg-body-tertiary fixed-top">
        <div class="container-fluid d-flex justify-content-between align-items-center">
          <!-- Left side: Logo -->
          <a class="navbar-brand" href="#">
            <img src="images/logoUMBB.png" alt="Université Logo" class="logo">
          </a>
          <button class="nav-btn active mx-2" data-target="deposer">
          Consulter les demandes
  </button>
          <form action="" method="post">
          <div class="search-box">
                    <input type="search" placeholder="Rechercher ..." name="student">
                    <button type="submit" name="search">
                        <i class="fas fa-search"></i>
                    </button>
                    <!--search results-->
                </form>
          <!-- Right side: Toggler button -->
          <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <!-- Offcanvas content -->
          <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header">
              <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Offcanvas</h5>
              <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
              <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="#">Home</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Link</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </nav>
    </div>
  </div>
</header>
<!-- Content Section -->
<div class="content mt-4">
  <!-- Déposer une demande Section -->
  <div class="tab-content active" id="deposer">
    <section class="deposer-section bg-white p-4 rounded shadow-sm mt-3 mb-5">
      <form class="form-horizontal" method="post">
        <div style="margin: 70px 50px 20px 50px;; width: 80%;">
        <div class="filters-container">
          
  
          <!-- date selection -->
          <div class="filter">
              <label for="end-date">Selectionner par date :</label>
              <input type="date" id="end-date" class="date-picker">
          </div>
  
          <!-- Document type selection -->
          <div class="filter">
              <label for="document-type">Type de document :</label>
              <select id="document-type" class="dropdown">
                  <option value="toutes">toutes</option>
                  <option value="certificat">Certificat de scolarité</option>
                  <option value="bulletin">Bulletin</option>
                  <option value="releve">Relevé de notes</option>
                  <option value="autre">Autre</option>
              </select>
          </div>
  
          <!-- Academic year selection -->
          <div class="filter">
              <label for="academic-year">Année scolaire :</label>
              <select id="academic-year" class="dropdown">
                  <option value="toutes">toutes</option>
                  <option value="l1">L1</option>
                  <option value="l2">L2</option>
                  <option value="l3">L3</option>
                  <option value="m1">M1</option>
                  <option value="m2">M2</option>
              </select>
          </div>
          
      </div>
    <table class="table">
        <tr>
                            <td>N° Demande</td>
                            <td>Matricule D'etudiant</td>
                            <td>Nom Complet</td>
                            <td>Type Document</td>
                            <td>Date Demande</td>
                            <td>Mettre a jour</td>
                            <td>confermer</td>
                        </tr>
                        <tbody>
<?php 
$data = $adm->getAllDemande();
foreach ($data as $key => $val) {
    // Assuming 'email' is the column for the student's email in your database
    echo "<tr>
        <td>{$val['id']}</td>
        <td>{$val['matricule']}</td>
        <td>{$val['nom']}<br> {$val['prenom']}</td>
        <td>{$val['type_doc']}</td>
        <td>{$val['date_demande']}</td>
        <td>{$val['status']}</td>
        <td>
          <form method='post' onsubmit='sendEmail(event, this)'>
                <select class='form-select' aria-label='Default select example' name='status'>
                  <option value='en cours'>en cours</option>
                  <option value='favorable'>favorable</option>
                  <option value='unfavorable'>unfavorable</option>
                </select>
               
                <button class='btn btn-success' type='submit' name='Confirmer'>Confirmer</button>
          </form>
        </td>
    </tr>";
}  
?>
</tbody>

                    

  
    </table>
    </section>
  </div>
</div>
<!-- Notifications Section -->
<div class="tab-content" id="notifications">
    <section class="notifications-section bg-white p-4 rounded shadow-sm">
      <h3 class="text-center mb-4">Notifications</h3>
      <p class="text-center">Put your code here</p>
    </section>
  </div>
</div>
<script>
    function showTextarea() {
        const select = document.getElementById("typeDocSelect");
        const textAreaDiv = document.getElementById("otherTextArea");
        textAreaDiv.style.display = select.value === "Autre" ? "block" : "none";
    }
  </script>
<!-- Optional JavaScript -->
<script>
  document.querySelectorAll('.nav-btn').forEach(button => {
    button.addEventListener('click', function() {
      // Remove 'active' class from all buttons and sections
      document.querySelectorAll('.nav-btn').forEach(btn => btn.classList.remove('active'));
      document.querySelectorAll('.tab-content').forEach(content => content.classList.remove('active'));

      // Add 'active' class to clicked button and corresponding section
      this.classList.add('active');
      const target = document.getElementById(this.getAttribute('data-target'));
      target.classList.add('active');
    });
  });
</script>
</body>
</html>