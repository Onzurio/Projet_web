<?php
session_start();

// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "rsl_data";

$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Vérifier si le formulaire d'inscription a été soumis
if (isset($_POST['submit'])) {
    $pseudo = $_POST['pseudo'];
    $motDePasse = $_POST['motDePasse'];

    // Vérifier si le pseudo existe déjà dans la base de données
    $query = "SELECT * FROM users WHERE username = '$pseudo'";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        echo "Ce pseudo est déjà utilisé. Veuillez choisir un autre pseudo.";
    } else {
        // Insérer le nouvel utilisateur dans la base de données
        $query = "INSERT INTO users (username, password) VALUES ('$pseudo', '$motDePasse')";
        if ($conn->query($query) === TRUE) {
            echo "Inscription réussie !";
            header("Location: projet_web_login.php");
            exit(); // Assurez-vous d'inclure exit() après la redirection pour arrêter l'exécution du script.
        } else {
            echo "Erreur lors de l'inscription : " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Page d'inscription</title>
</head>
<body>
    <h1>Inscription</h1>
    <form method="POST" action="">
        <label for="pseudo">Pseudo :</label>
        <input type="text" name="pseudo" required><br>

        <label for="motDePasse">Mot de passe :</label>
        <input type="password" name="motDePasse" required><br>

        <input type="submit" name="submit" value="S'inscrire">
    </form>
    <p>Dèja un compte ?: <a href="projet_web_login.php">Log in</a></p>

</body>
</html>