# SilverStripe HtmlEditorFolder

## Description

UploadField provides a `setFolderName()` method which allows you to control where files get uploaded to, however HtmlEditorField offers no such capability for files uploaded via the Insert Media dialog; everything winds up in Uploads which can be unwieldy for sites that make heavy usage of HtmlEditorFields with inline images or other files.

HtmlEditorFolder allows for a destination folder to be specified, on a per-page basis (per-field is not currently possible).

## Usage

After installing the module, pages can define a `getHtmlEditorFolder()` method:

```
class Article extends Page
{

	public function getHtmlEditorFolder()
	{
		return 'Articles';
	}
	
}
```

## Special Note

SilverStripe normally only loads the Insert Media dialog once, and then the stored copy in the DOM is used thereafter, even if you switch to editing a new page (which loads a new panel via AJAX and is not a full page refresh).

This module deliberately breaks this behaviour, and removes the dialog from the DOM on CMS state change, which forces the dialog (if invoked) to reload itself from the server after you've switched pages.
