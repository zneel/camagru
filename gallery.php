<?php
/**
 * Created by PhpStorm.
 * User: ebouvier
 * Date: 2019-02-27
 * Time: 09:29
 */
if (!isset($_SESSION)) {
    session_start();
}
?>
<div class="container">
    <h2 class="subtitle has-text-centered has-text-white">Nos photos</h2>
    <div class='columns is-multiline'>
        <?php
        for ($i = 0; $i <= 5; $i++) {
            echo <<<HTML
             <div class='column is-4'>
                <div class="card">  
                    <div class="card-image">
                        <figure class="image is-16by9">
                            <img src="https://via.placeholder.com/1280x720" alt="Placeholder image">
                        </figure>
                    </div>
                    <div class="content">
                        <div style="margin: 5px 0" class="level">
                            <p style="margin: 0" class="level-left">Username</p>
                            <p class="has-text-right level-right">
                                <a class="button is-default"><i class="fa fa-thumbs-up"></i> 5254</a>
                                <a class="button is-default"><i class="fa fa-thumbs-down"></i> 1</a>
                            </p>
                        </div>
                        <time datetime="2016-1-1">11:09 PM - 1 Jan 2016</time>
                    </div>
                </div>
            </div>
HTML;
        }
        ?>
    </div>
    <nav class="pagination is-centered" role="navigation" aria-label="pagination">
        <ul class="pagination-list">
            <li>
                <a class="pagination-link is-current" aria-label="Page 1" aria-current="page">1</a>
            </li>
            <li>
                <a class="pagination-link" aria-label="Goto page 2">2</a>
            </li>
            <li>
                <a class="pagination-link" aria-label="Goto page 3">3</a>
            </li>
        </ul>
    </nav>
</div>