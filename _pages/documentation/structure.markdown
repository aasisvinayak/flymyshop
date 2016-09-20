---
title: "Structure of the application"
sidebar:
  nav: "docs"
layout: single
excerpt: "Directory structure of FlyMyShop"
sitemap: true
share: true
permalink: /docs/structure/
---

{% include toc icon="gears" title="Table of Contents" %}


FlyMyShop code is organised into two main directories:

1. core
2. public

# core
Everything related to teh core application that does not need to be available to the public
are located in the 'core' folder. Core folder has the following directories

<li>app</li>

Same as in Laravel except in the presence of the Flymyshop class which sets up the directory structure.
It is an extension of Laravel Application class and it simply tells the server where the files are.

You will able to find all Controllers, Models, Events, Jobs, Policies, Routes etc under this directory.

<li>bootstrap</li>

Same as in Laravel

<li>config</li>

Same as in Laravel

<li>database</li>database

Same as in Laravel

<li>docker</li> docker

All the docker related files except the main Dokerfile is placed here.

<li>flymyshop</li>

Anything that offers modularity to FlyMyShop application is found under this. Please see the section below for details.

<li>resources</li>

All non-public resources are located here. This includes assets for compiling, admin theme and installation theme.


<li>storage</li>

Same as in Laravel


<li>tests</li>


Same as in Laravel


## flymyshop

Under this you will be able to find:

### Containers

FlyMyShop containers are essentially classes for holding different types of data associated with the application.

This includes

<li>DataContainer which folders all the raw data for the view</li>
<li>HookContainer which has a list of plugins that have registered different hooks with the application. This is used by the application to trigger the right plugin at the right time. </li>

### Core

This contains the core of the application.

<li>EnablePlugins : Load the plugins on to the application</li>


### Helpers

Helper classes for application and plugins.

<li>PluginHelper: Helps identify list of plugins already installed</li>

### Plugins

All the plugins go under here. Currently few sample plugins come with the application.

<li>Sample: To illustrate file structure</li>
<li>Test: To show how to insert data into views</li>
<li>Test: To show how to process objects from the application. In this example, it shows how the plugin can receive order details during checkout</li>

### functions.php

Functions that can be used by plugins and themes

### hooks.php

Allows plugins to register different hooks using the functions


### stubs

We store all the stub templates here

# public

## themes

All the themes are stored here

## uploads/assets

Any public asset can go here