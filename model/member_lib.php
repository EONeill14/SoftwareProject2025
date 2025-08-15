<?php

/**
 * Checks if a member's email already exists in the database.
 * @param string $email The email to check.
 * @return bool True if the email is in use, false otherwise.
 */
function is_email_in_use($email) {
    global $db;
    $query = 'SELECT memberID FROM members WHERE memberEmail = :email';
    $statement = $db->prepare($query);
    $statement->bindValue(':email', $email);
    $statement->execute();
    $is_in_use = ($statement->rowCount() > 0);
    $statement->closeCursor();
    return $is_in_use;
}

/**
 * Gets a member's full record from the database by their email.
 * @param string $email The member's email.
 * @return array|false The member data or false if not found.
 */
function get_member_by_email($email) {
    global $db;
    $query = 'SELECT * FROM members WHERE memberEmail = :email';
    $statement = $db->prepare($query);
    $statement->bindValue(':email', $email);
    $statement->execute();
    $member = $statement->fetch();
    $statement->closeCursor();
    return $member;
}

/**
 * Verifies a member's email and password against the stored hash.
 * @param string $email The member's email.
 * @param string $password The member's plain-text password.
 * @return bool True if the login is valid, false otherwise.
 */
function is_valid_member_login($email, $password) {
    global $db;
    $query = 'SELECT memberPW FROM members WHERE memberEmail = :email';
    $statement = $db->prepare($query);
    $statement->bindValue(':email', $email);
    $statement->execute();
    $row = $statement->fetch();
    $statement->closeCursor();

    if ($row === false) {
        return false; // User not found
    }
    $hash = $row['memberPW'];

    return password_verify($password, $hash);
}

/**
 * Gets a member's full record by their ID.
 * @param int $member_id The member's ID.
 * @return array|false The member data or false if not found.
 */
function get_member($member_id) {
    global $db;
    $query = 'SELECT * FROM members WHERE memberID = :member_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':member_id', $member_id);
    $statement->execute();
    $member = $statement->fetch();
    $statement->closeCursor();
    return $member;
}

/**
 * Adds a new member to the database with a securely hashed password.
 * @param string $email
 * @param string $first_name
 * @param string $last_name
 * @param string $password
 * @return int The ID of the newly created member.
 */
function add_member($email, $first_name, $last_name, $password) {
    global $db;
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    $query = 'INSERT INTO members (fName, lName, memberEmail, memberPW)
              VALUES (:first_name, :last_name, :email, :password)';
    $statement = $db->prepare($query);
    $statement->bindValue(':first_name', $first_name);
    $statement->bindValue(':last_name', $last_name);
    $statement->bindValue(':email', $email);
    $statement->bindValue(':password', $password_hash);
    $statement->execute();
    $member_id = $db->lastInsertId();
    $statement->closeCursor();
    return $member_id;
}

/**
 * Updates a member's account details, conditionally updating the password.
 * @param int $member_id
 * @param string $email
 * @param string $first_name
 * @param string $last_name
 * @param string $password_1 (optional new password)
 * @param string $password_2 (optional new password confirmation)
 */
function update_member($member_id, $email, $first_name, $last_name,
        $password_1, $password_2) {
    global $db;

    $query = 'UPDATE members
              SET memberEmail = :email, fName = :first_name, lName = :last_name
              WHERE memberID = :member_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':email', $email);
    $statement->bindValue(':first_name', $first_name);
    $statement->bindValue(':last_name', $last_name);
    $statement->bindValue(':member_id', $member_id);
    $statement->execute();
    $statement->closeCursor();

    if (!empty($password_1)) {
        if ($password_1 !== $password_2) {
            member_error('Passwords do not match.');
            return;
        }

        $password_hash = password_hash($password_1, PASSWORD_DEFAULT);

        $query = 'UPDATE members SET memberPW = :password WHERE memberID = :member_id';
        $statement = $db->prepare($query);
        $statement->bindValue(':password', $password_hash);
        $statement->bindValue(':member_id', $member_id);
        $statement->execute();
        $statement->closeCursor();
    }
}

/**
 * Updates the shipping address ID for a member.
 * @param int $member_id
 * @param int $address_id
 */
function member_change_shipping_id($member_id, $address_id) {
    global $db;
    $query = 'UPDATE members SET shipAddressID = :address_id WHERE memberID = :member_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':address_id', $address_id);
    $statement->bindValue(':member_id', $member_id);
    $statement->execute();
    $statement->closeCursor();
}

/**
 * Updates the billing address ID for a member.
 * @param int $member_id
 * @param int $address_id
 */
function member_change_billing_id($member_id, $address_id) {
    global $db;
    $query = 'UPDATE members SET billingAddressID = :address_id WHERE memberID = :member_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':address_id', $address_id);
    $statement->bindValue(':member_id', $member_id);
    $statement->execute();
    $statement->closeCursor();
}

?>