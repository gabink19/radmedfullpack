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

/* admin/plugin_settings.html.twig */
class __TwigTemplate_907c26fbe3ace1b2eeeb46b48267838361985ce61352be744081449a0d79143a extends \Twig\Template
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
        return "@core/admin/partial/layout_logged_in.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $this->parent = $this->loadTemplate("@core/admin/partial/layout_logged_in.html.twig", "admin/plugin_settings.html.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo twig_escape_filter($this->env, ($context["pluginName"] ?? null), "html", null, true);
        echo " Settings";
    }

    // line 4
    public function block_selected_page($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo "plugins";
    }

    // line 5
    public function block_selected_sub_page($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo "plugin_manage";
    }

    // line 7
    public function block_body($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 8
        echo "<div class=\"row clearfix\">
    <div class=\"col_12\">
        <div class=\"widget clearfix\">
            <h2>";
        // line 11
        echo twig_escape_filter($this->env, ($context["pluginName"] ?? null), "html", null, true);
        echo " Settings</h2>
            <div class=\"widget_inside\">
                ";
        // line 13
        echo ($context["msg_page_notifications"] ?? null);
        echo "
                <form method=\"POST\" action=\"";
        // line 14
        echo twig_escape_filter($this->env, ($context["ADMIN_WEB_ROOT"] ?? null), "html", null, true);
        echo "/plugin/filepreviewer/settings\" name=\"pluginForm\" id=\"pluginForm\" autocomplete=\"off\" enctype=\"multipart/form-data\">
                    <div class=\"clearfix col_12\">
                        <div class=\"col_4\">
                            <h3>Plugin State</h3>
                            <p>Whether this plugin is enabled.</p>
                        </div>
                        <div class=\"col_8 last\">
                            <div class=\"form\">
                                <div class=\"clearfix alt-highlight\">
                                    <label>Plugin Enabled:</label>
                                    <div class=\"input\">
                                        <select name=\"plugin_enabled\" id=\"plugin_enabled\" class=\"medium validate[required]\">
                                            ";
        // line 26
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["yesNoOptions"] ?? null));
        foreach ($context['_seq'] as $context["k"] => $context["yesNoOption"]) {
            // line 27
            echo "                                                <option value=\"";
            echo twig_escape_filter($this->env, $context["k"], "html", null, true);
            echo "\"";
            if ((($context["plugin_enabled"] ?? null) == $context["k"])) {
                echo " SELECTED";
            }
            echo ">";
            echo twig_escape_filter($this->env, $context["yesNoOption"], "html", null, true);
            echo "</option>
                                            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['k'], $context['yesNoOption'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 29
        echo "                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class=\"clearfix col_12\">
                        <div class=\"col_4\">
                            <h3>Image Previews</h3>
                            <p>Whether to enable image previews and thumbnails. If enabled, thumbnails will be shown while browsing files aswell as when you click to view a file.</p>
                        </div>
                        <div class=\"col_8 last\">
                            <div class=\"form\">
                                <div class=\"clearfix alt-highlight\">
                                    <label>Show Images:</label>
                                    <div class=\"input\">
                                        <select name=\"enable_preview_image\" class=\"medium\">
                                            ";
        // line 47
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["yesNoOptions"] ?? null));
        foreach ($context['_seq'] as $context["k"] => $context["yesNoOption"]) {
            // line 48
            echo "                                                <option value=\"";
            echo twig_escape_filter($this->env, $context["k"], "html", null, true);
            echo "\"";
            if ((($context["enable_preview_image"] ?? null) == $context["k"])) {
                echo " SELECTED";
            }
            echo ">";
            echo twig_escape_filter($this->env, $context["yesNoOption"], "html", null, true);
            echo "</option>
                                            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['k'], $context['yesNoOption'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 50
        echo "                                        </select>
                                    </div>
                                </div>

                                <div class=\"clearfix\">
                                    <label>Show Thumbnails:</label>
                                    <div class=\"input\">
                                        <select name=\"preview_image_show_thumb\" class=\"medium\">
                                            ";
        // line 58
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["yesNoOptions"] ?? null));
        foreach ($context['_seq'] as $context["k"] => $context["yesNoOption"]) {
            // line 59
            echo "                                                <option value=\"";
            echo twig_escape_filter($this->env, $context["k"], "html", null, true);
            echo "\"";
            if ((($context["preview_image_show_thumb"] ?? null) == $context["k"])) {
                echo " SELECTED";
            }
            echo ">";
            echo twig_escape_filter($this->env, $context["yesNoOption"], "html", null, true);
            echo "</option>
                                            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['k'], $context['yesNoOption'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 61
        echo "                                        </select>
                                    </div>
                                </div>

                                <div class=\"clearfix alt-highlight\">
                                    <label>Auto Rotate Images:</label>
                                    <div class=\"input\">
                                        <select name=\"auto_rotate\" id=\"auto_rotate\" class=\"medium\">
                                            ";
        // line 69
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["yesNoOptions"] ?? null));
        foreach ($context['_seq'] as $context["k"] => $context["yesNoOption"]) {
            // line 70
            echo "                                                <option value=\"";
            echo twig_escape_filter($this->env, $context["k"], "html", null, true);
            echo "\"";
            if ((($context["auto_rotate"] ?? null) == $context["k"])) {
                echo " SELECTED";
            }
            echo ">";
            echo twig_escape_filter($this->env, $context["yesNoOption"], "html", null, true);
            echo "</option>
                                            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['k'], $context['yesNoOption'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 72
        echo "                                        </select>
                                        <p class=\"text-muted\">
                                            If set to 'yes', image previews will be automatically rotated the correct way up (based on EXIF data).
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class=\"clearfix col_12\">
                        <div class=\"col_4\">
                            <h3>Document Previews</h3>
                            <p>Whether to enable document previews. If enabled, the document will be shown using Google Docs after you click on the file.</p>
                        </div>
                        <div class=\"col_8 last\">
                            <div class=\"form\">
                                <div class=\"clearfix alt-highlight\">
                                    <label>Show Documents:</label>
                                    <div class=\"input\">
                                        <select name=\"enable_preview_document\" class=\"medium\">
                                            ";
        // line 93
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["yesNoOptions"] ?? null));
        foreach ($context['_seq'] as $context["k"] => $context["yesNoOption"]) {
            // line 94
            echo "                                                <option value=\"";
            echo twig_escape_filter($this->env, $context["k"], "html", null, true);
            echo "\"";
            if ((($context["enable_preview_document"] ?? null) == $context["k"])) {
                echo " SELECTED";
            }
            echo ">";
            echo twig_escape_filter($this->env, $context["yesNoOption"], "html", null, true);
            echo "</option>
                                            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['k'], $context['yesNoOption'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 96
        echo "                                        </select>
                                    </div>
                                </div>

                                <div class=\"clearfix\">
                                    <label>Show PDF Thumbnails:</label>
                                    <div class=\"input\">
                                        <select name=\"preview_document_pdf_thumbs\" class=\"medium\">
                                            ";
        // line 104
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["yesNoOptions"] ?? null));
        foreach ($context['_seq'] as $context["k"] => $context["yesNoOption"]) {
            // line 105
            echo "                                                <option value=\"";
            echo twig_escape_filter($this->env, $context["k"], "html", null, true);
            echo "\"";
            if ((($context["preview_document_pdf_thumbs"] ?? null) == $context["k"])) {
                echo " SELECTED";
            }
            echo ">";
            echo twig_escape_filter($this->env, $context["yesNoOption"], "html", null, true);
            echo "</option>
                                            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['k'], $context['yesNoOption'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 107
        echo "                                        </select>
                                        <p class=\"text-muted\">
                                            Requires ImageMagick within PHP. Please contact your host to enable this.
                                        </p>
                                    </div>
                                </div>

                                <div class=\"clearfix alt-highlight\">
                                    <label>File Extensions:</label>
                                    <div class=\"input\">
                                        <input type=\"text\" name=\"preview_document_ext\" class=\"xxlarge\" value=\"";
        // line 117
        echo twig_escape_filter($this->env, ($context["preview_document_ext"] ?? null), "html", null, true);
        echo "\"/>
                                        <p class=\"text-muted\">
                                            Default: doc,docx,xls,xlsx,ppt,pptx,pdf,pages,ai,psd,tiff,dxf,svg,eps,ps,ttf,otf,xps
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class=\"clearfix col_12\">
                        <div class=\"col_4\">
                            <h3>Video Previews</h3>
                            <p>Whether to enable video previews. If enabled, the video will be shown using JWPlayer after you click on the file.</p>
                        </div>
                        <div class=\"col_8 last\">
                            <div class=\"form\">
                                <div class=\"clearfix alt-highlight\">
                                    <label>Play Videos:</label>
                                    <div class=\"input\">
                                        <select name=\"enable_preview_video\" class=\"medium\">
                                            ";
        // line 138
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["yesNoOptions"] ?? null));
        foreach ($context['_seq'] as $context["k"] => $context["yesNoOption"]) {
            // line 139
            echo "                                                <option value=\"";
            echo twig_escape_filter($this->env, $context["k"], "html", null, true);
            echo "\"";
            if ((($context["enable_preview_video"] ?? null) == $context["k"])) {
                echo " SELECTED";
            }
            echo ">";
            echo twig_escape_filter($this->env, $context["yesNoOption"], "html", null, true);
            echo "</option>
                                            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['k'], $context['yesNoOption'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 141
        echo "                                        </select>
                                    </div>
                                </div>

                                <div class=\"clearfix\">
                                    <label>File Extensions:</label>
                                    <div class=\"input\">
                                        <input type=\"text\" name=\"preview_video_ext\" class=\"xxlarge\" value=\"";
        // line 148
        echo twig_escape_filter($this->env, ($context["preview_video_ext"] ?? null), "html", null, true);
        echo "\"/>
                                        <p class=\"text-muted\">
                                            Default: mp4,flv,ogg
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class=\"clearfix col_12\">
                        <div class=\"col_4\">
                            <h3>Audio Previews</h3>
                            <p>Whether to enable audio previews. If enabled, the audio will be played using JWPlayer after you click on the file.</p>
                        </div>
                        <div class=\"col_8 last\">
                            <div class=\"form\">
                                <div class=\"clearfix alt-highlight\">
                                    <label>Play Audio:</label>
                                    <div class=\"input\">
                                        <select name=\"enable_preview_audio\" class=\"medium\">
                                            ";
        // line 169
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["yesNoOptions"] ?? null));
        foreach ($context['_seq'] as $context["k"] => $context["yesNoOption"]) {
            // line 170
            echo "                                                <option value=\"";
            echo twig_escape_filter($this->env, $context["k"], "html", null, true);
            echo "\"";
            if ((($context["enable_preview_audio"] ?? null) == $context["k"])) {
                echo " SELECTED";
            }
            echo ">";
            echo twig_escape_filter($this->env, $context["yesNoOption"], "html", null, true);
            echo "</option>
                                            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['k'], $context['yesNoOption'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 172
        echo "                                        </select>
                                    </div>
                                </div>

                                <div class=\"clearfix\">
                                    <label>File Extensions:</label>
                                    <div class=\"input\">
                                        <input type=\"text\" name=\"preview_audio_ext\" class=\"xxlarge\" value=\"";
        // line 179
        echo twig_escape_filter($this->env, ($context["preview_audio_ext"] ?? null), "html", null, true);
        echo "\"/>
                                        <p class=\"text-muted\">
                                            Default: mp3
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class=\"clearfix col_12\">
                        <div class=\"col_4 adminResponsiveHide\">&nbsp;</div>
                        <div class=\"col_8 last\">
                            <div class=\"clearfix\">
                                <div class=\"input no-label\">
                                    <input name=\"thumb_resize_method\" type=\"hidden\" value=\"cropped\"/>
                                    <input name=\"thumb_size_w\" type=\"hidden\" value=\"180\"/>
                                    <input name=\"thumb_size_h\" type=\"hidden\" value=\"150\"/>
                                    <input name=\"caching\" type=\"hidden\" value=\"1\"/>
                                    <input name=\"show_direct_link\" type=\"hidden\" value=\"0\"/>
                                    <input name=\"show_embedding\" type=\"hidden\" value=\"0\"/>
                                    <input name=\"image_quality\" type=\"hidden\" value=\"90\"/>
                                    <input name=\"watermark_enabled\" type=\"hidden\" value=\"0\"/>

                                    <input type=\"submit\" value=\"Submit\" class=\"button blue\">
                                    <input type=\"reset\" value=\"Reset\" class=\"button grey\">
                                </div>
                            </div>
                        </div>
                    </div>

                    <input name=\"submitted\" type=\"hidden\" value=\"1\"/>
                </form>
            </div>
        </div>   
    </div>
</div>
";
    }

    public function getTemplateName()
    {
        return "admin/plugin_settings.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  407 => 179,  398 => 172,  383 => 170,  379 => 169,  355 => 148,  346 => 141,  331 => 139,  327 => 138,  303 => 117,  291 => 107,  276 => 105,  272 => 104,  262 => 96,  247 => 94,  243 => 93,  220 => 72,  205 => 70,  201 => 69,  191 => 61,  176 => 59,  172 => 58,  162 => 50,  147 => 48,  143 => 47,  123 => 29,  108 => 27,  104 => 26,  89 => 14,  85 => 13,  80 => 11,  75 => 8,  71 => 7,  64 => 5,  57 => 4,  49 => 3,  38 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "admin/plugin_settings.html.twig", "/var/www/html/medicalimage/plugins/filepreviewer/views/admin/plugin_settings.html.twig");
    }
}
