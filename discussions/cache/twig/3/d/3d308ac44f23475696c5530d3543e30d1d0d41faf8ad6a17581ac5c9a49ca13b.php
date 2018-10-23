<?php

/* user_welcome.txt */
class __TwigTemplate_3d308ac44f23475696c5530d3543e30d1d0d41faf8ad6a17581ac5c9a49ca13b extends Twig_Template
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
        echo "Subject: Bienvenue sur les forums de « ";
        echo (isset($context["SITENAME"]) ? $context["SITENAME"] : null);
        echo " »

";
        // line 3
        echo (isset($context["WELCOME_MSG"]) ? $context["WELCOME_MSG"] : null);
        echo "

Conservez cet e-mail dans vos archives. Les informations de votre compte sont les suivantes :

----------------------------
Nom d’utilisateur : ";
        // line 8
        echo (isset($context["USERNAME"]) ? $context["USERNAME"] : null);
        echo "

Adresse du forum : ";
        // line 10
        echo (isset($context["U_BOARD"]) ? $context["U_BOARD"] : null);
        echo "
----------------------------

Votre mot de passe a été stocké de manière sécurisée dans notre base de données et ne pourra pas être retrouvé. Dans le cas où vous l’auriez oublié, vous pourrez le réinitialiser en utilisant l’adresse e-mail associée à votre compte.

Merci de vous être enregistré.

";
        // line 17
        echo (isset($context["EMAIL_SIG"]) ? $context["EMAIL_SIG"] : null);
        echo "
";
    }

    public function getTemplateName()
    {
        return "user_welcome.txt";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  48 => 17,  38 => 10,  33 => 8,  25 => 3,  19 => 1,);
    }
}
