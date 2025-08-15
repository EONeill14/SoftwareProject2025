<?php

/**
 * Gets a single address by its ID.
 * @param int $address_id The ID of the address to get.
 * @return array|false The address data or false if not found.
 */
function get_address($address_id) {
    global $db;
    $query = 'SELECT * FROM addresses WHERE addressID = :address_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':address_id', $address_id);
    $statement->execute();
    $address = $statement->fetch();
    $statement->closeCursor();
    return $address;
}

/**
 * Adds a new address to the database for a given member.
 * @param int $member_id
 * @param string $line1
 * @param string $line2
 * @param string $city
 * @param string $county
 * @param string $eircode
 * @param string $phone
 * @return int The ID of the newly created address.
 */
function add_address($member_id, $line1, $line2, $city, $county, $eircode, $phone) {
    global $db;
    $query = 'INSERT INTO addresses (memberID, line1, line2, city, county, eircode, phone)
              VALUES (:member_id, :line1, :line2, :city, :county, :eircode, :phone)';

    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':member_id', $member_id);
        $statement->bindValue(':line1', $line1);
        $statement->bindValue(':line2', $line2);
        // FIX: The variable was missing a '$' sign
        $statement->bindValue(':city', $city);
        $statement->bindValue(':county', $county);
        $statement->bindValue(':eircode', $eircode);
        $statement->bindValue(':phone', $phone);
        $statement->execute();
        $address_id = $db->lastInsertId();
        $statement->closeCursor();
        return $address_id;
    } catch (PDOException $e) {
        display_db_error($e->getMessage());
    }
}

/**
 * Updates an existing address.
 * @param int $address_id
 * @param string $line1
 * @param string $line2
 * @param string $city
 * @param string $county
 * @param string $eircode
 * @param string $phone
 */
function update_address($address_id, $line1, $line2, $city, $county, $eircode, $phone) {
    global $db;
    // MODIFIED: Changed 'state' and 'zipCode' to 'county' and 'eircode'
    $query = 'UPDATE addresses
              SET line1 = :line1,
                  line2 = :line2,
                  city = :city,
                  county = :county,
                  eircode = :eircode,
                  phone = :phone
              WHERE addressID = :address_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':address_id', $address_id);
    $statement->bindValue(':line1', $line1);
    $statement->bindValue(':line2', $line2);
    $statement->bindValue(':city', $city);
    $statement->bindValue(':county', $county);
    $statement->bindValue(':eircode', $eircode);
    $statement->bindValue(':phone', $phone);
    $statement->execute();
    $statement->closeCursor();
}

/**
 * Checks if an address ID is used in any orders (for shipping or billing).
 * @param int $address_id
 * @return bool True if the address is used, false otherwise.
 */
function is_used_address_id($address_id) {
    global $db;
    // IMPROVEMENT: Combined into a single, more efficient query.
    $query = 'SELECT COUNT(*) as useCount FROM orders 
              WHERE shipAddressID = :address_id OR billingAddressID = :address_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':address_id', $address_id);
    $statement->execute();
    $result = $statement->fetch();
    $statement->closeCursor();
    return ($result['useCount'] > 0);
}

/**
 * If an address has been used in an order, disable it. Otherwise, delete it.
 * @param int $address_id The address to disable or delete.
 */
function disable_or_delete_address($address_id) {
    if (is_used_address_id($address_id)) {
        // Soft delete by disabling
        global $db;
        $query = 'UPDATE addresses SET disabled = 1 WHERE addressID = :address_id';
        $statement = $db->prepare($query);
        $statement->bindValue(":address_id", $address_id);
        $statement->execute();
        $statement->closeCursor();
    } else {
        // Hard delete since it's not used in any orders
        global $db;
        $query = 'DELETE FROM addresses WHERE addressID = :address_id';
        $statement = $db->prepare($query);
        $statement->bindValue(":address_id", $address_id);
        $statement->execute();
        $statement->closeCursor();
    }
}

?>