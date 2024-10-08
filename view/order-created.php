<html>
    <head>
        <title>Commande Créée</title>
    </head>
    <body>
        <header>
            <h1>Le Eshop au top</h1>
        </header>

        <main>
            <p>La commande a été créée avec succès</p>

            <form method="POST" action="../controller/set-shipping-address.php">
                <label for="address">Adresse</label>
                <input type="text" id="address" name="address" required>
                <br>
                <label for="city">Ville</label>
                <input type="text" id="city" name="city" required>
                <br>
                <label for="country">Pays</label>
                <input type="text" id="country" name="country" required>
                <br>
                <button type="submit">Ajouter</button>
            </form>
        </main>
    </body>
</html>