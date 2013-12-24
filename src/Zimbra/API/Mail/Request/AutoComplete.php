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
use Zimbra\Utils\SimpleXML;

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
    private $_type;

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
     * @param  array  $folders
     * @param  bool   $includeGal
     * @return self
     */
    public function __construct($name, GalSearchType $type = null, $needExp = null, array $folders = null, $includeGal = null)
    {
        parent::__construct();
        $this->_name = (string) $name;
        if($type instanceof GalSearchType)
        {
            $this->_type = $type;
        }
        if($needExp !== null)
        {
            $this->_needExp = (bool) $needExp;
        }
        if($folders !== null)
        {
            $this->_folders = $folders;
        }
        if($includeGal !== null)
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
        $this->_name = (string) $name;
        return $this;
    }

    /**
     * Get or set type
     *
     * @param  GalSearchType $type
     * @return GalSearchType|self
     */
    public function type(GalSearchType $type = null)
    {
        if(null === $type)
        {
            return $this->_type;
        }
        $this->_type = $type;
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
     * Add a folder name
     *
     * @param  string $folder
     * @return string|self
     */
    public function addFolder($folder)
    {
        if(!empty($folder))
        {
            $this->_folders[] = (string) $folder;
        }
        return $this;
    }

    /**
     * Get or set folders
     *
     * @param  array $folders
     * @return array|self
     */
    public function folders(array $folders = null)
    {
        if(null === $folders)
        {
            return $this->_folders;
        }
        foreach ($folders as $folder)
        {
            if(!empty($folder))
            {
                $this->_folders[] = (string) $folder;
            }
        }
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
        $arr = array(
            'name' => $this->_name,
        );
        if($this->_type !== null)
        {
            $arr['t'] = (string) $this->_type;
        }
        if($this->_needExp !== null)
        {
            $arr['needExp'] = (bool) $this->_needExp ? 1 : 0;
        }
        if(count($this->_folders))
        {
            $arr['folder'] = implode(',', $this->_folders);
        }
        if($this->_includeGal !== null)
        {
            $arr['includeGal'] = (bool) $this->_includeGal ? 1 : 0;
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
        if($this->_type !== null)
        {
            $this->xml->addAttribute('t', (string) $this->_type);
        }
        if($this->_needExp !== null)
        {
            $this->xml->addAttribute('needExp', (bool) $this->_needExp ? 1 : 0);
        }
        if(count($this->_folders))
        {
            $this->xml->addAttribute('folder', implode(',', $this->_folders));
        }
        if($this->_includeGal !== null)
        {
            $this->xml->addAttribute('includeGal', (bool) $this->_includeGal ? 1 : 0);
        }
        return parent::toXml();
    }
}
