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

/* admin/partial/layout_logged_in.html.twig */
class __TwigTemplate_042cf7c5e366205ad85714b5942bcecdb77256d828dce2e6737ba78e86c54b4b extends \Twig\Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
            'head_css' => [$this, 'block_head_css'],
            'head_js' => [$this, 'block_head_js'],
            'body' => [$this, 'block_body'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        echo "<!DOCTYPE html>
<html lang=\"en\">
    <head>
        <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset=\"utf-8\">
        <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">

        <title>";
        // line 10
        $this->displayBlock("title", $context, $blocks);
        echo " - Admin</title>

        <!-- Bootstrap -->
        <link href=\"";
        // line 13
        echo twig_escape_filter($this->env, ($context["CORE_ASSETS_ADMIN_WEB_ROOT"] ?? null), "html", null, true);
        echo "/vendors/bootstrap/dist/css/bootstrap.min.css\" rel=\"stylesheet\"/>
        <!-- Font Awesome -->
        <link href=\"";
        // line 15
        echo twig_escape_filter($this->env, ($context["CORE_ASSETS_ADMIN_WEB_ROOT"] ?? null), "html", null, true);
        echo "/vendors/font-awesome/css/font-awesome.min.css\" rel=\"stylesheet\"/>
        <!-- NProgress -->
        <link href=\"";
        // line 17
        echo twig_escape_filter($this->env, ($context["CORE_ASSETS_ADMIN_WEB_ROOT"] ?? null), "html", null, true);
        echo "/vendors/nprogress/nprogress.css\" rel=\"stylesheet\"/>
        <link href=\"";
        // line 18
        echo twig_escape_filter($this->env, ($context["CORE_ASSETS_ADMIN_WEB_ROOT"] ?? null), "html", null, true);
        echo "/vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css\" rel=\"stylesheet\" />
        <!-- iCheck -->
        <link href=\"";
        // line 20
        echo twig_escape_filter($this->env, ($context["CORE_ASSETS_ADMIN_WEB_ROOT"] ?? null), "html", null, true);
        echo "/vendors/iCheck/skins/flat/green.css\" rel=\"stylesheet\"/>
        <!-- bootstrap-wysiwyg -->
        <link href=\"";
        // line 22
        echo twig_escape_filter($this->env, ($context["CORE_ASSETS_ADMIN_WEB_ROOT"] ?? null), "html", null, true);
        echo "/vendors/google-code-prettify/bin/prettify.min.css\" rel=\"stylesheet\"/>
        <!-- Select2 -->
        <link href=\"";
        // line 24
        echo twig_escape_filter($this->env, ($context["CORE_ASSETS_ADMIN_WEB_ROOT"] ?? null), "html", null, true);
        echo "/vendors/select2/dist/css/select2.min.css\" rel=\"stylesheet\"/>
        <!-- Switchery -->
        <link href=\"";
        // line 26
        echo twig_escape_filter($this->env, ($context["CORE_ASSETS_ADMIN_WEB_ROOT"] ?? null), "html", null, true);
        echo "/vendors/switchery/dist/switchery.min.css\" rel=\"stylesheet\"/>
        <!-- starrr -->
        <link href=\"";
        // line 28
        echo twig_escape_filter($this->env, ($context["CORE_ASSETS_ADMIN_WEB_ROOT"] ?? null), "html", null, true);
        echo "/vendors/starrr/dist/starrr.css\" rel=\"stylesheet\"/>
        <!-- bootstrap-daterangepicker -->
        <link href=\"";
        // line 30
        echo twig_escape_filter($this->env, ($context["CORE_ASSETS_ADMIN_WEB_ROOT"] ?? null), "html", null, true);
        echo "/vendors/bootstrap-daterangepicker/daterangepicker.css\" rel=\"stylesheet\"/>
        <!-- Datatables -->
        <link href=\"";
        // line 32
        echo twig_escape_filter($this->env, ($context["CORE_ASSETS_ADMIN_WEB_ROOT"] ?? null), "html", null, true);
        echo "/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css\" rel=\"stylesheet\"/>
        <link href=\"";
        // line 33
        echo twig_escape_filter($this->env, ($context["CORE_ASSETS_ADMIN_WEB_ROOT"] ?? null), "html", null, true);
        echo "/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css\" rel=\"stylesheet\"/>
        <link href=\"";
        // line 34
        echo twig_escape_filter($this->env, ($context["CORE_ASSETS_ADMIN_WEB_ROOT"] ?? null), "html", null, true);
        echo "/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css\" rel=\"stylesheet\"/>
        <link href=\"";
        // line 35
        echo twig_escape_filter($this->env, ($context["CORE_ASSETS_ADMIN_WEB_ROOT"] ?? null), "html", null, true);
        echo "/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css\" rel=\"stylesheet\"/>
        <link href=\"";
        // line 36
        echo twig_escape_filter($this->env, ($context["CORE_ASSETS_ADMIN_WEB_ROOT"] ?? null), "html", null, true);
        echo "/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css\" rel=\"stylesheet\"/>
        <!-- PNotify -->
        <link href=\"";
        // line 38
        echo twig_escape_filter($this->env, ($context["CORE_ASSETS_ADMIN_WEB_ROOT"] ?? null), "html", null, true);
        echo "/vendors/pnotify/dist/pnotify.css\" rel=\"stylesheet\"/>
        <link href=\"";
        // line 39
        echo twig_escape_filter($this->env, ($context["CORE_ASSETS_ADMIN_WEB_ROOT"] ?? null), "html", null, true);
        echo "/vendors/pnotify/dist/pnotify.buttons.css\" rel=\"stylesheet\"/>
        <link href=\"";
        // line 40
        echo twig_escape_filter($this->env, ($context["CORE_ASSETS_ADMIN_WEB_ROOT"] ?? null), "html", null, true);
        echo "/vendors/pnotify/dist/pnotify.nonblock.css\" rel=\"stylesheet\"/>

        <!-- Custom Theme Styles -->
        <link href=\"";
        // line 43
        echo twig_escape_filter($this->env, ($context["CORE_ASSETS_ADMIN_WEB_ROOT"] ?? null), "html", null, true);
        echo "/css/responsive.css\" rel=\"stylesheet\"/>
        <link href=\"";
        // line 44
        echo twig_escape_filter($this->env, ($context["CORE_ASSETS_ADMIN_WEB_ROOT"] ?? null), "html", null, true);
        echo "/css/custom.css\" rel=\"stylesheet\"/>
        <link href=\"";
        // line 45
        echo twig_escape_filter($this->env, ($context["CORE_ASSETS_ADMIN_WEB_ROOT"] ?? null), "html", null, true);
        echo "/css/pre_v44_compat.css\" rel=\"stylesheet\"/>

        <!-- Colour Skin -->
        <!--<link href=\"";
        // line 48
        echo twig_escape_filter($this->env, ($context["CORE_ASSETS_ADMIN_WEB_ROOT"] ?? null), "html", null, true);
        echo "/css/skins/brown.css\" rel=\"stylesheet\"/>-->
        <link rel=\"icon\" type=\"image/png\" href=\"https://radmed.co.id/images/favicon.png\"/>

        <!-- append any theme admin css -->
        ";
        // line 52
        if ((twig_length_filter($this->env, ($context["adminThemeCss"] ?? null)) > 0)) {
            // line 53
            echo "            <link rel=\"stylesheet\" href=\"";
            echo twig_escape_filter($this->env, ($context["adminThemeCss"] ?? null), "html", null, true);
            echo "\" type=\"text/css\" media=\"screen\" />
        ";
        }
        // line 55
        echo "        
        ";
        // line 56
        $this->displayBlock('head_css', $context, $blocks);
        // line 57
        echo "
        <script type=\"text/javascript\">
            var ADMIN_WEB_ROOT = \"";
        // line 59
        echo twig_escape_filter($this->env, ($context["ADMIN_WEB_ROOT"] ?? null), "html", null, true);
        echo "\";
            var CORE_ASSETS_ADMIN_WEB_ROOT = \"";
        // line 60
        echo twig_escape_filter($this->env, ($context["CORE_ASSETS_ADMIN_WEB_ROOT"] ?? null), "html", null, true);
        echo "\";
        </script>

        <!-- jQuery -->
        <script src=\"";
        // line 64
        echo twig_escape_filter($this->env, ($context["CORE_ASSETS_ADMIN_WEB_ROOT"] ?? null), "html", null, true);
        echo "/vendors/jquery/dist/jquery.min.js\"></script>
        <!-- Bootstrap -->
        <script src=\"";
        // line 66
        echo twig_escape_filter($this->env, ($context["CORE_ASSETS_ADMIN_WEB_ROOT"] ?? null), "html", null, true);
        echo "/vendors/bootstrap/dist/js/bootstrap.min.js\"></script>
        <!-- Pre v4.4 compatibility, i.e. third party plugins -->
        <script src=\"";
        // line 68
        echo twig_escape_filter($this->env, ($context["CORE_ASSETS_ADMIN_WEB_ROOT"] ?? null), "html", null, true);
        echo "/js/pre_v44_compat.js\"></script>
        
        ";
        // line 70
        $this->displayBlock('head_js', $context, $blocks);
        // line 71
        echo "    </head>

    <body class=\"nav-md\">
        <div class=\"container body\">
            <div class=\"main_container\">
                <div class=\"col-md-3 left_col menu_fixed\">
                    <div class=\"left_col scroll-view\" style=\"width: 100%;\">
                        <div class=\"navbar nav_title\" style=\"border: 0;\">
                            <a href=\"";
        // line 79
        echo twig_escape_filter($this->env, ($context["ADMIN_WEB_ROOT"] ?? null), "html", null, true);
        echo "\" class=\"site_title\"><i class=\"fa fa-cogs\"></i> <span>";
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("site_admin", "site admin")), "html", null, true);
        echo "</span></a>
                        </div>
                        <div class=\"clearfix\"></div>
                        
                        <!-- menu profile quick info -->
                        <div class=\"profile\">
                            <div class=\"profile_pic\">
                                <img src=\"";
        // line 86
        echo twig_escape_filter($this->env, ($context["ADMIN_WEB_ROOT"] ?? null), "html", null, true);
        echo "/ajax/account_view_avatar?userId=";
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["Auth"] ?? null), "id", [], "any", false, false, false, 86), "html", null, true);
        echo "&width=44&height=44\" alt=\"...\" class=\"img-circle profile_img\" style=\"width: 56px; height: 56px;\">
                            </div>
                            <div class=\"profile_info\">
                                <span>Welcome,</span>
                                <h2>";
        // line 90
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["Auth"] ?? null), "getAccountScreenName", [], "method", false, false, false, 90), "html", null, true);
        echo "</h2>
                            </div>
                        </div>
                        <!-- /menu profile quick info -->

                        <br />

                        <!-- sidebar menu -->
                        <div id=\"sidebar-menu\" class=\"main_menu_side hidden-print main_menu\">
                            <div class=\"menu_section\">
                                <h3>&nbsp;</h3>
                                <ul class=\"nav side-menu\">
                                    <li class=\"";
        // line 102
        echo (((        $this->renderBlock("selected_page", $context, $blocks) == "dashboard")) ? ("active") : (""));
        echo "\">
                                        <a href=\"";
        // line 103
        echo twig_escape_filter($this->env, ($context["ADMIN_WEB_ROOT"] ?? null), "html", null, true);
        echo "/\"><i class=\"fa fa-home\"></i> ";
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, twig_lower_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("dashboard", "dashboard"))), "html", null, true);
        echo "</a>
                                    </li>
                                    <li class=\"";
        // line 105
        echo ((((        $this->renderBlock("selected_page", $context, $blocks) == "files") || (        $this->renderBlock("selected_page", $context, $blocks) == "downloads"))) ? ("active") : (""));
        echo "\">
                                        <a><i class=\"fa fa-cloud-upload\"></i> ";
        // line 106
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, twig_lower_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("files", "files"))), "html", null, true);
        echo " <span class=\"fa fa-chevron-down\"></span></a>
                                        <ul class=\"nav child_menu\">
                                            <li><a href=\"";
        // line 108
        echo twig_escape_filter($this->env, ($context["ADMIN_WEB_ROOT"] ?? null), "html", null, true);
        echo "/file_manage\">";
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, twig_lower_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("manage_files", "manage files"))), "html", null, true);
        echo "</a></li>
                                                ";
        // line 109
        if ((twig_get_attribute($this->env, $this->source, ($context["Auth"] ?? null), "hasAccessLevel", [0 => 20], "method", false, false, false, 109) == true)) {
            echo " 
                                                <li class=\"nav_active_downloads\"><a href=\"";
            // line 110
            echo twig_escape_filter($this->env, ($context["ADMIN_WEB_ROOT"] ?? null), "html", null, true);
            echo "/download_current\">";
            echo twig_escape_filter($this->env, twig_title_string_filter($this->env, twig_lower_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("active_downloads", "active downloads"))), "html", null, true);
            echo "</a></li>
                                                <li><a href=\"";
            // line 111
            echo twig_escape_filter($this->env, ($context["ADMIN_WEB_ROOT"] ?? null), "html", null, true);
            echo "/file_manage_action_queue\">";
            echo twig_escape_filter($this->env, twig_title_string_filter($this->env, twig_lower_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("action_queue", "action queue"))), "html", null, true);
            echo " (";
            echo twig_escape_filter($this->env, ($context["totalPendingFileActions"] ?? null), "html", null, true);
            echo ")</a></li>
                                                ";
        }
        // line 113
        echo "                                            <li class=\"nav_abuse_reports\">
                                                <a>";
        // line 114
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, twig_lower_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("abuse_reports", "abuse reports"))), "html", null, true);
        if ((($context["totalReports"] ?? null) > 0)) {
            echo " (";
            echo twig_escape_filter($this->env, ($context["totalReports"] ?? null), "html", null, true);
            echo ")";
        }
        echo "<span class=\"fa fa-chevron-down\"></span></a>
                                                <ul class=\"nav child_menu\">
                                                    <li><a href=\"";
        // line 116
        echo twig_escape_filter($this->env, ($context["ADMIN_WEB_ROOT"] ?? null), "html", null, true);
        echo "/file_report_manage\">";
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, twig_lower_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("manage_reports", "manage reports"))), "html", null, true);
        if ((($context["totalReports"] ?? null) > 0)) {
            echo " (";
            echo twig_escape_filter($this->env, ($context["totalReports"] ?? null), "html", null, true);
            echo ")";
        }
        echo "</a></li>
                                                    <li><a href=\"";
        // line 117
        echo twig_escape_filter($this->env, ($context["ADMIN_WEB_ROOT"] ?? null), "html", null, true);
        echo "/file_report_manage_bulk_remove\">";
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, twig_lower_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("bulk_remove_abuse_reports", "bulk remove"))), "html", null, true);
        echo "</a></li>
                                                </ul>
                                            </li>

                                            ";
        // line 121
        if ((twig_get_attribute($this->env, $this->source, ($context["Auth"] ?? null), "hasAccessLevel", [0 => 20], "method", false, false, false, 121) == true)) {
            echo " 
                                                <li><a href=\"";
            // line 122
            echo twig_escape_filter($this->env, ($context["ADMIN_WEB_ROOT"] ?? null), "html", null, true);
            echo "/plugin/fileimport/settings\">";
            echo twig_escape_filter($this->env, twig_title_string_filter($this->env, twig_lower_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("bulk_import", "bulk import"))), "html", null, true);
            echo "</a></li>
                                                ";
        }
        // line 124
        echo "                                        </ul>
                                    </li>
                                    ";
        // line 126
        if ((twig_get_attribute($this->env, $this->source, ($context["Auth"] ?? null), "hasAccessLevel", [0 => 20], "method", false, false, false, 126) == true)) {
            // line 127
            echo "                                        <li class=\"";
            echo (((            $this->renderBlock("selected_page", $context, $blocks) == "users")) ? ("active") : (""));
            echo "\">
                                            <a><i class=\"fa fa-users\"></i> ";
            // line 128
            echo twig_escape_filter($this->env, twig_title_string_filter($this->env, twig_lower_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("users", "users"))), "html", null, true);
            echo " <span class=\"fa fa-chevron-down\"></span></a>
                                            <ul class=\"nav child_menu\">
                                                <li><a href=\"";
            // line 130
            echo twig_escape_filter($this->env, ($context["ADMIN_WEB_ROOT"] ?? null), "html", null, true);
            echo "/user_manage\">";
            echo twig_escape_filter($this->env, twig_title_string_filter($this->env, twig_lower_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("manage_users", "manage users"))), "html", null, true);
            echo "</a></li>
                                                <li><a href=\"";
            // line 131
            echo twig_escape_filter($this->env, ($context["ADMIN_WEB_ROOT"] ?? null), "html", null, true);
            echo "/user_add\">";
            echo twig_escape_filter($this->env, twig_title_string_filter($this->env, twig_lower_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("add_user", "add user"))), "html", null, true);
            echo "</a></li>
                                                <li class=\"nav_received_payments\">
                                                    <a>";
            // line 133
            echo twig_escape_filter($this->env, twig_title_string_filter($this->env, twig_lower_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("received_payments", "received payments"))), "html", null, true);
            echo "<span class=\"fa fa-chevron-down\"></span></a>
                                                    <ul class=\"nav child_menu\">
                                                        <li><a href=\"";
            // line 135
            echo twig_escape_filter($this->env, ($context["ADMIN_WEB_ROOT"] ?? null), "html", null, true);
            echo "/payment_manage\">";
            echo twig_escape_filter($this->env, twig_title_string_filter($this->env, twig_lower_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("list_payments", "list payments"))), "html", null, true);
            echo "</a></li>
                                                        <li><a href=\"";
            // line 136
            echo twig_escape_filter($this->env, ($context["ADMIN_WEB_ROOT"] ?? null), "html", null, true);
            echo "/payment_manage?log=1\">";
            echo twig_escape_filter($this->env, twig_title_string_filter($this->env, twig_lower_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("log_payment", "log payment"))), "html", null, true);
            echo "</a></li>
                                                    </ul>
                                                </li>
                                                <li class=\"nav_subscriptions\"><a href=\"";
            // line 139
            echo twig_escape_filter($this->env, ($context["ADMIN_WEB_ROOT"] ?? null), "html", null, true);
            echo "/payment_subscription_manage\">";
            echo twig_escape_filter($this->env, twig_title_string_filter($this->env, twig_lower_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("manage_subscriptions", "manage subscriptions"))), "html", null, true);
            echo "</a></li>
                                            </ul>
                                        </li>
                                    ";
        }
        // line 143
        echo "                                    
                                    <li class=\"";
        // line 144
        echo (((        $this->renderBlock("selected_page", $context, $blocks) == "sharing")) ? ("active") : (""));
        echo "\">
                                        <a><i class=\"fa fa-share-alt\"></i> ";
        // line 145
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, twig_lower_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("sharing", "sharing"))), "html", null, true);
        echo " <span class=\"fa fa-chevron-down\"></span></a>
                                        <ul class=\"nav child_menu\">
                                            <li><a href=\"";
        // line 147
        echo twig_escape_filter($this->env, ($context["ADMIN_WEB_ROOT"] ?? null), "html", null, true);
        echo "/sharing_manage\">";
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, twig_lower_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("manage_sharing", "manage sharing"))), "html", null, true);
        echo "</a></li>
                                            <li><a href=\"";
        // line 148
        echo twig_escape_filter($this->env, ($context["ADMIN_WEB_ROOT"] ?? null), "html", null, true);
        echo "/sharing_manage?add=1\">";
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, twig_lower_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("create_share", "create share"))), "html", null, true);
        echo "</a></li>
                                        </ul>
                                    </li>
                                    
                                    ";
        // line 152
        if ((twig_get_attribute($this->env, $this->source, ($context["Auth"] ?? null), "hasAccessLevel", [0 => 20], "method", false, false, false, 152) == true)) {
            // line 153
            echo "                                        <li class=\"";
            echo (((            $this->renderBlock("selected_page", $context, $blocks) == "file_servers")) ? ("active") : (""));
            echo "\">
                                            <a><i class=\"fa fa-hdd-o\"></i> ";
            // line 154
            echo twig_escape_filter($this->env, twig_title_string_filter($this->env, twig_lower_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("file_servers", "file servers"))), "html", null, true);
            echo " <span class=\"fa fa-chevron-down\"></span></a>
                                            <ul class=\"nav child_menu\">
                                                <li><a href=\"";
            // line 156
            echo twig_escape_filter($this->env, ($context["ADMIN_WEB_ROOT"] ?? null), "html", null, true);
            echo "/server_manage\">";
            echo twig_escape_filter($this->env, twig_title_string_filter($this->env, twig_lower_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("manage_file_servers", "manage file servers"))), "html", null, true);
            echo "</a></li>
                                                <li><a href=\"";
            // line 157
            echo twig_escape_filter($this->env, ($context["ADMIN_WEB_ROOT"] ?? null), "html", null, true);
            echo "/server_manage?add=1\">";
            echo twig_escape_filter($this->env, twig_title_string_filter($this->env, twig_lower_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("add_file_server", "add file server"))), "html", null, true);
            echo "</a></li>
                                            </ul>
                                        </li>
                                    ";
        }
        // line 161
        echo "
                                    ";
        // line 162
        if ((twig_get_attribute($this->env, $this->source, ($context["Auth"] ?? null), "hasAccessLevel", [0 => 20], "method", false, false, false, 162) == true)) {
            // line 163
            echo "                                        <li class=\"";
            echo (((            $this->renderBlock("selected_page", $context, $blocks) == "plugins")) ? ("active") : (""));
            echo " nav_plugins\">
                                            <a><i class=\"fa fa-plug\"></i> ";
            // line 164
            echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("plugins", "Plugins"), "html", null, true);
            echo " <span class=\"fa fa-chevron-down\"></span></a>
                                            <ul class=\"nav child_menu\">
                                                <li>
                                                    <a href=\"";
            // line 167
            echo twig_escape_filter($this->env, ($context["ADMIN_WEB_ROOT"] ?? null), "html", null, true);
            echo "/plugin_manage\">";
            echo twig_escape_filter($this->env, twig_title_string_filter($this->env, twig_lower_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("manage_plugins", "manage plugins"))), "html", null, true);
            echo "</a>
                                                </li>
                                                <li>
                                                    <a>";
            // line 170
            echo twig_escape_filter($this->env, twig_title_string_filter($this->env, twig_lower_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("plugin_settings", "plugin settings"))), "html", null, true);
            echo " <span class=\"fa fa-chevron-down\"></span></a>
                                                        ";
            // line 171
            if ((twig_length_filter($this->env, ($context["navPluginList"] ?? null)) > 0)) {
                // line 172
                echo "                                                        <ul class=\"nav child_menu\">
                                                            ";
                // line 173
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["navPluginList"] ?? null));
                $context['loop'] = [
                  'parent' => $context['_parent'],
                  'index0' => 0,
                  'index'  => 1,
                  'first'  => true,
                ];
                if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof \Countable)) {
                    $length = count($context['_seq']);
                    $context['loop']['revindex0'] = $length - 1;
                    $context['loop']['revindex'] = $length;
                    $context['loop']['length'] = $length;
                    $context['loop']['last'] = 1 === $length;
                }
                foreach ($context['_seq'] as $context["_key"] => $context["pluginItem"]) {
                    // line 174
                    echo "                                                                ";
                    if ((twig_get_attribute($this->env, $this->source, $context["loop"], "index", [], "any", false, false, false, 174) < 10)) {
                        // line 175
                        echo "                                                                    <li><a href=\"";
                        echo twig_escape_filter($this->env, ($context["ADMIN_WEB_ROOT"] ?? null), "html", null, true);
                        echo "/plugin/";
                        echo twig_escape_filter($this->env, (($__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4 = $context["pluginItem"]) && is_array($__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4) || $__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4 instanceof ArrayAccess ? ($__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4["folder_name"] ?? null) : null), "html", null, true);
                        echo "/settings\">";
                        echo twig_escape_filter($this->env, (($__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144 = $context["pluginItem"]) && is_array($__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144) || $__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144 instanceof ArrayAccess ? ($__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144["plugin_name"] ?? null) : null), "html", null, true);
                        echo "</a></li>
                                                                    ";
                    }
                    // line 177
                    echo "                                                                ";
                    ++$context['loop']['index0'];
                    ++$context['loop']['index'];
                    $context['loop']['first'] = false;
                    if (isset($context['loop']['length'])) {
                        --$context['loop']['revindex0'];
                        --$context['loop']['revindex'];
                        $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                    }
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['pluginItem'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 178
                echo "                                                            <li><a href=\"";
                echo twig_escape_filter($this->env, ($context["ADMIN_WEB_ROOT"] ?? null), "html", null, true);
                echo "/plugin_manage\">";
                echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("more", "more...."), "html", null, true);
                echo "</a></li>
                                                        </ul>
                                                    ";
            }
            // line 181
            echo "                                                </li>
                                                <li><a href=\"";
            // line 182
            echo twig_escape_filter($this->env, ($context["ADMIN_WEB_ROOT"] ?? null), "html", null, true);
            echo "/plugin_manage_add\">";
            echo twig_escape_filter($this->env, twig_title_string_filter($this->env, twig_lower_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("add_plugin", "add plugin"))), "html", null, true);
            echo "</a></li>
                                                <li><a href=\"";
            // line 183
            echo twig_escape_filter($this->env, ($context["currentProductUrl"] ?? null), "html", null, true);
            echo "/plugins.html\" target=\"_blank\">";
            echo twig_escape_filter($this->env, twig_title_string_filter($this->env, twig_lower_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("get_plugin", "get plugins"))), "html", null, true);
            echo "</a></li>
                                            </ul>
                                        </li>

                                        <li class=\"";
            // line 187
            echo (((            $this->renderBlock("selected_page", $context, $blocks) == "themes")) ? ("active") : (""));
            echo "\">
                                            <a><i class=\"fa fa-photo\"></i> ";
            // line 188
            echo twig_escape_filter($this->env, twig_title_string_filter($this->env, twig_lower_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("themes", "themes"))), "html", null, true);
            echo " <span class=\"fa fa-chevron-down\"></span></a>
                                            <ul class=\"nav child_menu\">
                                                <li><a href=\"";
            // line 190
            echo twig_escape_filter($this->env, ($context["ADMIN_WEB_ROOT"] ?? null), "html", null, true);
            echo "/theme_settings/";
            echo twig_escape_filter($this->env, ($context["SITE_CONFIG_SITE_THEME"] ?? null), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, ($context["currentThemeName"] ?? null), "html", null, true);
            echo "</a></li>
                                                <li><a href=\"";
            // line 191
            echo twig_escape_filter($this->env, ($context["ADMIN_WEB_ROOT"] ?? null), "html", null, true);
            echo "/theme_manage\">";
            echo twig_escape_filter($this->env, twig_title_string_filter($this->env, twig_lower_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("manage_themes", "manage themes"))), "html", null, true);
            echo "</a></li>
                                                <li><a href=\"";
            // line 192
            echo twig_escape_filter($this->env, ($context["ADMIN_WEB_ROOT"] ?? null), "html", null, true);
            echo "/theme_manage_add\">";
            echo twig_escape_filter($this->env, twig_title_string_filter($this->env, twig_lower_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("add_theme", "add theme"))), "html", null, true);
            echo "</a></li>
                                                <li><a href=\"";
            // line 193
            echo twig_escape_filter($this->env, ($context["currentProductUrl"] ?? null), "html", null, true);
            echo "/themes.html\" target=\"_blank\">";
            echo twig_escape_filter($this->env, twig_title_string_filter($this->env, twig_lower_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("get_themes", "get themes"))), "html", null, true);
            echo "</a></li>
                                            </ul>
                                        </li>

                                        <li class=\"";
            // line 197
            echo (((            $this->renderBlock("selected_page", $context, $blocks) == "api")) ? ("active") : (""));
            echo "\">
                                            <a><i class=\"fa fa-database\"></i> ";
            // line 198
            echo twig_escape_filter($this->env, twig_upper_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("api", "api")), "html", null, true);
            echo " <span class=\"fa fa-chevron-down\"></span></a>
                                            <ul class=\"nav child_menu\">
                                                <li><a href=\"";
            // line 200
            echo twig_escape_filter($this->env, ($context["ADMIN_WEB_ROOT"] ?? null), "html", null, true);
            echo "/setting_manage?filterByGroup=API\">";
            echo twig_escape_filter($this->env, twig_title_string_filter($this->env, twig_lower_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("api_settings", "settings"))), "html", null, true);
            echo "</a></li>
                                                <li><a href=\"";
            // line 201
            echo twig_escape_filter($this->env, ($context["ADMIN_WEB_ROOT"] ?? null), "html", null, true);
            echo "/api_documentation\">";
            echo twig_escape_filter($this->env, twig_title_string_filter($this->env, twig_lower_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("api_documentation", "documentation"))), "html", null, true);
            echo "</a></li>
                                                <li><a href=\"";
            // line 202
            echo twig_escape_filter($this->env, ($context["ADMIN_WEB_ROOT"] ?? null), "html", null, true);
            echo "/api_test_framework\">";
            echo twig_escape_filter($this->env, twig_title_string_filter($this->env, twig_lower_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("api_test_framework", "testing tool"))), "html", null, true);
            echo "</a></li>
                                            </ul>
                                        </li>

                                        <li class=\"";
            // line 206
            echo (((            $this->renderBlock("selected_page", $context, $blocks) == "configuration")) ? ("active") : (""));
            echo "\">
                                            <a><i class=\"fa fa-cog\"></i> ";
            // line 207
            echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("site_configuration", "Site Configuration"), "html", null, true);
            echo " <span class=\"fa fa-chevron-down\"></span></a>
                                            <ul class=\"nav child_menu\">
                                                <li>
                                                    <a>";
            // line 210
            echo twig_escape_filter($this->env, twig_title_string_filter($this->env, twig_lower_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("site_settings", "site settings"))), "html", null, true);
            echo " <span class=\"fa fa-chevron-down\"></span></a>
                                                    <ul class=\"nav child_menu\">
                                                        ";
            // line 212
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["navGroupDetails"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["navGroupDetail"]) {
                // line 213
                echo "                                                            <li><a href=\"";
                echo twig_escape_filter($this->env, ($context["ADMIN_WEB_ROOT"] ?? null), "html", null, true);
                echo "/setting_manage?filterByGroup=";
                echo twig_escape_filter($this->env, twig_urlencode_filter((($__internal_1cfccaec8dd2e8578ccb026fbe7f2e7e29ac2ed5deb976639c5fc99a6ea8583b = $context["navGroupDetail"]) && is_array($__internal_1cfccaec8dd2e8578ccb026fbe7f2e7e29ac2ed5deb976639c5fc99a6ea8583b) || $__internal_1cfccaec8dd2e8578ccb026fbe7f2e7e29ac2ed5deb976639c5fc99a6ea8583b instanceof ArrayAccess ? ($__internal_1cfccaec8dd2e8578ccb026fbe7f2e7e29ac2ed5deb976639c5fc99a6ea8583b["config_group"] ?? null) : null)), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, (($__internal_68aa442c1d43d3410ea8f958ba9090f3eaa9a76f8de8fc9be4d6c7389ba28002 = $context["navGroupDetail"]) && is_array($__internal_68aa442c1d43d3410ea8f958ba9090f3eaa9a76f8de8fc9be4d6c7389ba28002) || $__internal_68aa442c1d43d3410ea8f958ba9090f3eaa9a76f8de8fc9be4d6c7389ba28002 instanceof ArrayAccess ? ($__internal_68aa442c1d43d3410ea8f958ba9090f3eaa9a76f8de8fc9be4d6c7389ba28002["config_group"] ?? null) : null), "html", null, true);
                echo "</a></li>
                                                            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['navGroupDetail'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 215
            echo "                                                    </ul>
                                                </li>
                                                <li>
                                                    <a>";
            // line 218
            echo twig_escape_filter($this->env, twig_title_string_filter($this->env, twig_lower_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("user_settings", "user settings"))), "html", null, true);
            echo " <span class=\"fa fa-chevron-down\"></span></a>
                                                    <ul class=\"nav child_menu\">
                                                        <li class=\"nav_manage_download_pages\"><a href=\"";
            // line 220
            echo twig_escape_filter($this->env, ($context["ADMIN_WEB_ROOT"] ?? null), "html", null, true);
            echo "/download_page_manage\">";
            echo twig_escape_filter($this->env, twig_title_string_filter($this->env, twig_lower_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("download_pages", "download pages"))), "html", null, true);
            echo "</a></li>
                                                        <li><a href=\"";
            // line 221
            echo twig_escape_filter($this->env, ($context["ADMIN_WEB_ROOT"] ?? null), "html", null, true);
            echo "/account_package_manage\">";
            echo twig_escape_filter($this->env, twig_title_string_filter($this->env, twig_lower_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("account_packages", "account packages"))), "html", null, true);
            echo "</a></li>
                                                        <li><a href=\"";
            // line 222
            echo twig_escape_filter($this->env, ($context["ADMIN_WEB_ROOT"] ?? null), "html", null, true);
            echo "/banned_ip_manage\">";
            echo twig_escape_filter($this->env, twig_title_string_filter($this->env, twig_lower_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("banned_ips", "banned ips"))), "html", null, true);
            echo "</a></li>
                                                    </ul>
                                                </li>

                                                <li><a href=\"";
            // line 226
            echo twig_escape_filter($this->env, ($context["ADMIN_WEB_ROOT"] ?? null), "html", null, true);
            echo "/translation_manage\">";
            echo twig_escape_filter($this->env, twig_title_string_filter($this->env, twig_lower_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("translations", "translations"))), "html", null, true);
            echo "</a></li>

                                                <li>
                                                    <a>";
            // line 229
            echo twig_escape_filter($this->env, twig_title_string_filter($this->env, twig_lower_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("system_tools", "system tools"))), "html", null, true);
            echo " <span class=\"fa fa-chevron-down\"></span></a>
                                                    <ul class=\"nav child_menu\">
                                                        <li><a href=\"";
            // line 231
            echo twig_escape_filter($this->env, ($context["ADMIN_WEB_ROOT"] ?? null), "html", null, true);
            echo "/log_file_viewer\">";
            echo twig_escape_filter($this->env, twig_title_string_filter($this->env, twig_lower_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("system_logs", "system logs"))), "html", null, true);
            echo "</a></li>
                                                        <li><a href=\"";
            // line 232
            echo twig_escape_filter($this->env, ($context["ADMIN_WEB_ROOT"] ?? null), "html", null, true);
            echo "/background_task_manage\">";
            echo twig_escape_filter($this->env, twig_title_string_filter($this->env, twig_lower_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("background_task_logs", "background task logs"))), "html", null, true);
            echo "</a></li>
                                                        <li><a href=\"";
            // line 233
            echo twig_escape_filter($this->env, ($context["ADMIN_WEB_ROOT"] ?? null), "html", null, true);
            echo "/database_browser?username=&db=";
            echo twig_escape_filter($this->env, ($context["_CONFIG_DB_NAME"] ?? null), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, twig_title_string_filter($this->env, twig_lower_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("database_browser", "database browser"))), "html", null, true);
            echo "</a></li>
                                                        <li><a href=\"";
            // line 234
            echo twig_escape_filter($this->env, ($context["ADMIN_WEB_ROOT"] ?? null), "html", null, true);
            echo "/test_tools\">";
            echo twig_escape_filter($this->env, twig_title_string_filter($this->env, twig_lower_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("test_tools", "test tools"))), "html", null, true);
            echo "</a></li>
                                                        <li><a href=\"";
            // line 235
            echo twig_escape_filter($this->env, ($context["ADMIN_WEB_ROOT"] ?? null), "html", null, true);
            echo "/backup_manage\">";
            echo twig_escape_filter($this->env, twig_title_string_filter($this->env, twig_lower_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("backups", "backups"))), "html", null, true);
            echo "</a></li>
                                                        <li><a href=\"";
            // line 236
            echo twig_escape_filter($this->env, ($context["ADMIN_WEB_ROOT"] ?? null), "html", null, true);
            echo "/server_info\">";
            echo twig_escape_filter($this->env, twig_title_string_filter($this->env, twig_lower_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("php_info", "php info"))), "html", null, true);
            echo "</a></li>
                                                        <li><a href=\"";
            // line 237
            echo twig_escape_filter($this->env, ($context["ADMIN_WEB_ROOT"] ?? null), "html", null, true);
            echo "/support_info\">";
            echo twig_escape_filter($this->env, twig_title_string_filter($this->env, twig_lower_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("support_info", "support info"))), "html", null, true);
            echo "</a></li>
                                                        <li><a href=\"";
            // line 238
            echo twig_escape_filter($this->env, ($context["ADMIN_WEB_ROOT"] ?? null), "html", null, true);
            echo "/purge_application_cache\">";
            echo twig_escape_filter($this->env, twig_title_string_filter($this->env, twig_lower_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("purge_cache", "purge cache"))), "html", null, true);
            echo "</a></li>
                                                        <li><a href=\"";
            // line 239
            echo twig_escape_filter($this->env, ($context["ADMIN_WEB_ROOT"] ?? null), "html", null, true);
            echo "/system_update\">";
            echo twig_escape_filter($this->env, twig_title_string_filter($this->env, twig_lower_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("system_update", "system update"))), "html", null, true);
            echo "</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </li>
                                    ";
        }
        // line 245
        echo "                                </ul>
                            </div>

                            ";
        // line 248
        if ((twig_get_attribute($this->env, $this->source, ($context["Auth"] ?? null), "hasAccessLevel", [0 => 20], "method", false, false, false, 248) == true)) {
            // line 249
            echo "                                ";
            if (((twig_length_filter($this->env, ($context["themeNav"] ?? null)) > 0) || (twig_length_filter($this->env, ($context["pluginNav"] ?? null)) > 0))) {
                // line 250
                echo "                                    <div class=\"menu_section\">
                                        <h3>";
                // line 251
                echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("admin_plugin_pages", "Plugin Pages"), "html", null, true);
                echo "</h3>
                                        <ul class=\"nav side-menu\">
                                            ";
                // line 260
                echo "                                        </ul>
                                    </div>
                                ";
            }
            // line 263
            echo "                            ";
        }
        // line 264
        echo "                        </div>
                        <!-- /sidebar menu -->

                        <!-- /menu footer buttons -->
                        <div class=\"sidebar-footer hidden-small\">
                            <a href=\"";
        // line 269
        echo twig_escape_filter($this->env, ($context["ADMIN_WEB_ROOT"] ?? null), "html", null, true);
        echo "/setting_manage\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Site Settings\">
                                <span class=\"glyphicon glyphicon-cog\" aria-hidden=\"true\"></span>
                            </a>
                            <a href=\"#\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Toggle FullScreen\" onClick=\"toggleFullScreen();
                return false;\">
                                <span class=\"glyphicon glyphicon-fullscreen\" aria-hidden=\"true\"></span>
                            </a>
                            <a href=\"";
        // line 276
        echo twig_escape_filter($this->env, ($context["ADMIN_WEB_ROOT"] ?? null), "html", null, true);
        echo "/user_edit/";
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["Auth"] ?? null), "id", [], "any", false, false, false, 276), "html", null, true);
        echo "\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Manage Your Account\">
                                <span class=\"glyphicon glyphicon-lock\" aria-hidden=\"true\"></span>
                            </a>
                            <a href=\"";
        // line 279
        echo twig_escape_filter($this->env, ($context["ADMIN_WEB_ROOT"] ?? null), "html", null, true);
        echo "/logout\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"";
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, twig_lower_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("logout", "logout"))), "html", null, true);
        echo "\">
                                <span class=\"glyphicon glyphicon-off\" aria-hidden=\"true\"></span>
                            </a>
                        </div>
                        <!-- /menu footer buttons -->
                    </div>
                </div>

                <!-- top navigation -->
                <div class=\"top_nav\">
                    <div class=\"nav_menu\">
                        <nav>
                            <div class=\"nav toggle\">
                                <a id=\"menu_toggle\"><i class=\"fa fa-bars\"></i></a>
                            </div>

                            <ul class=\"nav navbar-nav navbar-right\">
                                <li class=\"\">
                                    <a href=\"javascript:;\" class=\"user-profile dropdown-toggle\" data-toggle=\"dropdown\" aria-expanded=\"false\">
                                        <img src=\"";
        // line 298
        echo twig_escape_filter($this->env, ($context["ADMIN_WEB_ROOT"] ?? null), "html", null, true);
        echo "/ajax/account_view_avatar?userId=";
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["Auth"] ?? null), "id", [], "any", false, false, false, 298), "html", null, true);
        echo "&width=44&height=44\" alt=\"\">";
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["Auth"] ?? null), "getAccountScreenName", [], "method", false, false, false, 298), "html", null, true);
        echo "
                                        <span class=\" fa fa-angle-down\"></span>
                                    </a>
                                    <ul class=\"dropdown-menu dropdown-usermenu pull-right\">
                                        <li><a href=\"";
        // line 302
        echo twig_escape_filter($this->env, ($context["ADMIN_WEB_ROOT"] ?? null), "html", null, true);
        echo "/user_edit/";
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["Auth"] ?? null), "id", [], "any", false, false, false, 302), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, twig_lower_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("your_account_settings", "your account settings"))), "html", null, true);
        echo "</a></li>
                                        <li><a href=\"https://forum.mfscripts.com\" target=\"_blank\">";
        // line 303
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, twig_lower_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("support", "support"))), "html", null, true);
        echo "</a></li>
                                        <li><a href=\"";
        // line 304
        echo twig_escape_filter($this->env, ($context["ADMIN_WEB_ROOT"] ?? null), "html", null, true);
        echo "/logout\"><i class=\"fa fa-sign-out pull-right\"></i> ";
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, twig_lower_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("logout", "logout"))), "html", null, true);
        echo "</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <!-- /top navigation -->

            ";
        // line 313
        $this->displayBlock('body', $context, $blocks);
        // line 314
        echo "
            <footer>
                <div class=\"pull-right\">
                    Created by <a href=\"";
        // line 317
        echo twig_escape_filter($this->env, ($context["currentProductUrl"] ?? null), "html", null, true);
        echo "\" target=\"_blank\">";
        echo twig_escape_filter($this->env, ($context["currentProductName"] ?? null), "html", null, true);
        echo "</a>, a <a href=\"https://mfscripts.com\" target=\"_blank\">MFScripts</a> company&nbsp;&nbsp;|&nbsp;&nbsp;v";
        echo twig_escape_filter($this->env, ($context["scriptVersion"] ?? null), "html", null, true);
        echo "&nbsp;&nbsp;|&nbsp;&nbsp;<a href=\"https://forum.mfscripts.com\" target=\"_blank\">";
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("support"), "html", null, true);
        echo "</a>
                </div>
                <div class=\"pull-left\">
                    ";
        // line 320
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("copyright")), "html", null, true);
        echo " &copy; ";
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, "now", "Y"), "html", null, true);
        echo " ";
        echo twig_escape_filter($this->env, ($context["SITE_CONFIG_SITE_NAME"] ?? null), "html", null, true);
        echo "
                </div>
                <div class=\"clearfix\"></div>
            </footer>

            <div id=\"genericModalContainer\" class=\"modal fade\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">
                <div class=\"modal-dialog modal-lg\">
                    <div class=\"modal-content\">
                        <div class=\"modal-header\"><button type=\"button\" class=\"close\" data-dismiss=\"modal\"><span aria-hidden=\"true\">×</span></button></div>
                        <div class=\"modal-body\"></div>
                        <div class=\"modal-footer\"></div>
                    </div>
                </div>
            </div>

            <!-- FastClick -->
            <script src=\"";
        // line 336
        echo twig_escape_filter($this->env, ($context["CORE_ASSETS_ADMIN_WEB_ROOT"] ?? null), "html", null, true);
        echo "/vendors/fastclick/lib/fastclick.js\"></script>

            <!-- NProgress -->
            <script src=\"";
        // line 339
        echo twig_escape_filter($this->env, ($context["CORE_ASSETS_ADMIN_WEB_ROOT"] ?? null), "html", null, true);
        echo "/vendors/nprogress/nprogress.js\"></script>
            <script src=\"";
        // line 340
        echo twig_escape_filter($this->env, ($context["CORE_ASSETS_ADMIN_WEB_ROOT"] ?? null), "html", null, true);
        echo "/vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js\"></script>

            <!-- iCheck -->
            <script src=\"";
        // line 343
        echo twig_escape_filter($this->env, ($context["CORE_ASSETS_ADMIN_WEB_ROOT"] ?? null), "html", null, true);
        echo "/vendors/iCheck/icheck.min.js\"></script>

            <!-- PNotify -->
            <script src=\"";
        // line 346
        echo twig_escape_filter($this->env, ($context["CORE_ASSETS_ADMIN_WEB_ROOT"] ?? null), "html", null, true);
        echo "/vendors/pnotify/dist/pnotify.js\"></script>
            <script src=\"";
        // line 347
        echo twig_escape_filter($this->env, ($context["CORE_ASSETS_ADMIN_WEB_ROOT"] ?? null), "html", null, true);
        echo "/vendors/pnotify/dist/pnotify.buttons.js\"></script>
            <script src=\"";
        // line 348
        echo twig_escape_filter($this->env, ($context["CORE_ASSETS_ADMIN_WEB_ROOT"] ?? null), "html", null, true);
        echo "/vendors/pnotify/dist/pnotify.nonblock.js\"></script>

            <!-- Datatables -->
            <script src=\"";
        // line 351
        echo twig_escape_filter($this->env, ($context["CORE_ASSETS_ADMIN_WEB_ROOT"] ?? null), "html", null, true);
        echo "/vendors/datatables.net/js/jquery.dataTables.min.js\"></script>
            <script src=\"";
        // line 352
        echo twig_escape_filter($this->env, ($context["CORE_ASSETS_ADMIN_WEB_ROOT"] ?? null), "html", null, true);
        echo "/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js\"></script>
            <script src=\"";
        // line 353
        echo twig_escape_filter($this->env, ($context["CORE_ASSETS_ADMIN_WEB_ROOT"] ?? null), "html", null, true);
        echo "/vendors/datatables.net-buttons/js/dataTables.buttons.min.js\"></script>
            <script src=\"";
        // line 354
        echo twig_escape_filter($this->env, ($context["CORE_ASSETS_ADMIN_WEB_ROOT"] ?? null), "html", null, true);
        echo "/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js\"></script>
            <script src=\"";
        // line 355
        echo twig_escape_filter($this->env, ($context["CORE_ASSETS_ADMIN_WEB_ROOT"] ?? null), "html", null, true);
        echo "/vendors/datatables.net-buttons/js/buttons.flash.min.js\"></script>
            <script src=\"";
        // line 356
        echo twig_escape_filter($this->env, ($context["CORE_ASSETS_ADMIN_WEB_ROOT"] ?? null), "html", null, true);
        echo "/vendors/datatables.net-buttons/js/buttons.html5.min.js\"></script>
            <script src=\"";
        // line 357
        echo twig_escape_filter($this->env, ($context["CORE_ASSETS_ADMIN_WEB_ROOT"] ?? null), "html", null, true);
        echo "/vendors/datatables.net-buttons/js/buttons.print.min.js\"></script>
            <script src=\"";
        // line 358
        echo twig_escape_filter($this->env, ($context["CORE_ASSETS_ADMIN_WEB_ROOT"] ?? null), "html", null, true);
        echo "/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js\"></script>
            <script src=\"";
        // line 359
        echo twig_escape_filter($this->env, ($context["CORE_ASSETS_ADMIN_WEB_ROOT"] ?? null), "html", null, true);
        echo "/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js\"></script>
            <script src=\"";
        // line 360
        echo twig_escape_filter($this->env, ($context["CORE_ASSETS_ADMIN_WEB_ROOT"] ?? null), "html", null, true);
        echo "/vendors/datatables.net-responsive/js/dataTables.responsive.min.js\"></script>
            <script src=\"";
        // line 361
        echo twig_escape_filter($this->env, ($context["CORE_ASSETS_ADMIN_WEB_ROOT"] ?? null), "html", null, true);
        echo "/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js\"></script>
            <script src=\"";
        // line 362
        echo twig_escape_filter($this->env, ($context["CORE_ASSETS_ADMIN_WEB_ROOT"] ?? null), "html", null, true);
        echo "/vendors/datatables.net-scroller/js/dataTables.scroller.min.js\"></script>
            <script src=\"";
        // line 363
        echo twig_escape_filter($this->env, ($context["CORE_ASSETS_ADMIN_WEB_ROOT"] ?? null), "html", null, true);
        echo "/vendors/jszip/dist/jszip.min.js\"></script>
            <script src=\"";
        // line 364
        echo twig_escape_filter($this->env, ($context["CORE_ASSETS_ADMIN_WEB_ROOT"] ?? null), "html", null, true);
        echo "/vendors/pdfmake/build/pdfmake.min.js\"></script>
            <script src=\"";
        // line 365
        echo twig_escape_filter($this->env, ($context["CORE_ASSETS_ADMIN_WEB_ROOT"] ?? null), "html", null, true);
        echo "/vendors/pdfmake/build/vfs_fonts.js\"></script>

            <!-- jQuery Tags Input -->
            <script src=\"";
        // line 368
        echo twig_escape_filter($this->env, ($context["CORE_ASSETS_ADMIN_WEB_ROOT"] ?? null), "html", null, true);
        echo "/vendors/jquery.tagsinput/src/jquery.tagsinput.js\"></script>

            <!-- Typeahead/autocomplete -->
            <script src=\"";
        // line 371
        echo twig_escape_filter($this->env, ($context["CORE_ASSETS_ADMIN_WEB_ROOT"] ?? null), "html", null, true);
        echo "/vendors/typeahead/bootstrap3-typeahead.min.js\"></script>

            <!-- bootstrap-daterangepicker -->
            <script src=\"";
        // line 374
        echo twig_escape_filter($this->env, ($context["CORE_ASSETS_ADMIN_WEB_ROOT"] ?? null), "html", null, true);
        echo "/vendors/moment/moment.js\"></script>
            <script src=\"";
        // line 375
        echo twig_escape_filter($this->env, ($context["CORE_ASSETS_ADMIN_WEB_ROOT"] ?? null), "html", null, true);
        echo "/vendors/bootstrap-daterangepicker/daterangepicker.js\"></script>

            <!-- Custom Theme Scripts -->
            <script src=\"";
        // line 378
        echo twig_escape_filter($this->env, ($context["CORE_ASSETS_ADMIN_WEB_ROOT"] ?? null), "html", null, true);
        echo "/js/custom.js\"></script>

        </div>
    </div>
</body>
</html>
";
    }

    // line 56
    public function block_head_css($context, array $blocks = [])
    {
        $macros = $this->macros;
    }

    // line 70
    public function block_head_js($context, array $blocks = [])
    {
        $macros = $this->macros;
    }

    // line 313
    public function block_body($context, array $blocks = [])
    {
        $macros = $this->macros;
    }

    public function getTemplateName()
    {
        return "admin/partial/layout_logged_in.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  1059 => 313,  1053 => 70,  1047 => 56,  1036 => 378,  1030 => 375,  1026 => 374,  1020 => 371,  1014 => 368,  1008 => 365,  1004 => 364,  1000 => 363,  996 => 362,  992 => 361,  988 => 360,  984 => 359,  980 => 358,  976 => 357,  972 => 356,  968 => 355,  964 => 354,  960 => 353,  956 => 352,  952 => 351,  946 => 348,  942 => 347,  938 => 346,  932 => 343,  926 => 340,  922 => 339,  916 => 336,  893 => 320,  881 => 317,  876 => 314,  874 => 313,  860 => 304,  856 => 303,  848 => 302,  837 => 298,  813 => 279,  805 => 276,  795 => 269,  788 => 264,  785 => 263,  780 => 260,  775 => 251,  772 => 250,  769 => 249,  767 => 248,  762 => 245,  751 => 239,  745 => 238,  739 => 237,  733 => 236,  727 => 235,  721 => 234,  713 => 233,  707 => 232,  701 => 231,  696 => 229,  688 => 226,  679 => 222,  673 => 221,  667 => 220,  662 => 218,  657 => 215,  644 => 213,  640 => 212,  635 => 210,  629 => 207,  625 => 206,  616 => 202,  610 => 201,  604 => 200,  599 => 198,  595 => 197,  586 => 193,  580 => 192,  574 => 191,  566 => 190,  561 => 188,  557 => 187,  548 => 183,  542 => 182,  539 => 181,  530 => 178,  516 => 177,  506 => 175,  503 => 174,  486 => 173,  483 => 172,  481 => 171,  477 => 170,  469 => 167,  463 => 164,  458 => 163,  456 => 162,  453 => 161,  444 => 157,  438 => 156,  433 => 154,  428 => 153,  426 => 152,  417 => 148,  411 => 147,  406 => 145,  402 => 144,  399 => 143,  390 => 139,  382 => 136,  376 => 135,  371 => 133,  364 => 131,  358 => 130,  353 => 128,  348 => 127,  346 => 126,  342 => 124,  335 => 122,  331 => 121,  322 => 117,  311 => 116,  301 => 114,  298 => 113,  289 => 111,  283 => 110,  279 => 109,  273 => 108,  268 => 106,  264 => 105,  257 => 103,  253 => 102,  238 => 90,  229 => 86,  217 => 79,  207 => 71,  205 => 70,  200 => 68,  195 => 66,  190 => 64,  183 => 60,  179 => 59,  175 => 57,  173 => 56,  170 => 55,  164 => 53,  162 => 52,  155 => 48,  149 => 45,  145 => 44,  141 => 43,  135 => 40,  131 => 39,  127 => 38,  122 => 36,  118 => 35,  114 => 34,  110 => 33,  106 => 32,  101 => 30,  96 => 28,  91 => 26,  86 => 24,  81 => 22,  76 => 20,  71 => 18,  67 => 17,  62 => 15,  57 => 13,  51 => 10,  40 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "admin/partial/layout_logged_in.html.twig", "/var/www/html/medicalimage/app/views/admin/partial/layout_logged_in.html.twig");
    }
}
