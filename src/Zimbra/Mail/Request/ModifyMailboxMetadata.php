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

use Zimbra\Mail\Struct\MailCustomMetadata;

/**
 * ModifyMailboxMetadata request class
 * Modify Mailbox Metadata
 *   - Modify request must contain one or more key/value pairs
 *   - Existing keys' values will be replaced by new values
 *   - Empty or null value will remove a key
 *   - New keys can be added
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class ModifyMailboxMetadata extends Base
{
    /**
     * Constructor method for ModifyMailboxMetadata
     * @param  MailCustomMetadata $meta
     * @return self
     */
    public function __construct(MailCustomMetadata $meta = null)
    {
        parent::__construct();
        if($meta instanceof MailCustomMetadata)
        {
            $this->child('meta', $meta);
        }
    }

    /**
     * Get or set meta
     *
     * @param  MailCustomMetadata $meta
     * @return MailCustomMetadata|self
     */
    public function meta(MailCustomMetadata $meta = null)
    {
        if(null === $meta)
        {
            return $this->child('meta');
        }
        return $this->child('meta', $meta);
    }
}
