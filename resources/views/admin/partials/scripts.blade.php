<script src="{{ url('app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js') }}"></script>

<script src="{{ url('app-assets/vendors/js/extensions/toastr.min.js') }}"></script>

<script src="{{ url('assets/js/jquery.confetti.js') }}"></script>

<script>

    $('body').on('click', '.confirm-proceed', function () {

        $(this).addClass('disabled');

        if (confirm('Are you sure you want to proceed?')) {
            window.location = $(this).attr('href');
        } else {
            $(this).removeClass('disabled');
            return false;
        }
    });

    function copyToClipboard(text) {


        const elem = document.createElement('textarea');
        elem.value = text;
        document.body.appendChild(elem);
        elem.select();
        document.execCommand('copy');
        document.body.removeChild(elem);

        toastr['success']('', 'Copied!', {
            closeButton: true,
            progressBar: true,
            positionClass: 'toast-top-center',
            tapToDismiss: false,
            rtl: false
        });

    }

    $('body').on('click', '.copytoclipboard', function () {

        var element = $(this).data('copy');


        var copyText = document.getElementById(element);


        /* Select the text field */
        copyText.select();
        copyText.setSelectionRange(0, 99999); /* For mobile devices */

        /* Copy the text inside the text field */
        document.execCommand("copy");

        $(this).html('Copied!');

        //  $(this).attr('disabled', true);

    });
    //For search bar copied from public/app-assets/js/core/app.js


</script>
<script>
    $(window).on('load', function () {

        $('.flatpicker').flatpickr({
            dateFormat: "Y-m-d",
        });
        if (feather) {
            feather.replace({
                width: 14,
                height: 14
            });
        }
    })


</script>


