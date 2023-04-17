<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Common\Enum\{ActionGrantRight, DocumentActionOp, GranteeType};

use Zimbra\Mail\Struct\DocumentActionSelector;
use Zimbra\Mail\Struct\DocumentActionGrant;
use Zimbra\Mail\Struct\Policy;
use Zimbra\Mail\Struct\RetentionPolicy;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for DocumentActionSelector.
 */
class DocumentActionSelectorTest extends ZimbraTestCase
{
    public function testDocumentActionSelector()
    {
        $operation = $this->faker->randomElement(DocumentActionOp::cases())->value;
        $ids = $this->faker->uuid;

        $zimbraId = $this->faker->uuid;
        $grantType = GranteeType::USR;

        $rights = implode(',', [ActionGrantRight::READ->value, ActionGrantRight::WRITE->value]);
        $expiry = $this->faker->randomNumber;
        $displayName = $this->faker->name;
        $args = $this->faker->word;
        $password = $this->faker->word;
        $accessKey = $this->faker->word;

        $grant = new DocumentActionGrant(
            $rights, $grantType, $expiry, $zimbraId, $displayName, $args, $password, $accessKey
        );

        $action = new StubDocumentActionSelector(
            $operation, $ids, $zimbraId, $grant
        );
        $this->assertSame($zimbraId, $action->getZimbraId());
        $this->assertSame($grant, $action->getGrant());

        $action = new StubDocumentActionSelector($operation, $ids);
        $action->setZimbraId($zimbraId)
            ->setGrant($grant);
        $this->assertSame($zimbraId, $action->getZimbraId());
        $this->assertSame($grant, $action->getGrant());

        $xml = <<<EOT
<?xml version="1.0"?>
<result id="$ids" op="$operation" zid="$zimbraId" xmlns:urn="urn:zimbraMail">
    <urn:grant perm="$rights" gt="usr" expiry="$expiry" zid="$zimbraId" d="$displayName" args="$args" pw="$password" key="$accessKey" />
</result>
EOT;

        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($action, 'xml'));
        $this->assertEquals($action, $this->serializer->deserialize($xml, StubDocumentActionSelector::class, 'xml'));
    }
}

#[XmlNamespace(uri: 'urn:zimbraMail', prefix: "urn")]
class StubDocumentActionSelector extends DocumentActionSelector
{
}
