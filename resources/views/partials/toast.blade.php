@if(session('toast'))
<script>
document.addEventListener('DOMContentLoaded', function () {
    Swal.fire({
        toast: true,
        position: 'top-end',
        icon: "{{ session('toast.type','info') }}",
        title: @json(session('toast.message')),
        showConfirmButton: false,
        timer: {{ session('toast.timer', 2500) }},
        timerProgressBar: true
    });
});
</script>
@endif