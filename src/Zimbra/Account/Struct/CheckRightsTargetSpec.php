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
    private $_right = array();

    /**
     * Constructor method for CheckRightsTargetSpec
     * @param  TargetType $type
     * @param  TargetBy $by
     * @param  string $key
     * @param  string $rights
     * @return self
     */
    public function __construct(TargetType $type, TargetBy $by, $key, array $rights = array())
    {
		parent::__construct();
        $this->property('type', $type);
        $this->property('by', $by);
        $this->property('key', trim($key));

        $this->_right = new Sequence;
        foreach ($rights as $right)
        {
            $right = trim($right);
            if(!empty($right))
            {
                $this->_right->add($right);
            }
        }

        $this->on('before', function(Base $sender)
        {
            if($sender->right()->count())
            {
                $sender->child('right', $sender->right()->all());
            }
        });
    }

    /**
     * Gets or sets type
     *
     * @param  TargetType $type
     * @return TargetType|self
     */
    public function type(TargetType $type = null)
    {
        if(null === $type)
        {
            return $this->property('type');
        }
        return $this->property('type', $type);
    }

    /**
     * Gets or sets by
     *
     * @param  TargetBy $by
     * @return TargetBy|self
     */
    public function by(TargetBy $by = null)
    {
        if(null === $by)
        {
            return $this->property('by');
        }
        return $this->property('by', $by);
    }

    /**
     * Gets or sets key
     *
     * @param  string $key
     * @return string|self
     */
    public function key($key = null)
    {
        if(null === $key)
        {
            return $this->property('key');
        }
        return $this->property('key', trim($key));;
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
            $this->_right->add($right);
        }
        return $this;
    }

    /**
     * Gets rights
     *
     * @return Sequence
     */
    public function right()
    {
        return $this->_right;
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
