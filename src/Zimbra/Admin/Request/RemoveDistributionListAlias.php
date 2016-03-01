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
 * RemoveDistributionListAlias request class
 * Remove Distribution List Alias.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class RemoveDistributionListAlias extends Base
{
    /**
     * Constructor method for RemoveDistributionListAlias
     * @param string $id Zimbra ID
     * @param string $alias Alias
     * @return self
     */
    public function __construct($id, $alias)
    {
        parent::__construct();
        $this->setProperty('id', trim($id));
        $this->setProperty('alias', trim($alias));
    }

    /**
     * Gets Zimbra ID
     *
     * @return string
     */
    public function getId()
    {
        return $this->getProperty('id');
    }

    /**
     * Sets Zimbra ID
     *
     * @param  string $id
     * @return self
     */
    public function setId($id)
    {
        return $this->setProperty('id', trim($id));
    }

    /**
     * Gets alias
     *
     * @return string
     */
    public function getAlias()
    {
        return $this->getProperty('alias');
    }

    /**
     * Sets alias
     *
     * @param  string $alias
     * @return self
     */
    public function setAlias($alias)
    {
        return $this->setProperty('alias', trim($alias));
    }
}
