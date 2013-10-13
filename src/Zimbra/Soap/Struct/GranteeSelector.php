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

use Zimbra\Soap\Enum\GranteeType;
use Zimbra\Soap\Enum\GranteeBy;
use Zimbra\Utils\SimpleXML;

/**
 * GranteeChooser class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class GranteeSelector
{
    /**
     * The grantee
     * @var string
     */
    private $_value;

    /**
     * The type
     * @var GranteeType
     */
    private $_type;

    /**
     * The by
     * @var GranteeBy
     */
    private $_by;

    /**
     * Password for guest grantee or the access key for key grantee For user right only
     * @var string
     */
    private $_secret;

    /**
     * For GetGrantsRequest, selects whether to include grants granted to groups the specified grantee belongs to.
     * Default is 1 (true)
     * @var bool
     */
    private $_all;

    /**
     * Constructor method for granteeSelector
     * @see parent::__construct()
     * @param string $value
     * @param string $type
     * @param string $by
     * @param string $secret
     * @param bool   $all
     * @return self
     */
    public function __construct(
        $value = null,
        GranteeType $type = null,
        GranteeBy $by = null,
        $secret = null,
        $all = null)
    {
        $this->_value = trim($value);
        if($type instanceof GranteeType)
        {
            $this->_type = $type;
        }
        if($by instanceof GranteeBy)
        {
            $this->_by = $by;
        }
        $this->_secret = trim($secret);
        if(null !== $all)
        {
            $this->_all = (bool) $all;
        }
    }

    /**
     * Gets or sets value
     *
     * @param  string $value
     * @return string|self
     */
    public function value($value = null)
    {
        if(null === $value)
        {
            return $this->_value;
        }
        $this->_value = trim($value);
        return $this;
    }

    /**
     * Gets or sets type
     *
     * @param  GranteeType $type
     * @return GranteeType|self
     */
    public function type(GranteeType $type = null)
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
     * @param  GranteeBy $by
     * @return GranteeBy|self
     */
    public function by(GranteeBy $by = null)
    {
        if(null === $by)
        {
            return $this->_by;
        }
        $this->_by = $by;
        return $this;
    }

    /**
     * Gets or sets secret
     *
     * @param  string $secret
     * @return string|self
     */
    public function secret($secret = null)
    {
        if(null === $secret)
        {
            return $this->_secret;
        }
        $this->_secret = trim($secret);
        return $this;
    }

    /**
     * Gets or sets all
     *
     * @param  bool $all
     * @return bool|self
     */
    public function all($all = null)
    {
        if(null === $all)
        {
            return $this->_all;
        }
        $this->_all = (bool) $all;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray()
    {
        $arr = array(
            '_' => $this->_value,
        );

        if($this->_type instanceof GranteeType)
        {
            $arr['type'] = (string) $this->_type;
        }
        if($this->_by instanceof GranteeBy)
        {
            $arr['by'] = (string) $this->_by;
        }
        if(!empty($this->_secret))
        {
            $arr['secret'] = $this->_secret;
        }
        if(is_bool($this->_all))
        {
            $arr['all'] = (bool) $this->_all ? 1 : 0;
        }
        return array('grantee' => $arr);
    }

    /**
     * Method returning the xml representative this class
     *
     * @return SimpleXML
     */
    public function toXml()
    {
        $xml = new SimpleXML('<grantee>'. $this->_value.'</grantee>');
        if($this->_type instanceof GranteeType)
        {
            $xml->addAttribute('type', (string) $this->_type);
        }
        if($this->_by instanceof GranteeBy)
        {
            $xml->addAttribute('by', (string) $this->_by);
        }
        if(!empty($this->_secret))
        {
            $xml->addAttribute('secret', $this->_secret);
        }
        if(is_bool($this->_all))
        {
            $xml->addAttribute('all', (bool) $this->_all ? 1 : 0);
        }

        return $xml;
    }

    /**
     * Method returning the xml string representative this class
     *
     * @return string
     */
    public function __toString()
    {
        return $this->toXml()->asXml();
    }
}
