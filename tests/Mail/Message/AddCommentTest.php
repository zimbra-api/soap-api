<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Message;

use Zimbra\Common\Struct\Id;

use Zimbra\Mail\Message\AddCommentEnvelope;
use Zimbra\Mail\Message\AddCommentBody;
use Zimbra\Mail\Message\AddCommentRequest;
use Zimbra\Mail\Message\AddCommentResponse;

use Zimbra\Mail\Struct\AddedComment;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for AddComment.
 */
class AddCommentTest extends ZimbraTestCase
{
    public function testAddComment()
    {
        $id = $this->faker->uuid;
        $parentId = $this->faker->uuid;
        $text = $this->faker->text;

        $addedComment = new AddedComment($parentId, $text);
        $request = new AddCommentRequest($addedComment);
        $this->assertSame($addedComment, $request->getComment());
        $request = new AddCommentRequest(new AddedComment('', ''));
        $request->setComment($addedComment);
        $this->assertSame($addedComment, $request->getComment());

        $idComment = new Id($id);
        $response = new AddCommentResponse($idComment);
        $this->assertSame($idComment, $response->getComment());
        $response = new AddCommentResponse(new Id(''));
        $response->setComment($idComment);
        $this->assertSame($idComment, $response->getComment());

        $body = new AddCommentBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new AddCommentBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new AddCommentEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new AddCommentEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:AddCommentRequest>
            <urn:comment parentId="$parentId" text="$text" />
        </urn:AddCommentRequest>
        <urn:AddCommentResponse>
            <urn:comment id="$id" />
        </urn:AddCommentResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, AddCommentEnvelope::class, 'xml'));
    }
}
