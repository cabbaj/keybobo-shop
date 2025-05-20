<?php
require "components/header.php";

// prevent search in url
if (isset($_SESSION["email"])) {
    header("location: index.php");
    exit;
}

/* LOGIN */
$errorMsg = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    if (empty($email) || empty($password)) {
        $errorMsg = "Email and Password are required!";
    } else {
        $stmt = $conn->prepare("SELECT id, email, password FROM users WHERE email = :email");
        $stmt->execute([
            "email" => $email
        ]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!empty($user)) {
            // bind variables
            $id = $user["id"];
            $email = $user["email"];
            $hash_password = $user["password"];

            // check password in db is match
            if (password_verify($password, $hash_password)) {
                // create session
                $_SESSION["id"] = $id;
                $_SESSION["email"] = $email;

                header("location: index.php");
                exit;
            }
        }
        
        $errorMsg = "Email or Password invalid!";
    }
}
?>

<div class="container py-5">
    <div class="mx-auto border shadow p-4" style="width: 400px">
        <h2 class="text-center mb-4">Login</h2>
        <hr>
        <?php if (!empty($errorMsg)): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong><?php echo $errorMsg; ?></strong>
                <button class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        <form method="post">
            <div class="mb-3">
                <label class="form-label" for="email">Email</label>
                <input class="form-control" name="email" id="email" type="text">
            </div>
            <div class="mb-3">
                <label class="form-label" for="password">Password</label>
                <input class="form-control" name="password" id="password" type="password">
            </div>
            <div class="row mb-3">
                <div class="col d-grid">
                    <button class="btn btn-primary" type="submit">Login</button>
                </div>
                <div class="col d-grid">
                    <a class="btn btn-outline-primary" href="index.php">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>

<?php require "components/footer.php"; ?>