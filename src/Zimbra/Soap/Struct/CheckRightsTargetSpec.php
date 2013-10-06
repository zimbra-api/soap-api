<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Soap\Struct;

use Zimbra\Soap\Enum\TargetType;
use Zimbra\Soap\Enum\TargetBy;
use Zimbra\Utils\SimpleXML;

/**
 * CheckRightsTargetSpec class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class CheckRightsTargetSpec
{
    /**
     * Target type
     * @var string
     */
    private $_type;

    /**
     * Selects the meaning of {target-key}
     * @var string
     */
    private $_by;

    /**
     * Key for target.
     * If {target-by} is id this key is the zimbraId of the target entry 
     * If {target-by} is name this key is the name of the target entry
     * @var string
     */
    private $_key;

    /**
     * Array of right
     * @var string
     */
    private $_rights = array();

    /**
     * Constructor method for checkRightsTargetSpec
     * @param  string $type
     * @param  string $by
     * @param  string $key
     * @param  string $rights
     * @return self
     */
    public function __construct($type, $by, $key, array $rights = array())
    {
        if(TargetType::isValid(trim($type)))
        {
            $this->_type = trim($type);
        }
        else
        {
            throw new \InvalidArgumentException('Invalid target type');
        }
        if(TargetBy::isValid(trim($by)))
        {
            $this->_by = trim($by);
        }
        else
        {
            throw new \InvalidArgumentException('Invalid target by');
        }
        $this->_key = trim($key);
        foreach ($rights as $right)
        {
            $this->_rights[] = trim($right);
        }
    }

    /**
     * Gets or sets type
     *
     * @param  string $type
     * @return string|self
     */
    public function type($type = null)
    {
        if(null === $type)
        {
            return $this->_type;
        }
        if(TargetType::isValid(trim($type)))
        {
            $this->_type = trim($type);
        }
        else
        {
            throw new \InvalidArgumentException('Invalid target type');
        }
        return $this;
    }

    /**
     * Gets or sets by
     *
     * @param  string $by
     * @return string|self
     */
    public function by($by = null)
    {
        if(null === $by)
        {
            return $this->_by;
        }
        if(TargetBy::isValid(trim($by)))
        {
            $this->_by = trim($by);
        }
        else
        {
            throw new \InvalidArgumentException('Invalid target by');
        }
        return $this;
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
            return $this->_key;
        }
        $this->_key = trim($key);
        return $this;
    }

    /**
     * Add a right
     *
     * @param  string $right
     * @return CheckRightsTargetSpec
     */
    public function addRight($right)
    {
        if(!empty($right))
        {
            $this->_rights[] = trim($right);
        }
        return $this;
    }

    /**
     * Gets or sets array of right
     *
     * @return array
     */
    public function rights(array $rights = null)
    {
        if(null === $rights)
        {
            return $this->_rights;
        }
        $this->_rights = array();
        foreach ($rights as $right)
        {
            $this->_rights[] = trim($right);
        }
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        $arr = array(
            'type' => $this->_type,
            'by' => $this->_by,
            'key' => $this->_key,
        );
        if(count($this->_rights))
        {
            $arr['right'] = $this->_rights;
        }
        return array('target' => $arr);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @return SimpleXML
     */
    public function toXml()
    {
        $xml = new SimpleXML('<target />');
        $xml->addAttribute('type', $this->_type)
            ->addAttribute('by', $this->_by)
            ->addAttribute('key', $this->_key);
        if(count($this->_rights))
        {
            foreach ($this->_rights as $right)
            {
                $xml->addChild('right', (string) $right);
            }
        }
        return $xml;
    }

    /**
     * Method returning the xml string representation of this class
     *
     * @return string
     */
    public function __toString()
    {
        return $this->toXml()->asXml();
    }
}
