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
class ModifyContact extends Base
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
        $this->setChild('cn', $cn);
        if(null !== $replace)
        {
            $this->setProperty('replace', (bool) $replace);
        }
        if(null !== $verbose)
        {
            $this->setProperty('verbose', (bool) $verbose);
        }
    }

    /**
     * Gets specification of contact modifications
     *
     * @return ModifyContactSpec
     */
    public function getContact()
    {
        return $this->getChild('cn');
    }

    /**
     * Sets specification of contact modifications
     *
     * @param  ModifyContactSpec $contact
     * @return self
     */
    public function setContact(ModifyContactSpec $contact)
    {
        return $this->setChild('cn', $contact);
    }

    /**
     * Gets replace mode
     *
     * @return bool
     */
    public function getReplace()
    {
        return $this->getProperty('replace');
    }

    /**
     * Sets replace mode
     *
     * @param  bool $replace
     * @return self
     */
    public function setReplace($replace)
    {
        return $this->setProperty('replace', (bool) $replace);
    }

    /**
     * Gets verbose
     *
     * @return bool
     */
    public function getVerbose()
    {
        return $this->getProperty('verbose');
    }

    /**
     * Sets verbose
     *
     * @param  bool $verbose
     * @return self
     */
    public function setVerbose($verbose)
    {
        return $this->setProperty('verbose', (bool) $verbose);
    }
}
