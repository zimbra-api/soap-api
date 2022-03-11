<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Message;

use Zimbra\Soap\Request;

/**
 * GetAllAccountLoggersRequest class
 * Returns all account loggers that have been created on the given server since the last server start.
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class GetAllAccountLoggersRequest extends Request
{
    /**
     * Initialize the soap envelope
     *
     * @return void
     */
    protected function envelopeInit(): void
    {
        if (!($this->envelope instanceof GetAllAccountLoggersEnvelope)) {
            $this->envelope = new GetAllAccountLoggersEnvelope(
                new GetAllAccountLoggersBody($this)
            );
        }
    }
}
