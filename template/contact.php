<?php 
    /**
     * Template Name: Contact
     */
?>

<?php get_header(); ?>
<div class="content">
    <div id="main-content">
        <div class="contact-information">
            <h4>Liên hệ:</h4>
            <p><i class="fa fa-github" aria-hidden="true"></i>Github: <a href="https://github.com/trungta897"> Nguyễn Hiếu</a></p>
        </div>

        <div class="contact-form">
            <?php echo do_shortcode('[contact-form-7 id="3f2ab21" title="Form liên hệ 1"]'); ?>
        </div>
    </div>
    <div id="sidebar">
        <?php get_sidebar(); ?>
    </div>
</div>
<?php get_footer(); ?>