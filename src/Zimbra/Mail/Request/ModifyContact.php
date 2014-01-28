<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Request;

use Zimbra\Mail\Struct\ModifyContactSpec;
use Zimbra\Soap\Request;

/**
 * ModifyContact request class
 * Modify Contact
 * When modifying tags, all specified tags are set and all others are unset.
 * If tn="{tag-names}" is NOT specified then any existing tags will remain set.
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class ModifyContact extends Request
{
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
        $this->child('cn', $cn);
        if(null !== $replace)
        {
            $this->property('replace', (bool) $replace);
        }
        if(null !== $verbose)
        {
            $this->property('verbose', (bool) $verbose);
        }
    }

    /**
     * Get or set cn
     * Specification of contact modifications
     *
     * @param  ModifyContactSpec $cn
     * @return ModifyContactSpec|self
     */
    public function cn(ModifyContactSpec $cn = null)
    {
        if(null === $cn)
        {
            return $this->child('cn');
        }
        return $this->child('cn', $cn);
    }

    /**
     * Get or set replace
     * If set, all attrs and group members in the specified contact are replaced with specified attrs and group members,
     * otherwise the attrs and group members are merged with the existing contact.
     * Unset by default.
     *
     * @param  bool $replace
     * @return bool|self
     */
    public function replace($replace = null)
    {
        if(null === $replace)
        {
            return $this->property('replace');
        }
        return $this->property('replace', (bool) $replace);
    }

    /**
     * Get or set verbose
     * If unset, the returned <cn> is just a placeholder containing the contact ID (i.e. <cn id="{id}"/>). {verbose} is set by default.
     *
     * @param  bool $verbose
     * @return bool|self
     */
    public function verbose($verbose = null)
    {
        if(null === $verbose)
        {
            return $this->property('verbose');
        }
        return $this->property('verbose', (bool) $verbose);
    }
}
