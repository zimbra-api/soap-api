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
use Zimbra\Struct\AttributeSelectorTrait;
use Zimbra\Struct\AttributeSelector;

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
class GetZimlet extends Base implements AttributeSelector
{
    use AttributeSelectorTrait;

    /**
     * Constructor method for GetZimlet
     * @param  Zimlet $zimlet Zimlet selector
     * @param  array $attrs A list of attributes
     * @return self
     */
    public function __construct(Zimlet $zimlet, array $attrs = [])
    {
        parent::__construct();
        $this->setChild('zimlet', $zimlet);

        $this->setAttrs($attrs);
        $this->on('before', function(Base $sender)
        {
            $attrs = $sender->getAttrs();
            if(!empty($attrs))
            {
                $sender->setProperty('attrs', $attrs);
            }
        });
    }

    /**
     * Gets the zimlet.
     *
     * @return Zimlet
     */
    public function getZimlet()
    {
        return $this->getChild('zimlet');
    }

    /**
     * Sets the zimlet.
     *
     * @param  Zimlet $zimlet
     * @return self
     */
    public function setZimlet(Zimlet $zimlet)
    {
        return $this->setChild('zimlet', $zimlet);
    }
}
