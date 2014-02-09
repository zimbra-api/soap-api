<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Account\Request;

/**
 * GetDistributionListMembers request class
 * Get the list of members of a distribution list.
 *
 * @package    Zimbra
 * @subpackage Account
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetDistributionListMembers extends Base
{
    /**
     * Constructor method for GetDistributionListMembers
     * @param string $ld     The name of the distribution list
     * @param int    $limit  The number of members to return (0 is default and means all)
     * @param int    $offset The starting offset (0, 25, etc)
     * @return self
     */
    public function __construct($dl, $limit = null, $offset = null)
    {
        parent::__construct();
        $this->child('dl', trim($dl));
        if(null !== $limit)
        {
            $this->property('limit', (int) $limit);
        }
        if(null !== $offset)
        {
            $this->property('offset', (int) $offset);
        }
    }

    /**
     * Gets or sets dl
     *
     * @param  string $dl The name of the distribution list
     * @return string|self
     */
    public function dl($dl = null)
    {
        if(null === $dl)
        {
            return $this->child('dl');
        }
        return $this->child('dl', trim($dl));
    }

    /**
     * Gets or sets limit
     *
     * @param  int $limit The number of members to return (0 is default and means all)
     * @return int|self
     */
    public function limit($limit = null)
    {
        if(null === $limit)
        {
            return $this->property('limit');
        }
        return $this->property('limit', (int) $limit);
    }

    /**
     * Gets or sets offset
     *
     * @param  int $offset The starting offset (0, 25, etc)
     * @return int|self
     */
    public function offset($offset = null)
    {
        if(null === $offset)
        {
            return $this->property('offset');
        }
        return $this->property('offset', (int) $offset);
    }
}
