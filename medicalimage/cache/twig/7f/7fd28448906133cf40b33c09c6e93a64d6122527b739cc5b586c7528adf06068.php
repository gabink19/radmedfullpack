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

/* admin/api_test_framework.html.twig */
class __TwigTemplate_84dd36400477a93ea6fdf67f1cf69dee9f5d97c22711400dd06cd5d242f8bd56 extends \Twig\Template
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
        $this->parent = $this->loadTemplate("admin/partial/layout_logged_in.html.twig", "admin/api_test_framework.html.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo "API Testing Tool";
    }

    // line 4
    public function block_selected_page($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo "api";
    }

    // line 5
    public function block_selected_sub_page($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo "api_test_framework";
    }

    // line 7
    public function block_body($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 8
        echo "    <script>
        \$(document).ready(function () {
            rebuildApiForm();
        });

        var replacementAccessToken = '';
        var replacementAccountId = '';
        var lastUrl = '';
        var lastAction = '';
        function rebuildApiForm()
        {
            params = jQuery.parseJSON(\$('#api_action option:selected').attr('data-params'));
            newForm = '';
            for (i in params)
            {
                newForm += '<div class=\"form-group\">';
                newForm += '    <label class=\"control-label col-md-3 col-sm-3 col-xs-12\" for=\"confirm_password\" style=\"text-transform: none;\">' + i + ':</span>';
                newForm += '    </label>';
                newForm += '    <div class=\"col-md-3 col-sm-3 col-xs-12\">';

                newForm += '        <input id=\"' + i + '\" name=\"' + i + '\" class=\"form-control api_params\" type=\"';
                if (i == 'password')
                {
                    newForm += 'password';
                } else if (i == 'upload_file')
                {
                    newForm += 'file';
                } else
                {
                    newForm += 'text';
                }
                newForm += '\" value=\"' + replaceParam(i, params[i]) + '\"/>';


                newForm += '    </div>';
                newForm += '</div>';
            }

            \$('#appendedForm').html(newForm);
        }

        function replaceParam(paramName, initialValue)
        {
            if (paramName == 'access_token')
            {
                return replacementAccessToken;
            } else if (paramName == 'account_id')
            {
                return replacementAccountId;
            }

            return initialValue;
        }

        function submitApiRequest()
        {
            apiUrl = \"";
        // line 64
        echo twig_escape_filter($this->env, ($context["apiUrl"] ?? null), "html", null, true);
        echo "\";
            apiUrl += \$('#api_action option:selected').val().substring(1);
            lastUrl = apiUrl;
            lastAction = \$('#api_action option:selected').val();

            apiParams = {};
            \$('.api_params').each(function () {
                apiParams[\$(this).attr('id')] = \$(this).val();
            });

            showRequest(apiUrl, apiParams);
            setResponseLoading();

            // find form
            var form = \$('#testForm');

            // send request
            \$.ajax({
                method: \"POST\",
                dataType: 'json',
                cache: false,
                contentType: false,
                processData: false,
                url: apiUrl,
                data: new FormData(\$(form)[0])
            })
                    .done(function (msg) {
                        setSuccessResponse(msg);
                        // store the access_token and account_id
                        if (typeof (msg['data']['access_token']) != 'undefined')
                        {
                            replacementAccessToken = msg['data']['access_token'];
                            replacementAccountId = msg['data']['account_id'];
                        }
                    })
                    .fail(function (msg) {
                        setErrorResponse(msg.responseText);
                    });
        }

        function showRequest(apiUrl, apiParams)
        {
            \$('.request-content').show();
            \$('.request-content .literal-block').html(apiUrl + \"\\n\\t?\" + jQuery.param(apiParams, null));
        }

        function hideResponseBoxes()
        {
            \$('.response-error').hide();
            \$('.response-success').hide();
        }

        function setResponseLoading()
        {
            hideResponseBoxes();
            \$('.response-success .literal-block').html('Loading...');
            \$('.response-success').show();
        }

        function setSuccessResponse(jsonText)
        {
            hideResponseBoxes();
            \$('.response-success .literal-block').html(htmlEncode(JSON.stringify(jsonText, null, '\\t')));
            \$('.response-success').show();
        }

        function setErrorResponse(responseText)
        {
            hideResponseBoxes();
            \$('.response-error .x_content').html(\"<div class='alert alert-danger'>Error: Failed finding url: \" + lastUrl + \" \" + htmlEncode(responseText) + \"</div>\");
            \$('.response-error').show();
        }

        function htmlEncode(value)
        {
            return \$('<div/>').text(value).html();
        }
    </script>

    <div class=\"right_col\" role=\"main\">
        <div class=\"\">
            <div class=\"page-title\">
                <div class=\"title_left\">
                    <h3>API Testing Tool</h3>
                </div>
            </div>
            <div class=\"clearfix\"></div>

            ";
        // line 152
        echo ($context["msg_page_notifications"] ?? null);
        echo "

            <div class=\"row request-content\" style=\"display: none;\">
                <div class=\"col-md-12 col-sm-12 col-xs-12\">
                    <div class=\"x_panel\">
                        <div class=\"x_title\">
                            <h2>Request</h2>
                            <div class=\"clearfix\"></div>
                        </div>
                        <div class=\"x_content\">
                            <pre class=\"literal-block\"></pre>
                        </div>
                    </div>
                </div>
            </div>

            <div class=\"row response-success\" style=\"display: none;\">
                <div class=\"col-md-12 col-sm-12 col-xs-12\">
                    <div class=\"x_panel\">
                        <div class=\"x_title\">
                            <h2>JSON Response</h2>
                            <div class=\"clearfix\"></div>
                        </div>
                        <div class=\"x_content\">
                            <pre class=\"literal-block\"></pre>
                        </div>
                    </div>
                </div>
            </div>

            <div class=\"row response-error\" style=\"display: none;\">
                <div class=\"col-md-12 col-sm-12 col-xs-12\">
                    <div class=\"x_panel\">
                        <div class=\"x_title\">
                            <h2>Error 404</h2>
                            <div class=\"clearfix\"></div>
                        </div>
                        <div class=\"x_content\">
                        </div>
                    </div>
                </div>
            </div>

            <div class=\"row\">
                <div class=\"col-md-12 col-sm-12 col-xs-12\">
                    <form action=\"#\" method=\"POST\" id=\"testForm\" class=\"form-horizontal form-label-left\" enctype=\"multipart/form-data\" onSubmit=\"submitApiRequest();
                            return false;\">
                        <div class=\"x_panel\">
                            <div class=\"x_title\">
                                <h2>Select Action</h2>
                                <div class=\"clearfix\"></div>
                            </div>
                            <div class=\"x_content\">
                                <p>Select the API action below. Ensure you've initially generated an access key for your request by submitting '/authorize' below.</p>
                                <br/>

                                <div class=\"form-group\">
                                    <label class=\"control-label col-md-3 col-sm-3 col-xs-12\" for=\"api_action\">Action:</span>
                                    </label>
                                    <div class=\"col-md-3 col-sm-3 col-xs-12\">
                                        <select id=\"api_action\" name=\"api_action\" class=\"form-control\" required=\"required\" onChange=\"rebuildApiForm();
                                                return false;\">
                                            ";
        // line 214
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["actions"] ?? null));
        foreach ($context['_seq'] as $context["action"] => $context["params"]) {
            // line 215
            echo "                                                <option value=\"";
            echo twig_escape_filter($this->env, $context["action"], "html", null, true);
            echo "\" data-params=\"";
            echo twig_escape_filter($this->env, json_encode($context["params"], true), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $context["action"], "html", null, true);
            echo "</option>
                                            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['action'], $context['params'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 217
        echo "                                        </select>
                                    </div>
                                </div>

                                <span id=\"appendedForm\"></span>

                                <div class=\"ln_solid\"></div>
                                <div class=\"form-group\">
                                    <div class=\"col-md-6 col-sm-6 col-xs-12 col-md-offset-3\">
                                        <button type=\"submit\" class=\"btn btn-primary\">Submit API Request</button>
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
        return "admin/api_test_framework.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  305 => 217,  292 => 215,  288 => 214,  223 => 152,  132 => 64,  74 => 8,  70 => 7,  63 => 5,  56 => 4,  49 => 3,  38 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "admin/api_test_framework.html.twig", "/var/www/html/medicalimage/app/views/admin/api_test_framework.html.twig");
    }
}
