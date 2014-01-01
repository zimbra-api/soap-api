<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Soap\Struct;

use Zimbra\Utils\SimpleXML;

/**
 * ActivityFilter class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class ActivityFilter
{
    /**
     * Account ID
     * @var string
     */
    private $_account;

    /**
     * Comma separated list of Mailbox operations
     * @var string
     */
    private $_op;

    /**
     * Session ID
     * @var string
     */
    private $_session;

    /**
     * Constructor method for cursorInfo
     * @param string $account
     * @param string $op
     * @param string $session
     * @return self
     */
    public function __construct(
        $account = null,
        $op = null,
        $session = null
    )
    {
        $this->_account = trim($account);
        $this->_op = trim($op);
        $this->_session = trim($session);
    }

    /**
     * Gets or sets account
     *
     * @param  string $account
     * @return string|self
     */
    public function account($account = null)
    {
        if(null === $account)
        {
            return $this->_account;
        }
        $this->_account = trim($account);
        return $this;
    }

    /**
     * Gets or sets op
     *
     * @param  string $op
     * @return string|self
     */
    public function op($op = null)
    {
        if(null === $op)
        {
            return $this->_op;
        }
        $this->_op = trim($op);
        return $this;
    }

    /**
     * Gets or sets session
     *
     * @param  string $session
     * @return string|self
     */
    public function session($session = null)
    {
        if(null === $session)
        {
            return $this->_session;
        }
        $this->_session = trim($session);
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray($name = 'filter')
    {
        $name = !empty($name) ? $name : 'filter';
        $arr = array();
        if(!empty($this->_account))
        {
            $arr['account'] = $this->_account;
        }
        if(!empty($this->_op))
        {
            $arr['op'] = $this->_op;
        }
        if(!empty($this->_session))
        {
            $arr['session'] = $this->_session;
        }

        return array($name => $arr);
    }

    /**
     * Method returning the xml representative this class
     *
     * @return SimpleXML
     */
    public function toXml($name = 'filter')
    {
        $name = !empty($name) ? $name : 'filter';
        $xml = new SimpleXML('<'.$name.' />');
        if(!empty($this->_account))
        {
            $xml->addAttribute('account', $this->_account);
        }
        if(!empty($this->_op))
        {
            $xml->addAttribute('op', $this->_op);
        }
        if(!empty($this->_session))
        {
            $xml->addAttribute('session', $this->_session);
        }
        return $xml;
    }

    /**
     * Method returning the xml string representative this class
     *
     * @return string
     */
    public function __toString()
    {
        return $this->toXml()->asXml();
    }
}
