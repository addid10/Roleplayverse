<?php session_start() ?>
<?php if (isset($_SESSION['usernameAdmin'])): ?>
<?php header('location: home');?>
<?php else: ?>
<?php header('location: users/login'); ?>
<?php endif; ?>