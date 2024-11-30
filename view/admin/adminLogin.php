<DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <!-- Section: Design Block -->
<section class="">
  <!-- Jumbotron -->
  <div class="px-4 py-5 px-md-5 text-center text-lg-start" style="background-color: hsl(0, 0%, 96%)">
    <div class="container">
      <div class="row gx-lg-5 align-items-center">
        <div class="col-lg-6 mb-5 mb-lg-0">
          <h1 class="my-5 display-3 fw-bold ls-tight">
          Bienvenue dans <br />
            <span class="text-primary">Département D'Informatique</span>
          </h1>
          <p style="color: hsl(217, 10%, 50.8%)">
            Accédez rapidement à vos documents administratifs (certificat de scolarité, relevé de notes, etc.).
            Restez informé des dernières actualités et annonces importantes.
            Découvrez les opportunités de formation et d’échange offertes par notre faculté.
          </p>
        </div>

        <div class="col-lg-6 mb-5 mb-lg-0">
          <div class="card">
            <div class="card-body py-5 px-md-5">
              <form style="margin-top : 100px" method="post" action="../../Controler/admin.php">

                <!-- Email input -->
                <div data-mdb-input-init class="form-outline mb-4">
                  <label class="form-label" for="form3Example3">Username</label>
                  <input type="text" id="form3Example3" name="username" class="form-control" />
                </div>

                <!-- Password input -->
                <div data-mdb-input-init class="form-outline mb-4">
                <label class="form-label" for="form3Example4">Mot De Pass</label>
                  <input type="password" id="form3Example4" name="password" class="form-control" />
                </div>

                <!-- Submit button -->
                <button type="submit" name="loginA" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-block mb-4">
                 se Connecter
                </button></form></div></div></div>
</body>
</html>