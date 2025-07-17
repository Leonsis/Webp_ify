<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Webp_ify</title>
        <link rel="stylesheet" href="src/css/style.css">
    </head>
    <body>
        <main>
            <div class="bloco">
                <div>
                    <h1>Webp_ify</h1>
                    <form id="downloadForm" action="src/php/copia_img.php" method="post">
                        <label for="url">URL:</label>
                        <input type="text" id="url" name="url" placeholder="URL do site" required>
                        <input type="submit" value="Submit" id="button">
                    </form>
                    <?php
                        if (!empty($_SESSION['flash'])) {
                            echo "<div class='alert alert-success'>" . htmlspecialchars($_SESSION['flash']) . "</div>";
                            //unset($_SESSION['flash']);
                        }
                    ?>
                    <div id="progressContainer">
                        <div id="progressBar" >0%</div>
                    </div>
                    <div id="status"></div>
                    <div class="info">
                        <h2>O que é?</h2>
                        <p>
                            Um programa que facilita o download de todas as imagens de um site a partir da URL fornecida.  
                            Basta inserir o endereço e as imagens serão salvas automaticamente na pasta <strong>imagens</strong> do seu projeto.
                        </p>
                    </div>
                </div>
            </div>
        </main>
        <script src="src/js/barra.js"></script>
    </body>
</html>