<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\API\Mail\Request;

use Zimbra\Soap\Request;
use Zimbra\Soap\Struct\AddMsgSpec;

/**
 * AddMsg request class
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class AddMsg extends Request
{
    /**
     * Specification of the message to add
     * @var AddMsgSpec
     */
    private $_m;

    /**
     * If set, then do outgoing message filtering if the msg is being added to
     * the Sent folder and has been flagged as sent.
     * Default is unset.
     * @var bool
     */
    private $_filterSent;

    /**
     * Constructor method for AddMsg
     * @param  AddMsgSpec $m
     * @param  bool $filterSent
     * @return self
     */
    public function __construct(AddMsgSpec $m, $filterSent = null)
    {
        parent::__construct();
        $this->_m = $m;
        if(null !== $filterSent)
        {
            $this->_filterSent = (bool) $filterSent;
        }
    }

    /**
     * Get or set m
     *
     * @param  AddMsgSpec $m
     * @return AddMsgSpec|self
     */
    public function m(AddMsgSpec $m = null)
    {
        if(null === $m)
        {
            return $this->_m;
        }
        $this->_m = $m;
        return $this;
    }

    /**
     * Get or set filterSent
     *
     * @param  bool $m
     * @return bool|self
     */
    public function filterSent($filterSent = null)
    {
        if(null === $filterSent)
        {
            return $this->_filterSent;
        }
        $this->_filterSent = (bool) $filterSent;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        if(is_bool($this->_filterSent))
        {
            $this->array['filterSent'] = $this->_filterSent ? 1 : 0;
        }
        $this->array += $this->_m->toArray('m');
        return parent::toArray();
    }

    /**
     * Method returning the xml representation of this class
     *
     * @return SimpleXML
     */
    public function toXml()
    {
        if(is_bool($this->_filterSent))
        {
            $this->xml->addAttribute('filterSent', $this->_filterSent ? 1 : 0);
        }
        $this->xml->append($this->_m->toXml('m'));
        return parent::toXml();
    }
}
