<?php
session_start();

include "vendor/autoload.php";

use app\app\app;
class TestApp extends PHPUnit\Framework\TestCase {

    private app $app;

    public function setUp(): void 
    {
        $this->app = new app(); 
    }
    public function testIsStatusArray()
    {
        ob_start();
        $this->app->status();
        $output = ob_get_clean();


        $this->assertJson($output);
    }
}