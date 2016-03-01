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

use Zimbra\Enum\DataSourceBy;
use Zimbra\Struct\Base;

/**
 * SyncGalAccountDataSourceSpec struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class SyncGalAccountDataSourceSpec extends Base
{
    /**
     * Constructor method for SyncGalAccountDataSourceSpec
     * @param DataSourceBy $by The by
     * @param string $value The value
     * @param bool $fullSync If fullSync is set to 0 (false) or unset the default behavior is trickle sync which will pull in any new contacts or modified contacts since last sync. If fullSync is set to 1 (true), then the server will go through all the contacts that appear in GAL, and resolve deleted contacts in addition to new or modified ones.
     * @param bool $reset Reset flag. If set, then all the contacts will be populated again, regardless of the status since last sync.
     * @return self
     */
    public function __construct(
        DataSourceBy $by,
        $value = null,
        $fullSync = null,
        $reset = null
    )
    {
        parent::__construct(trim($value));
        $this->setProperty('by', $by);
        if(null !== $fullSync)
        {
            $this->setProperty('fullSync', (bool) $fullSync);
        }
        if(null !== $reset)
        {
            $this->setProperty('reset', (bool) $reset);
        }
    }

    /**
     * Gets by enum
     *
     * @return Zimbra\Enum\DataSourceBy
     */
    public function getBy()
    {
        return $this->getProperty('by');
    }

    /**
     * Sets by enum
     *
     * @param  Zimbra\Enum\DataSourceBy $by
     * @return self
     */
    public function setBy(DataSourceBy $by)
    {
        return $this->setProperty('by', $by);
    }

    /**
     * Gets the full sync flag
     *
     * @return bool
     */
    public function getFullSync()
    {
        return $this->getProperty('fullSync');
    }

    /**
     * Sets the full sync flag
     *
     * @param  bool $fullSync
     * @return self
     */
    public function setFullSync($fullSync)
    {
        return $this->setProperty('fullSync', (bool) $fullSync);
    }

    /**
     * Gets the reset flag
     *
     * @return bool
     */
    public function getReset()
    {
        return $this->getProperty('reset');
    }

    /**
     * Sets the reset flag
     *
     * @param  bool $reset
     * @return self
     */
    public function setReset($reset)
    {
        return $this->setProperty('reset', (bool) $reset);
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'datasource')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'datasource')
    {
        return parent::toXml($name);
    }
}
