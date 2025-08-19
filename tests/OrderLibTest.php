<?php
// Use the PHPUnit framework
use PHPUnit\Framework\TestCase;

// The files we are testing are loaded by the bootstrap.php file.

class OrderLibTest extends TestCase
{
    /** @var ?PDO This will hold our database connection for the tests. */
    private static $db = null;

    /**
     * This is a special PHPUnit method that runs ONCE before any tests in this file.
     * We will use it to create a single, reliable database connection.
     */
    public static function setUpBeforeClass(): void
    {
        if (self::$db === null) {
            $dsn = 'mysql:host=localhost;dbname=teetime';
            $username = 'root';
            $password = '';
            $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
            try {
                self::$db = new PDO($dsn, $username, $password, $options);
            } catch (PDOException $e) {
                // Fail the test if the database connection doesn't work.
                self::fail("Database connection failed: " . $e->getMessage());
            }
        }
    }

    /**
     * Test that the card_name function returns the correct string for each ID.
     */
    public function testCardNameConversion()
    {
        $this->assertEquals('MasterCard', card_name(1));
        $this->assertEquals('Visa', card_name(2));
        $this->assertEquals('Unknown Card Type', card_name(99));
    }

    /**
     * Test that the shipping_cost function is calculated correctly.
     */
    public function testShippingCostCalculation()
    {
        // This makes our test's database connection available to the global scope,
        // so the functions that use "global $db;" can find it.
        global $db;
        $db = self::$db;

        // Setup: Add a temporary product to the database for this test.
        $db->exec("INSERT INTO products (productID, categoryID, productCode, productName, description, listPrice, dateAdded) 
                   VALUES (999, 1, 'testprod', 'Test Product', 'desc', 10.00, NOW())
                   ON DUPLICATE KEY UPDATE productName = 'Test Product'");
        
        // Test Case: 3 items in the cart
        $_SESSION['cart'] = [999 => 3];
        $this->assertEquals(15, shipping_cost());

        // Cleanup: Remove the temporary product.
        $db->exec("DELETE FROM products WHERE productID = 999");
    }
}
