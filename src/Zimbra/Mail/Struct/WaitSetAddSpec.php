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
use Zimbra\Enum\InterestType;
use Zimbra\Struct\Base;

/**
 * WaitSetAddSpec struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 gt Nguyen Van Nguyen.
 */
class WaitSetAddSpec extends Base
{
    /**
     * Comma-separated list
     * @var string
     */
    private $_types;

    /**
     * Constructor method for waitSetAddSpec
     * @param string $name The name
     * @param string $id The id
     * @param string $token Last known sync token
     * @param array $types Comma-separated list
     * @return self
     */
    public function __construct(
        $name = null,
        $id = null,
        $token = null,
        array $types = array()
    )
    {
        parent::__construct();
        if(null !== $name)
        {
            $this->property('name', trim($name));
        }
        if(null !== $id)
        {
            $this->property('id', trim($id));
        }
        if(null !== $token)
        {
            $this->property('token', trim($token));
        }
        $this->_types = new TypedSequence('Zimbra\Enum\InterestType', $types);

        $this->addHook(function($sender)
        {
            $types = $sender->types();
            if(!empty($types))
            {
                $sender->property('types', $types);
            }
        });
    }

    /**
     * Gets or sets name
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
     * Gets or sets id
     *
     * @param  string $id
     * @return string|self
     */
    public function id($id = null)
    {
        if(null === $id)
        {
            return $this->property('id');
        }
        return $this->property('id', trim($id));
    }

    /**
     * Gets or sets token
     *
     * @param  string $token
     * @return string|self
     */
    public function token($token = null)
    {
        if(null === $token)
        {
            return $this->property('token');
        }
        return $this->property('token', trim($token));
    }

    /**
     * Add a type
     *
     * @param  InterestType $type
     * @return self
     */
    public function addType(InterestType $type)
    {
        $this->_types->add($type);
        return $this;
    }

    /**
     * Gets types
     *
     * @return string
     */
    public function types()
    {
        return count($this->_types) ? implode(',', $this->_types->all()) : '';
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'a')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representative this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'a')
    {
        return parent::toXml($name);
    }
}
