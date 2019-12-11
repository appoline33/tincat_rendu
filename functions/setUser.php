<?php
// Etape 1 : config database
$DB_HOST = "localhost";
$DB_NAME = "tincat";
$DB_USER = "root";
$DB_PASSWORD = "root";
// Etape 2 : Connexion to database
try {
    $db = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME", $DB_USER, $DB_PASSWORD);
} catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}
var_dump($_POST);
// Avant d'insérer en base de données faire les vérifications suivantes
    // Vérifier si le pseudo ou le mot de passe est vide
if(!empty($_POST['pseudo']) && !empty($_POST['password']) && !empty($_POST['confirm_password'])){
    echo "Le pseudo, le password et le confirm password sont bien remplis" . "<br/>";
}else if(!empty($_POST['pseudo']) || !empty($_POST['password']) || !empty($_POST['confirm_password'])){
    echo "Le pseudo, le password ou le confirm password n'est pas renseigné" . "<br/>";
}else{
    echo "Le pseudo, le password et le confirm password ne sont pas renseignés" . "<br/>";
}

    // Ajouter un input confirm password et vérifier si les deux sont égaux
if ($_POST['password'] !== $_POST['confirm_password']){
    echo "Erreur ! Les deux passwords sont différents" . "<br/>";     
}else{
    echo "Bravo ! Les deux passwords sont identiques" . "<br/>";
}

// Ajouter un champ email
    // Validation d'une adresse e-mail
if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
    echo "L'adresse e-mail est bien renseignée" . "<br/>";
}else{
    echo "L'adresse e-mail est mal renseignée" . "<br/>";
}

// Etape 3 : prepare request
$req = $db->prepare("INSERT INTO users (pseudo, password) VALUES(:pseudo, :password)");
$req->bindParam(":pseudo", $_POST["pseudo"]);
$req->bindParam(":password", $_POST["password"]);
$req->execute();