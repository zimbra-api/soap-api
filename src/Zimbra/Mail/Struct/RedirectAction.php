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

/**
 * RedirectAction struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class RedirectAction extends FilterAction
{
    /**
     * Constructor method for RedirectAction
     * @param int $index
     * @param string $a
     * @return self
     */
    public function __construct($index, $a = null)
    {
        parent::__construct($index);
        if(null !== $a)
        {
            $this->setProperty('a', trim($a));
        }
    }

    /**
     * Gets address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->getProperty('a');
    }

    /**
     * Sets address
     *
     * @param  string $a
     * @return self
     */
    public function setAddress($a)
    {
        return $this->setProperty('a', trim($a));
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray($name = 'actionRedirect')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representative this class
     *
     * @return SimpleXML
     */
    public function toXml($name = 'actionRedirect')
    {
        return parent::toXml($name);
    }
}
