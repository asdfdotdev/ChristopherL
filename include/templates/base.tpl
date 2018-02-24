{*
/**
 * Base Template - Used globally for all pages.
 *
 * @package ChristopherL.com
 * @copyright 2016-2018 ChristopherL (https://github.com/christopherldotcom)
 * @license http://www.gnu.org/licenses/gpl-2.0.html
 */
*}
<!doctype html>
<html lang="en-US" itemscope itemtype="http://schema.org/WebPage">
<head>

    {include file='includes/meta.tpl'}

    {$head_extras}

</head>
<body>

    {$body_header_extras}

    {include file='includes/header.tpl'}

    <div class="hero hero_{$active_nav}" style="background-image: url({$hero_image});">&nbsp;</div>

    {$content}

    {include file='includes/footer.tpl'}

    {include file='includes/scripts.tpl'}

    {$body_footer_extras}

</body>
</html>
