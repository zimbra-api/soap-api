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
use Zimbra\Utils\TypedSequence;

/**
 * BounceMsgSpec struct class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class BounceMsgSpec
{
    /**
     * ID of message to resend
     * @var string
     */
    protected $_id;

    /**
     * Email addresses
     * @var TypedSequence<EmailAddrInfo>
     */
    protected $_e;

    /**
     * Constructor method for BounceMsgSpec
     * @param  string $id
     * @param  array  $e
     * @return self
     */
    public function __construct($id, array $e = array())
    {
        $this->_id = trim($id);
        $this->_e = new TypedSequence('Zimbra\Soap\Struct\EmailAddrInfo', $e);
    }

    /**
     * Gets or sets id
     *
     * @param  string $id
     * @return string|self
     */
    public function id($id = null)
    {
        if(null === $id)
        {
            return $this->_id;
        }
        $this->_id = trim($id);
        return $this;
    }

    /**
     * Add an email address
     *
     * @param  EmailAddrInfo $xparam
     * @return self
     */
    public function addE(EmailAddrInfo $e)
    {
        $this->_e->add($e);
        return $this;
    }

    /**
     * Gets email address sequence
     *
     * @return Sequence
     */
    public function e()
    {
        return $this->_e;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'm')
    {
        $name = !empty($name) ? $name : 'm';
        $arr = array(
            'id' => $this->_id,
        );
        if(count($this->_e))
        {
            $arr['e'] = array();
            foreach ($this->_e as $e)
            {
                $eArr = $e->toArray('e');
                $arr['e'][] = $eArr['e'];
            }
        }
        return array($name => $arr);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'm')
    {
        $name = !empty($name) ? $name : 'm';
        $xml = new SimpleXML('<'.$name.' />');
        $xml->addAttribute('id', $this->_id);
        foreach ($this->_e as $e)
        {
            $xml->append($e->toXml('e'));
        }
        return $xml;
    }

    /**
     * Method returning the xml string representation of this class
     *
     * @return string
     */
    public function __toString()
    {
        return $this->toXml()->asXml();
    }
}
