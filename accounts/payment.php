<?php
get_header();
global $current_user,$wp_roles;

$issubscriber = null;
if(!empty($current_user->roles)){
    $issubscriber = array_intersect($current_user->roles, [
        'free-account',
        'premium-account',
        'premium-unpaid-account',
        'regular-account',
        'regular-unpaid-account',
    ]);

    if(count($issubscriber)){
        $issubscriber = array_values($issubscriber)[0];
    }
}

if(empty($issubscriber)){
    ?>
<script>window.location.assign('<?=site_url('accounts')?>')</script>
    <?php
}
?>
<section>
    <header class="text-center margin-bottom-30">
        <h2 class="section-title">Complete Subscription</h2>
    </header>
    <div class="container">
        <?php

        if($issubscriber && in_array($issubscriber,[
            'premium-account',
            'premium-unpaid-account',
            'regular-account',
            'regular-unpaid-account',
            ])): ?>
            <div class="callout alert alert-border margin-top-0 margin-bottom-10">
                <div class="row">
                    <div class="col-md-8 col-sm-8"><!-- left text -->
                        <h4>Welcome to Market MasterClass</h4>
                        <p class="font-lato size-17">
                            You are currently subscribed to <strong><?=$wp_roles->roles[$issubscriber]['name']?></strong><br>
                            <small>We need to settle your account to complete the registration</small>
                        </p>
                    </div><!-- /left text -->
                    <div class="col-md-4 col-sm-4 text-right"><!-- right btn -->
                        <?php do_shortcode('[PAYPALCLIENT]')?>
                    </div><!-- /right btn -->
                </div>

            </div>

        <?php endif; ?>

    </div>
</section>
<?php
get_footer();
