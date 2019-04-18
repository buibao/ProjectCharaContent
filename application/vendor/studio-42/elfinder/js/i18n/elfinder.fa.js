/**
 * Persian-Farsi Translation
 * @author Keyhan Mohammadpour <keyhan_universityworks@yahoo.com>
 * @version 2014-12-19
 */
(function(root, factory) {
	if (typeof define === 'function' && define.amd) {
		define(['elfinder'], factory);
	} else if (typeof exports !== 'undefined') {
		module.exports = factory(require('elfinder'));
	} else {
		factory(root.elFinder);
	}
}(this, function(elFinder) {
	elFinder.prototype.i18.fa = {
		translator : 'Keyhan Mohammadpour &lt;keyhan_universityworks@yahoo.com&gt;',
		language   : 'فارسی',
		direction  : 'rtl',
		dateFormat : 'd.m.Y H:i',
		fancyDateFormat : '$1 H:i',
		messages   : {

			/********************************** errors **********************************/
			'error'                : 'خطا',
			'errUnknown'           : 'خطای ناشناخته .',
			'errUnknownCmd'        : 'دستور ناشناخته .',
			'errJqui'              : 'تنظیمات کتابخانه JQuery UI شما به درستی تنظیم نشده است . این کتابخانه بایستی شامل Resizable ، Draggable و Droppable باشد .',
			'errNode'              : 'شی elfinder به درستی ایجاد نشده است .',
			'errURL'               : 'تنظیمات elfinder شما به درستی انجام نشده است . تنظیم Url را به درستی انجام دهید .',
			'errAccess'            : 'محدودیت سطح دسترسی',
			'errConnect'           : 'Unable to connect to backend.',
			'errAbort'             : 'ارتباط قطع شده است .',
			'errTimeout'           : 'مهلت زمانی Connection شما به انتها رسیده ایت .',
			'errNotFound'          : 'تنظیم Backend یافت نشد .',
			'errResponse'          : 'پاسخ دریافتی از Backend صحیح نمی باشد .',
			'errConf'              : 'تنطیمات Backend به درستی انجام نشده است .',
			'errJSON'              : 'ماژول PHP JSON نصب نگردیده است .',
			'errNoVolumes'         : 'درایوهای قابل خواندن یافت نشدند .',
			'errCmdParams'         : 'پارامترهای دستور "$1" به صورت صحیح داده نشده است .',
			'errDataNotJSON'       : 'داده ها در قالب JSON نمی باشند .',
			'errDataEmpty'         : 'داده ها تهی می باشند .',
			'errCmdReq'            : 'درخواست از سمت Backend نیازمند نام دستور می باشد .',
			'errOpen'              : 'قادر به باز نمودن "$1" نمی باشد .',
			'errNotFolder'         : 'شی به صورت پوشه نمی باشد .',
			'errNotFile'           : 'شی به صورت فایل نمی باشد .',
			'errRead'              : 'قادر به خواندن "$1" نمی باشد .',
			'errWrite'             : 'قادر به نوشتن در درون "$1" نمی باشد .',
			'errPerm'              : 'شما مجاز به انجام این عمل نمی باشید .',
			'errLocked'            : '"$1"قفل گردیده است و شما قادر به تغییر نام ، حذف و یا جابجایی آن نمی باشید .',
			'errExists'            : 'فایلی با نام "$1" هم اکنون وجود دارد .',
			'errInvName'           : 'نام انتخابی شما صحیح نمی باشد .',
			'errFolderNotFound'    : 'پوشه مورد نظر شما یافت نشد .',
			'errFileNotFound'      : 'فایل مورد نظر شما یافت نشد .',
			'errTrgFolderNotFound' : 'پوشه مقصد با نام "$1" یافت نشد .',
			'errPopup'             : 'مرورگر شما ار باز شدن پنجره popup جلوگیری می نماید ، اطفا تنطیم مربوطه را در مرورگر خود فعال نمایید .',
			'errMkdir'             : 'قادر به ایجاد نمودن پوشه ای با نام "$1" نمی باشد .',
			'errMkfile'            : 'قادر به ابجاد نمودن فایلی با نبم "$1" نمی باشد .',
			'errRename'            : 'قادر به تغییر نام فایل "$1" نمی باشد .',
			'errCopyFrom'          : 'کپی نمودن از درایو با نام "$1" امکان پذیر نمی باشد .',
			'errCopyTo'            : 'کپی نمودن به درایو با نام "$1" امکان پذیر نمی باشد .',
			'errUpload'            : 'خطای بارگذاری ',
			'errUploadFile'        : 'قادر به بارگذاری "$1" نمی باشد .',
			'errUploadNoFiles'     : 'هیچ فایلی برای بارگذاری یافت نشد .',
			'errUploadTotalSize'   : 'حجم داده ها بیشتر از حد مجاز تعیین شده است .',
			'errUploadFileSize'    : 'حجم فایل بیشتر از حد مجاز تعیین شده است .',
			'errUploadMime'        : 'نوع فایل انتخابی شما مجاز نمی باشد .',
			'errUploadTransfer'    : 'در تبادل "$1" خطایی رخ داده است .',
			'errNotReplace'        : 'Object "$1" already exists at this location and can not be replaced by object with another type.',
			'errReplace'           : 'Unable to replace "$1".',
			'errSave'              : 'قادر به دخیره کردن "$1" نمی باشد .',
			'errCopy'              : 'قادر به کپی نمودن "$1" نمی باشد .',
			'errMove'              : 'قادر به جابجایی "$1" نمی باشد .',
			'errCopyInItself'      : 'قادر به کپی نمودن "$1" در درون خودش نمی باشد .',
			'errRm'                : 'قادر به حذف نمودن "$1" نمی باشد .',
			'errRmSrc'             : 'Unable remove source file(s).',
			'errExtract'           : 'قادر به استخراج فایل فشرده "$1" نمی باشد .',
			'errArchive'           : 'قادر به ایجاد آرشیو نمی باشد .',
			'errArcType'           : 'نوع ناشناخته برای آرشیو .',
			'errNoArchive'         : 'قادر به آرشیو نمودن فایل نمی باشد و یا نوع فایل در نوع های آرشیو تعیین نشده است .',
			'errCmdNoSupport'      : 'Backend قادر به پشتیبانی از این دستور نمی باشد .',
			'errReplByChild'       : 'پوشه با نام "$1"قادر به تغییر با محتویات درونی خود نمی باشد .',
			'errArcSymlinks'       : 'به دلایل مسائل امنیتی قادر به استخراج آرشیو های دارای symlinks نمی باشد .',
			'errArcMaxSize'        : 'فایل های آرشیو شده به حداکثر اندازه تعیین شده رسیده اند .',
			'errResize'            : 'قادر به تغییر اندازه "$1" نمی باشد .',
			'errResizeDegree'      : 'Invalid rotate degree.',
			'errResizeRotate'      : 'Unable to rotate image.',
			'errResizeSize'        : 'Invalid image size.',
			'errResizeNoChange'    : 'Image size not changed.',
			'errUsupportType'      : 'نوع فایل شما قابل پشتیبانی نمی باشد .',
			'errNotUTF8Content'    : 'File "$1" is not in UTF-8 and cannot be edited.',
			'errNetMount'          : 'Unable to mount "$1".',
			'errNetMountNoDriver'  : 'Unsupported protocol.',
			'errNetMountFailed'    : 'Mount failed.',
			'errNetMountHostReq'   : 'Host required.',
			'errSessionExpires'    : 'Your session has expired due to inactivity.',
			'errCreatingTempDir'   : 'Unable to create temporary directory: "$1"',
			'errFtpDownloadFile'   : 'Unable to download file from FTP: "$1"',
			'errFtpUploadFile'     : 'Unable to upload file to FTP: "$1"',
			'errFtpMkdir'          : 'Unable to create remote directory on FTP: "$1"',
			'errArchiveExec'       : 'Error while archiving files: "$1"',
			'errExtractExec'       : 'Error while extracting files: "$1"',
			
			/******************************* commands names ********************************/
			'cmdarchive'   : 'ساختن آرشیو',
			'cmdback'      : 'قبلی',
			'cmdcopy'      : 'کپی',
			'cmdcut'       : 'جابجایی',
			'cmddownload'  : 'بارگیری',
			'cmdduplicate' : 'تکثیر نمودن',
			'cmdedit'      : 'ویرایش فایل',
			'cmdextract'   : 'از حالت فشرده خارج نمودن',
			'cmdforward'   : 'بعدی',
			'cmdgetfile'   : 'انتخاب فایل ها',
			'cmdhelp'      : 'درباره این فایل',
			'cmdhome'      : 'صفحه اصلی',
			'cmdinfo'      : 'دریافت اطلاعات',
			'cmdmkdir'     : 'پوشه جدید',
			'cmdmkfile'    : 'فایل متنی جدید',
			'cmdopen'      : 'باز نمودن',
			'cmdpaste'     : 'چسباندن',
			'cmdquicklook' : 'پیش نمایش',
			'cmdreload'    : 'بارگذاری مجدد',
			'cmdrename'    : 'تغییر نام',
			'cmdrm'        : 'حذف',
			'cmdsearch'    : 'جستجو',
			'cmdup'        : 'رفتن به پوشه والد',
			'cmdupload'    : 'بارگذاری فایل ها',
			'cmdview'      : 'نمایش',
			'cmdresize'    : 'تغییر اندازه فایل',
			'cmdsort'      : 'مرتب سازی',
			'cmdnetmount'  : 'Mount network volume',

			/*********************************** buttons ***********************************/ 
			'btnClose'  : 'بستن',
			'btnSave'   : 'ذخیره',
			'btnRm'     : 'حذف',
			'btnApply'  : 'اعمال',
			'btnCancel' : 'انصراف',
			'btnNo'     : 'خیر',
			'btnYes'    : 'بلی',
			'btnMount'  : 'Mount',

			/******************************** notifications ********************************/
			'ntfopen'     : 'باز نمودن پوشه',
			'ntffile'     : 'باز نمدن فایل',
			'ntfreload'   : 'بازخوانی مجدد محتویات پوشه',
			'ntfmkdir'    : 'ساختن پوشه',
			'ntfmkfile'   : 'ساختن فایل',
			'ntfrm'       : 'حذف فایل',
			'ntfcopy'     : 'کپی فایل',
			'ntfmove'     : 'انتقال فایل',
			'ntfprepare'  : 'آماده شدن برای کپی نمودن فایل ها',
			'ntfrename'   : 'تغییر نام فایل',
			'ntfupload'   : 'بارگذاری فایل',
			'ntfdownload' : 'بارگیری فایل',
			'ntfsave'     : 'ذخیره نمودن فایل ها',
			'ntfarchive'  : 'در حال ساختن آرشیو',
			'ntfextract'  : 'استخراج فایل ها از آرشیو',
			'ntfsearch'   : 'در حال جستجو فایل ها',
			'ntfresize'   : 'Resizing images',
			'ntfsmth'     : 'درحال انجام عملیات ....',
			'ntfloadimg'  : 'در حال لود نمودن تصویر',
			'ntfnetmount' : 'Mounting network volume',
			'ntfdim'      : 'Acquiring image dimension',
			
			/************************************ dates **********************************/
			'dateUnknown' : 'ناشناخته',
			'Today'       : 'امروز',
			'Yesterday'   : 'دیروز',
			'msJan'       : 'ژانویه',
			'msFeb'       : 'فوریه',
			'msMar'       : 'مارس',
			'msApr'       : 'آوریل',
			'msMay'       : 'مه',
			'msJun'       : 'ژوئن',
			'msJul'       : 'ژوئیه',
			'msAug'       : 'اوت',
			'msSep'       : 'سپتامبر',
			'msOct'       : 'اکتبر',
			'msNov'       : 'نوامبر',
			'msDec'       : 'دسامبر',
			'January'     : 'ژانویه',
			'February'    : 'فوریه',
			'March'       : 'مارس',
			'April'       : 'آوریل',
			'May'         : 'مه',
			'June'        : 'ژوئن',
			'July'        : 'ژوئیه',
			'August'      : 'اوت',
			'September'   : 'سپتامبر',
			'October'     : 'اکتبر',
			'November'    : 'نوامبر',
			'December'    : 'دسامبر',
			'Sunday'      : 'یک شنبه',
			'Monday'      : 'دوشنبه',
			'Tuesday'     : 'سه شنبه',
			'Wednesday'   : 'چهار شنبه',
			'Thursday'    : 'پنج شنبه',
			'Friday'      : 'جمعه',
			'Saturday'    : 'شنبه',
			'Sun'         : 'یک شنبه',
			'Mon'         : 'دو شنبه',
			'Tue'         : 'سه شنبه',
			'Wed'         : 'چهار شنبه',
			'Thu'         : 'پنج شنبه',
			'Fri'         : 'جمعه',
			'Sat'         : 'شنبه',
			
			/******************************** sort variants ********************************/
			'sortname'          : 'بر اساس نام',
			'sortkind'          : 'بر اساس نوع',
			'sortsize'          : 'بر اساس اندازه',
			'sortdate'          : 'بر اساس تاریخ',
			'sortFoldersFirst'  : 'Folders first',

			/********************************** messages **********************************/
			'confirmReq'      : 'تاییدیه نهایی نیاز است .',
			'confirmRm'       : 'آیا مطمثن به انجام عملیات حذف می باشید ؟ آیتم های حدف شده قابل بازیابی نمی باشند  !',
			'confirmRepl'     : 'آیا فایل قدیم با فایل جدید جایگزین شود ؟',
			'apllyAll'        : 'اعمال تغییرات به همه',
			'name'            : 'نام',
			'size'            : 'اندازه',
			'perms'           : 'مجوزها',
			'modify'          : 'تغییر داده شده',
			'kind'            : 'نوع',
			'read'            : 'خواندن',
			'write'           : 'نوشتن',
			'noaccess'        : 'دسترسی وجود ندارد',
			'and'             : 'و',
			'unknown'         : 'ناشناخته',
			'selectall'       : 'انتخاب همه فایل ها',
			'selectfiles'     : 'انتخاب یکی یا همه فایل ها',
			'selectffile'     : 'انتخاب اولین فایل',
			'selectlfile'     : 'انتخاب آخرین فایل',
			'viewlist'        : 'نمایش به صورت لیست',
			'viewicons'       : 'نمایش با آیکون ها',
			'places'          : 'محل ها',
			'calc'            : 'محاسبه',
			'path'            : 'مسیر',
			'aliasfor'        : 'نام مستعار برای',
			'locked'          : 'قفل شده',
			'dim'             : 'ابعاد',
			'files'           : 'فایل ها',
			'folders'         : 'پوشه ها',
			'items'           : 'آیتم ها',
			'yes'             : 'بلی',
			'no'              : 'خیر',
			'link'            : 'پیوند',
			'searcresult'     : 'جستجو در نتایج',
			'selected'        : 'آیتم های انتخاب شده',
			'about'           : 'درباره',
			'shortcuts'       : 'میانبرها',
			'help'            : 'راهنما',
			'webfm'           : 'مدیر وب فایل',
			'ver'             : 'نسخه',
			'protocolver'     : 'protocol version',
			'homepage'        : 'صفحه اصلی پروژه',
			'docs'            : 'مستندات',
			'github'          : 'دنبال کردن ما بر روی Github',
			'twitter'         : 'دنبال کردن ما در Twitter',
			'facebook'        : 'به ما در facebook بپیوندید',
			'team'            : 'گروه',
			'chiefdev'        : 'سازنده اصلی برنامه',
			'developer'       : 'سازنده',
			'contributor'     : 'همکار',
			'maintainer'      : 'پشتیبان',
			'translator'      : 'مترجم',
			'icons'           : 'آیکون ها',
			'dontforget'      : 'فراموش نشود',
			'shortcutsof'     : 'میانبرها غیرفعال شده اند .',
			'dropFiles'       : 'فایل های خود را در این محل رها نمایید .',
			'or'              : 'یا',
			'selectForUpload' : 'انتخاب فایل ها برای بارگذاری',
			'moveFiles'       : 'انتقال فایل ها',
			'copyFiles'       : 'کپی فایل ها',
			'rmFromPlaces'    : 'حدف',
			'aspectRatio'     : 'نسبت تصویر',
			'scale'           : 'مقیاس',
			'width'           : 'طول',
			'height'          : 'ارتفاع',
			'resize'          : 'تغییر اندازه',
			'crop'            : 'بریدن',
			'rotate'          : 'چرخاندن',
			'rotate-cw'       : 'چرخاندن 90 درجه در جهت عقربه های ساعت',
			'rotate-ccw'      : 'چرخاندن 90 درجه در جهت خلاف عقربه های ساعت',
			'degree'          : 'درجه',
			'netMountDialogTitle' : 'Mount network volume',
			'protocol'        : 'نسخه پروتکل',
			'host'            : 'Host',
			'port'            : 'Port',
			'user'            : 'User',
			'pass'            : 'Password',
			
			/********************************** mimetypes **********************************/
			'kindUnknown'     : 'Unknown',
			'kindFolder'      : 'Folder',
			'kindAlias'       : 'Alias',
			'kindAliasBroken' : 'Broken alias',
			// applications
			'kindApp'         : 'Application',
			'kindPostscript'  : 'Postscript document',
			'kindMsOffice'    : 'Microsoft Office document',
			'kindMsWord'      : 'Microsoft Word document',
			'kindMsExcel'     : 'Microsoft Excel document',
			'kindMsPP'        : 'Microsoft Powerpoint presentation',
			'kindOO'          : 'Open Office document',
			'kindAppFlash'    : 'Flash application',
			'kindPDF'         : 'Portable Document Format (PDF)',
			'kindTorrent'     : 'Bittorrent file',
			'kind7z'          : '7z archive',
			'kindTAR'         : 'TAR archive',
			'kindGZIP'        : 'GZIP archive',
			'kindBZIP'        : 'BZIP archive',
			'kindXZ'          : 'XZ archive',
			'kindZIP'         : 'ZIP archive',
			'kindRAR'         : 'RAR archive',
			'kindJAR'         : 'Java JAR file',
			'kindTTF'         : 'True Type font',
			'kindOTF'         : 'Open Type font',
			'kindRPM'         : 'RPM package',
			// texts
			'kindText'        : 'Text document',
			'kindTextPlain'   : 'Plain text',
			'kindPHP'         : 'PHP source',
			'kindCSS'         : 'Cascading style sheet',
			'kindHTML'        : 'HTML document',
			'kindJS'          : 'Javascript source',
			'kindRTF'         : 'Rich Text Format',
			'kindC'           : 'C source',
			'kindCHeader'     : 'C header source',
			'kindCPP'         : 'C++ source',
			'kindCPPHeader'   : 'C++ header source',
			'kindShell'       : 'Unix shell script',
			'kindPython'      : 'Python source',
			'kindJava'        : 'Java source',
			'kindRuby'        : 'Ruby source',
			'kindPerl'        : 'Perl script',
			'kindSQL'         : 'SQL source',
			'kindXML'         : 'XML document',
			'kindAWK'         : 'AWK source',
			'kindCSV'         : 'Comma separated values',
			'kindDOCBOOK'     : 'Docbook XML document',
			// images
			'kindImage'       : 'Image',
			'kindBMP'         : 'BMP image',
			'kindJPEG'        : 'JPEG image',
			'kindGIF'         : 'GIF Image',
			'kindPNG'         : 'PNG Image',
			'kindTIFF'        : 'TIFF image',
			'kindTGA'         : 'TGA image',
			'kindPSD'         : 'Adobe Photoshop image',
			'kindXBITMAP'     : 'X bitmap image',
			'kindPXM'         : 'Pixelmator image',
			// media
			'kindAudio'       : 'Audio media',
			'kindAudioMPEG'   : 'MPEG audio',
			'kindAudioMPEG4'  : 'MPEG-4 audio',
			'kindAudioMIDI'   : 'MIDI audio',
			'kindAudioOGG'    : 'Ogg Vorbis audio',
			'kindAudioWAV'    : 'WAV audio',
			'AudioPlaylist'   : 'MP3 playlist',
			'kindVideo'       : 'Video media',
			'kindVideoDV'     : 'DV movie',
			'kindVideoMPEG'   : 'MPEG movie',
			'kindVideoMPEG4'  : 'MPEG-4 movie',
			'kindVideoAVI'    : 'AVI movie',
			'kindVideoMOV'    : 'Quick Time movie',
			'kindVideoWM'     : 'Windows Media movie',
			'kindVideoFlash'  : 'Flash movie',
			'kindVideoMKV'    : 'Matroska movie',
			'kindVideoOGG'    : 'Ogg movie'
		}
	};
}));
