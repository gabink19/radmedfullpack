<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* account/partial/_uploader_javascript.html.twig */
class __TwigTemplate_f026831eb32d7bac9a96bceea8eab8c3bc48263f411e005e1ef09abd74feb931 extends \Twig\Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        echo "var fileUrls = [];
var fileUrlsHtml = [];
var fileUrlsBBCode = [];
var fileDeleteHashes = [];
var fileShortUrls = [];
var fileNames = [];
var uploadPreviewQueuePending = [];
var uploadPreviewQueueProcessing = [];
var statusFlag = 'pending';
var lastEle = null;
var startTime = null;
var fileToEmail = '';
var filePassword = '';
var fileCategory = '';
var fileFolder = '';
var uploadComplete = true;
var uploadFolderId = null;

function initUploader() {
    fileUrls = [];
    fileDeleteHashes = [];
    fileShortUrls = [];
    startTime = null;

    // figure out if we should use 'chunking'
    var maxChunkSize = 0;
    var uploaderMaxSize = ";
        // line 27
        echo twig_escape_filter($this->env, ($context["maxUploadSizeNonChunking"] ?? null), "html", null, true);
        echo ";
    if (browserXHR2Support() == true)
    {
        maxChunkSize = ";
        // line 30
        echo twig_escape_filter($this->env, (((($context["phpMaxSize"] ?? null) > ($context["chunkedUploadSize"] ?? null))) ? (($context["chunkedUploadSize"] ?? null)) : ((($context["phpMaxSize"] ?? null) - 5000))), "html", null, true);
        echo ";
        var uploaderMaxSize = ";
        // line 31
        echo twig_escape_filter($this->env, ($context["maxUploadSize"] ?? null), "html", null, true);
        echo ";
    }

    // Initialize the jQuery File Upload widget:
    \$('#fileUpload #uploader').fileupload({
        sequentialUploads: true,
        url: '";
        // line 37
        echo ($context["uploadAction"] ?? null);
        echo "',
        maxFileSize: uploaderMaxSize,
        formData: {},
        autoUpload: false,
        xhrFields: {
            withCredentials: true
        },
        getNumberOfFiles: function () {
            return getTotalRows();
        },
        previewMaxWidth: 160,
        previewMaxHeight: 134,
        previewCrop: true,
        messages: {
            maxNumberOfFiles: \"";
        // line 51
        echo twig_escape_filter($this->env, twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("file_upload_maximum_number_of_files_exceeded", "Maximum number of files exceeded"), "js"), "html", null, true);
        echo "\",
            acceptFileTypes: \"";
        // line 52
        echo twig_escape_filter($this->env, twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("file_upload_file_type_not_allowed", "File type not allowed"), "js"), "html", null, true);
        echo "\",
            maxFileSize: \"";
        // line 53
        echo twig_escape_filter($this->env, twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("file_upload_file_is_too_large", "File is too large"), "js"), "html", null, true);
        echo "\",
            minFileSize: \"";
        // line 54
        echo twig_escape_filter($this->env, twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("file_upload_file_is_too_small", "File is too small"), "js"), "html", null, true);
        echo "\"
        },
        maxChunkSize: maxChunkSize, ";
        // line 56
        (((twig_length_filter($this->env, ($context["acceptedFileTypes"] ?? null)) > 0)) ? (print (twig_escape_filter($this->env, (("acceptFileTypes: /(\\.|\\/)(" . ($context["acceptedFileTypesUploaderStr"] ?? null)) . ")\$/i,"), "html", null, true))) : (print ("")));
        echo "
        maxNumberOfFiles: ";
        // line 57
        echo twig_escape_filter($this->env, ($context["maxFiles"] ?? null), "html", null, true);
        echo "
    })
    .on('fileuploadadd', function (e, data) {
        ";
        // line 60
        if ((twig_length_filter($this->env, ($context["acceptedFileTypes"] ?? null)) > 0)) {
            // line 61
            echo "            var acceptFileTypes = /^(";
            echo twig_escape_filter($this->env, ($context["acceptedFileTypes"] ?? null), "html", null, true);
            echo ")\$/i;
            for(i in data.originalFiles)
            {
                fileExtension = data.originalFiles[i]['name'].substr(data.originalFiles[i]['name'].lastIndexOf('.')+1);
                if(!acceptFileTypes.test(fileExtension)) {
                    alert(\"";
            // line 66
            echo twig_escape_filter($this->env, twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("file_upload_file_type_not_allowed", "File type not allowed"), "js"), "html", null, true);
            echo " (\\\"\"+data.originalFiles[i]['name']+\"\\\")\");
                    return false;
                }
            }
        ";
        }
        // line 71
        echo "
        \$('#fileUpload #uploader #fileListingWrapper').removeClass('hidden');
        \$('#fileUpload #uploader #initialUploadSection').addClass('hidden');
        \$('#fileUpload #uploader #initialUploadSectionLabel').addClass('hidden');

        // fix for safari
        getTotalRows();
        // end safari fix

        totalRows = getTotalRows() + 1;
        updateTotalFilesText(totalRows);
    })
    .on('fileuploadstart', function (e, data) {
        uploadComplete = false;
        uploadFolderId = fileFolder;

        // hide/show sections
        \$('#fileUpload #addFileRow').addClass('hidden');
        \$('#fileUpload #processQueueSection').addClass('hidden');
        \$('#fileUpload #processingQueueSection').removeClass('hidden');

        // hide cancel icons
        \$('#fileUpload .cancel').hide();
        \$('#fileUpload .cancel').click(function () {
            return false;
        });

        // show faded overlay on images
        \$('#fileUpload .previewOverlay').addClass('faded');

        // set timer
        startTime = (new Date()).getTime();
    })
    .on('fileuploadstop', function (e, data) {
        // finished uploading
        updateTitleWithProgress(100);
        updateProgessText(100, data.total, data.total);
        \$('#fileUpload #processQueueSection').addClass('hidden');
        \$('#fileUpload #processingQueueSection').addClass('hidden');
        \$('#fileUpload #completedSection').removeClass('hidden');

        // set all remainging pending icons to failed
        \$('#fileUpload .processingIcon').parent().html('<img src=\"";
        // line 113
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountImagePath", [], "method", false, false, false, 113), "html", null, true);
        echo "/red_error_small.png\" width=\"16\" height=\"16\"/>');

        uploadComplete = true;
        sendAdditionalOptions();

        // setup copy link
        setupCopyAllLink();

        // flag as finished for later on
        statusFlag = 'finished';

        if (typeof (checkShowUploadFinishedWidget) === 'function')
        {
            checkShowUploadFinishedWidget();
        }

        delay(function() {
            \$('#hide_modal_btn').click();
        }, 1500);
    })
    .on('fileuploadprogressall', function (e, data) {
        // progress bar
        var progress = parseInt(data.loaded / data.total * 100, 10);
        \$('#progress .progress-bar').css(
                'width',
                progress + '%'
                );

        // update page title with progress
        updateTitleWithProgress(progress);
        updateProgessText(progress, data.loaded, data.total);
    })
    .on('fileuploadsend', function (e, data) {
        // show progress ui elements
        \$(data['context']).find('.previewOverlay .progressText').removeClass('hidden');
        \$(data['context']).find('.previewOverlay .progress').removeClass('hidden');
    })
    .on('fileuploadprogress', function (e, data) {
        // progress bar
        var progress = parseInt(data.loaded / data.total * 100, 10);

        // update item progress
        \$(data['context']).find('.previewOverlay .progressText').html(progress + '%');
        \$(data['context']).find('.previewOverlay .progress .progress-bar').css('width', progress + '%');
    })
    .on('fileuploaddone', function (e, data) {

        // hide faded overlay on images
        \$(data['context']).find('.previewOverlay').removeClass('faded');

        // keep a copy of the urls globally
        fileUrls.push(data['result'][0]['url']);
        fileUrlsHtml.push(data['result'][0]['url_html']);
        fileUrlsBBCode.push(data['result'][0]['url_bbcode']);
        fileDeleteHashes.push(data['result'][0]['delete_hash']);
        fileShortUrls.push(data['result'][0]['short_url']);
        fileNames.push(data['result'][0]['name']);

        var isSuccess = true;
        if (data['result'][0]['error'] != null)
        {
            isSuccess = false;
        }

        var html = '';
        html += '<div class=\"template-download-img';
        if (isSuccess == false)
        {
            html += ' errorText';
        }
        html += '\" ';
        if (isSuccess == true)
        {
            html += 'onClick=\"window.open(\\'' + data['result'][0]['url'] + '\\'); return false;\"';
        }
        html += ' title=\"'+data['result'][0]['name']+'\"';
        html += '>';

        if (isSuccess == true)
        {
            previewUrl = '";
        // line 193
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountImagePath", [], "method", false, false, false, 193), "html", null, true);
        echo "/trans_1x1.gif';
            if(data['result'][0]['success_result_html'].length > 0)
            {
                previewUrl = data['result'][0]['success_result_html'];
            }

            html += \"<div id='finalThumbWrapper\"+data['result'][0]['file_id']+\"'></div>\";
            queueUploaderPreview('finalThumbWrapper'+data['result'][0]['file_id'], previewUrl, data['result'][0]['file_id']);
        }
        else
        {
            // @TODO - replace this with an error icon
            html += 'Error uploading: ' + data['result'][0]['name'];
        }
        html += '</div>';

        // update screen with success content
        \$(data['context']).replaceWith(html);
        processUploaderPreviewQueue();
    })
    .on('fileuploadfail', function (e, data) {
        // hand deletes
        if (data.errorThrown == 'abort')
        {
            \$(data['context']).remove();
            return true;
        }

        // update screen with error content, ajax issues
        var html = '';
        html += '<div class=\"template-download-img errorText\">';
        html += \"";
        // line 224
        echo twig_escape_filter($this->env, twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("indexjs_error_server_problem_reservo", "ERROR: There was a server problem when attempting the upload."), "js"), "html", null, true);
        echo "\";
        html += '</div>';
        \$(data['context']).replaceWith(html);
        totalRows = getTotalRows();
        if (totalRows > 0)
        {
            totalRows = totalRows - 1;
        }

        updateTotalFilesText(totalRows);
    });

    // Open download dialogs via iframes,
    // to prevent aborting current uploads:
    \$('#fileUpload #uploader #files a:not([target^=_blank])').on('click', function (e) {
        e.preventDefault();
        \$('<iframe style=\"display:none;\"></iframe>')
                .prop('src', this.href)
                .appendTo('body');
    });

    \$('#fileUpload #uploader').bind('fileuploadsubmit', function (e, data) {
        // The example input, doesn't have to be part of the upload form:
        data.formData = {_sessionid: '";
        // line 247
        echo twig_escape_filter($this->env, ($context["sessionId"] ?? null), "html", null, true);
        echo "', cTracker: '";
        echo twig_escape_filter($this->env, ($context["cTracker"] ?? null), "html", null, true);
        echo "', maxChunkSize: maxChunkSize, folderId: fileFolder};
    });

    \$('.showAdditionalOptionsLink').click(function (e) {
        // show panel
        showAdditionalOptions();

        // prevent background clicks
        e.preventDefault();

        return false;
    });
    
    ";
        // line 260
        if ( !(null === ($context["fid"] ?? null))) {
            // line 261
            echo "    saveAdditionalOptions(true);
    ";
        }
        // line 263
        echo "}

function queueUploaderPreview(thumbWrapperId, previewImageUrl, previewImageId)
{
    uploadPreviewQueuePending[thumbWrapperId] = [previewImageUrl, previewImageId];
}

function processUploaderPreviewQueue()
{
    // allow only 4 at once
    if(getTotalProcessing() >= ";
        // line 273
        echo twig_escape_filter($this->env, ($context["maxConcurrentThumbnailRequests"] ?? null), "html", null, true);
        echo ")
    {
        return false;
    }

    for(i in uploadPreviewQueuePending)
    {
        var filename = \$('#'+i).parent().attr('title');
        \$('#'+i).html(\"<img src='\"+uploadPreviewQueuePending[i][0]+\"' id='finalThumb\"+uploadPreviewQueuePending[i][1]+\"' onLoad=\\\"showUploadThumbCheck('finalThumb\"+uploadPreviewQueuePending[i][1]+\"', \"+uploadPreviewQueuePending[i][1]+\");\\\"/><div class='filename'>\"+filename+\"</div>\");
        uploadPreviewQueueProcessing[i] = uploadPreviewQueuePending[i];
        delete uploadPreviewQueuePending[i];
        return false;
    }
}

function getTotalPending()
{
    total = 0;
    for(i in uploadPreviewQueuePending)
    {
        total++;
    }

    return total;
}

function getTotalProcessing()
{
    total = 0;
    for(i in uploadPreviewQueueProcessing)
    {
        total++;
    }

    return total;
}

function showUploadThumbCheck(thumbId, itemId)
{
    \$('#'+thumbId).after(\"<div class='image-upload-thumb-check' style='display: none;'><i class='glyphicon glyphicon-ok'></i></div>\");
    \$('#'+thumbId).parent().find('.image-upload-thumb-check').fadeIn().delay(1000).fadeOut();

    // finish uploading
    if(getTotalPending() == 0 && getTotalProcessing() == 0)
    {
        // refresh treeview
        if (typeof (checkShowUploadFinishedWidget) === 'function')
        {
            refreshFolderListing();
        }
    }

    // trigger the next
    delete uploadPreviewQueueProcessing['finalThumbWrapper'+itemId];
    processUploaderPreviewQueue();
}

function getPreviewExtension(filename)
{
    fileExtension = filename.substr(filename.lastIndexOf('.')+1);
    if((fileExtension == 'gif') || (fileExtension == 'mng'))
    {
        return 'gif';
    }

    return 'jpg';
}

function setUploadFolderId(folderId)
{
    if (typeof (folderId != \"undefined\") && (\$.isNumeric(folderId)))
    {
        \$('#upload_folder_id').val(folderId);
    }
    else if (\$('#nodeId').val() == '-1')
    {
        \$('#upload_folder_id').val('');
    }
    else if (\$.isNumeric(\$('#nodeId').val()))
    {
        \$('#upload_folder_id').val(\$('#nodeId').val());
    }
    else
    {
        \$('#upload_folder_id').val('');
    }
    saveAdditionalOptions(true);
}

function getSelectedFolderId()
{
    return \$('#upload_folder_id').val();
}

function setupCopyAllLink()
{

}

function updateProgessText(progress, uploadedBytes, totalBytes)
{
    // calculate speed & time left
    nowTime = (new Date()).getTime();
    loadTime = (nowTime - startTime);
    if (loadTime == 0)
    {
        loadTime = 1;
    }
    loadTimeInSec = loadTime / 1000;
    bytesPerSec = uploadedBytes / loadTimeInSec;

    textContent = '';
    textContent += \"";
        // line 385
        echo twig_escape_filter($this->env, twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("indexjs_progress", "Progress"), "js"), "html", null, true);
        echo ": \" + progress + \"%\";
    textContent += ' ';
    textContent += '(' + bytesToSize(uploadedBytes, 2) + ' / ' + bytesToSize(totalBytes, 2) + ')';

    \$(\"#fileupload-progresstextLeft\").html(textContent);

    rightTextContent = '';
    rightTextContent += \"";
        // line 392
        echo twig_escape_filter($this->env, twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("indexjs_speed", "Speed"), "js"), "html", null, true);
        echo ": \" + bytesToSize(bytesPerSec, 2) + \"";
        echo twig_escape_filter($this->env, twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("indexjs_speed_ps", "ps"), "js"), "html", null, true);
        echo ". \";
    rightTextContent += \"";
        // line 393
        echo twig_escape_filter($this->env, twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("indexjs_remaining", "Remaining"), "js"), "html", null, true);
        echo ": \" + humanReadableTime((totalBytes / bytesPerSec) - (uploadedBytes / bytesPerSec));

    \$(\"#fileupload-progresstextRight\").html(rightTextContent);

    // progress widget for file manager
    if (typeof (updateProgressWidgetText) === 'function')
    {
        updateProgressWidgetText(textContent);
    }
}

function getUrlsAsText()
{
    urlStr = '';
    for (var i = 0; i < fileUrls.length; i++)
    {
        urlStr += fileUrls[i] + \"\\n\";
    }

    return urlStr;
}

function viewFileLinksPopup()
{
    fileUrlText = '';
    htmlUrlText = '';
    bbCodeUrlText = '';
    if (fileUrls.length > 0)
    {
        for (var i = 0; i < fileUrls.length; i++)
        {
            fileUrlText += fileUrls[i] + \"<br/>\";
            htmlUrlText += fileUrlsHtml[i] + \"&lt;br/&gt;<br/>\";
            bbCodeUrlText += '[URL='+fileUrls[i]+']'+fileUrls[i] + \"[/URL]<br/>\";
        }
    }

    \$('#popupContentUrls').html(fileUrlText);
    \$('#popupContentHTMLCode').html(htmlUrlText);
    \$('#popupContentBBCode').html(bbCodeUrlText);

    jQuery('#fileLinksModal').modal('show', {backdrop: 'static'}).on('shown.bs.modal');
}

function showLinkSection(sectionId, ele)
{
    \$('.link-section').hide();
    \$('#' + sectionId).show();
    \$(ele).parent().children('.active').removeClass('active');
    \$(ele).addClass('active');
    \$('.file-links-wrapper .modal-header .modal-title').html(\$(ele).html());
}

function selectAllText(el)
{
    if (typeof window.getSelection != \"undefined\" && typeof document.createRange != \"undefined\")
    {
        var range = document.createRange();
        range.selectNodeContents(el);
        var sel = window.getSelection();
        sel.removeAllRanges();
        sel.addRange(range);
    }
    else if (typeof document.selection != \"undefined\" && typeof document.body.createTextRange != \"undefined\")
    {
        var textRange = document.body.createTextRange();
        textRange.moveToElementText(el);
        textRange.select();
    }
}

function updateTitleWithProgress(progress)
{
    if (typeof (progress) == \"undefined\")
    {
        var progress = 0;
    }

    if (progress == 0)
    {
        \$(document).attr(\"title\", \"";
        // line 473
        echo twig_escape_filter($this->env, ($context["PAGE_NAME"] ?? null), "html", null, true);
        echo " - ";
        echo twig_escape_filter($this->env, ($context["SITE_CONFIG_SITE_NAME"] ?? null), "html", null, true);
        echo "\");
    }
    else
    {
        \$(document).attr(\"title\", progress + \"% ";
        // line 477
        echo twig_escape_filter($this->env, twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("indexjs_uploaded", "Uploaded"), "js"), "html", null, true);
        echo " - ";
        echo twig_escape_filter($this->env, ($context["PAGE_NAME"] ?? null), "html", null, true);
        echo " - ";
        echo twig_escape_filter($this->env, ($context["SITE_CONFIG_SITE_NAME"] ?? null), "html", null, true);
        echo "\");
    }
}

function getTotalRows()
{
    totalRows = \$('#files .template-upload').length;
    if (typeof (totalRows) == \"undefined\")
    {
        return 0;
    }

    return totalRows;
}

function updateTotalFilesText(total)
{
    // removed for now, might be useful in some form in the future
    //\$('#uploadButton').html('upload '+total+' files');
}

function setRowClasses()
{
    // removed for now, might be useful in some form in the future
    //\$('#files tr').removeClass('even');
    //\$('#files tr').removeClass('odd');
    //\$('#files tr:even').addClass('odd');
    //\$('#files tr:odd').addClass('even');
}

function showAdditionalInformation(ele)
{
    // block parent clicks from being processed on additional information
    \$('.sliderContent table').unbind();
    \$('.sliderContent table').click(function (e) {
        e.stopPropagation();
    });

    // make sure we've clicked on a new element
    if (lastEle == ele)
    {
        // close any open sliders
        \$('.sliderContent').slideUp('fast');
        // remove row highlighting
        \$('.sliderContent').parent().parent().removeClass('rowSelected');
        lastEle = null;
        return false;
    }
    lastEle = ele;

    // close any open sliders
    \$('.sliderContent').slideUp('fast');

    // remove row highlighting
    \$('.sliderContent').parent().parent().removeClass('rowSelected');

    // select row and popup content
    \$(ele).addClass('rowSelected');

    // set the position of the sliderContent div
    \$(ele).find('.sliderContent').css('left', 0);
    \$(ele).find('.sliderContent').css('top', (\$(ele).offset().top + \$(ele).height()) - \$('.file-upload-wrapper .modal-content').offset().top);
    \$(ele).find('.sliderContent').slideDown(400, function () {
    });

    return false;
}

function showAdditionalOptions(hide)
{
    if (typeof (hide) == \"undefined\")
    {
        hide = false;
    }

    if ((\$('#additionalOptionsWrapper').is(\":visible\")) || (hide == true))
    {
        \$('#additionalOptionsWrapper').slideUp();
    }
    else
    {
        \$('#additionalOptionsWrapper').slideDown();
    }
}

function saveAdditionalOptions(hide)
{
    if (typeof (hide) == \"undefined\")
    {
        hide = false;
    }

    // save values globally
    fileToEmail = \$('#send_via_email').val();
    filePassword = \$('#set_password').val();
    fileCategory = \$('#set_category').val();
    fileFolder = \$('#upload_folder_id').val();

    // attempt ajax to save
    processAddtionalOptions();

    // hide
    showAdditionalOptions(hide);
}

function processAddtionalOptions()
{
    // make sure the uploads have completed
    if (uploadComplete == false)
    {
        return false;
    }

    return sendAdditionalOptions();
}

function sendAdditionalOptions()
{
    // make sure we have some urls
    if (fileDeleteHashes.length == 0)
    {
        return false;
    }

    \$.ajax({
        type: \"POST\",
        url: \"";
        // line 603
        echo twig_escape_filter($this->env, ($context["WEB_ROOT"] ?? null), "html", null, true);
        echo "/ajax/update_file_options\",
        data: {fileToEmail: fileToEmail, filePassword: filePassword, fileCategory: fileCategory, fileDeleteHashes: fileDeleteHashes, fileShortUrls: fileShortUrls, fileFolder: uploadFolderId}
    }).done(function (msg) {
        originalFolder = fileFolder;
        if(originalFolder == '')
        {
            originalFolder = '-1';
        }
        fileToEmail = '';
        filePassword = '';
        fileCategory = '';
        fileFolder = '';
        fileDeleteHashes = [];
        if (typeof updateStatsViaAjax === \"function\")
        {
            updateStatsViaAjax();
        }
        if (typeof refreshFileListing === \"function\")
        {
            if(isFileListView()) {
                loadImages(currentPageType, originalFolder);
            }
        }
    });
}

function findUrls(text)
{
    var source = (text || '').toString();
    var urlArray = [];
    var url;
    var matchArray;

    // standardise
    source = source.replace(\"\\n\\r\", \"\\n\");
    source = source.replace(\"\\r\", \"\\n\");
    source = source.replace(\"\\n\\n\", \"\\n\");

    // split apart urls
    source = source.split(\"\\n\");

    // find urls
    var regexToken = /(\\b(https?|ftp):\\/\\/[-A-Z0-9+&@#\\/%?=~()_|\\s!:,.;'\\[\\]]*[-A-Z0-9+&@#\\/%=~()_'|\\s])/ig;

    // validate urls
    for(i in source)
    {
        url = source[i];
        if(url.match(regexToken))
        {
            urlArray.push(url);
        }
    }

    return urlArray;
}

var currentUrlItem = 0;
var totalUrlItems = 0;
function urlUploadFiles()
{
    // get textarea contents
    urlList = \$('#urlList').val();
    if (urlList.length == 0)
    {
        alert(\"";
        // line 668
        echo twig_escape_filter($this->env, twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("please_enter_the_urls_to_start", "Please enter the urls to start."), "js"), "html", null, true);
        echo "\");
        return false;
    }

    // get file list as array
    urlList = findUrls(urlList);
    totalUrlItems = urlList.length;

    // first check to make sure we have some urls
    if (urlList.length == 0)
    {
        alert(\"";
        // line 679
        echo twig_escape_filter($this->env, twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("no_valid_urls_found_please_make_sure_any_start_with_http_or_https", "No valid urls found, please make sure any start with http or https and try again.", ["MAX_URLS" => ($context["maxPermittedUrls"] ?? null)]), "js"), "html", null, true);
        echo "\");
        return false;
    }

    // make sure the user hasn't entered more than is permitted
    if (urlList.length > ";
        // line 684
        echo twig_escape_filter($this->env, ($context["maxPermittedUrls"] ?? null), "html", null, true);
        echo ")
    {
        alert(\"";
        // line 686
        echo twig_escape_filter($this->env, twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("you_can_not_add_more_than_x_urls_at_once", "You can not add more than [[[MAX_URLS]]] urls at once."), "js"), "html", null, true);
        echo "\");
        return false;
    }

    // create table listing
    html = '';
    for (i in urlList)
    {
        html += '<tr id=\"rowId' + i + '\"><td class=\"cancel\"><a href=\"#\" onClick=\"return false;\"><img src=\"";
        // line 694
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountImagePath", [], "method", false, false, false, 694), "html", null, true);
        echo "/processing_small.gif\" class=\"processingIcon\" height=\"16\" width=\"16\" alt=\"";
        echo twig_escape_filter($this->env, twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("indexjs_processing", "processing"), "js"), "html", null, true);
        echo "\"/>';
        html += '</a></td><td class=\"name\" colspan=\"3\">' + urlList[i] + '&nbsp;&nbsp;<span class=\"progressWrapper\"><span class=\"progressText\"></span></span></td></tr>';
    }
    \$('#urlUpload #urls').html(html);

    // show file uploader screen
    \$('#urlUpload #urlFileListingWrapper').removeClass('hidden');
    \$('#urlUpload #urlFileUploader').addClass('hidden');

    // loop over urls and try to retrieve the file
    startRemoteUrlDownload(currentUrlItem);

}

function updateUrlProgress(data)
{
    \$.each(data, function (key, value) {
        switch (key)
        {
            case 'progress':
                percentageDone = parseInt(value.loaded / value.total * 100, 10);

                textContent = '';
                textContent += 'Progress: ' + percentageDone + '%';
                textContent += ' ';
                textContent += '(' + bytesToSize(value.loaded, 2) + ' / ' + bytesToSize(value.total, 2) + ')';

                progressText = textContent;
                \$('#rowId' + value.rowId + ' .progressText').html(progressText);
                break;
            case 'done':
                handleUrlUploadSuccess(value);

                if ((currentUrlItem + 1) < totalUrlItems)
                {
                    currentUrlItem = currentUrlItem + 1;
                    startRemoteUrlDownload(currentUrlItem);
                }
                break;
        }
    });
}

function startRemoteUrlDownload(index)
{
    // show progress
    \$('#urlUpload .urlFileListingWrapper .processing-button').removeClass('hidden');

    // get file list as array
    urlList = \$('#urlList').val();
    urlList = findUrls(urlList);

    // create iframe to track progress
    var iframe = \$('<iframe src=\"javascript:false;\" style=\"display:none;\"></iframe>');
    iframe
            .prop('src', '";
        // line 749
        echo ($context["urlUploadAction"] ?? null);
        echo "&rowId=' + index + '&url=' + encodeURIComponent(urlList[index]) + '&folderId=' + fileFolder)
            .appendTo(document.body);
}

function handleUrlUploadSuccess(data)
{
    isSuccess = true;
    if (data.error != null)
    {
        isSuccess = false;
    }

    html = '';
    html += '<tr class=\"template-download';
    if (isSuccess == false)
    {
        html += ' errorText';
    }
    html += '\" onClick=\"return showAdditionalInformation(this);\">'
    if (isSuccess == false)
    {
        // add result html
        html += data.error_result_html;
    }
    else
    {
        // add result html
        html += data.success_result_html;

        // keep a copy of the urls globally
        fileUrls.push(data.url);
        fileUrlsHtml.push(data.url_html);
        fileUrlsBBCode.push(data.url_bbcode);
        fileDeleteHashes.push(data.delete_hash);
        fileShortUrls.push(data.short_url);
    }

    html += '</tr>';

    \$('#rowId' + data.rowId).replaceWith(html);

    if (data.rowId == urlList.length - 1)
    {
        // show footer
        \$('#urlUpload .urlFileListingWrapper .processing-button').addClass('hidden');
        \$('#urlUpload .fileSectionFooterText').removeClass('hidden');

        // set additional options
        sendAdditionalOptions();

        // setup copy link
        setupCopyAllLink();
        delay(function() {
                \$('#hide_modal_btn').click();
        }, 1500);
    }
}

";
        // line 807
        if ((($context["backgroundUrlDownloading"] ?? null) == true)) {
            // line 808
            echo "var gBackgroundUrlTableLoaded = false;
var gBackgroundUrlDoneInitialLoad = false;
\$(document).ready(function() {
    loadBackgroundUrlDownloadTable();

    // refresh every 10 seconds
    window.setInterval(function() {
        if (gBackgroundUrlTableLoaded == false)
        {
            return true;
        }
        gBackgroundUrlTableLoaded = false;
        loadBackgroundUrlDownloadTable();
    }, 10000);
});

function loadBackgroundUrlDownloadTable()
{
    // only do this when tab is visible
    if(\$('#urlUpload').is(':visible') == false)
    {
        if(gBackgroundUrlDoneInitialLoad == true)
        {
            return;
        }
    }
    
    \$.ajax({
        type: \"GET\",
        url: \"";
            // line 837
            echo twig_escape_filter($this->env, ($context["ACCOUNT_WEB_ROOT"] ?? null), "html", null, true);
            echo "/ajax/existing_background_url_download\",
        dataType: 'html',
        success: function(html) {
            \$('#urlBackgroundDownloadExistingWrapper').html(html);
            \$('#urlUpload #urlFileListingWrapper').addClass('hidden');
            \$('#urlUpload #urlFileUploader').removeClass('hidden');
            setupBackgroundUrlDatatable();
            gBackgroundUrlTableLoaded = true;
            gBackgroundUrlDoneInitialLoad = true;
        }
    });
}

function setupBackgroundUrlDatatable()
{
    \$('#existingBackgroundUrlDownloadTable').dataTable({
        \"sPaginationType\": \"full_numbers\",
        \"bAutoWidth\": false,
        \"bProcessing\": false,
        \"iDisplayLength\": 20,
        \"bFilter\": false,
        \"bSort\": true,
        \"bDestroy\": true,
        \"bLengthChange\": false,
        \"bPaginate\": false,
        \"bInfo\": false,
        \"aoColumns\": [
            {sClass: \"alignCenter text-center\"},
            {},
            {sClass: \"alignCenter text-center\"},
            {sClass: \"alignCenter text-center\"}
        ],
        \"oLanguage\": {
            \"oPaginate\": {
                \"sFirst\": \"";
            // line 871
            echo twig_escape_filter($this->env, twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("datatable_first", "First"), "js"), "html", null, true);
            echo "\",
                \"sPrevious\": \"";
            // line 872
            echo twig_escape_filter($this->env, twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("datatable_previous", "Previous"), "js"), "html", null, true);
            echo "\",
                \"sNext\": \"";
            // line 873
            echo twig_escape_filter($this->env, twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("datatable_next", "Next"), "js"), "html", null, true);
            echo "\",
                \"sLast\": \"";
            // line 874
            echo twig_escape_filter($this->env, twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("datatable_last", "Last"), "js"), "html", null, true);
            echo "\"
            },
            \"sEmptyTable\": \"";
            // line 876
            echo twig_escape_filter($this->env, twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("datatable_no_data_available_in_table", "No data available in table"), "js"), "html", null, true);
            echo "\",
            \"sInfo\": \"";
            // line 877
            echo twig_escape_filter($this->env, twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("datatable_showing_x_to_x_of_total_entries", "Showing _START_ to _END_ of _TOTAL_ entries"), "js"), "html", null, true);
            echo "\",
            \"sInfoEmpty\": \"";
            // line 878
            echo twig_escape_filter($this->env, twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("datatable_no_data", "No data"), "js"), "html", null, true);
            echo "\",
            \"sLengthMenu\": \"";
            // line 879
            echo twig_escape_filter($this->env, twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("datatable_show_menu_entries", "Show _MENU_ entries"), "js"), "html", null, true);
            echo "\",
            \"sProcessing\": \"";
            // line 880
            echo twig_escape_filter($this->env, twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("datatable_loading_please_wait", "Loading, please wait..."), "js"), "html", null, true);
            echo "\",
            \"sInfoFiltered\": \"";
            // line 881
            echo twig_escape_filter($this->env, twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("datatable_base_filtered", " (filtered"), "js"), "html", null, true);
            echo "\",
            \"sSearch\": \"";
            // line 882
            echo twig_escape_filter($this->env, twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("datatable_search_text", "Search:"), "js"), "html", null, true);
            echo "\",
            \"sZeroRecords\": \"";
            // line 883
            echo twig_escape_filter($this->env, twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("datatable_no_matching_records_found", "No matching records found"), "js"), "html", null, true);
            echo "\"
        }
    });
}

function confirmRemoveBackgroundUrl(urlId)
{
    if(confirm(\"";
            // line 890
            echo twig_escape_filter($this->env, twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("are_you_sure_you_want_to_remove_the_remote_url_download", "Are you sure you want to cancel this download?"), "js"), "html", null, true);
            echo "\"))
    {
        return removeBackgroundUrl(urlId);            
    }

    return false;
}

function removeBackgroundUrl(urlId)
{
    \$.ajax({
        type: \"GET\",
        url: \"";
            // line 902
            echo twig_escape_filter($this->env, ($context["ACCOUNT_WEB_ROOT"] ?? null), "html", null, true);
            echo "/ajax/remove_background_url_download/\"+urlId,
        dataType: 'json',
        success: function(json) {
            if(json.error == true)
            {
                alert(json.msg);
            }
            else
            {
                loadBackgroundUrlDownloadTable();
            }
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            alert('Error getting response from server. '+XMLHttpRequest.responseText);
        }
    });
}
";
        }
    }

    public function getTemplateName()
    {
        return "account/partial/_uploader_javascript.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  1093 => 902,  1078 => 890,  1068 => 883,  1064 => 882,  1060 => 881,  1056 => 880,  1052 => 879,  1048 => 878,  1044 => 877,  1040 => 876,  1035 => 874,  1031 => 873,  1027 => 872,  1023 => 871,  986 => 837,  955 => 808,  953 => 807,  892 => 749,  832 => 694,  821 => 686,  816 => 684,  808 => 679,  794 => 668,  726 => 603,  593 => 477,  584 => 473,  501 => 393,  495 => 392,  485 => 385,  370 => 273,  358 => 263,  354 => 261,  352 => 260,  334 => 247,  308 => 224,  274 => 193,  191 => 113,  147 => 71,  139 => 66,  130 => 61,  128 => 60,  122 => 57,  118 => 56,  113 => 54,  109 => 53,  105 => 52,  101 => 51,  84 => 37,  75 => 31,  71 => 30,  65 => 27,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "account/partial/_uploader_javascript.html.twig", "/var/www/html/medicalimage/themes/evolution/views/account/partial/_uploader_javascript.html.twig");
    }
}
