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
use Zimbra\Soap\Enum\GalSearchType;

/**
 * AutoComplete request class
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class AutoComplete extends Request
{
    /**
     * The name to test for autocompletion
     * @var string
     */
    private $_name;

    /**
     * GAL Search type - default value is "account"
     * @var string
     */
    private $_t;

    /**
     * Set if the "exp" flag is needed in the response for group entries. Default is unset.
     * @var boolean
     */
    private $_needExp;

    /**
     * list of folder IDs
     * @var array
     */
    private $_folders = array();

    /**
     * Flag whether to include Global Address Book (GAL)
     * @var boolean
     */
    private $_includeGal;

    /**
     * Constructor method for autoCompleteRequest
     * @param  string $name
     * @param  GalSearchType $type
     * @param  bool   $needExp
     * @param  string $folders
     * @param  bool   $includeGal
     * @return self
     */
    public function __construct($name, GalSearchType $t = null, $needExp = null, $folders = null, $includeGal = null)
    {
        parent::__construct();
        $this->_name = trim($name);
        $this->_folders = trim($folders);
        if($t instanceof GalSearchType)
        {
            $this->_t = $t;
        }
        if(null !== $needExp)
        {
            $this->_needExp = (bool) $needExp;
        }
        if(null !== $includeGal)
        {
            $this->_includeGal = (bool) $includeGal;
        }
    }

    /**
     * Get or set name
     *
     * @param  string $name
     * @return string|AutoComplete
     */
    public function name($name = null)
    {
        if(null === $name)
        {
            return $this->_name;
        }
        $this->_name = trim($name);
        return $this;
    }

    /**
     * Get or set t
     *
     * @param  GalSearchType $t
     * @return GalSearchType|self
     */
    public function t(GalSearchType $t = null)
    {
        if(null === $t)
        {
            return $this->_t;
        }
        $this->_t = $t;
        return $this;
    }

    /**
     * Get or set needExp
     *
     * @param  bool $needExp
     * @return bool|self
     */
    public function needExp($needExp = null)
    {
        if(null === $needExp)
        {
            return $this->_needExp;
        }
        $this->_needExp = (bool) $needExp;
        return $this;
    }

    /**
     * Get or set folders
     *
     * @param  string $folders
     * @return string|self
     */
    public function folders($folders = null)
    {
        if(null === $folders)
        {
            return $this->_folders;
        }
        $this->_folders = trim($folders);
        return $this;
    }

    /**
     * Get or set includeGal
     *
     * @param  bool $includeGal
     * @return bool|self
     */
    public function includeGal($includeGal = null)
    {
        if(null === $includeGal)
        {
            return $this->_includeGal;
        }
        $this->_includeGal = (bool) $includeGal;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        $this->array = array(
            'name' => $this->_name,
        );
        if($this->_t instanceof GalSearchType)
        {
            $this->array['t'] = (string) $this->_t;
        }
        if(is_bool($this->_needExp))
        {
            $this->array['needExp'] = $this->_needExp ? 1 : 0;
        }
        if(!empty($this->_folders))
        {
            $this->array['folders'] = $this->_folders;
        }
        if(is_bool($this->_includeGal))
        {
            $this->array['includeGal'] = $this->_includeGal ? 1 : 0;
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
        $this->xml->addAttribute('name', $this->_name);
        if($this->_t instanceof GalSearchType)
        {
            $this->xml->addAttribute('t', (string) $this->_t);
        }
        if(is_bool($this->_needExp))
        {
            $this->xml->addAttribute('needExp', $this->_needExp ? 1 : 0);
        }
        if(!empty($this->_folders))
        {
            $this->xml->addAttribute('folders', $this->_folders);
        }
        if(is_bool($this->_includeGal))
        {
            $this->xml->addAttribute('includeGal', $this->_includeGal ? 1 : 0);
        }
        return parent::toXml();
    }
}
