<?php
// No direct access
defined('_JEXEC') or die;

use Joomla\CMS\Plugin\CMSPlugin;
use Joomla\CMS\Factory;
use Joomla\CMS\Uri\Uri;
use Joomla\CMS\MVC\Model\BaseDatabaseModel;

class PlgSystemOpenGraph extends CMSPlugin
{
    public function onBeforeCompileHead()
    {
        $app = Factory::getApplication();

        if ($app->isClient('administrator')) {
            return;
        }

        $document = Factory::getDocument();
        $metas = $document->getHeadData();

        // Extract the title from existing meta data
        $ogTitle = isset($metas['title']) ? $metas['title'] : '';
        $ogType = 'website'; // Default type
        $ogUrl = Uri::current();
        $ogImage = ''; // Default image URL set to empty
        $ogImageWidth = ''; // Default image width
        $ogImageHeight = ''; // Default image height
        $ogDescription = isset($metas['description']) ? $metas['description'] : '';

        // Fetch site name from global configuration
        $siteName = Factory::getConfig()->get('sitename');

        // Retrieve the article content and find the first image
        $itemId = $app->input->getInt('id'); // Get the article ID
        if ($itemId) {
            $articleModel = BaseDatabaseModel::getInstance('Article', 'ContentModel');
            $article = $articleModel->getItem($itemId);

            if ($article) {
                // Extract the first image from the article content
                $imageData = $this->getFirstImageFromContent($article->introtext . $article->fulltext);
                $ogImage = $imageData['url'];
                $ogImageWidth = $imageData['width'];
                $ogImageHeight = $imageData['height'];
            }
        }

        // Add Open Graph tags if required values are present
        if ($ogTitle) {
            $document->addCustomTag('<meta property="og:title" content="' . htmlspecialchars($ogTitle, ENT_QUOTES, 'UTF-8') . '" />');
        }
        if ($ogType) {
            $document->addCustomTag('<meta property="og:type" content="' . htmlspecialchars($ogType, ENT_QUOTES, 'UTF-8') . '" />');
        }
        if ($ogUrl) {
            $document->addCustomTag('<meta property="og:url" content="' . htmlspecialchars($ogUrl, ENT_QUOTES, 'UTF-8') . '" />');
        }
        if ($ogImage) {
            $document->addCustomTag('<meta property="og:image" content="' . htmlspecialchars($ogImage, ENT_QUOTES, 'UTF-8') . '" />');
            if ($ogImageWidth) {
                $document->addCustomTag('<meta property="og:image:width" content="' . htmlspecialchars($ogImageWidth, ENT_QUOTES, 'UTF-8') . '" />');
            }
            if ($ogImageHeight) {
                $document->addCustomTag('<meta property="og:image:height" content="' . htmlspecialchars($ogImageHeight, ENT_QUOTES, 'UTF-8') . '" />');
            }
        }
        if ($ogDescription) {
            $document->addCustomTag('<meta property="og:description" content="' . htmlspecialchars($ogDescription, ENT_QUOTES, 'UTF-8') . '" />');
        }
        if ($siteName) {
            $document->addCustomTag('<meta property="og:site_name" content="' . htmlspecialchars($siteName, ENT_QUOTES, 'UTF-8') . '" />');
        }
    }

    protected function getFirstImageFromContent($content)
    {
        // Use preg_match to find the first image URL with specified file extensions
        preg_match('/<img[^>]+src=["\']([^"\']+\.(jpg|png|webp))["\'][^>]*width=["\'](\d+)["\'][^>]*height=["\'](\d+)["\']/i', $content, $matches);

        if (isset($matches[1])) {
            $imageUrl = $matches[1];
            $width = isset($matches[3]) ? $matches[3] : '';
            $height = isset($matches[4]) ? $matches[4] : '';

            // Convert relative URL to absolute URL
            if (parse_url($imageUrl, PHP_URL_SCHEME) === null) {
                // Relative URL; make it absolute
                $imageUrl = Uri::root() . ltrim($imageUrl, '/');
            }

            return ['url' => $imageUrl, 'width' => $width, 'height' => $height];
        }

        return ['url' => '', 'width' => '', 'height' => ''];
    }
}
?>
