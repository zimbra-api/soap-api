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
     * @param  string $entryTypes Comma separated list of entry types. Attributes on the specified entry types will be returned.
     * @return self
     */
    public function __construct($attrs = null, array $entryTypes = array())
    {
        parent::__construct();
        if(null !== $attrs)
        {
            $this->property('attrs', trim($attrs));
        }
        $this->_entryTypes = new TypedSequence('Zimbra\Enum\EntryType', $entryTypes);

        $this->addHook(function($sender)
        {
            $entryTypes = $sender->entryTypes();
            if(!empty($entryTypes))
            {
                $sender->property('entryTypes', $sender->entryTypes());
            }
        });
    }

    /**
     * Gets or sets attrs
     *
     * @param  string $attrs
     * @return string|self
     */
    public function attrs($attrs = null)
    {
        if(null === $attrs)
        {
            return $this->property('attrs');
        }
        return $this->property('attrs', trim($attrs));
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
     * Gets entryTypes
     *
     * @return Sequence
     */
    public function entryTypes()
    {
        return count($this->_entryTypes) ? implode(',', $this->_entryTypes->all()) : '';
    }
}
