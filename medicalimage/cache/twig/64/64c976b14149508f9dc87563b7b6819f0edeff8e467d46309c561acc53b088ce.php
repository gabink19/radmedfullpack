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

/* account/partial/account_home_javascript.html.twig */
class __TwigTemplate_a06a6609498a2d78795c2489ee1988e9071bcfbfefcdcc712ef2eb3f1625661a extends \Twig\Template
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
        echo "<link rel=\"stylesheet\" href=\"";
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountCssPath", [], "method", false, false, false, 1), "html", null, true);
        echo "/file_browser_sprite_48px.css\" type=\"text/css\" charset=\"utf-8\" />

<script type=\"text/javascript\">
    var cur = -1, prv = -1;
    var pageStart = 0;
    var perPage = 30;
    var fileId = 0;
    var intialLoad = true;
    var uploaderShown = false;
    var fromFilterModal = false;
    var doubleClickTimeout = null;
    var backgroundFolderLoading = false;
    var clipboard = null;
    var triggerTreeviewLoad = true;
    \$(function () {
        // initial button state
        updateFileActionButtons();
        ";
        // line 18
        if (((isset($context["initialFileId"]) || array_key_exists("initialFileId", $context)) && (($context["initialFileId"] ?? null) > 0))) {
            // line 19
            echo "            showFileInformation(";
            echo twig_escape_filter($this->env, ($context["initialFileId"] ?? null), "html", null, true);
            echo ");
            backgroundFolderLoading = true;
        ";
        }
        // line 22
        echo "
        ";
        // line 23
        if ((twig_get_attribute($this->env, $this->source, ($context["Auth"] ?? null), "loggedIn", [], "any", false, false, false, 23) == true)) {
            // line 24
            echo "        // load folder listing
        \$(\"#folderTreeview\").jstree({
            \"plugins\": [
                \"themes\", \"json_data\", \"ui\", \"types\", \"crrm\", \"contextmenu\", \"cookies\"
            ],
            \"themes\": {
                \"theme\": \"default\",
                \"dots\": false,
                \"icons\": true
            },
            \"core\": {\"animation\": 150},
            \"json_data\": {
                \"data\": [
                    {
                        \"data\": \"";
            // line 38
            echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("my_files", "My Files"), "html", null, true);
            if ((($context["totalRootFiles"] ?? null) > 0)) {
                echo " (";
                echo twig_escape_filter($this->env, ($context["totalRootFiles"] ?? null), "html", null, true);
                echo ")";
            }
            echo "\",
                        \"state\": \"closed\",
                        \"attr\": {\"pageType\": \"folder\", \"id\": \"-1\", \"rel\": \"home\", \"original-text\": ";
            // line 40
            echo json_encode($this->extensions['App\Services\TTwigExtension']->tHandler("my_files", "My Files"));
            echo "}
                    },
                    {
                        \"data\": \"";
            // line 43
            echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("shared_with_me", "Shared With Me"), "html", null, true);
            if ((($context["totalSharedWithMeFiles"] ?? null) > 0)) {
                echo " (";
                echo twig_escape_filter($this->env, ($context["totalSharedWithMeFiles"] ?? null), "html", null, true);
                echo ")";
            }
            echo "\",
                        \"attr\": {\"pageType\": \"shared\", \"id\": \"shared\", \"rel\": \"shared\", \"original-text\": ";
            // line 44
            echo json_encode($this->extensions['App\Services\TTwigExtension']->tHandler("shared_with_me", "Shared With Me"));
            echo "}
                    },
                    {
                        \"data\": \"";
            // line 47
            echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("recent_files", "Recent Files"), "html", null, true);
            echo "\",
                        \"attr\": {\"pageType\": \"recent\", \"id\": \"recent\", \"rel\": \"recent\", \"original-text\": ";
            // line 48
            echo json_encode($this->extensions['App\Services\TTwigExtension']->tHandler("recent_files", "Recent Files"));
            echo "}
                    },
                    {
                        \"data\": \"";
            // line 51
            echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("all_files", "All Files"), "html", null, true);
            if ((($context["totalActiveFiles"] ?? null) > 0)) {
                echo " (";
                echo twig_escape_filter($this->env, ($context["totalActiveFiles"] ?? null), "html", null, true);
                echo ")";
            }
            echo "\",
                        \"attr\": {\"pageType\": \"all\", \"id\": \"all\", \"rel\": \"all\", \"original-text\": ";
            // line 52
            echo json_encode($this->extensions['App\Services\TTwigExtension']->tHandler("all_files", "All Files"));
            echo "}
                    },
                    {
                        \"data\": \"";
            // line 55
            echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("trash_can", "Trash Can"), "html", null, true);
            if ((($context["totalTrash"] ?? null) > 0)) {
                echo " (";
                echo twig_escape_filter($this->env, ($context["totalTrash"] ?? null), "html", null, true);
                echo ")";
            }
            echo "\",
                        \"attr\": {\"pageType\": \"trash\", \"id\": \"trash\", \"rel\": \"bin\", \"original-text\": ";
            // line 56
            echo json_encode($this->extensions['App\Services\TTwigExtension']->tHandler("trash_can", "Trash Can"));
            echo "}
                    }
                ],
                \"ajax\": {
                    \"url\": function (node) {
                        var nodeId = \"\";
                        var url = \"\"
                        if (node == -1)
                        {
                            url = \"";
            // line 65
            echo twig_escape_filter($this->env, ($context["ACCOUNT_WEB_ROOT"] ?? null), "html", null, true);
            echo "/ajax/home_v2_folder_listing\";
                        }
                        else
                        {
                            nodeId = node.attr('id');
                            url = \"";
            // line 70
            echo twig_escape_filter($this->env, ($context["ACCOUNT_WEB_ROOT"] ?? null), "html", null, true);
            echo "/ajax/home_v2_folder_listing?folder=\" + nodeId;
                        }

                        return url;
                    }
                }
            },
            \"contextmenu\": {
                \"items\": buildTreeViewContextMenu
            },
            'progressive_render': true
        }).bind(\"dblclick.jstree\", function (event, data) {
            var node = \$(event.target).closest(\"li\");
            if (\$(node).hasClass('jstree-leaf') == true)
            {
                return false;
            }

            //\$(\"#folderTreeview\").jstree(\"toggle_node\", node.data(\"jstree\"));
        }).bind(\"select_node.jstree\", function (event, data) {
            // use this to stop the treeview from triggering a reload of the file manager
            if(triggerTreeviewLoad == false)
            {
                triggerTreeviewLoad = true;
                return false;
            }

            // add a slight delay encase this is a double click
            if (intialLoad == false)
            {
                // wait before loading the files, just encase this is a double click
                clickTreeviewNode(event, data);
                return false;
            }

            clickTreeviewNode(event, data);
        }).bind(\"load_node.jstree\", function (event, data) {
            // assign click to icon
            assignNodeExpandClick();
            reSelectFolder();
        }).bind(\"open_node.jstree\", function (event, data) {
            // reassign drag crop for sub-folder
            setupTreeviewDropTarget();
        }).delegate(\"a\", \"click\", function (event, data) {
            event.preventDefault();
        }).bind('loaded.jstree', function (e, data) {
            // load default view if not stored in cookie
            var doIntial = true;
            if (typeof (\$.cookie(\"jstree_open\")) != \"undefined\")
            {
                if (\$.cookie(\"jstree_open\").length > 0)
                {
                    doIntial = false;
                }
            }

            if (doIntial == true)
            {
                \$(\"#folderTreeview\").jstree(\"open_node\", \$(\"#-1\"));
            }

            // reload stats
            updateStatsViaAjax();
        });

        var doIntial = true;
        if (typeof (\$.cookie(\"jstree_select\")) != \"undefined\")
        {
            if (\$.cookie(\"jstree_select\").length > 0)
            {
                doIntial = false;
            }
        }
        if (doIntial == true)
        {
            // load file listing
            \$('#nodeId').val('-1');
        }

        \$(\"#fileManager\").click(function (event) {
            if (ctrlPressed == false)
            {
                if (\$(event.target).is('ul') || \$(event.target).hasClass('fileManager')) {
                    clearSelectedItems();
                }
            }
        });

        setupFileDragSelect();
        
        // load the uploader ready in the background. This also enables the drag and drop upload
        loadUploader(false);
        ";
        }
        // line 163
        echo "    });

    function assignNodeExpandClick()
    {
        \$('.jstree-icon').off('click');
        \$('.jstree-icon').on('click', function (event) {
            var node = \$(event.target).parent().parent();
            if (\$(node).hasClass('jstree-leaf') != true)
            {
                // expand
                \$(\"#folderTreeview\").jstree(\"toggle_node\", \$(node));

                // stop the node from being selected
                event.stopPropagation();
                event.preventDefault();
            }
        });
    }

    function clickTreeviewNode(event, data)
    {
        clearSelectedItems();
        clearSearchFilters(false);
\tcancelPendingNetworkRequests();

        // load via ajax
        if (intialLoad == true)
        {
            intialLoad = false;
        }
        else
        {
            \$('#nodeId').val(data.rslt.obj.attr(\"id\"));
            \$('#folderIdDropdown').val(\$('#nodeId').val());
            if (typeof (setUploadFolderId) === 'function')
            {
                setUploadFolderId(\$('#nodeId').val());
            }
            loadImages(data.rslt.obj.attr(\"pageType\"), data.rslt.obj.attr(\"id\"));
        }
    }
\t
    function cancelPendingNetworkRequests()
    {
        // disabled due to adverse side effects on refresh
        return false;

        // don't cancel if we're uploading files
        if(uploadComplete == false)
        {
            return false;
        }

        if(window.stop !== undefined)
        {
            window.stop();
        }
        else if(document.execCommand !== undefined)
        {
            document.execCommand(\"Stop\", false);
        }
    }

    function updateFolderDropdownMenuItems()
    {
        // not a sub folder
        if (isPositiveInteger(\$('#nodeId').val()) == false)
        {
            \$('#subFolderOptions').hide();
            \$('#topFolderOptions').show();
        }
        // all sub folders / menu options
        else
        {
            \$('#topFolderOptions').hide();
            \$('#subFolderOptions').show();
        }
    }

    function reloadDragItems()
    {
        \$('.fileIconLi, .folderIconLi')
                .drop(\"start\", function () {
                    \$(this).removeClass(\"active\");
                    if (\$(this).hasClass(\"selected\") == false)
                    {
                        \$(this).addClass(\"active\");
                    }
                })
                .drop(function (ev, dd) {
                    if(typeof(\$(this).attr('fileId')) != 'undefined') {
                        selectFile(\$(this).attr('fileId'), true);
                    }
                    else {
                        selectFolder(\$(this).attr('folderId'), true);
                    }
                })
                .drop(\"end\", function () {
                    \$(this).removeClass(\"active\");
                });
        \$.drop({multi: true});
    }

    function refreshFolderListing(triggerLoad)
    {
\t\tif(typeof(triggerLoad) != \"undefined\")
\t\t{
\t\t\ttriggerTreeviewLoad = triggerLoad;
\t\t}
\t\t
        \$(\"#folderTreeview\").jstree(\"refresh\");
    }

    function buildTreeViewContextMenu(node)
    {
        var items = {
            \"Open\": {
                \"label\": \"";
        // line 280
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("open_folder", "Open Folder"), "html", null, true);
        echo "\",
                                    \"icon\": \"glyphicon glyphicon-folder-open\",
                \"separator_after\": false,
                \"action\": function (obj) {
                    loadImages(obj.attr(\"pageType\"), obj.attr(\"id\"));
                }
            }
        };

        if (\$(node).attr('id') == 'trash')
        {
            items[\"Empty\"] = {
                    \"label\": \"";
        // line 292
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("empty_trash", "Empty Trash"), "html", null, true);
        echo "\",
\t\t\t\t\t\"icon\": \"glyphicon glyphicon-trash\",
                    \"action\": function (obj) {
                        confirmEmptyTrash();
                    }
                };
        }
        else if (\$(node).attr('id') == '-1')
        {
            items[\"Upload\"] = {
                    \"label\": \"";
        // line 302
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("upload_files", "Upload Files"), "html", null, true);
        echo "\",
\t\t\t\t\t\"icon\": \"glyphicon glyphicon-cloud-upload\",
                    \"separator_after\": true,
                    \"action\": function (obj) {
                        uploadFiles('');
                    }
                };
                
            items[\"Add\"] = {
                    \"label\": \"";
        // line 311
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("add_folder", "Add Folder"), "html", null, true);
        echo "\",
\t\t\t\t\t\"icon\": \"glyphicon glyphicon-plus\",
                    \"action\": function (obj) {
                        showAddFolderForm(obj.attr(\"id\"));
                    }
                };
        }
        else if (\$.isNumeric(\$(node).attr('id')))
        {
            if(\$(node).attr('permission') != 'view')
            {
                items[\"Upload\"] = {
                        \"label\": \"";
        // line 323
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("upload_files", "Upload Files"), "html", null, true);
        echo "\",
                                            \"icon\": \"glyphicon glyphicon-cloud-upload\",
                        \"separator_after\": true,
                        \"action\": function (obj) {
                            uploadFiles(obj.attr(\"id\"));
                        }
                    };
            }
                
            if(\$(node).attr('permission') == 'all')
            {
                items[\"Add\"] = {
                        \"label\": \"";
        // line 335
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("add_sub_folder", "Add Sub Folder"), "html", null, true);
        echo "\",
                                            \"icon\": \"glyphicon glyphicon-plus\",
                        \"action\": function (obj) {
                            showAddFolderForm(obj.attr(\"id\"));
                        }
                    };
                items[\"Edit\"] = {
                        \"label\": \"";
        // line 342
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("edit_folder", "Edit"), "html", null, true);
        echo "\",
                                            \"icon\": \"glyphicon glyphicon-pencil\",
                        \"action\": function (obj) {
                            showAddFolderForm(null, obj.attr(\"id\"));
                        }
                    };
                items[\"Delete\"] = {
                        \"label\": \"";
        // line 349
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("delete_folder", "Delete"), "html", null, true);
        echo "\",
                                            \"icon\": \"glyphicon glyphicon-trash\",
                        \"action\": function (obj) {
                            confirmTrashFolder(obj.attr(\"id\"));
                        }
                    };
            }
            
            if(\$(node).attr('permission') != 'view')
            {
                items[\"Download\"] = {
                        \"label\": \"";
        // line 360
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("download_all_files", "Download All Files (Zip)"), "html", null, true);
        echo "\",
                                            \"icon\": \"glyphicon glyphicon-floppy-save\",
                        \"separator_before\": true,
                        \"action\": function (obj) {
                            downloadAllFilesFromFolder(obj.attr(\"id\"));
                        }
                    };
            }

            if(\$(node).attr('permission') == 'all')
            {
                items[\"Share\"] = {
                        \"label\": \"";
        // line 372
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("share_folder", "Share Folder"), "html", null, true);
        echo "\",
                            \"icon\": \"glyphicon glyphicon-share\",
                        \"action\": function (obj) {
                            showSharingForm(obj.attr(\"id\"));
                        }
                    };
            }
            
            items[\"HtmlMenuSection\"] = {
                    \"label\": \"<span class='menu-folder-details'><ul><li>Owner: \"+\$(node).attr('owner')+\"</li><li>Access Rights: \"+uCWords(\$(node).attr('permission').replace('_', ' '))+\"</li><li>Size: \"+\$(node).attr('total_size')+\"</li></ul></span>\",
                    \"separator_before\": true,
                    \"action\": function (obj) {
                        loadImages(obj.attr(\"pageType\"), obj.attr(\"id\"));
                    }
                };
        }

        return items;
    }

    function confirmTrashFolder(folderId)
    {
        // only allow actual sub folders
        if (isPositiveInteger(folderId) == false)
        {
            return false;
        }

        if (confirm(";
        // line 400
        echo json_encode($this->extensions['App\Services\TTwigExtension']->tHandler("are_you_sure_you_want_to_trash_this_folder_inc_files", "Are you sure you want to send this folder to trash? Any files within the folder will also be sent to trash."));
        echo "))
        {
            trashFolder(folderId);
        }

        return false;
    }

    function trashFolder(folderId)
    {
        // trash files
\t\$.ajax({
\t\ttype: \"POST\",
\t\turl: ACCOUNT_WEB_ROOT+\"/ajax/trash_files\",
\t\tdata: {fileIds: [], folderIds: [folderId]},
\t\tdataType: 'json',
\t\tsuccess: function(json) {
                    if (json.error == true)
                    {
                        showErrorNotification('Error', json.msg);
                    }
                    else
                    {
                        // refresh treeview
                        showSuccessNotification('Success', json.msg);
                        refreshFolderListing();
                    }
\t\t},
\t\terror: function(XMLHttpRequest, textStatus, errorThrown) {
                    showErrorNotification('Error', 'General error');
\t\t}
\t});
    }


    function confirmEmptyTrash()
    {
        if (confirm(";
        // line 437
        echo json_encode($this->extensions['App\Services\TTwigExtension']->tHandler("are_you_sure_you_want_to_empty_the_trash", "Are you sure you want to empty the trash can? Any statistics and other file information will be permanently deleted."));
        echo "))
        {
            emptyTrash();
        }

        return false;
    }

    function emptyTrash()
    {
        \$.ajax({
            dataType: \"json\",
            url: \"";
        // line 449
        echo twig_escape_filter($this->env, ($context["ACCOUNT_WEB_ROOT"] ?? null), "html", null, true);
        echo "/ajax/empty_trash\",
            success: function (data) {
                if (data.error == true)
                {
                    alert(data.msg);
                }
                else
                {
                    // reload file listing
                    loadImages('trash');

                    // reload stats
                    updateStatsViaAjax();
                }
            }
        });
    }

    var hideLoader = false;
    function loadFiles(folderId)
    {
        // get variables
        if (typeof (folderId) == 'undefined')
        {
            folderId = \$('#nodeId').val();
        }

        loadImages('folder', folderId);
    }

    function dblClickFile(fileId)
    {

    }
\t
\tfunction clearExistingHoverFileItem()
\t{
\t\t\$('.hoverItem').removeClass('hoverItem');
\t}

    function showFileMenu(liEle, clickEvent)
    {
        clickEvent.stopPropagation();
        hideOpenContextMenus();
\t\t
        fileId = \$(liEle).attr('fileId');
        downloadUrl = \$(liEle).attr('dtfullurl');
        statsUrl = \$(liEle).attr('dtstatsurl');
        isDeleted = \$(liEle).hasClass('fileDeletedLi');
        fileName = \$(liEle).attr('dtfilename');
        extraMenuItems = \$(liEle).attr('dtextramenuitems');
        var items = {
            \"Stats\": {
                \"label\": \"";
        // line 502
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("account_file_details_stats", "Stats")), "html", null, true);
        echo "\",
                \"icon\": \"glyphicon glyphicon-stats\",
                \"action\": function (obj) {
                    showStatsPopup(fileId);
                }
            },
            \"Select\": {
                \"label\": \"";
        // line 509
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("account_file_details_select_file", "Select File")), "html", null, true);
        echo " \",
                \"icon\": \"glyphicon glyphicon-check\",
                \"action\": function (obj) {
                    selectFile(fileId, true);
                }
            },
            \"Restore\": {
                \"label\": \"";
        // line 516
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("restore", "Restore"), "html", null, true);
        echo "\",
                \"icon\": \"glyphicon glyphicon-export\",
                \"separator_after\": false,
                \"action\": function (obj) {
                    selectFile(fileId, true);
                    restoreItems();
                }
            },
            \"Delete\": {
                \"label\": \"";
        // line 525
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("permanently_delete", "Permanently Delete"), "html", null, true);
        echo "\",
                \"icon\": \"glyphicon glyphicon-remove\",
                \"separator_after\": false,
                \"action\": function (obj) {
                    selectFile(fileId, true);
                    deleteFiles();
                }
            }
        };

        if (isDeleted == false)
        {
            var items = {};

            // replace any items for overwriting (plugins)
            if (extraMenuItems.length > 0)
            {
                items = JSON.parse(extraMenuItems);
                for (i in items)
                {
                    // setup click action on menu item
                    eval(\"items['\" + i + \"']['action'] = \" + items[i]['action']);
                }
            }
\t\t\t
            // default menu items
            items[\"View\"] = {
                \"label\": \"";
        // line 552
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("account_file_details_view", "View")), "html", null, true);
        echo "\",
                \"icon\": \"glyphicon glyphicon-zoom-in\",
                \"action\": function (obj) {
                    showFile(fileId);
                }
            };

            items[\"Download\"] = {
                \"label\": \"";
        // line 560
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("account_file_details_download", "Download")), "html", null, true);
        echo " \" + htmlEntities(fileName),
                \"icon\": \"glyphicon glyphicon-download-alt\",
                \"action\": function (obj) {
                    openUrl('";
        // line 563
        echo twig_escape_filter($this->env, ($context["ACCOUNT_WEB_ROOT"] ?? null), "html", null, true);
        echo "/direct_download/' + fileId);
                }
            };
            
            items[\"Share\"] = {
                \"label\": \"";
        // line 568
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("account_file_details_share", "Share")), "html", null, true);
        echo "\",
                \"icon\": \"glyphicon glyphicon-share\",
                \"separator_after\": true,
                \"action\": function (obj) {
                    selectFile(fileId, true);
                    showSharingForm();
                }
            };

            items[\"Edit\"] = {
                \"label\": \"";
        // line 578
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("account_file_details_edit_file_info", "Edit File Info")), "html", null, true);
        echo "\",
                \"icon\": \"glyphicon glyphicon-pencil\",
                \"action\": function (obj) {
                    showEditFileForm(fileId);
                }
            };
\t\t\t
            items[\"Duplicate\"] = {
                \"label\": \"";
        // line 586
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("account_file_details_create_copy", "Create Copy")), "html", null, true);
        echo "\",
                \"icon\": \"glyphicon glyphicon-plus-sign\",
                \"action\": function (obj) {
                selectFile(fileId, true);
                    duplicateFiles();
                }
            };

            items[\"Delete\"] = {
                \"label\": \"";
        // line 595
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("account_file_details_delete", "Delete")), "html", null, true);
        echo "\",
                \"icon\": \"glyphicon glyphicon-trash\",
                \"separator_after\": true,
                \"action\": function (obj) {
                    selectFile(fileId, true);
                    trashFiles();
                }
            };
\t\t\t
            items[\"Copy\"] = {
                \"label\": \"";
        // line 605
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("copy_url_to_clipboard", "Copy Url to Clipboard"), "html", null, true);
        echo "\",
                \"icon\": \"entypo entypo-clipboard\",
                \"classname\": \"fileMenuItem\"+fileId,
                \"separator_after\": true,
                \"action\": function (obj) {
                    selectFile(fileId, true);
                    fileUrlText = '';
                    for (i in selectedFiles)
                    {
                        fileUrlText += selectedFiles[i][3] + \"<br/>\";
                    }
                    \$('#clipboard-placeholder').html(fileUrlText);
                    copyToClipboard('.fileMenuItem'+fileId);
                }
            };

            items[\"Select\"] = {
                \"label\": \"";
        // line 622
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("account_file_details_select_file", "Select File")), "html", null, true);
        echo " \",
                \"icon\": \"glyphicon glyphicon-check\",
                \"action\": function (obj) {
                    selectFile(fileId, true);
                }
            };

            items[\"Links\"] = {
                \"label\": \"";
        // line 630
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("file_manager_links", "Links")), "html", null, true);
        echo "\",
                \"icon\": \"glyphicon glyphicon-link\",
                \"action\": function (obj) {
                    selectFile(fileId, true);
                    viewFileLinks();
                    // clear selected if only 1
                    if (countSelected() == 1)
                    {
                        clearSelectedItems();
                    }
                }
            };

            items[\"Stats\"] = {
                \"label\": \"";
        // line 644
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("account_file_details_stats", "Stats")), "html", null, true);
        echo "\",
                \"icon\": \"glyphicon glyphicon-stats\",
                \"action\": function (obj) {
                    showStatsPopup(fileId);
                }
            };

            // replace any items for overwriting
            for (i in extraMenuItems)
            {
                if (typeof (items[i]) != 'undefined')
                {
                    items[i] = extraMenuItems[i];
                }
            }
        }
        \$.vakata.context.show(items, \$(liEle), clickEvent.pageX - 15, clickEvent.pageY - 8, liEle);
        return false;
    }
\t
    function showFolderMenu(liEle, clickEvent)
    {
        clickEvent.stopPropagation();
        var folderId = \$(liEle).attr('folderId');
        var isDeleted = \$(liEle).hasClass('folderDeletedLi');
        if(isDeleted == false) {
            var items = {
                \"Upload\": {
                    \"label\": \"";
        // line 672
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("upload_files", "Upload Files"), "html", null, true);
        echo "\",
                    \"icon\": \"glyphicon glyphicon-cloud-upload\",
                    \"separator_after\": true,
                    \"action\": function (obj) {
                        uploadFiles(folderId);
                    }
                },
                \"Add\": {
                    \"label\": \"";
        // line 680
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("add_sub_folder", "Add Sub Folder"), "html", null, true);
        echo "\",
                    \"icon\": \"glyphicon glyphicon-plus\",
                    \"action\": function (obj) {
                        showAddFolderForm(folderId);
                    }
                },
                \"Edit\": {
                    \"label\": \"";
        // line 687
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("edit_folder", "Edit"), "html", null, true);
        echo "\",
                    \"icon\": \"glyphicon glyphicon-pencil\",
                    \"action\": function (obj) {
                        showAddFolderForm(null, folderId);
                    }
                },
                \"Delete\": {
                    \"label\": \"";
        // line 694
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("delete_folder", "Delete"), "html", null, true);
        echo "\",
                    \"icon\": \"glyphicon glyphicon-trash\",
                    \"action\": function (obj) {
                        selectFolder(folderId, true);
                        trashFiles();
                    }
                },
                \"Download\": {
                    \"label\": \"";
        // line 702
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("download_all_files", "Download All Files (Zip)"), "html", null, true);
        echo "\",
                    \"icon\": \"glyphicon glyphicon-floppy-save\",
                    \"separator_before\": true,
                    \"action\": function (obj) {
                        downloadAllFilesFromFolder(folderId);
                    }
                },
                \"Copy\": {
                    \"label\": \"";
        // line 710
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("copy_url_to_clipboard", "Copy Url to Clipboard"), "html", null, true);
        echo "\",
                    \"icon\": \"entypo entypo-clipboard\",
                    \"classname\": \"folderMenuItem\"+folderId,
                    \"separator_before\": true,
                    \"action\": function (obj) {
                        \$('#clipboard-placeholder').html(\$('#folderItem'+folderId).attr('sharing-url'));
                        copyToClipboard('.folderMenuItem'+folderId);
                    }
                },
                \"Share\": {
                    \"label\": \"";
        // line 720
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("account_file_details_share", "Share"), "html", null, true);
        echo "\",
                    \"icon\": \"glyphicon glyphicon-share\",
                    \"action\": function (obj) {
                        selectFolder(folderId, true);
                        showSharingForm();
                    }
                }
            };
        }
        else {
            var items = {
                \"Select\": {
                    \"label\": \"";
        // line 732
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("account_file_details_select_folder", "Select Folder")), "html", null, true);
        echo " \",
                    \"icon\": \"glyphicon glyphicon-check\",
                    \"action\": function (obj) {
                        selectFolder(folderId, true);
                    }
                },
                \"Restore\": {
                    \"label\": \"";
        // line 739
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("restore", "Restore"), "html", null, true);
        echo "\",
                    \"icon\": \"glyphicon glyphicon-export\",
                    \"separator_after\": false,
                    \"action\": function (obj) {
                        selectFolder(folderId, true);
                        restoreItems();
                    }
                },
                \"Delete\": {
                    \"label\": \"";
        // line 748
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("permanently_delete", "Permanently Delete"), "html", null, true);
        echo "\",
                    \"icon\": \"glyphicon glyphicon-remove\",
                    \"separator_after\": false,
                    \"action\": function (obj) {
                        selectFolder(folderId, true);
                        deleteFiles();
                    }
                }
            }
        }

        \$.vakata.context.show(items, \$(liEle), clickEvent.pageX - 15, clickEvent.pageY - 8, liEle);
        return false;
    }

    function selectFile(fileId, onlySelectOn)
    {
        if (typeof (onlySelectOn) == \"undefined\")
        {
            onlySelectOn = false;
        }

        // clear any selected if ctrl key not pressed
        if ((ctrlPressed == false) && (onlySelectOn == false))
        {
            showFileInformation(fileId);

            return false;
        }

        elementId = 'fileItem' + fileId;
        if ((\$('.' + elementId).hasClass('selected')) && (onlySelectOn == false))
        {
            \$('.' + elementId).removeClass('selected');
            if (typeof (selectedFiles['k' + fileId]) != 'undefined')
            {
                delete selectedFiles['k' + fileId];
            }
        }
        else
        {
            \$('.' + elementId + '.owned-image').addClass('selected');
            if (\$('.' + elementId).hasClass('selected'))
            {
                selectedFiles['k' + fileId] = [fileId, \$('.' + elementId).attr('dttitle'), \$('.' + elementId).attr('dtsizeraw'), \$('.' + elementId).attr('dtfullurl'), \$('.' + elementId).attr('dturlhtmlcode'), \$('.' + elementId).attr('dturlbbcode')];
            }
        }

        updateSelectedItemsStatusText();
        updateFileActionButtons();
    }
    
    function selectFolder(folderId, onlySelectOn)
    {
        if (typeof (onlySelectOn) == \"undefined\")
        {
            onlySelectOn = false;
        }

        // clear any selected if ctrl key not pressed
        if ((ctrlPressed == false) && (onlySelectOn == false))
        {
            loadFolderFiles(folderId);

            return false;
        }

        elementId = 'folderItem' + folderId;
        if ((\$('.' + elementId).hasClass('selected')) && (onlySelectOn == false))
        {
            \$('.' + elementId).removeClass('selected');
            if (typeof (selectedFolders['k' + folderId]) != 'undefined')
            {
                delete selectedFolders['k' + folderId];
            }
        } else
        {
            \$('.' + elementId).addClass('selected');
            if (\$('.' + elementId).hasClass('selected'))
            {
                selectedFolders['k' + folderId] = [folderId];
            }
        }

        updateSelectedItemsStatusText();
        updateFileActionButtons();
    }

    var ctrlPressed = false;
    \$(window).keydown(function (evt) {
        if (evt.which == 17) {
            ctrlPressed = true;
        }
    }).keyup(function (evt) {
        if (evt.which == 17) {
            ctrlPressed = false;
        }
    });

    \$(window).keydown(function (evt) {
        if (evt.which == 65) {
            if (ctrlPressed == true)
            {
                selectAllFiles();
                return false;
            }
        }
    })

    function updateFileActionButtons()
    {
        totalSelected = countSelected();
        if (totalSelected > 0)
        {
            \$('.fileActionLinks').removeClass('disabled');

        }
        else
        {
            \$('.fileActionLinks').addClass('disabled');
        }
    }

    function viewFileLinks()
    {
        count = countSelected();
        if (count > 0)
        {
            fileUrlText = '';
            htmlUrlText = '';
            bbCodeUrlText = '';
            for (i in selectedFiles)
            {
                fileUrlText += selectedFiles[i][3] + \"<br/>\";
                htmlUrlText += selectedFiles[i][4] + \"&lt;br/&gt;<br/>\";
                bbCodeUrlText += '[URL='+selectedFiles[i][3]+']'+selectedFiles[i][3] + \"[/URL]<br/>\";
            }

            \$('#popupContentUrls').html(fileUrlText);
            \$('#popupContentHTMLCode').html(htmlUrlText);
            \$('#popupContentBBCode').html(bbCodeUrlText);

            jQuery('#fileLinksModal').modal('show', {backdrop: 'static'}).on('shown.bs.modal');
        }
    }

    function showLightboxNotice()
    {
        jQuery('#generalModal').modal('show', {backdrop: 'static'}).on('shown.bs.modal', function () {
            \$('.general-modal .modal-body').html(\$('#filePopupContentWrapperNotice').html());
        });
    }

    function showFileInformation(fileId)
    {
        // hide any context menus
        hideOpenContextMenus();

        // load overlay
        showFileInline(fileId);
    }

    function loadPage(startPos)
    {
        cancelPendingNetworkRequests();
        \$('html, body').animate({
            scrollTop: \$(\".page-body\").offset().top
        }, 700);
        pageStart = startPos;
        refreshFileListing();
    }

    function downloadAllFilesFromFolder(folderId)
    {
        // only allow actual sub folders
        if (isPositiveInteger(folderId) == false)
        {
            return false;
        }

        if (confirm(\"";
        // line 928
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("account_home_are_you_sure_download_all_files", "Are you sure you want to download all the files in this folder? This may take some time to complete."), "html", null, true);
        echo "\"))
        {
            downloadAllFilesFromFolderConfirm(folderId);
        }

        return false;
    }

    function downloadAllFilesFromFolderConfirm(folderId)
    {
        \$('.download-folder-modal .modal-body .col-md-9').html('');
        jQuery('#downloadFolderModal').modal('show', {backdrop: 'static'}).on('shown.bs.modal', function () {
            \$('.download-folder-modal .modal-body .col-md-9').html('<iframe src=\"";
        // line 940
        echo twig_escape_filter($this->env, ($context["ACCOUNT_WEB_ROOT"] ?? null), "html", null, true);
        echo "/ajax/download_all_as_zip/' + folderId + '\" style=\"zoom:0.60\" width=\"99.6%\" height=\"730\" frameborder=\"0\"></iframe>');
        });
    }
\t
    function downloadAllFilesFromFolderShared(folderId)
    {
        if(typeof(folderId) === 'undefined') {
            folderId = 0;
        }
        
        msg = \"";
        // line 950
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("account_home_are_you_sure_download_all_files_in_share", "Are you sure you want to download all the files in this share? This may take some time to complete."), "html", null, true);
        echo "\";
        if(folderId > 0) {
            msg = \"";
        // line 952
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("account_home_are_you_sure_download_all_files_in_folder", "Are you sure you want to download all the files in this folder? This may take some time to complete."), "html", null, true);
        echo "\";
        }
        if (confirm(msg))
        {
            downloadAllFilesFromFolderSharedConfirm(folderId);
        }

        return false;
    }
\t
    function downloadAllFilesFromFolderSharedConfirm(folderId)
    {
        \$('.download-folder-modal .modal-body .col-md-9').html('');
        jQuery('#downloadFolderModal').modal('show', {backdrop: 'static'}).on('shown.bs.modal', function () {
            \$('.download-folder-modal .modal-body .col-md-9').html('<iframe src=\"";
        // line 966
        echo twig_escape_filter($this->env, ($context["WEB_ROOT"] ?? null), "html", null, true);
        echo "/ajax/non_account_download_all_as_zip?folderId='+folderId+'\" style=\"zoom:0.60\" width=\"99.6%\" height=\"440\" frameborder=\"0\"></iframe>');
        });
    }
</script>


<script>
    function showAddFolderForm(parentId, editFolderId)
    {
        // only allow actual sub folders on edit
        if ((typeof (editFolderId) != 'undefined') && (isPositiveInteger(editFolderId) == false))
        {
            return false;
        }

        showLoaderModal();
        if (typeof (parentId) == 'undefined')
        {
            parentId = \$('#nodeId').val();
        }

        if (typeof (editFolderId) == 'undefined')
        {
            editFolderId = 0;
        }

        jQuery('#addEditFolderModal .modal-content').load(\"";
        // line 992
        echo twig_escape_filter($this->env, ($context["ACCOUNT_WEB_ROOT"] ?? null), "html", null, true);
        echo "/ajax/add_edit_folder\", {parentId: parentId, editFolderId: editFolderId}, function () {
            hideLoaderModal();
            jQuery('#addEditFolderModal').modal('show', {backdrop: 'static'}).on('shown.bs.modal', function () {
                assignModalEnterKey();
                \$('#addEditFolderModal input').first().focus();
            });
        });
    }

    var folderArray = ";
        // line 1001
        echo json_encode(($context["folderListingArr"] ?? null));
        echo ";
    function markInternalNotificationsRead()
    {
        \$.ajax({
            dataType: \"json\",
            url: \"";
        // line 1006
        echo twig_escape_filter($this->env, ($context["ACCOUNT_WEB_ROOT"] ?? null), "html", null, true);
        echo "/ajax/internal_notification_mark_all_read\",
            success: function (data) {
                \$('.internal-notification .unread').addClass('read').removeClass('unread');
                \$('.internal-notification .text-bold').removeClass('text-bold');
                \$('.internal-notification .badge').hide();
                \$('.internal-notification .unread-count').html('You have 0 new notifications.');
                \$('.internal-notification .mark-read-link').hide();
            }
        });
    }

    progressWidget = null;
    function showProgressWidget(intialText, title, complete, timeout)
    {
\t\tif(typeof(timeout) == \"undefined\")
\t\t{
\t\t\ttimeout = 0;
\t\t}
\t\t
        if (progressWidget != null)
        {
            progressWidget.hide();
        }

        var opts = {
            \"closeButton\": false,
            \"debug\": false,
            \"positionClass\": \"toast-bottom-right\",
            \"onclick\": null,
            \"showDuration\": \"300\",
            \"hideDuration\": \"1000\",
            \"timeOut\": timeout,
            \"extendedTimeOut\": \"0\",
            \"showEasing\": \"swing\",
            \"hideEasing\": \"linear\",
            \"showMethod\": \"fadeIn\",
            \"hideMethod\": \"fadeOut\",
            \"onclick\": function () {
                showUploaderPopup();
            }
        };

        if (complete == true)
        {
            progressWidget = toastr.success(intialText, title, opts);
        }
        else
        {
            progressWidget = toastr.info(intialText, title, opts);
        }
    }

    function updateProgressWidgetText(text)
    {
        if (progressWidget == null)
        {
            return false;
        }

        \$(progressWidget).find('.toast-message').html(text);
    }

    function checkShowUploadProgressWidget()
    {
        if (uploadComplete == false)
        {
            showProgressWidget(";
        // line 1072
        echo json_encode($this->extensions['App\Services\TTwigExtension']->tHandler("file_manager_uploading", "Uploading..."));
        echo ", ";
        echo json_encode($this->extensions['App\Services\TTwigExtension']->tHandler("file_manager_upload_progress", "Upload Progress:"));
        echo ", false);
        }
    }

    function checkShowUploadFinishedWidget()
    {
        showProgressWidget(";
        // line 1078
        echo json_encode($this->extensions['App\Services\TTwigExtension']->tHandler("file_manager_upload_complete", "Upload complete."));
        echo ", ";
        echo json_encode($this->extensions['App\Services\TTwigExtension']->tHandler("file_manager_upload_progress", "Upload Progress:"));
        echo ", true, 6000);
    }

    function updateStatsViaAjax()
    {
        // first request stats via ajax
        \$.ajax({
            type: \"POST\",
            dataType: \"json\",
            url: \"";
        // line 1087
        echo twig_escape_filter($this->env, ($context["ACCOUNT_WEB_ROOT"] ?? null), "html", null, true);
        echo "/ajax/get_account_file_stats\",
            success: function (data) {
                updateOnScreenStats(data);
            }
        });
    }

    function updateOnScreenStats(data)
    {
        // update list of folders for breadcrumbs
        folderArray = jQuery.parseJSON(data.folderArray);

        // update folder drop-down list in the popup uploader
        \$(\"#folder_id\").html(data.folderSelectForUploader);

        // update root folder stats
        if (data.totalRootFiles > 0)
        {
            \$(\"#folderTreeview\").jstree('set_text', '#-1', \$('#-1').attr('original-text') + ' (' + data.totalRootFiles + ')');
        }
        else
        {
            \$(\"#folderTreeview\").jstree('set_text', '#-1', \$('#-1').attr('original-text'));
        }

        // update trash folder stats
        if (data.totalTrashFiles > 0)
        {
            \$(\"#folderTreeview\").jstree('set_text', '#trash', \$('#trash').attr('original-text') + ' (' + data.totalTrashFiles + ')');
        }
        else
        {
            \$(\"#folderTreeview\").jstree('set_text', '#trash', \$('#trash').attr('original-text'));
        }
        
        // update trash folder stats
        if (data.totalShareWithMeFiles > 0)
        {
            \$(\"#folderTreeview\").jstree('set_text', '#shared', \$('#shared').attr('original-text') + ' (' + data.totalShareWithMeFiles + ')');
        }
        else
        {
            \$(\"#folderTreeview\").jstree('set_text', '#shared', \$('#shared').attr('original-text'));
        }

        // update all folder stats
        \$(\"#folderTreeview\").jstree('set_text', '#all', \$('#all').attr('original-text') + ' (' + data.totalActiveFiles + ')');

        // update total storage stats
        \$(\".remaining-storage .progress .progress-bar\").attr('aria-valuenow', data.totalStoragePercentage);
        \$(\".remaining-storage .progress .progress-bar\").width(data.totalStoragePercentage + '%');
        \$(\"#totalActiveFileSize\").html(data.totalActiveFileSizeFormatted);
    }

    function isDesktopUser()
    {
        if ((getBrowserWidth() <= 1024) && (getBrowserWidth() > 0))
        {
            return false;
        }

        return true;
    }

    function getBrowserWidth()
    {
        return \$(window).width();
    }

    function duplicateFiles()
    {
        if (countSelected() > 0)
        {
            duplicateFilesConfirm();
        }

        return false;
    }

    function duplicateFilesConfirm()
    {
        // show loader
        showLoaderModal(0);

        // prepare file ids
        fileIds = [];
        for (i in selectedFiles)
        {
            fileIds.push(i.replace('k', ''));
        }

        // duplicate files
        \$.ajax({
            type: \"POST\",
            url: \"";
        // line 1181
        echo twig_escape_filter($this->env, ($context["ACCOUNT_WEB_ROOT"] ?? null), "html", null, true);
        echo "/ajax/duplicate_file\",
            data: {fileIds: fileIds},
            dataType: 'json',
            success: function (json) {
                if (json.error == true)
                {
                    // hide loader
                    hideLoaderModal();
                    \$('#filePopupContentNotice').html(json.msg);
                    showLightboxNotice();
                }
                else
                {
                    // done
                    addBulkSuccess(json.msg);
                    finishBulkProcess();
                }

            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                \$('#popupContentNotice').html('Failed connecting to server, please try again later.');
                showLightboxNotice();
            }
        });
    }
</script>

<script type=\"text/javascript\">
    function showFileInline(fileId)
    {
        showFile(fileId);
    }

    function showImageBrowseSlide(folderId)
    {
        \$('#imageBrowseWrapper').show();
        \$('#albumBrowseWrapper').hide();
        loadFiles(folderId);
    }

    function handleTopSearch(event, ele, isAdvSearch)
    {
\t\t// make sure we have a default setting for advance search
\t\tif(typeof(isAdvSearch) == 'undefined')
\t\t{
\t\t\tisAdvSearch = false;
\t\t}
\t\t
\t\tsearchText = \$(ele).val();
        \$('#filterText').val(searchText);

        // check for enter key
\t\tdoSearch = false;
\t\tif(event == null)
\t\t{
\t\t\tdoSearch = true;
\t\t}
\t\telse
\t\t{
\t\t\tvar charCode = (typeof event.which === \"number\") ? event.which : event.keyCode;
\t\t\tif (charCode == 13)
\t\t\t{
\t\t\t\tdoSearch = true;
\t\t\t}
\t\t}
\t\t
\t\t// do search
\t\tif(doSearch == true)
\t\t{
\t\t\t// make sure we have something to search
\t\t\tif(searchText.length == 0)
\t\t\t{
\t\t\t\tshowErrorNotification('Error', 'Please enter something to search for.');
\t\t\t\treturn false;
\t\t\t}
\t\t\t
\t\t\tfilterAllFolders = false;
\t\t\tfilterUploadedDateRange = '';
\t\t\tif(isAdvSearch == true)
\t\t\t{
\t\t\t\tif(\$('#filterAllFolders').is(':checked'))
\t\t\t\t{
\t\t\t\t\tfilterAllFolders = true;
\t\t\t\t}
\t\t\t\tfilterUploadedDateRange = \$('#filterUploadedDateRange').val();
\t\t\t}
\t\t\t
\t\t\turl = '";
        // line 1268
        echo twig_escape_filter($this->env, ($context["ACCOUNT_WEB_ROOT"] ?? null), "html", null, true);
        echo "/search/?filterAllFolders='+filterAllFolders+'&filterUploadedDateRange='+filterUploadedDateRange+'&t='+encodeURIComponent(searchText);
\t\t\twindow.location = url;
\t\t}

        return false;
    }
\t
    function showSharingForm(folderId)
    {
        // if we have the folderId as a param, assume we just want to share this
        if(typeof(folderId) !== \"undefined\") {
            fileIds = [];
            folderIds = [];
            folderIds.push(folderId);
        }
        else {
            // prepare item ids
            fileIds = getAllSelectedFileIds();
            folderIds = getAllSelectedFolderIds();
        }
        
        showLoaderModal();
        jQuery('#shareFolderModal .modal-content').load(\"";
        // line 1290
        echo twig_escape_filter($this->env, ($context["ACCOUNT_WEB_ROOT"] ?? null), "html", null, true);
        echo "/ajax/share_file_folder\", {fileIds: fileIds, folderIds: folderIds}, function () {
            hideLoaderModal();
            jQuery('#shareFolderModal').modal('show', {backdrop: 'static'});
            createdUrl = false;
            setupPostPopup();
        });
    }
\t
\tfunction setupPostPopup()
\t{
            // hover over tooptips
            setupToolTips();

            // radios
            replaceCheckboxes();

            // block enter key from being pressed
            \$('#registeredEmailAddress').keypress(function (e) {
                    if (e.which == 13)
                    {
                            return false;
                    }
            });
\t}
\t
\tfunction shareFolderInternally(fileIds, folderIds)
\t{
            setShareFolderButtonLoading();
            \$.ajax({
                dataType: \"json\",
                method: \"post\",
                url: \"";
        // line 1321
        echo twig_escape_filter($this->env, ($context["ACCOUNT_WEB_ROOT"] ?? null), "html", null, true);
        echo "/ajax/share_file_folder_internally\",
                data: {fileIds: fileIds, folderIds: folderIds, registeredEmailAddress: \$('#registeredEmailAddress').val(), permissionType: \$('input[name=permission_radio]:checked').val()},
                success: function (data) {
                    if (data.error == true)
                    {
                        showErrorNotification('Error', data.msg);
                        clearShareFolderButtonLoading();
                    }
                    else
                    {
                        \$('#registeredEmailAddress').val('');
                        loadExistingInternalShareTable(fileIds, folderIds);
                        clearShareFolderButtonLoading();
                        showSuccessNotification('Success', data.msg);
                    }
                }
            });
\t}
\t
\tfunction loadExistingInternalShareTable(fileIds, folderIds)
\t{
            \$('#existingInternalShareTable').load(\"";
        // line 1342
        echo twig_escape_filter($this->env, ($context["ACCOUNT_WEB_ROOT"] ?? null), "html", null, true);
        echo "/ajax/share_file_folder_internally_existing\", {fileIds: fileIds, folderIds: folderIds}).hide().fadeIn();
\t}
\t
\tfunction shareFolderInternallyRemove(folderShareId, fileIds, folderIds)
\t{
            \$.ajax({
                dataType: \"json\",
                url: \"";
        // line 1349
        echo twig_escape_filter($this->env, ($context["ACCOUNT_WEB_ROOT"] ?? null), "html", null, true);
        echo "/ajax/share_file_folder_internally_remove\",
                data: {folderShareId: folderShareId},
                success: function (data) {
                    if (data.error == true)
                    {
                        showErrorNotification('Error', data.msg);
                    }
                    else
                    {
                        loadExistingInternalShareTable(fileIds, folderIds);
                        showSuccessNotification('Success', data.msg);
                    }
                }
            });
\t}
\t
\tfunction setShareFolderButtonLoading()
\t{
            \$('#shareFolderInternallyBtn').removeClass('btn-info');
            \$('#shareFolderInternallyBtn').addClass('btn-default disabled');
            \$('#shareFolderInternallyBtn').html(\"";
        // line 1369
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("processing", "processing")), "html", null, true);
        echo " <i class=\\\"entypo-arrows-cw\\\"></i>\");
\t}
\t
\tfunction clearShareFolderButtonLoading()
\t{
            \$('#shareFolderInternallyBtn').removeClass('btn-default disabled');
            \$('#shareFolderInternallyBtn').addClass('btn-info');
            \$('#shareFolderInternallyBtn').html(\"";
        // line 1376
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("grant_access", "grant access")), "html", null, true);
        echo " <i class=\\\"entypo-lock\\\"></i>\");
\t}
\t
\tfunction copyToClipboard(ele)
\t{
            destroyClipboard();
            clipboard = new Clipboard(ele);
            clipboard.on('success', function(e) {
                showSuccessNotification('Success', 'Copied to clipboard.');
                \$('#clipboard-placeholder').html('');
            });

            clipboard.on('error', function(e) {
                showErrorNotification('Error', 'Failed copying to clipboard.');
            });
\t}
\t
\tfunction destroyClipboard()
\t{
            if(clipboard != null)
            {
                clipboard.destroy();
            }
\t}
\t
\tcallbackcheck = false;
\tfunction showStatsPopup(fileId)
        {
            showLoaderModal();
            jQuery('#statsModal .modal-content').load(\"";
        // line 1405
        echo twig_escape_filter($this->env, ($context["ACCOUNT_WEB_ROOT"] ?? null), "html", null, true);
        echo "/ajax/file_stats\", {fileId: fileId}, function () {
                hideLoaderModal();
                jQuery('#statsModal').modal('show', {backdrop: 'static'}).on('show', function() {
                    callbackcheck = setTimeout(function(){
                        redrawCharts();
                        clearTimeout(callbackcheck);
                    }, 100);
                });
            });
        }
\t
\tvar createdUrl = false;
\tfunction generateFolderSharingUrl(fileIds, folderIds)
\t{
            \$.ajax({
                dataType: \"json\",
                method: \"post\",
                url: \"";
        // line 1422
        echo twig_escape_filter($this->env, ($context["ACCOUNT_WEB_ROOT"] ?? null), "html", null, true);
        echo "/ajax/generate_folder_sharing_url\",
                data: {fileIds: fileIds, folderIds: folderIds},
                success: function (data) {
                    if (data.error == true)
                    {
                        showErrorNotification('Error', data.msg);
                    }
                    else
                    {
                        \$('#sharingUrlInput').html(data.msg);
                        \$('#shareEmailSharingUrl').html(data.msg);
                        \$('#nonPublicSharingUrls').fadeIn();
                        \$('#nonPublicSharingUrls').html(\$('.social-wrapper-template').html().replace(/SHARE_LINK/g, data.msg));
                        \$('#nonPublicSharingUrls').removeClass('disabled');
                        createdUrl = true;
                    }
                }
            });
\t}
        
        function checkSocialLink(ele) {
            // alert if link has not been generated
            if(\$(ele).attr('href').indexOf('SHARE_LINK') !== -1) {
                showErrorNotification(";
        // line 1445
        echo json_encode($this->extensions['App\Services\TTwigExtension']->tHandler("sharing_please_generate_link_before_social_sharing", "Please generate the sharing url to enable social sharing."));
        echo ");
                return false;
            }

            return true;
        }
        
        function togglePublicAccessUrl() {
            if(\$('#isPublic').val() === '1') {
                \$('.public-access-url').show();
            }
            else {
                \$('.public-access-url').hide();
            }
        }
</script>";
    }

    public function getTemplateName()
    {
        return "account/partial/account_home_javascript.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  1734 => 1445,  1708 => 1422,  1688 => 1405,  1656 => 1376,  1646 => 1369,  1623 => 1349,  1613 => 1342,  1589 => 1321,  1555 => 1290,  1530 => 1268,  1440 => 1181,  1343 => 1087,  1329 => 1078,  1318 => 1072,  1249 => 1006,  1241 => 1001,  1229 => 992,  1200 => 966,  1183 => 952,  1178 => 950,  1165 => 940,  1150 => 928,  967 => 748,  955 => 739,  945 => 732,  930 => 720,  917 => 710,  906 => 702,  895 => 694,  885 => 687,  875 => 680,  864 => 672,  833 => 644,  816 => 630,  805 => 622,  785 => 605,  772 => 595,  760 => 586,  749 => 578,  736 => 568,  728 => 563,  722 => 560,  711 => 552,  681 => 525,  669 => 516,  659 => 509,  649 => 502,  593 => 449,  578 => 437,  538 => 400,  507 => 372,  492 => 360,  478 => 349,  468 => 342,  458 => 335,  443 => 323,  428 => 311,  416 => 302,  403 => 292,  388 => 280,  269 => 163,  173 => 70,  165 => 65,  153 => 56,  144 => 55,  138 => 52,  129 => 51,  123 => 48,  119 => 47,  113 => 44,  104 => 43,  98 => 40,  88 => 38,  72 => 24,  70 => 23,  67 => 22,  60 => 19,  58 => 18,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "account/partial/account_home_javascript.html.twig", "/var/www/html/medicalimage/themes/evolution/views/account/partial/account_home_javascript.html.twig");
    }
}
