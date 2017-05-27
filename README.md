# SilverStripe HtmlEditorFolder

![Screenshot](https://raw.githubusercontent.com/bcairns/silverstripe-htmleditorfolder/master/screenshot.png)

## Description

UploadField provides `setFolderName()` and `setDisplayFolderName()` methods which allows you to control where files get uploaded to and selected from, however HtmlEditorField offers no such capability for files uploaded via the Insert Media and Link dialogs; everything winds up in Uploads which can be unwieldy for sites that make heavy usage of HtmlEditorFields with inline images or other files.

HtmlEditorFolder allows for a folder to be specified, on a per-page basis (per-field is not currently possible).  This location will be used in both Media and Link dialogs, for both upload destination and default folder when selecting from the CMS. 

Combining this with UploadField's `setFolderName()` and `setDisplayFolderName()` allows for excellent management of default file locations for your CMS users.

## Usage

After installing the module, pages (any descendant of SiteTree) can define a `getHtmlEditorFolder()` method:

```
class Article extends Page
{

	public function getHtmlEditorFolder()
	{
		return 'Articles';
	}
	
}
```

This will be used as the location for all files uploaded/selected via the Insert Media/Link dialogs in all HtmlEditorFields for the current page being edited in the CMS.

### As Extension

You can define getHtmlEditorFolder() in an extension, for instance to use HtmlEditorFolder with 3rd-party code:

```
class BlogPost_Extension extends DataExtension
{
	public function getHtmlEditorFolder()
	{
		return 'Blog';
	}
}
```

And apply it in config.yml:

```
BlogPost:
  extensions:
    - BlogPost_Extension
```


### DataObjects

This module sets the folder according to the current page that is being edited.  So DataObjects will use the folder set by their parent page.

(Currently untested with non-Page parents, for example ModelAdmin-based editing)


## Special Note

SilverStripe normally only loads the Insert Media and Insert Link dialogs once, and then the stored copy in the DOM is used thereafter, even if you switch to editing a new page (which loads a new panel via AJAX and is not a full page refresh).

This module deliberately *breaks* this behaviour, and removes the dialog(s) from the DOM on CMS state change, which forces the dialog(s) (if invoked) to reload themselves from the server after you've switched pages.

This may be a useful feature for other extensions that wish to modify HtmlEditorField's Media and Link dialogs.