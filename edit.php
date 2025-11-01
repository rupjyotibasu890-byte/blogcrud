<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Blog</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h1>Edit Blog</h1>

<?php
if (!isset($_GET['id'])) {
    die("Invalid request.");
}

$id = $_GET['id'];

if (isset($_POST['verify'])) {
    $codename = $_POST['codename'];
    $stmt = $conn->prepare("SELECT * FROM blogs WHERE id=? AND codename=?");
    $stmt->bind_param("is", $id, $codename);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows == 1) {
        $blog = $result->fetch_assoc();
        ?>
        <form method="POST">
            <input type="hidden" name="codename" value="<?= htmlspecialchars($codename) ?>">
            <input type="text" name="title" value="<?= htmlspecialchars($blog['title']) ?>" required><br>
            <textarea name="content" required><?= htmlspecialchars($blog['content']) ?></textarea><br>
            <button type="submit" name="update">Update Blog</button>
        </form>
        <?php
    } else {
        echo "<p>Invalid codename!</p>";
    }
} elseif (isset($_POST['update'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $codename = $_POST['codename'];

    $stmt = $conn->prepare("UPDATE blogs SET title=?, content=? WHERE id=? AND codename=?");
    $stmt->bind_param("ssis", $title, $content, $id, $codename);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "<script>alert('Blog updated successfully!'); window.location='index.php';</script>";
    } else {
        echo "<p>Update failed. Wrong codename?</p>";
    }
} else {
    ?>
    <form method="POST">
        <input type="password" name="codename" placeholder="Enter your codename" required>
        <button type="submit" name="verify">Verify</button>
    </form>
    <?php
}
?>
</body>
</html>
