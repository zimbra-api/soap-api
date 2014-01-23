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
use Zimbra\Soap\Request;

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
class GetInfo extends Request
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
            $this->sections($sections);
        }
        if(null !== $rights)
        {
            $this->property('rights', trim($rights));
        }
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
            return $this->property('rights');
        }
        return $this->property('rights', trim($rights));
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
            return $this->property('sections');
        }
        $secs = array();
        $sections = explode(',', $sections);
        foreach ($sections as $section)
        {
            $section = trim($section);
            if(SectionType::has($section) && !in_array($section, $secs))
            {
                $secs[] = $section;
            }
        }
        return $this->property('sections', implode(',', $secs));
    }
}
