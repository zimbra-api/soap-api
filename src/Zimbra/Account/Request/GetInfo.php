<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Account\Request;

use Zimbra\Enum\SectionType;

/**
 * GetInfo request class
 * Get information about an account.
 *
 * @package    Zimbra
 * @subpackage Account
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetInfo extends Base
{
    /**
     * Constructor method for GetInfo
     * @param string $sections Comma separated list of sections to return information about. Sections are: mbox,prefs,attrs,zimlets,props,idents,sigs,dsrcs,children
     * @param string $rights Comma separated list of rights to return information about.
     * @return self
     */
    public function __construct($sections = null, $rights = null)
    {
        parent::__construct();
        if(null !== $sections)
        {
            $this->setSections($sections);
        }
        if(null !== $rights)
        {
            $this->setProperty('rights', trim($rights));
        }
    }

    /**
     * Gets the rights
     *
     * @return string
     */
    public function getRights()
    {
        return $this->getProperty('rights');
    }

    /**
     * Sets the rights
     *
     * @param  string $rights
     * @return self
     */
    public function setRights($rights)
    {
        return $this->setProperty('rights', trim($rights));
    }

    /**
     * Gets sections
     * Sections are: mbox,prefs,attrs,zimlets,props,idents,sigs,dsrcs,children
     *
     * @return string
     */
    public function getSections()
    {
        return $this->getProperty('sections');
    }

    /**
     * Sets sections
     * Sections are: mbox,prefs,attrs,zimlets,props,idents,sigs,dsrcs,children
     *
     * @param  string $sections
     * @return self
     */
    public function setSections($sections)
    {
        $secs = [];
        $sections = explode(',', $sections);
        foreach ($sections as $section)
        {
            $section = trim($section);
            if(SectionType::has($section) && !in_array($section, $secs))
            {
                $secs[] = $section;
            }
        }
        return $this->setProperty('sections', implode(',', $secs));
    }
}
