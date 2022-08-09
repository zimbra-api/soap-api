<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Message;

use Zimbra\Mail\Message\CheckSpellingEnvelope;
use Zimbra\Mail\Message\CheckSpellingBody;
use Zimbra\Mail\Message\CheckSpellingRequest;
use Zimbra\Mail\Message\CheckSpellingResponse;

use Zimbra\Mail\Struct\Misspelling;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for CheckSpelling.
 */
class CheckSpellingTest extends ZimbraTestCase
{
    public function testCheckSpelling()
    {
        $dictionary = $this->faker->word;
        $ignoreList = $this->faker->text;
        $text = $this->faker->text;
        $word = $this->faker->word;
        $suggestions = $this->faker->text;

        $request = new CheckSpellingRequest(
            $dictionary, $ignoreList, $text
        );
        $this->assertSame($dictionary, $request->getDictionary());
        $this->assertSame($ignoreList, $request->getIgnoreList());
        $this->assertSame($text, $request->getText());

        $request = new CheckSpellingRequest();
        $request->setDictionary($dictionary)
            ->setIgnoreList($ignoreList)
            ->setText($text);
        $this->assertSame($dictionary, $request->getDictionary());
        $this->assertSame($ignoreList, $request->getIgnoreList());
        $this->assertSame($text, $request->getText());

        $missed = new Misspelling($word, $suggestions);
        $response = new CheckSpellingResponse(FALSE, [$missed]);
        $this->assertFalse($response->isAvailable());
        $this->assertSame([$missed], $response->getMisspelledWords());
        $response = new CheckSpellingResponse();
        $response->setMisspelledWords([$missed])
            ->setAvailable(TRUE);
        $this->assertTrue($response->isAvailable());
        $this->assertSame([$missed], $response->getMisspelledWords());

        $body = new CheckSpellingBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new CheckSpellingBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new CheckSpellingEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new CheckSpellingEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:CheckSpellingRequest dictionary="$dictionary" ignore="$ignoreList">$text</urn:CheckSpellingRequest>
        <urn:CheckSpellingResponse available="true">
            <urn:misspelled word="$word" suggestions="$suggestions" />
        </urn:CheckSpellingResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, CheckSpellingEnvelope::class, 'xml'));
    }
}
