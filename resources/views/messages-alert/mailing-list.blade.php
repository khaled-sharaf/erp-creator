@if(session('message_session_mailing_list'))
    <script>
        setTimeout(() => {
            Swal.fire({
                type: "{{ session('type_message') }}",
                text: "{{ session('message_session_mailing_list') }}",
                showConfirmButton: false,
                timer: 4000
            })
        }, 2000)
    </script>
@endif

