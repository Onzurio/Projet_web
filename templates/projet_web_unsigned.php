<?php
session_start();
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
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
                align-items: center;
            }

            .rental {
                margin: 20px;
                width: 300px;
                height: 400px;
                background-color: #8A00B6;
                box-shadow: 2px 2px 0px #D50000, 5px 5px 0px #8A00B6;
                transition: all 0.2s ease-in-out;
                position: relative;
                overflow: hidden;
                border-radius: 5px;
            }

            .rental:hover {
                transform: translate(5px, 5px);
                box-shadow: none;
                background-color: #6D4C41;
                color: #8A00B6;
            }

            .rental img {
                width: 100%;
                height: 70%;
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
                cursor: pointer;
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
        <main>
            <h2>Welcome to Rent Shadow Legends</h2>
            <p>We are the premier rental service for robots, vehicles and equipment. We've got you covered for anything.</p>
            <section class="rentals">
                <article class="rental">
                    <img src="https://via.placeholder.com/300x200" alt="Eva Unit-01">
                    <h3>Eva Unit-01</h3>
                    <p>The iconic purple and green mech piloted by Shinji Ikari.</p>
                    <a class="rent-btn" href="projet_web_login.php">Rent now</a>
                </article>
                
                
                
                <article class="rental">
                    <img src="https://via.placeholder.com/300x200" alt="Eva Unit-02">
                    <h3>Eva Unit-02</h3>
                    <p>The red and white mech piloted by Asuka Langley.</p>
                    <a class="rent-btn" href="projet_web_login.php">Rent now</a>
                </article>
                <article class="rental">
                    <img src="https://via.placeholder.com/300x200" alt="Eva Unit-00">
                    <h3>Eva Unit-00</h3>
                    <p>The blue and white mech piloted by Rei Ayanami.</p>
                    <a class="rent-btn" href="projet_web_login.php">Rent now</a>
                </article>
                <article class="rental">
                    <img src="https://via.placeholder.com/300x200" alt="S-Type Equipment">
                    <h3>S-Type Equipment</h3>
                    <p>Specialized equipment used by the Evangelion pilots.</p>
                    <a class="rent-btn" href="projet_web_login.php">Rent now</a>
                </article>
                    <article class="rental">
                    <img src="https://via.placeholder.com/300x200" alt="Entry Plug">
                    <h3>Entry Plug</h3>
                    <p>The cockpit module for the Evangelion mechs.</p>
                    <a class="rent-btn" href="projet_web_login.php">Rent now</a>
                </article>
                    <article class="rental">
                    <img src="https://static.wikia.nocookie.net/evangelion/images/0/09/SCREEN_05_C292a.png/revision/latest/scale-to-width-down/350?cb=20160404201620&path-prefix=fr" alt="Angel">
                    <h3>Angel</h3>
                    <p>Play the role of the enemy and pilot an Angel.</p>
                    <a class="rent-btn"  href="projet_web_login.php">Rent now</a>
                </article>
            </section>
        </main>
        <footer>
            <p>© Rent Shadow Legends 2023</p>
        </footer>
        <script>
            //script goes here

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