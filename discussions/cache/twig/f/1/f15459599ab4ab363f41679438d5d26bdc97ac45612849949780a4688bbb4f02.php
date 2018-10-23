<?php

/* acp_contact.html */
class __TwigTemplate_f15459599ab4ab363f41679438d5d26bdc97ac45612849949780a4688bbb4f02 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        $location = "overall_header.html";
        $namespace = false;
        if (strpos($location, '@') === 0) {
            $namespace = substr($location, 1, strpos($location, '/') - 1);
            $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
            $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
        }
        $this->loadTemplate("overall_header.html", "acp_contact.html", 1)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
        // line 2
        echo "
<script type=\"text/javascript\">
// <![CDATA[

\tvar form_name = 'acp_contact';
\tvar text_name = 'contact_admin_info';
\tvar load_draft = false;
\tvar upload = false;
\tvar imageTag = false;

// ]]>
</script>

<a id=\"maincontent\"></a>

<h1>";
        // line 17
        echo $this->env->getExtension('phpbb')->lang("ACP_CONTACT_SETTINGS");
        echo "</h1>

<p>";
        // line 19
        echo $this->env->getExtension('phpbb')->lang("ACP_CONTACT_SETTINGS_EXPLAIN");
        echo "</p>

<form id=\"acp_contact\" method=\"post\" action=\"";
        // line 21
        echo (isset($context["U_ACTION"]) ? $context["U_ACTION"] : null);
        echo "\">
\t<fieldset>
\t\t<legend>";
        // line 23
        echo $this->env->getExtension('phpbb')->lang("GENERAL_OPTIONS");
        echo "</legend>
\t\t<dl>
\t\t\t<dt><label for=\"contact_admin_form_enable\">";
        // line 25
        echo $this->env->getExtension('phpbb')->lang("CONTACT_US_ENABLE");
        echo $this->env->getExtension('phpbb')->lang("COLON");
        echo "</label><br /><span>";
        echo $this->env->getExtension('phpbb')->lang("CONTACT_US_ENABLE_EXPLAIN");
        echo "</span></dt>
\t\t\t<dd>
\t\t\t\t<label><input type=\"radio\" class=\"radio\" id=\"contact_admin_form_enable\" name=\"contact_admin_form_enable\" value=\"1\"";
        // line 27
        if ((isset($context["CONTACT_ENABLED"]) ? $context["CONTACT_ENABLED"] : null)) {
            echo " checked=\"checked\"";
        }
        echo " /> ";
        echo $this->env->getExtension('phpbb')->lang("ENABLED");
        echo "</label>
\t\t\t\t<label><input type=\"radio\" class=\"radio\" name=\"contact_admin_form_enable\" value=\"0\"";
        // line 28
        if ( !(isset($context["CONTACT_ENABLED"]) ? $context["CONTACT_ENABLED"] : null)) {
            echo " checked=\"checked\"";
        }
        echo " /> ";
        echo $this->env->getExtension('phpbb')->lang("DISABLED");
        echo "</label>
\t\t\t</dd>
\t\t</dl>
\t</fieldset>

\t";
        // line 33
        if ((isset($context["CONTACT_US_INFO_PREVIEW"]) ? $context["CONTACT_US_INFO_PREVIEW"] : null)) {
            // line 34
            echo "\t<fieldset>
\t\t<legend>";
            // line 35
            echo $this->env->getExtension('phpbb')->lang("CONTACT_US_INFO_PREVIEW");
            echo "</legend>
\t\t<p>";
            // line 36
            echo (isset($context["CONTACT_US_INFO_PREVIEW"]) ? $context["CONTACT_US_INFO_PREVIEW"] : null);
            echo "</p>
\t</fieldset>
\t";
        }
        // line 39
        echo "
\t<fieldset>
\t\t<legend>";
        // line 41
        echo $this->env->getExtension('phpbb')->lang("CONTACT_US_INFO");
        echo "</legend>
\t\t<p>";
        // line 42
        echo $this->env->getExtension('phpbb')->lang("CONTACT_US_INFO_EXPLAIN");
        echo "</p>

\t\t";
        // line 44
        $location = "acp_posting_buttons.html";
        $namespace = false;
        if (strpos($location, '@') === 0) {
            $namespace = substr($location, 1, strpos($location, '/') - 1);
            $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
            $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
        }
        $this->loadTemplate("acp_posting_buttons.html", "acp_contact.html", 44)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
        // line 45
        echo "
\t\t<dl class=\"responsive-columns\">
\t\t\t<dt style=\"width: 90px;\" id=\"color_palette_placeholder\" data-orientation=\"v\" data-height=\"12\" data-width=\"15\" data-bbcode=\"true\">
\t\t\t</dt>

\t\t\t<dd style=\"margin-";
        // line 50
        echo (isset($context["S_CONTENT_FLOW_BEGIN"]) ? $context["S_CONTENT_FLOW_BEGIN"] : null);
        echo ": 90px;\">
\t\t\t\t<textarea name=\"contact_admin_info\" rows=\"10\" cols=\"60\" style=\"width: 95%;\" onselect=\"storeCaret(this);\" onclick=\"storeCaret(this);\" onkeyup=\"storeCaret(this);\" onfocus=\"initInsertions();\" data-bbcode=\"true\">";
        // line 51
        echo (isset($context["CONTACT_US_INFO"]) ? $context["CONTACT_US_INFO"] : null);
        echo "</textarea>
\t\t\t</dd>

\t\t\t<dd style=\"margin-";
        // line 54
        echo (isset($context["S_CONTENT_FLOW_BEGIN"]) ? $context["S_CONTENT_FLOW_BEGIN"] : null);
        echo ": 90px; margin-top: 5px;\">
\t\t\t\t";
        // line 55
        if ((isset($context["S_BBCODE_ALLOWED"]) ? $context["S_BBCODE_ALLOWED"] : null)) {
            // line 56
            echo "\t\t\t\t<label><input type=\"checkbox\" class=\"radio\" name=\"disable_bbcode\"";
            if ((isset($context["S_BBCODE_DISABLE_CHECKED"]) ? $context["S_BBCODE_DISABLE_CHECKED"] : null)) {
                echo " checked=\"checked\"";
            }
            echo " /> ";
            echo $this->env->getExtension('phpbb')->lang("DISABLE_BBCODE");
            echo "</label>
\t\t\t\t";
        }
        // line 58
        echo "\t\t\t\t";
        if ((isset($context["S_SMILIES_ALLOWED"]) ? $context["S_SMILIES_ALLOWED"] : null)) {
            // line 59
            echo "\t\t\t\t<label><input type=\"checkbox\" class=\"radio\" name=\"disable_smilies\"";
            if ((isset($context["S_SMILIES_DISABLE_CHECKED"]) ? $context["S_SMILIES_DISABLE_CHECKED"] : null)) {
                echo " checked=\"checked\"";
            }
            echo " /> ";
            echo $this->env->getExtension('phpbb')->lang("DISABLE_SMILIES");
            echo "</label>
\t\t\t\t";
        }
        // line 61
        echo "\t\t\t\t";
        if ((isset($context["S_LINKS_ALLOWED"]) ? $context["S_LINKS_ALLOWED"] : null)) {
            // line 62
            echo "\t\t\t\t<label><input type=\"checkbox\" class=\"radio\" name=\"disable_magic_url\"";
            if ((isset($context["S_MAGIC_URL_DISABLE_CHECKED"]) ? $context["S_MAGIC_URL_DISABLE_CHECKED"] : null)) {
                echo " checked=\"checked\"";
            }
            echo " /> ";
            echo $this->env->getExtension('phpbb')->lang("DISABLE_MAGIC_URL");
            echo "</label>
\t\t\t\t";
        }
        // line 64
        echo "\t\t\t</dd>
\t\t\t<dd style=\"margin-";
        // line 65
        echo (isset($context["S_CONTENT_FLOW_BEGIN"]) ? $context["S_CONTENT_FLOW_BEGIN"] : null);
        echo ": 90px; margin-top: 10px;\"><strong>";
        echo $this->env->getExtension('phpbb')->lang("OPTIONS");
        echo $this->env->getExtension('phpbb')->lang("COLON");
        echo " </strong>";
        echo (isset($context["BBCODE_STATUS"]) ? $context["BBCODE_STATUS"] : null);
        echo " :: ";
        echo (isset($context["IMG_STATUS"]) ? $context["IMG_STATUS"] : null);
        echo " :: ";
        echo (isset($context["FLASH_STATUS"]) ? $context["FLASH_STATUS"] : null);
        echo " :: ";
        echo (isset($context["URL_STATUS"]) ? $context["URL_STATUS"] : null);
        echo " :: ";
        echo (isset($context["SMILIES_STATUS"]) ? $context["SMILIES_STATUS"] : null);
        echo "</dd>
\t\t</dl>
\t</fieldset>

\t<fieldset class=\"submit-buttons\">
\t\t<input class=\"button1\" type=\"submit\" id=\"submit\" name=\"submit\" value=\"";
        // line 70
        echo $this->env->getExtension('phpbb')->lang("SUBMIT");
        echo "\" />&nbsp;
\t\t<input class=\"button2\" type=\"submit\" name=\"preview\" value=\"";
        // line 71
        echo $this->env->getExtension('phpbb')->lang("PREVIEW");
        echo "\" />
\t\t";
        // line 72
        echo (isset($context["S_FORM_TOKEN"]) ? $context["S_FORM_TOKEN"] : null);
        echo "
\t</fieldset>
</form>

";
        // line 76
        $location = "overall_footer.html";
        $namespace = false;
        if (strpos($location, '@') === 0) {
            $namespace = substr($location, 1, strpos($location, '/') - 1);
            $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
            $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
        }
        $this->loadTemplate("overall_footer.html", "acp_contact.html", 76)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
    }

    public function getTemplateName()
    {
        return "acp_contact.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  234 => 76,  227 => 72,  223 => 71,  219 => 70,  198 => 65,  195 => 64,  185 => 62,  182 => 61,  172 => 59,  169 => 58,  159 => 56,  157 => 55,  153 => 54,  147 => 51,  143 => 50,  136 => 45,  124 => 44,  119 => 42,  115 => 41,  111 => 39,  105 => 36,  101 => 35,  98 => 34,  96 => 33,  84 => 28,  76 => 27,  68 => 25,  63 => 23,  58 => 21,  53 => 19,  48 => 17,  31 => 2,  19 => 1,);
    }
}
