/*
 * tags wrap
 */

jQuery(document).ready(function ($) {

    var $tags = $('.tags-links');
    $tags.each(function(){
        var tagsOutput = $(this).html();
        tagsOutput = tagsOutput.replace(/, /g, '');
        $(this).html(tagsOutput);
    });

    $('.tags-links a').wrap('<span class="tag-item"></span>');

});