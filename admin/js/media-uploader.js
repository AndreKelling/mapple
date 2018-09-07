jQuery(document).ready(function($){
    var mediaUploader;
    $('[data-mappleupload]').click(function(e) {
        e.preventDefault();
        if (mediaUploader) {
            mediaUploader.open();
            return;
        }
        mediaUploader = wp.media.frames.file_frame = wp.media({
            title: 'Map marker',
            multiple: false });
        mediaUploader.on('select', function() {
            var attachment = mediaUploader.state().get('selection').first().toJSON();
            var target = $('[data-mappleupload]').data('mappleupload');
            $('#'+target).val(attachment.url);
            $('#'+target+'-img').attr("src", attachment.url);
        });
        mediaUploader.open();
    });

    $('[data-mappleuploadremove]').click(function(e) {
        e.preventDefault();
        var target = $('[data-mappleuploadremove]').data('mappleuploadremove');
        console.log(target);
        $('#'+target).val('');
        $('#'+target+'-img').attr("src", '');
    });
});
