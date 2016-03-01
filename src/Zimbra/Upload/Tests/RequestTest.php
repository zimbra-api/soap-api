<?php

namespace Zimbra\Common\Tests;

use \PHPUnit_Framework_TestCase;
use Faker\Factory as FakerFactory;
use Zimbra\Upload\Request;

/**
 * Testcase class for upload request class.
 */
class RequestTest extends PHPUnit_Framework_TestCase
{
    protected $faker;

    protected function setUp()
    {
        $this->faker = FakerFactory::create();
    }

    public function testRequest()
    {
        $requestId = $this->faker->word;
        $file1 = $this->faker->word;
        $file2 = $this->faker->word;

        $request = new Request($requestId, [$file1]);
        $this->assertSame($requestId, $request->getRequestId());
        $this->assertSame([$file1], $request->getFiles()->all());

        $request = new Request('');
        $request->setRequestId($requestId)
            ->setFiles([$file1])
            ->addFile($file2);
        $this->assertSame($requestId, $request->getRequestId());
        $this->assertSame([$file1, $file2], $request->getFiles()->all());
    }
}
