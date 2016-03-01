<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Struct;

use Zimbra\Common\TypedSequence;
use Zimbra\Struct\Base;

/**
 * XProp struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class XProp extends Base
{
    /**
     * XPARAMs
     * @var TypedSequence<XParam>
     */
    private $_xparams;

    /**
     * Constructor method for XProp
     *
     * @param string $name
     * @param string $value
     * @return self
     */
    public function __construct($name, $value, array $xparams = [])
    {
        parent::__construct();
        $this->setProperty('name', trim($name))
            ->setProperty('value', trim($value))
            ->setXParams($xparams);

        $this->on('before', function(Base $sender)
        {
            if($sender->getXParams()->count())
            {
                $sender->setChild('xparam', $sender->getXParams()->all());
            }
        });
    }

    /**
     * Gets name
     *
     * @return string
     */
    public function getName()
    {
        return $this->getProperty('name');
    }

    /**
     * Sets name
     *
     * @param  string $name
     * @return self
     */
    public function setName($name)
    {
        return $this->setProperty('name', trim($name));
    }

    /**
     * Gets value
     *
     * @return string
     */
    public function getValue()
    {
        return $this->getProperty('value');
    }

    /**
     * Sets value
     *
     * @param  string $value
     * @return self
     */
    public function setValue($value)
    {
        return $this->setProperty('value', trim($value));
    }

    /**
     * Add xparam
     *
     * @param  XParam $xparam
     * @return self
     */
    public function addXParam(XParam $xparam)
    {
        $this->_xparams->add($xparam);
        return $this;
    }

    /**
     * Sets xparam sequence
     *
     * @param  array $xparams
     * @return self
     */
    public function setXParams(array $xparams)
    {
        $this->_xparams = new TypedSequence('Zimbra\Mail\Struct\XParam', $xparams);
        return $this;
    }

    /**
     * Gets xparam sequence
     *
     * @return Sequence
     */
    public function getXParams()
    {
        return $this->_xparams;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'xprop')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'xprop')
    {
        return parent::toXml($name);
    }
}
