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

use Zimbra\Enum\AlwaysOnClusterBy;
use Zimbra\Struct\Base;

/**
 * AlwaysOnClusterSelector struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class AlwaysOnClusterSelector extends Base
{
    /**
     * Constructor method for AlwaysOnClusterSelector
     * @param  Zimbra\Enum\AlwaysOnClusterBy $by Selects the meaning of alwaysOnCluster-key
     * @param  string $value Key for choosing alwaysOnCluster
     * @return self
     */
    public function __construct(AlwaysOnClusterBy $by, $value = null)
    {
        parent::__construct(trim($value));
        $this->setProperty('by', $by);
    }

    /**
     * Gets by enum
     *
     * @return Zimbra\Enum\AlwaysOnClusterBy
     */
    public function getBy()
    {
        return $this->getProperty('by');
    }

    /**
     * Sets by enum
     *
     * @param  Zimbra\Enum\AlwaysOnClusterBy $by
     * @return self
     */
    public function setBy(AlwaysOnClusterBy $by = null)
    {
        return $this->setProperty('by', $by);
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'alwaysOnCluster')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'alwaysOnCluster')
    {
        return parent::toXml($name);
    }
}
