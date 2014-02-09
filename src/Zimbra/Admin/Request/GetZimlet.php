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

use Zimbra\Struct\NamedElement as Zimlet;

/**
 * GetZimlet request class
 * Get Zimlet.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetZimlet extends Base
{
    /**
     * Constructor method for GetZimlet
     * @param  Zimlet $zimlet Zimlet selector
     * @param  string $attrs Comma separated list of attributes
     * @return self
     */
    public function __construct(Zimlet $zimlet, $attrs = null)
    {
        parent::__construct();
        $this->child('zimlet', $zimlet);
        if(null !== $attrs)
        {
            $this->property('attrs', trim($attrs));
        }
    }

    /**
     * Gets or sets zimlet
     *
     * @param  Zimlet $zimlet
     * @return Zimlet|self
     */
    public function zimlet(Zimlet $zimlet = null)
    {
        if(null === $zimlet)
        {
            return $this->child('zimlet');
        }
        return $this->child('zimlet', $zimlet);
    }

    /**
     * Gets or sets attrs
     *
     * @param  string $attrs
     * @return string|self
     */
    public function attrs($attrs = null)
    {
        if(null === $attrs)
        {
            return $this->property('attrs');
        }
        return $this->property('attrs', trim($attrs));
    }
}
