<?php 
$matricule=isset($_GET['matricule'])? $_GET['matricule']:'';
if(!$matricule){
    header("Location: index.php");
}else{
  include('../../model/class.php') ;
  $std=new Scolarite();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="student.css">
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
            <img src="/images/logoUMBB.png" alt="Université Logo" class="logo">
          </a>

        
          <button class="nav-btn active mx-2" data-target="deposer">
     Déposer une demande
  </button>
  <button class="nav-btn mx-2" data-target="consulter">
     Demande déposée
  </button>
  <button class="nav-btn mx-2" data-target="notifications">
    Notifications
  </button>

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
      <form class="form-horizontal" method="post" action="../../Controler/student.php">
        <div style="margin: 70px 50px 20px 50px;; width: 80%;">
          <div class="form-group text-center">
            <h2>Déposer une Demande</h2>
          </div>
          <!-- Matricule -->
          <div class="form-group mt-3">
            <label class="form-label">Matricule</label>
            <input type="text" class="form-control" placeholder="Entrez votre matricule..." name="matricule" required>
          </div>
          <!-- Nom -->
          <div class="form-group mt-3">
            <label class="form-label">Nom</label>
            <input type="text" class="form-control" placeholder="Entrez votre nom..." name="nom" required>
          </div>
          <!-- prenom -->
          <div class="form-group mt-3">
            <label class="form-label">Prenom</label>
            <input type="text" class="form-control" placeholder="Entrez votre prenom..." name="prenom" required>
          </div>
          <!-- Groupe -->
          <div class="form-group mt-3">
            <label class="form-label">Groupe</label>
            <input type="text" class="form-control" placeholder="Entrez votre groupe..." name="groupe" required>
          </div>
          <!-- Niveau -->
          <div class="form-group mt-3">
            <label class="form-label">Niveau</label>
            <select class="form-select" aria-label="Default select example" name="niveau" id="NiveauSelect" onchange="showTextarea()">
              <option value="L1">L1</option>
              <option value="L2">L2</option>
              <option value="L3">L3</option>
              <option value="M1">M1</option>
              <option value="M2">M2</option>
            </select>
          </div>
          <!-- Spécialités -->
          <div class="form-group mt-3">
            <label class="form-label">Spécialités</label>
            <select class="form-select" aria-label="Default select example" name="specialites" id="specialitesSelect">
              <option value="INFO">INFO</option>
              <option value="ISIL">ISIL</option>
              <option value="SI">SI</option>
              <option value="IT">IT</option>
            </select>
          </div>
          <!-- Année scolaire -->
          <div class="form-group mt-3">
            <label class="form-label">Année scolaire</label>
            <input type="text" class="form-control" placeholder="2024-2025" name="annee_scolaire" required>
          </div>
          <!-- Type Document -->
          <div class="form-group mt-3">
            <label class="form-label">Type Document</label>
            <select class="form-select" aria-label="Default select example" name="type_doc" id="typeDocSelect" onchange="showTextarea()">
              <option value="Certificat de scolarité">Certificat de scolarité</option>
              <option value="Attestation de bonne conduite">Attestation de bonne conduite</option>
              <option value="Relevé de notes">Relevé de notes</option>
              <option value="Autre">Autre</option>
            </select>
          </div>
          <!-- Autre Textarea -->
          <div class="form-group mt-3" id="otherTextArea" style="display: none;">
            <label for="otherDetails" class="form-label">Veuillez préciser :</label>
            <textarea class="form-control" id="otherDetails" name="other_details" rows="3" placeholder="Précisez ici..."></textarea>
          </div>
          <!-- Submit Button -->
          <div class="form-group mt-3 text-center">
            <button type="submit" class="btn btn-success" name="Envoyer">Envoyer</button>
          </div>
        </div>
      </form>
    </section>
  </div>
</div>
<!-- Demande déposée Section -->
<div class="tab-content" id="consulter">
  <div class="container ">
        <div class="row">
           <div class="col">
            <div class="card mt-5">
                <div class="card-header">
                    <h2 class="display-6 text-center">Demandes list </h2>
                </div>
                <div class="card-body">
                  <table class="table table-border text-center">
                    <tr class="bg-dark text-white ">
                        <td>nom</td>
                        <td>prenom</td>
                        <td>groupe</td>
                        <td>type doc</td>
                        <td>status</td>
                        
                    </tr>
                    <tbody>

                    <?php 
                       
                        $data=$std->getDemande($matricule);
                        foreach ($data as $key => $val) {
                            echo "<tr>
                                <td>$val[nom]</td>
                                <td>$val[prenom]</td>
                                <td>$val[groupe]</td>
                                <td>$val[type_doc]</td>
                                <td>$val[status]</td>
                            </tr>";
            }
        ?>
                    </tbody>
                  </table>
               
                </div>
            </div>
           </div>
        </div>

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