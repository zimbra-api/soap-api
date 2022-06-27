<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Common\Enum\AutoCompleteMatchType as MatchType;
use Zimbra\Mail\Struct\AutoCompleteMatch;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for AutoCompleteMatch.
 */
class AutoCompleteMatchTest extends ZimbraTestCase
{
    public function testAutoCompleteMatch()
    {
        $email = $this->faker->email;
        $matchType = MatchType::GAL();
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
            $email, $matchType, $ranking, FALSE, FALSE, $id, $folder, $displayName, $firstName, $middleName, $lastName, $fullName, $nickname, $company, $fileAs
        );
        $this->assertSame($email, $match->getEmail());
        $this->assertSame($matchType, $match->getMatchType());
        $this->assertSame($ranking, $match->getRanking());
        $this->assertFalse($match->getGroup());
        $this->assertFalse($match->getCanExpandGroupMembers());
        $this->assertSame($id, $match->getId());
        $this->assertSame($folder, $match->getFolder());
        $this->assertSame($displayName, $match->getDisplayName());
        $this->assertSame($firstName, $match->getFirstName());
        $this->assertSame($middleName, $match->getMiddleName());
        $this->assertSame($lastName, $match->getLastName());
        $this->assertSame($fullName, $match->getFullName());
        $this->assertSame($nickname, $match->getNickname());
        $this->assertSame($company, $match->getCompany());
        $this->assertSame($fileAs, $match->getFileAs());

        $match = new AutoCompleteMatch();
        $match->setEmail($email)
            ->setMatchType($matchType)
            ->setRanking($ranking)
            ->setGroup(TRUE)
            ->setCanExpandGroupMembers(TRUE)
            ->setId($id)
            ->setFolder($folder)
            ->setDisplayName($displayName)
            ->setFirstName($firstName)
            ->setMiddleName($middleName)
            ->setLastName($lastName)
            ->setFullName($fullName)
            ->setNickname($nickname)
            ->setCompany($company)
            ->setFileAs($fileAs);
        $this->assertSame($email, $match->getEmail());
        $this->assertSame($matchType, $match->getMatchType());
        $this->assertSame($ranking, $match->getRanking());
        $this->assertTrue($match->getGroup());
        $this->assertTrue($match->getCanExpandGroupMembers());
        $this->assertSame($id, $match->getId());
        $this->assertSame($folder, $match->getFolder());
        $this->assertSame($displayName, $match->getDisplayName());
        $this->assertSame($firstName, $match->getFirstName());
        $this->assertSame($middleName, $match->getMiddleName());
        $this->assertSame($lastName, $match->getLastName());
        $this->assertSame($fullName, $match->getFullName());
        $this->assertSame($nickname, $match->getNickname());
        $this->assertSame($company, $match->getCompany());
        $this->assertSame($fileAs, $match->getFileAs());


        $xml = <<<EOT
<?xml version="1.0"?>
<result email="$email" type="gal" ranking="$ranking" isGroup="true" exp="true" id="$id" l="$folder" display="$displayName" first="$firstName" middle="$middleName" last="$lastName" full="$fullName" nick="$nickname" company="$company" fileas="$fileAs" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($match, 'xml'));
        $this->assertEquals($match, $this->serializer->deserialize($xml, AutoCompleteMatch::class, 'xml'));
    }
}
