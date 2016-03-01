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

use Zimbra\Admin\Struct\CalendarResourceSelector as Calendar;
use Zimbra\Struct\AttributeSelectorTrait;
use Zimbra\Struct\AttributeSelector;

/**
 * GetCalendarResource request class
 * Get a calendar resource.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetCalendarResource extends Base implements AttributeSelector
{
    use AttributeSelectorTrait;

    /**
     * Constructor method for GetCalendarResource
     * @param  Calendar $calResource Specify calendar resource
     * @param  bool $applyCos Flag whether to apply Class of Service (COS)
     * @param  string $attrs Comma separated list of attributes
     * @return self
     */
    public function __construct(Calendar $calResource = null, $applyCos = null, array $attrs = [])
    {
        parent::__construct();
        if($calResource instanceof Calendar)
        {
            $this->setChild('calresource', $calResource);
        }
        if(null !== $applyCos)
        {
            $this->setProperty('applyCos', (bool) $applyCos);
        }

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
     * Gets the calResource.
     *
     * @return Calendar
     */
    public function getCalResource()
    {
        return $this->getChild('calresource');
    }

    /**
     * Sets the calResource.
     *
     * @param  Calendar $calResource
     * @return self
     */
    public function setCalResource(Calendar $calResource)
    {
        return $this->setChild('calresource', $calResource);
    }

    /**
     * Gets applyCos
     *
     * @return bool
     */
    public function getApplyCos()
    {
        return $this->getProperty('applyCos');
    }

    /**
     * Sets applyCos
     *
     * @param  bool $applyCos
     * @return self
     */
    public function setApplyCos($applyCos)
    {
        return $this->setProperty('applyCos', (bool) $applyCos);
    }
}
