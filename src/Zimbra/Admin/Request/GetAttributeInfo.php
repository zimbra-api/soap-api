<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Request;

use Zimbra\Common\TypedSequence;
use Zimbra\Enum\EntryType;

/**
 * GetAttributeInfo request class
 * Get attribute information.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetAttributeInfo extends Base
{
    /**
     * Comma separated list of entry types.
     * Attributes on the specified entry types will be returned.
     * @var string
     */
    private $_entryTypes;

    /**
     * Constructor method for GetAttributeInfo
     * @param  string $attrs Comma separated list of attributes to return
     * @param  array $entryTypes An array of entry types. Attributes on the specified entry types will be returned.
     * @return self
     */
    public function __construct($attrs = null, array $entryTypes = [])
    {
        parent::__construct();
        if(null !== $attrs)
        {
            $this->setProperty('attrs', trim($attrs));
        }
        $this->setEntryTypes($entryTypes);

        $this->on('before', function(Base $sender)
        {
            $entryTypes = $sender->getEntryTypes();
            if(!empty($entryTypes))
            {
                $sender->setProperty('entryTypes', $entryTypes);
            }
        });
    }

    /**
     * Gets attrs
     *
     * @return string
     */
    public function getAttrs()
    {
        return $this->getProperty('attrs');
    }

    /**
     * Sets attrs
     *
     * @param  string $attrs
     * @return self
     */
    public function setAttrs($attrs)
    {
        return $this->setProperty('attrs', trim($attrs));
    }

    /**
     * Add an EntryType
     *
     * @param  EntryType $entryType
     * @return self
     */
    public function addEntryType(EntryType $entryType)
    {
        $this->_entryTypes->add($entryType);
        return $this;
    }

    /**
     * Sets entryTypes
     *
     * @param  string $entryTypes
     * @return self
     */
    public function setEntryTypes(array $entryTypes)
    {
        $this->_entryTypes = new TypedSequence('Zimbra\Enum\EntryType', $entryTypes);
        return $this;
    }

    /**
     * Gets entryTypes
     * Comma separated list of entry types. Attributes on the specified entry types will be returned.
     *
     * @return Sequence
     */
    public function getEntryTypes()
    {
        return count($this->_entryTypes) ? implode(',', $this->_entryTypes->all()) : '';
    }
}
