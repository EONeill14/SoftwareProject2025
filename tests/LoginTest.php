<?php

// Use PHPUnit and the Selenium WebDriver library
use PHPUnit\Framework\TestCase;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\WebDriverBy;

class LoginTest extends TestCase {

    /** @var RemoteWebDriver */
    private $driver;

    /**
     * This method runs before each test to set up the browser.
     */
    // The corrected code
    protected function setUp(): void {
        $serverUrl = 'http://localhost:9515'; // Or whatever port you are using
        // Create capabilities and tell it to accept insecure certs
        $capabilities = DesiredCapabilities::chrome();
        $capabilities->setCapability('acceptInsecureCerts', true);

        // Pass the new capabilities when creating the driver
        $this->driver = RemoteWebDriver::create($serverUrl, $capabilities);
    }

    /**
     * This method runs after each test to close the browser.
     */
    protected function tearDown(): void {
        $this->driver->quit();
    }

    /**
     * Test that a valid member can successfully log in.
     */
    public function testSuccessfulMemberLogin() {
        // 1. Navigate to the login page
        $this->driver->get('http://localhost/SoftWareProject/member/?action=view_login');

        // 2. Find the form elements
        $emailInput = $this->driver->findElement(WebDriverBy::name('email'));
        $passwordInput = $this->driver->findElement(WebDriverBy::name('password'));
        $loginButton = $this->driver->findElement(WebDriverBy::cssSelector('button[type="submit"]'));

        // 3. Fill out the form and click the button
        $emailInput->sendKeys('member@teetime.ie'); // Use your demo member's email
        $passwordInput->sendKeys('password');       // Use your demo member's password
        $loginButton->click();

        // 4. Assertion: Check if the login was successful
        // We'll check if the URL is now the member's account page
        $this->assertStringContainsString('/member/', $this->driver->getCurrentURL());

        // We can also check for text on the new page
        $pageSource = $this->driver->getPageSource();
        $this->assertStringContainsString('My Account', $pageSource);
    }

}
