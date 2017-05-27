<?php

/**
 * Class HtmlEditorFolder_Toolbar
 * Extension for HtmlEditorField_Toolbar which sets folder name for media form, including default folder for "From CMS"
 */
class HtmlEditorFolder_Toolbar extends Extension
{

	/**
	 * @return mixed folder path as set by current page, or false if not found
	 */
	function getCurrentFolder()
	{
		$currentPage = $this->owner->controller->currentPage();
		return method_exists($currentPage, 'getHtmlEditorFolder') ?
			$currentPage->getHtmlEditorFolder() :
			false;
	}

	/**
	 * Update the media form, set current folder and use our upload field template (displays upload path)
	 * @param $form
	 */
	function updateMediaForm($form)
	{
		if ($uploadField = $form->Fields()->dataFieldByName('AssetUploadField')) {
			$uploadField->setFolderName($this->getCurrentFolder());
			$uploadField->setTemplate('HtmlEditorFolder_UploadField');
		}
	}

	/**
	 * Update parent folder ID for "From CMS" default folder selection (media dialog)
	 * @param $parentID
	 */
	function updateAttachParentID(&$parentID)
	{
		if (
			($folderPath = $this->getCurrentFolder()) &&
			($parentFolder = Folder::find_or_make($folderPath))
		) {
			$parentID = $parentFolder->ID;
		}
	}

	/**
	 * Update the link form, set current folder
	 * @param $form
	 */
	function updateLinkForm($form)
	{
		if ($uploadField = $form->Fields()->dataFieldByName('file')) {
			$uploadField->setFolderName($this->getCurrentFolder());
			$uploadField->setDisplayFolderName($this->getCurrentFolder());
		}
	}

}
