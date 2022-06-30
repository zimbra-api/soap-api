<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Message;

use Zimbra\Common\Struct\KeyValuePair;

use Zimbra\Mail\Message\GetCommentsEnvelope;
use Zimbra\Mail\Message\GetCommentsBody;
use Zimbra\Mail\Message\GetCommentsRequest;
use Zimbra\Mail\Message\GetCommentsResponse;

use Zimbra\Mail\Struct\ParentId;
use Zimbra\Mail\Struct\IdEmailName;
use Zimbra\Mail\Struct\CommentInfo;
use Zimbra\Mail\Struct\MailCustomMetadata;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for GetComments.
 */
class GetCommentsTest extends ZimbraTestCase
{
    public function testGetComments()
    {
        $name = $this->faker->name;
        $parentId = $this->faker->uuid;
        $id = $this->faker->uuid;
        $uuid = $this->faker->uuid;
        $email = $this->faker->email;
        $creatorEmail = $this->faker->email;
        $date = $this->faker->randomNumber;
        $flags = $this->faker->word;
        $tags = $this->faker->word;
        $tagNames = $this->faker->word;
        $color = $this->faker->numberBetween(0, 127);
        $rgb = $this->faker->hexcolor;
        $section = $this->faker->word;
        $key = $this->faker->word;
        $value = $this->faker->text;

        $comment = new ParentId($parentId);
        $user = new IdEmailName(
            $id, $email, $name
        );
        $info = new CommentInfo(
            $parentId,
            $id,
            $uuid,
            $creatorEmail,
            $flags,
            $tags,
            $tagNames,
            $color,
            $rgb,
            $date,
            [new MailCustomMetadata($section, [new KeyValuePair($key, $value)])]
        );

        $request = new GetCommentsRequest($comment);
        $this->assertSame($comment, $request->getComment());
        $request = new GetCommentsRequest(new ParentId(''));
        $request->setComment($comment);
        $this->assertSame($comment, $request->getComment());

        $response = new GetCommentsResponse([$user], [$info]);
        $this->assertSame([$user], $response->getUsers());
        $this->assertSame([$info], $response->getComments());
        $response = new GetCommentsResponse();
        $response->setUsers([$user])
            ->addUser($user)
            ->setComments([$info])
            ->addComment($info);
        $this->assertSame([$user, $user], $response->getUsers());
        $this->assertSame([$info, $info], $response->getComments());
        $response = new GetCommentsResponse([$user], [$info]);

        $body = new GetCommentsBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new GetCommentsBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new GetCommentsEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new GetCommentsEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:GetCommentsRequest>
            <urn:comment parentId="$parentId" />
        </urn:GetCommentsRequest>
        <urn:GetCommentsResponse>
            <urn:user id="$id" email="$email" name="$name" />
            <urn:comment parentId="$parentId" id="$id" uuid="$uuid" email="$creatorEmail" f="$flags" t="$tags" tn="$tagNames" color="$color" rgb="$rgb" d="$date">
                <urn:meta section="$section">
                    <urn:a n="$key">$value</urn:a>
                </urn:meta>
            </urn:comment>
        </urn:GetCommentsResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetCommentsEnvelope::class, 'xml'));
    }
}
