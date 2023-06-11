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

/* admin/file_manage.html.twig */
class __TwigTemplate_03c11c0cf94efe5aacc565d042535534c42dcb06313c7b85c3478a1880bf5c6e extends \Twig\Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'title' => [$this, 'block_title'],
            'selected_page' => [$this, 'block_selected_page'],
            'selected_sub_page' => [$this, 'block_selected_sub_page'],
            'body' => [$this, 'block_body'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return "admin/partial/layout_logged_in.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $this->parent = $this->loadTemplate("admin/partial/layout_logged_in.html.twig", "admin/file_manage.html.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo "Manage Files";
    }

    // line 4
    public function block_selected_page($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo "files";
    }

    // line 5
    public function block_selected_sub_page($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo "file_manage";
    }

    // line 7
    public function block_body($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 8
        echo "    <script>
        oTable = null;
        gFileId = null;
        gEditFileId = null;
        oldStart = 0;
        \$(document).ready(function () {
            // datatable
            oTable = \$('#fileTable').dataTable({
                \"sPaginationType\": \"full_numbers\",
                \"bServerSide\": true,
                \"bProcessing\": true,
                \"sAjaxSource\": 'ajax/file_manage',
                \"deferRender\": true,
                \"iDisplayLength\": 25,
                \"aaSorting\": [[2, \"desc\"]],
                \"aoColumns\": [
                    {bSortable: false, sWidth: '3%', sName: 'file_icon', sClass: \"center adminResponsiveHide\"},
                    {sName: 'filename'},
                    {sName: 'date_uploaded', sWidth: '12%', sClass: \"center adminResponsiveHide\"},
                    {sName: 'filesize', sWidth: '10%', sClass: \"center adminResponsiveHide\"},
                    {sName: 'downloads', sWidth: '10%', sClass: \"center adminResponsiveHide\"},
                    {sName: 'owner', sWidth: '11%', sClass: \"center adminResponsiveHide\"},
                    {sName: 'status', sWidth: '11%', sClass: \"center adminResponsiveHide\"},
                    {bSortable: false, sWidth: '14%', sClass: \"center removeMultiFilesButton\"}
                ],
                \"fnServerData\": function (sSource, aoData, fnCallback, oSettings) {
                    setTableLoading();
                    if (oSettings._iDisplayStart != oldStart) {
                        var targetOffset = \$('.dataTables_wrapper').offset().top - 10;
                        \$('html, body').animate({scrollTop: targetOffset}, 300);
                        oldStart = oSettings._iDisplayStart;
                    }
                    aoData.push({\"name\": \"filterText\", \"value\": \$('#filterText').val()});
                    aoData.push({\"name\": \"filterByUser\", \"value\": \$('#filterByUser').val()});
                    aoData.push({\"name\": \"filterByServer\", \"value\": \$('#filterByServer').val()});
                    aoData.push({\"name\": \"filterByStatus\", \"value\": \$('#filterByStatus').val()});
                    aoData.push({\"name\": \"filterBySource\", \"value\": \$('#filterBySource').val()});
                    aoData.push({\"name\": \"filterView\", \"value\": \$('#filterView').val()});
                    \$.ajax({
                        \"dataType\": 'json',
                        \"type\": \"GET\",
                        \"url\": sSource,
                        \"data\": aoData,
                        \"success\": fnCallback
                    });
                },
                \"fnDrawCallback\": function (oSettings) {
                    postDatatableRender();
                },
                \"oLanguage\": {
                    \"sEmptyTable\": \"There are no files in the current filters.\"
                },
                dom: \"lBfrtip\",
                buttons: [
                    {
                        extend: \"copy\",
                        className: \"btn-sm\"
                    },
                    {
                        extend: \"csv\",
                        className: \"btn-sm\"
                    },
                    {
                        extend: \"excel\",
                        className: \"btn-sm\"
                    },
                    {
                        extend: \"pdfHtml5\",
                        className: \"btn-sm\"
                    },
                    {
                        extend: \"print\",
                        className: \"btn-sm\"
                    }
                ]
            });

            // update custom filter
            \$('.dataTables_filter').html(\$('#customFilter').html());

            \$('#filterByUser').typeahead({
                source: function (request, response) {
                    \$.ajax({
                        url: 'ajax/file_manage_auto_complete',
                        dataType: \"json\",
                        data: {
                            filterByUser: \$(\"#filterByUser\").val()
                        },
                        success: function (data) {
                            response(data);
                        }
                    });
                },
                minLength: 3,
                delay: 1,
                afterSelect: function () {
                    reloadTable();
                }
            });
        });

        function bulkMoveFiles()
        {
            if (countChecked() == 0)
            {
                alert('Please select some files to move.');
                return false;
            }

            // show popup
            loadMoveFileForm();
            \$('#moveFilesForm').modal('show');
        }

        function loadMoveFileForm()
        {
            \$('#moveFilesForm .modal-body').html('');
            \$.ajax({
                type: \"POST\",
                url: \"ajax/file_manage_move_form\",
                dataType: 'json',
                success: function (json) {
                    if (json.error == true)
                    {
                        \$('#moveFilesForm .modal-body').html(json.msg);
                    } else
                    {
                        \$('#moveFilesForm .modal-body').html(json.html);
                    }

                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    \$('#moveFilesForm .modal-body').html(XMLHttpRequest.responseText);
                }
            });
        }

        function processMoveFileForm()
        {
            // get data
            serverIds = \$('#server_ids').val();
            \$.ajax({
                type: \"POST\",
                url: \"ajax/file_manage_move_process\",
                data: {serverIds: serverIds, gFileIds: getCheckboxFiles()},
                dataType: 'json',
                success: function (json) {
                    if (json.error == true)
                    {
                        showError(json.msg, 'popupMessageContainer');
                    } else
                    {
                        showSuccess(json.msg);
                        reloadTable();
                        clearBulkResponses();
                        checkboxIds = {};
                        updateButtonText();
                        \$(\"#moveFilesForm\").modal('hide');
                    }

                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    showError(XMLHttpRequest.responseText, 'popupMessageContainer');
                }
            });

        }

        function reloadTable()
        {
            oTable.fnDraw(false);
        }

        function confirmRemoveFile(fileId)
        {
            showModal(\$('#confirmDelete .modal-body'), \$('#confirmDelete .modal-footer'));
            gFileId = fileId;
        }

        function processRemoveFile()
        {
            removeFile(function () {
                hideModal();
            });
        }

        function showNotes(notes)
        {
            showBasicModal('<p>' + notes + '</p>', 'File Notes');
        }

        function removeFile(callback)
        {
            // find out file server first
            \$.ajax({
                type: \"POST\",
                url: \"ajax/update_file_state\",
                data: {fileId: gFileId, statusId: \$('#genericModalContainer #removal_type').val(), adminNotes: \$('#genericModalContainer #admin_notes').val(), blockUploads: \$('#genericModalContainer #block_uploads').val()},
                dataType: 'json',
                success: function (json) {
                    if (json.error == true)
                    {
                        showError(json.msg);
                    } else
                    {
                        showSuccess(json.msg);
                        \$('#removal_type').val(3);
                        \$('#admin_notes').val('');
                        reloadTable();
                        callback();
                    }

                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    showError(XMLHttpRequest.responseText);
                }
            });
        }

        function setupActionButtons()
        {
            updateButtonText();
        }

        function updateButtonText()
        {
            totalFiles = countChecked();
            \$('#actionMultiMenu li').removeClass('disabled');
            if (totalFiles == 0)
            {
                totalFilesStr = '';
                \$('#actionMultiMenu li').addClass('disabled');
                \$('#actionMultiMenuBase').addClass('btn-default');
                \$('#actionMultiMenuBase').removeClass('btn-primary');
            } else
            {
                totalFilesStr = ' (' + totalFiles + ' File';
                if (totalFiles > 1)
                {
                    totalFilesStr += 's';
                }
                totalFilesStr += ')';
                \$('#actionMultiMenuBase').removeClass('btn-default');
                \$('#actionMultiMenuBase').addClass('btn-primary');
            }

            \$('#actionMultiMenuBase .fileCount').html(totalFilesStr);
        }

        function getCheckboxFiles()
        {
            count = 0;
            for (i in checkboxIds)
            {
                count++;
            }

            return checkboxIds;
        }

        function bulkDeleteFiles(deleteData)
        {
            if (typeof (deleteData) == 'undefined')
            {
                deleteData = false;
            }

            if (countChecked() == 0)
            {
                alert('Please select some files to remove.');
                return false;
            }

            msg = 'Are you sure you want to remove ' + countChecked() + ' files? This can not be undone once confirmed.';
            if (deleteData == true)
            {
                msg += '\\n\\nAll file data and associated data such as the stats, will also be deleted from the database. This will entirely clear any record of the upload. (exc logs)';
            } else
            {
                msg += '\\n\\nThe original file record will be retained along with the file stats.';
            }

            if (confirm(msg))
            {
                bulkDeleteConfirm(deleteData);
            }
        }

        var bulkError = '';
        var bulkSuccess = '';
        var totalDone = 0;
        function addBulkError(x)
        {
            bulkError += x;
        }
        function getBulkError(x)
        {
            return bulkError;
        }
        function addBulkSuccess(x)
        {
            bulkSuccess += x;
        }
        function getBulkSuccess(x)
        {
            return bulkSuccess;
        }
        function clearBulkResponses()
        {
            bulkError = '';
            bulkSuccess = '';
        }
        function bulkDeleteConfirm(deleteData)
        {
            // get server list first
            \$.ajax({
                type: \"POST\",
                url: \"ajax/file_manage_bulk_delete\",
                data: {fileIds: checkboxIds, deleteData: deleteData},
                dataType: 'json',
                success: function (json) {
                    if (json.error == true)
                    {
                        showError(json.msg);
                    } else
                    {
                        addBulkSuccess(json.msg);
                        finishBulkProcess();
                    }

                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    showError('Failed connecting to server to get the list of servers, please try again later.');
                }
            });
        }

        function finishBulkProcess()
        {
            // get final response
            bulkError = getBulkError();
            bulkSuccess = getBulkSuccess();

            // compile result
            if (bulkError.length > 0)
            {
                showError(bulkError + bulkSuccess);
            } else
            {
                showSuccess(bulkSuccess);
            }
            reloadTable();
            clearBulkResponses();
            checkboxIds = {};
            updateButtonText();

            // scroll to the top of the page
            \$(\"html, body\").animate({scrollTop: 0}, \"slow\");
            \$('#selectAllCB').prop('checked', false);
        }

        function editFile(fileId)
        {
            gEditFileId = fileId;
            loadEditFileForm();
            \$('#editFileForm').modal('show');
        }

        function loadEditFileForm()
        {
            \$('#editFileFormInner').html('Loading...');
            \$.ajax({
                type: \"POST\",
                url: \"ajax/file_manage_edit_form\",
                data: {gEditFileId: gEditFileId},
                dataType: 'json',
                success: function (json) {
                    if (json.error == true)
                    {
                        \$('#editFileFormInner').html(json.msg);
                    } else
                    {
                        \$('#editFileFormInner').html(json.html);
                        setupTagInterface();
                        toggleFilePasswordField();
                    }

                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    \$('#editFileFormInner').html(textStatus + ': ' + errorThrown);
                }
            });
        }

        function toggleFilePasswordField()
        {
            if (\$('#editFileForm #enablePassword').is(':checked'))
            {
                \$('#editFileForm #password').attr('READONLY', false);
            } else
            {
                \$('#editFileForm #password').attr('READONLY', true);
            }
        }

        function processEditFile()
        {
            \$.ajax({
                type: \"POST\",
                url: \"ajax/file_manage_edit_process\",
                data: \$('form#editFileFormInner').serialize(),
                dataType: 'json',
                success: function (json) {
                    if (json.error == true)
                    {
                        showError(json.msg, 'popupMessageContainer');
                    } else
                    {
                        showSuccess(json.msg);
                        reloadTable();
                        \$(\"#editFileForm\").modal('hide');
                    }

                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    showError(textStatus + ': ' + errorThrown, 'popupMessageContainer');
                }
            });

        }

        function updateSelectedRemoveFileSelect()
        {
            if (\$('#removal_type').val() == '4')
            {
                \$('#block_uploads').val('1');
            } else
            {
                \$('#block_uploads').val('0');
            }
        }
    </script>

    <!-- page content -->
    <div class=\"right_col\" role=\"main\">
        <div class=\"\">
            <div class=\"page-title\">
                <div class=\"title_left\">
                    <h3>";
        // line 456
        $this->displayBlock("title", $context, $blocks);
        echo "</h3>
                </div>
            </div>
            <div class=\"clearfix\"></div>

            ";
        // line 461
        echo ($context["msg_page_notifications"] ?? null);
        echo "

            <div class=\"row\">
                <div class=\"col-md-12 col-sm-12 col-xs-12\">
                    <div class=\"x_panel\">
                        <div class=\"x_title\">
                            <h2>File List</h2>
                            <div class=\"clearfix\"></div>
                        </div>
                        <div class=\"x_content\">
                            <table id=\"fileTable\" class=\"table table-striped table-only-border dtLoading bulk_action\">
                                <thead>
                                    <tr>
                                        <th><input type=\"checkbox\" id=\"check-all\" class=\"flat\"/></th>
                                        <th class=\"align-left fileManageFileName\">";
        // line 475
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("filename", "Filename")), "html", null, true);
        echo "</th>
                                        <th class=\"align-left\">";
        // line 476
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("date_uploaded", "Date Uploaded")), "html", null, true);
        echo "</th>
                                        <th >";
        // line 477
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("filesize", "Filesize")), "html", null, true);
        echo "</th>
                                        <th>";
        // line 478
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("downloads", "Downloads")), "html", null, true);
        echo "</th>
                                        <th>";
        // line 479
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("owner", "Owner")), "html", null, true);
        echo "</th>
                                        <th>";
        // line 480
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("status", "Status")), "html", null, true);
        echo "</th>
                                        <th class=\"align-left fileManageActions\">";
        // line 481
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("actions", "Actions")), "html", null, true);
        echo "</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan=\"20\">";
        // line 486
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("admin_loading_data", "Loading data...")), "html", null, true);
        echo "</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class=\"x_panel\">
                        <div class=\"btn-group\">
                            <div class=\"dropup\">
                                <button class=\"btn btn-default dropdown-toggle\" type=\"button\" id=\"actionMultiMenuBase\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"true\">
                                    Bulk Action<span class=\"fileCount\"></span>
                                    <span class=\"caret\"></span>
                                </button>
                                <ul class=\"dropdown-menu\" aria-labelledby=\"actionMultiMenuBase\" id=\"actionMultiMenu\">
                                    <li class=\"disabled\"><a href=\"#\" onClick=\"bulkDeleteFiles(false); return false;\">";
        // line 501
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("remove_files_total", "Remove Files[[[FILE_COUNT]]]", ["FILE_COUNT" => ""])), "html", null, true);
        echo "</a></li>
                                    <li class=\"disabled\"><a href=\"#\" onClick=\"bulkDeleteFiles(true);
                                        return false;\">";
        // line 503
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("delete_files_and_data_total", "Delete Files And Stats Data[[[FILE_COUNT]]]", ["FILE_COUNT" => ""])), "html", null, true);
        echo "</a></li>
                                    <li class=\"disabled\"><a href=\"#\" onClick=\"bulkMoveFiles();
                                        return false;\">";
        // line 505
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("move_files_total", "Move Files[[[FILE_COUNT]]]", ["FILE_COUNT" => ""])), "html", null, true);
        echo "</a></li>
                                </ul>
                            </div>
                        </div>
                        ";
        // line 509
        if (twig_get_attribute($this->env, $this->source, ($context["Auth"] ?? null), "hasAccessLevel", [0 => 20], "method", false, false, false, 509)) {
            // line 510
            echo "                            <div class=\"btn-group\">
                                <a href=\"export_csv?type=files\" type=\"button\" class=\"btn btn-default\">Export All Data (CSV)</a>
                            </div>
                        ";
        }
        // line 514
        echo "                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class=\"customFilter\" id=\"customFilter\" style=\"display: none;\">
        <label>
            Filter:
            <input name=\"filterText\" id=\"filterText\" type=\"text\" value=\"";
        // line 524
        echo twig_escape_filter($this->env, ($context["filterText"] ?? null), "html", null, true);
        echo "\" onKeyUp=\"reloadTable();
                return false;\" style=\"width: 180px;\" class=\"form-control input-sm\"/>
        </label>
        <label id=\"username\" style=\"padding-left: 6px;\">
            User:
            <input name=\"filterByUser\" id=\"filterByUser\" type=\"text\" class=\"filterByUser form-control input-sm txt-auto\" style=\"width: 120px;\" value=\"";
        // line 529
        echo twig_escape_filter($this->env, ($context["filterByUserLabel"] ?? null), "html", null, true);
        echo "\" autocomplete=\"off\"/>
        </label>
        <label class=\"adminResponsiveHide filterByServerWrapper\" style=\"padding-left: 6px;\">
            Server:
            <select name=\"filterByServer\" id=\"filterByServer\" onChange=\"reloadTable(); return false;\" style=\"width: 120px;\" class=\"form-control input-sm\">
                <option value=\"\">- all -</option>
                ";
        // line 535
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["serverDetails"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["serverDetail"]) {
            // line 536
            echo "                    <option value=\"";
            echo twig_escape_filter($this->env, (($__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4 = $context["serverDetail"]) && is_array($__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4) || $__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4 instanceof ArrayAccess ? ($__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4["id"] ?? null) : null), "html", null, true);
            echo "\"";
            echo (((($context["filterByServer"] ?? null) == (($__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144 = $context["serverDetail"]) && is_array($__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144) || $__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144 instanceof ArrayAccess ? ($__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144["id"] ?? null) : null))) ? (" SELECTED") : (""));
            echo ">";
            echo twig_escape_filter($this->env, (($__internal_1cfccaec8dd2e8578ccb026fbe7f2e7e29ac2ed5deb976639c5fc99a6ea8583b = $context["serverDetail"]) && is_array($__internal_1cfccaec8dd2e8578ccb026fbe7f2e7e29ac2ed5deb976639c5fc99a6ea8583b) || $__internal_1cfccaec8dd2e8578ccb026fbe7f2e7e29ac2ed5deb976639c5fc99a6ea8583b instanceof ArrayAccess ? ($__internal_1cfccaec8dd2e8578ccb026fbe7f2e7e29ac2ed5deb976639c5fc99a6ea8583b["serverLabel"] ?? null) : null), "html", null, true);
            echo "</option>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['serverDetail'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 538
        echo "            </select>
        </label>
        <label class=\"adminResponsiveHide filterByStatusWrapper\" style=\"padding-left: 6px;\">
            Status:
            <select name=\"filterByStatus\" id=\"filterByStatus\" onChange=\"reloadTable(); return false;\" style=\"width: 120px;\" class=\"form-control input-sm\">
                <option value=\"\">- all -</option>
                ";
        // line 544
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["statusDetails"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["statusDetail"]) {
            // line 545
            echo "                    <option value=\"";
            echo twig_escape_filter($this->env, $context["statusDetail"], "html", null, true);
            echo "\"";
            echo (((($context["filterByStatus"] ?? null) == $context["statusDetail"])) ? (" SELECTED") : (""));
            echo ">";
            echo twig_escape_filter($this->env, $context["statusDetail"], "html", null, true);
            echo "</option>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['statusDetail'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 547
        echo "            </select>
        </label>
        <label class=\"adminResponsiveHide filterBySourceWrapper\" style=\"padding-left: 6px; display: none;\">
            Src:
            <select name=\"filterBySource\" id=\"filterBySource\" onChange=\"reloadTable();
                return false;\" style=\"width: 80px;\" class=\"form-control input-sm\">
                <option value=\"\">- all -</option>
                <option value=\"direct\">Direct</option>
                <option value=\"ftp\">FTP</option>
                <option value=\"remote\">Remote</option>
                <option value=\"torrent\">Torrent</option>
                <option value=\"leech\">Leech</option>
                <option value=\"webdav\">Webdav</option>
                <option value=\"api\">API</option>
                <option value=\"other\">Other</option>
            </select>
        </label>

        <label class=\"adminResponsiveHide updateViewWrapper\" style=\"padding-left: 6px;\">
            View:
            <select name=\"filterView\" id=\"filterView\" onChange=\"reloadTable(); return false;\" style=\"width: 80px;\" class=\"form-control input-sm\">
                <option value=\"list\" ";
        // line 568
        echo (((($context["SITE_CONFIG_DEFAULT_ADMIN_FILE_MANAGER_VIEW"] ?? null) == "list")) ? ("SELECTED") : (""));
        echo ">List</option>
                <option value=\"thumb\" ";
        // line 569
        echo (((($context["SITE_CONFIG_DEFAULT_ADMIN_FILE_MANAGER_VIEW"] ?? null) == "thumb")) ? ("SELECTED") : (""));
        echo ">Thumbnails</option>
            </select>
        </label>
    </div>

    <div id=\"editFileForm\" class=\"modal fade\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">
        <div class=\"modal-dialog modal-lg\">
            <div class=\"modal-content\">
                <div class=\"modal-header\"><button type=\"button\" class=\"close\" data-dismiss=\"modal\"><span aria-hidden=\"true\">×</span></button></div>
                <div class=\"modal-body\" id=\"editFileFormInner\"></div>
                <div class=\"modal-footer\">
                    <button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">Close</button>
                    <button type=\"button\" class=\"btn btn-primary\" onClick=\"processEditFile();\">Update File</button>
                </div>
            </div>
        </div>
    </div>

    <div id=\"confirmDelete\" style=\"display: none;\">
        <div class=\"modal-body\">
            <form id=\"removeFileForm\" class=\"form-horizontal form-label-left input_mask\">
                <div class=\"x_panel\">
                    <div class=\"x_title\">
                        <h2>Remove File:</h2>
                        <div class=\"clearfix\"></div>
                    </div>

                    <div class=\"x_content\">
                        <p>Select the type of removal below. You can also add removal notes such as a copy of the original removal request. The notes are only visible by an admin user.</p>
                        <div class=\"form-group\">
                            <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">
                                Removal Type:
                            </label>
                            <div class=\"col-md-9 col-sm-9 col-xs-12\">
                                <div class=\"input-group\">
                                    <select name=\"removal_type\" id=\"removal_type\" class=\"form-control\" onChange=\"updateSelectedRemoveFileSelect();
                                          return false;\">
                                        <option value=\"3\">General</option>
                                        <option value=\"4\">Copyright Breach (DMCA)</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class=\"form-group\">
                            <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">
                                Notes:
                            </label>
                            <div class=\"col-md-9 col-sm-9 col-xs-12\">
                                <textarea name=\"admin_notes\" id=\"admin_notes\" class=\"form-control\"></textarea>
                            </div>
                        </div>
                        <div class=\"form-group\">
                            <label class=\"control-label col-md-3 col-sm-3 col-xs-12\">
                                Block Future Uploads:
                            </label>
                            <div class=\"col-md-9 col-sm-9 col-xs-12\">
                                <div class=\"input-group\">
                                    <select name=\"block_uploads\" id=\"block_uploads\" class=\"form-control\">
                                        <option value=\"0\">No (allow the same file to be uploaded again)</option>
                                        <option value=\"1\">Yes (this file will be blocked from uploading again)</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class=\"modal-footer\">
            <button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">Close</button>
            <button type=\"button\" class=\"btn btn-primary\" onClick=\"processRemoveFile();\">Remove File</button>
        </div>
    </div>

    <div id=\"moveFilesForm\" class=\"modal fade\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">
        <div class=\"modal-dialog modal-lg\">
            <div class=\"modal-content\">
                <div class=\"modal-header\"><button type=\"button\" class=\"close\" data-dismiss=\"modal\"><span aria-hidden=\"true\">×</span></button></div>
                <div class=\"modal-body\" id=\"moveFilesRawFileForm\"></div>
                <div class=\"modal-footer\">
                    <button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">Close</button>
                    <button type=\"button\" class=\"btn btn-primary\" onClick=\"processMoveFileForm();\">Move Files</button>
                </div>
            </div>
        </div>
    </div>
";
    }

    public function getTemplateName()
    {
        return "admin/file_manage.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  722 => 569,  718 => 568,  695 => 547,  682 => 545,  678 => 544,  670 => 538,  657 => 536,  653 => 535,  644 => 529,  636 => 524,  624 => 514,  618 => 510,  616 => 509,  609 => 505,  604 => 503,  599 => 501,  581 => 486,  573 => 481,  569 => 480,  565 => 479,  561 => 478,  557 => 477,  553 => 476,  549 => 475,  532 => 461,  524 => 456,  74 => 8,  70 => 7,  63 => 5,  56 => 4,  49 => 3,  38 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "admin/file_manage.html.twig", "/var/www/html/medicalimage/app/views/admin/file_manage.html.twig");
    }
}
