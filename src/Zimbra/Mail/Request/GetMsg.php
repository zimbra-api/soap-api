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

use Zimbra\Mail\Struct\MsgSpec;

/**
 * GetMsg request class
 * Get Message
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetMsg extends Base
{
    /**
     * Constructor method for GetMsg
     * @param  MsgSpec $msg
     * @return self
     */
    public function __construct(MsgSpec $msg)
    {
        parent::__construct();
        $this->setChild('m', $msg);
    }

    /**
     * Gets message specification
     *
     * @return MsgSpec
     */
    public function getMsg()
    {
        return $this->getChild('m');
    }

    /**
     * Sets message specification
     *
     * @param  MsgSpec $msg
     * @return self
     */
    public function setMsg(MsgSpec $msg)
    {
        return $this->setChild('m', $msg);
    }
}
