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

use PhpCollection\Sequence;

/**
 * InviteTest struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class InviteTest extends FilterTest
{
    /**
     * Method
     * @var Sequence
     */
    private $_methods;

    /**
     * Constructor method for InviteTest
     * @param int $index
     * @param array $method
     * @param bool $negative
     * @return self
     */
    public function __construct(
        $index, array $methods = [], $negative = null
    )
    {
        parent::__construct($index, $negative);
        $this->setMethods($methods);
        $this->on('before', function(FilterTest $sender)
        {
            if($sender->getMethods()->count())
            {
                $sender->setChild('method', $sender->getMethods()->all());
            }
        });
    }

    /**
     * Add a method
     *
     * @param  string $method
     * @return self
     */
    public function addMethod($method)
    {
        $this->_methods->add($method);
        return $this;
    }

    /**
     * Sets method sequence
     *
     * @param  array $methods
     * @return self
     */
    public function setMethods(array $methods)
    {
        $this->_methods = new Sequence();
        foreach ($methods as $value)
        {
            $value = trim($value);
            if(!$this->_methods->contains($value))
            {
                $this->_methods->add($value);
            }
        }
        return $this;
    }

    /**
     * Gets method sequence
     *
     * @return Sequence
     */
    public function getMethods()
    {
        return $this->_methods;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'inviteTest')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representative this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'inviteTest')
    {
        return parent::toXml($name);
    }
}
