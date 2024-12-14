<?php

$conn = new PDO('mysql:host=localhost; dbname=db_inventory', 'root', '');
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);