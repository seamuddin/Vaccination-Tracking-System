<style>
    .image-upload figure {
        position: relative;
        cursor: pointer;
    }

    .image-upload figure figcaption {
        position: absolute;
        bottom: 0;
        color: #fff;
        width: 100%;
        padding-left: 9px;
        padding-bottom: 5px;
        text-shadow: 0 0 10px #000;
    }
</style>

<div class="modal fade" id="ImageUploadModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel"> Photo resize</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="upload_crop_area" class="d-block mx-auto" style="padding-bottom: 25px"></div>
            </div>
            <div class="modal-footer" id="modal-footer">
                <div id="cropping_msg" class="alert alert-info text-center" style="width: 100%; display: none;">
                    <i class="fa fa-spinner fa-pulse"></i> Please wait, Face detecting
                </div>
                <div id="button_area"  style="width: 100%; display: flex;  gap: 10px;">
                    <div class="">
                        <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
                    </div>
                    <div class="">
                        <button type="button" id="cropImageBtn" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('plugins/croppie-2.6.2/croppie.min.js') }}"></script>
<script src="{{ asset('plugins/facedetection.js') }}" type="text/javascript"></script>
<link rel="stylesheet" href="{{ asset('plugins/croppie-2.6.2/croppie.min.css') }}">
<script>

    // Start upload preview image
    // $(".gambar").attr("src", "https://user.gadjian.com/static/images/personnel_boy.png");
    var input_field, upload_crop_area,
        rawImg,
        Image_upload_modal_id = 'ImageUploadModal',
        img_preview_div_id,
        base64_value_field_id,
        viewport_width = 300,
        viewport_height = 300,
        is_required = false,
        face_detect = false;


    function imageUploadWithCropping(input, img_preview_id, base64_value_target) {

        if (input.files && input.files[0]) {
            // Validate Image type
            var mime_type = input.files[0].type;
            if (!(mime_type == 'image/jpeg' || mime_type == 'image/jpg' || mime_type == 'image/png')) {
                input.value = '';
                alert('Image format is not valid. Only PNG or JPEG or JPG type images are allowed.');
                return false;
            }

            input_field = input;

            // Configure dynamic data
            img_preview_div_id = img_preview_id;
            base64_value_field_id = base64_value_target;

            // Configure viewport height, width from input
            if (input.getAttribute('size')) {
                var viewport_size = input.getAttribute('size').split('x');
                viewport_width = parseInt(viewport_size[0]);
                viewport_height = parseInt(viewport_size[1]);
            }

            // Configure is_required plug from input
            if (input.classList.contains('required') || input.hasAttribute('required')) {
                is_required = true;
            }

            // enable face detect
            face_detect = false;


            var reader = new FileReader();

            reader.onload = function (e) {
                // Show Modal
                debugger;
                $('#' + Image_upload_modal_id).modal('show');

                // re-set upload cropping area
                upload_crop_area = $('#upload_crop_area');

                // Set raw image to use later
                rawImg = e.target.result;
            };
            reader.readAsDataURL(input.files[0]);
        } else {
            document.getElementById(base64_value_target).value = '';
            document.getElementById(img_preview_id).setAttribute('src', '{{ url('images/no_image.png') }}');
        }
    }

    function imageUploadWithCroppingAndDetect(input, img_preview_id, base64_value_target) {
        if (input.files && input.files[0]) {
            // Validate Image type
            var mime_type = input.files[0].type;
            if (!(mime_type == 'image/jpeg' || mime_type == 'image/jpg' || mime_type == 'image/png')) {
                input.value = '';
                alert('Image format is not valid. Only PNG or JPEG or JPG type images are allowed.');
                return false;
            }

            input_field = input;

            // Configure dynamic data
            img_preview_div_id = img_preview_id;
            base64_value_field_id = base64_value_target;

            // Configure viewport height, width from input
            if (input.getAttribute('size')) {
                var viewport_size = input.getAttribute('size').split('x');
                viewport_width = parseInt(viewport_size[0]);
                viewport_height = parseInt(viewport_size[1]);
            }

            // Configure is_required plug from input
            if (input.classList.contains('required') || input.hasAttribute('required')) {
                is_required = true;
            }

            // enable face detect
            face_detect = true;

            var reader = new FileReader();

            reader.onload = function (e) {
                // Show Modal
                $('#' + Image_upload_modal_id).modal('show');



                // Create image element to face detect
                document.getElementById('upload_crop_area').innerHTML = "";
                var img_elem = document.createElement("img");
                img_elem.id = 'detect_image';
                img_elem.style.height = '100%';
                img_elem.style.width = '100%';
                img_elem.src = e.target.result;
                document.getElementById('upload_crop_area').appendChild(img_elem);
                // End Create image element to face detect

                // re-set upload cropping area
                upload_crop_area = $('#detect_image');

                // Set raw image to use later
                rawImg = e.target.result;
            };
            reader.readAsDataURL(input.files[0]);
        } else {
            document.getElementById(base64_value_target).value = '';
            document.getElementById(img_preview_id).setAttribute('src', '{{ url('images/no_image.png') }}');
        }
    }


    /*
    This event fires immediately when the show instance method is called.
    If caused by a click, the clicked element is available as the relatedTarget property of the event.

    */
    // This event is triggered when the modal is fully shown to the user.
    // At this point, the cropping area is initialized and, if enabled, face detection will start.
    $('#' + Image_upload_modal_id).on('shown.bs.modal', function () {
        // If already croppie initiated, then destroy it
        if (upload_crop_area.data('croppie')) {
            upload_crop_area.croppie('destroy');
        }

        // Set viewport height, width for cropping
        document.getElementById('upload_crop_area').style.width = (viewport_width + 50) + "px";
        document.getElementById('upload_crop_area').style.height = (viewport_height + 50) + "px";

        if (face_detect) {
            // disable cropping button
            $('#button_area').css('display', 'none');
            $('#cropping_msg').css('display', 'flex');



            setTimeout(function () {
                upload_crop_area.faceDetection({
                    complete: function (faces) {
                        if (faces.length > 0) {
                            upload_crop_area.croppie({
                                viewport: {
                                    width: viewport_width,
                                    height: viewport_height,
                                    type: 'square'
                                },
                                enforceBoundary: true, // Restricts zoom so image cannot be smaller than viewport
                                // enableExif: false,
                                enableResize: false, // Enable or disable support for resizing the viewport area
                            });

                            $('#button_area').css('display', 'flex');
                            $('#cropping_msg').css('display', 'none');
                        } else {
                            toastr.error(" ", 'Given image is not valid! (Can\'t recognize any face)', {
                                positionClass: "toast-top-center",
                            });

                            $('#button_area').css('display', 'flex');
                            $('#cropping_msg').css('display', 'none');


                            document.getElementById('detect_image').remove();

                            // Hide Modal
                            $('#' + Image_upload_modal_id).modal('hide');
                        }
                    }
                });
            }, 3000);

        } else {
            upload_crop_area.croppie({
                viewport: {
                    width: viewport_width,
                    height: viewport_height,
                    type: 'square'
                },
                enforceBoundary: true, // Restricts zoom so image cannot be smaller than viewport
                // enableExif: false,
                enableResize: false, // Enable or disable support for resizing the viewport area
            });

            // Bind raw image to croppie
            upload_crop_area.croppie('bind', {
                url: rawImg
            }).then(function () {
                // console.log('jQuery bind complete');
            });
        }
    });


    $('#cropImageBtn').on('click', function (ev) {
        upload_crop_area.croppie('result', {
            type: 'base64',
            format: 'jpeg',
            // size: 'original',
            size: {width: viewport_width, height: viewport_height}
        }).then(function (resp) {
            document.getElementById(img_preview_div_id).setAttribute('src', resp);
            document.getElementById(base64_value_field_id).value = resp;

            document.getElementById(input_field.id).setAttribute('disabled', true);
            $('#correspondent_signature').hide();

            // Create reset button
            var preview_parent_div = document.getElementById(img_preview_div_id).parentNode.parentNode;
            var btn_elem = document.createElement("button");
            btn_elem.type = 'button';
            btn_elem.id = 'reset_image_'.concat(input_field.id);
            btn_elem.innerHTML = 'Reset image';
            btn_elem.className = 'btn btn-warning btn-xs';
            btn_elem.value = [input_field.id, base64_value_field_id, img_preview_div_id];
            btn_elem.onclick = function () {
                // resetImage(input_field.id, base64_value_field_id, img_preview_div_id, this);
                resetImage(btn_elem.value, this);
            };
            preview_parent_div.parentNode.insertBefore(btn_elem, preview_parent_div.nextSibling);
            // End Create reset button

            $('#' + Image_upload_modal_id).modal('hide');
        });
        upload_crop_area.croppie('destroy');
    });


    /*
    This event is fired immediately when the hide instance method has been called.

    Here, we check the required issue of input field.
    if input is required and image has been cropped then the input will valid or not.
     */
    $('#' + Image_upload_modal_id).on('hide.bs.modal', function (event) {

        // destroy croppie container
        if (upload_crop_area.data('croppie')) {
            upload_crop_area.croppie('destroy');
        }


        //The default close button id is "cropImageBtn", if you change it please change the selector
        if (document.activeElement.id == 'cropImageBtn') {

        } else {
            if (!document.getElementById(base64_value_field_id).value.trim()) {
                input_field.value = '';
            }
        }
    });
    function resetImage(input_details, elem) {
        var input = input_details.split(',');
        document.getElementById(input[0]).value = '';
        if($('#' + input[0] + '_hidden').length){
            document.getElementById(input[0] + '_hidden').value = '';
        }
        document.getElementById(input[0]).removeAttribute('disabled');
        $('#correspondent_signature').show();
        document.getElementById(input[1]).value = '';
        document.getElementById(input[2]).setAttribute('src', '{{ url('images/no_image.png') }}');
        elem.remove();
    }

    // function resetImage(input_id, base_64_id, img_preview_id, elem) {
    {{-- document.getElementById(input_id).value = ''; --}}
    {{-- document.getElementById(input_id).removeAttribute('disabled'); --}}
    {{-- document.getElementById(base_64_id).value = ''; --}}
    {{-- document.getElementById(img_preview_id).setAttribute('src', '{{ url('images/no_image.png') }}'); --}}
    {{-- elem.remove(); --}}
    // }

    // End upload preview image
</script>
