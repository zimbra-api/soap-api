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

use Zimbra\Mail\Struct\AddMsgSpec;

/**
 * AddMsg request class
 * Add a message
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class AddMsg extends Base
{
    /**
     * Constructor method for AddMsg
     * @param  AddMsgSpec $m Specification of the message to add
     * @param  bool $filterSent Filter sent
     * @return self
     */
    public function __construct(AddMsgSpec $m, $filterSent = null)
    {
        parent::__construct();
        $this->setChild('m', $m);
        if(null !== $filterSent)
        {
            $this->setProperty('filterSent', (bool) $filterSent);
        }
    }

    /**
     * Gets message
     *
     * @return AddMsgSpec
     */
    public function getMsg()
    {
        return $this->getChild('m');
    }

    /**
     * Sets message
     *
     * @param  AddMsgSpec $m
     * @return self
     */
    public function setMsg(AddMsgSpec $m)
    {
        return $this->setChild('m', $m);
    }

    /**
     * Gets filter sent
     *
     * @return bool
     */
    public function getFilterSent()
    {
        return $this->getProperty('filterSent');
    }

    /**
     * Sets filter sent
     *
     * @param  bool $filterSent
     *     If set, then do outgoing message filtering if the msg is being added to
     *     the Sent folder and has been flagged as sent.
     *     Default is unset.
     * @return self
     */
    public function setFilterSent($filterSent)
    {
        return $this->setProperty('filterSent', (bool) $filterSent);
    }
}
