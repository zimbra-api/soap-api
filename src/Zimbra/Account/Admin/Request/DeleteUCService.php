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

use Zimbra\Soap\Request;

/**
 * DeleteUCService request class
 * Delete a UC service.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class DeleteUCService extends Request
{
    /**
     * Constructor method for DeleteUCService
     * @param  string $id Zimbra ID
     * @return self
     */
    public function __construct($id)
    {
        parent::__construct();
        $this->child('id', trim($id));
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
            return $this->child('id');
        }
        return $this->child('id', trim($id));
    }
}
