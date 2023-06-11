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

/* account/partial/site_js_html_containers.html.twig */
class __TwigTemplate_f5b663dbe568e9f3b0b9f884f5a9fe10f3b3c7a025a550bb3c373bea1406af8f extends \Twig\Template
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
        echo "<!-- uploader -->
<div id=\"fileUploadWrapper\" class=\"modal fade file-upload-wrapper\">
    <div class=\"modal-dialog\">
        <div class=\"modal-content\">
            ";
        // line 5
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("loading_please_wait", "Loading, please wait..."), "html", null, true);
        echo "
        </div>
    </div>
</div>

<div id=\"filePopupContentWrapper\" style=\"display: none;\">
    <div id=\"filePopupContent\" class=\"filePopupContent\"></div>
</div>

<div id=\"filePopupContentWrapperNotice\" style=\"display: none;\">
    <div id=\"filePopupContentNotice\" class=\"filePopupContentNotice\"></div>
</div>

<!-- filter modal -->
<div class=\"modal fade custom-width filter-modal\" id=\"filterModal\">
    <div class=\"modal-dialog\">
        <div class=\"modal-content\">

            <div class=\"modal-header\">
                <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</button>
                <h4 class=\"modal-title\">";
        // line 25
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("search_your_files", "Search Your Files"), "html", null, true);
        echo "</h4>
            </div>

            <div class=\"modal-body\">
                <form autocomplete=\"off\">
                    <div class=\"row\">

                        <div class=\"col-md-3\">
                            <div class=\"modal-icon-left\"><img src=\"";
        // line 33
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountImagePath", [], "method", false, false, false, 33), "html", null, true);
        echo "/modal_icons/file_search.png\"/></div>
                        </div>

                        <div class=\"col-md-9\">

                            <div class=\"row\">
                                <div class=\"col-md-6\">
                                    <div class=\"form-group\">
                                        <label for=\"filterText\" class=\"control-label\">";
        // line 41
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("search", "Search"), "html", null, true);
        echo "</label>
                                        <input type=\"text\" class=\"form-control\" name=\"filterText\" id=\"filterText\" placeholder=\"";
        // line 42
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("file_manager_freetext_search", "Freetext search..."), "html", null, true);
        echo "\" value=\"";
        (((isset($context["filterText"]) || array_key_exists("filterText", $context))) ? (print (twig_escape_filter($this->env, ($context["filterText"] ?? null), "html", null, true))) : (print ("")));
        echo "\">
                                    </div>
                                </div>
                                <div class=\"col-md-3\">
                                    <div class=\"form-group\">
                                        <label class=\"control-label\">&nbsp;</label>
                                        <div class=\"radio\">
                                            <label>
                                                <input type=\"radio\" value=\"\" id=\"filterCurrentFolder\" name=\"folderId\" CHECKED>";
        // line 50
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("file_manager_current_folder", "Current Folder"), "html", null, true);
        echo "
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class=\"col-md-3\">
                                    <div class=\"form-group\">
                                        <label class=\"control-label\">&nbsp;</label>
                                        <div class=\"radio\">
                                            <label>
                                                <input type=\"radio\" value=\"all\" id=\"filterAllFolders\" name=\"folderId\">";
        // line 60
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("file_manager_all_folders", "All Folders"), "html", null, true);
        echo "
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class=\"row\">
                                <div class=\"col-md-12\">
                                    <div class=\"form-group\">
                                        <label for=\"filterUploadedDateRange\" class=\"control-label\">";
        // line 70
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("upload_date", "Upload Date"), "html", null, true);
        echo "</label>
                                        <div class=\"daterange daterange-inline\" data-format=\"MMMM D, YYYY\" data-start-date=\"";
        // line 71
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, twig_date_modify_filter($this->env, "now", "-30 days"), "F j, Y"), "html", null, true);
        echo "\" data-end-date=\"";
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, "now", "F j, Y"), "html", null, true);
        echo "\" data-callback=\"\">
                                             <i class=\"entypo-calendar\"></i>
                                            <span>";
        // line 73
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("file_manager_select_range", "Select range..."), "html", null, true);
        echo "</span>
                                        </div>
                                        <input type=\"hidden\" name=\"filterUploadedDateRange\" id=\"filterUploadedDateRange\" value=\"\"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class=\"modal-footer\">
                <button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">";
        // line 85
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("close", "Close"), "html", null, true);
        echo "</button>
                <button type=\"button\" class=\"btn btn-info\" onClick=\"handleTopSearch(null, \$('#filterText'), true);
                        return false;\">";
        // line 87
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("search", "Search"), "html", null, true);
        echo " <i class=\"entypo-search\"></i></button>
            </div>
        </div>
    </div>
</div>

<!-- add/edit folder -->
<div id=\"addEditFolderModal\" class=\"modal fade custom-width edit-folder-modal\">
    <div class=\"modal-dialog\">
        <div class=\"modal-content\">
            ";
        // line 97
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("loading_please_wait", "Loading, please wait..."), "html", null, true);
        echo "
        </div>
    </div>
</div>

<!-- edit file -->
<div id=\"editFileModal\" class=\"modal fade custom-width edit-file-modal\">
    <div class=\"modal-dialog\">
        <div class=\"modal-content\">
            ";
        // line 106
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("loading_please_wait", "Loading, please wait..."), "html", null, true);
        echo "
        </div>
    </div>
</div>

<!-- share folder -->
<div id=\"shareFolderModal\" class=\"modal fade custom-width edit-folder-modal\">
    <div class=\"modal-dialog\">
        <div class=\"modal-content\">
            ";
        // line 115
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("loading_please_wait", "Loading, please wait..."), "html", null, true);
        echo "
        </div>
    </div>
</div>

<!-- stats -->
<div id=\"statsModal\" class=\"modal fade custom-width stats-modal\">
    <div class=\"modal-dialog\">
        <div class=\"modal-content\">
            ";
        // line 124
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("loading_please_wait", "Loading, please wait..."), "html", null, true);
        echo "
        </div>
    </div>
</div>

<!-- links -->
<div id=\"fileLinksModal\" class=\"modal fade custom-width file-links-wrapper\" style=\"z-index: 10000;\">
    <div class=\"modal-dialog\">
        <div class=\"modal-content\">

            <div class=\"modal-header\">
                <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</button>
                <h4 class=\"modal-title\">";
        // line 136
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("file_urls", "File Urls"), "html", null, true);
        echo "</h2>
            </div>

            <div class=\"modal-body\">
                <div class=\"row\">

                    <div class=\"col-md-3\">
                        <div class=\"modal-icon-left\"><img src=\"";
        // line 143
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountImagePath", [], "method", false, false, false, 143), "html", null, true);
        echo "/modal_icons/link.png\"/></div>
                    </div>

                    <div class=\"col-md-9\">
                        <samp>
                             <div id=\"popupContentUrls\" class=\"link-section\" onClick=\"selectAllText(this);
                                                                return false;\"></div>
                                 <div id=\"popupContentHTMLCode\" class=\"link-section\" style=\"display: none;\" onClick=\"selectAllText(this);
                                                                return false;\"></div>
                                 <div id=\"popupContentBBCode\" class=\"link-section\" style=\"display: none;\" onClick=\"selectAllText(this);
                                                                return false;\"></div>
                        </samp>
                    </div>
                </div>
            </div>

            <div class=\"modal-footer\">
                <div class=\"row\">
                    <div class=\"col-md-8 text-left\">
                        <div class=\"btn-group\">
                            <button type=\"button\" class=\"btn btn-info active\" onClick=\"showLinkSection('popupContentUrls', this);
                                    return false;\">";
        // line 164
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("file_urls", "File Urls"), "html", null, true);
        echo "</button>
    <button type=\"button\" class=\"btn btn-info\" onClick=\"showLinkSection('popupContentHTMLCode', this);
                                    return false;\">";
        // line 166
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("urls_html_code", "HTML Code"), "html", null, true);
        echo "</button>
                            <button type=\"button\" class=\"btn btn-info\" onClick=\"showLinkSection('popupContentBBCode', this);
                                    return false;\">";
        // line 168
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("urls_bbcode", "Forum BBCode"), "html", null, true);
        echo "</button>
                        </div>
                    </div>
                    <div class=\"col-md-4\">
                        <button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">";
        // line 172
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("close", "Close"), "html", null, true);
        echo "</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- download folder modal -->
<div id=\"downloadFolderModal\" class=\"modal fade custom-width custom-width download-folder-modal\">
    <div class=\"modal-dialog\">
        <div class=\"modal-content\">
            <div class=\"modal-header\">
                <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</button>
                <h4 class=\"modal-title\">";
        // line 186
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("download_zip_file", "Download Zip File"), "html", null, true);
        echo "</h2>
            </div>

            <div class=\"modal-body\" style=\"height: 440px;\">
                <div class=\"row\">
                    <div class=\"col-md-3\">
                        <div class=\"modal-icon-left\"><img src=\"";
        // line 192
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountImagePath", [], "method", false, false, false, 192), "html", null, true);
        echo "/modal_icons/box_download.png\"/></div>
                    </div>

                    <div class=\"col-md-9\"></div>
                </div>
            </div>

            <div class=\"modal-footer\">
                <button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">";
        // line 200
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("close", "Close"), "html", null, true);
        echo "</button>
            </div>
        </div>
    </div>
</div>

<!-- view file details modal -->
<div id=\"fileDetailsModal\" class=\"modal fade custom-width file-details-modal\">
    <div class=\"modal-dialog\">
        <div class=\"modal-content\">
            ";
        // line 210
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("loading_please_wait", "Loading, please wait..."), "html", null, true);
        echo "
        </div>
    </div>
</div>

<!-- general notice modal -->
<div id=\"generalModal\" class=\"modal fade custom-width general-modal\">
    <div class=\"modal-dialog\">
        <div class=\"modal-content\">
            <div class=\"modal-body\"></div>
            <div class=\"modal-footer\">
                <button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">";
        // line 221
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("close", "Close"), "html", null, true);
        echo "</button>
            </div>
        </div>
    </div>
</div>

<!-- for full screen images -->
<div class=\"pswp\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">
    <!-- Background of PhotoSwipe. It's a separate element as animating opacity is faster than rgba(). -->
    <div class=\"pswp__bg\"></div>
    <!-- Slides wrapper with overflow:hidden. -->
    <div class=\"pswp__scroll-wrap\">
        <!-- Container that holds slides. 
            PhotoSwipe keeps only 3 of them in the DOM to save memory. Don't modify these 3 pswp__item elements, data is added later on. -->
        <div class=\"pswp__container\">
            <div class=\"pswp__item\"></div>
            <div class=\"pswp__item\"></div>
            <div class=\"pswp__item\"></div>
        </div>
        <!-- Default (PhotoSwipeUI_Default) interface on top of sliding area. Can be changed. -->
        <div class=\"pswp__ui pswp__ui--hidden\">
            <div class=\"pswp__top-bar\">
                <!--  Controls are self-explanatory. Order can be changed. -->
                <div class=\"pswp__counter\"></div>
                <button class=\"pswp__button pswp__button--close\" title=\"Close (Esc)\"></button>
                <button class=\"pswp__button pswp__button--share\" title=\"Share\"></button>
                <button class=\"pswp__button pswp__button--fs\" title=\"Toggle fullscreen\"></button>
                <button class=\"pswp__button pswp__button--zoom\" title=\"Zoom in/out\"></button>

                <!-- element will get class pswp__preloader--active when preloader is running -->
                <div class=\"pswp__preloader\">
                    <div class=\"pswp__preloader__icn\">
                        <div class=\"pswp__preloader__cut\">
                            <div class=\"pswp__preloader__donut\"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class=\"pswp__share-modal pswp__share-modal--hidden pswp__single-tap\">
                <div class=\"pswp__share-tooltip\"></div> 
            </div>
            <button class=\"pswp__button pswp__button--arrow--left\" title=\"Previous (arrow left)\"></button>
            <button class=\"pswp__button pswp__button--arrow--right\" title=\"Next (arrow right)\"></button>
            <div class=\"pswp__caption\">
                <div class=\"pswp__caption__center\"></div>
            </div>
        </div>
    </div>
</div>";
    }

    public function getTemplateName()
    {
        return "account/partial/site_js_html_containers.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  341 => 221,  327 => 210,  314 => 200,  303 => 192,  294 => 186,  277 => 172,  270 => 168,  265 => 166,  260 => 164,  236 => 143,  226 => 136,  211 => 124,  199 => 115,  187 => 106,  175 => 97,  162 => 87,  157 => 85,  142 => 73,  135 => 71,  131 => 70,  118 => 60,  105 => 50,  92 => 42,  88 => 41,  77 => 33,  66 => 25,  43 => 5,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "account/partial/site_js_html_containers.html.twig", "/var/www/html/medicalimage/themes/evolution/views/account/partial/site_js_html_containers.html.twig");
    }
}
