<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Message;

use Zimbra\Common\Struct\{SoapEnvelopeInterface, SoapRequest};

/**
 * GetDataSourcesRequest class
 * Returns all data sources defined for the given mailbox.
 * For each data source, every attribute value is returned except password.
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetDataSourcesRequest extends SoapRequest
{
    /**
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new GetDataSourcesEnvelope(new GetDataSourcesBody($this));
    }
}
