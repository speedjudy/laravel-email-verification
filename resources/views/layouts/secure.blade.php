<script>
    var verified = `<?php echo Auth::user()->verified;?>`;
    if (!verified) {
        location.href="/";
    }
</script>