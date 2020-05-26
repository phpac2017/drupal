<?php

namespace Drupal\embed\Controller;

use Drupal\Core\Ajax\AjaxHelperTrait;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Language\LanguageInterface;
use Drupal\Core\Render\RendererInterface;
use Drupal\editor\EditorInterface;
use Drupal\embed\Ajax\EmbedInsertCommand;
use Drupal\embed\EmbedButtonInterface;
use Drupal\filter\FilterFormatInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Returns responses for Embed module routes.
 */
class EmbedController extends ControllerBase {

  use AjaxHelperTrait;

  /**
   * The renderer service.
   *
   * @var \Drupal\Core\Render\RendererInterface
   */
  protected $renderer;

  /**
   * Constructs an EmbedController instance.
   *
   * @param \Drupal\Core\Render\RendererInterface $renderer
   *   The renderer service.
   */
  public function __construct(RendererInterface $renderer) {
    $this->renderer = $renderer;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('renderer')
    );
  }

  /**
   * Returns an Ajax response to generate preview of embedded items.
   *
   * Expects the the HTML element as GET parameter.
   *
   * @param \Symfony\Component\HttpFoundation\Request $request
   *   The request object.
   * @param \Drupal\filter\FilterFormatInterface $filter_format
   *   The filter format.
   *
   * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
   *   Throws an exception if 'value' parameter is not found in the request.
   *
   * @return \Symfony\Component\HttpFoundation\Response
   *   The preview of the embedded item specified by the data attributes.
   */
  public function preview(Request $request, FilterFormatInterface $filter_format) {
    $text = $request->get('text') ?: $request->get('value');
    if (empty($text)) {
      throw new NotFoundHttpException();
    }

    $build = [
      '#type' => 'processed_text',
      '#text' => $text,
      '#format' => $filter_format->id(),
      '#langcode' => $this->languageManager()->getCurrentLanguage(LanguageInterface::TYPE_CONTENT)->getId(),
    ];

    if ($this->isAjax()) {
      $response = new AjaxResponse();
      $response->addCommand(new EmbedInsertCommand($build));
      return $response;
    }
    else {
      $html = $this->renderer->renderPlain($build);
      // Note that we intentionally do not use:
      // - \Drupal\Core\Cache\CacheableResponse because caching it on the server
      //   side is wasteful, hence there is no need for cacheability metadata.
      // - \Drupal\Core\Render\HtmlResponse because there is no need for
      //   attachments nor cacheability metadata.
      return (new Response($html))
        // Do not allow any intermediary to cache the response, only end user.
        ->setPrivate()
        // Allow the end user to cache it for up to 5 minutes.
        ->setMaxAge(300);
    }
  }

  /**
   * Returns an Ajax response to generate preview of an entity.
   *
   * Expects the the HTML element as GET parameter.
   *
   * @param \Symfony\Component\HttpFoundation\Request $request
   *   The request object.
   * @param \Drupal\editor\EditorInterface $editor
   *   The editor.
   * @param \Drupal\embed\EmbedButtonInterface $embed_button
   *   The embed button.
   *
   * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
   *   Throws an exception if 'value' parameter is not found in the request.
   *
   * @return \Symfony\Component\HttpFoundation\Response
   *   The preview of the embedded item specified by the data attributes.
   */
  public function previewEditor(Request $request, EditorInterface $editor, EmbedButtonInterface $embed_button) {
    return $this->preview($request, $editor->getFilterFormat());
  }

}
