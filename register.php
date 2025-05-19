<?php
include "components/header.php";

$firstname_error = "";
$lastname_error = "";
$email_error = "";
$phone_error = "";
$address_error = "";
$password_error = "";
$confirm_password_error = "";

try {
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $password = $_POST['password'];
        $comfirm_password = $_POST['confirm_password'];

        if (
            isset($firstname) &&
            ($lastname) &&
            ($email) &&
            ($phone) &&
            ($address) &&
            ($password) &&
            ($comfirm_password)
        ) {
            $stmt = $conn->prepare(
                "INSERT INTO users SET 
                firstname = :firstname, 
                lastname = :lastname,
                email = :email,
                phone = :phone,
                address = :address,
                password = :password"
            );
            $stmt->execute([
                "fistname" => $fistname,
                "lastname" => $lastname,
                "email" => $email,
                "phone" => $phone,
                "address" => $address,
                "password" => $password,
            ]);
        }
    }
} catch (PDOException $e) {
    echo "error" . $e->getMessage();
}
?>

<div class="container py-5">
    <div class="row">
        <div class="col-lg-6 mx-auto border shadow p-4">
            <h2 class="text-center mb-4">Register</h2>
            <hr>
            <form method="post">
                <div class="row mb-3">
                    <label class="col-sm-4 col-form-label" for="firstname">First Name</label>
                    <div class="col-sm-8">
                        <input class="form-control" name="firstname" id="firstname" type="text">
                        <span class="text-danger"></span>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-4 col-form-label" for="lastname">Last Name</label>
                    <div class="col-sm-8">
                        <input class="form-control" name="lastname" id="lastname" type="text">
                        <span class="text-danger"></span>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-4 col-form-label" for="email">Email*</label>
                    <div class="col-sm-8">
                        <input class="form-control" name="email" id="email" type="text">
                        <span class="text-danger"></span>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-4 col-form-label" for="phone">Phone*</label>
                    <div class="col-sm-8">
                        <input class="form-control" name="phone" id="phone" type="text">
                        <span class="text-danger"></span>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-4 col-form-label" for="address">Address</label>
                    <div class="col-sm-8">
                        <input class="form-control" name="address" id="address" type="text">
                        <span class="text-danger"></span>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-4 col-form-label" for="password">Password*</label>
                    <div class="col-sm-8">
                        <input class="form-control" name="password" id="password" type="password">
                        <span class="text-danger"></span>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-4 col-form-label" for="confirm_password">Confirm Password*</label>
                    <div class="col-sm-8">
                        <input class="form-control" name="comfirm_password" id="confirm_password" type="password">
                        <span class="text-danger"></span>
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

<?php
include "components/footer.php";
?>