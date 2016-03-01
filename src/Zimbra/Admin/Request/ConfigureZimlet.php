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

use Zimbra\Admin\Struct\AttachmentIdAttrib as Attachment;

/**
 * ConfigureZimlet request class
 * Configure Zimlet.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class ConfigureZimlet extends Base
{
    /**
     * Constructor method for ConfigureZimlet
     * @param Attachment $content Content
     * @return self
     */
    public function __construct(Attachment $content)
    {
        parent::__construct();
        $this->setChild('content', $content);
    }

    /**
     * Gets the content.
     *
     * @return Attachment
     */
    public function getContent()
    {
        return $this->getChild('content');
    }

    /**
     * Sets the content.
     *
     * @param  Attachment $content
     * @return self
     */
    public function setContent(Attachment $content)
    {
        return $this->setChild('content', $content);
    }
}
