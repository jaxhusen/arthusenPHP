<?php

require_once __DIR__ . "/../classes/Template.php";
require_once __DIR__ . "/../classes/UsersDatabase.php";

$is_logged_in = isset($_SESSION["user"]);
$logged_in_user = $is_logged_in ? $_SESSION["user"] : null;
$is_admin = $is_logged_in && $logged_in_user->role == "admin";

if (!$is_admin) {
    http_response_code(401);
    die("Access denied");
}

if (!isset($_GET["username"])) {
    die("Invalid input");
} 

$users_db = new UsersDatabase();

$user = $users_db->get_one_by_username($_GET["username"]);

Template::header("Update user");

if ($user == null) : ?>

    <h2>No user</h2>

<?php else : ?>

    <form action="/arthusen/admin-scripts/post-update-user.php?id=<?= $_GET["id"] ?>" method="post" enctype="multipart/form-data">
        <input type="text" name="username" placeholder="Username" value="<?= $user->username ?>"> <br>
        <input type="text" name="role" placeholder="role" value="<?= $user->role ?>"> <br>
        <input type="submit" value="Save">
    </form>

    <p><b>Delete:</b></p>

    <form action="/arthusen/admin-scripts/post-delete-user.php" method="post">
        <input type="hidden" name="username" value="<?= $_GET["username"] ?>">
        <input type="submit" value="Delete user">
    </form>


<?php

endif;

Template::footer();