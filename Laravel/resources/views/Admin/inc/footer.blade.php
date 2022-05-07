<script>
    $(document).ready(function() {
        $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#tableData tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>




<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.repeater/1.2.1/jquery.repeater.min.js"></script>


<script>
    $(function() {
        $(document).on('click', '.btn-add', function(e) {
            e.preventDefault();
            var controlForm = $('#myRepeatingFields:first'),
                currentEntry = $(this).parents('.entry:first'),
                newEntry = $(currentEntry.clone()).appendTo(controlForm);
            newEntry.find('input').val('');
            controlForm.find('.entry:not(:first) .btn-add')
                .removeClass('btn-add').addClass('btn-remove')
                .removeClass('btn-success').addClass('btn-danger').addClass('btn.lg').addClass('btn')
                .html('');
        }).on('click', '.btn-remove', function(e) {
            e.preventDefault();
            $(this).parents('.entry:first').remove();
            return false;
        });
    });
</script>


<script>
    // form repeater Initialization
    $('.repeater-default').repeater({
        show: function() {
            $(this).slideDown();
        },
        hide: function(deleteElement) {
            if (confirm('Are you sure you want to delete this element ?')) {
                $(this).slideUp(deleteElement);
            }
        }
    });
</script>


{{-- <script>
    setInterval(function() {
            // $("#noti_content").load(window.location.href +"#noti_content" );
            $("#noti_count").load(window.location.href +"#noti_count");
    }, 5000);
</script> --}}

<script>
function updateNotification()
{

    $('#noti_count').load(window.location.href + ' #noti_count');
    $('#noti_countt').load(window.location.href + ' #noti_countt');
    $('#noti_content').load(window.location.href + ' #noti_content');
}
setInterval(function() {
            // $("#noti_content").load(window.location.href +"#noti_content" );
            updateNotification()
    }, 5000);
</script>

</div>
</div>
<footer class="footer">
    <div class="d-sm-flex justify-content-center justify-content-sm-between">
        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block"> <a href="http://mypartner.test/"
                target="_blank" style="text-decoration: none">
                <i class="mdi mdi-account-multiple">MyPartner</i>

                {{-- <img class="img" style="d-block ; width:10%; height:30%; object-fit:cover; float:left"
                   src="{{ asset('images/logo/P.svg') }}" alt="Logo"> --}}
            </a> </span>
        <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Copyright © 2021. All rights
            reserved.</span>
    </div>
</footer>
{{-- start --}}
<!-- plugins:js -->
<script src="{{ asset('vendors/js/vendor.bundle.base.js') }}"></script>
<!-- endinject -->
<!-- Plugin js for this page -->
<script src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('vendor/progressbar.js/progressbar.min.js') }}"></script>

<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="{{ asset('js/off-canvas.js') }}"></script>
<script src="{{ asset('js/hoverable-collapse.js') }}"></script>
<script src="{{ asset('js/template.js') }}"></script>
<script src="{{ asset('js/settings.js') }}"></script>
<script src="{{ asset('js/todolist.js') }}"></script>
<!-- endinject -->
<!-- Custom js for this page-->
<script src="{{ asset('js/jquery.cookie.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/dashboard.js') }}"></script>
<script src="{{ asset('js/Chart.roundedBarCharts.js') }}"></script>
<!-- End custom js for this page-->
{{-- ENd --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>

</html>
