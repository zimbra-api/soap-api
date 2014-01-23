<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Struct;

use Zimbra\Enum\CacheEntryBy;
use Zimbra\Struct\Base;

/**
 * CacheEntrySelector struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class CacheEntrySelector extends Base
{
    /**
     * Select the meaning of {acct-selector-key}
     * Valid values: adminName|appAdminName|id|foreignPrincipal|name|krb5Principal
     * @var CacheEntryBy
     */
    private $_by;

    /**
     * Specifies the account to authenticate against
     * @var string
     */
    private $_value;

    /**
     * Constructor method for CacheEntrySelector
     * @param  CacheEntryBy $by Select the meaning of {cache-entry-key}
     * @param  string $value The key used to identify the cache entry
     * @return self
     */
    public function __construct(CacheEntryBy $by, $value = null)
    {
        parent::__construct(trim($value));
        $this->property('by', $by);
    }

    /**
     * Gets or sets by
     *
     * @param  CacheEntryBy $by
     * @return CacheEntryBy|self
     */
    public function by(CacheEntryBy $by = null)
    {
        if(null === $by)
        {
            return $this->property('by');
        }
        return $this->property('by', $by);
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'entry')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'entry')
    {
        return parent::toXml($name);
    }
}
