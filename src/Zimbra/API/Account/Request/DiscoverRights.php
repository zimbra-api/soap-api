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
     * @var array
     */
    private $_rights = array();

    /**
     * Constructor method for DiscoverRights
     * @param  array $rights
     * @return self
     */
    public function __construct(array $rights)
    {
        parent::__construct();
        $this->rights($rights);
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
            $this->_rights[] = $right;
        }
        return $this;
    }

    /**
     * Gets or sets rights
     *
     * @param  array $rights
     * @return array|self
     */
    public function rights(array $rights = null)
    {
        if(null === $rights)
        {
            return $this->_rights;
        }
        else
        {
            $this->_rights = array();
            foreach ($rights as $right)
            {
                $right = trim($right);
                if(!empty($right))
                {
                    $this->_rights[] = $right;
                }
            }
            if(count($this->_rights) === 0)
            {
                throw new \InvalidArgumentException('DiscoverRights must have at least one right');
            }
            return $this;
        }
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        if(count($this->_rights))
        {
            $this->array['right'] = $this->_rights;
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
        if(count($this->_rights))
        {
            foreach ($this->_rights as $right)
            {
                $this->xml->addChild('right', $right);
            }
        }
        return parent::toXml();
    }
}
