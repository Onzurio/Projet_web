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
?>


<!DOCTYPE html>
<html>
    <head>
	    <meta charset="utf-8">
	    <title>Rent Shadow Legends</title>
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

            main {
                padding: 50px 20px;
            }

            h2 {
                font-size: 32px;
                margin-bottom: 20px;
                text-align: center;
                text-shadow: 2px 2px 0px #D50000, 5px 5px 0px #8A00B6, 7px 7px 0px #6D4C41;
            }

            p {
                font-size: 18px;
                line-height: 1.5;
                margin-bottom: 20px;
                text-align: justify;
                text-shadow: 2px 2px 0px #D50000, 5px 5px 0px #8A00B6, 7px 7px 0px #6D4C41;
            }

            ul {
                margin-bottom: 20px;
                list-style: none;
                padding-left: 0;
            }

            li {
                font-size: 18px;
                line-height: 1.5;
                margin-bottom: 10px;
                text-align: justify;
                text-shadow: 2px 2px 0px #FFF, 5px 5px 0px #D50000, 7px 7px 0px #8A00B6,
            }

    

            .rentals {
                display: block;
                flex-wrap: wrap;
                justify-content: center;
                align-items: center;
            }

            .rental {
                margin: 20px;
                width: 85%;
                height: 300px;
                background-color: #8A00B6;
                box-shadow: 2px 2px 0px #D50000, 5px 5px 0px #8A00B6;
                transition: all 0.2s ease-in-out;
                position: relative;
                overflow: hidden;
                border-radius: 5px;
                display: flex;
                flex-direction: row;
                align-items: center;
                margin-bottom: 2rem;
            }

            .rental:hover {
                transform: translate(5px, 5px);
                box-shadow: none;
                background-color: #6D4C41;
                color: #8A00B6;
            }

            .rental img {
                width: 30%;
                height: 100%;
                object-fit: cover;
                object-position: center;
            }

            .rental h3 {
                font-size: 24px;
                margin-top: 10px;
                margin-bottom: 5px;
                color: #FFF;
                text-align: center;
                text-shadow: 2px 2px 0px #D50000, 5px 5px 0px #8A00B6, 7px 7px 0px #6D4C41;
            }

            .rental p {
                font-size: 18px;
                margin-bottom: 10px;
                color: #FFF;
                text-align: center;
                text-shadow: 2px 2px 0px #D50000, 5px 5px 0px #8A00B6, 7px 7px 0px #6D4C41;
            }
            .rent-btn {
                display: none;
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                z-index: 1;
                background-color: #8A00B6;
                box-shadow: 2px 2px 0px #D50000, 5px 5px 0px #8A00B6;
                color: white;
                border: none;
                border-radius: 4px;
                padding: 12px 24px;
                font-size: 16px;
                cursor: pointer;
            }

            .rent-btn:hover {
                box-shadow: none;
                background-color: #6D4C41;
                color: #FFF;
                display: block;
            }
                    
           div {

            text-align: justify;
           }







           
        </style>
    </head>
    <body>
        <header>
            <h1 class="logo">Rent Shadow Legends</h1>
            <nav>
            <ul>
                <li>
                    <a href="projet_web_signed.php">Home</a>
                </li>
                <li>
                    <a href="test.php">Rent</a>
                </li>
                <li>
                    <a href="projet_web_unsigned.php">Log out</a>
                </li>
            </ul>
            </nav>
        </header>
        <main>
            <h2>Welcome to Rent Shadow Legends</h2>
            <p>We are the premier rental service for robots, vehicles and equipment. We've got you covered for anything.</p>
            <section class="rentals">
            <?php
                // 1. Établir une connexion à la base de données (assumant que vous avez déjà une connexion établie)
                $conn = mysqli_connect('localhost', 'root', '', 'rsl_data');

                // Vérifier la connexion
                if (mysqli_connect_errno()) {
                    echo "Échec de la connexion à la base de données: " . mysqli_connect_error();
                    exit();
                }

                // 2. Exécuter une requête SQL pour récupérer les annonces depuis la base de données
                $query = "SELECT * FROM annonces";
                $result = mysqli_query($conn, $query);

                // Définir une image par défaut
                $defaultImage = '../ressources/300x200.png';

                // 3. Parcourir les résultats et afficher les annonces
                while ($row = mysqli_fetch_assoc($result)) {
                    $titre = $row['name'];
                    $description = $row['description'];
                    $duree = $row['maxDuration'];
                    $image = isset($row['image']) ? "../ressources/image/" . $row['image'] : $defaultImage;
                    $prix = $row['price'];

                    // Utiliser l'image par défaut si aucune image spécifiée
                    if (empty($image)) {
                        $image = $defaultImage;
                    }

                    // Afficher un article pour chaque annonce
                    echo '<article class="rental">';
                    echo '<img src="' . $image . '" alt="' . $titre . '">';
                    echo '<div>';
                    echo '<h3>' . $titre . '</h3>';
                    echo '<p>' . $description . '</p>';
                    echo '<p>Durée : ' . $duree . '</p>';
                    echo '<p>Prix : ' . $prix . '</p>';
                    echo '</div>';
                    echo '<button class="rent-btn">Rent now</button>';
                    echo '</article>';
                }

                // Fermer la connexion à la base de données
                mysqli_close($conn);
            ?>
                
            </section>
        </main>
        <footer>
            <p>© Rent Shadow Legends 2023</p>
        </footer>
        <script>
             // script goes here

            const rentalArticles = document.querySelectorAll('.rental');

            rentalArticles.forEach((article) => {
            const rentButton = article.querySelector('.rent-btn');

            article.addEventListener('mouseover', () => {
                rentButton.style.display = 'block';
            });

            article.addEventListener('mouseout', () => {
                rentButton.style.display = 'none';
            });
            });
        </script>
    </body>
</html>