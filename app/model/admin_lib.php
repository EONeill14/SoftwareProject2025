<?php

function is_valid_admin_login($email,$password){
    global $db;
    $password = sha1($email . $password);


$query='SELECT*FROM admins WHERE adminemail=:email aAND adminpw = :password';

$statement = $db->prepare($query);
$statement->bindValue(':email', '$email');
$statement->bindValue(':password', $password);
$statement->execute();

$valid = ($statement->rowCount() == 1);
$statement->closeCursor();
return $valid;
}

function get_admin_by_email($email) {
    global $db;
    $query = 'SELECT * FROM admins WHERE adminemail = :email';
    $statement = $db->prepare($query);
    $statement->bindValue(':email',$email);
    $statement->execute();
    $admin = $statement->fetch();
    $statement->closeCursor();
    return $admin;
}