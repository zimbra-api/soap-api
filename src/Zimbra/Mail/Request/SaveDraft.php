<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Request;

use Zimbra\Mail\Struct\SaveDraftMsg;

/**
 * SaveDraft request class
 * Save draft
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class SaveDraft extends Base
{
    /**
     * Constructor method for SaveDraft
     * @param  SaveDraftMsg $m
     * @return self
     */
    public function __construct(SaveDraftMsg $m)
    {
        parent::__construct();
        $this->child('m', $m);
    }

    /**
     * Get or set m
     * Details of Draft to save
     *
     * @param  SaveDraftMsg $m
     * @return SaveDraftMsg|self
     */
    public function m(SaveDraftMsg $m = null)
    {
        if(null === $m)
        {
            return $this->child('m');
        }
        return $this->child('m', $m);
    }
}
