<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Delete Blog</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h1>Delete Blog</h1>

<?php
if (!isset($_GET['id'])) die("Invalid request.");
$id = $_GET['id'];

if (isset($_POST['delete'])) {
    $codename = $_POST['codename'];
    $stmt = $conn->prepare("DELETE FROM blogs WHERE id=? AND codename=?");
    $stmt->bind_param("is", $id, $codename);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "<script>alert('Blog deleted successfully!'); window.location='index.php';</script>";
    } else {
        echo "<p>Wrong codename or deletion failed!</p>";
    }
} else {
    ?>
    <form method="POST" onsubmit="return confirm('Are you sure you want to delete this blog?')">
        <input type="password" name="codename" placeholder="Enter your codename to confirm" required>
        <button type="submit" name="delete">Delete</button>
    </form>
    <?php
}
?>
</body>
</html>
