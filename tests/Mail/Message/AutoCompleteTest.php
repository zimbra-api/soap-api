<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Message;

use Zimbra\Common\Enum\AutoCompleteMatchType;
use Zimbra\Common\Enum\GalSearchType;
use Zimbra\Mail\Struct\AutoCompleteMatch;

use Zimbra\Mail\Message\AutoCompleteEnvelope;
use Zimbra\Mail\Message\AutoCompleteBody;
use Zimbra\Mail\Message\AutoCompleteRequest;
use Zimbra\Mail\Message\AutoCompleteResponse;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for AutoComplete.
 */
class AutoCompleteTest extends ZimbraTestCase
{
    public function testAutoComplete()
    {
        $name = $this->faker->name;
        $type = GalSearchType::ACCOUNT();
        $folderList = $this->faker->text;

        $request = new AutoCompleteRequest($name, $type, FALSE, $folderList, FALSE);
        $this->assertSame($name, $request->getName());
        $this->assertSame($type, $request->getType());
        $this->assertFalse($request->getNeedCanExpand());
        $this->assertSame($folderList, $request->getFolderList());
        $this->assertFalse($request->getIncludeGal());
        $request = new AutoCompleteRequest();
        $request->setName($name)
            ->setType($type)
            ->setNeedCanExpand(TRUE)
            ->setFolderList($folderList)
            ->setIncludeGal(TRUE);
        $this->assertSame($name, $request->getName());
        $this->assertSame($type, $request->getType());
        $this->assertTrue($request->getNeedCanExpand());
        $this->assertSame($folderList, $request->getFolderList());
        $this->assertTrue($request->getIncludeGal());

        $email = $this->faker->email;
        $matchType = AutoCompleteMatchType::GAL();
        $ranking = $this->faker->randomNumber;
        $id = $this->faker->uuid;
        $folder = $this->faker->word;
        $displayName = $this->faker->name;
        $firstName = $this->faker->firstName;
        $middleName = $this->faker->name;
        $lastName = $this->faker->lastName;
        $fullName = $this->faker->name;
        $nickname = $this->faker->name;
        $company = $this->faker->company;
        $fileAs = $this->faker->word;

        $match = new AutoCompleteMatch(
            $email, $matchType, $ranking, TRUE, TRUE, $id, $folder, $displayName, $firstName, $middleName, $lastName, $fullName, $nickname, $company, $fileAs
        );
        $response = new AutoCompleteResponse([$match], FALSE);
        $this->assertSame([$match], $response->getMatches());
        $this->assertFalse($response->getCanBeCached());
        $response = new AutoCompleteResponse();
        $response->setMatches([$match])
            ->setCanBeCached(TRUE);
        $this->assertSame([$match], $response->getMatches());
        $this->assertTrue($response->getCanBeCached());

        $body = new AutoCompleteBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new AutoCompleteBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new AutoCompleteEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new AutoCompleteEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:AutoCompleteRequest name="$name" t="account" needExp="true" folders="$folderList" includeGal="true" />
        <urn:AutoCompleteResponse canBeCached="true">
            <urn:match email="$email" type="gal" ranking="$ranking" isGroup="true" exp="true" id="$id" l="$folder" display="$displayName" first="$firstName" middle="$middleName" last="$lastName" full="$fullName" nick="$nickname" company="$company" fileas="$fileAs" />
        </urn:AutoCompleteResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, AutoCompleteEnvelope::class, 'xml'));
    }
}
