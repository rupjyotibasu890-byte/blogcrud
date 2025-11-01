<?php include 'db.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Simple Blog System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h1>📝 All Blogs</h1>
<a href="create.php" class="create-btn">+ Create New Blog</a>

<div class="blog-container">
    <?php
    $result = $conn->query("SELECT * FROM blogs ORDER BY created_at DESC");
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='blog-box'>";
            echo "<h2>" . htmlspecialchars($row['title']) . "</h2>";
            echo "<p class='content'>" . nl2br(htmlspecialchars($row['content'])) . "</p>";
            echo "<div class='actions'>
                    <a href='edit.php?id={$row['id']}'>✏️ Edit</a>
                    <a href='delete.php?id={$row['id']}'>🗑️ Delete</a>
                  </div>";
            echo "</div>";
        }
    } else {
        echo "<p>No blogs found. Create one!</p>";
    }
    ?>
</div>

</body>
</html>
