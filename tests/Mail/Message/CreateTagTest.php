<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Message;

use Zimbra\Common\Enum\Type;
use Zimbra\Common\Struct\KeyValuePair;

use Zimbra\Mail\Message\CreateTagEnvelope;
use Zimbra\Mail\Message\CreateTagBody;
use Zimbra\Mail\Message\CreateTagRequest;
use Zimbra\Mail\Message\CreateTagResponse;

use Zimbra\Mail\Struct\MailCustomMetadata;
use Zimbra\Mail\Struct\Policy;
use Zimbra\Mail\Struct\RetentionPolicy;
use Zimbra\Mail\Struct\TagInfo;
use Zimbra\Mail\Struct\TagSpec;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for CreateTag.
 */
class CreateTagTest extends ZimbraTestCase
{
    public function testCreateTag()
    {
        $id = $this->faker->uuid;
        $name = $this->faker->word;
        $rgb = $this->faker->hexcolor;
        $color = $this->faker->numberBetween(0, 127);
        $unread = $this->faker->randomNumber;
        $count = $this->faker->randomNumber;
        $date = $this->faker->unixTime;
        $revision = $this->faker->randomNumber;
        $changeDate = $this->faker->unixTime;
        $modifiedSequence = $this->faker->randomNumber;

        $lifetime = $this->faker->word;
        $section = $this->faker->word;
        $key = $this->faker->word;
        $value = $this->faker->text;

        $tagSpec = new TagSpec(
            $name,
            $rgb,
            $color
        );
        $request = new CreateTagRequest($tagSpec);
        $this->assertSame($tagSpec, $request->getTag());
        $request = new CreateTagRequest(new TagSpec());
        $request->setTag($tagSpec);
        $this->assertSame($tagSpec, $request->getTag());

        $metadata = new MailCustomMetadata($section, [new KeyValuePair($key, $value)]);
        $retentionPolicy = new RetentionPolicy(
            [new Policy(Type::SYSTEM(), $id, $name, $lifetime)],
            [new Policy(Type::USER(), $id, $name, $lifetime)]
        );
        $tagInfo = new TagInfo(
            $id,
            $name,
            $color,
            $rgb,
            $unread,
            $count,
            $date,
            $revision,
            $changeDate,
            $modifiedSequence,
            [$metadata],
            $retentionPolicy
        );
        $response = new CreateTagResponse($tagInfo);
        $this->assertSame($tagInfo, $response->getTag());
        $response = new CreateTagResponse();
        $response->setTag($tagInfo);
        $this->assertSame($tagInfo, $response->getTag());

        $body = new CreateTagBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new CreateTagBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new CreateTagEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new CreateTagEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:CreateTagRequest>
            <urn:tag name="$name" rgb="$rgb" color="$color" />
        </urn:CreateTagRequest>
        <urn:CreateTagResponse>
            <urn:tag id="$id" name="$name" color="$color" rgb="$rgb" u="$unread" n="$count" d="$date" rev="$revision" md="$changeDate" ms="$modifiedSequence">
                <urn:meta section="$section">
                    <urn:a n="$key">$value</urn:a>
                </urn:meta>
                <urn:urn:retentionPolicy>
                    <urn:keep>
                        <urn:policy type="system" id="$id" name="$name" lifetime="$lifetime" />
                    </urn:keep>
                    <urn:purge>
                        <urn:policy type="user" id="$id" name="$name" lifetime="$lifetime" />
                    </urn:purge>
                </urn:retentionPolicy>
            </urn:tag>
        </urn:CreateTagResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, CreateTagEnvelope::class, 'xml'));
    }
}
