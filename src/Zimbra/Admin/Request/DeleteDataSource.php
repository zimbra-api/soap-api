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

use Zimbra\Struct\Id;

/**
 * DeleteDataSource request class
 * Deletes the given data source.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class DeleteDataSource extends BaseAttr
{
    /**
     * Constructor method for DeleteDataSource
     * @param  string $id Id for an existing Account
     * @param  Id     $dataSource Data source ID
     * @param  array  $attrs
     * @return self
     */
    public function __construct($id, Id $dataSource, array $attrs = array())
    {
        parent::__construct($attrs);
        $this->property('id', trim($id));
        $this->child('dataSource', $dataSource);
    }

    /**
     * Gets or sets id
     *
     * @param  string $id
     * @return string|self
     */
    public function id($id = null)
    {
        if(null === $id)
        {
            return $this->property('id');
        }
        return $this->property('id', trim($id));
    }

    /**
     * Gets or sets dataSource
     *
     * @param  Id $dataSource
     * @return Id|self
     */
    public function dataSource(Id $dataSource = null)
    {
        if(null === $dataSource)
        {
            return $this->child('dataSource');
        }
        return $this->child('dataSource', $dataSource);
    }
}
