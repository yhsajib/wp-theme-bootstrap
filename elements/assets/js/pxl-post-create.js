(function ($) {

    'use strict';
    var PXLPostCreateHandler = function ($scope, $) {
        let innerHeight = 0;
        var itemBG = [];
        
        $scope.find(".item-inner .post-image img").each(function () {
            itemBG.push($(this).attr("src"));
        });

        for (let i in itemBG) {
            $scope.find(".post-imgs").append( '<div id="itembg-' + i + '" class="post-img"><img src="' + itemBG[i] + '" /></div>' );
        }

        var itemInner = $scope.find(".item-inner");
        if (itemInner.length >= 2)
            for (let i = 0; i <= 2; i++) {
                innerHeight += $(itemInner[i]).outerHeight() + 30;
                if (i == 0) {
                    var containerBG = $(itemInner[0]).find(".post-image").attr("id");
                    var postDate = $(itemInner[0]).find(".item-date").html();
                    var postVideo = $(itemInner[0]).find(".video-btn").html();
                    var postAudio = $(itemInner[0]).find(".audio-btn").html();
                    var postTitle = $(itemInner[0]).find(".item-title").html();
                    var postMeta = $(itemInner[0]).find(".item-metas").html();
                    var postExcerpt = $(itemInner[0]).find(".item-excerpt").html();
                    var postReadMore = $(itemInner[0]).find(".item-readmore").html();
                    bindContent(
                        containerBG,
                        postDate,
                        postAudio,
                        postVideo,
                        postTitle,
                        postMeta,
                        postExcerpt,
                        postReadMore
                    );
                }
            }
        $scope.find(".post-list-container").css({ "max-height": innerHeight - 60 });

        var itemListClickListener = function (e) {
            e.preventDefault();
            var containerBG = $(this)
                .parents(".item-inner")
                .find(".post-image")
                .attr("id");
            var postDate = $(this).parents(".item-inner").find(".item-date").html();
            var postVideo = $(this).parents(".item-inner").find(".video-btn").html();
            var postAudio = $(this).parents(".item-inner").find(".audio-btn").html();
            var postTitle = $(this).parents(".item-inner").find(".item-title").html();
            var postMeta = $(this).parents(".item-inner").find(".item-metas").html();
            var postExcerpt = $(this)
                .parents(".item-inner")
                .find(".item-excerpt")
                .html();
            var postReadMore = $(this)
                .parents(".item-inner")
                .find(".item-readmore")
                .html();
            bindContent(
                containerBG,
                postDate,
                postAudio,
                postVideo,
                postTitle,
                postMeta,
                postExcerpt,
                postReadMore
            );
        }

        $(itemInner).find(".item-title").on("click", itemListClickListener);
        $(itemInner).find(".post-image").on("click", itemListClickListener);

        function bindContent(
            background,
            date,
            audio,
            video,
            title,
            meta,
            excerpt,
            readmore
        ) {
            var postDate = $scope.find(".item-content-large .post-date");
            var postMedia = $scope.find(".item-content-large .post-media");
            var postTitle = $scope.find(".item-content-large .post-title");
            var postMeta = $scope.find(".item-content-large .post-metas");
            var postExcerpt = $scope.find(".item-content-large .post-excerpt");
            var postReadMore = $scope.find(".item-content-large .post-readmore");

            $(postDate).empty();
            $(postMedia).empty();
            $(postTitle).empty();
            $(postMeta).empty();
            $(postExcerpt).empty();
            $(postReadMore).empty();

            $scope.find('.post-imgs .post-img').removeClass('active');
            $scope.find('.post-imgs ' + '#' + background).addClass('active');
            if (date) $(postDate).html(date);
            if (audio) $(postMedia).html(audio);
            if (video) $(postMedia).html(video);
            if (title) $(postTitle).html(title);
            if (meta) $(postMeta).html(meta);
            if (date) {
                $(postExcerpt).html(excerpt);
                $scope.find(".item-content-large .pxl-divider").css("display", "block");
            } else {
                $scope.find(".item-content-large .pxl-divider").css("display", "none");
            }
            if (readmore) $(postReadMore).html(readmore);
        }
    };

    $(window).on("elementor/frontend/init", function () {
        elementorFrontend.hooks.addAction(
            "frontend/element_ready/pxl_post_create.default",
            PXLPostCreateHandler
        );
    });
})(jQuery);
