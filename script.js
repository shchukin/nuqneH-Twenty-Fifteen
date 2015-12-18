/*
 * tags wrap
 */

jQuery(document).ready(function ($) {

    var $tags = $('.tags-links');
    var tagsOutput = $tags.html();
    tagsOutput = tagsOutput.replace(/, /g, '');
    $tags.html(tagsOutput);

    $('.tags-links a').wrap('<span class="tag-item"></span>');

});