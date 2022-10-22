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
 * GetImportStatusRequest class
 * Returns current import status for all data sources.
 * Status values for a data source are reinitialized when either (a)
 * another import process is startedor (b) when the server is restarted.
 * If import has not run yet, the success and error attributes are not specified in the response.
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetImportStatusRequest extends SoapRequest
{
    /**
     * {@inheritdoc}
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new GetImportStatusEnvelope(
            new GetImportStatusBody($this)
        );
    }
}
