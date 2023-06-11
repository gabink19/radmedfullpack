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

/* terms.html.twig */
class __TwigTemplate_f2b1b53338afb8db8c26a559b35141d32e8d2c58ccba123d2e5e640ccf52b63b extends \Twig\Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'title' => [$this, 'block_title'],
            'description' => [$this, 'block_description'],
            'keywords' => [$this, 'block_keywords'],
            'html_element_class' => [$this, 'block_html_element_class'],
            'body' => [$this, 'block_body'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return "account/partial/layout_non_login.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $this->parent = $this->loadTemplate("account/partial/layout_non_login.html.twig", "terms.html.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("terms_page_name", "Terms & Conditions"), "html", null, true);
    }

    // line 4
    public function block_description($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("terms_meta_description", "Terms & conditions of use."), "html", null, true);
    }

    // line 5
    public function block_keywords($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("terms_meta_keywords", "terms, and, conditions, file, hosting, site"), "html", null, true);
    }

    // line 6
    public function block_html_element_class($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo "login-page-wrapper";
    }

    // line 8
    public function block_body($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 9
        echo "    <body class=\"page-body login-page login-form-fall register-page\">
        <div class=\"login-container\">
            <div class=\"login-header login-caret\">
                <div class=\"login-content\">
                    <a href=\"";
        // line 13
        echo twig_escape_filter($this->env, ($context["CORE_SITE_PATH"] ?? null), "html", null, true);
        echo "\" class=\"logo\">
                        <img src=\"";
        // line 14
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getMainLogoUrl", [], "method", false, false, false, 14), "html", null, true);
        echo "\" alt=\"";
        echo twig_escape_filter($this->env, ($context["SITE_CONFIG_SITE_NAME"] ?? null), "html", null, true);
        echo "\" alt=\"";
        echo twig_escape_filter($this->env, ($context["SITE_CONFIG_SITE_NAME"] ?? null), "html", null, true);
        echo "\"/>
                    </a>
                </div>
            </div>
            <div class=\"login-progressbar\">
                <div></div>
            </div>
            <div class=\"login-form\">
                <div class=\"login-content wide-view\">
                    <div class=\"login-main-box\">
                        <p class=\"description\">
                            ";
        // line 25
        echo $this->extensions['App\Services\TTwigExtension']->tHandler("terms_and_conditions_text", "<strong>Basic TOS</strong><br/>
<br/>
All users must be of at least the age of 13, and agree to not use the [[[SITE_NAME]]] service for any illegal or unauthorized purposes. All users must agree to comply with local laws regarding online conduct, and copyright laws. [[[SITE_NAME]]] is intended for personal use, and any business use is strictly prohibited. All users must not use [[[SITE_NAME]]]'s services to violate any laws which include but are not limited to copyright laws. Any violations will result in immediate deletion of all files [[[SITE_NAME]]] has on record for your IP Address.<br/>
<br/>
All users use [[[SITE_NAME]]] at their own risk, users understand that files uploaded on [[[SITE_NAME]]] are not private, they may be displayed for others to view, and [[[SITE_NAME]]] users understand and agree that [[[SITE_NAME]]] cannot be responsible for the content posted on its web site and you nonetheless may be exposed to such materials and that you use [[[SITE_NAME]]]'s service at your own risk.<br/>
<br/>
<strong>Conditions</strong><br/>
<br/>
- We reserve the right to modify or terminate the [[[SITE_NAME]]] service for any reason, without notice at any time.<br/>
- We reserve the right to alter these Terms of Use at any time.<br/>
- We reserve the right to refuse service to anyone for any reason at any time.<br/>
- We may, but have no obligation to, remove Content and accounts containing Content that we determine in our sole discretion are unlawful, offensive, threatening, libelous, defamatory, obscene or otherwise objectionable or violates any party's intellectual property or these Terms of Use.<br/>
- If a user is found to be using [[[SITE_NAME]]] to host icons, smileys, buddy icons, forum avatars, forum badges, forum signature images, or any other graphic for website design all your images will be removed.<br/>
<br/>
<strong>Copyright Information</strong><br/>
<br/>
[[[SITE_NAME]]] claims no intellectual property rights over the images uploaded by its' users.<br/>
<br/>
[[[SITE_NAME]]] will review all copyright &copy; infringement claims received and remove files found to have been upload or distributed in violation of any such laws. To make a valid claim you must provide [[[SITE_NAME]]] with the following information:<br/>
<br/>
- A physical or electronic signature of the copyright owner or the person authorized to act on its behalf;<br/>
- A description of the copyrighted work claimed to have been infringed;<br/>
- A description of the infringing material and information reasonably sufficient to permit [[[SITE_NAME]]] to locate the material;<br/>
- Your contact information, including your address, telephone number, and email;<br/>
- A statement by you that you have a good faith belief that use of the material in the manner complained of is not authorized by the copyright owner, its agent, or the law; and<br/>
- A statement that the information in the notification is accurate, and, under the pains and penalties of perjury, that you are authorized to act on behalf of the copyright owner.<br/>
<br/>
Claims can be sent to us by emailing support on [[[SITE_CONFIG_REPORT_ABUSE_EMAIL]]].", ["SITE_NAME" =>         // line 52
($context["SITE_CONFIG_SITE_NAME"] ?? null), "SITE_CONFIG_REPORT_ABUSE_EMAIL" => ($context["SITE_CONFIG_REPORT_ABUSE_EMAIL"] ?? null)]);
        echo "
                        <div class=\"login-bottom-links\">
                            <a href=\"";
        // line 54
        echo twig_escape_filter($this->env, ($context["CORE_SITE_PATH"] ?? null), "html", null, true);
        echo "/account/login\" class=\"link\"><i class=\"entypo-lock\"></i> ";
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("back_to_login_form", "back to login form")), "html", null, true);
        echo "</a>
                        </div>
                    </div>
                </div>
                ";
        // line 58
        $this->loadTemplate("terms.html.twig", "terms.html.twig", 58, "352112649")->display($context);
        // line 59
        echo "            </div>
        </div>
        <!-- Bottom Scripts -->
        <script src=\"";
        // line 62
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 62), "html", null, true);
        echo "/gsap/main-gsap.js\"></script>
        <script src=\"";
        // line 63
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 63), "html", null, true);
        echo "/bootstrap.js\"></script>
        <script src=\"";
        // line 64
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 64), "html", null, true);
        echo "/joinable.js\"></script>
        <script src=\"";
        // line 65
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 65), "html", null, true);
        echo "/resizeable.js\"></script>
        <script src=\"";
        // line 66
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 66), "html", null, true);
        echo "/evolution-api.js\"></script>
        <script src=\"";
        // line 67
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 67), "html", null, true);
        echo "/jquery.validate.min.js\"></script>
        <script src=\"";
        // line 68
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 68), "html", null, true);
        echo "/evolution-login.js\"></script>
        <script src=\"";
        // line 69
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 69), "html", null, true);
        echo "/custom.js\"></script>
    </body>
";
    }

    public function getTemplateName()
    {
        return "terms.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  187 => 69,  183 => 68,  179 => 67,  175 => 66,  171 => 65,  167 => 64,  163 => 63,  159 => 62,  154 => 59,  152 => 58,  143 => 54,  138 => 52,  110 => 25,  92 => 14,  88 => 13,  82 => 9,  78 => 8,  71 => 6,  64 => 5,  57 => 4,  50 => 3,  39 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "terms.html.twig", "/var/www/html/medicalimage/themes/evolution/views/terms.html.twig");
    }
}


/* terms.html.twig */
class __TwigTemplate_f2b1b53338afb8db8c26a559b35141d32e8d2c58ccba123d2e5e640ccf52b63b___352112649 extends \Twig\Template
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
        // line 58
        return "account/partial/non_login_footer_links.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $this->parent = $this->loadTemplate("account/partial/non_login_footer_links.html.twig", "terms.html.twig", 58);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    public function getTemplateName()
    {
        return "terms.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  234 => 58,  187 => 69,  183 => 68,  179 => 67,  175 => 66,  171 => 65,  167 => 64,  163 => 63,  159 => 62,  154 => 59,  152 => 58,  143 => 54,  138 => 52,  110 => 25,  92 => 14,  88 => 13,  82 => 9,  78 => 8,  71 => 6,  64 => 5,  57 => 4,  50 => 3,  39 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "terms.html.twig", "/var/www/html/medicalimage/themes/evolution/views/terms.html.twig");
    }
}
