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

/* account/ajax/file_details.html.twig */
class __TwigTemplate_7a7465889a031201f0cbe84e66e7c8eb426779be050689c60885bfea93d649bf extends \Twig\Template
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
        echo "<div class=\"file-browse-container-wrapper\">
    <div class=\"file-preview-wrapper\">
        <div class=\"row\">
            <div class=\"col-md-9\">
                <div class=\"section-wrapper\">
                    <table class=\"image-name-wrapper\">
                        <tr>
                            <td>
                                <div class=\"image-name-title\">
                                    ";
        // line 10
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["file"] ?? null), "originalFilename", [], "any", false, false, false, 10), "html", null, true);
        echo "
                                </div>
                            </td>
                            <td class=\"image-hide-wrapper\">
                                <a class=\"btn btn-default\" onclick=\"hideImage(); return false;\" data-original-title=\"";
        // line 14
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("account_file_details_go_back", "Go Back"), "html", null, true);
        echo "\" data-placement=\"bottom\" data-toggle=\"tooltip\">
                                    <i class=\"entypo-left\"></i>
                                </a>
                                ";
        // line 17
        if (((($context["isPublic"] ?? null) == true) && (twig_get_attribute($this->env, $this->source, ($context["file"] ?? null), "status", [], "any", false, false, false, 17) == "active"))) {
            // line 18
            echo "                                     <div class=\"image-social-sharing\">
                                        <div class=\"row mobile-social-share\">
                                            <div id=\"socialHolder\">
                                                <div id=\"socialShare\" class=\"btn-group share-group\">
                                                    <a data-toggle=\"dropdown\" class=\"btn btn-default\">
                                                        <i class=\"entypo-share\"></i>
                                                    </a>
                                                    <button href=\"#\" data-toggle=\"dropdown\" class=\"btn btn-default dropdown-toggle share\">
                                                        <span class=\"caret\"></span>
                                                    </button>
                                                    <ul class=\"dropdown-menu\">
                                                        <li>
                                                            <a href=\"https://twitter.com/intent/tweet?url=";
            // line 30
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["file"] ?? null), "getFullShortUrl", [], "method", false, false, false, 30), "html", null, true);
            echo "&text=";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["file"] ?? null), "originalFilename", [], "any", false, false, false, 30), "html", null, true);
            echo "\" data-original-title=\"";
            echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("account_file_details_share_on", "Share On"), "html", null, true);
            echo " Twitter\" data-toggle=\"tooltip\" href=\"#\" class=\"btn btn-twitter\" data-placement=\"left\" target=\"_blank\">
                                                                <i class=\"fa fa-twitter\"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href=\"https://www.facebook.com/sharer/sharer.php?u=";
            // line 35
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["file"] ?? null), "getFullShortUrl", [], "method", false, false, false, 35), "html", null, true);
            echo "\" data-original-title=\"";
            echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("account_file_details_share_on", "Share On"), "html", null, true);
            echo " Facebook\" data-toggle=\"tooltip\" href=\"#\" class=\"btn btn-facebook\" data-placement=\"left\" target=\"_blank\">
                                                                <i class=\"fa fa-facebook\"></i>
                                                            </a>
                                                        </li>\t\t\t\t\t
                                                        <li>
                                                            <a href=\"https://www.linkedin.com/shareArticle?mini=true&url=";
            // line 40
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["file"] ?? null), "getFullShortUrl", [], "method", false, false, false, 40), "html", null, true);
            echo "\" data-original-title=\"";
            echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("account_file_details_share_on", "Share On"), "html", null, true);
            echo " LinkedIn\" data-toggle=\"tooltip\" href=\"#\" class=\"btn btn-linkedin\" data-placement=\"left\" target=\"_blank\">
                                                                <i class=\"fa fa-linkedin\"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href=\"https://pinterest.com/pin/create/button/?url=";
            // line 45
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["file"] ?? null), "getFullShortUrl", [], "method", false, false, false, 45), "html", null, true);
            echo "\" data-original-title=\"";
            echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("account_file_details_share_on", "Share On"), "html", null, true);
            echo " Pinterest\" data-toggle=\"tooltip\" class=\"btn btn-pinterest\" data-placement=\"left\" target=\"_blank\">
                                                                <i class=\"fa fa-pinterest\"></i>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                ";
        }
        // line 55
        echo "                            </td>
                        </tr>
                    </table>
                </div>
                
                ";
        // line 60
        if ((twig_get_attribute($this->env, $this->source, ($context["file"] ?? null), "status", [], "any", false, false, false, 60) != "deleted")) {
            // line 61
            echo "                    <div class=\"section-wrapper image-preview-wrapper\">
                        ";
            // line 62
            if ((twig_get_attribute($this->env, $this->source, ($context["file"] ?? null), "status", [], "any", false, false, false, 62) == "active")) {
                // line 63
                echo "                            ";
                if ((($context["prev"] ?? null) != null)) {
                    // line 64
                    echo "                                <a href=\"#\" class=\"prev-link\" onClick=\"showFile(";
                    echo twig_escape_filter($this->env, ($context["prev"] ?? null), "html", null, true);
                    echo "); return false;\"><i class=\"entypo-left-open-big\"></i></a>
                            ";
                }
                // line 66
                echo "
                            ";
                // line 67
                if ((($context["next"] ?? null) != null)) {
                    // line 68
                    echo "                                <a href=\"#\" class=\"next-link\" onClick=\"showFile(";
                    echo twig_escape_filter($this->env, ($context["next"] ?? null), "html", null, true);
                    echo "); return false;\"><i class=\"entypo-right-open-big\"></i></a>
                            ";
                }
                // line 70
                echo "                        ";
            }
            // line 71
            echo "
                        <div class=\"image\">
                            <div class=\"content-preview-wrapper loader\">
                                ";
            // line 74
            echo ($context["previewerHtmlContent"] ?? null);
            echo "
                            </div>
                        </div>
                    </div>
                    <div class=\"clear\"></div>
                ";
        }
        // line 80
        echo "
                <div class=\"section-wrapper\">
                    ";
        // line 82
        if ((twig_get_attribute($this->env, $this->source, ($context["file"] ?? null), "status", [], "any", false, false, false, 82) == "active")) {
            // line 83
            echo "                        <div class=\"similar-images\"><!-- --></div>
                    ";
        }
        // line 85
        echo "                </div>
            </div>
            <div class=\"col-md-3\">
                ";
        // line 88
        if ((($context["owner"] ?? null) != null)) {
            // line 89
            echo "                    <div class=\"section-wrapper\">
                        <a href=\"#\" onClick=\"loadImages('folder', ";
            // line 90
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["folder"] ?? null), "id", [], "any", false, false, false, 90), "html", null, true);
            echo "); return false;\"><img width=\"60\" height=\"60\" class=\"img-rounded\" alt=\"";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["owner"] ?? null), "getAccountScreenName", [], "method", false, false, false, 90), "html", null, true);
            echo "\" src=\"";
            echo twig_escape_filter($this->env, ($context["folderCoverLink"] ?? null), "html", null, true);
            echo "\"/></a>
                        <span class=\"text-section\">
                            <a href=\"#\" class=\"text-section-1\" onClick=\"loadImages('folder', ";
            // line 92
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["folder"] ?? null), "id", [], "any", false, false, false, 92), "html", null, true);
            echo "); return false;\">";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["folder"] ?? null), "folderName", [], "any", false, false, false, 92), "html", null, true);
            echo "</a>
                            ";
            // line 93
            echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("profile_by", "by"), "html", null, true);
            echo "
                            ";
            // line 94
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["owner"] ?? null), "getAccountScreenName", [], "method", false, false, false, 94), "html", null, true);
            echo "
                        </span>
                    </div>
                ";
        }
        // line 98
        echo "
                <div class=\"section-wrapper\">
                    <table class=\"table table-bordered table-striped\">
                        <tbody>
                            ";
        // line 102
        if ((twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["file"] ?? null), "description", [], "any", false, false, false, 102)) > 0)) {
            // line 103
            echo "                            <tr>
                                <td class=\"view-file-details-first-row\">
                                    ";
            // line 105
            echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("description", "description")), "html", null, true);
            echo ":
                                </td>
                                <td class=\"responsiveTable\">
                                    ";
            // line 108
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["file"] ?? null), "description", [], "any", false, false, false, 108), "html", null, true);
            echo "
                                </td>
                            </tr>
                            ";
        }
        // line 112
        echo "                            
                            <tr>
                                <td class=\"view-file-details-first-row\">
                                    ";
        // line 115
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("added_by", "added by")), "html", null, true);
        echo ":
                                </td>
                                <td class=\"responsiveTable\">
                                    ";
        // line 118
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["file"] ?? null), "getUploaderUsername", [], "method", false, false, false, 118), "html", null, true);
        echo "
                                </td>
                            </tr>
                            ";
        // line 121
        if ((twig_get_attribute($this->env, $this->source, ($context["file"] ?? null), "uploadedUserId", [], "any", false, false, false, 121) != twig_get_attribute($this->env, $this->source, ($context["file"] ?? null), "userId", [], "any", false, false, false, 121))) {
            // line 122
            echo "                            <tr>
                                <td class=\"view-file-details-first-row\">
                                    ";
            // line 124
            echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("owner", "owner")), "html", null, true);
            echo ":
                                </td>
                                <td class=\"responsiveTable\">
                                    ";
            // line 127
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["file"] ?? null), "getOwnerUsername", [], "method", false, false, false, 127), "html", null, true);
            echo "
                                </td>
                            </tr>
                            ";
        }
        // line 131
        echo "                            <tr>
                                <td class=\"view-file-details-first-row\">
                                    ";
        // line 133
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("filesize", "filesize")), "html", null, true);
        echo ":
                                </td>
                                <td class=\"responsiveTable\">
                                    ";
        // line 136
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["file"] ?? null), "getFormattedFilesize", [], "method", false, false, false, 136), "html", null, true);
        echo "
                                </td>
                            </tr>
                            
                            ";
        // line 140
        if ((twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["file"] ?? null), "keywords", [], "any", false, false, false, 140)) > 0)) {
            // line 141
            echo "                            <tr>
                                <td class=\"view-file-details-first-row\">
                                    ";
            // line 143
            echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("keywords", "keywords")), "html", null, true);
            echo ":
                                </td>
                                <td class=\"responsiveTable\">
                                    <div class=\"bootstrap-tagsview\">
                                        ";
            // line 147
            $context["keywords"] = twig_split_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["file"] ?? null), "keywords", [], "any", false, false, false, 147), ",");
            // line 148
            echo "                                        ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["keywords"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["keyword"]) {
                // line 149
                echo "                                            ";
                if ((twig_length_filter($this->env, $context["keyword"]) > 0)) {
                    // line 150
                    echo "                                                <a 
                                                ";
                    // line 151
                    if ((twig_get_attribute($this->env, $this->source, ($context["Auth"] ?? null), "loggedIn", [], "method", false, false, false, 151) == true)) {
                        // line 152
                        echo "                                                    href=\"";
                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountWebRoot", [], "method", false, false, false, 152), "html", null, true);
                        echo "/search/?s=image&filterAllFolders=false&filterUploadedDateRange=&t=";
                        echo twig_escape_filter($this->env, $context["keyword"], "html", null, true);
                        echo "\"
                                                ";
                    }
                    // line 154
                    echo "                                                 class=\"tag label label-info\">";
                    echo twig_escape_filter($this->env, $context["keyword"], "html", null, true);
                    echo "</a>
                                            ";
                }
                // line 156
                echo "                                        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['keyword'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 157
            echo "                                    </div>
                                </td>
                            </tr>
                            ";
        }
        // line 161
        echo "                            
                            <tr>
                                <td class=\"view-file-details-first-row\">
                                    ";
        // line 164
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("uploaded", "uploaded")), "html", null, true);
        echo ":
                                </td>
                                <td class=\"responsiveTable\">
                                    ";
        // line 167
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["file"] ?? null), "getFormattedUploadedDate", [], "method", false, false, false, 167), "html", null, true);
        echo "
                                </td>
                            </tr>
                            ";
        // line 170
        if ((twig_get_attribute($this->env, $this->source, ($context["file"] ?? null), "status", [], "any", false, false, false, 170) == "active")) {
            // line 171
            echo "                            <tr>
                                <td class=\"view-file-details-first-row\">
                                    ";
            // line 173
            echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("permissions", "permissions")), "html", null, true);
            echo ":
                                </td>
                                <td class=\"responsiveTable\">
                                    ";
            // line 176
            echo twig_escape_filter($this->env, twig_title_string_filter($this->env, ($context["shareAccessLevelLabel"] ?? null)), "html", null, true);
            echo "
                                </td>
                            </tr>
                            ";
        }
        // line 180
        echo "
                            ";
        // line 181
        if (((($context["userOwnsFile"] ?? null) == true) && (twig_get_attribute($this->env, $this->source, ($context["file"] ?? null), "status", [], "any", false, false, false, 181) == "active"))) {
            // line 182
            echo "                                <tr>
                                    <td class=\"view-file-details-first-row\">
                                        ";
            // line 184
            echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("sharing", "Sharing")), "html", null, true);
            echo ":
                                    </td>
                                    <td class=\"responsiveTable\">
                                        ";
            // line 187
            echo (((($context["isPublic"] ?? null) == true)) ? ("<i class=\"entypo-lock-open\"></i>") : ("<i class=\"entypo-lock\"></i>"));
            echo "
                                        ";
            // line 188
            echo twig_escape_filter($this->env, (((($context["isPublic"] ?? null) == true)) ? ($this->extensions['App\Services\TTwigExtension']->tHandler("public_file", "Public File - Can be accessed directly by anyone that knows the file url.")) : ($this->extensions['App\Services\TTwigExtension']->tHandler("private_file", "Private File - Only available via your account, or via a generated sharing url."))), "html", null, true);
            echo "
                                    </td>
                                </tr>
                            ";
        }
        // line 192
        echo "
                            ";
        // line 193
        if ((twig_get_attribute($this->env, $this->source, ($context["file"] ?? null), "status", [], "any", false, false, false, 193) != "active")) {
            // line 194
            echo "                                <tr>
                                    <td class=\"view-file-details-first-row\">
                                        ";
            // line 196
            echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("status", "status")), "html", null, true);
            echo ":
                                    </td>
                                    <td class=\"responsiveTable\">
                                        ";
            // line 199
            echo twig_escape_filter($this->env, twig_title_string_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["file"] ?? null), "getStatusLabel", [], "method", false, false, false, 199)), "html", null, true);
            echo "
                                    </td>
                                </tr>
                            ";
        }
        // line 203
        echo "                        </tbody>
                    </table>
                </div>

                ";
        // line 207
        if ((twig_length_filter($this->env, ($context["links"] ?? null)) > 0)) {
            // line 208
            echo "                    <div class=\"section-wrapper\">
                        <div class=\"button-wrapper responsiveMobileAlign\">\t\t\t\t\t\t
                            ";
            // line 210
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["links"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["link"]) {
                // line 211
                echo "                                <div class=\"btn-group responsiveMobileMargin\">
                                    ";
                // line 212
                echo $context["link"];
                echo "
                                </div>
                            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['link'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 215
            echo "                        </div>
                    </div>
                ";
        }
        // line 218
        echo "
                ";
        // line 219
        if ((twig_get_attribute($this->env, $this->source, ($context["file"] ?? null), "status", [], "any", false, false, false, 219) == "active")) {
            // line 220
            echo "                    <div role=\"tabpanel\">
                        <ul class=\"nav nav-tabs file-info-tabs\" role=\"tablist\">
                            <li role=\"presentation\" class=\"active\"><a href=\"#details\" aria-controls=\"details\" role=\"tab\" data-toggle=\"tab\"><i class=\"entypo-share\"></i><span> ";
            // line 222
            echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("sharing_code", "sharing code")), "html", null, true);
            echo "</span></a></li>
                            <li role=\"presentation\"><a href=\"#send-via-email\" aria-controls=\"send-via-email\" role=\"tab\" data-toggle=\"tab\"><i class=\"entypo-mail\"></i><span> ";
            // line 223
            echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("email", "email")), "html", null, true);
            echo "</span></a></li>
                            ";
            // line 224
            if ((twig_length_filter($this->env, ($context["imageRawDataArr"] ?? null)) > 0)) {
                // line 225
                echo "                                <li role=\"presentation\"><a href=\"#image-data\" aria-controls=\"image-data\" role=\"tab\" data-toggle=\"tab\"><i class=\"entypo-info-circled\"></i><span> ";
                echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("meta", "Meta")), "html", null, true);
                echo "</span></a></li>
                            ";
            }
            // line 227
            echo "                            <li role=\"presentation\"><a href=\"#printQR\" aria-controls=\"details\" role=\"tab\" data-toggle=\"tab\"><i class=\"fa fa-print\"></i><span> Print QR</span></a></li>
                        </ul>
                        <div class=\"tab-content\">
                            <div class=\"tab-pane active file-details-sharing-code\" id=\"details\">
                                <h4><strong>";
            // line 231
            echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("file_page_link", "File Page Link"), "html", null, true);
            echo "</strong></h4>
                                <pre><section onClick=\"selectAllText(this); return false;\">";
            // line 232
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["file"] ?? null), "getFullShortUrl", [], "method", false, false, false, 232), "html", null, true);
            echo "</section></pre>

                                <h4><strong>";
            // line 234
            echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("html_code", "HTML Code"), "html", null, true);
            echo "</strong></h4>
                                <pre><section onClick=\"selectAllText(this); return false;\">";
            // line 235
            echo twig_get_attribute($this->env, $this->source, ($context["file"] ?? null), "getHtmlLinkCode", [], "method", false, false, false, 235);
            echo "</section></pre>

                                <h4><strong>";
            // line 237
            echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("forum_code", "forum code")), "html", null, true);
            echo "</strong></h4>
                                <pre><section onClick=\"selectAllText(this); return false;\">";
            // line 238
            echo twig_get_attribute($this->env, $this->source, ($context["file"] ?? null), "getForumLinkCode", [], "method", false, false, false, 238);
            echo "</section></pre>
                                    
                                <h4><strong>";
            // line 240
            echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("direct_link", "Direct Link")), "html", null, true);
            echo "</strong></h4>
                                <pre><section onClick=\"selectAllText(this); return false;\">";
            // line 241
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["file"] ?? null), "getFileServerPath", [], "method", false, false, false, 241), "html", null, true);
            echo "/file/";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["file"] ?? null), "shortUrl", [], "any", false, false, false, 241), "html", null, true);
            echo "/";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["file"] ?? null), "getSafeFilenameForUrl", [], "method", false, false, false, 241), "html", null, true);
            echo "</section></pre>
                            </div>

                            <div class=\"tab-pane file-details-sharing-code\" id=\"printQR\" style=\"text-align: center;\">
                                <h4 style=\"text-align: center;\"><strong>QR Code</strong></h4><br>
                                <a class=\"btn btn-default\" onclick=\"printQR();\">Print QR Code</a>
                                <img width=\"200\" height=\"200\" class=\"img-rounded\" alt=\"";
            // line 247
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["file"] ?? null), "qrcode", [], "any", false, false, false, 247), "html", null, true);
            echo "\" src=\"";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["file"] ?? null), "qrcode", [], "any", false, false, false, 247), "html", null, true);
            echo "\"/></a>                                
                                <script>
                                    function printQR() {
                                        window.open('//image.radmed.co.id/plugins/phpqrcode/printQR.php?id=";
            // line 250
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["file"] ?? null), "id", [], "any", false, false, false, 250), "html", null, true);
            echo "', '_blank');
                                    }
                                </script>
                            </div>

                            <div role=\"tabpanel\" class=\"tab-pane\" id=\"send-via-email\">
                                <div class=\"row\">
                                    <form action=\"";
            // line 257
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountWebRoot", [], "method", false, false, false, 257), "html", null, true);
            echo "/ajax/file_details_send_email_process\" autocomplete=\"off\">
                                        <div class=\"col-md-12\">
                                            <div class=\"form-group\">
                                                <p>";
            // line 260
            echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("account_file_details_intro_user_the_form_below_send_email", "Use the form below to share this file via email. The recipient will receive a link to download the file."), "html", null, true);
            echo "</p>
                                                ";
            // line 261
            if ((($context["isPublic"] ?? null) == false)) {
                // line 262
                echo "                                                    <div class=\"alert alert-danger\">";
                echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("account_file_details_folder_not_publicly_shared", "This file is not publicly shared. You will need to make it public before the recipient can view it."), "html", null, true);
                echo "</div>
                                                ";
            }
            // line 264
            echo "                                            </div>


                                            <!--<div class=\"form-group\">
                                                <label for=\"shareSubject\" class=\"control-label\">";
            // line 268
            echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("edit_share_subject", "Subject Email :"), "html", null, true);
            echo "</label>
                                                <input type=\"text\" class=\"form-control\" name=\"shareSubject\" id=\"shareSubject\" placeholder=\"";
            // line 269
            echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("share_subject", "Subject Email")), "html", null, true);
            echo "\"/>
                                            </div>--!>
                                            <div class=\"form-group\">
                                                <label for=\"shareResult\" class=\"control-label\">";
            // line 272
            echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("edit_share_resultw", "Examination Result :"), "html", null, true);
            echo "</label>
                                                <input type=\"text\" class=\"form-control\" name=\"shareResult\" id=\"shareResult\" placeholder=\"";
            // line 273
            echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("share_result", "what result is ?")), "html", null, true);
            echo "\"/>
                                            </div>
                                            <div class=\"form-group\">
                                                <label class=\"control-label\" for=\"shareName\">";
            // line 276
            echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("recipient_name", "recipient full name")), "html", null, true);
            echo ":</label>
                                                <input type=\"text\" id=\"shareName\" name=\"shareName\" class=\"form-control\"/>
                                            </div>

                                            <div class=\"form-group\">
                                               <label for=\"shareCheckUpDate\" class=\"control-label\">Date Check Up:</label>
                                               <input type=\"date\" class=\"form-control\" name=\"shareCheckUpDate\" id=\"shareCheckUpDate\" placeholder=\"";
            // line 282
            echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("date_label_share", "")), "html", null, true);
            echo "\"/>
                                            </div>
                                            <div class=\"form-group\">
                                                <label class=\"control-label\" for=\"shareEmailAddress\">";
            // line 285
            echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("recipient_email_address", "recipient email address")), "html", null, true);
            echo ":</label>
                                                <input type=\"text\" id=\"shareEmailAddress\" name=\"shareEmailAddress\" class=\"form-control\"/>
                                            </div>

                                            <!--<div class=\"form-group\">
                                                <label class=\"control-label\" for=\"shareExtraMessage\">";
            // line 290
            echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("extra_message", "extra message (optional)")), "html", null, true);
            echo ":</label>
                                                <textarea id=\"shareExtraMessage\" name=\"shareExtraMessage\" class=\"form-control\"></textarea>
                                            </div>--!>

                                            <div class=\"form-group\">
                                                <input type=\"hidden\" name=\"submitme\" id=\"submitme\" value=\"1\"/>
                                                <input type=\"hidden\" value=\"";
            // line 296
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["file"] ?? null), "id", [], "any", false, false, false, 296), "html", null, true);
            echo "\" name=\"fileId\"/>
                                                <button type=\"button\" class=\"btn btn-info\" onClick=\"processAjaxForm(this, function () {
                                                            \$('#shareName').val('');
                                                            \$('#shareEmailAddress').val('');
                                                            \$('#shareExtraMessage').val('');
                                                        });
                                                        return false;\">";
            // line 302
            echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("send_email", "send email")), "html", null, true);
            echo " <i class=\"entypo-mail\"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            ";
            // line 309
            if ((twig_length_filter($this->env, ($context["imageRawDataArr"] ?? null)) > 0)) {
                // line 310
                echo "                                <div class=\"tab-pane image-data\" id=\"image-data\">
                                    <table class=\"table table-bordered table-striped\">
                                        <tbody>
                                            ";
                // line 313
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["imageRawDataArr"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["imageRawDataItem"]) {
                    // line 314
                    echo "                                                <tr>
                                                    <td class=\"view-file-details-first-row\">
                                                        ";
                    // line 316
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["imageRawDataItem"], "label", [], "any", false, false, false, 316), "html", null, true);
                    echo ":
                                                    </td>
                                                    <td>
                                                        ";
                    // line 319
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["imageRawDataItem"], "value", [], "any", false, false, false, 319), "html", null, true);
                    echo "
                                                    </td>
                                                </tr>
                                            ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['imageRawDataItem'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 323
                echo "                                        </tbody>
                                    </table>
                                </div>
                            ";
            }
            // line 327
            echo "                        </div>
                    </div>
                ";
        }
        // line 330
        echo "
            </div>
        </div>
    </div>
</div>";
    }

    public function getTemplateName()
    {
        return "account/ajax/file_details.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  700 => 330,  695 => 327,  689 => 323,  679 => 319,  673 => 316,  669 => 314,  665 => 313,  660 => 310,  658 => 309,  648 => 302,  639 => 296,  630 => 290,  622 => 285,  616 => 282,  607 => 276,  601 => 273,  597 => 272,  591 => 269,  587 => 268,  581 => 264,  575 => 262,  573 => 261,  569 => 260,  563 => 257,  553 => 250,  545 => 247,  532 => 241,  528 => 240,  523 => 238,  519 => 237,  514 => 235,  510 => 234,  505 => 232,  501 => 231,  495 => 227,  489 => 225,  487 => 224,  483 => 223,  479 => 222,  475 => 220,  473 => 219,  470 => 218,  465 => 215,  456 => 212,  453 => 211,  449 => 210,  445 => 208,  443 => 207,  437 => 203,  430 => 199,  424 => 196,  420 => 194,  418 => 193,  415 => 192,  408 => 188,  404 => 187,  398 => 184,  394 => 182,  392 => 181,  389 => 180,  382 => 176,  376 => 173,  372 => 171,  370 => 170,  364 => 167,  358 => 164,  353 => 161,  347 => 157,  341 => 156,  335 => 154,  327 => 152,  325 => 151,  322 => 150,  319 => 149,  314 => 148,  312 => 147,  305 => 143,  301 => 141,  299 => 140,  292 => 136,  286 => 133,  282 => 131,  275 => 127,  269 => 124,  265 => 122,  263 => 121,  257 => 118,  251 => 115,  246 => 112,  239 => 108,  233 => 105,  229 => 103,  227 => 102,  221 => 98,  214 => 94,  210 => 93,  204 => 92,  195 => 90,  192 => 89,  190 => 88,  185 => 85,  181 => 83,  179 => 82,  175 => 80,  166 => 74,  161 => 71,  158 => 70,  152 => 68,  150 => 67,  147 => 66,  141 => 64,  138 => 63,  136 => 62,  133 => 61,  131 => 60,  124 => 55,  109 => 45,  99 => 40,  89 => 35,  77 => 30,  63 => 18,  61 => 17,  55 => 14,  48 => 10,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "account/ajax/file_details.html.twig", "/var/www/html/medicalimage/themes/evolution/views/account/ajax/file_details.html.twig");
    }
}
