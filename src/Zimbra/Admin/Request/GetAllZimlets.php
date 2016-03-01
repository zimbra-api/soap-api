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
class GetAllZimlets extends Base
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
            $this->setProperty('exclude', $exclude);
        }
    }

    /**
     * Gets exclude
     *
     * @return ExcludeType
     */
    public function getExclude()
    {
        return $this->getProperty('exclude');
    }

    /**
     * Sets exclude
     *
     * @param  ExcludeType $exclude
     * @return self
     */
    public function setExclude(ExcludeType $exclude)
    {
        return $this->setProperty('exclude', $exclude);
    }
}
