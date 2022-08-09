<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Message;

use Zimbra\Common\Enum\Type;
use Zimbra\Common\Struct\KeyValuePair;

use Zimbra\Mail\Message\GetTagEnvelope;
use Zimbra\Mail\Message\GetTagBody;
use Zimbra\Mail\Message\GetTagRequest;
use Zimbra\Mail\Message\GetTagResponse;

use Zimbra\Mail\Struct\TagInfo;
use Zimbra\Mail\Struct\MailCustomMetadata;
use Zimbra\Mail\Struct\Policy;
use Zimbra\Mail\Struct\RetentionPolicy;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for GetTag.
 */
class GetTagTest extends ZimbraTestCase
{
    public function testGetTag()
    {
        $id = $this->faker->uuid;
        $name = $this->faker->word;
        $color = $this->faker->numberBetween(0, 127);
        $rgb = $this->faker->hexcolor;
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

        $metadata = new MailCustomMetadata($section, [new KeyValuePair($key, $value)]);
        $retentionPolicy = new RetentionPolicy(
            [new Policy(Type::SYSTEM(), $id, $name, $lifetime)],
            [new Policy(Type::USER(), $id, $name, $lifetime)]
        );
        $tag = new TagInfo(
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

        $response = new GetTagResponse([$tag]);
        $this->assertSame([$tag], $response->getTags());
        $response = new GetTagResponse();
        $response->setTags([$tag]);
        $this->assertSame([$tag], $response->getTags());
        $request = new GetTagRequest();
        $response = new GetTagResponse([$tag]);

        $body = new GetTagBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new GetTagBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new GetTagEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new GetTagEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:GetTagRequest/>
        <urn:GetTagResponse>
            <urn:tag id="$id" name="$name" color="$color" rgb="$rgb" u="$unread" n="$count" d="$date" rev="$revision" md="$changeDate" ms="$modifiedSequence" xmlns:urn="urn:zimbraMail">
                <urn:meta section="$section">
                    <urn:a n="$key">$value</urn:a>
                </urn:meta>
                <urn:retentionPolicy>
                    <urn:keep>
                        <urn:policy type="system" id="$id" name="$name" lifetime="$lifetime" />
                    </urn:keep>
                    <urn:purge>
                        <urn:policy type="user" id="$id" name="$name" lifetime="$lifetime" />
                    </urn:purge>
                </urn:retentionPolicy>
            </urn:tag>
        </urn:GetTagResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetTagEnvelope::class, 'xml'));
    }
}
