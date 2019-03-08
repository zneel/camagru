<?php
if (!isset($_SESSION)) {
    session_start();
}
?>
<footer class="footer">
    <div class="content has-text-centered">
        <p>
            <strong>Camagru</strong> by <a href="https://github.com/zneel">ebouvier</a>. Coded very fast with hate.
        </p>
    </div>
</footer>
<script>
    (function () {
        const burger = document.querySelector('.navbar-burger');
        const menu = document.querySelector('.navbar-menu');
        burger.addEventListener('click', () => {
            burger.classList.toggle('is-active');
            menu.classList.toggle('is-active');
        });
    })();
</script>
