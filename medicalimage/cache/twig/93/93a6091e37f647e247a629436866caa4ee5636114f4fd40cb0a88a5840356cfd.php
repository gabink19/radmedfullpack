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

/* privacy.html.twig */
class __TwigTemplate_444e3522d8eb873fb1b53fb8871f0bff520440064170934808b9a5c70b8dae20 extends \Twig\Template
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
        $this->parent = $this->loadTemplate("account/partial/layout_non_login.html.twig", "privacy.html.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("privacy_page_name", "Privacy"), "html", null, true);
    }

    // line 4
    public function block_description($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("privacy_meta_description", "Privacy policy."), "html", null, true);
    }

    // line 5
    public function block_keywords($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo twig_escape_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("privacy_meta_keywords", "privacy, policy, file, hosting, site"), "html", null, true);
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
        echo $this->extensions['App\Services\TTwigExtension']->tHandler("privacy_policy_text", "[[[SITE_NAME]]] respects your right to privacy. We asure you that all information submitted to us during the process of using our site will be kept strictly confidential and used solely by [[[SITE_NAME]]] to improve the user experience. At [[[SITE_NAME]]] we do not share, sell, rent, or distribute to any third party outside of [[[SITE_NAME]]] with the exception to legal purposes, regulation, or governmental authority.<br/>
<br/>
<strong>Information Collected</strong><br/>
<br/>
[[[SITE_NAME]]] securely holds data about it's users in order to process orders and provide account logins so they can access their purchases. The following data may be stored for each registered user of our site:<br/>
<br/>
- Your account email address.<br/>
- Your account password, stored using one-way hashing & encryption.<br/>
- Your title, firstname and lastname as supplied during the registration process.<br/>
- Your first, last and recent login IP addresses.<br/>
- Any data supplied by our payment gateways in order to process your order. These include address data, company name, your payment account email and your full name.<br/>
- Your browser user agent, referrering site and which pages you visited.<br/>
- You can receive a copy of this information by making a request via our <a href=\"contact.html\">contact form</a>.<br/>
<br/>
[[[SITE_NAME]]] does not collect and store any information such as credit card details.<br/>
<br/>
<strong>How The Information Collected Is Used</strong><br/>
<br/>
We mainly use the information collected to provide a service which has been requested by [[[SITE_NAME]]] users such as of sales and customer support. With permission, [[[SITE_NAME]]] may also use the provided email addresses to contact users periodically to inform them of [[[SITE_NAME]]] service and site announcements such as new products, promotions, and site or service updates. You may choose at any point to unsubscribe to these emails. [[[SITE_NAME]]] may also use the email addresses at any point to contact you for customer support services. [[[SITE_NAME]]] withholds the right to use any of the information provided by users for the purposes improving our site user experience, improving our advertising and marketing, and for legal disputes if required.<br/>
<br/>
<strong>Linked Sites</strong><br/>
<br/>
At any point we may provide [[[SITE_NAME]]] users with links to websites operated by other parties. These links are provided because they may be of use to users for any particular reason. [[[SITE_NAME]]] terms and conditions as well as privacy policy does not extend to third party sites and we are not responsible for the terms and privacy policy set by third party sites.<br/>
<br/>
<strong>Cookie Policy</strong><br/>
<br/>
For the purpose of enhancing our site and the customer experience, we have implemented small data files also known as cookies on your device. Most large sites do this also.<br/>
<br/>
<strong>What are cookies?</strong><br/>
<br/>
A cookie is a text file that is saved onto your computer or device when you visit certain sites. It allows the site to remember your actions and preferences (For example, login, language, etc) so you do not have to re-enter them each time you visit our site or browse between pages.<br/>
<br/>
<strong>How do we use cookies?</strong><br/>
<br/>
A number of our pages use cookies:<br/>
<br/>
- To remember if you have or have not agreed to use cookies on our sites.<br/>
- For external advertisers like Google Ads.<br/>
- By any login process to remember your current login session on the site.<br/>
<br/>
Enabling these cookies will provide you with a better browsing experience. You have the ability and every right to block or delete these cookies if you wish to do so, but certain features of this site may not work as intended. The cookie-related information and data is not used to identify any individual personally and the pattern data is fully under the control of [[[SITE_NAME]]]. The cookies are not used for any purpose other than described here.<br/>
<br/>
<strong>Do we use other cookies?</strong><br/>
<br/>
Some of our pages or sites may use additional or different cookies to the ones described above. If so the details of these will be provided in the specific cookie agreement notice for that particular page.<br/>
<br/>
<strong>How to control cookies</strong><br/>
<br/>
You can control and delete cookies if you wish to do so. For details on this please go to aboutcookies.org. You have the ability to delete all cookies that are already on your computer and most internet browsers have the ability to prevent them from being placed if configured to do so. As an added note, certain functionality on our site may not work as intended if this is done.<br/>
<br/>
[[[SITE_NAME]]] reserves the right to edit the above privacy policy at any time. Any changes made to the above privacy policy are active as soon as they are updated. Users of [[[SITE_NAME]]] sites agrees to regularly review this privacy policy and be aware of any alterations made to them. By the continual use of [[[SITE_NAME]]] sites and services, users agree to the above.", ["SITE_NAME" =>         // line 75
($context["SITE_CONFIG_SITE_NAME"] ?? null), "SITE_CONFIG_REPORT_ABUSE_EMAIL" => ($context["SITE_CONFIG_REPORT_ABUSE_EMAIL"] ?? null)]);
        echo "
                        <div class=\"login-bottom-links\">
                            <a href=\"";
        // line 77
        echo twig_escape_filter($this->env, ($context["CORE_SITE_PATH"] ?? null), "html", null, true);
        echo "/account/login\" class=\"link\"><i class=\"entypo-lock\"></i> ";
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->extensions['App\Services\TTwigExtension']->tHandler("back_to_login_form", "back to login form")), "html", null, true);
        echo "</a>
                        </div>
                    </div>
                </div>
                ";
        // line 81
        $this->loadTemplate("privacy.html.twig", "privacy.html.twig", 81, "710716636")->display($context);
        // line 82
        echo "            </div>
        </div>
        <!-- Bottom Scripts -->
        <script src=\"";
        // line 85
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 85), "html", null, true);
        echo "/gsap/main-gsap.js\"></script>
        <script src=\"";
        // line 86
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 86), "html", null, true);
        echo "/bootstrap.js\"></script>
        <script src=\"";
        // line 87
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 87), "html", null, true);
        echo "/joinable.js\"></script>
        <script src=\"";
        // line 88
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 88), "html", null, true);
        echo "/resizeable.js\"></script>
        <script src=\"";
        // line 89
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 89), "html", null, true);
        echo "/evolution-api.js\"></script>
        <script src=\"";
        // line 90
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 90), "html", null, true);
        echo "/jquery.validate.min.js\"></script>
        <script src=\"";
        // line 91
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 91), "html", null, true);
        echo "/evolution-login.js\"></script>
        <script src=\"";
        // line 92
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["theme"] ?? null), "getAccountJsPath", [], "method", false, false, false, 92), "html", null, true);
        echo "/custom.js\"></script>
    </body>
";
    }

    public function getTemplateName()
    {
        return "privacy.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  210 => 92,  206 => 91,  202 => 90,  198 => 89,  194 => 88,  190 => 87,  186 => 86,  182 => 85,  177 => 82,  175 => 81,  166 => 77,  161 => 75,  110 => 25,  92 => 14,  88 => 13,  82 => 9,  78 => 8,  71 => 6,  64 => 5,  57 => 4,  50 => 3,  39 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "privacy.html.twig", "/var/www/html/medicalimage/themes/evolution/views/privacy.html.twig");
    }
}


/* privacy.html.twig */
class __TwigTemplate_444e3522d8eb873fb1b53fb8871f0bff520440064170934808b9a5c70b8dae20___710716636 extends \Twig\Template
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
        // line 81
        return "account/partial/non_login_footer_links.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $this->parent = $this->loadTemplate("account/partial/non_login_footer_links.html.twig", "privacy.html.twig", 81);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    public function getTemplateName()
    {
        return "privacy.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  257 => 81,  210 => 92,  206 => 91,  202 => 90,  198 => 89,  194 => 88,  190 => 87,  186 => 86,  182 => 85,  177 => 82,  175 => 81,  166 => 77,  161 => 75,  110 => 25,  92 => 14,  88 => 13,  82 => 9,  78 => 8,  71 => 6,  64 => 5,  57 => 4,  50 => 3,  39 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "privacy.html.twig", "/var/www/html/medicalimage/themes/evolution/views/privacy.html.twig");
    }
}
