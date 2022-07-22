<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Account\Message;

use Zimbra\Common\Soap\{EnvelopeInterface, Request};

/**
 * GetAvailableLocalesRequest class
 * Get the intersection of all translated locales installed on the server and the list
 * specified in zimbraAvailableLocale. The locale list in the response is sorted by display name (name attribute).
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class GetAvailableLocalesRequest extends Request
{
    /**
     * Initialize the soap envelope
     *
     * @return EnvelopeInterface
     */
    protected function envelopeInit(): EnvelopeInterface
    {
        return new GetAvailableLocalesEnvelope(
            new GetAvailableLocalesBody($this)
        );
    }
}
