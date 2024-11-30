<?php
include("../model/class.php");
$student=new Scolarite();
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['loginS'])){
    $matricule=$_POST['matricule'];
    $password=$_POST['password'];
        if($student->loginS($matricule,$password)){
            $std=$student->loginS($matricule,$password);
            $matricule=$std['matricule'];
            header('location:../view/student/Student.php?matricule='.$matricule);
            exit;
        }else{
            header('location:../view/student/index.php');
            exit;
        }
    }

      
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['Envoyer']) ) {
          $matricule = $_POST['matricule'];
          $type_doc=$_POST['type_doc'];
          if(!is_numeric($matricule) ):
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            Failed to add Demande,Invalidate matricule!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
    
          else:
            $student->addDemande($matricule,$type_doc);
          endif;
          

        }
        

        
 

            
