<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\API\Account\Request;

use Zimbra\Soap\Request;
use PhpCollection\Sequence;

/**
 * DiscoverRights class
 * Return all targets of the specified rights applicable to the requested account.
 * 
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class DiscoverRights extends Request
{
    /**
     * The signature
     * @var Sequence
     */
    private $_right;

    /**
     * Constructor method for DiscoverRights
     * @param  array $rights
     * @return self
     */
    public function __construct(array $rights)
    {
        parent::__construct();
        $this->_right = new Sequence;
        foreach ($rights as $right)
        {
            $right = trim($right);
            if(!empty($right))
            {
                $this->_right->add($right);
            }
        }
        if(count($this->_right) === 0)
        {
            throw new \InvalidArgumentException('DiscoverRights must have at least one right');
        }
    }

    /**
     * Add a right
     *
     * @param  string $right
     * @return self
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
     * Gets right sequence
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
     * @return array
     */
    public function toArray()
    {
        if(count($this->_right))
        {
            foreach ($this->_right as $right)
            {
                if(!empty($right))
                {
                    $this->array['right'][] = $right;
                }
            }
        }
        return parent::toArray();
    }

    /**
     * Method returning the xml representation of this class
     *
     * @return SimpleXML
     */
    public function toXml()
    {
        if(count($this->_right))
        {
            foreach ($this->_right as $right)
            {
                if(!empty($right))
                {
                    $this->xml->addChild('right', $right);
                }
            }
        }
        return parent::toXml();
    }
}
