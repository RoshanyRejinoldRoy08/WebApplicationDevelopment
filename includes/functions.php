<?php
if (session_status() !== PHP_SESSION_ACTIVE) session_start();
if (!isset($_SESSION['cart']) || !is_array($_SESSION['cart'])) $_SESSION['cart'] = [];
function e($v){ return htmlspecialchars((string)$v, ENT_QUOTES, 'UTF-8'); }
function cart_count(){ $n=0; foreach($_SESSION['cart'] as $i) $n+=(int)$i['quantity']; return $n; }
function cart_total(){ $n=0; foreach($_SESSION['cart'] as $i) $n+=(float)$i['price']*(int)$i['quantity']; return $n; }
