<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Request;

/**
 * SendDeliveryReport request class
 * Send a delivery report
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class SendDeliveryReport extends Base
{
    /**
     * Constructor method for SendDeliveryReport
     * @param  string $mid
     * @return self
     */
    public function __construct($mid)
    {
        parent::__construct();
        $this->setProperty('mid', trim($mid));
    }

    /**
     * Gets message Id
     *
     * @return string
     */
    public function getMessageId()
    {
        return $this->getProperty('mid');
    }

    /**
     * Sets message Id
     *
     * @param  string $messageId
     * @return self
     */
    public function setMessageId($messageId)
    {
        return $this->setProperty('mid', trim($messageId));
    }
}
