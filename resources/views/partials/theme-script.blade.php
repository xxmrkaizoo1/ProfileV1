<script>
    // Apply the saved (or system) color theme before the first paint to avoid a flash.
    (() => {
        let theme = null;

        try {
            theme = localStorage.getItem('theme');
        } catch (error) {
            theme = null;
        }

        if (theme !== 'light' && theme !== 'dark') {
            theme = window.matchMedia('(prefers-color-scheme: light)').matches ? 'light' : 'dark';
        }

        document.documentElement.dataset.theme = theme;
    })();
</script>
