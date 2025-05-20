<?php

require "components/header.php";

// prevent search register.php on url while in session
if (isset($_SESSION["email"])) {
    header("location: index.php");
    exit;
}

$firstname_error = "";
$lastname_error = "";
$email_error = "";
$phone_error = "";
$password_error = "";
$confirm_password_error = "";

$error = false;

try {
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

        /* validation */
        if (empty($firstname)) {
            $firstname_error = "First name is required.";
            $error = true;
        }
        if (empty($lastname)) {
            $lastname_error = "Last name is required.";
            $error = true;
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $email_error = "Email is invalid.";
            $error = true;
        } else {
            $stmt = $conn->prepare("SELECT 1 FROM users WHERE email = :email");
            $stmt->execute(["email" => $email]);

            // check if it have email in database already
            if ($stmt->fetchColumn()) {
                $email_error = "This Email is already used";
                $error = true;
            }
        }
        if (!preg_match('/^[0-9]{10,15}$/', $phone)) {
            $phone_error = "Phone number is invalid.";
            $error = true;
        }
        if (strlen($password) < 6) {
            $password_error = "Password must have at least 6 characters.";
            $error = true;
        }
        if ($confirm_password != $password) {
            $confirm_password_error = "Password is not match.";
            $error = true;
        }

        /* insert to db */
        if (!$error) {
            // password hashing
            $password = password_hash($password, PASSWORD_DEFAULT);

            // insert to db
            $stmt = $conn->prepare(
                "INSERT INTO users (
                    firstname, lastname, email, phone, address, password
                ) VALUES (
                    :firstname, :lastname, :email, :phone, :address, :password
                )"
            );
            $stmt->execute([
                "firstname" => $firstname,
                "lastname" => $lastname,
                "email" => $email,
                "phone" => $phone,
                "address" => $address,
                "password" => $password,
            ]);

            // store the id after insert (auto-increment)
            $insert_id = $conn->lastInsertId();

            // create session
            $_SESSION["id"] = $insert_id;
            $_SESSION["email"] = $email;

            header("location: index.php");
            exit;
        }
    }
} catch (PDOException $e) {
    echo "databse error: " . $e->getMessage();
}
?>

<div class="container py-5">
    <div class="row">
        <div class="col-lg-6 mx-auto border shadow p-4">
            <h2 class="text-center mb-4">Register</h2>
            <hr>
            <form method="post">
                <div class="row mb-3">
                    <label class="col-sm-4 col-form-label" for="firstname">First Name*</label>
                    <div class="col-sm-8">
                        <input class="form-control" name="firstname" id="firstname" type="text">
                        <span class="text-danger"><?php echo $firstname_error; ?></span>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-4 col-form-label" for="lastname">Last Name*</label>
                    <div class="col-sm-8">
                        <input class="form-control" name="lastname" id="lastname" type="text">
                        <span class="text-danger"><?php echo $lastname_error; ?></span>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-4 col-form-label" for="email">Email*</label>
                    <div class="col-sm-8">
                        <input class="form-control" name="email" id="email" type="text">
                        <span class="text-danger"><?php echo $email_error; ?></span>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-4 col-form-label" for="phone">Phone*</label>
                    <div class="col-sm-8">
                        <input class="form-control" name="phone" id="phone" type="text">
                        <span class="text-danger"><?php echo $phone_error; ?></span>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-4 col-form-label" for="address">Address</label>
                    <div class="col-sm-8">
                        <input class="form-control" name="address" id="address" type="text">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-4 col-form-label" for="password">Password*</label>
                    <div class="col-sm-8">
                        <input class="form-control" name="password" id="password" type="password">
                        <span class="text-danger"><?php echo $password_error; ?></span>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-4 col-form-label" for="confirm_password">Confirm Password*</label>
                    <div class="col-sm-8">
                        <input class="form-control" name="confirm_password" id="confirm_password" type="password">
                        <span class="text-danger"><?php echo $confirm_password_error; ?></span>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="offset-sm-4 col-sm-4 d-grid">
                        <button class="btn btn-primary" type="submit">Register</button>
                    </div>
                    <div class="col-sm-4 d-grid">
                        <a class="btn btn-outline-primary" href="index.php">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require "components/footer.php"; ?>