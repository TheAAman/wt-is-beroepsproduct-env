<?php 
//Inloggen Passagier functies
//1. functie voor checken gebruikersnaam en wachtwoord in database
function checkUser ($username, $password){ 
    $db = maakVerbinding(); 
    
    $sql = 'SELECT * From Passagier WHERE naam = :username;'; 
    $stmt = $db->prepare($sql);
    $stmt->bindParam(":username", $username);
    $stmt->execute();
  
    $rij = $stmt->fetch(PDO::FETCH_ASSOC); 
  
    if ($rij) { 
      $stored_password = $rij['wachtwoord'];
     
    // if (password_verify($password, $stored_password)) {
    if ($password === $stored_password){
          return true; 
        }
    }
    return false; 
}

//2. functie voor inloggen passagier
function inloggenP() {
    if (isset($_POST['loginP'])) { 
        $username = $_POST['username']; 
        $password = $_POST['password']; 

        if (checkUser($username, $password)) {
            $_SESSION['username'] = $username;
            header('Location: homep.php'); 
            exit();
        } else {
            echo "Invalid username or password"; 
        }
    }
}

//Inloggen Medewerker functies
//1. functie voor checken balienummer en wachtwoord in database
function checkBalie ($balienummer, $password){ 
    $db = maakVerbinding(); 
    
    $sql = 'SELECT * From Balie WHERE balienummer = :balienummer;'; 
    $stmt = $db->prepare($sql);
    $stmt->bindParam(":balienummer", $balienummer);
    $stmt->execute();
  
    $rij = $stmt->fetch(PDO::FETCH_ASSOC); 
  
    if ($rij) { 
      $stored_password = $rij['wachtwoord'];
     
    // if (password_verify($password, $stored_password)) {
    if ($password === $stored_password){
          return true; 
        }
    }
    return false; 
}

//2. functie voor inloggen passagier
function inloggenM() {
    if (isset($_POST['loginM'])) { 
        $balienummer = $_POST['balienummer']; 
        $password = $_POST['password']; 

        if (checkBalie($balienummer, $password)) {
            $_SESSION['balienummer'] = $balienummer;
            header('Location: incheckenM.php'); 
            exit();
        } else {
            echo "Invalid balienummer or password"; 
        }
    }
}