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
use Zimbra\Enum\ZimletExcludeType as ExcludeType;

/**
 * GetAllZimlets request class
 * Get all Zimlets.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetAllZimlets extends Request
{
    /**
     * Constructor method for GetAllZimlets
     * @param  ExcludeType $exclude Exclude can be "none|extension|mail"
     * @return self
     */
    public function __construct(ExcludeType $exclude = null)
    {
        parent::__construct();
        if($exclude instanceof ExcludeType)
        {
            $this->property('exclude', $exclude);
        }
    }

    /**
     * Gets or sets exclude
     *
     * @param  ExcludeType $exclude
     * @return ExcludeType|self
     */
    public function exclude(ExcludeType $exclude = null)
    {
        if(null === $exclude)
        {
            return $this->property('exclude');
        }
        return $this->property('exclude', $exclude);
    }
}
