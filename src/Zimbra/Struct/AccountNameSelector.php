<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Struct;

use Zimbra\Enum\AccountBy;

/**
 * AccountNameSelector struct class
 *
 * @package   Zimbra
 * @category  Struct
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class AccountNameSelector extends Base
{
    /**
     * Constructor method for AccountNameSelector
     * @param  AccountBy $by
     * @param  string $name
     * @param  string $value
     * @return self
     */
    public function __construct(AccountBy $by, $name = null, $value = null)
    {
        parent::__construct(trim($value));
        $this->setProperty('by', $by);
        $this->setProperty('name', $name);
    }

    /**
     * Sets account by enum
     *
     * @return AccountBy
     */
    public function getBy()
    {
        return $this->getProperty('by');
    }

    /**
     * Gets account by enum
     *
     * @param  AccountBy $by
     * @return self
     */
    public function setBy(AccountBy $by)
    {
        return $this->setProperty('by', $by);
    }

    /**
     * Gets name
     *
     * @return string
     */
    public function getName()
    {
        return $this->getProperty('name');
    }

    /**
     * Sets name
     *
     * @param  string $name
     * @return self
     */
    public function setName($name)
    {
        return $this->setProperty('name', trim($name));
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'account')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'account')
    {
        return parent::toXml($name);
    }
}
