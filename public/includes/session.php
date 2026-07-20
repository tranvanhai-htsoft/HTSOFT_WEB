<?php

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

$currentUserId = isset($_SESSION['user_id']) ? (int) $_SESSION['user_id'] : null;
