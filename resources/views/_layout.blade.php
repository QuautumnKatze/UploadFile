<!DOCTYPE html>
<html lang="en" id="upload">

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
                    <a href="{{route('homepage')}}" class="block px-4 py-2 hover:bg-gray-100">Trang chủ</a>
                    <a href="#" class="block px-4 py-2 hover:bg-gray-100">Liên hệ</a>
                    <a href="{{route('showGallery')}}" class="block px-4 py-2 hover:bg-gray-100">Thư viện của bạn</a>
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
            <a href="{{route('homepage')}}">
                <img src="{{asset('img/logo/imgbb.png')}}" alt="">
            </a>
        </ul>
        <div class="pe-3">
            <button id="modalOpenBtn" class="flex items-center space-x-1">
                <i class="fa-solid fa-cloud-arrow-up"></i>
                <span class="text-lg ml-2">Upload</span>
            </button>
        </div>
    </header>

    @yield("content")

    <!-- Modal -->
    <div id="modalOverlay" class="bg-opacity-65 fixed inset-0 top-[4.0rem] bg-black z-40 hidden">
        <div id="closeModal" class="bg-opacity-65 fixed inset-0 top-[4.0rem] bg-black z-40"></div>
    </div>
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
            <main class="text-center" ondrop="dropHandler(event)" ondragover="dragOverHandler(event)">
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
                <div id="fileList" class="flex justify-center mt-8 space-x-4"></div>
                <div id="listDownload" class="flex justify-center mt-8 flex-col"></div>
                <div id="autoDeleteSection" class="mt-8 hidden">
                    <label class="block text-base font-bold mb-1" for="auto-delete">
                        Tự động xóa file
                    </label>
                    <select class="border p-2 mt-2 mx-auto w-full max-w-xs" id="auto-delete">
                        <option value="1">Sau 1 ngày</option>
                        <option value="3">Sau 3 ngày</option>
                        <option value="7">Sau 7 ngày</option>
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

        document.getElementById('closeModal').addEventListener('click', function () {
            document.getElementById('uploadModal').classList.add('hidden');
            $('#fileList').empty();
            uploadedFiles.length = 0;
            document.getElementById('autoDeleteSection').classList.add('hidden');
            document.getElementById('uploadBtn').classList.add('hidden');
            document.getElementById('modalOverlay').classList.add('hidden');
            document.getElementById('listDownload').classList.add('hidden');

        });
        const uploadedFiles = [];

        $('#fileInput').on('change', handleFiles);

        // Xử lý thả file vào khu vực modal
        function dropHandler(event) {
            event.preventDefault();
            handleFiles(event);
        }

        function dragOverHandler(event) {
            event.preventDefault();
        }

        //Paste files
        document.getElementById('upload').addEventListener('paste', function (event) {
            event.preventDefault();
            document.getElementById('uploadModal').classList.remove('hidden');
            document.getElementById('modalOverlay').classList.remove('hidden');

            // Lấy dữ liệu từ clipboard
            const items = (event.clipboardData || window.clipboardData).items;

            for (let i = 0; i < items.length; i++) {
                const item = items[i];
                if (item.kind === 'file') {
                    const file = item.getAsFile();
                    if (file) {
                        handleFiles({ target: { files: [file] } });
                    }
                } else if (item.kind === 'string') {
                    // Nếu là ảnh từ clipboard
                    item.getAsString((url) => {
                        fetch(url)
                            .then(response => response.blob())
                            .then(blob => {
                                const file = new File([blob], 'pasted-image.png', { type: blob.type });
                                handleFiles({ target: { files: [file] } });
                            });
                    });
                }
            }
        });

        // Hàm xử lý file
        function handleFiles(event) {
            const files = event.target.files || event.dataTransfer.files;

            for (let i = 0; i < files.length; i++) {
                const file = files[i];

                uploadedFiles.push(file);
                let filePreview;
                const fileExtension = file.name.split('.').pop().toLowerCase();

                // Kiểm tra nếu file là hình ảnh thì hiện ảnh, nếu không hiển thị icon tương ứng
                if (['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp', 'tif'].includes(fileExtension)) {
                    filePreview = `<img alt="${file.name}" title="${file.name}" class="border w-28 h-32 object-cover" src="${URL.createObjectURL(file)}" />`;
                } else {
                    let iconClass;
                    switch (fileExtension) {
                        case 'rar':
                            iconClass = 'fas fa-file-archive text-yellow-500'; break;
                        case 'zip':
                            iconClass = 'fas fa-file-archive text-yellow-500'; break;
                        case 'pdf':
                            iconClass = 'fas fa-file-pdf text-red-500'; break;
                        case 'doc':
                        case 'docx':
                            iconClass = 'fas fa-file-word text-blue-500'; break;
                        case 'xls':
                        case 'xlsx':
                            iconClass = 'fas fa-file-excel text-green-500'; break;
                        case 'ppt':
                        case 'pptx':
                            iconClass = 'fas fa-file-powerpoint text-orange-500'; break;
                        case 'txt':
                            iconClass = 'fas fa-file-alt text-gray-500'; break;
                        case 'csv':
                            iconClass = 'fas fa-file-csv text-green-600'; break;
                        case 'mp3':
                            iconClass = 'fas fa-file-audio text-purple-500'; break;
                        case 'mp4':
                            iconClass = 'fas fa-file-video text-blue-600'; break;
                        case 'json':
                            iconClass = 'fas fa-file-code text-teal-500'; break;
                        case 'xml':
                            iconClass = 'fas fa-file-code text-orange-600'; break;
                        default:
                            iconClass = 'fas fa-file text-gray-500';
                    }
                    filePreview = `<i class="${iconClass} border w-28 h-32 text-7xl flex items-center justify-center" title="${file.name}"></i>`;
                }

                const fileDiv = $('<div class="relative inline-block m-1"></div>').append(`
                ${filePreview}
                <button class="absolute top-0 left-0 bg-white rounded-full w-4 h-4 flex items-center justify-center shadow hover:shadow-md transition-shadow duration-300">
                    <i class="fas fa-times text-black-250 text-xs" onclick="removeFile(this)"></i>
                </button>
                <button class="absolute top-4 left-0 bg-white rounded-full w-4 h-4 flex items-center justify-center shadow hover:shadow-md transition-shadow duration-300">
                    <i class="fas fa-pen text-black-200 text-xs"></i>
                </button>
            `);

                $('#fileList').append(fileDiv);
            }

            if ($('#fileList').children().length > 0) {
                document.getElementById('autoDeleteSection').classList.remove('hidden');
                document.getElementById('uploadBtn').classList.remove('hidden');
            }
            else {
                document.getElementById('autoDeleteSection').classList.add('hidden');
                document.getElementById('uploadBtn').classList.add('hidden');
            }
        }

        function removeFile(button) {
            const fileDiv = button.closest('.relative');
            const fileName = fileDiv.querySelector('img, i').getAttribute('title'); // Lấy tên file từ thuộc tính `title`

            const index = uploadedFiles.findIndex(file => file.name === fileName);
            if (index !== -1) {
                uploadedFiles.splice(index, 1);
            }

            fileDiv.remove();

            if (document.getElementById('fileList').children.length === 0) {
                document.getElementById('autoDeleteSection').classList.add('hidden');
                document.getElementById('uploadBtn').classList.add('hidden');
            }
        }

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

        // Sự kiện click nút upload
        let isUploading = false;
        $('#uploadBtn').on('click', function () {
            if (isUploading) return;
            isUploading = true;
            $(this).prop('disabled', true);
            const maxSize = 10 * 1024 * 1024;
            const invalidFiles = uploadedFiles.filter(file => file.size > maxSize);

            if (invalidFiles.length > 0) {
                toastr.error("Chỉ cho phép upload file dưới 10MB!");
                $(this).prop('disabled', false);
                isUploading = false;
                return;
            }
            const formData = new FormData();
            uploadedFiles.forEach(file => {
                formData.append('files[]', file);
            });

            // Lấy giá trị từ thẻ select expired_date và thêm vào FormData
            let expiredDate = document.getElementById('auto-delete').value;
            formData.append('expired_date', expiredDate);

            $.ajax({
                url: '/upload',
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    toastr.success(response.message);
                    $('#fileInput').siblings('i').removeClass('fas fa-images').addClass('fas fa-check text-green-500');
                    $('#fileInput').removeAttr('id');
                    $('#fileList').children().each(function () {
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
                error: function (error) {
                    console.error("Error response:", error.responseText);
                    toastr.error("Có lỗi xảy ra, vui lòng thử lại!");
                },
                complete: function () {
                    $('#uploadBtn').prop('disabled', false);
                    isUploading = false;
                }
            });
        });
    </script>
    @yield("scripts")
</body>

</html>