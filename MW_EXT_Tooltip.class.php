<?php

namespace MediaWiki\Extension\Z17;

use OutputPage, Parser, Skin;

/**
 * Class MW_EXT_Tooltip
 */
class MW_EXT_Tooltip
{
  /**
   * Register tag function.
   *
   * @param Parser $parser
   *
   * @return bool
   * @throws \MWException
   */
  public static function onParserFirstCallInit(Parser $parser)
  {
    $parser->setFunctionHook('tooltip', [__CLASS__, 'onRenderTag']);

    return true;
  }

  /**
   * Render tag function.
   *
   * @param Parser $parser
   * @param string $word
   * @param string $tooltip
   *
   * @return string
   */
  public static function onRenderTag(Parser $parser, $word = '', $tooltip = '')
  {
    // Argument: id.
    $getWord = MW_EXT_Kernel::outClear($word ?? '' ?: '');
    $outWord = $getWord;

    // Argument: tooltip.
    $getTooltip = MW_EXT_Kernel::outClear($tooltip ?? '' ?: '');
    $outTooltip = $getTooltip;

    // Out HTML.
    $outHTML = '<span class="mw-ext-tooltip" title="' . $outTooltip . '">' . $outWord . '</span>';

    // Out parser.
    $outParser = $outHTML;

    return $outParser;
  }

  /**
   * Load resource function.
   *
   * @param OutputPage $out
   * @param Skin $skin
   *
   * @return bool
   */
  public static function onBeforePageDisplay(OutputPage $out, Skin $skin)
  {
    $out->addModuleStyles(['ext.mw.tooltip.styles']);

    return true;
  }
}
