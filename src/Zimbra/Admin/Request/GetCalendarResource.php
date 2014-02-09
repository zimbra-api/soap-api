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
class GetCalendarResource extends Base
{
    /**
     * Constructor method for GetCalendarResource
     * @param  Calendar $calResource Specify calendar resource
     * @param  bool $applyCos Flag whether to apply Class of Service (COS)
     * @param  string $attrs Comma separated list of attributes
     * @return self
     */
    public function __construct(Calendar $calResource = null, $applyCos = null, $attrs = null)
    {
        parent::__construct();
        if($calResource instanceof Calendar)
        {
            $this->child('calresource', $calResource);
        }
        if(null !== $applyCos)
        {
            $this->property('applyCos', (bool) $applyCos);
        }
        if(null !== $attrs)
        {
            $this->property('attrs', trim($attrs));
        }
    }

    /**
     * Gets or sets calResource
     *
     * @param  Calendar $calResource
     * @return Calendar|self
     */
    public function calResource(Calendar $calResource = null)
    {
        if(null === $calResource)
        {
            return $this->child('calresource');
        }
        return $this->child('calresource', $calResource);
    }

    /**
     * Gets or sets applyCos
     *
     * @param  bool $applyCos
     * @return bool|self
     */
    public function applyCos($applyCos = null)
    {
        if(null === $applyCos)
        {
            return $this->property('applyCos');
        }
        return $this->property('applyCos', (bool) $applyCos);
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
