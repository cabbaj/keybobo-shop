<?php
require "components/header.php";

// prevent search on url
if (empty($_SESSION["email"])) {
    header("location: index.php");
    exit;
}

if ($_SESSION['id']) {
    $id = $_SESSION["id"];

    $stmt = $conn->prepare("SELECT * FROM users WHERE id = :id");
    $stmt->execute([
        "id" => $id
    ]);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<div class="container py-5">
    <div class="row">
        <div class="col-lg-6 mx-auto border shadow p-4">
            <h2 class="text-center mb-4">Profile</h2>
            <hr>
            <div class="row mb-3">
                <div class="col-sm-4">First Name</div>
                <div class="col-sm-8"><?php echo $user["firstname"]; ?></div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-4">Last Name</div>
                <div class="col-sm-8"><?php echo $user["lastname"]; ?></div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-4">Email</div>
                <div class="col-sm-8"><?php echo $user["email"]; ?></div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-4">Phone</div>
                <div class="col-sm-8"><?php echo $user["phone"]; ?></div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-4">Address</div>
                <div class="col-sm-8"><?php echo $user["address"]; ?></div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-4">Registerd At</div>
                <div class="col-sm-8"><?php echo $user["created_at"]; ?></div>
            </div>
        </div>
    </div>
</div>

<?php require "components/footer.php"; ?>