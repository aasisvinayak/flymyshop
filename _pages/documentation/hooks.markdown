---
title: "Hooks"
sidebar:
  nav: "docs"
layout: single
excerpt: "Hooks available for FlyMyShop"
sitemap: false
share: true
permalink: /docs/hooks/
---

{% include toc icon="gears" title="Table of Contents" %}


Hooks are available to plugins to tell the application when you call the relevant functions.

For example, a plugin that connects with a third-party service to update every time a new order is received needs to be called when the user checks-out.

# Types

There are different types of hooks available for plugins to use.

## Interrupting one

If the plugin needs to process the data from the application and it wants the application to wait while it performs the actions you call an interrupting hook.

## Non-interrupting ones

In other cases you might not need this. For example, you want to send an SMS to the customer once the customer has placed an order. In this case you can call a non-interrupting hook. The plugin operation will be handled in parallel as a job.

# Registering a hook

Plugins can register hooks by using reserved function names. For example, if a plugin has a method <span
        style="color: red">`i_order_hook()`</span> then  it will be registered as an interrupting order hook.


# Naming convention

If the function you are writing is reserved and it begins with `i_` then it implied that it is an interrupting hook.

