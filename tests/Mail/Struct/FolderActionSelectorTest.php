<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Common\Enum\{ActionGrantRight, ContactActionOp, GranteeType, Type};

use Zimbra\Mail\Struct\ActionGrantSelector;
use Zimbra\Mail\Struct\FolderActionSelector;
use Zimbra\Mail\Struct\Policy;
use Zimbra\Mail\Struct\RetentionPolicy;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for FolderActionSelector.
 */
class FolderActionSelectorTest extends ZimbraTestCase
{
    public function testFolderActionSelector()
    {
        $operation = $this->faker->randomElement(ContactActionOp::values())->getValue();
        $ids = $this->faker->uuid;

        $id = $this->faker->uuid;
        $name = $this->faker->word;

        $url = $this->faker->url;
        $zimbraId = $this->faker->uuid;
        $grantType = GranteeType::USR();
        $view = $this->faker->word;
        $numDays = $this->faker->randomNumber;

        $rights = implode([ActionGrantRight::READ(), ActionGrantRight::WRITE()]);
        $displayName = $this->faker->name;
        $args = $this->faker->word;
        $password = $this->faker->word;
        $accessKey = $this->faker->word;
        $lifetime = $this->faker->word;

        $grant = new ActionGrantSelector(
            $rights, $grantType, $zimbraId, $displayName, $args, $password, $accessKey
        );
        $retentionPolicy = new RetentionPolicy(
            [new Policy(Type::SYSTEM(), $id, $name, $lifetime)],
            [new Policy(Type::USER(), $id, $name, $lifetime)]
        );

        $action = new StubFolderActionSelector(
            $operation, $ids, FALSE, $url, FALSE, $zimbraId, $grantType, $view, $grant, [$grant], $retentionPolicy, $numDays
        );
        $this->assertFalse($action->getRecursive());
        $this->assertSame($url, $action->getUrl());
        $this->assertFalse($action->getExcludeFreebusy());
        $this->assertSame($zimbraId, $action->getZimbraId());
        $this->assertSame($grantType, $action->getGrantType());
        $this->assertSame($view, $action->getView());
        $this->assertSame($grant, $action->getGrant());
        $this->assertSame([$grant], $action->getGrants());
        $this->assertSame($retentionPolicy, $action->getRetentionPolicy());
        $this->assertSame($numDays, $action->getNumDays());

        $action = new StubFolderActionSelector($operation, $ids);
        $action->setRecursive(TRUE)
            ->setUrl($url)
            ->setExcludeFreebusy(TRUE)
            ->setZimbraId($zimbraId)
            ->setGrantType($grantType)
            ->setView($view)
            ->setGrant($grant)
            ->setGrants([$grant])
            ->addGrant($grant)
            ->setRetentionPolicy($retentionPolicy)
            ->setNumDays($numDays);
        $this->assertTrue($action->getRecursive());
        $this->assertSame($url, $action->getUrl());
        $this->assertTrue($action->getExcludeFreebusy());
        $this->assertSame($zimbraId, $action->getZimbraId());
        $this->assertSame($grantType, $action->getGrantType());
        $this->assertSame($view, $action->getView());
        $this->assertSame($grant, $action->getGrant());
        $this->assertSame([$grant, $grant], $action->getGrants());
        $this->assertSame($retentionPolicy, $action->getRetentionPolicy());
        $this->assertSame($numDays, $action->getNumDays());
        $action->setGrants([$grant]);

        $xml = <<<EOT
<?xml version="1.0"?>
<result id="$ids" op="$operation" recursive="true" url="$url" excludeFreeBusy="true" zid="$zimbraId" gt="usr" view="$view" numDays="$numDays" xmlns:urn="urn:zimbraMail">
    <urn:grant perm="$rights" gt="usr" zid="$zimbraId" d="$displayName" args="$args" pw="$password" key="$accessKey" />
    <urn:acl>
        <urn:grant perm="$rights" gt="usr" zid="$zimbraId" d="$displayName" args="$args" pw="$password" key="$accessKey" />
    </urn:acl>
    <urn:retentionPolicy>
        <urn:keep>
            <urn:policy type="system" id="$id" name="$name" lifetime="$lifetime" />
        </urn:keep>
        <urn:purge>
            <urn:policy type="user" id="$id" name="$name" lifetime="$lifetime" />
        </urn:purge>
    </urn:retentionPolicy>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($action, 'xml'));
        $this->assertEquals($action, $this->serializer->deserialize($xml, StubFolderActionSelector::class, 'xml'));
    }
}

/**
 * @XmlNamespace(uri="urn:zimbraMail", prefix="urn")
 */
#[XmlNamespace(uri: 'urn:zimbraMail', prefix: "urn")]
class StubFolderActionSelector extends FolderActionSelector
{
}
