<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\CreateSystemRetentionPolicy;
use Zimbra\Admin\Struct\CosSelector;
use Zimbra\Admin\Struct\Policy;
use Zimbra\Admin\Struct\PolicyHolder;
use Zimbra\Enum\CosBy;
use Zimbra\Enum\Type;

/**
 * Testcase class for CreateSystemRetentionPolicy.
 */
class CreateSystemRetentionPolicyTest extends ZimbraAdminApiTestCase
{
    public function testCreateSystemRetentionPolicyRequest()
    {
        $value = $this->faker->word;
        $id = $this->faker->word;
        $name = $this->faker->word;
        $lifetime = $this->faker->word;

        $cos = new CosSelector(CosBy::NAME(), $value);

        $policy = new Policy(Type::SYSTEM(), $id, $name, $lifetime);
        $keep = new PolicyHolder($policy);

        $policy = new Policy(Type::USER(), $id, $name, $lifetime);
        $purge = new PolicyHolder($policy);

        $req = new CreateSystemRetentionPolicy($cos, $keep, $purge);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($cos, $req->getCos());
        $this->assertSame($keep, $req->getKeepPolicy());
        $this->assertSame($purge, $req->getPurgePolicy());

        $req->setCos($cos)
            ->setKeepPolicy($keep)
            ->setPurgePolicy($purge);
        $this->assertSame($cos, $req->getCos());
        $this->assertSame($keep, $req->getKeepPolicy());
        $this->assertSame($purge, $req->getPurgePolicy());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CreateSystemRetentionPolicyRequest>'
                . '<cos by="' . CosBy::NAME() . '">' . $value . '</cos>'
                . '<keep>'
                    . '<policy xmlns="urn:zimbraMail" type="' . Type::SYSTEM() . '" id="' . $id . '" name="' . $name . '" lifetime="' . $lifetime . '" />'
                . '</keep>'
                . '<purge>'
                    . '<policy xmlns="urn:zimbraMail" type="' . Type::USER() . '" id="' . $id . '" name="' . $name . '" lifetime="' . $lifetime . '" />'
                . '</purge>'
            . '</CreateSystemRetentionPolicyRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'CreateSystemRetentionPolicyRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'cos' => [
                    'by' => CosBy::NAME()->value(),
                    '_content' => $value,
                ],
                'keep' => [
                    'policy' => [
                        '_jsns' => 'urn:zimbraMail',
                        'type' => Type::SYSTEM()->value(),
                        'id' => $id,
                        'name' => $name,
                        'lifetime' => $lifetime,
                    ],
                ],
                'purge' => [
                    'policy' => [
                        '_jsns' => 'urn:zimbraMail',
                        'type' => Type::USER()->value(),
                        'id' => $id,
                        'name' => $name,
                        'lifetime' => $lifetime,
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testCreateSystemRetentionPolicyApi()
    {
        $value = $this->faker->word;
        $id = $this->faker->word;
        $name = $this->faker->word;
        $lifetime = $this->faker->word;

        $cos = new CosSelector(CosBy::NAME(), $value);

        $policy = new Policy(Type::SYSTEM(), $id, $name, $lifetime);
        $keep = new PolicyHolder($policy);

        $policy = new Policy(Type::USER(), $id, $name, $lifetime);
        $purge = new PolicyHolder($policy);

        $this->api->createSystemRetentionPolicy(
            $cos, $keep, $purge
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin" xmlns:urn2="urn:zimbraMail">'
                . '<env:Body>'
                    . '<urn1:CreateSystemRetentionPolicyRequest>'
                        . '<urn1:cos by="' . CosBy::NAME() . '">' . $value . '</urn1:cos>'
                        . '<urn1:keep>'
                            . '<urn2:policy type="' . Type::SYSTEM() . '" id="' . $id . '" name="' . $name . '" lifetime="' . $lifetime . '" />'
                        . '</urn1:keep>'
                        . '<urn1:purge>'
                            . '<urn2:policy type="' . Type::USER() . '" id="' . $id . '" name="' . $name . '" lifetime="' . $lifetime . '" />'
                        . '</urn1:purge>'
                    . '</urn1:CreateSystemRetentionPolicyRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
