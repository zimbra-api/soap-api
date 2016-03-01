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
 * CreateUCService request class
 * Create a UC service.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class CreateUCService extends BaseAttr
{
    /**
     * New ucservice name
     * @var string
     */
    private $_name;

    /**
     * Constructor method for CreateUCService
     * @param string $name
     * @param array  $attrs
     * @return self
     */
    public function __construct($name, array $attrs = [])
    {
        parent::__construct($attrs);
        $this->setChild('name', trim($name));
    }

    /**
     * Gets name
     *
     * @return string
     */
    public function getName()
    {
        return $this->getChild('name');
    }

    /**
     * Sets name
     *
     * @param  string $name
     * @return self
     */
    public function setName($name)
    {
        return $this->setChild('name', trim($name));
    }
}
