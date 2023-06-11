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

/* account/partial/_preview_video.html.twig */
class __TwigTemplate_f96c478d0718f1babcc7c255f23c7dc1ba9f9e2b499335a85d7761a15ea2a6fe extends \Twig\Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        echo "<div id=\"playerContainer\"></div>
<script type=\"text/javascript\">
//<![CDATA[
    \$(document).ready(function () {
        //FWDUVPUtils.onReady(function(){
            // remove any existing
            if(typeof(videoPlayer) !== \"undefined\") {
                delete videoPlayer;
            }
            
            new FWDUVPlayer({\t\t
                //main settings
                instanceName:\"videoPlayer\",
                parentId:\"playerContainer\",
                playlistsId:\"playlists\",
                mainFolderPath:\"";
        // line 16
        echo twig_escape_filter($this->env, ($context["PLUGIN_WEB_ROOT"] ?? null), "html", null, true);
        echo "/filepreviewer/assets/players/ultimate/content\",
                skinPath:\"minimal_skin_white\",
                initializeOnlyWhenVisible:\"no\",
                useVectorIcons:\"no\",
                fillEntireVideoScreen:\"no\",
                fillEntireposterScreen:\"yes\",
                goFullScreenOnButtonPlay:\"no\",
                playsinline:\"yes\",
                useHEXColorsForSkin:\"no\",
                normalHEXButtonsColor:\"#666666\",
                googleAnalyticsTrackingCode:\"\",
                useResumeOnPlay: \"no\",
                showPreloader: \"yes\",
                preloaderBackgroundColor: \"#000000\",
                preloaderFillColor: \"#FFFFFF\",
                addKeyboardSupport: \"yes\",
                autoScale: \"yes\",
                showButtonsToolTip: \"yes\",
                stopVideoWhenPlayComplete: \"no\",
                playAfterVideoStop: \"no\",
                autoPlay: \"no\",
                loop: \"no\",
                shuffle: \"no\",
                showErrorInfo: \"no\",
                maxWidth: 2000,
                maxHeight: 1200,
                buttonsToolTipHideDelay: 1.5,
                volume: .8,
                backgroundColor: \"#000000\",
                videoBackgroundColor: \"#000000\",
                posterBackgroundColor: \"#000000\",
                buttonsToolTipFontColor: \"#5a5a5a\",
                //logo settings
                showLogo: \"no\",
                //playlist settings
                showPlaylistsButtonAndPlaylists: \"no\",
                showPlaylistButtonAndPlaylist: \"no\",
                showPlaylistByDefault: \"no\",
                //controller settings
                showController: \"yes\",
                showControllerWhenVideoIsStopped: \"yes\",
                showNextAndPrevButtonsInController: \"no\",
                showRewindButton: \"yes\",
                showPlaybackRateButton: \"yes\",
                showVolumeButton: \"yes\",
                showTime: \"yes\",
                showQualityButton: \"yes\",
                showInfoButton: \"yes\",
                showDownloadButton: \"no\",
                showShareButton: \"no\",
                showEmbedButton: \"no\",
                showChromecastButton: \"yes\",
                showFullScreenButton: \"yes\",
                disableVideoScrubber: \"no\",
                showScrubberWhenControllerIsHidden: \"yes\",
                showMainScrubberToolTipLabel: \"yes\",
                showDefaultControllerForVimeo: \"no\",
                repeatBackground: \"yes\",
                controllerHeight: 42,
                controllerHideDelay: 3,
                startSpaceBetweenButtons: 7,
                spaceBetweenButtons: 8,
                scrubbersOffsetWidth: 2,
                mainScrubberOffestTop: 14,
                timeOffsetLeftWidth: 5,
                timeOffsetRightWidth: 3,
                timeOffsetTop: 0,
                volumeScrubberHeight: 80,
                volumeScrubberOfsetHeight: 12,
                timeColor: \"#888888\",
                youtubeQualityButtonNormalColor: \"#888888\",
                youtubeQualityButtonSelectedColor: \"#FFFFFF\",
                scrubbersToolTipLabelBackgroundColor: \"#FFFFFF\",
                scrubbersToolTipLabelFontColor: \"#5a5a5a\",
                //audio visualizer
                audioVisualizerLinesColor: \"#21a9e1\",
                audioVisualizerCircleColor: \"#FFFFFF\",
                //a to b loop
                useAToB: \"yes\",
                //thumbnails preview
                thumbnailsPreviewWidth: 196,
                thumbnailsPreviewHeight: 110,
                thumbnailsPreviewBackgroundColor: \"#000000\",
                thumbnailsPreviewBorderColor: \"#666\",
                thumbnailsPreviewLabelBackgroundColor: \"#666\",
                thumbnailsPreviewLabelFontColor: \"#FFF\",
                // context menu
                showContextmenu: 'no',
                showScriptDeveloper: \"no\",
                contextMenuBackgroundColor: \"#1f1f1f\",
                contextMenuBorderColor: \"#1f1f1f\",
                contextMenuSpacerColor: \"#333\",
                contextMenuItemNormalColor: \"#666666\",
                contextMenuItemSelectedColor: \"#FFFFFF\",
                contextMenuItemDisabledColor: \"#444\"
            });
        //});
    });
    //]]>
</script>

<!--  Playlists -->
<ul id=\"playlists\" style=\"display: none;\">
    <li data-source=\"playlist1\" data-playlist-name=\"PLAYLIST 1\" data-thumbnail-path=\"";
        // line 119
        echo twig_escape_filter($this->env, ($context["PLUGIN_WEB_ROOT"] ?? null), "html", null, true);
        echo "/filepreviewer/assets/players/ultimate/content/images/thumbnail.jpg\">
   </li>
</ul>

<!--  HTML playlist -->
<ul id=\"playlist1\" style=\"display: none;\">
    <li data-thumb-source=\"";
        // line 125
        echo twig_escape_filter($this->env, ($context["PLUGIN_WEB_ROOT"] ?? null), "html", null, true);
        echo "/filepreviewer/assets/players/ultimate/content/images/thumbnail.jpg\" data-video-source=\"[{source:'";
        echo ($context["downloadUrlForMedia"] ?? null);
        echo "', label:'Original'}]\" data-start-at-video=\"0\" data-downloadable=\"yes\"></li>
</ul>";
    }

    public function getTemplateName()
    {
        return "account/partial/_preview_video.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  169 => 125,  160 => 119,  54 => 16,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "account/partial/_preview_video.html.twig", "/var/www/html/medicalimage/themes/evolution/views/account/partial/_preview_video.html.twig");
    }
}
