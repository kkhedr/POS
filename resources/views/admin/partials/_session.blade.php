@if (session('success'))

    <script>
        new Noty({
            type: 'success',
            layout: 'topRight',
            text: "{{ session('success') }}",
            timeout: 2000,
            killer: true
        }).show();
    </script>

@endif

<!-- @if (session('edit_wrong'))

    <script>
        new Noty({
            type: 'error',
            layout: 'center',
            text: "{{ session('edit_wrong') }}",
            timeout: 2000,
            killer: true
        }).show();
    </script>

 @endif -->

@if (session('edit_wrong'))

<script>
var n = new Noty({
                text: "{{ session('edit_wrong') }}",
                type: "error",
                layout: 'center',
                killer: true,
                buttons: [
                    Noty.button("موافق", 'btn btn-primary mr-2', function () {
                        n.close();
                    })
                ]
            });
            n.show();
</script>
@endif



@if (session('edit'))

    <script>
        new Noty({
            type: 'information',
            layout: 'topRight',
            text: "{{ session('edit') }}",
            timeout: 2000,
            killer: true
        }).show();
    </script>

@endif


@if(session('delete'))

    <script>
        new Noty({
            type: 'error',
            layout: 'topRight',
            text: "{{ session('delete') }}",
            timeout: 2000,
            killer: true
        }).show();
    </script>

@endif
