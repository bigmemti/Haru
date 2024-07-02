<section id="main-category">
    <div @class(["$background p-4 rounded-lg my-4"])>
        <div class="flex justify-between items-end">
            <div class="border-b-2 border-red-600 pb-2">
                <h4 class="font-bold">میوه و سبزیجات</h4>
                <span class="text-sm">مرتب سازی بر اساس جدیدترین</span>
            </div>
            <div class="pb-2">
                <a href="">{{ __('more') }}>></a>
            </div>
        </div>
        <div class="divider -mt-2"></div>
        <div x-data="">
            <div class="" data-flickity='{"imagesLoaded": true, "cellAlign":"right", "contain":true, "wrapAround": false, "freeScroll": true , "groupCells": true, "rightToLeft":true, "autoPlay":false, "pageDots":false, "prevNextButtons":true, "draggable":true}'>
                <div class="carousel-cell"></div>
                <div class="carousel-cell"></div>
                <div class="carousel-cell"></div>
                <div class="carousel-cell"></div>
                <div class="carousel-cell"></div>
                <div class="carousel-cell"></div>
                <div class="carousel-cell"></div>
                <div class="carousel-cell"></div>
                <div class="carousel-cell"></div>
                <div class="carousel-cell"></div>
                <div class="carousel-cell"></div>
            </div>
        </div>
    </div>
</section>
