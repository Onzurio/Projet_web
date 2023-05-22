<?php
session_start();
// Vérifier si l'id de l'utilisateur est disponible dans la session
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    // Utiliser l'id de l'utilisateur comme nécessaire
    echo "<p>L'id de l'utilisateur est : " . $user_id;
    echo "</p>";
} else {
    // L'id de l'utilisateur n'est pas disponible dans la session
    echo "L'utilisateur n'est pas connecté.";
}


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


if (isset($_POST['submit'])) {
    // 2. Récupérer l'ID de l'utilisateur connecté
    // Supposons que vous ayez déjà l'ID de l'utilisateur disponible dans une variable $idUtilisateur
    $idUtilisateur = $_SESSION['user_id']; // Exemple avec une variable de session

    // 3. Récupérer les valeurs des autres champs du formulaire
    $titre = $_POST['titre'];
    $prix = $_POST['prix'];
    $description = $_POST['description'];
    $duree = $_POST['duree'];
    $image = $_FILES['image'];

    // 4. Valider et nettoyer les données si nécessaire
    // Vous pouvez ajouter des vérifications supplémentaires ici en fonction de vos besoins

    // 5. Récupérer l'ID d'annonce le plus élevé et l'incrémenter de 1
    $queryMaxId = "SELECT MAX(id) AS maxId FROM annonces";
    $resultMaxId = mysqli_query($conn, $queryMaxId);
    $rowMaxId = mysqli_fetch_assoc($resultMaxId);
    $nouvelIdAnnonce = $rowMaxId['maxId'] + 1;
    $escapedImageData = null;

    if(isset($image)) {
        /*if ($image['error'] === UPLOAD_ERR_OK) {
            // Retrieve the temporary file path
            $tmpImagePath = $image['tmp_name'];
    
            // Read the image data
            $imageData = file_get_contents($tmpImagePath);
    
            // Escape special characters in the image data
            $escapedImageData = $conn->real_escape_string($imageData);
        }*/
        // Permet de renonner l'image
        $time = time();
        $image_name = $time . $image['name'];
        $image_tmp_name = $image['tmp_name'];
        $image_destination_path = "../ressources/image/" . $image_name;

        // Make sure file is an image
        $allowed_files = ['png', 'jpg', 'jpeg', 'gif'];
        $extension = explode('.', $image_name);
        $extension = end($extension);
        if (in_array($extension, $allowed_files)) {
            // Make sure image is not too big. (2mb+)
            move_uploaded_file($image_tmp_name, $image_destination_path);
        }

    }
    

    // 6. Exécuter une requête SQL pour insérer les données dans la base de données avec le nouvel ID
    // Insérer les données de l'annonce
    $query = "INSERT INTO annonces (id, idAuthor, name, price, description, maxDuration,image) VALUES ('$nouvelIdAnnonce', '$idUtilisateur', '$titre', '$prix', '$description', '$duree', '$image_name')";
    if ($conn->query($query) === TRUE) {


        // Récupérer l'ID de l'annonce créée
        $idAnnonce = $conn->insert_id;

        // Insérer les liens entre les tags sélectionnés et l'annonce
        if (isset($_POST['tags'])) {
            $selectedTags = $_POST['tags'];

            // Récupérer le plus grand ID de lien existant
            $queryMaxLinkId = "SELECT MAX(id) AS maxLinkId FROM tag_annonces";
            $resultMaxLinkId = mysqli_query($conn, $queryMaxLinkId);
            $rowMaxLinkId = mysqli_fetch_assoc($resultMaxLinkId);
            $nouvelIdLien = $rowMaxLinkId['maxLinkId'];
            $nouvelIdLien++;

            // Insérer les liens pour chaque tag sélectionné
            foreach ($selectedTags as $tag) {
                $queryLinkTag = "INSERT INTO tag_annonces (id, idTag, idAnnonce) VALUES ('$nouvelIdLien', '$tag', '$idAnnonce')";
                if ($conn->query($queryLinkTag) === TRUE) {
                    $nouvelIdLien++; // Incrémenter l'ID de lien pour le prochain lien à insérer
                } else {
                    echo "Erreur lors de l'ajout du lien avec le tag : " . $conn->error;
                }
            }
        }

        echo "Ajout réussi !";
        // Rediriger vers une page de confirmation ou une autre action si nécessaire
        exit();
    } else {
        echo "Erreur lors de l'insertion de l'annonce : " . $conn->error;
}
}




// Fermer la connexion à la base de données
mysqli_close($conn);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Création d'une annonce</title>
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
   
    <h1>Création d'une annonce</h1>
    <form method="POST" action="" enctype="multipart/form-data">
        <label for="titre">Titre de l'annonce :</label>
        <input type="text" name="titre" required><br>

        <label for="prix">Prix (jounalier) :</label>
        <input type="number" name="prix" step="0.01" required><br>

        <label>Tags :</label><br>
        <?php
            // 1. Établir une connexion à la base de données (assumant que vous avez déjà une connexion établie)
            $conn = mysqli_connect('localhost', 'root', '', 'rsl_data');

            // Vérifier la connexion
            if (mysqli_connect_errno()) {
                echo "Échec de la connexion à la base de données: " . mysqli_connect_error();
                exit();
            }

            // 2. Exécuter une requête SQL pour récupérer les tags depuis la base de données
            $query = "SELECT id, name FROM tags";
            $result = mysqli_query($conn, $query);

            // 3. Parcourir les résultats et afficher les tags
            while ($row = mysqli_fetch_assoc($result)) {
                $tagId = $row['id'];
                $tagName = $row['name'];
                echo "<input type='checkbox' name='tags[]' value='$tagId'>";
                echo "<label for='$tagId'>$tagName</label><br>";
            }

            // Fermer la connexion à la base de données
            mysqli_close($conn);
        ?>


        <label for="description">Description :</label>
        <textarea name="description" required></textarea><br>

        <label for="image">Image :</label>
        <input type="file" name="image"><br>

        <label for="duree">Durée maximale (en jours, maximum 365) :</label>
        <input type="number" name="duree" min="1" max="365" required><br>

        <input type="submit" name="submit" value="Créer l'annonce">
    </form>
</body>
</html>
