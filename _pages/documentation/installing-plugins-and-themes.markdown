---
title: "Installing Plugins and Themes"
sidebar:
  nav: "docs"
layout: single
excerpt: "Installing Plugins and Themes"
sitemap: true
share: true
permalink: /docs/installing-plugins-and-themes/
---

This part explain the current way to get new plugins and install them.

<h2>Getting new plugins and themes</h2>

As FlyMyShop does not yet has an online repository, one can obtain plugins and themes from third party providers like Github.


<h2>Installing plugins</h2>

Once you have obtained the plugin file (zip file that contains are the required plugin files) from a third party source, unzip the file and upload the file to `/flymycloud/core/flymycloud/plugins/` folder.

Currently once you upload the plugin it will be automatically enabled. In the next version, the ability  to enable, disable  or delete a plugins will be added to  the admin interface.


<h2>Installing themes</h2>

Similar to the steps described above, upload the unzipped files to `/public/themes/` folder and enable the new theme by updating the `THEME` key in the `.env` file.  In the next version, the ability  to enable, disable  or delete a theme will be added to  the admin interface.
