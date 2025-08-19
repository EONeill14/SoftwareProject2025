<?php
// Use the PHPUnit framework
use PHPUnit\Framework\TestCase;

// The files we are testing are loaded by the bootstrap.php file.

class ProductLibTest extends TestCase
{
    /** @var ?PDO This will hold our database connection for the tests. */
    private static $db = null;

    /**
     * This method runs once before any tests in this file to set up the database.
     */
    public static function setUpBeforeClass(): void
    {
        if (self::$db === null) {
            try {
                self::$db = new PDO('mysql:host=localhost;dbname=teetime', 'root', '');
            } catch (PDOException $e) {
                self::fail("Database connection failed: " . $e->getMessage());
            }
        }
    }

    /**
     * Test that we can successfully fetch a product from the database.
     */
    public function testGetProduct()
    {
        // This makes our test's database connection available to the global scope
        global $db;
        $db = self::$db;

        // 1. Setup: Add a temporary product to the database
        $db->exec("INSERT INTO products (productID, categoryID, productCode, productName, description, listPrice, dateAdded) 
                   VALUES (998, 1, 'testget', 'Get Test Product', 'desc', 50.00, NOW())
                   ON DUPLICATE KEY UPDATE productName = 'Get Test Product'");

        // 2. Action: Call the function we want to test
        $product = get_product(998);

        // 3. Assertions: Check that the returned data is correct
        $this->assertIsArray($product, "get_product should return an array.");
        $this->assertEquals('Get Test Product', $product['productName'], "Product name should match.");
        $this->assertEquals(50.00, $product['listPrice'], "List price should match.");

        // 4. Cleanup: Remove the temporary product
        $db->exec("DELETE FROM products WHERE productID = 998");
    }
}
