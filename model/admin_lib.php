<?php
function is_valid_admin_login($email, $password) {
    global $db;
    
    // 1. Get the stored hash from the database for the given email
    $query = 'SELECT adminpw FROM admins WHERE adminemail = :email';
    $statement = $db->prepare($query);
    $statement->bindValue(':email', $email);
    $statement->execute();
    $row = $statement->fetch();
    $statement->closeCursor();

    // If no user was found, the login is invalid
    if ($row === false) {
        return false;
    }

    // Get the hash from the database row
    $hash = $row['adminpw'];

    // 2. Use the modern, secure password_verify() function to check the password
    return password_verify($password, $hash);
}

function get_admin_by_email ($email) {
    global $db;
    $query = 'SELECT * FROM admins WHERE adminemail = :email';
    $statement = $db->prepare($query);
    $statement->bindValue(':email', $email);
    $statement->execute();
    $admin = $statement->fetch();
    $statement->closeCursor();
    return $admin;
}

function admin_count() {
    global $db;
    $query = 'SELECT count(*) AS adminCount FROM admins';
    $statement = $db->prepare($query);
    $statement->execute();
    $result = $statement->fetch();
    $statement->closeCursor();
    return $result['adminCount'];
}

function get_all_admins() {
    global $db;
    $query = 'SELECT * FROM admins ORDER BY lName, fName';
    $statement = $db->prepare($query);
    $statement->execute();
    $admins = $statement->fetchAll();
    $statement->closeCursor();
    return $admins;
}

function get_admin ($admin_id) {
    global $db;
    $query = 'SELECT * FROM admins WHERE adminID = :admin_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':admin_id', $admin_id);
    $statement->execute();
    $admin = $statement->fetch();
    $statement->closeCursor();
    return $admin;
}


function is_valid_admin_email($email) {
    global $db;
    $query = '
        SELECT * FROM admins
        WHERE adminemail = :email';
    $statement = $db->prepare($query);
    $statement->bindValue(':email', $email);
    $statement->execute();
    $valid = ($statement->rowCount() == 1);
    $statement->closeCursor();
    return $valid;
}

function add_admin($email, $first_name, $last_name, $password_1, $password_2) {
    global $db;
    // Use the modern, secure password_hash() function
    $password = password_hash($password_1, PASSWORD_DEFAULT);
    $query = '
        INSERT INTO admins (fName, lName, adminemail, adminpw)
        VALUES (:first_name, :last_name, :email, :password)';
    $statement = $db->prepare($query);
    $statement->bindValue(':first_name', $first_name);
    $statement->bindValue(':last_name', $last_name);
    $statement->bindValue(':email', $email);
    $statement->bindValue(':password', $password);
    $statement->execute();
    $admin_id = $db->lastInsertId();
    $statement->closeCursor();
    return $admin_id;
}

function update_admin($admin_id, $email, $first_name, $last_name,
                      $password_1, $password_2) {
    global $db;
    $query = '
        UPDATE admins
        SET adminemail = :email,
            fName = :first_name,
            lName = :last_name
        WHERE adminID = :admin_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':email', $email);
    $statement->bindValue(':first_name', $first_name);
    $statement->bindValue(':last_name', $last_name);
    $statement->bindValue(':admin_id', $admin_id);
    $statement->execute();
    $statement->closeCursor();

    if (!empty($password_1) && !empty ($password_2)) {
        if ($password_1 !== $password_2) {
            display_error('Passwords do not match.');
        } elseif (strlen($password_1) < 6) {
            display_error('Password must be at least six characters.');
        }
        // Use the modern, secure password_hash() function
        $password = password_hash($password_1, PASSWORD_DEFAULT);
        $query = '
            UPDATE admins
            SET adminpw = :password
            WHERE adminID = :admin_id';
        $statement = $db->prepare($query);
        $statement->bindValue(':password', $password);
        $statement->bindValue(':admin_id', $admin_id);
        $statement->execute();
        $statement->closeCursor();
    }
}

function delete_admin($admin_id) {
    global $db;
    $query = 'DELETE FROM admins WHERE adminID = :admin_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':admin_id', $admin_id);
    $statement->execute();
    $statement->closeCursor();
}
?>
