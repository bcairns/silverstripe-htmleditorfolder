# SilverStripe HtmlEditorFolder

![Screenshot](https://raw.githubusercontent.com/bcairns/silverstripe-htmleditorfolder/master/screenshot.png)

## Description

UploadField provides `setFolderName()` and `setDisplayFolderName()` methods which allows you to control where files get uploaded to and selected from, however HtmlEditorField offers no such capability for files uploaded via the Insert Media and Link dialogs; everything winds up in Uploads which can be unwieldy for sites that make heavy usage of HtmlEditorFields with inline images or other files.

HtmlEditorFolder allows for a folder to be specified, on a per-page basis (per-field is not currently possible).  This location will be used in both Media and Link dialogs, for both upload destination and default folder when selecting from the CMS. 

Combining this with UploadField's `setFolderName()` and `setDisplayFolderName()` allows for excellent control of default file locations.

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

## What About DataObjects?

This module sets the folder according to the current page that is being edited.  So DataObjects will use the folder set by their parent page.

(Currently untested with non-Page parents, for example ModelAdmin-based editing)


## Special Note

SilverStripe normally only loads the Insert Media dialog once, and then the stored copy in the DOM is used thereafter, even if you switch to editing a new page (which loads a new panel via AJAX and is not a full page refresh).

This module deliberately breaks this behaviour, and removes the dialog from the DOM on CMS state change, which forces the dialog (if invoked) to reload itself from the server after you've switched pages.
