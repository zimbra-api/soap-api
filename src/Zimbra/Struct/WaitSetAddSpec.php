<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Struct;

use Zimbra\Common\TypedSequence;
use Zimbra\Enum\InterestType;

/**
 * WaitSetAddSpec struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class WaitSetAddSpec extends Base
{
    /**
     * Comma-separated list
     * @var string
     */
    private $_interests;

    /**
     * Constructor method for waitSetAddSpec
     * @param string $name The name
     * @param string $id The id
     * @param string $token Last known sync token
     * @param array $interests Comma-separated list
     * @return self
     */
    public function __construct(
        $name = null,
        $id = null,
        $token = null,
        array $interests  = []
    )
    {
        parent::__construct();
        if(null !== $name)
        {
            $this->setProperty('name', trim($name));
        }
        if(null !== $id)
        {
            $this->setProperty('id', trim($id));
        }
        if(null !== $token)
        {
            $this->setProperty('token', trim($token));
        }
        $this->setInterests($interests);

        $this->on('before', function(Base $sender)
        {
            $interests = $sender->getInterests();
            if(!empty($interests))
            {
                $sender->setProperty('types', $interests);
            }
        });
    }

    /**
     * Gets the name
     *
     * @return string
     */
    public function getName()
    {
        return $this->getProperty('name');
    }

    /**
     * Sets the name
     *
     * @param  string $name
     * @return self
     */
    public function setName($name)
    {
        return $this->setProperty('name', trim($name));
    }

    /**
     * Gets Id
     *
     * @return string
     */
    public function getId()
    {
        return $this->getProperty('id');
    }

    /**
     * Sets Id
     *
     * @param  string $id
     * @return self
     */
    public function setId($id)
    {
        return $this->setProperty('id', trim($id));
    }

    /**
     * Gets the token
     *
     * @return string
     */
    public function getToken()
    {
        return $this->getProperty('token');
    }

    /**
     * Sets the token
     *
     * @param  string $token
     * @return self
     */
    public function setToken($token)
    {
        return $this->setProperty('token', trim($token));
    }

    /**
     * Add a type
     *
     * @param  InterestType $type
     * @return self
     */
    public function addInterest(InterestType $type)
    {
        $this->_interests->add($type);
        return $this;
    }

    /**
     * Sets interests
     *
     * @param array $interests Comma-separated list
     * @return self
     */
    public function setInterests(array $interests)
    {
        $this->_interests = new TypedSequence('Zimbra\Enum\InterestType', $interests);
        return $this;
    }

    /**
     * Gets interests
     *
     * @return string
     */
    public function getInterests()
    {
        return count($this->_interests) ? implode(',', $this->_interests->all()) : '';
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
