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

use JMS\Serializer\Annotation\XmlRoot;
use Zimbra\Soap\Request;

/**
 * GetWhiteBlackListRequest class
 * Get the anti-spam WhiteList and BlackList addresses
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @XmlRoot(name="GetWhiteBlackListRequest")
 */
class GetWhiteBlackListRequest extends Request
{
    /**
     * Initialize the soap envelope
     *
     * @return void
     */
    protected function envelopeInit(): void
    {
        if (!($this->envelope instanceof GetWhiteBlackListEnvelope)) {
            $this->envelope = new GetWhiteBlackListEnvelope(
                new GetWhiteBlackListBody($this)
            );
        }
    }
}