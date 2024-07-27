# Open Graph Plugin

A Joomla 5.x plugin that automatically generates Open Graph tags from your article's meta data for improved social media integration and visibility.

## Installation

1. **Download the Plugin:**
   - Visit the [GitHub Releases page](https://github.com/zeroalphagit/Joomla-Open-Graph/releases) to download the latest version of the plugin as a ZIP file.

2. **Install the Plugin:**
   - Log in to your Joomla administrator backend.
   - Navigate to `Extensions` > `Manage` > `Install`.
   - Under the `Upload Package File` tab, click `Choose File` and select the downloaded ZIP file.
   - Click `Upload & Install` to upload and install the plugin.

3. **Enable the Plugin:**
   - After installation, go to `Extensions` > `Plugins`.
   - Search for "Open Graph" in the list of plugins.
   - Click on the plugin name to open the plugin settings.
   - Change the status to `Enabled` and click `Save & Close`.

4. **Configure the Plugin:**
   - The plugin will automatically use the meta data from your articles to generate Open Graph tags. There are no additional configuration settings required.

## Usage

This plugin adds the following Open Graph metadata to your pages:

* `og:url:` The URL of the current page.
* `og:type:` Default is `website`.
* `og:title:` The title of the page or article.
* `og:description:` The meta description of the article.
* `og:image:` The first image found in the article body that is a .jpg, .png, or .webp format. If no image is found, this tag will not be included.

Learn more about The Open Graph Protocol at [ogp.me](http://ogp.me/).

## Requirements

* Joomla 5.x or later.

## Support

* Please visit the [issues page](https://github.com/zeroalphagit/Joomla-Open-Graph/issues) for this project.

## Stable Master Branch Policy

The master branch will, at all times, remain stable. Development for new features will occur in branches, and when ready, will be merged into the master branch.

In the event features have already been merged for the next release series, and an issue arises that warrants a fix on the current release series, the developer will create a branch based off the tag created from the previous release, make the necessary changes, package a new release, and tag the new release. If necessary, the commits made in the temporary branch will be merged into master.

## Branch Schema

* __master__: stable at all times, containing the latest tagged release for Joomla 5.x.
* __develop__: the latest version in development for Joomla 5.x. This is the branch to base all pull requests on.

## Contributing

Your contributions are more than welcome! Please make all pull requests against the `develop` branch.
