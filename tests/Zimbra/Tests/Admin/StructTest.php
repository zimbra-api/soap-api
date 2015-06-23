<?php

namespace Zimbra\Tests\Admin;

use Zimbra\Tests\ZimbraTestCase;

use Zimbra\Enum\AclType;
use Zimbra\Enum\AuthScheme;
use Zimbra\Enum\AutoProvPrincipalBy as PrincipalBy;
use Zimbra\Enum\DataSourceBy;
use Zimbra\Enum\CacheEntryBy;
use Zimbra\Enum\CalendarResourceBy as CalResBy;
use Zimbra\Enum\CosBy;
use Zimbra\Enum\DataSourceType;
use Zimbra\Enum\DistributionListBy as DLBy;
use Zimbra\Enum\DomainBy;
use Zimbra\Enum\GranteeType;
use Zimbra\Enum\GranteeBy;
use Zimbra\Enum\InterestType;
use Zimbra\Enum\LoggingLevel;
use Zimbra\Enum\QueueAction;
use Zimbra\Enum\QueueActionBy;
use Zimbra\Enum\ServerBy;
use Zimbra\Enum\TargetType;
use Zimbra\Enum\TargetBy;
use Zimbra\Enum\Type;
use Zimbra\Enum\UcServiceBy;
use Zimbra\Enum\ZimletStatus;
use Zimbra\Enum\XmppComponentBy as XmppBy;

/**
 * Testcase class for admin struct.
 */
class StructTest extends ZimbraTestCase
{
    public function testAdminAttrsImpl()
    {
        $stub = $this->getMockForAbstractClass('Zimbra\Admin\Struct\AdminAttrsImpl');

        $key1 = self::randomName();
        $value1 = md5(self::randomString());
        $key2 = self::randomName();
        $value2 = md5(self::randomString());
        $key3 = self::randomName();
        $value3 = md5(self::randomString());

        $attr1 = new \Zimbra\Struct\KeyValuePair($key1, $value1);
        $attr2 = new \Zimbra\Struct\KeyValuePair($key2, $value2);
        $attr3 = new \Zimbra\Struct\KeyValuePair($key3, $value3);
        $stub->addAttr($attr1)->getAttrs()->addAll([$attr2, $attr3]);
        foreach ($stub->getAttrs() as $attr)
        {
            $this->assertInstanceOf('\Zimbra\Struct\KeyValuePair', $attr);
        }

        $arr = [
            'attrs' => [
                'a' => [
                    [
                        'n' => $key1,
                        '_content' => $value1,
                    ],
                    [
                        'n' => $key2,
                        '_content' => $value2,
                    ],
                    [
                        'n' => $key3,
                        '_content' => $value3,
                    ],
                ],
            ],
        ];
        $this->assertEquals($arr, $stub->toArray());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<attrs>'
                . '<a n="' . $key1 . '">' . $value1 . '</a>'
                . '<a n="' . $key2 . '">' . $value2 . '</a>'
                . '<a n="' . $key3 . '">' . $value3 . '</a>'
            . '</attrs>';
        $this->assertXmlStringEqualsXmlString($xml, $stub->toXml()->asXml());
    }

    public function testAttachmentIdAttrib()
    {
        $aid = self::randomName();

        $content = new \Zimbra\Admin\Struct\AttachmentIdAttrib($aid);
        $this->assertSame($aid, $content->getAttachmentId());
        $content->setAttachmentId($aid);
        $this->assertSame($aid, $content->getAttachmentId());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<content aid="' . $aid . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $content);

        $array = [
            'content' => [
                'aid' => $aid,
            ],
        ];
        $this->assertEquals($array, $content->toArray());
    }

    public function testCacheEntrySelector()
    {
        $value = md5(self::randomString());

        $entry = new \Zimbra\Admin\Struct\CacheEntrySelector(CacheEntryBy::NAME(), $value);
        $this->assertTrue($entry->getBy()->is('name'));
        $this->assertSame($value, $entry->getValue());

        $entry->setBy(CacheEntryBy::ID());
        $this->assertTrue($entry->getBy()->is('id'));

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<entry by="' . CacheEntryBy::ID() . '">' . $value . '</entry>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $entry);

        $array = [
            'entry' => [
                'by' => CacheEntryBy::ID()->value(),
                '_content' => $value,
            ],
        ];
        $this->assertEquals($array, $entry->toArray());
    }

    public function testCacheSelector()
    {
        $value1 = md5(self::randomString());
        $value2 = md5(self::randomString());
        $types = self::randomAttrs(\Zimbra\Enum\CacheType::enums());

        $entry1 = new \Zimbra\Admin\Struct\CacheEntrySelector(CacheEntryBy::ID(), $value1);
        $entry2 = new \Zimbra\Admin\Struct\CacheEntrySelector(CacheEntryBy::NAME(), $value2);

        $cache = new \Zimbra\Admin\Struct\CacheSelector($types, false, [$entry1]);
        $this->assertSame($types, $cache->getTypes());
        $this->assertFalse($cache->isAllServers());
        $this->assertSame([$entry1], $cache->getEntries()->all());

        $cache->setTypes($types)
              ->setAllServers(true)
              ->addEntry($entry2);
        $this->assertSame($types, $cache->getTypes());
        $this->assertTrue($cache->isAllServers());
        $this->assertSame([$entry1, $entry2], $cache->getEntries()->all());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<cache type="' . $types . '" allServers="true">'
                . '<entry by="' . CacheEntryBy::ID() . '">' . $value1 . '</entry>'
                . '<entry by="' . CacheEntryBy::NAME() . '">' . $value2 . '</entry>'
            . '</cache>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $cache);

        $array = [
            'cache' => [
                'type' => $types,
                'allServers' => true,
                'entry' => [
                    [
                        'by' => CacheEntryBy::ID()->value(),
                        '_content' => $value1,
                    ],
                    [
                        'by' => CacheEntryBy::NAME()->value(),
                        '_content' => $value2,
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $cache->toArray());
    }

    public function testCalendarResourceSelector()
    {
        $value = md5(self::randomString());
        $cal = new \Zimbra\Admin\Struct\CalendarResourceSelector(CalResBy::ID(), $value);
        $this->assertTrue($cal->getBy()->is('id'));
        $this->assertSame($value, $cal->getValue());

        $cal->setBy(CalResBy::NAME());
        $this->assertTrue($cal->getBy()->is('name'));

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<calresource by="' . CalResBy::NAME() . '">' . $value . '</calresource>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $cal);

        $array = [
            'calresource' => [
                'by' => CalResBy::NAME()->value(),
                '_content' => $value,
            ],
        ];
        $this->assertEquals($array, $cal->toArray());
    }

    public function testCalTZInfo()
    {
        $std_mon = mt_rand(1, 12);
        $std_hour = mt_rand(0, 23);
        $std_min = mt_rand(0, 59);
        $std_sec = mt_rand(0, 59);
        $standard = new \Zimbra\Struct\TzOnsetInfo($std_mon, $std_hour, $std_min, $std_sec);

        $day_mon = mt_rand(1, 12);
        $day_hour = mt_rand(0, 23);
        $day_min = mt_rand(0, 59);
        $day_sec = mt_rand(0, 59);
        $daylight = new \Zimbra\Struct\TzOnsetInfo($day_mon, $day_hour, $day_min, $day_sec);

        $id = self::randomName();
        $stdname = self::randomName();
        $dayname = self::randomName();
        $stdoff = mt_rand(0, 100);
        $dayoff = mt_rand(0, 100);
        $tzi = new \Zimbra\Admin\Struct\CalTZInfo($id, $stdoff, $dayoff, $daylight, $standard, $stdname, $dayname);

        $this->assertSame($id, $tzi->getId());
        $this->assertSame($stdoff, $tzi->getTzStdOffset());
        $this->assertSame($dayoff, $tzi->getTzDayOffset());
        $this->assertSame($stdname, $tzi->getStandardTZName());
        $this->assertSame($dayname, $tzi->getDaylightTZName());
        $this->assertSame($daylight, $tzi->getStandardTzOnset());
        $this->assertSame($standard, $tzi->getDaylightTzOnset());

        $tzi->setId($id)
            ->setTzStdOffset($stdoff)
            ->setTzDayOffset($dayoff)
            ->setStandardTZName($stdname)
            ->setDaylightTZName($dayname)
            ->setStandardTzOnset($standard)
            ->setDaylightTzOnset($daylight);
        $this->assertSame($id, $tzi->getId());
        $this->assertSame($stdoff, $tzi->getTzStdOffset());
        $this->assertSame($dayoff, $tzi->getTzDayOffset());
        $this->assertSame($stdname, $tzi->getStandardTZName());
        $this->assertSame($dayname, $tzi->getDaylightTZName());
        $this->assertSame($standard, $tzi->getStandardTzOnset());
        $this->assertSame($daylight, $tzi->getDaylightTzOnset());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<tz id="' . $id . '" stdoff="' . $stdoff . '" dayoff="' . $dayoff . '" stdname="' . $stdname . '" dayname="' . $dayname . '">'
                . '<standard mon="' . $std_mon . '" hour="' . $std_hour . '" min="' . $std_min . '" sec="' . $std_sec . '" />'
                . '<daylight mon="' . $day_mon . '" hour="' . $day_hour . '" min="' . $day_min . '" sec="' . $day_sec . '" />'
            . '</tz>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $tzi);

        $array = [
            'tz' => [
                'id' => $id,
                'stdoff' => $stdoff,
                'dayoff' => $dayoff,
                'stdname' => $stdname,
                'dayname' => $dayname,
                'standard' => [
                    'mon' => $std_mon,
                    'hour' => $std_hour,
                    'min' => $std_min,
                    'sec' => $std_sec,
                ],
                'daylight' => [
                    'mon' => $day_mon,
                    'hour' => $day_hour,
                    'min' => $day_min,
                    'sec' => $day_sec,
                ],
            ],
        ];
        $this->assertEquals($array, $tzi->toArray());
    }

    public function testCheckDirSelector()
    {
        $path = self::randomName();
        $dir = new \Zimbra\Admin\Struct\CheckDirSelector($path, false);
        $this->assertSame($path, $dir->getPath());
        $this->assertFalse($dir->isCreate());

        $dir->setPath($path)
            ->setCreate(true);
        $this->assertSame($path, $dir->getPath());
        $this->assertTrue($dir->isCreate());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<directory path="' . $path . '" create="true" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $dir);

        $array = [
            'directory' => [
                'path' => $path,
                'create' => true,
            ],
        ];
        $this->assertEquals($array, $dir->toArray());
    }

    public function testConstraintInfoValues()
    {
        $value1 = md5(self::randomString());
        $value2 = md5(self::randomString());

        $values = new \Zimbra\Admin\Struct\ConstraintInfoValues([$value1]);
        $this->assertSame([$value1], $values->getValues()->all());
        $values->addValue($value2);
        $this->assertSame([$value1, $value2], $values->getValues()->all());

        $xml = '<?xml version="1.0"?>' . "\n"
                . '<values>'
                    . '<v>' . $value1 . '</v>'
                    . '<v>' . $value2 . '</v>'
                . '</values>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $values);

        $array = [
            'values' => [
                'v' => [
                    $value1,
                    $value2,
                ],
            ],
        ];
        $this->assertEquals($array, $values->toArray());
    }

    public function testConstraintInfo()
    {
        $value = md5(self::randomString());
        $max = md5(self::randomString());
        $min = md5(self::randomString());

        $values = new \Zimbra\Admin\Struct\ConstraintInfoValues([$value]);
        $constraint = new \Zimbra\Admin\Struct\ConstraintInfo($max, $min, $values);
        $this->assertSame($max, $constraint->getMin());
        $this->assertSame($min, $constraint->getMax());
        $this->assertSame($values, $constraint->getValues());

        $constraint->setMin($min)
            ->setMax($max)
            ->setValues($values);
        $this->assertSame($min, $constraint->getMin());
        $this->assertSame($max, $constraint->getMax());
        $this->assertSame($values, $constraint->getValues());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<constraint>'
                . '<min>' . $min . '</min>'
                . '<max>' . $max . '</max>'
                . '<values>'
                    . '<v>' . $value . '</v>'
                . '</values>'
            . '</constraint>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $constraint);

        $array = [
            'constraint' => [
                'min' => $min,
                'max' => $max,
                'values' => [
                    'v' => [
                        $value,
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $constraint->toArray());
    }

    public function testConstraintAttr()
    {
        $name = self::randomName();
        $value = md5(self::randomString());
        $max = md5(self::randomString());
        $min = md5(self::randomString());

        $values = new \Zimbra\Admin\Struct\ConstraintInfoValues([$value]);
        $constraint = new \Zimbra\Admin\Struct\ConstraintInfo($min, $max, $values);
        $attr = new \Zimbra\Admin\Struct\ConstraintAttr($constraint, $name);
        $this->assertSame($name, $attr->getName());
        $this->assertSame($constraint, $attr->getConstraint());

        $attr->setName($name)
            ->setConstraint($constraint);

        $this->assertSame($name, $attr->getName());
        $this->assertSame($constraint, $attr->getConstraint());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<a name="' . $name . '">'
                . '<constraint>'
                    . '<min>' . $min . '</min>'
                    . '<max>' . $max . '</max>'
                    . '<values>'
                        . '<v>' . $value . '</v>'
                    . '</values>'
                . '</constraint>'
            . '</a>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $attr);

        $array = [
            'a' => [
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
        ];
        $this->assertEquals($array, $attr->toArray());
    }

    public function testCookieSpec()
    {
        $name = self::randomName();
        $cookie = new \Zimbra\Admin\Struct\CookieSpec($name);
        $this->assertSame($name, $cookie->getName());

        $cookie->setName($name);
        $this->assertSame($name, $cookie->getName());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<cookie name="' . $name . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $cookie);

        $array = [
            'cookie' => [
                'name' => $name,
            ],
        ];
        $this->assertEquals($array, $cookie->toArray());
    }

    public function testCosSelector()
    {
        $value = self::randomName();
        $cos = new \Zimbra\Admin\Struct\CosSelector(CosBy::ID(), $value);
        $this->assertTrue($cos->getBy()->is('id'));
        $this->assertSame($value, $cos->getValue());

        $cos->setBy(CosBy::NAME());
        $this->assertTrue($cos->getBy()->is('name'));

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<cos by="' . CosBy::NAME() . '">' . $value . '</cos>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $cos);

        $array = [
            'cos' => [
                'by' => CosBy::NAME()->value(),
                '_content' => $value,
            ],
        ];
        $this->assertEquals($array, $cos->toArray());
    }

    public function testDataSourceSpecifier()
    {
        $name = self::randomName();
        $key = self::randomName();
        $value = self::randomName();

        $ds = new \Zimbra\Admin\Struct\DataSourceSpecifier(DataSourceType::IMAP(), $name);
        $this->assertTrue($ds->getType()->is('imap'));
        $this->assertSame($name, $ds->getName());

        $attr = new \Zimbra\Struct\KeyValuePair($key, $value);
        $ds->setType(DataSourceType::POP3())
           ->setName($name)
           ->addAttr($attr);
        $this->assertTrue($ds->getType()->is('pop3'));
        $this->assertSame($name, $ds->getName());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<dataSource type="' . DataSourceType::POP3() . '" name="' . $name . '">'
                . '<a n="' . $key . '">' . $value . '</a>'
            . '</dataSource>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $ds);

        $array = [
            'dataSource' => [
                'type' => DataSourceType::POP3()->value(),
                'name' => $name,
                'a' => [
                    [
                        'n' => $key,
                        '_content' => $value,
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $ds->toArray());
    }

    public function testDeviceId()
    {
        $id = self::randomName();
        $device = new \Zimbra\Admin\Struct\DeviceId($id);
        $this->assertSame($id, $device->getId());

        $device->setId($id);
        $this->assertSame($id, $device->getId());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<device id="' . $id . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $device);

        $array = [
            'device' => [
                'id' => $id,
            ],
        ];
        $this->assertEquals($array, $device->toArray());
    }

    public function testDistributionListSelector()
    {
        $value = self::randomName();
        $dl = new \Zimbra\Admin\Struct\DistributionListSelector(DLBy::ID(), $value);
        $this->assertTrue($dl->getBy()->is('id'));
        $this->assertSame($value, $dl->getValue());

        $dl->setBy(DLBy::NAME());
        $this->assertTrue($dl->getBy()->is('name'));

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<dl by="' . DLBy::NAME() . '">' . $value . '</dl>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $dl);

        $array = [
            'dl' => [
                'by' => DLBy::NAME()->value(),
                '_content' => $value,
            ],
        ];
        $this->assertEquals($array, $dl->toArray());
    }

    public function testDomainSelector()
    {
        $value = self::randomName();
        $domain = new \Zimbra\Admin\Struct\DomainSelector(DomainBy::ID(), $value);
        $this->assertTrue($domain->getBy()->is('id'));
        $this->assertSame($value, $domain->getValue());

        $domain->setBy(DomainBy::NAME());
        $this->assertTrue($domain->getBy()->is('name'));

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<domain by="' . DomainBy::NAME() . '">' . $value . '</domain>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $domain);

        $array = [
            'domain' => [
                'by' => DomainBy::NAME()->value(),
                '_content' => $value,
            ],
        ];
        $this->assertEquals($array, $domain->toArray());
    }

    public function testEffectiveRightsTargetSelector()
    {
        $value = self::randomName();
        $target = new \Zimbra\Admin\Struct\EffectiveRightsTargetSelector(
            TargetType::DOMAIN(), TargetBy::ID(), $value
        );
        $this->assertTrue($target->getType()->is('domain'));
        $this->assertSame($value, $target->getValue());
        $this->assertSame('id', $target->getBy()->value());

        $target->setType(TargetType::ACCOUNT())
               ->setBy(TargetBy::NAME());

        $this->assertSame('account', $target->getType()->value());
        $this->assertSame('name', $target->getBy()->value());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<target type="' . TargetType::ACCOUNT() . '" by="' . TargetBy::NAME() . '">' . $value . '</target>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $target);

        $array = [
            'target' => [
                'type' => TargetType::ACCOUNT()->value(),
                '_content' => $value,
                'by' => TargetBy::NAME()->value(),
            ],
        ];
        $this->assertEquals($array, $target->toArray());
    }

    public function testExchangeAuthSpec()
    {
        $url = self::randomName();
        $user = self::randomName();
        $pass = self::randomName();
        $type = self::randomName();

        $exc = new \Zimbra\Admin\Struct\ExchangeAuthSpec($url, $user, $pass, AuthScheme::BASIC(), $type);
        $this->assertSame($url, $exc->getUrl());
        $this->assertSame($user, $exc->getAuthUserName());
        $this->assertSame($pass, $exc->getAuthPassword());
        $this->assertSame('basic', $exc->getAuthScheme()->value());
        $this->assertSame($type, $exc->getType());

        $exc->setUrl($url)
            ->setAuthUserName($user)
            ->setAuthPassword($pass)
            ->setAuthScheme(AuthScheme::FORM())
            ->setType($type);

        $this->assertSame($url, $exc->getUrl());
        $this->assertSame($user, $exc->getAuthUserName());
        $this->assertSame($pass, $exc->getAuthPassword());
        $this->assertSame('form', $exc->getAuthScheme()->value());
        $this->assertSame($type, $exc->getType());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<auth url="' . $url . '" user="' . $user . '" pass="' . $pass . '" scheme="' . AuthScheme::FORM() . '" type="' . $type . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $exc);

        $array = [
            'auth' => [
                'url' => $url,
                'user' => $user,
                'pass' => $pass,
                'scheme' => AuthScheme::FORM()->value(),
                'type' => $type,
            ],
        ];
        $this->assertEquals($array, $exc->toArray());
    }

    public function testExportAndDeleteItemSpec()
    {
        $id = mt_rand(1, 100);
        $version = mt_rand(1, 100);

        $item = new \Zimbra\Admin\Struct\ExportAndDeleteItemSpec($id, $version);
        $this->assertSame($id, $item->getId());
        $this->assertSame($version, $item->getVersion());

        $item->setId($id)
             ->setVersion($version);
        $this->assertSame($id, $item->getId());
        $this->assertSame($version, $item->getVersion());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<item id="' . $id . '" version="' . $version . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $item);

        $array = [
            'item' => [
                'id' => $id,
                'version' => $version,
            ],
        ];
        $this->assertEquals($array, $item->toArray());
    }

    public function testExportAndDeleteMailboxSpec()
    {
        $id = mt_rand(1, 100);
        $version = mt_rand(1, 100);
        $item1 = new \Zimbra\Admin\Struct\ExportAndDeleteItemSpec($id, $version);
        $item2 = new \Zimbra\Admin\Struct\ExportAndDeleteItemSpec($version, $id);

        $mbox = new \Zimbra\Admin\Struct\ExportAndDeleteMailboxSpec($id, [$item1]);
        $this->assertSame($id, $mbox->getId());
        $this->assertSame([$item1], $mbox->getItems()->all());

        $mbox->setId($id)
             ->addItem($item2);

        $this->assertSame($id, $mbox->getId());
        $this->assertSame([$item1, $item2], $mbox->getItems()->all());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<mbox id="' . $id . '">'
                . '<item id="' . $id . '" version="' . $version . '" />'
                . '<item id="' . $version . '" version="' . $id . '" />'
            . '</mbox>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $mbox);

        $array = [
            'mbox' => [
                'id' => $id,
                'item' => [
                    [
                        'id' => $id,
                        'version' => $version,
                    ],
                    [
                        'id' => $version,
                        'version' => $id,
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $mbox->toArray());
    }

    public function testGranteeSelector()
    {
        $value = self::randomName();
        $secret = self::randomName();

        $grantee = new \Zimbra\Admin\Struct\GranteeSelector(
            $value, GranteeType::ALL(), GranteeBy::NAME(), $secret, false
        );
        $this->assertSame('all', $grantee->getType()->value());
        $this->assertSame('name', $grantee->getBy()->value());
        $this->assertSame($value, $grantee->getValue());
        $this->assertSame($secret, $grantee->getSecret());
        $this->assertFalse($grantee->getAll());

        $grantee->setType(GranteeType::USR())
                ->setBy(GranteeBy::ID())
                ->setSecret($secret)
                ->setAll(true);
        $this->assertSame('usr', $grantee->getType()->value());
        $this->assertSame('id', $grantee->getBy()->value());
        $this->assertSame($secret, $grantee->getSecret());
        $this->assertTrue($grantee->getAll());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<grantee type="' . GranteeType::USR() . '" by="' . GranteeBy::ID() . '" secret="' . $secret . '" all="true">' . $value . '</grantee>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $grantee);

        $array = [
            'grantee' => [
                '_content' => $value,
                'type' => GranteeType::USR()->value(),
                'by' => GranteeBy::ID()->value(),
                'secret' => $secret,
                'all' => true,
            ],
        ];
        $this->assertEquals($array, $grantee->toArray());
    }

    public function testHostName()
    {
        $name = self::randomName();
        $host = new \Zimbra\Admin\Struct\HostName($name);
        $this->assertSame($name, $host->getHostName());

        $host->setHostName($name);
        $this->assertSame($name, $host->getHostName());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<hostname hn="' . $name . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $host);

        $array = [
            'hostname' => [
                'hn' => $name,
            ],
        ];
        $this->assertEquals($array, $host->toArray());
    }

    public function testIdAndAction()
    {
        $id = self::randomName();
        $action = self::randomValue(['bug72174', 'wiki', 'contactGroup']);

        $ia = new \Zimbra\Admin\Struct\IdAndAction($id, $action);
        $this->assertSame($id, $ia->getId());
        $this->assertSame($action, $ia->getAction());

        $ia->setId($id)
           ->setAction($action);
        $this->assertSame($id, $ia->getId());
        $this->assertSame($action, $ia->getAction());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<ia id="' . $id . '" action="' . $action . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $ia);

        $array = [
            'ia' => [
                'id' => $id,
                'action' => $action,
            ],
        ];
        $this->assertEquals($array, $ia->toArray());
    }

    public function testIdStatus()
    {
        $id = self::randomName();
        $status = self::randomName();

        $is = new \Zimbra\Admin\Struct\IdStatus($id, $status);
        $this->assertSame($id, $is->getId());
        $this->assertSame($status, $is->getStatus());

        $is->setId($id)
           ->setStatus($status);
        $this->assertSame($id, $is->getId());
        $this->assertSame($status, $is->getStatus());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<device id="' . $id . '" status="' . $status . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $is);

        $array = [
            'device' => [
                'id' => $id,
                'status' => $status,
            ],
        ];
        $this->assertEquals($array, $is->toArray());
    }

    public function testIntegerValueAttrib()
    {
        $value = mt_rand(0, 100);
        $attr = new \Zimbra\Admin\Struct\IntegerValueAttrib($value);
        $this->assertSame($value, $attr->getValue());

        $attr->setValue($value);
        $this->assertSame($value, $attr->getValue());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<a value="' . $value . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $attr);

        $array = [
            'a' => [
                'value' => $value,
            ],
        ];
        $this->assertEquals($array, $attr->toArray());
    }

    public function testIntIdAttr()
    {
        $value = mt_rand(0, 100);
        $attr = new \Zimbra\Admin\Struct\IntIdAttr($value);
        $this->assertSame($value, $attr->getId());

        $attr->setId($value);
        $this->assertSame($value, $attr->getId());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<attr id="' . $value . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $attr);

        $array = [
            'attr' => [
                'id' => $value,
            ],
        ];
        $this->assertEquals($array, $attr->toArray());
    }

    public function testLimitedQuery()
    {
        $limit = mt_rand(0, 10);
        $value = self::randomName();

        $query = new \Zimbra\Admin\Struct\LimitedQuery($limit, $value);
        $this->assertSame($limit, $query->getLimit());
        $this->assertSame($value, $query->getValue());

        $query->setLimit($limit);
        $this->assertSame($limit, $query->getLimit());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<query limit="' . $limit . '">' . $value . '</query>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $query);

        $array = [
            'query' => [
                'limit' => $limit,
                '_content' => $value,
            ],
        ];
        $this->assertEquals($array, $query->toArray());
    }

    public function testLoggerInfo()
    {
        $value = self::randomName();

        $logger = new \Zimbra\Admin\Struct\LoggerInfo($value, LoggingLevel::ERROR());
        $this->assertSame($value, $logger->getCategory());
        $this->assertSame('error', $logger->getLevel()->value());

        $logger->setCategory($value)
               ->setLevel(LoggingLevel::INFO());
        $this->assertSame($value, $logger->getCategory());
        $this->assertSame('info', $logger->getLevel()->value());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<logger category="' . $value . '" level="' . LoggingLevel::INFO() . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $logger);

        $array = [
            'logger' => [
                'category' => $value,
                'level' => LoggingLevel::INFO()->value(),
            ],
        ];
        $this->assertEquals($array, $logger->toArray());
    }

    public function testMailboxByAccountIdSelector()
    {
        $id = self::randomName();
        $mbox = new \Zimbra\Admin\Struct\MailboxByAccountIdSelector($id);
        $this->assertSame($id, $mbox->getId());

        $mbox->setId($id);
        $this->assertSame($id, $mbox->getId());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<mbox id="' . $id . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $mbox);

        $array = [
            'mbox' => [
                'id' => $id,
            ],
        ];
        $this->assertEquals($array, $mbox->toArray());
    }

    public function testMailQueueAction()
    {
        $name = self::randomName();
        $value = self::randomName();
        $limit = mt_rand(0, 100);
        $offset = mt_rand(0, 100);

        $attr = new \Zimbra\Admin\Struct\ValueAttrib($value);
        $field = new \Zimbra\Admin\Struct\QueueQueryField($name, [$attr]);
        $query = new \Zimbra\Admin\Struct\QueueQuery([$field], $limit, $offset);
        $action = new \Zimbra\Admin\Struct\MailQueueAction($query, QueueAction::REQUEUE(), QueueActionBy::ID());

        $this->assertSame($query, $action->getQuery());
        $this->assertSame('requeue', $action->getOp()->value());
        $this->assertSame('id', $action->getBy()->value());

        $action->setQuery($query)
               ->setOp(QueueAction::HOLD())
               ->setBy(QueueActionBy::QUERY());

        $this->assertSame($query, $action->getQuery());
        $this->assertSame('hold', $action->getOp()->value());
        $this->assertSame('query', $action->getBy()->value());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<action op="' . QueueAction::HOLD() . '" by="' . QueueActionBy::QUERY() . '">'
                . '<query limit="' . $limit . '" offset="' . $offset . '">'
                    . '<field name="' . $name . '">'
                        . '<match value="' . $value . '" />'
                    . '</field>'
                . '</query>'
            . '</action>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $action);

        $array = [
            'action' => [
                'op' => QueueAction::HOLD()->value(),
                'by' => QueueActionBy::QUERY()->value(),
                'query' => [
                    'limit' => $limit,
                    'offset' => $offset,
                    'field' => [
                        [
                            'name' => $name,
                            'match' => [
                                [
                                    'value' => $value,
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $action->toArray());
    }

    public function testMailQueueQuery()
    {
        $name = self::randomName();
        $value = self::randomName();
        $limit = mt_rand(0, 100);
        $offset = mt_rand(0, 100);
        $wait = mt_rand(0, 100);

        $attr = new \Zimbra\Admin\Struct\ValueAttrib($value);
        $field = new \Zimbra\Admin\Struct\QueueQueryField($name, [$attr]);
        $query = new \Zimbra\Admin\Struct\QueueQuery([$field], $limit, $offset);

        $queue = new \Zimbra\Admin\Struct\MailQueueQuery($query, $name, false, $wait);
        $this->assertSame($query, $queue->getQuery());
        $this->assertSame($name, $queue->getQueueName());
        $this->assertFalse($queue->getScan());
        $this->assertSame($wait, $queue->getWaitSeconds());

        $queue->setQuery($query)
              ->setQueueName($name)
              ->setScan(true)
              ->setWaitSeconds($wait);
        $this->assertSame($query, $queue->getQuery());
        $this->assertSame($name, $queue->getQueueName());
        $this->assertTrue($queue->getScan());
        $this->assertSame($wait, $queue->getWaitSeconds());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<queue name="' . $name . '" scan="true" wait="' . $wait . '">'
                . '<query limit="' . $limit . '" offset="' . $offset . '">'
                    . '<field name="' . $name . '">'
                        . '<match value="' . $value . '" />'
                    . '</field>'
                . '</query>'
            . '</queue>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $queue);

        $array = [
            'queue' => [
                'name' => $name,
                'scan' => true,
                'wait' => $wait,
                'query' => [
                    'limit' => $limit,
                    'offset' => $offset,
                    'field' => [
                        [
                            'name' => $name,
                            'match' => [
                                [
                                    'value' => $value,
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $queue->toArray());
    }

    public function testMailQueueWithAction()
    {
        $name = self::randomName();
        $value = self::randomName();
        $limit = mt_rand(0, 100);
        $offset = mt_rand(0, 100);

        $attr = new \Zimbra\Admin\Struct\ValueAttrib($value);
        $field = new \Zimbra\Admin\Struct\QueueQueryField($name, [$attr]);
        $query = new \Zimbra\Admin\Struct\QueueQuery([$field], $limit, $offset);
        $action = new \Zimbra\Admin\Struct\MailQueueAction($query, QueueAction::HOLD(), QueueActionBy::QUERY());

        $queue = new \Zimbra\Admin\Struct\MailQueueWithAction($action, $name);
        $this->assertSame($name, $queue->getName());
        $this->assertSame($action, $queue->getAction());

        $queue->setAction($action)
              ->setName($name);
        $this->assertSame($name, $queue->getName());
        $this->assertSame($action, $queue->getAction());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<queue name="' . $name . '">'
                . '<action op="' . QueueAction::HOLD() . '" by="' . QueueActionBy::QUERY() . '">'
                    . '<query limit="' . $limit . '" offset="' . $offset . '">'
                        . '<field name="' . $name . '">'
                            . '<match value="' . $value . '" />'
                        . '</field>'
                    . '</query>'
                . '</action>'
            . '</queue>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $queue);

        $array = [
            'queue' => [
                'name' => $name,
                'action' => [
                    'op' => QueueAction::HOLD()->value(),
                    'by' => QueueActionBy::QUERY()->value(),
                    'query' => [
                        'limit' => $limit,
                        'offset' => $offset,
                        'field' => [
                            [
                                'name' => $name,
                                'match' => [
                                    [
                                        'value' => $value
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $queue->toArray());
    }

    public function testNames()
    {
        $name = self::randomName();
        $names = new \Zimbra\Admin\Struct\Names($name);
        $this->assertSame($name, $names->getName());

        $names->setName($name);
        $this->assertSame($name, $names->getName());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<name name="' . $name . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $names);

        $array = [
            'name' => [
                'name' => $name,
            ],
        ];
        $this->assertEquals($array, $names->toArray());
    }

    public function testOffset()
    {
        $value = mt_rand(0, 100);
        $offset = new \Zimbra\Admin\Struct\Offset($value);
        $this->assertSame($value, $offset->getOffset());

        $offset->setOffset($value);
        $this->assertSame($value, $offset->getOffset());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<offset offset="' . $value . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $offset);

        $array = [
            'offset' => [
                'offset' => $value,
            ],
        ];
        $this->assertEquals($array, $offset->toArray());
    }

    public function testPackageSelector()
    {
        $name = self::randomName();
        $package = new \Zimbra\Admin\Struct\PackageSelector($name);
        $this->assertSame($name, $package->getName());

        $package->setName($name);
        $this->assertSame($name, $package->getName());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<package name="' . $name . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $package);

        $array = [
            'package' => [
                'name' => $name,
            ],
        ];
        $this->assertEquals($array, $package->toArray());
    }

    public function testPolicy()
    {
        $id = self::randomName();
        $name = self::randomName();
        $lifetime = self::randomName();

        $policy = new \Zimbra\Admin\Struct\Policy(Type::SYSTEM(), $id, $name, $lifetime);
        $this->assertSame('system', $policy->getType()->value());
        $this->assertSame($id, $policy->getId());
        $this->assertSame($name, $policy->getName());
        $this->assertSame($lifetime, $policy->getLifetime());

        $policy->setType(Type::USER())
               ->setId($id)
               ->setName($name)
               ->setLifetime($lifetime);
        $this->assertSame('user', $policy->getType()->value());
        $this->assertSame($id, $policy->getId());
        $this->assertSame($name, $policy->getName());
        $this->assertSame($lifetime, $policy->getLifetime());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<policy type="' . Type::USER() . '" id="' . $id . '" name="' . $name . '" lifetime="' . $lifetime . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $policy);

        $array = [
            'policy' => [
                '_jsns' => 'urn:zimbraMail',
                'type' => Type::USER()->value(),
                'id' => $id,
                'name' => $name,
                'lifetime' => $lifetime,
            ],
        ];
        $this->assertEquals($array, $policy->toArray());
    }

    public function testPolicyHolder()
    {
        $id = self::randomName();
        $name = self::randomName();
        $lifetime = self::randomName();
        $policy = new \Zimbra\Admin\Struct\Policy(Type::SYSTEM(), $id, $name, $lifetime);

        $holder = new \Zimbra\Admin\Struct\PolicyHolder($policy);
        $this->assertSame($policy, $holder->getPolicy());
        $holder->setPolicy($policy);
        $this->assertSame($policy, $holder->getPolicy());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<holder>'
                . '<policy xmlns="urn:zimbraMail" type="' . Type::SYSTEM() . '" id="' . $id . '" name="' . $name . '" lifetime="' . $lifetime . '" />'
            . '</holder>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $holder);

        $array = [
            'holder' => [
                'policy' => [
                    '_jsns' => 'urn:zimbraMail',
                    'type' => Type::SYSTEM()->value(),
                    'id' => $id,
                    'name' => $name,
                    'lifetime' => $lifetime,
                ],
            ],
        ];
        $this->assertEquals($array, $holder->toArray());
    }

    public function testPrincipalSelector()
    {
        $value = self::randomName();

        $pri = new \Zimbra\Admin\Struct\PrincipalSelector(PrincipalBy::DN(), $value);
        $this->assertSame('dn', $pri->getBy()->value());
        $this->assertSame($value, $pri->getValue());

        $pri->setBy(PrincipalBy::NAME());
        $this->assertSame('name', $pri->getBy()->value());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<principal by="' . PrincipalBy::NAME() . '">' . $value . '</principal>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $pri);

        $array = [
            'principal' => [
                'by' => PrincipalBy::NAME()->value(),
                '_content' => $value,
            ],
        ];
        $this->assertEquals($array, $pri->toArray());
    }

    public function testQueueQueryField()
    {
        $value1 = self::randomName();
        $value2 = self::randomName();
        $name = self::randomName();

        $match1 = new \Zimbra\Admin\Struct\ValueAttrib($value1);
        $match2 = new \Zimbra\Admin\Struct\ValueAttrib($value2);

        $field = new \Zimbra\Admin\Struct\QueueQueryField($name, [$match1]);
        $this->assertSame($name, $field->getName());
        $this->assertSame([$match1], $field->getMatches()->all());

        $field->setName($name)
              ->addMatch($match2);
        $this->assertSame($name, $field->getName());
        $this->assertSame([$match1, $match2], $field->getMatches()->all());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<field name="' . $name . '">'
                . '<match value="' . $value1 . '" />'
                . '<match value="' . $value2 . '" />'
            . '</field>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $field);

        $array = [
            'field' => [
                'name' => $name,
                'match' => [
                    [
                        'value' => $value1,
                    ],
                    [
                        'value' => $value2,
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $field->toArray());
    }

    public function testQueueQuery()
    {
        $name = self::randomName();
        $value = self::randomName();
        $limit = mt_rand(0, 100);
        $offset = mt_rand(0, 100);

        $match = new \Zimbra\Admin\Struct\ValueAttrib($value);
        $field = new \Zimbra\Admin\Struct\QueueQueryField($name, [$match]);

        $query = new \Zimbra\Admin\Struct\QueueQuery([$field], $limit, $offset);
        $this->assertSame($limit, $query->getLimit());
        $this->assertSame($offset, $query->getOffset());
        $this->assertSame([$field], $query->getFields()->all());

        $query->setLimit($limit)
              ->setOffset($offset)
              ->addField($field);
        $this->assertSame($limit, $query->getLimit());
        $this->assertSame($offset, $query->getOffset());
        $this->assertSame([$field, $field], $query->getFields()->all());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<query limit="' . $limit . '" offset="' . $offset . '">'
                . '<field name="' . $name . '">'
                    . '<match value="' . $value . '" />'
                . '</field>'
                . '<field name="' . $name . '">'
                    . '<match value="' . $value . '" />'
                . '</field>'
            . '</query>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $query);

        $array = [
            'query' => [
                'limit' => $limit,
                'offset' => $offset,
                'field' => [
                    [
                        'name' => $name,
                        'match' => [
                            [
                                'value' => $value,
                            ],
                        ],
                    ],
                    [
                        'name' => $name,
                        'match' => [
                            [
                                'value' => $value,
                            ],
                        ],
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $query->toArray());
    }

    public function testReindexMailboxInfo()
    {
        $id = self::randomName();
        $ids = self::randomName();
        $types = self::randomAttrs(\Zimbra\Enum\ReindexType::enums());

        $mbox = new \Zimbra\Admin\Struct\ReindexMailboxInfo($id, $types, $ids);
        $this->assertSame($id, $mbox->getId());
        $this->assertSame($types, $mbox->getTypes());
        $this->assertSame($ids, $mbox->getIds());

        $mbox->setId($id)
             ->setTypes($types)
             ->setIds($ids);
        $this->assertSame($id, $mbox->getId());
        $this->assertSame($types, $mbox->getTypes());
        $this->assertSame($ids, $mbox->getIds());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<mbox id="' . $id . '" types="' . $types . '" ids="' . $ids . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $mbox);

        $array = [
            'mbox' => [
                'id' => $id,
                'types' => $types,
                'ids' => $ids,
            ],
        ];
        $this->assertEquals($array, $mbox->toArray());
    }

    public function testRightModifierInfo()
    {
        $value = self::randomName();
        $right = new \Zimbra\Admin\Struct\RightModifierInfo($value, false, true, true, false);
        $this->assertSame($value, $right->getValue());
        $this->assertFalse($right->getDeny());
        $this->assertTrue($right->getCanDelegate());
        $this->assertTrue($right->getDisinheritSubGroups());
        $this->assertFalse($right->getSubDomain());

        $right->setDeny(true)
              ->setCanDelegate(false)
              ->setDisinheritSubGroups(false)
              ->setSubDomain(true);
        $this->assertTrue($right->getDeny());
        $this->assertFalse($right->getCanDelegate());
        $this->assertFalse($right->getDisinheritSubGroups());
        $this->assertTrue($right->getSubDomain());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<right deny="true" canDelegate="false" disinheritSubGroups="false" subDomain="true">' . $value . '</right>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $right);

        $array = [
            'right' => [
                'deny' => true,
                'canDelegate' => false,
                'disinheritSubGroups' => false,
                'subDomain' => true,
                '_content' => $value,
            ],
        ];
        $this->assertEquals($array, $right->toArray());
    }

    public function testServerMailQueueQuery()
    {
        $name = self::randomName();
        $value = self::randomName();
        $limit = mt_rand(0, 100);
        $offset = mt_rand(0, 100);
        $wait = mt_rand(0, 100);

        $attr = new \Zimbra\Admin\Struct\ValueAttrib($value);
        $field = new \Zimbra\Admin\Struct\QueueQueryField($name, [$attr]);
        $query = new \Zimbra\Admin\Struct\QueueQuery([$field], $limit, $offset);
        $queue = new \Zimbra\Admin\Struct\MailQueueQuery($query, $name, true, $wait);

        $server = new \Zimbra\Admin\Struct\ServerMailQueueQuery($queue, $name);
        $this->assertSame($name, $server->getServerName());
        $this->assertSame($queue, $server->getQueue());

        $server->setServerName($name)
               ->setQueue($queue);
        $this->assertSame($name, $server->getServerName());
        $this->assertSame($queue, $server->getQueue());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<server name="' . $name . '">'
                . '<queue name="' . $name . '" scan="true" wait="' . $wait . '">'
                    . '<query limit="' . $limit . '" offset="' . $offset . '">'
                        . '<field name="' . $name . '">'
                            . '<match value="' . $value . '" />'
                        . '</field>'
                    . '</query>'
                . '</queue>'
            . '</server>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $server);

        $array = [
            'server' => [
                'name' => $name,
                'queue' => [
                    'name' => $name,
                    'scan' => true,
                    'wait' => $wait,
                    'query' => [
                        'limit' => $limit,
                        'offset' => $offset,
                        'field' => [
                            [
                                'name' => $name,
                                'match' => [
                                    [
                                        'value' => $value
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $server->toArray());
    }

    public function testServerSelector()
    {
        $value = self::randomName();
        $server = new \Zimbra\Admin\Struct\ServerSelector(ServerBy::ID(), $value);
        $this->assertSame('id', $server->getBy()->value());
        $this->assertSame($value, $server->getValue());

        $server->setBy(ServerBy::NAME());
        $this->assertSame('name', $server->getBy()->value());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<server by="' . ServerBy::NAME() . '">' . $value . '</server>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $server);

        $array = [
            'server' => [
                'by' => ServerBy::NAME()->value(),
                '_content' => $value,
            ],
        ];
        $this->assertEquals($array, $server->toArray());
    }

    public function testServerWithQueueAction()
    {
        $name = self::randomName();
        $value = self::randomName();
        $limit = mt_rand(0, 100);
        $offset = mt_rand(0, 100);

        $attr = new \Zimbra\Admin\Struct\ValueAttrib($value);
        $field = new \Zimbra\Admin\Struct\QueueQueryField($name, [$attr]);
        $query = new \Zimbra\Admin\Struct\QueueQuery([$field], $limit, $offset);

        $action = new \Zimbra\Admin\Struct\MailQueueAction($query, QueueAction::HOLD(), QueueActionBy::QUERY());
        $queue = new \Zimbra\Admin\Struct\MailQueueWithAction($action, $name);

        $server = new \Zimbra\Admin\Struct\ServerWithQueueAction($queue, $name);
        $this->assertSame($name, $server->getName());
        $this->assertSame($queue, $server->getQueue());

        $server->setName($name)
               ->setQueue($queue);
        $this->assertSame($name, $server->getName());
        $this->assertSame($queue, $server->getQueue());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<server name="' . $name . '">'
                . '<queue name="' . $name . '">'
                    . '<action op="' . QueueAction::HOLD() . '" by="' . QueueActionBy::QUERY() . '">'
                        . '<query limit="' . $limit . '" offset="' . $offset . '">'
                            . '<field name="' . $name . '">'
                                . '<match value="' . $value . '" />'
                            . '</field>'
                        . '</query>'
                    . '</action>'
                . '</queue>'
            . '</server>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $server);

        $array = [
            'server' => [
                'name' => $name,
                'queue' => [
                    'name' => $name,
                    'action' => [
                        'op' => QueueAction::HOLD()->value(),
                        'by' => QueueActionBy::QUERY()->value(),
                        'query' => [
                            'limit' => $limit,
                            'offset' => $offset,
                            'field' => [
                                [
                                    'name' => $name,
                                    'match' => [
                                        [
                                            'value' => $value,
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $server->toArray());
    }

    public function testSimpleElement()
    {
        $el = new \Zimbra\Admin\Struct\SimpleElement;

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<any />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $el);

        $array = [
            'any' => [],
        ];
        $this->assertEquals($array, $el->toArray());
    }

    public function testStat()
    {
        $value = self::randomName();
        $name = self::randomName();
        $description = self::randomName();

        $stat = new \Zimbra\Admin\Struct\Stat($value, $name, $description);
        $this->assertSame($name, $stat->getName());
        $this->assertSame($description, $stat->getDescription());

        $stat->setName($name)
             ->setDescription($description);
        $this->assertSame($name, $stat->getName());
        $this->assertSame($description, $stat->getDescription());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<stat name="' . $name . '" description="' . $description . '">' . $value . '</stat>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $stat);

        $array = [
            'stat' => [
                'name' => $name,
                'description' => $description,
                '_content' => $value,
            ],
        ];
        $this->assertEquals($array, $stat->toArray());
    }

    public function testStatsSpec()
    {
        $name = self::randomName();
        $limit = self::randomName();

        $stat = new \Zimbra\Struct\NamedElement($name);
        $values = new \Zimbra\Admin\Struct\StatsValueWrapper([$stat]);

        $stats = new \Zimbra\Admin\Struct\StatsSpec($values, $name, $limit);
        $this->assertSame($values, $stats->getValues());
        $this->assertSame($name, $stats->getName());
        $this->assertSame($limit, $stats->getLimit());

        $stats->setValues($values)
              ->setName($name)
              ->setLimit($limit);
        $this->assertSame($values, $stats->getValues());
        $this->assertSame($name, $stats->getName());
        $this->assertSame($limit, $stats->getLimit());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<stats name="' . $name . '" limit="' . $limit . '">'
                . '<values>'
                    . '<stat name="' . $name . '" />'
                . '</values>'
            . '</stats>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $stats);

        $array = [
            'stats' => [
                'name' => $name,
                'limit' => $limit,
                'values' => [
                    'stat' => [
                        [
                            'name' => $name
                        ],
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $stats->toArray());
    }

    public function testStatsValueWrapper()
    {
        $name1 = self::randomName();
        $name2 = self::randomName();
        $stat1 = new \Zimbra\Struct\NamedElement($name1);
        $stat2 = new \Zimbra\Struct\NamedElement($name2);

        $wrapper = new \Zimbra\Admin\Struct\StatsValueWrapper([$stat1]);
        $this->assertSame([$stat1], $wrapper->getStats()->all());

        $wrapper->addStat($stat2);
        $this->assertSame([$stat1, $stat2], $wrapper->getStats()->all());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<values>'
                . '<stat name="' . $name1 . '" />'
                . '<stat name="' . $name2 . '" />'
            . '</values>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $wrapper);

        $array = [
            'values' => [
                'stat' => [
                    [
                        'name' => $name1,
                    ],
                    [
                        'name' => $name2,
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $wrapper->toArray());
    }

    public function testSyncGalAccountDataSourceSpec()
    {
        $value = self::randomName();

        $ds = new \Zimbra\Admin\Struct\SyncGalAccountDataSourceSpec(DataSourceBy::ID(), $value, false, true);
        $this->assertSame('id', $ds->getBy()->value());
        $this->assertSame($value, $ds->getValue());
        $this->assertFalse($ds->getFullSync());
        $this->assertTrue($ds->getReset());

        $ds->setBy(DataSourceBy::NAME())
           ->setFullSync(true)
           ->setReset(false);
        $this->assertSame('name', $ds->getBy()->value());
        $this->assertTrue($ds->getFullSync());
        $this->assertFalse($ds->getReset());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<datasource by="' . DataSourceBy::NAME() . '" fullSync="true" reset="false">' . $value . '</datasource>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $ds);

        $array = [
            'datasource' => [
                'by' => DataSourceBy::NAME()->value(),
                'fullSync' => true,
                'reset' => false,
                '_content' => $value,
            ],
        ];
        $this->assertEquals($array, $ds->toArray());
    }

    public function testSyncGalAccountSpec()
    {
        $value1 = self::randomName();
        $value2 = self::randomName();
        $id = self::randomName();

        $ds1 = new \Zimbra\Admin\Struct\SyncGalAccountDataSourceSpec(DataSourceBy::ID(), $value1, true, false);
        $ds2 = new \Zimbra\Admin\Struct\SyncGalAccountDataSourceSpec(DataSourceBy::NAME(), $value2, false, true);

        $sync = new \Zimbra\Admin\Struct\SyncGalAccountSpec($id, [$ds1]);
        $this->assertSame($id, $sync->getId());
        $this->assertSame([$ds1], $sync->getDataSources()->all());

        $sync->setId($id)
             ->addDataSource($ds2);
        $this->assertSame($id, $sync->getId());
        $this->assertSame([$ds1, $ds2], $sync->getDataSources()->all());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<account id="' . $id . '">'
                . '<datasource by="' . DataSourceBy::ID() . '" fullSync="true" reset="false">' . $value1 . '</datasource>'
                . '<datasource by="' . DataSourceBy::NAME() . '" fullSync="false" reset="true">' . $value2 . '</datasource>'
            . '</account>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $sync);

        $array = [
            'account' => [
                'id' => $id,
                'datasource' => [
                    [
                        'by' => DataSourceBy::ID()->value(),
                        'fullSync' => true,
                        'reset' => false,
                        '_content' => $value1,
                    ],
                    [
                        'by' => DataSourceBy::NAME()->value(),
                        'fullSync' => false,
                        'reset' => true,
                        '_content' => $value2,
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $sync->toArray());
    }

    public function testTargetWithType()
    {
        $type = self::randomName();
        $value = self::randomName();
        $target = new \Zimbra\Admin\Struct\TargetWithType($type, $value);
        $this->assertSame($type, $target->getType());
        $this->assertSame($value, $target->getValue());

        $target->setType($type);
        $this->assertSame($type, $target->getType());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<target type="' . $type . '">' . $value . '</target>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $target);

        $array = [
            'target' => [
                'type' => $type,
                '_content' => $value,
            ],
        ];
        $this->assertEquals($array, $target->toArray());
    }

    public function testTimeAttr()
    {
        $time = self::randomName();
        $attr = new \Zimbra\Admin\Struct\TimeAttr($time);
        $this->assertSame($time, $attr->getTime());

        $attr->setTime($time);
        $this->assertSame($time, $attr->getTime());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<attr time="' . $time . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $attr);

        $array = [
            'attr' => [
                'time' => $time,
            ],
        ];
        $this->assertEquals($array, $attr->toArray());
    }

    public function testTzFixupRuleMatchDate()
    {
        $mon = mt_rand(1, 12);
        $mday = mt_rand(1, 31);
        $date = new \Zimbra\Admin\Struct\TzFixupRuleMatchDate($mon, $mday);
        $this->assertSame($mon, $date->getMonth());
        $this->assertSame($mday, $date->getMonthDay());

        $date->setMonth($mon)
             ->setMonthDay($mday);
        $this->assertSame($mon, $date->getMonth());
        $this->assertSame($mday, $date->getMonthDay());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<date mon="' . $mon . '" mday="' . $mday . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $date);

        $array = [
            'date' => [
                'mon' => $mon,
                'mday' => $mday,
            ],
        ];
        $this->assertEquals($array, $date->toArray());
    }

    public function testTzFixupRuleMatchDates()
    {
        $std_mon = mt_rand(1, 12);
        $std_mday = mt_rand(1, 31);
        $standard = new \Zimbra\Admin\Struct\TzFixupRuleMatchDate($std_mon, $std_mday);

        $day_mon = mt_rand(1, 12);
        $day_mday = mt_rand(1, 31);
        $daylight = new \Zimbra\Admin\Struct\TzFixupRuleMatchDate($day_mon, $day_mday);

        $stdoff = mt_rand(1, 100);
        $dayoff = mt_rand(1, 100);
        $dates = new \Zimbra\Admin\Struct\TzFixupRuleMatchDates($standard, $daylight, $stdoff, $dayoff);
        $this->assertSame($standard, $dates->getStandard());
        $this->assertSame($daylight, $dates->getDaylight());
        $this->assertSame($stdoff, $dates->getStdOffset());
        $this->assertSame($dayoff, $dates->getDstOffset());

        $dates->setStandard($standard)
              ->setDaylight($daylight)
              ->setStdOffset($stdoff)
              ->setDstOffset($dayoff);
        $this->assertSame($standard, $dates->getStandard());
        $this->assertSame($daylight, $dates->getDaylight());
        $this->assertSame($stdoff, $dates->getStdOffset());
        $this->assertSame($dayoff, $dates->getDstOffset());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<dates stdoff="' . $stdoff . '" dayoff="' . $dayoff . '">'
                . '<standard mon="' . $std_mon . '" mday="' . $std_mday . '" />'
                . '<daylight mon="' . $day_mon . '" mday="' . $day_mday . '" />'
            . '</dates>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $dates);

        $array = [
            'dates' => [
                'stdoff' => $stdoff,
                'dayoff' => $dayoff,
                'standard' => [
                    'mon' => $std_mon,
                    'mday' => $std_mday,
                ],
                'daylight' => [
                    'mon' => $day_mon,
                    'mday' => $day_mday,
                ],
            ],
        ];
        $this->assertEquals($array, $dates->toArray());
    }

    public function testTzFixupRuleMatchRule()
    {
        $mon = mt_rand(1, 12);
        $week = mt_rand(1, 4);
        $wkday = mt_rand(1, 7);

        $rule = new \Zimbra\Admin\Struct\TzFixupRuleMatchRule($mon, $week, $wkday);
        $this->assertSame($mon, $rule->getMonth());
        $this->assertSame($week, $rule->getWeek());
        $this->assertSame($wkday, $rule->getWeekDay());

        $rule->setMonth($mon)
             ->setWeek($week)
             ->setWeekDay($wkday);
        $this->assertSame($mon, $rule->getMonth());
        $this->assertSame($week, $rule->getWeek());
        $this->assertSame($wkday, $rule->getWeekDay());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<rule mon="' . $mon . '" week="' . $week . '" wkday="' . $wkday . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $rule);

        $array = [
            'rule' => [
                'mon' => $mon,
                'week' => $week,
                'wkday' => $wkday,
            ],
        ];
        $this->assertEquals($array, $rule->toArray());
    }

    public function testTzFixupRuleMatchRules()
    {
        $std_mon = mt_rand(1, 12);
        $std_week = mt_rand(1, 4);
        $std_wkday = mt_rand(1, 7);
        $standard = new \Zimbra\Admin\Struct\TzFixupRuleMatchRule($std_mon, $std_week, $std_wkday);

        $day_mon = mt_rand(1, 12);
        $day_week = mt_rand(1, 4);
        $day_wkday = mt_rand(1, 7);
        $daylight = new \Zimbra\Admin\Struct\TzFixupRuleMatchRule($day_mon, $day_week, $day_wkday);

        $stdoff = mt_rand(1, 100);
        $dayoff = mt_rand(1, 100);
        $rules = new \Zimbra\Admin\Struct\TzFixupRuleMatchRules($standard, $daylight, $stdoff, $dayoff);
        $this->assertSame($standard, $rules->getStandard());
        $this->assertSame($daylight, $rules->getDaylight());
        $this->assertSame($stdoff, $rules->getStdOffset());
        $this->assertSame($dayoff, $rules->getDstOffset());

        $rules->setStandard($standard)
              ->setDaylight($daylight)
              ->setStdOffset($stdoff)
              ->setDstOffset($dayoff);
        $this->assertSame($standard, $rules->getStandard());
        $this->assertSame($daylight, $rules->getDaylight());
        $this->assertSame($stdoff, $rules->getStdOffset());
        $this->assertSame($dayoff, $rules->getDstOffset());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<rules stdoff="' . $stdoff . '" dayoff="' . $dayoff . '">'
                . '<standard mon="' . $std_mon . '" week="' . $std_week . '" wkday="' . $std_wkday . '" />'
                . '<daylight mon="' . $day_mon . '" week="' . $day_week . '" wkday="' . $day_wkday . '" />'
            . '</rules>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $rules);

        $array = [
            'rules' => [
                'stdoff' => $stdoff,
                'dayoff' => $dayoff,
                'standard' => [
                    'mon' => $std_mon,
                    'week' => $std_week,
                    'wkday' => $std_wkday,
                ],
                'daylight' => [
                    'mon' => $day_mon,
                    'week' => $day_week,
                    'wkday' => $day_wkday,
                ],
            ],
        ];
        $this->assertEquals($array, $rules->toArray());
    }

    public function testTzFixupRuleMatch()
    {
        $id = self::randomName();
        $offset = mt_rand(0, 100);
        $any = new \Zimbra\Admin\Struct\SimpleElement;
        $tzid = new \Zimbra\Struct\Id($id);
        $nonDst = new \Zimbra\Admin\Struct\Offset($offset);

        $rule_mon = mt_rand(1, 12);
        $rule_week = mt_rand(1, 4);
        $rule_wkday = mt_rand(1, 7);
        $rule_stdoff = mt_rand(1, 100);
        $rule_dayoff = mt_rand(1, 100);
        $rule_standard = new \Zimbra\Admin\Struct\TzFixupRuleMatchRule($rule_mon, $rule_week, $rule_wkday);
        $rule_daylight = new \Zimbra\Admin\Struct\TzFixupRuleMatchRule($rule_mon, $rule_week, $rule_wkday);
        $rules = new \Zimbra\Admin\Struct\TzFixupRuleMatchRules($rule_standard, $rule_daylight, $rule_stdoff, $rule_dayoff);

        $date_mon = mt_rand(1, 12);
        $date_mday = mt_rand(1, 31);
        $date_stdoff = mt_rand(1, 100);
        $date_dayoff = mt_rand(1, 100);
        $date_standard = new \Zimbra\Admin\Struct\TzFixupRuleMatchDate($date_mon, $date_mday);
        $date_daylight = new \Zimbra\Admin\Struct\TzFixupRuleMatchDate($date_mon, $date_mday);
        $dates = new \Zimbra\Admin\Struct\TzFixupRuleMatchDates($date_standard, $date_daylight, $date_stdoff, $date_dayoff);

        $match = new \Zimbra\Admin\Struct\TzFixupRuleMatch($any, $tzid, $nonDst, $rules, $dates);
        $this->assertSame($any, $match->getAny());
        $this->assertSame($tzid, $match->getTzid());
        $this->assertSame($nonDst, $match->getNonDst());
        $this->assertSame($rules, $match->getRules());
        $this->assertSame($dates, $match->getDates());

        $match->setAny($any)
              ->setTzid($tzid)
              ->setNonDst($nonDst)
              ->setRules($rules)
              ->setDates($dates);
        $this->assertSame($any, $match->getAny());
        $this->assertSame($tzid, $match->getTzid());
        $this->assertSame($nonDst, $match->getNonDst());
        $this->assertSame($rules, $match->getRules());
        $this->assertSame($dates, $match->getDates());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<match>'
                . '<any />'
                . '<tzid id="' . $id . '" />'
                . '<nonDst offset="' . $offset . '" />'
                . '<rules stdoff="' . $rule_stdoff . '" dayoff="' . $rule_dayoff . '">'
                    . '<standard mon="' . $rule_mon . '" week="' . $rule_week . '" wkday="' . $rule_wkday . '" />'
                    . '<daylight mon="' . $rule_mon . '" week="' . $rule_week . '" wkday="' . $rule_wkday . '" />'
                . '</rules>'
                . '<dates stdoff="' . $date_stdoff . '" dayoff="' . $date_dayoff . '">'
                    . '<standard mon="' . $date_mon . '" mday="' . $date_mday . '" />'
                    . '<daylight mon="' . $date_mon . '" mday="' . $date_mday . '" />'
                . '</dates>'
            . '</match>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $match);

        $array = [
            'match' => [
                'any' => [],
                'tzid' => [
                    'id' => $id
                ],
                'nonDst' => [
                    'offset' => $offset
                ],
                'rules' => [
                    'stdoff' => $rule_stdoff,
                    'dayoff' => $rule_dayoff,
                    'standard' => [
                        'mon' => $rule_mon,
                        'week' => $rule_week,
                        'wkday' => $rule_wkday,
                    ],
                    'daylight' => [
                        'mon' => $rule_mon,
                        'week' => $rule_week,
                        'wkday' => $rule_wkday,
                    ],
                ],
                'dates' => [
                    'stdoff' => $date_stdoff,
                    'dayoff' => $date_dayoff,
                    'standard' => [
                        'mon' => $date_mon,
                        'mday' => $date_mday,
                    ],
                    'daylight' => [
                        'mon' => $date_mon,
                        'mday' => $date_mday,
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $match->toArray());
    }

    public function testTzFixupRule()
    {
        $id = self::randomName();
        $offset = mt_rand(0, 100);
        $any = new \Zimbra\Admin\Struct\SimpleElement;
        $tzid = new \Zimbra\Struct\Id($id);
        $nonDst = new \Zimbra\Admin\Struct\Offset($offset);

        $rule_mon = mt_rand(1, 12);
        $rule_week = mt_rand(1, 4);
        $rule_wkday = mt_rand(1, 7);
        $rule_stdoff = mt_rand(1, 100);
        $rule_dayoff = mt_rand(1, 100);
        $rule_standard = new \Zimbra\Admin\Struct\TzFixupRuleMatchRule($rule_mon, $rule_week, $rule_wkday);
        $rule_daylight = new \Zimbra\Admin\Struct\TzFixupRuleMatchRule($rule_mon, $rule_week, $rule_wkday);
        $rules = new \Zimbra\Admin\Struct\TzFixupRuleMatchRules($rule_standard, $rule_daylight, $rule_stdoff, $rule_dayoff);

        $date_mon = mt_rand(1, 12);
        $date_mday = mt_rand(1, 31);
        $date_stdoff = mt_rand(1, 100);
        $date_dayoff = mt_rand(1, 100);
        $date_standard = new \Zimbra\Admin\Struct\TzFixupRuleMatchDate($date_mon, $date_mday);
        $date_daylight = new \Zimbra\Admin\Struct\TzFixupRuleMatchDate($date_mon, $date_mday);
        $dates = new \Zimbra\Admin\Struct\TzFixupRuleMatchDates($date_standard, $date_daylight, $date_stdoff, $date_dayoff);

        $match = new \Zimbra\Admin\Struct\TzFixupRuleMatch($any, $tzid, $nonDst, $rules, $dates);

        $mon = mt_rand(1, 12);
        $hour = mt_rand(0, 23);
        $min = mt_rand(0, 59);
        $sec = mt_rand(0, 59);
        $wellKnownTz = new \Zimbra\Struct\Id($id);
        $standard = new \Zimbra\Struct\TzOnsetInfo($mon, $hour, $min, $sec);
        $daylight = new \Zimbra\Struct\TzOnsetInfo($mon, $hour, $min, $sec);

        $stdname = self::randomName();
        $dayname = self::randomName();
        $stdoff = mt_rand(0, 100);
        $dayoff = mt_rand(0, 100);
        $tz = new \Zimbra\Admin\Struct\CalTZInfo($id, $stdoff, $dayoff, $daylight, $standard, $stdname, $dayname);
        $replace = new \Zimbra\Admin\Struct\TzReplaceInfo($wellKnownTz, $tz);
        
        $touch = new \Zimbra\Admin\Struct\SimpleElement;
        $fixupRule = new \Zimbra\Admin\Struct\TzFixupRule($match, $touch, $replace);
        $this->assertSame($match, $fixupRule->getMatch());
        $this->assertSame($touch, $fixupRule->getTouch());
        $this->assertSame($replace, $fixupRule->getReplace());

        $fixupRule->setMatch($match)
                  ->setTouch($touch)
                  ->setReplace($replace);
        $this->assertSame($match, $fixupRule->getMatch());
        $this->assertSame($touch, $fixupRule->getTouch());
        $this->assertSame($replace, $fixupRule->getReplace());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<fixupRule>'
                . '<match>'
                    . '<any />'
                    . '<tzid id="' . $id . '" />'
                    . '<nonDst offset="' . $offset . '" />'
                    . '<rules stdoff="' . $rule_stdoff . '" dayoff="' . $rule_dayoff . '">'
                        . '<standard mon="' . $rule_mon . '" week="' . $rule_week . '" wkday="' . $rule_wkday . '" />'
                        . '<daylight mon="' . $rule_mon . '" week="' . $rule_week . '" wkday="' . $rule_wkday . '" />'
                    . '</rules>'
                    . '<dates stdoff="' . $date_stdoff . '" dayoff="' . $date_dayoff . '">'
                        . '<standard mon="' . $date_mon . '" mday="' . $date_mday . '" />'
                        . '<daylight mon="' . $date_mon . '" mday="' . $date_mday . '" />'
                    . '</dates>'
                . '</match>'
                . '<touch />'
                . '<replace>'
                    . '<wellKnownTz id="' . $id . '" />'
                    . '<tz id="' . $id . '" stdoff="' . $stdoff . '" dayoff="' . $dayoff . '" stdname="' . $stdname . '" dayname="' . $dayname . '">'
                        . '<standard mon="' . $mon . '" hour="' . $hour . '" min="' . $min . '" sec="' . $sec . '" />'
                        . '<daylight mon="' . $mon . '" hour="' . $hour . '" min="' . $min . '" sec="' . $sec . '" />'
                    . '</tz>'
                . '</replace>'
            . '</fixupRule>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $fixupRule);

        $array = [
            'fixupRule' => [
                'match' => [
                    'any' => [],
                    'tzid' => [
                        'id' => $id
                    ],
                    'nonDst' => [
                        'offset' => $offset
                    ],
                    'rules' => [
                        'stdoff' => $rule_stdoff,
                        'dayoff' => $rule_dayoff,
                        'standard' => [
                            'mon' => $rule_mon,
                            'week' => $rule_week,
                            'wkday' => $rule_wkday,
                        ],
                        'daylight' => [
                            'mon' => $rule_mon,
                            'week' => $rule_week,
                            'wkday' => $rule_wkday,
                        ],
                    ],
                    'dates' => [
                        'stdoff' => $date_stdoff,
                        'dayoff' => $date_dayoff,
                        'standard' => [
                            'mon' => $date_mon,
                            'mday' => $date_mday,
                        ],
                        'daylight' => [
                            'mon' => $date_mon,
                            'mday' => $date_mday,
                        ],
                    ],
                ],
                'touch' => [],
                'replace' => [
                    'wellKnownTz' => [
                        'id' => $id
                    ],
                    'tz' => [
                        'id' => $id,
                        'stdoff' => $stdoff,
                        'dayoff' => $dayoff,
                        'stdname' => $stdname,
                        'dayname' => $dayname,
                        'standard' => [
                            'mon' => $mon,
                            'hour' => $hour,
                            'min' => $min,
                            'sec' => $sec,
                        ],
                        'daylight' => [
                            'mon' => $mon,
                            'hour' => $hour,
                            'min' => $min,
                            'sec' => $sec,
                        ],
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $fixupRule->toArray());
    }

    public function testTzFixup()
    {
        $id = self::randomName();
        $offset = mt_rand(0, 100);
        $any = new \Zimbra\Admin\Struct\SimpleElement;
        $tzid = new \Zimbra\Struct\Id($id);
        $nonDst = new \Zimbra\Admin\Struct\Offset($offset);

        $rule_mon = mt_rand(1, 12);
        $rule_week = mt_rand(1, 4);
        $rule_wkday = mt_rand(1, 7);
        $rule_stdoff = mt_rand(1, 100);
        $rule_dayoff = mt_rand(1, 100);
        $rule_standard = new \Zimbra\Admin\Struct\TzFixupRuleMatchRule($rule_mon, $rule_week, $rule_wkday);
        $rule_daylight = new \Zimbra\Admin\Struct\TzFixupRuleMatchRule($rule_mon, $rule_week, $rule_wkday);
        $rules = new \Zimbra\Admin\Struct\TzFixupRuleMatchRules($rule_standard, $rule_daylight, $rule_stdoff, $rule_dayoff);

        $date_mon = mt_rand(1, 12);
        $date_mday = mt_rand(1, 31);
        $date_stdoff = mt_rand(1, 100);
        $date_dayoff = mt_rand(1, 100);
        $date_standard = new \Zimbra\Admin\Struct\TzFixupRuleMatchDate($date_mon, $date_mday);
        $date_daylight = new \Zimbra\Admin\Struct\TzFixupRuleMatchDate($date_mon, $date_mday);
        $dates = new \Zimbra\Admin\Struct\TzFixupRuleMatchDates($date_standard, $date_daylight, $date_stdoff, $date_dayoff);

        $match = new \Zimbra\Admin\Struct\TzFixupRuleMatch($any, $tzid, $nonDst, $rules, $dates);

        $mon = mt_rand(1, 12);
        $hour = mt_rand(0, 23);
        $min = mt_rand(0, 59);
        $sec = mt_rand(0, 59);
        $wellKnownTz = new \Zimbra\Struct\Id($id);
        $standard = new \Zimbra\Struct\TzOnsetInfo($mon, $hour, $min, $sec);
        $daylight = new \Zimbra\Struct\TzOnsetInfo($mon, $hour, $min, $sec);

        $stdname = self::randomName();
        $dayname = self::randomName();
        $stdoff = mt_rand(0, 100);
        $dayoff = mt_rand(0, 100);
        $tz = new \Zimbra\Admin\Struct\CalTZInfo($id, $stdoff, $dayoff, $daylight, $standard, $stdname, $dayname);
        $replace = new \Zimbra\Admin\Struct\TzReplaceInfo($wellKnownTz, $tz);
        
        $touch = new \Zimbra\Admin\Struct\SimpleElement;
        $fixupRule = new \Zimbra\Admin\Struct\TzFixupRule($match, $touch, $replace);

        $tzfixup = new \Zimbra\Admin\Struct\TzFixup([$fixupRule]);
        $this->assertSame([$fixupRule], $tzfixup->getFixupRules()->all());
        $tzfixup->addFixupRule($fixupRule);
        $this->assertSame([$fixupRule, $fixupRule], $tzfixup->getFixupRules()->all());
        $tzfixup->getFixupRules()->remove(1);

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<tzfixup>'
                . '<fixupRule>'
                    . '<match>'
                        . '<any />'
                        . '<tzid id="' . $id . '" />'
                        . '<nonDst offset="' . $offset . '" />'
                        . '<rules stdoff="' . $rule_stdoff . '" dayoff="' . $rule_dayoff . '">'
                            . '<standard mon="' . $rule_mon . '" week="' . $rule_week . '" wkday="' . $rule_wkday . '" />'
                            . '<daylight mon="' . $rule_mon . '" week="' . $rule_week . '" wkday="' . $rule_wkday . '" />'
                        . '</rules>'
                        . '<dates stdoff="' . $date_stdoff . '" dayoff="' . $date_dayoff . '">'
                            . '<standard mon="' . $date_mon . '" mday="' . $date_mday . '" />'
                            . '<daylight mon="' . $date_mon . '" mday="' . $date_mday . '" />'
                        . '</dates>'
                    . '</match>'
                    . '<touch />'
                    . '<replace>'
                        . '<wellKnownTz id="' . $id . '" />'
                        . '<tz id="' . $id . '" stdoff="' . $stdoff . '" dayoff="' . $dayoff . '" stdname="' . $stdname . '" dayname="' . $dayname . '">'
                            . '<standard mon="' . $mon . '" hour="' . $hour . '" min="' . $min . '" sec="' . $sec . '" />'
                            . '<daylight mon="' . $mon . '" hour="' . $hour . '" min="' . $min . '" sec="' . $sec . '" />'
                        . '</tz>'
                    . '</replace>'
                . '</fixupRule>'
            . '</tzfixup>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $tzfixup);

        $array = [
            'tzfixup' => [
                'fixupRule' => [
                    [
                        'match' => [
                            'any' => [],
                            'tzid' => [
                                'id' => $id
                            ],
                            'nonDst' => [
                                'offset' => $offset
                            ],
                            'rules' => [
                                'stdoff' => $rule_stdoff,
                                'dayoff' => $rule_dayoff,
                                'standard' => [
                                    'mon' => $rule_mon,
                                    'week' => $rule_week,
                                    'wkday' => $rule_wkday,
                                ],
                                'daylight' => [
                                    'mon' => $rule_mon,
                                    'week' => $rule_week,
                                    'wkday' => $rule_wkday,
                                ],
                            ],
                            'dates' => [
                                'stdoff' => $date_stdoff,
                                'dayoff' => $date_dayoff,
                                'standard' => [
                                    'mon' => $date_mon,
                                    'mday' => $date_mday,
                                ],
                                'daylight' => [
                                    'mon' => $date_mon,
                                    'mday' => $date_mday,
                                ],
                            ],
                        ],
                        'touch' => [],
                        'replace' => [
                            'wellKnownTz' => [
                                'id' => $id
                            ],
                            'tz' => [
                                'id' => $id,
                                'stdoff' => $stdoff,
                                'dayoff' => $dayoff,
                                'stdname' => $stdname,
                                'dayname' => $dayname,
                                'standard' => [
                                    'mon' => $mon,
                                    'hour' => $hour,
                                    'min' => $min,
                                    'sec' => $sec,
                                ],
                                'daylight' => [
                                    'mon' => $mon,
                                    'hour' => $hour,
                                    'min' => $min,
                                    'sec' => $sec,
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $tzfixup->toArray());
    }

    public function testTzReplaceInfo()
    {
        $id = self::randomName();
        $mon = mt_rand(1, 12);
        $hour = mt_rand(0, 23);
        $min = mt_rand(0, 59);
        $sec = mt_rand(0, 59);
        $wellKnownTz = new \Zimbra\Struct\Id($id);
        $standard = new \Zimbra\Struct\TzOnsetInfo($mon, $hour, $min, $sec);
        $daylight = new \Zimbra\Struct\TzOnsetInfo($mon, $hour, $min, $sec);

        $stdname = self::randomName();
        $dayname = self::randomName();
        $stdoff = mt_rand(0, 100);
        $dayoff = mt_rand(0, 100);
        $tz = new \Zimbra\Admin\Struct\CalTZInfo($id, $stdoff, $dayoff, $standard, $daylight, $stdname, $dayname);

        $replace = new \Zimbra\Admin\Struct\TzReplaceInfo($wellKnownTz, $tz);
        $this->assertSame($wellKnownTz, $replace->getWellKnownTz());
        $this->assertSame($tz, $replace->getTz());

        $replace->setWellKnownTz($wellKnownTz)
                ->setTz($tz);
        $this->assertSame($wellKnownTz, $replace->getWellKnownTz());
        $this->assertSame($tz, $replace->getTz());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<replace>'
                . '<wellKnownTz id="' . $id . '" />'
                . '<tz id="' . $id . '" stdoff="' . $stdoff . '" dayoff="' . $dayoff . '" stdname="' . $stdname . '" dayname="' . $dayname . '">'
                    . '<standard mon="' . $mon . '" hour="' . $hour . '" min="' . $min . '" sec="' . $sec . '" />'
                    . '<daylight mon="' . $mon . '" hour="' . $hour . '" min="' . $min . '" sec="' . $sec . '" />'
                . '</tz>'
            . '</replace>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $replace);

        $array = [
            'replace' => [
                'wellKnownTz' => [
                    'id' => $id,
                ],
                'tz' => [
                    'id' => $id,
                    'stdoff' => $stdoff,
                    'dayoff' => $dayoff,
                    'stdname' => $stdname,
                    'dayname' => $dayname,
                    'standard' => [
                        'mon' => $mon,
                        'hour' => $hour,
                        'min' => $min,
                        'sec' => $sec,
                    ],
                    'daylight' => [
                        'mon' => $mon,
                        'hour' => $hour,
                        'min' => $min,
                        'sec' => $sec,
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $replace->toArray());
    }

    public function testUcServiceSelector()
    {
        $value = self::randomName();
        $ucs = new \Zimbra\Admin\Struct\UcServiceSelector(UcServiceBy::ID(), $value);
        $this->assertSame('id', $ucs->getBy()->value());

        $ucs->setBy(UcServiceBy::NAME());
        $this->assertSame('name', $ucs->getBy()->value());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<ucservice by="' . UcServiceBy::NAME() . '">' . $value . '</ucservice>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $ucs);

        $array = [
            'ucservice' => [
                'by' => UcServiceBy::NAME()->value(),
                '_content' => $value,
            ],
        ];
        $this->assertEquals($array, $ucs->toArray());
    }

    public function testValueAttrib()
    {
        $value = self::randomName();
        $attr = new \Zimbra\Admin\Struct\ValueAttrib($value);
        $this->assertSame($value, $attr->getValue());

        $attr->setValue($value);
        $this->assertSame($value, $attr->getValue());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<a value="' . $value  .'" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $attr);

        $array = [
            'a' => [
                'value' => $value,
            ],
        ];
        $this->assertEquals($array, $attr->toArray());
    }

    public function testVolumeInfo()
    {
        $id = mt_rand(0, 10);
        $type = self::randomValue([1, 2, 10]);
        $threshold = mt_rand(0, 10);
        $mgbits = mt_rand(0, 10);
        $mbits = mt_rand(0, 10);
        $fgbits = mt_rand(0, 10);
        $fbits = mt_rand(0, 10);
        $name = self::randomName();
        $rootpath = self::randomName();

        $volume = new \Zimbra\Admin\Struct\VolumeInfo(
            $id, $type, $threshold, $mgbits, $mbits, $fgbits, $fbits, $name, $rootpath, false, true
        );
        $this->assertSame($id, $volume->getId());
        $this->assertSame($type, $volume->getType());
        $this->assertSame($threshold, $volume->getCompressionThreshold());
        $this->assertSame($mgbits, $volume->getMgbits());
        $this->assertSame($mbits, $volume->getMbits());
        $this->assertSame($fgbits, $volume->getFgbits());
        $this->assertSame($fbits, $volume->getFbits());
        $this->assertSame($name, $volume->getName());
        $this->assertSame($rootpath, $volume->getRootPath());
        $this->assertFalse($volume->getCompressBlobs());
        $this->assertTrue($volume->isCurrent());

        $volume->setId($id)
               ->setType($type)
               ->setCompressionThreshold($threshold)
               ->setMgbits($mgbits)
               ->setMbits($mbits)
               ->setFgbits($fgbits)
               ->setFbits($fbits)
               ->setName($name)
               ->setRootPath($rootpath)
               ->setCompressBlobs(true)
               ->setCurrent(false);
        $this->assertSame($id, $volume->getId());
        $this->assertSame($type, $volume->getType());
        $this->assertSame($threshold, $volume->getCompressionThreshold());
        $this->assertSame($mgbits, $volume->getMgbits());
        $this->assertSame($mbits, $volume->getMbits());
        $this->assertSame($fgbits, $volume->getFgbits());
        $this->assertSame($fbits, $volume->getFbits());
        $this->assertSame($name, $volume->getName());
        $this->assertSame($rootpath, $volume->getRootPath());
        $this->assertTrue($volume->getCompressBlobs());
        $this->assertFalse($volume->isCurrent());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<volume '
                . 'id="' . $id . '" '
                . 'type="' . $type . '" '
                . 'compressionThreshold="' . $threshold . '" '
                . 'mgbits="' . $mgbits . '" '
                . 'mbits="' . $mbits . '" '
                . 'fgbits="' . $fgbits . '" '
                . 'fbits="' . $fbits . '" '
                . 'name="' . $name . '" '
                . 'rootpath="' . $rootpath . '" '
                . 'compressBlobs="true" '
                . 'isCurrent="false" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $volume);

        $array = [
            'volume' => [
                'id' => $id,
                'type' => $type,
                'compressionThreshold' => $threshold,
                'mgbits' => $mgbits,
                'mbits' => $mbits,
                'fgbits' => $fgbits,
                'fbits' => $fbits,
                'name' => $name,
                'rootpath' => $rootpath,
                'compressBlobs' => true,
                'isCurrent' => false,
            ],
        ];
        $this->assertEquals($array, $volume->toArray());
    }

    public function testXmppComponentSelector()
    {
        $value = self::randomName();
        $xmpp = new \Zimbra\Admin\Struct\XmppComponentSelector(XmppBy::ID(), $value);
        $this->assertTrue($xmpp->getBy()->is('id'));
        $this->assertSame($value, $xmpp->getValue());

        $xmpp->setBy(XmppBy::NAME());
        $this->assertTrue($xmpp->getBy()->is('name'));

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<xmppcomponent by="' . XmppBy::NAME() . '">' . $value . '</xmppcomponent>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $xmpp);

        $array = [
            'xmppcomponent' => [
                'by' => XmppBy::NAME()->value(),
                '_content' => $value,
            ],
        ];
        $this->assertEquals($array, $xmpp->toArray());
    }

    public function testXmppComponentSpec()
    {
        $name = self::randomName();
        $value = self::randomName();

        $attr = new \Zimbra\Struct\KeyValuePair($name, $value);
        $domain = new \Zimbra\Admin\Struct\DomainSelector(DomainBy::NAME(), $value);
        $server = new \Zimbra\Admin\Struct\ServerSelector(ServerBy::NAME(), $value);

        $xmpp = new \Zimbra\Admin\Struct\XmppComponentSpec($name, $domain, $server);
        $this->assertSame($name, $xmpp->getName());
        $this->assertSame($domain, $xmpp->getDomain());
        $this->assertSame($server, $xmpp->getServer());

        $xmpp->setName($name)
             ->setDomain($domain)
             ->setServer($server)
             ->addAttr($attr);
        $this->assertSame($name, $xmpp->getName());
        $this->assertSame($domain, $xmpp->getDomain());
        $this->assertSame($server, $xmpp->getServer());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<xmppcomponent name="' . $name . '">'
                . '<domain by="' . DomainBy::NAME() . '">' . $value . '</domain>'
                . '<server by="' . ServerBy::NAME() . '">' . $value . '</server>'
                . '<a n="' . $name . '">' . $value . '</a>'
            . '</xmppcomponent>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $xmpp);

        $array = [
            'xmppcomponent' => [
                'name' => $name,
                'domain' => [
                    'by' => ServerBy::NAME()->value(),
                    '_content' => $value,
                ],
                'server' => [
                    'by' => ServerBy::NAME()->value(),
                    '_content' => $value,
                ],
                'a' => [
                    [
                        'n' => $name,
                        '_content' => $value,
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $xmpp->toArray());
    }

    public function testZimletAcl()
    {
        $cos = self::randomName();
        $acl = new \Zimbra\Admin\Struct\ZimletAcl($cos, AclType::DENY());
        $this->assertSame($cos, $acl->getCos());
        $this->assertSame('deny', $acl->getAcl()->value());

        $acl->setCos($cos)
            ->setAcl(AclType::GRANT());
        $this->assertSame($cos, $acl->getCos());
        $this->assertSame('grant', $acl->getAcl()->value());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<acl cos="' . $cos . '" acl="' . AclType::GRANT() . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $acl);

        $array = [
            'acl' => [
                'cos' => $cos,
                'acl' => AclType::GRANT()->value(),
            ],
        ];
        $this->assertEquals($array, $acl->toArray());
    }

    public function testZimletAclStatusPri()
    {
        $name = self::randomName();
        $cos = self::randomName();
        $priority_value = mt_rand(0, 10);

        $acl = new \Zimbra\Admin\Struct\ZimletAcl($cos, AclType::DENY());
        $status = new \Zimbra\Admin\Struct\ValueAttrib(ZimletStatus::ENABLED()->value());
        $priority = new \Zimbra\Admin\Struct\IntegerValueAttrib($priority_value);

        $zimlet = new \Zimbra\Admin\Struct\ZimletAclStatusPri($name, $acl, $status, $priority);
        $this->assertSame($name, $zimlet->getName());
        $this->assertSame($acl, $zimlet->getAcl());
        $this->assertSame($status, $zimlet->getStatus());
        $this->assertSame($priority, $zimlet->getPriority());

        $zimlet->setName($name)
               ->setAcl($acl)
               ->setStatus($status)
               ->setPriority($priority);
        $this->assertSame($name, $zimlet->getName());
        $this->assertSame($acl, $zimlet->getAcl());
        $this->assertSame($status, $zimlet->getStatus());
        $this->assertSame($priority, $zimlet->getPriority());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<zimlet name="' . $name . '">'
                . '<acl cos="' . $cos . '" acl="' . AclType::DENY() . '" />'
                . '<status value="' . ZimletStatus::ENABLED() . '" />'
                . '<priority value="' . $priority_value . '" />'
            . '</zimlet>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $zimlet);

        $array = [
            'zimlet' => [
                'name' => $name,
                'acl' => [
                    'cos' => $cos,
                    'acl' => AclType::DENY()->value(),
                ],
                'status' => [
                    'value' => ZimletStatus::ENABLED()->value(),
                ],
                'priority' => [
                    'value' => $priority_value,
                ],
            ],
        ];
        $this->assertEquals($array, $zimlet->toArray());
    }
}
