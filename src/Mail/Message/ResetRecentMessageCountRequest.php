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

use Zimbra\Common\Soap\{SoapEnvelopeInterface, SoapRequest};

/**
 * ResetRecentMessageCountRequest class
 * Resets the mailbox's "recent message count" to 0.  A message is considered "recent" if:
 * - (a) it's not a draft or a sent message, and
 * - (b) it was added since the last write operation associated with any SOAP session.
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class ResetRecentMessageCountRequest extends SoapRequest
{
    /**
     * Initialize the soap envelope
     *
     * @return SoapEnvelopeInterface
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new ResetRecentMessageCountEnvelope(
            new ResetRecentMessageCountBody($this)
        );
    }
}
