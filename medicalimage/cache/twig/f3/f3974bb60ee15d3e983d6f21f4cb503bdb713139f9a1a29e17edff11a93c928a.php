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

/* account/partial/layout_logged_in.html.twig */
class __TwigTemplate_5226fad8114e4f7caa9a26b0c23e1d77a9fd433b2999e65b08e15b76300e5550 extends \Twig\Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
            'body' => [$this, 'block_body'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        echo "<!DOCTYPE html>
<html lang=\"en\" dir=\"";
        // line 2
        echo twig_escape_filter($this->env, twig_upper_filter($this->env, ($context["SITE_LANGUAGE_DIRECTION"] ?? null)), "html", null, true);
        echo "\" class=\"direction";
        echo twig_escape_filter($this->env, twig_capitalize_string_filter($this->env, ($context["SITE_LANGUAGE_DIRECTION"] ?? null)), "html", null, true);
        echo " ";
        if (        $this->hasBlock("html_element_class", $context, $blocks)) {
            $this->displayBlock("html_element_class", $context, $blocks);
        }
        echo "\">
    <head>
        <meta charset=\"utf-8\">
        <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
        <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"/>
        <title>";
        // line 7
        $this->displayBlock("title", $context, $blocks);
        echo " - ";
        echo twig_escape_filter($this->env, ($context["SITE_CONFIG_SITE_NAME"] ?? null), "html", null, true);
        echo "</title>
        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\" />
        <meta name=\"description\" content=\"";
        // line 9
        $this->displayBlock("description", $context, $blocks);
        echo "\" />
        <meta name=\"keywords\" content=\"";
        // line 10
        $this->displayBlock("keywords", $context, $blocks);
        echo "\" />
        <meta name=\"copyright\" content=\"Copyright &copy; - ";
        // line 11
        echo twig_escape_filter($this->env, ($context["SITE_CONFIG_SITE_NAME"] ?? null), "html", null, true);
        echo "\" />
        <meta name=\"robots\" content=\"all\" />
        <meta http-equiv=\"Cache-Control\" content=\"no-cache\" />
        <meta http-equiv=\"Expires\" content=\"-1\" />
        <meta http-equiv=\"Pragma\" content=\"no-cache\" />

        <!-- og meta tags -->
        ";
        // line 18
        if ((isset($context["PAGE_OG_TITLE"]) || array_key_exists("PAGE_OG_TITLE", $context))) {
            // line 19
            echo "            <meta property=\"og:title\" content=\"";
            echo twig_escape_filter($this->env, ($context["PAGE_OG_TITLE"] ?? null), "html", null, true);
            echo "\" />
        ";
        }
        // line 21
        echo "        ";
        if ((isset($context["PAGE_OG_IMAGE"]) || array_key_exists("PAGE_OG_IMAGE", $context))) {
            // line 22
            echo "            <meta property=\"og:image\" content=\"";
            echo twig_escape_filter($this->env, ($context["PAGE_OG_IMAGE"] ?? null), "html", null, true);
            echo ">\" />
        ";
        } else {
            // line 24
            echo "            <meta property=\"og:image\" content=\"";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountImagePath", [], "method", false, false, false, 24), "html", null, true);
            echo "/favicon/ms-icon-144x144.png\" />
        ";
        }
        // line 26
        echo "        <meta property=\"og:type\" content=\"website\" />

        <!-- fav and touch icons -->
        <link rel=\"icon\" type=\"image/x-icon\" href=\"";
        // line 29
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountImagePath", [], "method", false, false, false, 29), "html", null, true);
        echo "/favicon/favicon.ico\" />
        <link rel=\"icon\" type=\"image/png\" sizes=\"96x96\" href=\"";
        // line 30
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountImagePath", [], "method", false, false, false, 30), "html", null, true);
        echo "/favicon/favicon-96x96.png\">
        <link rel=\"apple-touch-icon\" sizes=\"152x152\" href=\"";
        // line 31
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountImagePath", [], "method", false, false, false, 31), "html", null, true);
        echo "/favicon/apple-icon-152x152.png\">
        <link rel=\"manifest\" href=\"";
        // line 32
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountImagePath", [], "method", false, false, false, 32), "html", null, true);
        echo "/favicon/manifest.json\">
        <meta name=\"msapplication-TileImage\" content=\"";
        // line 33
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountImagePath", [], "method", false, false, false, 33), "html", null, true);
        echo "/favicon/ms-icon-144x144.png\">
        <meta name=\"msapplication-TileColor\" content=\"#ffffff\">
        <meta name=\"theme-color\" content=\"#ffffff\">

        <link rel=\"stylesheet\" href=\"";
        // line 37
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountCssPath", [], "method", false, false, false, 37), "html", null, true);
        echo "/fonts.css\" />
        <link rel=\"stylesheet\" href=\"";
        // line 38
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountCssPath", [], "method", false, false, false, 38), "html", null, true);
        echo "/font-icons/entypo/css/entypo.css\" />
        <link rel=\"stylesheet\" href=\"";
        // line 39
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountCssPath", [], "method", false, false, false, 39), "html", null, true);
        echo "/font-icons/font-awesome/css/font-awesome.min.css\" />
        <link rel=\"stylesheet\" href=\"";
        // line 40
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountCssPath", [], "method", false, false, false, 40), "html", null, true);
        echo "/bootstrap.css\" />
        ";
        // line 41
        if ((twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getThemeSkin", [], "method", false, false, false, 41) != false)) {
            // line 42
            echo "            <link rel=\"stylesheet\" href=\"";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountCssPath", [], "method", false, false, false, 42), "html", null, true);
            echo "/skins/";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getThemeSkin", [], "method", false, false, false, 42), "html", null, true);
            echo "\" />
        ";
        } else {
            // line 44
            echo "            <link rel=\"stylesheet\" href=\"";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountCssPath", [], "method", false, false, false, 44), "html", null, true);
            echo "/skins/default.css\" />
        ";
        }
        // line 46
        echo "        <link rel=\"stylesheet\" href=\"";
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountCssPath", [], "method", false, false, false, 46), "html", null, true);
        echo "/core.css\" />
        <link rel=\"stylesheet\" href=\"";
        // line 47
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountCssPath", [], "method", false, false, false, 47), "html", null, true);
        echo "/theme.css\" />
        <link rel=\"stylesheet\" href=\"";
        // line 48
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountCssPath", [], "method", false, false, false, 48), "html", null, true);
        echo "/forms.css\" />
        <link rel=\"stylesheet\" href=\"";
        // line 49
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountCssPath", [], "method", false, false, false, 49), "html", null, true);
        echo "/responsive.css\" />
        ";
        // line 50
        if ((($context["SITE_LANGUAGE_DIRECTION"] ?? null) == "RTL")) {
            // line 51
            echo "            <link rel=\"stylesheet\" href=\"";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountCssPath", [], "method", false, false, false, 51), "html", null, true);
            echo "/rtl.css\" />
        ";
        }
        // line 53
        echo "        <link rel=\"stylesheet\" href=\"";
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountCssPath", [], "method", false, false, false, 53), "html", null, true);
        echo "/daterangepicker-bs3.css\" />
        <link rel=\"stylesheet\" href=\"";
        // line 54
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountCssPath", [], "method", false, false, false, 54), "html", null, true);
        echo "/custom.css\" />
        <link rel=\"stylesheet\" href=\"";
        // line 55
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountCssPath", [], "method", false, false, false, 55), "html", null, true);
        echo "/file-upload.css\" />
        <link rel=\"stylesheet\" href=\"";
        // line 56
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountCssPath", [], "method", false, false, false, 56), "html", null, true);
        echo "/search_widget.css\" />
        <link rel=\"stylesheet\" type=\"text/css\"  href=\"";
        // line 57
        echo twig_escape_filter($this->env, ($context["PLUGIN_WEB_ROOT"] ?? null), "html", null, true);
        echo "/filepreviewer/assets/players/ultimate/content/global.css\"/>
        ";
        // line 58
        echo twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "outputCustomCSSCode", [], "method", false, false, false, 58);
        echo "

        <script src=\"";
        // line 60
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 60), "html", null, true);
        echo "/jquery-1.11.0.min.js\"></script>
        <script type=\"text/javascript\" src=\"";
        // line 61
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 61), "html", null, true);
        echo "/jquery.ckie.js\"></script>
        <script type=\"text/javascript\" src=\"";
        // line 62
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 62), "html", null, true);
        echo "/jquery.jstree.js\"></script>
        <script type=\"text/javascript\" src=\"";
        // line 63
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 63), "html", null, true);
        echo "/jquery.event.drag-2.2.js\"></script>
        <script type=\"text/javascript\" src=\"";
        // line 64
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 64), "html", null, true);
        echo "/jquery.event.drag.live-2.2.js\"></script>
        <script type=\"text/javascript\" src=\"";
        // line 65
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 65), "html", null, true);
        echo "/jquery.event.drop-2.2.js\"></script>
        <script type=\"text/javascript\" src=\"";
        // line 66
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 66), "html", null, true);
        echo "/jquery.event.drop.live-2.2.js\"></script>

        <link rel=\"stylesheet\" href=\"";
        // line 68
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountCssPath", [], "method", false, false, false, 68), "html", null, true);
        echo "/file_browser_sprite_48px.css\" type=\"text/css\" charset=\"utf-8\" />

        <link rel=\"stylesheet\" type=\"text/css\" href=\"";
        // line 70
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 70), "html", null, true);
        echo "/slick/slick.css\"/>

        <link rel=\"stylesheet\" type=\"text/css\" href=\"";
        // line 72
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 72), "html", null, true);
        echo "/slick/slick-theme.css\"/>
        <script type=\"text/javascript\" src=\"";
        // line 73
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 73), "html", null, true);
        echo "/slick/slick.js\"></script>

        <link rel=\"stylesheet\" type=\"text/css\" href=\"";
        // line 75
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 75), "html", null, true);
        echo "/photo-swipe/photoswipe.css\"/>
        <link rel=\"stylesheet\" type=\"text/css\" href=\"";
        // line 76
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 76), "html", null, true);
        echo "/photo-swipe/default-skin/default-skin.css\"/>
        <script type=\"text/javascript\" src=\"";
        // line 77
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 77), "html", null, true);
        echo "/photo-swipe/photoswipe.min.js\"></script>
        <script type=\"text/javascript\" src=\"";
        // line 78
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 78), "html", null, true);
        echo "/photo-swipe/photoswipe-ui-default.min.js\"></script>

        <!-- mobile swipe navigation -->
        <script type=\"text/javascript\" src=\"";
        // line 81
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 81), "html", null, true);
        echo "/jquery.touchSwipe.min.js\"></script>

        <script type=\"text/javascript\" src=\"";
        // line 83
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 83), "html", null, true);
        echo "/evolution.js\"></script>
        <script type=\"text/javascript\" src=\"";
        // line 84
        echo twig_escape_filter($this->env, ($context["CORE_SITE_PATH"] ?? null), "html", null, true);
        echo "/assets/js/uploader.js?r=";
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_date_converter($this->env), "timestamp", [], "any", false, false, false, 84), "html", null, true);
        echo "\"></script>

        <!--[if lt IE 9]><script src=\"";
        // line 86
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 86), "html", null, true);
        echo "/ie8-responsive-file-warning.js\"></script><![endif]-->

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
                <script src=\"https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js\"></script>
                <script src=\"https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js\"></script>
        <![endif]-->

        <script type=\"text/javascript\">
            document.domain = '";
        // line 95
        echo twig_escape_filter($this->env, ($context["documentDomain"] ?? null), "html", null, true);
        echo "';
            var ACCOUNT_WEB_ROOT = \"";
        // line 96
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountWebRoot", [], "method", false, false, false, 96), "html", null, true);
        echo "\";
            var SITE_THEME_WEB_ROOT = \"";
        // line 97
        echo twig_escape_filter($this->env, ($context["SITE_THEME_WEB_ROOT"] ?? null), "html", null, true);
        echo "\";
            var SITE_CSS_PATH = \"";
        // line 98
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountCssPath", [], "method", false, false, false, 98), "html", null, true);
        echo "\";
            var SITE_IMAGE_PATH = \"";
        // line 99
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountImagePath", [], "method", false, false, false, 99), "html", null, true);
        echo "\";
            var _CONFIG_SITE_PROTOCOL = \"";
        // line 100
        echo twig_escape_filter($this->env, ($context["_CONFIG_SITE_PROTOCOL"] ?? null), "html", null, true);
        echo "\";
            var CORE_AJAX_WEB_ROOT = \"";
        // line 101
        echo twig_escape_filter($this->env, ($context["CORE_AJAX_WEB_ROOT"] ?? null), "html", null, true);
        echo "\";
            var LOGGED_IN = ";
        // line 102
        if ((twig_get_attribute($this->env, $this->source, ($context["Auth"] ?? null), "loggedIn", [], "method", false, false, false, 102) == "true")) {
            echo "true";
        } else {
            echo "false";
        }
        echo ";
        </script>
        <script type=\"text/javascript\" src=\"";
        // line 104
        echo twig_escape_filter($this->env, ($context["CORE_SITE_PATH"] ?? null), "html", null, true);
        echo "/js/translations.js\"></script>
        <script type=\"text/javascript\" src=\"";
        // line 105
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 105), "html", null, true);
        echo "/jquery-ui.js\"></script>
        <script type=\"text/javascript\" src=\"";
        // line 106
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 106), "html", null, true);
        echo "/jquery.dataTables.min.js\"></script>
        <script type=\"text/javascript\" src=\"";
        // line 107
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 107), "html", null, true);
        echo "/jquery.tmpl.min.js\"></script>
        <script type=\"text/javascript\" src=\"";
        // line 108
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 108), "html", null, true);
        echo "/load-image.min.js\"></script>
        <script type=\"text/javascript\" src=\"";
        // line 109
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 109), "html", null, true);
        echo "/canvas-to-blob.min.js\"></script>
        <script type=\"text/javascript\" src=\"";
        // line 110
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 110), "html", null, true);
        echo "/jquery.iframe-transport.js\"></script>
        <script type=\"text/javascript\" src=\"";
        // line 111
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 111), "html", null, true);
        echo "/jquery.fileupload.js\"></script>
        <script type=\"text/javascript\" src=\"";
        // line 112
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 112), "html", null, true);
        echo "/jquery.fileupload-process.js\"></script>
        <script type=\"text/javascript\" src=\"";
        // line 113
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 113), "html", null, true);
        echo "/jquery.fileupload-resize.js\"></script>
        <script type=\"text/javascript\" src=\"";
        // line 114
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 114), "html", null, true);
        echo "/jquery.fileupload-validate.js\"></script>
        <script type=\"text/javascript\" src=\"";
        // line 115
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 115), "html", null, true);
        echo "/jquery.fileupload-ui.js\"></script>
        <script type=\"text/javascript\" src=\"";
        // line 116
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 116), "html", null, true);
        echo "/zeroClipboard/ZeroClipboard.js\"></script>
        <script type=\"text/javascript\" src=\"";
        // line 117
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 117), "html", null, true);
        echo "/daterangepicker/moment.min.js\"></script>
        <script type=\"text/javascript\" src=\"";
        // line 118
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 118), "html", null, true);
        echo "/daterangepicker/daterangepicker.js\"></script>
        <script type=\"text/javascript\" src=\"";
        // line 119
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 119), "html", null, true);
        echo "/charts/Chart.js\"></script>
        <script type=\"text/javascript\" src=\"";
        // line 120
        echo twig_escape_filter($this->env, ($context["PLUGIN_WEB_ROOT"] ?? null), "html", null, true);
        echo "/filepreviewer/assets/players/ultimate/java/FWDUVPlayer.js\"></script>
        <script type=\"text/javascript\" src=\"";
        // line 121
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 121), "html", null, true);
        echo "/global.js\"></script>
        ";
        // line 122
        $this->loadTemplate("account/partial/account_home_javascript.html.twig", "account/partial/layout_logged_in.html.twig", 122)->display($context);
        // line 123
        echo "    </head>
    <body class=\"page-body\">
        <div class=\"page-container horizontal-menu with-sidebar fit-logo-with-sidebar ";
        // line 125
        if ((twig_get_attribute($this->env, $this->source, ($context["Auth"] ?? null), "loggedIn", [], "method", false, false, false, 125) == true)) {
            echo "logged-in";
        } else {
            echo "logged-out";
        }
        echo "\">\t

            <div class=\"sidebar-menu fixed\">
                <div class=\"sidebar-mobile-menu visible-xs\"> <a href=\"#\" class=\"with-animation\"><i class=\"entypo-menu\"></i> </a> </div>
                ";
        // line 129
        if ((($context["userAllowedToUpload"] ?? null) == true)) {
            // line 130
            echo "                    <div class=\"sidebar-mobile-upload visible-xs\"><a href=\"#\" onClick=\"uploadFiles();
                        return false;\">";
            // line 131
            echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("upload_account", "Upload"), "html", null, true);
            echo "&nbsp;&nbsp;<span class=\"glyphicon glyphicon-cloud-upload\"></span></a> </div>
                        ";
        }
        // line 133
        echo "
                <!-- logo -->
                <div class=\"siderbar-logo\">
                    <a href=\"http://image.radmed.co.id/\">
                        <img src=\"";
        // line 137
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getMainLogoUrl", [], "method", false, false, false, 137), "html", null, true);
        echo "\" alt=\"";
        echo twig_escape_filter($this->env, ($context["SITE_CONFIG_SITE_NAME"] ?? null), "html", null, true);
        echo "\" />
                    </a>
                </div>
                <div id=\"folderTreeview\"></div>
                <div class=\"clear\"></div>
            </div>

            ";
        // line 144
        if ((twig_get_attribute($this->env, $this->source, ($context["Auth"] ?? null), "is_mobile", [], "method", false, false, false, 144) == true)) {
            echo "<header class=\"navbar navbar-fixed-top\" asu style=\"display: none;\">";
        } else {
            echo "<header asu class=\"navbar navbar-fixed-top\">";
        }
        echo "<!-- set fixed position by adding class \"navbar-fixed-top\" -->
                <div class=\"navbar-inner\">
                    ";
        // line 146
        if ((twig_get_attribute($this->env, $this->source, ($context["Auth"] ?? null), "loggedIn", [], "method", false, false, false, 146) == true)) {
            // line 147
            echo "                        <form autocomplete=\"off\">
                            <div class=\"navbar-form navbar-form-sm navbar-left shift\" ui-shift=\"prependTo\" data-target=\".navbar-collapse\" role=\"search\">
                                <div class=\"form-group\">
                                    <div class=\"input-group\" id=\"top-search\">
                                        <input name=\"searchInput\" id=\"searchInput\" type=\"text\" value=\"";
            // line 151
            echo twig_escape_filter($this->env, ($context["t"] ?? null), "html", null, true);
            echo "\" class=\"form-control input-sm bg-light no-border rounded padder typeahead\" placeholder=\"";
            echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("account_header_search_your_files", "Search your files..."));
            echo "\" onKeyUp=\"handleTopSearch(event, this); return false;\"/>
                                        <span class=\"input-group-btn\">
                                            <button type=\"submit\" class=\"btn btn-sm bg-light rounded\" onClick=\"handleTopSearch(null, \$('#searchInput'));
                                                return false;\" title=\"\" data-original-title=\"";
            // line 154
            echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("filter", "Filter"), "html", null, true);
            echo "\" data-placement=\"bottom\" data-toggle=\"tooltip\"><i class=\"entypo-search\"></i></button>
                                            <button type=\"submit\" class=\"btn btn-sm bg-light rounded\" onClick=\"showFilterModal();
                                                return false;\" title=\"\" data-original-title=\"";
            // line 156
            echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("advanced_search", "Advanced Search"), "html", null, true);
            echo "\" data-placement=\"bottom\" data-toggle=\"tooltip\"><i class=\"entypo-cog\"></i></button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </form>
                    ";
        } else {
            // line 163
            echo "                        <div class=\"navbar-form navbar-form-sm navbar-left shift non-logged-in-logo\">
                            <a href=\"";
            // line 164
            echo twig_escape_filter($this->env, ($context["CORE_SITE_PATH"] ?? null), "html", null, true);
            echo "/\">
                                <img src=\"";
            // line 165
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getInverseLogoUrl", [], "method", false, false, false, 165), "html", null, true);
            echo "\" alt=\"";
            echo twig_escape_filter($this->env, ($context["SITE_CONFIG_SITE_NAME"] ?? null), "html", null, true);
            echo "\" />
                            </a>
                        </div>
                    ";
        }
        // line 169
        echo "
                    ";
        // line 170
        if ((($context["userAllowedToUpload"] ?? null) == true)) {
            // line 171
            echo "                        <div class=\"upload-button-wrapper pull-left\" style=\"display: none;\">
                            <button class=\"btn btn-green\" type=\"button\" onClick=\"uploadFiles();
                                return false;\">";
            // line 173
            echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("upload_account", "Upload"), "html", null, true);
            echo "&nbsp;&nbsp;<span class=\"glyphicon glyphicon-cloud-upload\"></span></button>
                        </div>
                    ";
        }
        // line 176
        echo "
                    <div class=\"header-home-button pull-left\">
                        <a href=\"";
        // line 178
        if (((isset($context["sharekeyOriginalUrl"]) || array_key_exists("sharekeyOriginalUrl", $context)) && (twig_get_attribute($this->env, $this->source, ($context["Auth"] ?? null), "loggedIn", [], "method", false, false, false, 178) == false))) {
            echo twig_escape_filter($this->env, ($context["sharekeyOriginalUrl"] ?? null), "html", null, true);
        } else {
            echo "#";
        }
        echo "\" onClick=\"";
        echo ((twig_get_attribute($this->env, $this->source, ($context["Auth"] ?? null), "loggedIn", [], "method", false, false, false, 178)) ? ("loadImages(currentPageType, -1, 1); return false;") : (""));
        echo "\">
                            <i class=\"glyphicon glyphicon-home\"></i>
                        </a>
                    </div>

                    <ul class=\"mobile-account-toolbar-wrapper nav navbar-right pull-right\">

                        ";
        // line 185
        if ((twig_get_attribute($this->env, $this->source, ($context["Auth"] ?? null), "loggedIn", [], "method", false, false, false, 185) == true)) {
            // line 186
            echo "                            ";
            if ((twig_get_attribute($this->env, $this->source, ($context["Auth"] ?? null), "package_id", [], "any", false, false, false, 186) == 20)) {
                // line 187
                echo "                                <li class=\"root-level responsive-Hide\">
                                    <a href=\"";
                // line 188
                echo twig_escape_filter($this->env, ($context["ADMIN_WEB_ROOT"] ?? null), "html", null, true);
                echo "/\" target=\"_blank\">
                                        <span class=\"badge badge-danger badge-roundless\">";
                // line 189
                echo twig_escape_filter($this->env, twig_upper_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("admin_user", "Admin User")), "html", null, true);
                echo "</span>
                                    </a>
                                </li>
                            ";
            }
            // line 193
            echo "
                            <li class=\"dropdown account-nav-icon\">
                                <a href=\"#\" data-toggle=\"dropdown\" class=\"dropdown-toggle clear\">
                                    <span class=\"thumb-sm avatar pull-right\">
                                        <img width=\"40\" height=\"40\" class=\"img-circle\" alt=\"";
            // line 197
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["Auth"] ?? null), "getAccountScreenName", [], "method", false, false, false, 197), "html", null, true);
            echo "\" src=\"";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["Auth"] ?? null), "user", [], "any", false, false, false, 197), "getAvatarUrl", [], "method", false, false, false, 197), "html", null, true);
            echo "\"/>
                                    </span>
                                    <span class=\"user-screen-name hidden-sm hidden-md\">";
            // line 199
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["Auth"] ?? null), "getAccountScreenName", [], "method", false, false, false, 199), "html", null, true);
            echo "</span> <b class=\"caret\"></b>
                                </a>
                                <!-- dropdown -->
                                <ul class=\"dropdown-menu\">
                                    <li class=\"account-menu bg-light\" title=\"";
            // line 203
            if ((($context["totalFileStorage"] ?? null) > 0)) {
                echo twig_escape_filter($this->env, ($context["storagePercentage"] ?? null), "html", null, true);
            } else {
                echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("unlimited", "unlimited")), "html", null, true);
            }
            echo "\" onClick=\"window.location = '";
            echo twig_escape_filter($this->env, ($context["CORE_SITE_PATH"] ?? null), "html", null, true);
            echo "/account/edit';\" style=\"cursor: pointer;\">
                                        <div>
                                            <p>
                                                ";
            // line 206
            if ((($context["totalFileStorage"] ?? null) > 0)) {
                // line 207
                echo "                                                    <span><span id=\"totalActiveFileSize\">";
                echo twig_escape_filter($this->env, ($context["totalActiveFileSizeBoth"] ?? null), "html", null, true);
                echo "</span> ";
                echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("of", "of"), "html", null, true);
                echo " ";
                echo twig_escape_filter($this->env, ($context["totalFileStorageBoth"] ?? null), "html", null, true);
                echo " ";
                echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("used", "used"), "html", null, true);
                echo "</span>
                                                ";
            } else {
                // line 209
                echo "                                                    <span><span id=\"totalActiveFileSize\">";
                echo twig_escape_filter($this->env, ($context["totalActiveFileSizeBoth"] ?? null), "html", null, true);
                echo "</span> ";
                echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("of", "of"), "html", null, true);
                echo " ";
                echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("unlimited", "unlimited")), "html", null, true);
                echo "</span>
                                                ";
            }
            // line 211
            echo "                                            </p>
                                        </div>
                                        <div class=\"progress progress-xs m-b-none dker\">
                                            <div style=\"width: ";
            // line 214
            echo twig_escape_filter($this->env, ($context["storagePercentage"] ?? null), "html", null, true);
            echo "%\" aria-valuemax=\"100\" aria-valuemin=\"0\" aria-valuenow=\"";
            echo twig_escape_filter($this->env, ($context["storagePercentage"] ?? null), "html", null, true);
            echo "\" role=\"progressbar\" class=\"progress-bar progress-bar-success\"></div>
                                        </div>
                                    </li>
                                    <li>
                                        <a href=\"";
            // line 218
            echo twig_escape_filter($this->env, ($context["CORE_SITE_PATH"] ?? null), "html", null, true);
            echo "/account/edit\"> <i class=\"entypo-cog\"></i>";
            echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("file_manager_account_settings", "Account Settings"), "html", null, true);
            echo "</a>
                                    </li>
                                    <li>
                                        <a href=\"";
            // line 221
            echo twig_escape_filter($this->env, ($context["CORE_SITE_PATH"] ?? null), "html", null, true);
            echo "/account/shared_with_me\"></i> <i class=\"entypo-users\"></i>";
            echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("shared_files", "Shared Files"), "html", null, true);
            echo "</a>
                                    </li>
                                    <li>
                                        <a href=\"";
            // line 224
            echo twig_escape_filter($this->env, ($context["CORE_SITE_PATH"] ?? null), "html", null, true);
            echo "/account/trash\"></i> <i class=\"entypo-trash\"></i>";
            echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("trash_can", "Trash Can"), "html", null, true);
            echo "</a>
                                    </li>
                                    <li class=\"divider\"></li>
                                        ";
            // line 227
            if ((twig_get_attribute($this->env, $this->source, ($context["Auth"] ?? null), "package_id", [], "any", false, false, false, 227) == 20)) {
                // line 228
                echo "                                        <li>
                                            <a href=\"";
                // line 229
                echo twig_escape_filter($this->env, ($context["ADMIN_WEB_ROOT"] ?? null), "html", null, true);
                echo "/\" target=\"_blank\"></i> <i class=\"entypo-user\"></i>";
                echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("admin_area_link", "Admin Area"), "html", null, true);
                echo "</a>
                                        </li>
                                        <li class=\"divider\"></li>
                                        ";
            }
            // line 233
            echo "                                    <li>
                                        <a href=\"";
            // line 234
            echo twig_escape_filter($this->env, ($context["CORE_SITE_PATH"] ?? null), "html", null, true);
            echo "/account/logout\"> <i class=\"entypo-logout\"></i>";
            echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("file_manager_logout", "Logout"), "html", null, true);
            echo "</a>
                                    </li>
                                </ul>
                                <!-- / dropdown -->
                            </li>
                        ";
        } else {
            // line 240
            echo "                            <li>
                                <a href=\"";
            // line 241
            echo twig_escape_filter($this->env, ($context["CORE_SITE_PATH"] ?? null), "html", null, true);
            echo "/account/login\">
                                    <i class=\"entypo-lock\"></i>
                                    ";
            // line 243
            echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("login", "login")), "html", null, true);
            echo "
                                </a>
                            </li>
                        ";
        }
        // line 247
        echo "                    </ul>
                </div>
            </header>

            <div id=\"main-ajax-container\" class=\"layer\"></div>

        ";
        // line 253
        $this->displayBlock('body', $context, $blocks);
        // line 254
        echo "
    </div>

";
        // line 257
        $this->loadTemplate("account/partial/layout_logged_in.html.twig", "account/partial/layout_logged_in.html.twig", 257, "844704104")->display($context);
        // line 258
        echo "
<!-- Bottom Scripts -->
<script type=\"text/javascript\" src=\"";
        // line 260
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 260), "html", null, true);
        echo "/gsap/main-gsap.js\"></script>
<script type=\"text/javascript\" src=\"";
        // line 261
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 261), "html", null, true);
        echo "/bootstrap.js\"></script>
<script type=\"text/javascript\" src=\"";
        // line 262
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 262), "html", null, true);
        echo "/joinable.js\"></script>
<script type=\"text/javascript\" src=\"";
        // line 263
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 263), "html", null, true);
        echo "/resizeable.js\"></script>
<script type=\"text/javascript\" src=\"";
        // line 264
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 264), "html", null, true);
        echo "/evolution-api.js\"></script>
<script type=\"text/javascript\" src=\"";
        // line 265
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 265), "html", null, true);
        echo "/toastr.js\"></script>
<script type=\"text/javascript\" src=\"";
        // line 266
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 266), "html", null, true);
        echo "/custom.js\"></script>
<script type=\"text/javascript\" src=\"";
        // line 267
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 267), "html", null, true);
        echo "/handlebars.js\"></script>
<script type=\"text/javascript\" src=\"";
        // line 268
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 268), "html", null, true);
        echo "/typeahead.bundle.js\"></script>
<script type=\"text/javascript\" src=\"";
        // line 269
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 269), "html", null, true);
        echo "/search_widget.js\"></script>
<script type=\"text/javascript\" src=\"";
        // line 270
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 270), "html", null, true);
        echo "/clipboardjs/clipboard.min.js\"></script>
<script type=\"text/javascript\" src=\"";
        // line 271
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 271), "html", null, true);
        echo "/bootstrap-tagsinput.min.js\"></script>

<script src=\"";
        // line 273
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 273), "html", null, true);
        echo "/file-manager-gallery/jquery.wookmark.js\" type=\"text/javascript\"></script>

<div class=\"clipboard-placeholder-wrapper\">
    <button id=\"clipboard-placeholder-btn\" type=\"button\" data-clipboard-action=\"copy\" data-clipboard-target=\"#clipboard-placeholder\"></button>
    <div id=\"clipboard-placeholder\"></div>
</div>

";
        // line 280
        if (($context["SITE_CONFIG_GOOGLE_ANALYTICS_CODE"] ?? null)) {
            echo "SITE_CONFIG_GOOGLE_ANALYTICS_CODE";
        }
        // line 281
        echo "
</body>
";
        // line 283
        $this->loadTemplate("account/partial/notifications.html.twig", "account/partial/layout_logged_in.html.twig", 283)->display($context);
        // line 284
        echo "</html>";
    }

    // line 253
    public function block_body($context, array $blocks = [])
    {
        $macros = $this->macros;
    }

    public function getTemplateName()
    {
        return "account/partial/layout_logged_in.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  803 => 253,  799 => 284,  797 => 283,  793 => 281,  789 => 280,  779 => 273,  774 => 271,  770 => 270,  766 => 269,  762 => 268,  758 => 267,  754 => 266,  750 => 265,  746 => 264,  742 => 263,  738 => 262,  734 => 261,  730 => 260,  726 => 258,  724 => 257,  719 => 254,  717 => 253,  709 => 247,  702 => 243,  697 => 241,  694 => 240,  683 => 234,  680 => 233,  671 => 229,  668 => 228,  666 => 227,  658 => 224,  650 => 221,  642 => 218,  633 => 214,  628 => 211,  618 => 209,  606 => 207,  604 => 206,  592 => 203,  585 => 199,  578 => 197,  572 => 193,  565 => 189,  561 => 188,  558 => 187,  555 => 186,  553 => 185,  537 => 178,  533 => 176,  527 => 173,  523 => 171,  521 => 170,  518 => 169,  509 => 165,  505 => 164,  502 => 163,  492 => 156,  487 => 154,  479 => 151,  473 => 147,  471 => 146,  462 => 144,  450 => 137,  444 => 133,  439 => 131,  436 => 130,  434 => 129,  423 => 125,  419 => 123,  417 => 122,  413 => 121,  409 => 120,  405 => 119,  401 => 118,  397 => 117,  393 => 116,  389 => 115,  385 => 114,  381 => 113,  377 => 112,  373 => 111,  369 => 110,  365 => 109,  361 => 108,  357 => 107,  353 => 106,  349 => 105,  345 => 104,  336 => 102,  332 => 101,  328 => 100,  324 => 99,  320 => 98,  316 => 97,  312 => 96,  308 => 95,  296 => 86,  289 => 84,  285 => 83,  280 => 81,  274 => 78,  270 => 77,  266 => 76,  262 => 75,  257 => 73,  253 => 72,  248 => 70,  243 => 68,  238 => 66,  234 => 65,  230 => 64,  226 => 63,  222 => 62,  218 => 61,  214 => 60,  209 => 58,  205 => 57,  201 => 56,  197 => 55,  193 => 54,  188 => 53,  182 => 51,  180 => 50,  176 => 49,  172 => 48,  168 => 47,  163 => 46,  157 => 44,  149 => 42,  147 => 41,  143 => 40,  139 => 39,  135 => 38,  131 => 37,  124 => 33,  120 => 32,  116 => 31,  112 => 30,  108 => 29,  103 => 26,  97 => 24,  91 => 22,  88 => 21,  82 => 19,  80 => 18,  70 => 11,  66 => 10,  62 => 9,  55 => 7,  41 => 2,  38 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "account/partial/layout_logged_in.html.twig", "/var/www/html/medicalimage/themes/evolution/views/account/partial/layout_logged_in.html.twig");
    }
}


/* account/partial/layout_logged_in.html.twig */
class __TwigTemplate_5226fad8114e4f7caa9a26b0c23e1d77a9fd433b2999e65b08e15b76300e5550___844704104 extends \Twig\Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 257
        return "account/partial/site_js_html_containers.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $this->parent = $this->loadTemplate("account/partial/site_js_html_containers.html.twig", "account/partial/layout_logged_in.html.twig", 257);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    public function getTemplateName()
    {
        return "account/partial/layout_logged_in.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  849 => 257,  803 => 253,  799 => 284,  797 => 283,  793 => 281,  789 => 280,  779 => 273,  774 => 271,  770 => 270,  766 => 269,  762 => 268,  758 => 267,  754 => 266,  750 => 265,  746 => 264,  742 => 263,  738 => 262,  734 => 261,  730 => 260,  726 => 258,  724 => 257,  719 => 254,  717 => 253,  709 => 247,  702 => 243,  697 => 241,  694 => 240,  683 => 234,  680 => 233,  671 => 229,  668 => 228,  666 => 227,  658 => 224,  650 => 221,  642 => 218,  633 => 214,  628 => 211,  618 => 209,  606 => 207,  604 => 206,  592 => 203,  585 => 199,  578 => 197,  572 => 193,  565 => 189,  561 => 188,  558 => 187,  555 => 186,  553 => 185,  537 => 178,  533 => 176,  527 => 173,  523 => 171,  521 => 170,  518 => 169,  509 => 165,  505 => 164,  502 => 163,  492 => 156,  487 => 154,  479 => 151,  473 => 147,  471 => 146,  462 => 144,  450 => 137,  444 => 133,  439 => 131,  436 => 130,  434 => 129,  423 => 125,  419 => 123,  417 => 122,  413 => 121,  409 => 120,  405 => 119,  401 => 118,  397 => 117,  393 => 116,  389 => 115,  385 => 114,  381 => 113,  377 => 112,  373 => 111,  369 => 110,  365 => 109,  361 => 108,  357 => 107,  353 => 106,  349 => 105,  345 => 104,  336 => 102,  332 => 101,  328 => 100,  324 => 99,  320 => 98,  316 => 97,  312 => 96,  308 => 95,  296 => 86,  289 => 84,  285 => 83,  280 => 81,  274 => 78,  270 => 77,  266 => 76,  262 => 75,  257 => 73,  253 => 72,  248 => 70,  243 => 68,  238 => 66,  234 => 65,  230 => 64,  226 => 63,  222 => 62,  218 => 61,  214 => 60,  209 => 58,  205 => 57,  201 => 56,  197 => 55,  193 => 54,  188 => 53,  182 => 51,  180 => 50,  176 => 49,  172 => 48,  168 => 47,  163 => 46,  157 => 44,  149 => 42,  147 => 41,  143 => 40,  139 => 39,  135 => 38,  131 => 37,  124 => 33,  120 => 32,  116 => 31,  112 => 30,  108 => 29,  103 => 26,  97 => 24,  91 => 22,  88 => 21,  82 => 19,  80 => 18,  70 => 11,  66 => 10,  62 => 9,  55 => 7,  41 => 2,  38 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "account/partial/layout_logged_in.html.twig", "/var/www/html/medicalimage/themes/evolution/views/account/partial/layout_logged_in.html.twig");
    }
}
