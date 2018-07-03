<?php

namespace Devtoolboxuk\DataSanitiser;

use PHPUnit_Framework_TestCase as TestCase;

class Service extends TestCase
{

    protected $sanitiserService;

    public function __construct($name = null, array $data = array(), $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->sanitiserService = new SanitiserService();

    }


    public function testSanitiseDisplay()
    {
        $this->assertEquals(89, $this->sanitiserService->sanitiseDisplay(89));
        $this->assertEquals("string", $this->sanitiserService->sanitiseDisplay("string"));
    }

    public function testSanitiseForCSV()
    {

    }

    public function testSanitise()
    {
        $this->emailSanitise();
    }

    private function emailSanitise()
    {

    }
}
