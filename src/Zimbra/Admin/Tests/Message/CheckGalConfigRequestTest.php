<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\CheckGalConfigRequest;
use Zimbra\Admin\Struct\LimitedQuery;
use Zimbra\Admin\Struct\Attr;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for CheckGalConfigRequest.
 */
class CheckGalConfigRequestTest extends ZimbraStructTestCase
{
    public function testCheckGalConfigRequest()
    {
        $limit = mt_rand(0, 10);
        $action = $this->faker->word;
        $key = $this->faker->word;
        $value = $this->faker->word;

        $query = new LimitedQuery($limit, $value);

        $req = new CheckGalConfigRequest($query, $action, [new Attr($key, $value)]);
        $this->assertSame($query, $req->getQuery());
        $this->assertSame($action, $req->getAction());

        $req = new CheckGalConfigRequest(new LimitedQuery($limit, $value), '', [new Attr($key, $value)]);
        $req->setQuery($query)
            ->setAction($action);
        $this->assertSame($query, $req->getQuery());
        $this->assertSame($action, $req->getAction());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CheckGalConfigRequest>'
                . '<query limit="' . $limit . '">' . $value . '</query>'
                . '<action>' . $action . '</action>'
                . '<a n="' . $key . '">' . $value . '</a>'
            . '</CheckGalConfigRequest>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($req, 'xml'));
        $this->assertEquals($req, $this->serializer->deserialize($xml, CheckGalConfigRequest::class, 'xml'));

        $json = json_encode([
            'query' => [
                'limit' => $limit,
                '_content' => $value,
            ],
            'action' => [
                '_content' => $action,
            ],
            'a' => [
                [
                    'n' => $key,
                    '_content' => $value,
                ],
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($req, 'json'));
        $this->assertEquals($req, $this->serializer->deserialize($json, CheckGalConfigRequest::class, 'json'));
    }
}
