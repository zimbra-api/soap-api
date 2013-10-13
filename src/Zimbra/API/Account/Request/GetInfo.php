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
use Zimbra\Soap\Enum\SectionType;

/**
 * GetInfo class
 * Get information about an account.
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetInfo extends Request
{
    /**
     * Comma separated list of sections to return information about.
     * @var string
     */
    public $_rights;

    /**
     * Comma separated list of rights to return information about.
     * Sections are: mbox,prefs,attrs,zimlets,props,idents,sigs,dsrcs,children
     * @var string
     */
    public $_sections;

    /**
     * Constructor method for getInfoRequest
     * @param string $sections
     * @param string $rights
     * @return self
     */
    public function __construct($sections = null, $rights = null)
    {
        parent::__construct();
        if(null !== $sections)
        {
            $this->sections($sections);
        }
        $this->_rights = trim($rights);
    }

    /**
     * Gets or sets rights
     *
     * @param  string $rights
     * @return string|self
     */
    public function rights($rights = null)
    {
        if(null === $rights)
        {
            return $this->_rights;
        }
        $this->_rights = trim($rights);
        return $this;
    }

    /**
     * Gets or sets sections
     * Sections are: mbox,prefs,attrs,zimlets,props,idents,sigs,dsrcs,children
     *
     * @param  string $sections
     * @return string|self
     */
    public function sections($sections = null)
    {
        if(null === $sections)
        {
            return $this->_sections;
        }
        $this->_sections = '';
        $sections = explode(',', $sections);
        foreach ($sections as $section)
        {
            $section = trim($section);
            if(SectionType::has($section))
            {
                $this->_sections = empty($this->_sections) ? $section : $this->_sections . ',' . $section;
            }
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
        if(!empty($this->_rights))
        {
            $this->array['rights'] = $this->_rights;
        }
        if(!empty($this->_sections))
        {
            $this->array['sections'] = $this->_sections;
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
        if(!empty($this->_rights))
        {
            $this->xml->addAttribute('rights', $this->_rights);
        }
        if(!empty($this->_sections))
        {
            $this->xml->addAttribute('sections', $this->_sections);
        }
        return parent::toXml();
    }
}
