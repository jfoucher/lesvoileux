<?php
/**
 * WebExtension.php
 *
 * Created By: jonathan
 * Date: 1/9/13
 * Time: 10:18 PM
 */

namespace Voileux\WebBundle\Twig;
use Symfony\Component\DependencyInjection\ContainerInterface;

class WebExtension extends \Twig_Extension
{

    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function getFilters()
    {
        return array(
            'currencySymbol' => new \Twig_Filter_Method($this, 'currencyCodeToSymbol'),
            'gravatar' => new \Twig_Filter_Method($this, 'gravatar'),
        );
    }

    public function getFunctions()
    {
        return array(
            'renderTemplates' => new \Twig_Function_Method($this, 'renderTemplatesFunction'),
            'renderHtmlTag' => new \Twig_Function_Method($this, 'renderHtmlTagFunction'),
            'getParameter' => new \Twig_Function_Method($this, 'getParameterFunction'),
            'isEnabled' => new \Twig_Function_Method($this, 'isEnabledFunction'),
        );
    }

    public function isEnabledFunction($item) {

        $paramName = 'voileux.features.' . $item;
        if ($this->container->hasParameter($paramName)) {
            return $this->container->getParameter($paramName);
        }

        return false;
    }


    public function gravatar($str, $size = 105)
    {
        $hash = md5(strtolower($str));
        return "http://www.gravatar.com/avatar/$hash?s=$size&d=retro";
    }

    public function currencyCodeToSymbol($str) {
        $currencies = array(
            'EUR' => '€',
            'USD' => '$',
            'GBP' => '£',
            'AUD' => '$',

        );

        return $currencies[$str];
    }


    public function renderTemplatesFunction($subdir = '', $suffix = '', $context = array())
    {
        $twig = $this->container->get('twig');

        $dir = dirname(__DIR__) . '/Resources/views/tmpl/' . $subdir;
        $files = scandir($dir);

        $debug = $this->container->getParameter('kernel.debug');

        foreach ($files as $file) {

            $extension = pathinfo($file, PATHINFO_EXTENSION);

            if ('haml' !== $extension && 'twig' !== $extension) {
                continue;
            }

            $filename = pathinfo(pathinfo($file, PATHINFO_FILENAME), PATHINFO_FILENAME);

            echo '<script type="text/template" id="' . $filename . $suffix . '-tmpl">', "\n";

            $str = $twig->render('StampliaWebBundle:tmpl:' . $subdir . $file, $context);
            if (!$debug) {
                $str = preg_replace('#\s+#', ' ', $str);
            }
            echo $str;

            echo '</script>';
        }
    }

    public function renderHtmlTagFunction($lang)
    {
        echo '
  <!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="'.$lang.'"> <![endif]-->
  <!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang="'.$lang.'"> <![endif]-->
  <!--[if IE 8]>         <html class="no-js lt-ie9" lang="'.$lang.'"> <![endif]-->
  <!--[if gt IE 8]><!--> <html class="no-js" lang="'.$lang.'"> <!--<![endif]-->
  <!--[if (gt IE 9)|!(IE)]><!--> <html lang="'.$lang.'"> <!--<![endif]-->
  ';


    }

    public function getName()
    {
        return 'voileux_web_extension';
    }
}
