<?php

namespace Zimbra\Common\Tests;

use \PHPUnit_Framework_TestCase;
use Faker\Factory as FakerFactory;
use Zimbra\Upload\Attactment;

/**
 * Testcase class for upload attactment class.
 */
class AttactmentTest extends PHPUnit_Framework_TestCase
{
    protected $faker;

    protected function setUp()
    {
        $this->faker = FakerFactory::create();
    }

    public function testAttactment()
    {
        $attachmentId = $this->faker->word;
        $fileName = $this->faker->word;
        $contentType = $this->faker->word;

        $attactment = new Attactment($attachmentId, $fileName, $contentType);
        $this->assertSame($attachmentId, $attactment->getAttachmentId());
        $this->assertSame($fileName, $attactment->getFileName());
        $this->assertSame($contentType, $attactment->getContentType());
    }
}
