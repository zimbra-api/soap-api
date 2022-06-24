<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\MiniCalError;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for MiniCalError.
 */
class MiniCalErrorTest extends ZimbraTestCase
{
    public function testMiniCalError()
    {
        $id = $this->faker->uuid;
        $code = $this->faker->word;
        $errorMessage = $this->faker->word;

        $error = new MiniCalError(
            $id, $code, $errorMessage
        );
        $this->assertSame($id, $error->getId());
        $this->assertSame($code, $error->getCode());
        $this->assertSame($errorMessage, $error->getErrorMessage());

        $error = new MiniCalError('', '');
        $error->setId($id)
            ->setCode($code)
            ->setErrorMessage($errorMessage);
        $this->assertSame($id, $error->getId());
        $this->assertSame($code, $error->getCode());
        $this->assertSame($errorMessage, $error->getErrorMessage());

        $xml = <<<EOT
<?xml version="1.0"?>
<result id="$id" code="$code">$errorMessage</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($error, 'xml'));
        $this->assertEquals($error, $this->serializer->deserialize($xml, MiniCalError::class, 'xml'));

        $json = json_encode([
            'id' => $id,
            'code' => $code,
            '_content' => $errorMessage,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($error, 'json'));
        $this->assertEquals($error, $this->serializer->deserialize($json, MiniCalError::class, 'json'));
    }
}
