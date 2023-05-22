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

// Vérifier si le formulaire de connexion a été soumis
if (isset($_POST['submit'])) {
    $pseudo = $_POST['pseudo'];
    $motDePasse = $_POST['motDePasse'];

    // Vérifier les informations d'identification dans la base de données
    $query = "SELECT * FROM users WHERE username = '$pseudo' AND password = '$motDePasse'";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['user_id'] = $row['id'];
        // Redirection vers une autre page
        header("Location: projet_web_signed.php");
        exit(); // Assurez-vous d'inclure exit() après la redirection pour arrêter l'exécution du script.
    } else {
        echo "Identifiants incorrects. Veuillez réessayer.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Page de connexion</title>
    <style>
        body {
            font-family: 'Helvetica Neue', sans-serif;
            background-color: #141414;
            color: #FFF;
        }

        header {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            background-color: #FEFEFE;
            box-shadow: 0px 5px 15px rgba(0,0,0,0.1);
        }

        .logo {
            font-family: 'Impact', sans-serif;
            font-size: 40px;
            color: #141414;
            text-shadow: 2px 2px 0px #FFF, 5px 5px 0px #D50000, 7px 7px 0px #8A00B6, 10px 10px 0px #6D4C41;
            cursor: pointer;
        }

        nav ul {
            display: flex;
            flex-direction: row;
            list-style: none;
        }

        nav ul li {
            margin: 0 10px;
        }

        nav ul li a {
            color: #FFF;
            text-decoration: none;
            padding: 10px;
            border-radius: 5px;
            background-color: #8A00B6;
            box-shadow: 2px 2px 0px #D50000, 5px 5px 0px #8A00B6;
            transition: all 0.2s ease-in-out;
        }

        nav ul li a:hover {
            transform: translate(5px, 5px);
            box-shadow: none;
            color: #8A00B6;
            background-color: #FFF;
        }

        .container {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 100vh;
    }
    form, p {
        text-align: center;
    }


    </style>
</head>
<body>
    <header>
        <h1 class="logo">Rent Shadow Legends</h1>
        <nav>
            <ul>
                <li>
                    <a href="projet_web_unsigned.php">Home</a>
                </li>
                <li>
                    <a href="projet_web_login.php">Log in</a>
                </li>
                <li>
                    <a href="projet_web_signup.php">Sign up</a>
                </li>
            </ul>
        </nav>
    </header>
   
    <div class="container">
    <h1>Connexion</h1>
        <form method="POST" action="">
            <label for="pseudo">Pseudo :</label>
            <input type="text" name="pseudo" required><br>

            <label for="motDePasse">Mot de passe :</label>
            <input type="password" name="motDePasse" required><br>

            <input type="submit" name="submit" value="Se connecter">
        </form>
    </div>
    <p>Pas de compte ?: <a href="projet_web_signup.php">Sign up</a></p>
</body>
</html>