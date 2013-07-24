/*
 * Copyright 1999 - 2011 Crazy Development Ltd.
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

$(document).ready(function() {
    var $exampleButton = $("#example-source-button");
    var $exampleSource = $("#example-source");
    var codemirror = CodeMirror.fromTextArea(document.getElementById("example-source-content"), {
        lineNumbers: false,
        readOnly : true,
        mode:  "javascript"
    });

    $exampleButton.click(function() {
        if ($exampleSource.is(":visible")) {
            $exampleSource.hide(); //'slide', { direction: "up" }, 300);
            $exampleButton.html("Source code >");
        }
        else {
            $exampleSource.show(); //'slide', { direction: "up" }, 300);
            codemirror.refresh();
            $exampleButton.html("Source code <");
        }
    });

    $exampleButton.html("Source code >");
    $exampleSource.hide();

    codemirror.setValue($("#example").html());

    $(".next").prepend("next :");

    if (top != window) {
        $(".header").each(function() {
            var html = "<img src=\"js/new-window.png\" title=\"Open in New Window\" style=\"padding-left:10px; float:right; cursor:pointer\" onclick='window.open(window.location.href, \"_blank\")'/>";
            $(this).prepend(html);
        });
    }
});

vizNextTutorial = function(tutorial) {
    var current = top.location.href;
    top.location = current.replace(/\w*.html/, tutorial);
};
