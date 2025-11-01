<?php include 'db.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Create Blog</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h1>Create New Blog</h1>
<form method="POST">
    <input type="text" name="title" placeholder="Blog Title" required><br>
    <textarea name="content" placeholder="Write your blog..." required></textarea><br>
    <input type="password" name="codename" placeholder="Your secret codename" required><br>
    <button type="submit" name="submit">Create Blog</button>
</form>

<?php
if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $codename = $_POST['codename'];

    $stmt = $conn->prepare("INSERT INTO blogs (title, content, codename) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $title, $content, $codename);

    if ($stmt->execute()) {
        echo "<script>alert('Blog created successfully!'); window.location='index.php';</script>";
    } else {
        echo "<p>Error creating blog!</p>";
    }
}
?>
</body>
</html>
