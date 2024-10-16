<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>ImgBB</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

</head>

<body class="bg-white text-gray-800">

    <header class="sticky flex row top-0 z-10 py-4 justify-between bg-white border-b shadow">
        <ul class="z-60 flex items-center col-lg-4">
            <li class="z-60">
                <button class="dropdown-about text-gray-600 hover:text-gray-800 px-4">
                    <i class="fa-regular fa-circle-question"></i>
                    <span class="ml-2">Giới thiệu</span>
                    <i class="fa-solid fa-caret-down"></i>
                </button>
                <div class="dropdown-about-menu hidden absolute bg-white shadow-md rounded mt-2">
                    <a href="{{route('upload')}}" class="block px-4 py-2 hover:bg-gray-100">Trang chủ</a>
                    <a href="#" class="block px-4 py-2 hover:bg-gray-100">Liên hệ</a>
                    <a href="{{route('gallery')}}" class="block px-4 py-2 hover:bg-gray-100">Thư viện</a>
                </div>
            </li>
            <li>
                <button class=" dropdown-language text-gray-600 hover:text-gray-800 px-4">
                    <i class="fa-solid fa-language"></i>
                    <span class="ml-2">VI</span>
                    <i class="fa-solid fa-caret-down"></i>
                </button>
                <div class=" dropdown-language-menu hidden absolute bg-white shadow-md rounded mt-2">
                    <a href="#" class="block px-4 py-2 hover:bg-gray-100">EN</a>
                    <a href="#" class="block px-4 py-2 hover:bg-gray-100">CN</a>
                    <a href="#" class="block px-4 py-2 hover:bg-gray-100">JP</a>
                </div>
            </li>
        </ul>
        <ul class="text-center align-self-center">
            <img src="{{asset('img/logo/imgbb.png')}}" alt="">
        </ul>
        <div class="pe-3">
            <button id="modalOpenBtn" class="flex items-center space-x-1">
                <i class="fa-solid fa-cloud-arrow-up"></i>
                <span class="text-lg ml-2">Upload</span>
            </button>
        </div>
    </header>

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

    <!-- Modal -->
    <div id="modalOverlay" class="bg-opacity-65 fixed inset-0 top-[4.0rem] bg-black z-40 hidden"></div>
    <div id="uploadModal"
        class="fixed inset-x-0 top-[4.0rem] bg-gray-900 bg-opacity-70 z-50 hidden flex items-center justify-center">
        <div class="bg-white w-full h-2/3 p-6 shadow-lg overflow-y-auto">
            <div class="row">
                <div class="text-left text-sm text-gray-500 leading-tight">
                    DOC, PDF, ZIP, PHP, TEXT, JPG PNG BMP GIF TIF WEBP HEIC AVIF PDF... GIỚI HẠN: 10MB
                </div>
                <button id="closeModal"
                    class="absolute top-4 right-4 text-gray-600 hover:text-gray-800 flex items-center">
                    <i class="fas fa-times"></i><span class="text-sm text-gray-500 ml-1">Đóng</span>
                </button>
            </div>
            <main class="text-center">
                <label for="fileInput" class="mt-8 cursor-pointer">
                    <div>
                        <span style="color:#2a80b9" class="fa-6x mt-10 fa-solid fa-cloud-arrow-up my-3"></span>
                        <input type="file" id="fileInput" name="files[]" multiple class="hidden" />

                        <p class="text-2xl font-semibold mb-3 text-gray-900 flex flex-wrap justify-center"> Kéo thả hoặc
                            paste (Ctrl + V) ảnh vào đây để upload</p>
                        <p class="text-base font-semibold mb-3 text-gray-900 flex flex-wrap justify-center">
                            Bạn cũng có thể &nbsp; <a id="fileInput"
                                class="text-base font-semibold mb-3 text-blue-500 flex flex-wrap justify-center hover:underline">
                                tải lên từ máy tính </a>
                            &nbsp; hoặc &nbsp;
                            <a id=""
                                class="text-base font-semibold mb-3 text-blue-500 flex flex-wrap justify-center hover:underline">
                                thêm địa chỉ ảnh </a>
                        </p>
                    </div>

                </label>
                <div id="gallery" class="flex justify-center mt-8 space-x-4"></div>
                <div id="listDownload" class="flex justify-center mt-8 flex-col"></div>
                <div id="autoDeleteSection" class="mt-8 hidden">
                    <label class="block text-base font-bold mb-1" for="auto-delete">
                        Tự động xóa ảnh
                    </label>
                    <select class="border p-2 mt-2 mx-auto w-full max-w-xs" id="auto-delete">
                        <option value="1">Sau 1 ngày</option>
                        <option value="7">Sau 7 ngày</option>
                        <option value="30">Sau 30 ngày</option>
                    </select>
                </div>
                <button id="uploadBtn" class="mt-8 bg-green-500 text-white px-6 py-2 rounded hidden">
                    TẢI LÊN NGAY
                </button>
            </main>
        </div>
    </div>


    <footer class="text-center py-4 text-gray-600">
        <div class="flex justify-center space-x-4 mb-2">
            <a href="#" class="hover:underline text-blue-500">Giới thiệu</a>
            <a href="#" class="hover:underline text-blue-500">Liên hệ</a>
        </div>
        <p>Sử dụng 10MB.cc là bạn đã đồng ý với <a href="#" class="hover:underline text-blue-500">Quy định sử dụng</a>
            và <a href="#" class="hover:underline text-blue-500">Chính sách bảo mật</a>.</p>
    </footer>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        //Dropdown
        const dropdownAboutBtn = document.querySelector('.dropdown-about');
        const dropdownAboutMenu = document.querySelector('.dropdown-about-menu');

        dropdownAboutBtn.addEventListener('click',
            () => {
                dropdownAboutMenu.classList.toggle('hidden');
            });

        const dropdownLanBtn = document.querySelector('.dropdown-language');
        const dropdownLanMenu = document.querySelector('.dropdown-language-menu');

        dropdownLanBtn.addEventListener('click',
            () => {
                dropdownLanMenu.classList.toggle('hidden');

            });

        document.getElementById('modalOpenBtn').addEventListener('click', function () {
            document.getElementById('uploadModal').classList.remove('hidden');
            document.getElementById('modalOverlay').classList.remove('hidden');
        });

        document.getElementById('openModalDiv').addEventListener('click', function () {
            document.getElementById('uploadModal').classList.remove('hidden');
            document.getElementById('modalOverlay').classList.remove('hidden');
        });
        const uploadedFiles = [];

        $(document).ready(function () {
            $('#fileInput').on('change', function (event) {
                const files = event.target.files;

                for (let i = 0; i < files.length; i++) {
                    const file = files[i];
                    if (uploadedFiles.some(uploadedFile => uploadedFile.name === file.name)) {
                        continue;
                    }
                    uploadedFiles.push(file);

                    const fileDiv = $('<div class="relative"></div>');
                    fileDiv.append(`
                    <img alt="${file.name}" class="border w-24 h-24 object-cover" src="${URL.createObjectURL(file)}" width="100"/>
                    <button class="absolute top-0 left-0 bg-white rounded-full w-4 h-4 flex items-center justify-center shadow hover:shadow-md transition-shadow duration-300">
                        <i class="fas fa-times text-black-250 text-xs" onclick="removeFile(this)"></i>
                    </button>
                    <button class="absolute top-4 left-0 bg-white rounded-full w-4 h-4 flex items-center justify-center shadow hover:shadow-md transition-shadow duration-300">
                        <i class="fas fa-pen text-black-200 text-xs"></i>
                    </button>
                `);

                    $('#gallery').append(fileDiv);
                }

                if ($('#gallery').children().length > 0) {
                    document.getElementById('autoDeleteSection').classList.remove('hidden');
                    document.getElementById('uploadBtn').classList.remove('hidden');
                } else {
                    document.getElementById('autoDeleteSection').classList.add('hidden');
                    document.getElementById('uploadBtn').classList.add('hidden');
                }
            });

            $('#uploadBtn').on('click', function () {
                const formData = new FormData();
                formData.append('_token', $('meta[name="csrf-token"]').attr('content'));

                // Thêm các file đã chọn vào FormData
                uploadedFiles.forEach(file => {
                    formData.append('files[]', file);
                });
                console.log(uploadedFiles);

                $.ajax({
                    url: '/upload',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        toastr.success(response.message);
                        $('#fileInput').siblings('i').removeClass('fas fa-images').addClass('fas fa-check text-green-500');
                        $('#fileInput').removeAttr('id');
                        $('#gallery').children().each(function () {
                            $(this).find('button').remove();
                        });
                        response.downloadLinks.forEach(function (link) {
                            const linkDiv = `
                            <div class="flex justify-center items-center mt-2 flex">
                                <input class="border p-2 w-80 max-w-lg" readonly type="text" value="${link}"/>
                                <button class="bg-gray-200 p-2 ml-2" onclick="copyToClipboard('${link}')">SAO CHÉP</button>
                            </div>
                        `;
                            $('#listDownload').append(linkDiv);
                        });
                        document.getElementById('autoDeleteSection').classList.add('hidden');
                        document.getElementById('uploadBtn').classList.add('hidden');
                    },
                    error: function (xhr, status, error) {
                        console.error('Error:', error);
                        console.log(xhr.responseText);
                        alert(`Error: ${xhr.responseText}`);
                    }
                });
            });

            document.getElementById('closeModal').addEventListener('click', function () {
                document.getElementById('uploadModal').classList.add('hidden');
                $('#gallery').empty();
                uploadedFiles.length = 0;
                document.getElementById('autoDeleteSection').classList.add('hidden');
                document.getElementById('uploadBtn').classList.add('hidden');
                document.getElementById('modalOverlay').classList.add('hidden');
            });
        });

        function copyToClipboard(text) {
            // Tạo một thẻ input tạm thời để chứa nội dung cần sao chép
            const tempInput = document.createElement('input');
            tempInput.value = text;
            document.body.appendChild(tempInput);
            tempInput.select();
            document.execCommand('copy');
            document.body.removeChild(tempInput);
            toastr.success('Sao chép thành công!');
        }

        function removeFile(button) {
            const fileDiv = button.closest('.relative');
            const fileName = fileDiv.querySelector('img').alt;

            const index = uploadedFiles.findIndex(file => file.name === fileName);
            if (index !== -1) {
                uploadedFiles.splice(index, 1);
            }

            fileDiv.remove();

            const gallery = document.getElementById('gallery');
            if (gallery.children.length === 0) {
                document.getElementById('autoDeleteSection').classList.add('hidden');
                document.getElementById('uploadBtn').classList.add('hidden');
            }
        }
    </script>
</body>

</html>