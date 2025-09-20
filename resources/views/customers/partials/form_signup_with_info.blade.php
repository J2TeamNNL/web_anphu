<style>
    /* Section background */
    .section-bg-contact {
        background-color: var(--lux-dark);
        background-image:
            linear-gradient(rgba(11, 28, 44, 0.85), rgba(11, 28, 44, 0.85)),
            url('/assets/img/gallery/background_danmask_1.jpg');
        background-position: center;
        background-repeat: repeat;
        background-size: auto;
        background-attachment: fixed;
        position: relative;
        border-bottom: 2px solid var(--anphu-gold);
        width: 100%;
    }
</style>
<section class="py-5 section-bg-contact">
    <div class="container">
        <x-consulting-form
            title="ĐĂNG KÝ NHẬN MẪU BẢN VẼ MIỄN PHÍ"
            :showInfo="true"
            style="default"
        />
    </div>
</section>