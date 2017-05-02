<?php

/**
 * Class HtmlEditorFolder_Toolbar
 * Extension for HtmlEditorField_Toolbar which sets folder name for media form
 */
class HtmlEditorFolder_Toolbar extends Extension
{

	function updateMediaForm($form)
	{
		if( $uploadField = $form->Fields()->dataFieldByName('AssetUploadField') ){
			$uploadField->setTemplate('HtmlEditorFolder_UploadField');
			$currentPage = $this->owner->controller->currentPage();
			if(
				method_exists($currentPage, 'getHtmlEditorFolder') &&
				$folder = $currentPage->getHtmlEditorFolder()
			){
				$uploadField->setFolderName($folder);
			}
		}
	}

}
