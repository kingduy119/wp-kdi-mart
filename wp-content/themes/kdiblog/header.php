<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <?php wp_head(); ?>
    
    <title>
        <?php is_home() ? bloginfo('name') : wp_title('', true, ''); ?>
    </title>
</head>

<body>
    <div id="page" class="pb-4">
        <header id="page-header">
            <?php
                get_template_part('modules/header/navbar');
                get_template_part('modules/header/breadcrumb');
            ?>
        </header>

        <?php if( is_active_sidebar( 'middle-header-content' ) ) { dynamic_sidebar('middle-header-content'); } ?>
        
        <div id="page-content" class="mb-3">
