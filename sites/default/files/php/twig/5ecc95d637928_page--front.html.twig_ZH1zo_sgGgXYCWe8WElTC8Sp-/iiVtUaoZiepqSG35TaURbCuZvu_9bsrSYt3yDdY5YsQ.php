<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* themes/custom/govind/page--front.html.twig */
class __TwigTemplate_d5381927c71c5c88b77bf4901b855794926b475dd841ccb681c4f36e6daaa01c extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = ["include" => 1, "if" => 11];
        $filters = ["escape" => 8];
        $functions = [];

        try {
            $this->sandbox->checkSecurity(
                ['include', 'if'],
                ['escape'],
                []
            );
        } catch (SecurityError $e) {
            $e->setSourceContext($this->getSourceContext());

            if ($e instanceof SecurityNotAllowedTagError && isset($tags[$e->getTagName()])) {
                $e->setTemplateLine($tags[$e->getTagName()]);
            } elseif ($e instanceof SecurityNotAllowedFilterError && isset($filters[$e->getFilterName()])) {
                $e->setTemplateLine($filters[$e->getFilterName()]);
            } elseif ($e instanceof SecurityNotAllowedFunctionError && isset($functions[$e->getFunctionName()])) {
                $e->setTemplateLine($functions[$e->getFunctionName()]);
            }

            throw $e;
        }

    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        // line 1
        $this->loadTemplate((($context["directory"] ?? null) . "/partials/header.html.twig"), "themes/custom/govind/page--front.html.twig", 1)->display($context);
        // line 2
        echo "<div class=\"container\">
  <main role=\"main\">
    <a id=\"main-content\" tabindex=\"-1\"></a>";
        // line 5
        echo "
    <div class=\"layout-content\">
      <div class=\"article-list\">
        ";
        // line 8
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "content", [])), "html", null, true);
        echo "
      </div>
    </div>
    ";
        // line 11
        echo " ";
        if ($this->getAttribute(($context["page"] ?? null), "sidebar", [])) {
            // line 12
            echo "    <aside class=\"layout-sidebar-first\" role=\"complementary\">
      ";
            // line 13
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "sidebar", [])), "html", null, true);
            echo "
      ";
            // line 14
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "latest_movies", [])), "html", null, true);
            echo "
    </aside>
    ";
        }
        // line 17
        echo "  </main>
</div>
";
        // line 19
        echo " ";
        $this->loadTemplate((($context["directory"] ?? null) . "/partials/footer.html.twig"), "themes/custom/govind/page--front.html.twig", 19)->display($context);
    }

    public function getTemplateName()
    {
        return "themes/custom/govind/page--front.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  92 => 19,  88 => 17,  82 => 14,  78 => 13,  75 => 12,  72 => 11,  66 => 8,  61 => 5,  57 => 2,  55 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "themes/custom/govind/page--front.html.twig", "/var/www/drupal8/themes/custom/govind/page--front.html.twig");
    }
}
