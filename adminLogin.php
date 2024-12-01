




















<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <title>Welcome to the Computer Science Department</title>
    <style>
body {
    font-family: 'Poppins', sans-serif;
    background-color: #e0f7fa; /* Light Blue Shade */
    color: #777; /* Gray for Text */
    scroll-behavior: smooth;
    margin: 0;
    padding: 0;
}

/* Hero Section (background image + content) */
.hero {
    color: white;
    padding: 100px 0;
    text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.9);
    position: relative;
    animation: fadeIn 2s ease-in-out;
    background-color: #1a304f; /* Lighter Blue */
}

.hero h1 {
    font-size: 3.5rem;
    font-weight: 600;
    opacity: 0;
    animation: fadeInUp 1s ease-in-out forwards;
}

.hero p {
    font-size: 1.25rem;
    opacity: 0;
    animation: fadeInUp 1.5s ease-in-out forwards;
}

.cta-btn {
    background-color: #1d3557; /* Accent Blue button */
    border: none;
    border-radius: 50px;
    padding: 12px 25px;
    color: white;
    font-weight: 600;
    transition: all 0.3s ease;
    opacity: 0;
    animation: fadeInUp 2s ease-in-out forwards;
    cursor: pointer;
}

.cta-btn:hover {
    background-color: #1d3557; /* Deep Blue on hover */
    box-shadow: 0px 4px 10px rgba(30, 128, 183, 0.3);
    transform: scale(1.05);
}

/* Adding Parallax Effect to Hero Background */
.hero::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: inherit;
    background-position: center center;
    background-attachment: fixed;
    z-index: -1;
    animation: parallax 15s linear infinite;
}


/* Jumbotron Section */
.jumbotron {
    background-color: rgba(255, 255, 255, 0.9);
    border-radius: 8px;
    padding: 50px 20px;
    box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);
    animation: slideInLeft 1s ease-in-out;
}

.jumbotron h1 {
    font-size: 3rem;
    font-weight: 600;
    color: #1d3557; /* Deep Blue for section title */
    opacity: 0;
    animation: fadeInUp 1s ease-in-out forwards;
}

.jumbotron p {
    color: #1a304f; /* Lighter Blue for text */
    font-size: 1.1rem;
    line-height: 1.8;
    opacity: 0;
    animation: fadeInUp 1.5s ease-in-out forwards;
}

.card {
    border-radius: 8px;
    box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);
    background-color: #fff;
    padding: 30px;
    margin-top: 20px;
    transition: all 0.3s ease-in-out;
    opacity: 0;
    animation: fadeInUp 2s ease-in-out forwards;
}

.card:hover {
    transform: translateY(-10px);
    box-shadow: 0px 6px 20px rgba(0, 0, 0, 0.2);
}

.footer {
    background-color: #f9f9f9; /* Light Gray for footer background */
    color: #777; /* Gray for text */
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    padding: 30px 0;
    text-align: center;
    animation: fadeInUp 2s ease-in-out forwards;
}

.footer a {
    color: #1e80b7; /* Accent Blue for footer links */
    text-decoration: none;
    font-weight: 600;
    margin: 0 15px;
}

/* Animations */
@keyframes fadeIn {
    0% {
        opacity: 0;
    }
    100% {
        opacity: 1;
    }
}

@keyframes fadeInUp {
    0% {
        opacity: 0;
        transform: translateY(30px);
    }
    100% {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes slideInLeft {
    0% {
        transform: translateX(-100%);
    }
    100% {
        transform: translateX(0);
    }
}

@keyframes parallax {
    0% {
        background-position: center center;
    }
    100% {
        background-position: center 100%;
    }
}

/* Media queries for responsiveness */
@media (max-width: 768px) {
    .hero h1 {
        font-size: 2.5rem;
    }

    .hero p {
        font-size: 1rem;
    }

    .jumbotron h1 {
        font-size: 2.5rem;
    }

    .card {
        padding: 25px;
    }

    .form-control {
        font-size: 0.9rem;
    }
}


    </style>
</head>
<body>

    <!-- Hero Section -->
    <section id="hero" class="hero text-center">
        <div class="container">
            <h1>Welcome to the <br><span style="color: #1a304f;">Computer Science Department</span></h1>
            <p>Quickly access your administrative documents and stay informed about the latest news.</p>
            <button herf="index.html" class="cta-btn" data-bs-toggle="modal" data-bs-target="#infoModal">Discover</button>
        </div>
    </section>

    <!-- Jumbotron Section -->
    <section id="form-section" class="jumbotron">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 text-center text-lg-start">
                    <h1 class="my-5">Access Your Administrative Documents</h1>
                    <p>Certificate of enrollment, transcript, and much more at your fingertips.</p>
                </div>

                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <form method="post" action="../../Controler/admin.php">

                                <!-- Matricule input -->
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form3Example3">username</label>
                                    <input type="text" id="form3Example3" name="username" class="form-control" required />
                                </div>

                                <!-- Password input -->
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form3Example4">Password</label>
                                    <input type="password" id="form3Example4" name="password" class="form-control" required />
                                </div>

                                <!-- Submit button -->
                                <button type="submit" style="background-color: #1e80b7; border-color:#1e80b7" name="loginA" class="btn btn-primary btn-block mb-4">Log in</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal for Additional Info -->
    <div class="modal fade" id="infoModal" tabindex="-1" aria-labelledby="infoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="infoModalLabel">Learn More</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>The Computer Science Department of the University of M'hamed Bougara in Boumerdès offers a wide range of services for students, from administrative documents to information on current events.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Section -->
    <section id="footer" class="footer">
        <div class="container">
            <p>&copy; 2024 University of M'hamed Bougara </p>
        </div>
    </section>

    <!-- Bootstrap JS & Popper -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybI6N4w7d0hghP0Xggcxj8eP6Qql4gZwGKXzRmPDiA+Nm5P4pm" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-pzjw8f+ua7Kw1TIq0pM6P4Afxxmjfwg0v5ZZy96wC1J5g9pgswYeO77Xyb9ScjIZ" crossorigin="anonymous"></script>

</body>
</html>
