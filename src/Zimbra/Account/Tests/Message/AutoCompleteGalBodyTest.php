<?php declare(strict_types=1);

namespace Zimbra\Account\Tests\Message;

use Zimbra\Account\Message\AutoCompleteGalBody;
use Zimbra\Account\Message\AutoCompleteGalRequest;
use Zimbra\Account\Message\AutoCompleteGalResponse;
use Zimbra\Account\Struct\ContactInfo;
use Zimbra\Enum\GalSearchType;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for AutoCompleteGalBody.
 */
class AutoCompleteGalBodyTest extends ZimbraStructTestCase
{
    public function testAutoCompleteGalBody()
    {
        $name = $this->faker->word;
        $galAccountId = $this->faker->word;
        $limit = mt_rand(1, 100);
        $request = new AutoCompleteGalRequest(
            $name,
            GalSearchType::ALL(),
            FALSE,
            $galAccountId,
            $limit
        );

        $pagingSupported = mt_rand(1, 100);
        $contact = new ContactInfo;
        $response = new AutoCompleteGalResponse(
            FALSE,
            TRUE,
            $pagingSupported,
            [$contact]
        );

        $body = new AutoCompleteGalBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new AutoCompleteGalBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
    }
}
