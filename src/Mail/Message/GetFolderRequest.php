<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Message;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlElement};
use Zimbra\Mail\Struct\GetFolderSpec;
use Zimbra\Common\Soap\{SoapEnvelopeInterface, SoapRequest};

/**
 * GetFolderRequest class
 * Get Folder
 * 
 * A {base-folder-id}, a {base-folder-uuid} or a {fully-qualified-path} can optionally be specified in the folder
 * element; if none is present, the descent of the folder hierarchy begins at the mailbox's root folder (id 1).
 * 
 * If {fully-qualified-path} is present and {base-folder-id} or {base-folder-uuid} is also present, the path is
 * treated as relative to the folder that was specified by id/uuid.  {base-folder-id} is ignored if {base-folder-uuid}
 * is present.
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class GetFolderRequest extends SoapRequest
{
    /**
     * If set we include all visible subfolders of the specified folder.
     * @Accessor(getter="isVisible", setter="setVisible")
     * @SerializedName("visible")
     * @Type("bool")
     * @XmlAttribute
     */
    private $isVisible;

    /**
     * If set then grantee names are supplied in the <b>d</b> attribute in <b>&lt;grant></b>.
     * @Accessor(getter="isNeedGranteeName", setter="setNeedGranteeName")
     * @SerializedName("needGranteeName")
     * @Type("bool")
     * @XmlAttribute
     */
    private $needGranteeName;

    /**
     * If "view" is set then only the folders with matching view will be returned.
     * Otherwise folders with any default views will be returned.
     * @Accessor(getter="getViewConstraint", setter="setViewConstraint")
     * @SerializedName("view")
     * @Type("string")
     * @XmlAttribute
     */
    private $viewConstraint;

    /**
     * If "depth" is set to a non-negative number, we include that many levels of
     * subfolders in the response.  (so if depth="1", we'll include only the folder and its direct subfolders)
     * If depth is missing or negative, the entire folder hierarchy is returned
     * @Accessor(getter="getTreeDepth", setter="setTreeDepth")
     * @SerializedName("depth")
     * @Type("integer")
     * @XmlAttribute
     */
    private $treeDepth;

    /**
     * If  true, one level of mountpoints are traversed and the target folder's counts are
     * applied to the local mountpoint.  if the root folder as referenced by <b>{base-folder-id}</b> and/or
     * {fully-qualified-path} is a mountpoint, "tr" is regarded as being automatically set.
     * Mountpoints under mountpoints are not themselves expanded.
     * @Accessor(getter="isTraverseMountpoints", setter="setTraverseMountpoints")
     * @SerializedName("tr")
     * @Type("bool")
     * @XmlAttribute
     */
    private $traverseMountpoints;

    /**
     * Folder specification
     * @Accessor(getter="getFolder", setter="setFolder")
     * @SerializedName("folder")
     * @Type("Zimbra\Mail\Struct\GetFolderSpec")
     * @XmlElement(namespace="urn:zimbraMail")
     */
    private ?GetFolderSpec $folder = NULL;

    /**
     * Constructor method for GetFolderRequest
     *
     * @param  GetFolderSpec $folder
     * @param  bool $isVisible
     * @param  bool $needGranteeName
     * @param  string $viewConstraint
     * @param  int $treeDepth
     * @param  bool $traverseMountpoints
     * @return self
     */
    public function __construct(
        ?GetFolderSpec $folder = NULL,
        ?bool $isVisible = NULL,
        ?bool $needGranteeName = NULL,
        ?string $viewConstraint = NULL,
        ?int $treeDepth = NULL,
        ?bool $traverseMountpoints = NULL
    )
    {
        if ($folder instanceof GetFolderSpec) {
            $this->setFolder($folder);
        }
        if (NULL !== $isVisible) {
            $this->setVisible($isVisible);
        }
        if (NULL !== $needGranteeName) {
            $this->setNeedGranteeName($needGranteeName);
        }
        if (NULL !== $viewConstraint) {
            $this->setViewConstraint($viewConstraint);
        }
        if (NULL !== $treeDepth) {
            $this->setTreeDepth($treeDepth);
        }
        if (NULL !== $traverseMountpoints) {
            $this->setTraverseMountpoints($traverseMountpoints);
        }
    }

    /**
     * Gets folder
     *
     * @return GetFolderSpec
     */
    public function getFolder(): ?GetFolderSpec
    {
        return $this->folder;
    }

    /**
     * Sets folder
     *
     * @param  GetFolderSpec $folder
     * @return self
     */
    public function setFolder(GetFolderSpec $folder): self
    {
        $this->folder = $folder;
        return $this;
    }

    /**
     * Gets isVisible
     *
     * @return bool
     */
    public function isVisible(): ?bool
    {
        return $this->isVisible;
    }

    /**
     * Sets isVisible
     *
     * @param  bool $isVisible
     * @return self
     */
    public function setVisible(bool $isVisible): self
    {
        $this->isVisible = $isVisible;
        return $this;
    }

    /**
     * Gets needGranteeName
     *
     * @return bool
     */
    public function isNeedGranteeName(): ?bool
    {
        return $this->needGranteeName;
    }

    /**
     * Sets needGranteeName
     *
     * @param  bool $needGranteeName
     * @return self
     */
    public function setNeedGranteeName(bool $needGranteeName): self
    {
        $this->needGranteeName = $needGranteeName;
        return $this;
    }

    /**
     * Gets viewConstraint
     *
     * @return string
     */
    public function getViewConstraint(): ?string
    {
        return $this->viewConstraint;
    }

    /**
     * Sets viewConstraint
     *
     * @param  string $viewConstraint
     * @return self
     */
    public function setViewConstraint(string $viewConstraint): self
    {
        $this->viewConstraint = $viewConstraint;
        return $this;
    }

    /**
     * Gets treeDepth
     *
     * @return int
     */
    public function getTreeDepth(): ?int
    {
        return $this->treeDepth;
    }

    /**
     * Sets treeDepth
     *
     * @param  int $treeDepth
     * @return self
     */
    public function setTreeDepth(int $treeDepth): self
    {
        $this->treeDepth = $treeDepth;
        return $this;
    }

    /**
     * Gets traverseMountpoints
     *
     * @return bool
     */
    public function isTraverseMountpoints(): ?bool
    {
        return $this->traverseMountpoints;
    }

    /**
     * Sets traverseMountpoints
     *
     * @param  bool $traverseMountpoints
     * @return self
     */
    public function setTraverseMountpoints(bool $traverseMountpoints): self
    {
        $this->traverseMountpoints = $traverseMountpoints;
        return $this;
    }

    /**
     * Initialize the soap envelope
     *
     * @return SoapEnvelopeInterface
     */
    protected function envelopeInit(): SoapEnvelopeInterface
    {
        return new GetFolderEnvelope(
            new GetFolderBody($this)
        );
    }
}
