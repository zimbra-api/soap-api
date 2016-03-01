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

/**
 * GetDataSources request class
 * Returns all data sources defined for the given mailbox.
 * For each data source, every attribute value is returned except password. 
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetDataSources extends BaseAttr
{
    /**
     * Constructor method for GetDataSources
     * @param  string $id Account ID for an existing account
     * @param  array $attrs
     * @return self
     */
    public function __construct($id, array $attrs = [])
    {
        parent::__construct($attrs);
        $this->setProperty('id', trim($id));
    }

    /**
     * Gets id
     *
     * @return string
     */
    public function getId()
    {
        return $this->getProperty('id');
    }

    /**
     * Sets id
     *
     * @param  string $id
     * @return self
     */
    public function setId($id)
    {
        return $this->setProperty('id', trim($id));
    }
}
