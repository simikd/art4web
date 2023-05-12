<div>
    @push('scripts')
        <script type="module">
            document.addEventListener('DOMContentLoaded', function () {
            @this.on('triggerDelete', postId => {
                Swal.fire({
                    title: 'Are You Sure?',
                    text: 'This post will be deleted!',
                    showCancelButton: true,
                    confirmButtonColor: '#bf2727',
                    confirmButtonText: 'Delete!'
                }).then((result) => {
                    if (result.value) {
                    @this.call('delete', postId);
                    }
                });
            });
            })
        </script>
    @endpush
</div>
