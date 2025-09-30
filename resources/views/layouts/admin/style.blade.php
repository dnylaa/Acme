<style>
    @import url('https://rsms.me/inter/inter.css');

    :root {
        --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
    }

    body {
        font-feature-settings: "cv03", "cv04", "cv11";
        font-family: var(--tblr-font-sans-serif);
        min-height: 100vh;
        display: flex;
        flex-direction: column;
    }

    .note-editable ul {
        list-style-type: initial !important;
        padding-left: 20px !important;
    }

    .note-editable ol {
        list-style-type: decimal !important;
        padding-left: 20px !important;
    }

    /* bg-pink custom */
.bg-pink {
    background-color: #db2858 !important;
}

/* Sidebar menu vertical */
.sidebar .navbar-nav {
    flex-direction: column; /* pastikan menu vertikal */
}

.sidebar .nav-link {
    color: white !important;
}

.sidebar .dropdown-menu {
    position: relative; /* dropdown muncul di dalam sidebar */
    background-color: #db2858; 
    border: none;
}

/* Konten sebelah kanan */
.content-wrapper {
    margin-left: 250px; /* sesuai lebar sidebar */
    padding: 20px;
}

</style>

@stack('styles')

