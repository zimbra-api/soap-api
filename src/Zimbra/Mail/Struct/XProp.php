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
     * @var Sequence
     */
    private $_xparam;

    /**
     * Constructor method for XProp
     *
     * @param string $name
     * @param string $value
     * @return self
     */
    public function __construct($name, $value, array $xparams = array())
    {
        parent::__construct();
        $this->property('name', trim($name));
        $this->property('value', trim($value));
        $this->_xparam = new TypedSequence('Zimbra\Mail\Struct\XParam', $xparams);

        $this->on('before', function(Base $sender)
        {
            if($sender->xparam()->count())
            {
                $sender->child('xparam', $sender->xparam()->all());
            }
        });
    }

    /**
     * Gets or sets xParam name
     *
     * @param  string $name
     * @return string|self
     */
    public function name($name = null)
    {
        if(null === $name)
        {
            return $this->property('name');
        }
        return $this->property('name', trim($name));
    }

    /**
     * Gets or sets xParam value
     *
     * @param  string $value
     * @return string|self
     */
    public function value($value = null)
    {
        if(null === $value)
        {
            return $this->property('value');
        }
        return $this->property('value', trim($value));
    }

    /**
     * Add xparam
     *
     * @param  XParam $xparam
     * @return self
     */
    public function addXParam(XParam $xparam)
    {
        $this->_xparam->add($xparam);
        return $this;
    }

    /**
     * Gets xparam sequence
     *
     * @return Sequence
     */
    public function xparam()
    {
        return $this->_xparam;
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
