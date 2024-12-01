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

}$profile = $adm->getProfileA($id); // Ensure this method exists in your Scolarite class
if (!$profile) {
   die("User profile not found!");
}
$input = isset($_POST['student']) ? $_POST['student'] : '';
$search_result = [];
if (!empty($input)) {
    $search_result = $adm->searchStudent($input);
}
// filters + combinision 
$data = []; // Initialize the data array

$filter_date = isset($_GET['filter_date']) ? $_GET['filter_date'] : '';
$filter_type = isset($_GET['filter_type']) ? $_GET['filter_type'] : 'toutes';
$filter_year = isset($_GET['filter_year']) ? $_GET['filter_year'] : 'toutes';

// Handle combinations of filters
if (!empty($filter_date) && $filter_type != 'toutes' && $filter_year != 'toutes') {
    // All filters applied
    $data = $adm->getDemandeByDateTypeAndYear($filter_date, $filter_type, $filter_year);
} elseif (!empty($filter_date) && $filter_type != 'toutes') {
    // Filters: Date and Type
    $data = $adm->getDemandeByDateAndType($filter_date, $filter_type);
} elseif (!empty($filter_date) && $filter_year != 'toutes') {
    // Filters: Date and Year
    $data = $adm->getDemandeByDateAndYear($filter_date, $filter_year);
} elseif ($filter_type != 'toutes' && $filter_year != 'toutes') {
    // Filters: Type and Year
    $data = $adm->getDemandeByTypeAndYear($filter_type, $filter_year); // New method
} elseif (!empty($filter_date)) {
    // Filter: Date only
    $data = $adm->getDemandeByDate($filter_date);
} elseif ($filter_type != 'toutes') {
    // Filter: Type only
    $data = $adm->getDemandeByType($filter_type);
} elseif ($filter_year != 'toutes') {
    // Filter: Year only
    $data = $adm->getDemandeByYear($filter_year);
} else {
    // No filters, fetch all
    $data = $adm->getAllDemande();
}
if (!empty($filter_date) && $filter_year != 'toutes') {
    $data = $adm->getDemandeByDateAndYear($filter_date, $filter_year);
} elseif ($filter_type != 'toutes' && $filter_year != 'toutes') {
    $data = $adm->getDemandeByTypeAndYear($filter_type, $filter_year);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar Navigation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="test.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">


</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
    <div class="brand">
        <i class="fas fa-graduation-cap"></i><span>monPortail</span> <!-- 'monPortail' text hidden when collapsed -->
    </div>
    <div class="menu">
        <a data-section="dashboard" class="active">
            <i class="fas fa-user"></i><span>Profile</span>
        </a>
        <a data-section="Review Requests">
            <i class="fas fa-envelope-open-text"></i><span>Review Requests</span>
        </a>
        <a data-section="Student List">
            <i class="fas fa-users"></i><span>Student List</span>
        </a>
        <a data-section="Add student">
            <i class="fas fa-user-plus"></i><span>Add Student</span>
        </a>
        <a data-section="Search Student">
            <i class="fas fa-search"></i><span>Search</span>
        </a>
    </div>
    <div class="footer">
        <div>
            <span>Faculty of Science</span>
        </div>
    </div>
</div>


  <!-- Main Content -->
  <div class="content">


  <div id="dashboard" class="section active">
  <h1 class="page-title">Your Profile</h1>
  <div class="profile-container">
    <div class="profile-header">
      <!-- Default Profile Image -->
      <img src="images/admin.png" class="profile-photo" alt="Profile Photo">
      <h2 class="profile-name"><?php echo htmlspecialchars($profile['username']); ?></h2>
    </div>
    <div class="profile-info">
      <div class="info-item">
        <label>password:</label>
        <span><?php echo htmlspecialchars($profile['password']); ?></span>
      </div>
    </div>
  </div>
  </div>
  </div>

  <div id="Review Requests" class="section">
  <h1>Student Request Dashboard</h1>
  <div class="filters-container mb-4">
    <!-- Date Filter -->
    <label for="end-date">Sélectionner par date :</label>
    <input 
      type="date" 
      id="end-date" 
      class="date-picker" 
      value="<?php echo isset($_GET['filter_date']) ? htmlspecialchars($_GET['filter_date']) : ''; ?>" 
      onchange="updateFilters()">

    <!-- Document Type Filter -->
    <label for="document-type">Type de document :</label>
    <select id="document-type" class="dropdown" onchange="updateFilters()">
      <option value="toutes" <?php echo (isset($filter_type) && $filter_type === 'toutes') ? 'selected' : ''; ?>>Toutes</option>
      <option value="Certificat de scolarité" <?php echo (isset($filter_type) && $filter_type === 'Certificat de scolarité') ? 'selected' : ''; ?>>Certificat de scolarité</option>
      <option value="Attestation de bonne Conduite" <?php echo (isset($filter_type) && $filter_type === 'Attestation de bonne Conduite') ? 'selected' : ''; ?>>Attestation de bonne Conduite</option>
      <option value="Relevé de notes" <?php echo (isset($filter_type) && $filter_type === 'Relevé de notes') ? 'selected' : ''; ?>>Relevé de notes</option>
    </select>

    <!-- Academic Year Filter -->
    <label for="academic-year">Niveau académique :</label>
    <select id="academic-year" class="dropdown" onchange="updateFilters()">
      <option value="toutes" <?php echo (isset($filter_year) && $filter_year === 'toutes') ? 'selected' : ''; ?>>Toutes</option>
      <option value="L1" <?php echo (isset($filter_year) && $filter_year === 'L1') ? 'selected' : ''; ?>>L1</option>
      <option value="L2" <?php echo (isset($filter_year) && $filter_year === 'L2') ? 'selected' : ''; ?>>L2</option>
      <option value="L3" <?php echo (isset($filter_year) && $filter_year === 'L3') ? 'selected' : ''; ?>>L3</option>
      <option value="M1" <?php echo (isset($filter_year) && $filter_year === 'M1') ? 'selected' : ''; ?>>M1</option>
      <option value="M2" <?php echo (isset($filter_year) && $filter_year === 'M2') ? 'selected' : ''; ?>>M2</option>
    </select>
  </div>

 
    <table class="table table-hover" >
    <thead>
        <tr>
          <th>N° Demande</th>
          <th>Matricule D'étudiant</th>
          <th>Nom Complet</th>
          <th>Type Document</th>
          <th>Date Demande</th>
          <th>Status</th>
          <th>Mettre à jour</th>
          <th>Confirmer</th>
        </tr>
      </thead>
      <tbody>
        <?php
        if (!empty($data)) {
            foreach ($data as $val) {
                echo "<tr>
                    <td>" . htmlspecialchars($val['id']) . "</td>
                    <td>" . htmlspecialchars($val['matricule']) . "</td>
                    <td>" . htmlspecialchars($val['nom']) . " " . htmlspecialchars($val['prenom']) . "</td>
                    <td>" . htmlspecialchars($val['type_doc']) . "</td>
                    <td>" . htmlspecialchars($val['date_demande']) . "</td>
                    <td>" . htmlspecialchars($val['status']) . "</td>
                    <td>
                        <form method='post'>
                            <select class='form-select' name='status'>
                                <option value='en cours'>en cours</option>
                                <option value='favorable'>favorable</option>
                                <option value='unfavorable'>unfavorable</option>
                            </select>
                    </td>
                    <td>
                        <input type='hidden' name='id' value='" . htmlspecialchars($val['id']) . "'>
                        <button class='btn btn-success' type='submit' name='Confirmer'>Confirmer</button>
                        </form>
                    </td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='8' class='text-center'>Aucune demande trouvée pour cette date.</td></tr>";
        }
        ?>
      </tbody>
    </table>
  </div>

  <div id="Student List" class="section">
  <h1 class="text-center">Student List</h1>


  <div class="table-container">
    <table class="table table-hover">
      <thead>
        <tr>
          <th>Student ID</th>
          <th>Last Name</th>
          <th>First Name</th>
          <th>Email</th>
          <th>Group</th>
          <th>Level</th>
          <th>Field</th>
          <th>Academic Year</th>
          <th>Password</th>
        
        </tr>
      </thead>
      <tbody id="studentTableBody">
        <!-- Rows will be added here dynamically by JavaScript -->
        <?php
        $data = $adm->getStudents(); // Initially load all students
        if (!empty($data)) {
          foreach ($data as $val) {
            echo "<tr>
                <td>" . htmlspecialchars($val['matricule'] ?? 'N/A') . "</td>
                <td>" . htmlspecialchars($val['nom'] ?? 'N/A') . "</td>
                <td>" . htmlspecialchars($val['prenom'] ?? 'N/A') . "</td>
                <td>" . htmlspecialchars($val['email'] ?? 'N/A') . "</td>
                <td>" . htmlspecialchars($val['groupe'] ?? 'N/A') . "</td>
                <td>" . htmlspecialchars($val['niveau'] ?? 'N/A') . "</td>
                <td>" . htmlspecialchars($val['specialites'] ?? 'N/A') . "</td>
                <td>" . htmlspecialchars($val['annee_scolaire'] ?? 'N/A') . "</td>
                <td>" . htmlspecialchars($val['password'] ?? 'N/A') . "</td>
                
            </tr>";
          }
        } else {
          echo "<tr><td colspan='9' class='text-center'>No students found.</td></tr>";
        }
        ?>
      </tbody>
    </table>
  </div>
</div>


   <div id="Add student" class="section">
      <h1>Add student</h1>
      <form class="form-horizontal" method="post" action="../../Controler/admin.php">
        <div style="margin: 70px 50px 20px 50px;; width: 80%;">
          <div class="form-group text-center">
            
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
          <!-- Email -->
          <div class="form-group mt-3">
            <label class="form-label">Email</label>
            <input type="email" class="form-control" placeholder="Entrez votre email..." name="email" required>
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
          <div class="form-group mt-3">
            <label class="form-label">Password</label>
            <input type="text" class="form-control" placeholder="enter student password.." name="password" required>
          </div>
        
          <!-- Submit Button -->
          <div class="form-group mt-3 text-center">
            <button type="submit" class="btn btn-success" name="Envoyer">Envoyer</button>
          </div>
        </div>
      </form>
    
   </div>
 <!-- section for searching -->
<div id="Search Student" class="section">
    <h1>Search For Student</h1>
    <p>Here you can search for a student by their ID, first name, or last name</p>

    <div class="search-bar-container">
        <form method="post" class="search-form">
            <div class="search-input">
                
                <input type="text" name="student" value="<?= htmlspecialchars($input) ?>" placeholder="Search by matricule, name, or group">
            </div>
            <button type="submit">Search</button>
        </form>
    </div>

    <br>

    <?php if (!empty($search_result)): ?>
        <table class="results-table">
            <thead>
                <tr>
                    <th>Matricule</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Groupe</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($search_result as $student): ?>
                    <tr>
                        <td><?= htmlspecialchars($student['matricule']) ?></td>
                        <td><?= htmlspecialchars($student['nom']) ?></td>
                        <td><?= htmlspecialchars($student['prenom']) ?></td>
                        <td><?= htmlspecialchars($student['groupe']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No results found.</p>
    <?php endif; ?>
</div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="test.js"></script>

</body>
</html>