<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-image bg-cover" style="background-image: url('https://cdn-e360.s3-sa-east-1.amazonaws.com/proyectop_article_692bed7877df26d11dc0001140bcb780_jpg_1000x665_100_4547.jpg')">
    <div>
        {{ $logo }}
    </div>

    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
        {{ $slot }}
    </div>
</div>