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

use Zimbra\Enum\AutoProvPrincipalBy as PrincipalBy;
use Zimbra\Struct\Base;

/**
 * PrincipalSelector struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class PrincipalSelector extends Base
{
    /**
     * Constructor method for PrincipalSelector
     * @param  PrincipalBy $by Meaning determined by {principal-selector-by}
     * @param  string $value The key used to identify the principal
     * @return self
     */
    public function __construct(PrincipalBy $by, $value = null)
    {
        parent::__construct(trim($value));
        $this->setProperty('by', $by);
    }

    /**
     * Gets by enum
     *
     * @return Zimbra\Enum\PrincipalBy
     */
    public function getBy()
    {
        return $this->getProperty('by');
    }

    /**
     * Sets by enum
     *
     * @param  Zimbra\Enum\PrincipalBy $by
     * @return self
     */
    public function setBy(PrincipalBy $by)
    {
        return $this->setProperty('by', $by);
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'principal')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'principal')
    {
        return parent::toXml($name);
    }
}
