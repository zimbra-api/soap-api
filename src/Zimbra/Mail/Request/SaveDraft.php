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
     * @param  SaveDraftMsg $msg
     * @return self
     */
    public function __construct(SaveDraftMsg $msg)
    {
        parent::__construct();
        $this->setChild('m', $msg);
    }

    /**
     * Gets details of Draft to save
     *
     * @return SaveDraftMsg
     */
    public function getMsg()
    {
        return $this->getChild('m');
    }

    /**
     * Sets details of Draft to save
     *
     * @param  SaveDraftMsg $msg
     * @return self
     */
    public function setMsg(SaveDraftMsg $msg)
    {
        return $this->setChild('m', $msg);
    }
}
