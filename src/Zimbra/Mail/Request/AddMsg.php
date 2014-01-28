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
use Zimbra\Soap\Request;

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
class AddMsg extends Request
{
    /**
     * Constructor method for AddMsg
     * @param  AddMsgSpec $m
     * @param  bool $filterSent
     * @return self
     */
    public function __construct(AddMsgSpec $m, $filterSent = null)
    {
        parent::__construct();
        $this->child('m', $m);
        if(null !== $filterSent)
        {
            $this->property('filterSent', (bool) $filterSent);
        }
    }

    /**
     * Get or set m
     * Specification of the message to add
     *
     * @param  AddMsgSpec $m
     * @return AddMsgSpec|self
     */
    public function m(AddMsgSpec $m = null)
    {
        if(null === $m)
        {
            return $this->child('m');
        }
        return $this->child('m', $m);
    }

    /**
     * Get or set filterSent
     * If set, then do outgoing message filtering if the msg is being added to
     * the Sent folder and has been flagged as sent.
     * Default is unset.
     *
     * @param  bool $filterSent
     * @return bool|self
     */
    public function filterSent($filterSent = null)
    {
        if(null === $filterSent)
        {
            return $this->property('filterSent');
        }
        return $this->property('filterSent', (bool) $filterSent);
    }
}
