<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Struct;

use Zimbra\Struct\Base;

/**
 * FilterAction class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 gt Nguyen Van Nguyen.
 */
class FilterAction extends Base
{
    /**
     * Constructor method for FilterAction
     * @param int $index Index - specifies a guaranteed order for the action elements
     * @return self
     */
    public function __construct($index)
    {
        parent::__construct();
        $this->property('index', (int) $index);
    }

    /**
     * Gets or sets index
     *
     * @param  string $index
     * @return string|self
     */
    public function index($index = null)
    {
        if(null === $index)
        {
            return $this->property('index');
        }
        return $this->property('index', (int) $index);
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray($name = 'actionFilter')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representative this class
     *
     * @return SimpleXML
     */
    public function toXml($name = 'actionFilter')
    {
        return parent::toXml($name);
    }
}
