<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\API\Mail\Request;

use Zimbra\Soap\Request;
use Zimbra\Soap\Struct\ModifyContactSpec;

/**
 * ModifyContact request class
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class ModifyContact extends Request
{
    /**
     * Specification of contact modifications
     * @var ModifyContactSpec
     */
    private $_cn;

    /**
     * If set, all attrs and group members in the specified contact are replaced with specified attrs and group members,
     * otherwise the attrs and group members are merged with the existing contact.
     * Unset by default.
     * @var bool
     */
    private $_replace;

    /**
     * If unset, the returned <cn> is just a placeholder containing the contact ID (i.e. <cn id="{id}"/>). {verbose} is set by default.
     * @var bool
     */
    private $_verbose;

    /**
     * Constructor method for ModifyContact
     * @param  ModifyContactSpec $cn
     * @param  bool $replace
     * @param  bool $verbose
     * @return self
     */
    public function __construct(
    	ModifyContactSpec $cn,
    	$replace = null,
    	$verbose = null
	)
    {
        parent::__construct();
        $this->_cn = $cn;
        if(null !== $replace)
        {
            $this->_replace = (bool) $replace;
        }
        if(null !== $verbose)
        {
            $this->_verbose = (bool) $verbose;
        }
    }

    /**
     * Get or set cn
     *
     * @param  ModifyContactSpec $cn
     * @return ModifyContactSpec|self
     */
    public function cn(ModifyContactSpec $cn = null)
    {
        if(null === $cn)
        {
            return $this->_cn;
        }
        $this->_cn = $cn;
        return $this;
    }

    /**
     * Get or set replace
     *
     * @param  bool $replace
     * @return bool|self
     */
    public function replace($replace = null)
    {
        if(null === $replace)
        {
            return $this->_replace;
        }
        $this->_replace = (bool) $replace;
        return $this;
    }

    /**
     * Get or set verbose
     *
     * @param  bool $verbose
     * @return bool|self
     */
    public function verbose($verbose = null)
    {
        if(null === $verbose)
        {
            return $this->_verbose;
        }
        $this->_verbose = (bool) $verbose;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        if(is_bool($this->_replace))
        {
            $this->array['replace'] = $this->_replace ? 1 : 0;
        }
        if(is_bool($this->_verbose))
        {
            $this->array['verbose'] = $this->_verbose ? 1 : 0;
        }
        $this->array += $this->_cn->toArray('cn');
        return parent::toArray();
    }

    /**
     * Method returning the xml representation of this class
     *
     * @return SimpleXML
     */
    public function toXml()
    {
        if(is_bool($this->_replace))
        {
            $this->xml->addAttribute('replace', $this->_replace ? 1 : 0);
        }
        if(is_bool($this->_verbose))
        {
            $this->xml->addAttribute('verbose', $this->_verbose ? 1 : 0);
        }
        $this->xml->append($this->_cn->toXml('cn'));
        return parent::toXml();
    }
}
