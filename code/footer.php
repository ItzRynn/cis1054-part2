<footer>
    <?php if (!isset($_SESSION['username'])): ?>
        <a href="login.php">Admin Login</a>
    <?php else: ?>
        <a href="admin.php">Admin Panel</a>
    <?php endif; ?>
    <p>&copy; 2024 Royal Burgers</p>
</footer>