@extends("_layout")
@section("content")
<main id="openModalDiv" class="cursor-pointer flex flex-col items-center justify-center min-h-96">
    <div class="text-center hover">
        <div>
            <h2 class="text-4xl font-bold mb-4 shadow-sm">Đăng và chia sẻ dữ liệu trực tuyến</h2>
            <p class="text-gray-600">Kéo thả dữ liệu hoặc hình ảnh của bạn vào bất kỳ đâu để bắt đầu tải
                lên
                ngay.</p>
            <p class="text-gray-600"></p>
            Giới hạn 10 MB. Liên kết trực tiếp đến dữ liệu, mã BBCode và hình thu nhỏ HTML.</p>
        </div>
        <div class="my-6">
            <a style="background-color:#3a81b9" class=" text-white px-6 py-2 rounded my-5">START UPLOADING</a>
        </div>

    </div>
</main>

<section class="bg-gray-100 py-16 min-h-72">
    <div class="text-center">
        <h3 class="text-2xl font-bold mb-2">Nội dung trang chủ</h3>
        <p class="text-gray-600">Đoạn này là bài viết giới thiệu để SEO</p>
    </div>
</section>
@endsection
@section("scripts")
<script>
    document.getElementById('openModalDiv').addEventListener('click', function () {
        document.getElementById('uploadModal').classList.remove('hidden');
        document.getElementById('modalOverlay').classList.remove('hidden');
    });
</script>
@endsection