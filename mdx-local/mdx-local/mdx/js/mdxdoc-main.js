/*
 * Copyright 1999 - 2010 Crazy Development Ltd.
 *
 * The code and all underlying concepts and data models are owned fully
 * and exclusively by Crazy Development Ltd. and are protected by
 * copyright law and international treaties.
 *
 * Warning: Unauthorized reproduction, use or distribution of this
 * program, concepts, documentation and data models, or any portion of
 * it, may result in severe civil and criminal penalties, and will be
 * prosecuted to the maximum extent possible under the law.
 */

var maxHeight = 0;

jQuery(document).ready(function ()
                       {
                           jQuery('.cd-mdxdoc-example-header a').click(function ()
                                                                       {
                                                                           var parent = jQuery(this).parent();
                                                                           parent.next().slideToggle("fast", function ()
                                                                           {
                                                                               window.parent.resizeNavigation();
                                                                           });
                                                                           parent.toggleClass('cd-mdxdoc-example-header-collapsed');
                                                                           return false;
                                                                       });

                           jQuery('.cd-mdxdoc-tree-branch-btn').click(function ()
                                                                      {
                                                                          jQuery(this).toggleClass('cd-mdxdoc-tree-branch-btn-expanded');
                                                                          var parent = jQuery(this).parent();
                                                                          parent.find(".cd-mdxdoc-tree-branch-container:first").slideToggle("fast", function ()
                                                                          {
                                                                              window.parent.resizeNavigation();
                                                                          });
                                                                          return false;
                                                                      });

                           if (top == window)
                           {
                               updateNavigation(window.location.href);

                               jQuery(window).resize(function ()
                                                     {
                                                         resizeNavigation();
                                                     });
                           }

                       });

function resizeNavigation()
{
    // do we need this ?
    if (top == window) // what the f.. is this ?
    {
        maxHeight = jQuery(window).height() - 111 - 86 - 34 - 18;

        var contentDiv = jQuery(".cd-mdxdoc-content");
        contentDiv.css("min-height", maxHeight);
//        if (contentDiv.height() < maxHeight)
//        {
//            contentDiv.(maxHeight);
//        }
    }
}

function updateNavigation(contentLink)
{
    jQuery("a.cd-mdxdoc-tree-link").each(function ()
                                         {
                                             if (contentLink.indexOf(this.href) >= 0)
                                             {
                                                 jQuery(this).addClass('cd-mdxdoc-tree-selected-element');
                                                 var parent = jQuery(this).parent();
                                                 while (parent.length > 0)
                                                 {
                                                     var pEl = jQuery(parent[0]);
                                                     if (pEl.hasClass("cd-mdxdoc-tree-branch-container"))
                                                     {
                                                         pEl.show();
                                                         pEl.prevAll(".cd-mdxdoc-tree-branch-btn").addClass("cd-mdxdoc-tree-branch-btn-expanded");
                                                     }
                                                     parent = jQuery(parent[0]).parent();
                                                 }
                                             }
                                             else
                                             {
                                                 jQuery(this).removeClass('cd-mdxdoc-tree-selected-element');
                                             }
                                         });

    top.resizeNavigation();
    top.jQuery("html").scrollTop(0);
}

