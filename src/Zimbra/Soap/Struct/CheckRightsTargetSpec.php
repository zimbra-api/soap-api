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
use PhpCollection\Sequence;

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
     * @var TargetType
     */
    private $_type;

    /**
     * Selects the meaning of {target-key}
     * @var TargetBy
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
     * @param  TargetType $type
     * @param  TargetBy $by
     * @param  string $key
     * @param  string $rights
     * @return self
     */
    public function __construct(TargetType $type, TargetBy $by, $key, array $rights = array())
    {
        $this->_type = $type;
        $this->_by = $by;
        $this->_key = trim($key);

        $this->_rights = new Sequence;
        foreach ($rights as $right)
        {
            $right = trim($right);
            if(!empty($right))
            {
                $this->_rights->add($right);
            }
        }
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
            return $this->_type;
        }
        $this->_type = $type;
        return $this;
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
            return $this->_by;
        }
        $this->_by = $by;
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
        $right = trim($right);
        if(!empty($right))
        {
            $this->_rights->add($right);
        }
        return $this;
    }

    /**
     * Gets rights
     *
     * @return Sequence
     */
    public function rights()
    {
        return $this->_rights;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        $arr = array(
            'type' => (string) $this->_type,
            'by' => (string) $this->_by,
            'key' => $this->_key,
        );
        if(count($this->_rights))
        {
            $arr['right'] = $this->_rights->all();
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
        $xml->addAttribute('type', (string) $this->_type)
            ->addAttribute('by', (string) $this->_by)
            ->addAttribute('key', $this->_key);
        foreach ($this->_rights as $right)
        {
            if(!empty($right))
            {
                $xml->addChild('right', $right);
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
