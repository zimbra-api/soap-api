<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\ModifyDelegatedAdminConstraints;
use Zimbra\Admin\Struct\ConstraintInfoValues;
use Zimbra\Admin\Struct\ConstraintInfo;
use Zimbra\Admin\Struct\ConstraintAttr;
use Zimbra\Enum\TargetType;

/**
 * Testcase class for ModifyDelegatedAdminConstraints.
 */
class ModifyDelegatedAdminConstraintsTest extends ZimbraAdminApiTestCase
{
    public function testModifyDelegatedAdminConstraintsRequest()
    {
        $value = $this->faker->word;
        $min = $this->faker->word;
        $max = $this->faker->word;
        $name = $this->faker->word;
        $id = $this->faker->uuid;

        $values = new ConstraintInfoValues([$value]);
        $constraint = new ConstraintInfo($min, $max, $values);
        $attr = new ConstraintAttr($constraint, $name);

        $req = new ModifyDelegatedAdminConstraints(
            TargetType::GROUP(), $id, $name, [$attr]
        );
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame('group', $req->getType()->value());
        $this->assertSame($id, $req->getId());
        $this->assertSame($name, $req->getName());
        $this->assertSame([$attr], $req->getAttrs()->all());

        $req->setType(TargetType::ACCOUNT())
            ->setId($id)
            ->setName($name)
            ->addAttr($attr);
        $this->assertSame('account', $req->getType()->value());
        $this->assertSame($id, $req->getId());
        $this->assertSame($name, $req->getName());
        $this->assertSame([$attr, $attr], $req->getAttrs()->all());
        $req->getAttrs()->remove(1);

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<ModifyDelegatedAdminConstraintsRequest type="' . TargetType::ACCOUNT() .'" id="' . $id . '" name="' . $name . '">'
                . '<a name="' . $name . '">'
                    . '<constraint>'
                        . '<min>' . $min . '</min>'
                        . '<max>' . $max . '</max>'
                        . '<values>'
                            . '<v>' . $value . '</v>'
                        . '</values>'
                    . '</constraint>'
                . '</a>'
            . '</ModifyDelegatedAdminConstraintsRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'ModifyDelegatedAdminConstraintsRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'type' => TargetType::ACCOUNT()->value(),
                'id' => $id,
                'name' => $name,
                'a' => [
                    [
                        'name' => $name,
                        'constraint' => [
                            'min' => $min,
                            'max' => $max,
                            'values' => [
                                'v' => [
                                    $value,
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testModifyDelegatedAdminConstraintsApi()
    {
        $value = $this->faker->word;
        $min = $this->faker->word;
        $max = $this->faker->word;
        $name = $this->faker->word;
        $id = $this->faker->uuid;

        $values = new ConstraintInfoValues([$value]);
        $constraint = new ConstraintInfo($min, $max, $values);
        $attr = new ConstraintAttr($constraint, $name);

        $this->api->modifyDelegatedAdminConstraints(
            TargetType::ACCOUNT(), $id, $name, [$attr]
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:ModifyDelegatedAdminConstraintsRequest type="' . TargetType::ACCOUNT() . '" id="' . $id . '" name="' . $name . '">'
                        . '<urn1:a name="' . $name . '">'
                            . '<urn1:constraint>'
                                . '<urn1:min>' . $min . '</urn1:min>'
                                . '<urn1:max>' . $max . '</urn1:max>'
                                . '<urn1:values>'
                                    . '<urn1:v>' . $value . '</urn1:v>'
                                . '</urn1:values>'
                            . '</urn1:constraint>'
                        . '</urn1:a>'
                    . '</urn1:ModifyDelegatedAdminConstraintsRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
