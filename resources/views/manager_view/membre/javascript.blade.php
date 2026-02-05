<script type="text/javascript">

    async function confirmAction(button, message) {
        const confirmed = await showConfirmButton(message)
        if (confirmed) {
            button.closest('form').submit();
        }
    }
</script>
