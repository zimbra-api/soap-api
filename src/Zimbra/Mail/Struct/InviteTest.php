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
 * @copyright  Copyright © 2013 gt Nguyen Van Nguyen.
 */
class InviteTest extends FilterTest
{
    /**
     * Method
     * @var Sequence
     */
    private $_method;

    /**
     * Constructor method for InviteTest
     * @param int $index
     * @param array $method
     * @param bool $negative
     * @return self
     */
    public function __construct(
        $index, array $method = array(), $negative = null
    )
    {
        parent::__construct($index, $negative);
        $this->_method = new Sequence();
        foreach ($method as $value)
        {
            $value = trim($value);
            if(!$this->_method->contains($value))
            {
                $this->_method->add($value);
            }
        }

        $this->addHook(function($sender)
        {
            $sender->child('method', $sender->method()->all());
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
        $this->_method->add($method);
        return $this;
    }

    /**
     * Gets method sequence
     *
     * @return Sequence
     */
    public function method()
    {
        return $this->_method;
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
