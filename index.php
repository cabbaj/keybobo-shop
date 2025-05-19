<?php
require "db.php";

session_start();

$authenticated = false;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keybobo Shop</title>
    <link rel="icon" href="/img/logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
</head>

<body>
    <!-- NAVBAR -->
    <?php include "components/header.php"; ?>

    <!-- CONTENT -->
    <div style="background-color: #0f172a">
        <div class="container text-white py-5">
            <div class="row align-items-center g-5">
                <div class="col md-6">
                    <h1 class="mb-5 display-2"><strong>Keybobo Shop of Keyboard</strong></h1>
                    <p>
                        The best keyboard shop in the world.
                    </p>
                </div>
                <div class="col-md-6 text-center">
                    <img class="img-fluid" src="img/keyboard.png" alt="keyboard">
                </div>

            </div>
        </div>
    </div>

    <!-- FOOTER -->
    <?php include "components/footer.php" ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>

</body>

</html>