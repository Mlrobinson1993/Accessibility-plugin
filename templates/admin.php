<div class="wrap">
    <h1>Accessibility Tester</h1>
    <?php settings_errors();?>

    <?php
        do_settings_sections( 'a11y_plugin' );
        settings_fields( 'a11y_headings' )
        ?>

<div id="col-container" class="main-container" style>

		<div id="col-right">

            <h2>Error Locations</h2>

			<div class="col-wrap postbox error-container">

            </div>

		</div>

		<div id="col-left">

            <h2>Errors</h2>
			<div class="col-wrap postbox list-container">


                    <!--CONTAINER FOR ERROR INSTANCES-->
                    <div class="spinner">
                    </div>


            </div>

        </div>

    </div>

    <p class="submit">

        <button class="a11y-page-btn button-primary" type="button">Get Score</button>

    </p>

</div>