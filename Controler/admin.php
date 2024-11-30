<?php

include("../model/class.php");
$admin=new Scolarite();

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['loginA'])){
    $username=$_POST['username'];
    $password=$_POST['password'];

        if($admin->loginA($username,$password)){
            $adm=$admin->loginA($username,$password);
            $id=$adm['id'];
            header('location:../view/admin/test.php?id='.$id);
            exit;
        }else{
            header('location:../view/admin/adminLogin.php');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['Confirmer'])) {
            $status = $_POST['status'];
            $id =$_POST['id'];
            $admin->status($status,$id);
            $adminId = $_POST['adminId'] ;
            header('location:../view/admin/test.php?adminId='.$adminId);
        }
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['Confirmer'])) {
    $id = $_POST['id'];  // Get the student ID from the form
    $status = $_POST['status'];  // Get the new status from the form

    // Update the status in the database
    $adm->status($status, $id);
    
    // --- Add this part here ---
    $email = $_POST['email'];  // Assuming the email is submitted via the form
    echo "<script>
        var status = '" . addslashes($status) . "';
        var studentEmail = '" . addslashes($email) . "';
        var studentName = '" . addslashes($_POST['nom']) . "'; // Assuming 'nom' is submitted
        sendEmail(status, studentEmail, studentName);
    </script>";
}
 
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['Envoyer']) ) {
    $matricule = $_POST['matricule'];
    $nom=$_POST['nom'];
    $prenom=$_POST['prenom'];
    $email=$_POST['email'];
    $groupe=$_POST['groupe'];
    $niveau=$_POST['niveau'];
    $specialites=$_POST['specialites'];
    $annee_scolaire=$_POST['annee_scolaire'];
    $password=$_POST['password'];
    
    
    $admin->addStudent($matricule,$nom,$prenom,$email,$groupe,$niveau,$specialites,$annee_scolaire,$password);
   
    

}





