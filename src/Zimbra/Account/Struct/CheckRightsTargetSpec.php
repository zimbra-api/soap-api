<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Account\Struct;

use PhpCollection\Sequence;
use Zimbra\Enum\TargetBy;
use Zimbra\Enum\TargetType;
use Zimbra\Struct\Base;

/**
 * CheckRightsTargetSpec struct class
 *
 * @package    Zimbra
 * @subpackage Account
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class CheckRightsTargetSpec extends Base
{
    /**
     * Array of right
     * @var Sequence
     */
    private $_rights;

    /**
     * Constructor method for CheckRightsTargetSpec
     * @param  TargetType $type
     * @param  TargetBy $by
     * @param  string $key
     * @param  string $rights
     * @return self
     */
    public function __construct(TargetType $type, TargetBy $by, $key, array $rights = [])
    {
		parent::__construct();
        $this->setProperty('type', $type);
        $this->setProperty('by', $by);
        $this->setProperty('key', trim($key));
        $this->setRights($rights);

        $this->on('before', function(Base $sender)
        {
            if($sender->getRights()->count())
            {
                $sender->setChild('right', $sender->getRights()->all());
            }
        });
    }

    /**
     * Gets target type
     *
     * @return TargetType
     */
    public function getTargetType()
    {
        return $this->getProperty('type');
    }

    /**
     * Sets target type
     *
     * @param  TargetType $type
     * @return self
     */
    public function setTargetType(TargetType $type)
    {
        return $this->setProperty('type', $type);
    }

    /**
     * Gets target by
     *
     * @return TargetBy
     */
    public function getTargetBy()
    {
        return $this->getProperty('by');
    }

    /**
     * Sets target by
     *
     * @param  TargetBy $by
     * @return self
     */
    public function setTargetBy(TargetBy $by)
    {
        return $this->setProperty('by', $by);
    }

    /**
     * Gets target key
     *
     * @return string
     */
    public function getTargetKey()
    {
        return $this->getProperty('key');
    }

    /**
     * Sets target key
     *
     * @param  string $key
     * @return self
     */
    public function setTargetKey($key = null)
    {
        return $this->setProperty('key', trim($key));;
    }

    /**
     * Add a right
     *
     * @param  string $right
     * @return CheckRightsTargetSpec
     */
    public function addRight($right)
    {
        $right = trim($right);
        if(!empty($right))
        {
            $this->_rights->add($right);
        }
        return $this;
    }

    /**
     * Sets rights
     *
     * @param  string $rights
     * @return self
     */
    public function setRights(array $rights)
    {
        $this->_rights = new Sequence;
        foreach ($rights as $right)
        {
            $right = trim($right);
            if(!empty($right))
            {
                $this->_rights->add($right);
            }
        }
        return $this;
    }

    /**
     * Gets rights
     *
     * @return Sequence
     */
    public function getRights()
    {
        return $this->_rights;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'target')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'target')
    {
        return parent::toXml($name);
    }
}
