<?php

// Print the standard menu item format
function madwell_menu_item($post_ID) {

	$item_string = '';

	$item_string .= '<li class="menu-item">';
		$item_string .= '<h5 class="menu-item__name">' . esc_html(get_sub_field('name', $post_ID)) . '</h5>';
		if ( get_sub_field('name', $post_ID) ) $item_string .= '<p class="menu-item__description">' . esc_html(get_sub_field('name', $post_ID)) . '</p>';
		if ( get_sub_field('price', $post_ID) ) $item_string .= '<p class="menu-item__price">' . esc_html(get_sub_field('price', $post_ID)) . '</p>';
	$item_string .= '</li>';

	echo $item_string;
};

// Helper function from GitHub user Maerlyn http://stackoverflow.com/a/2955878
function slugify($text) {

	// replace non letter or digits by -
	$text = preg_replace('~[^\pL\d]+~u', '-', $text);

	// transliterate
	$text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

	// remove unwanted characters
	$text = preg_replace('~[^-\w]+~', '', $text);

	// trim
	$text = trim($text, '-');

	// remove duplicate -
	$text = preg_replace('~-+~', '-', $text);

	// lowercase
	$text = strtolower($text);

	if (empty($text)) {
		return 'n-a';
	}

	return $text;
};

// Print out the whole menu for a post, default to current post
function the_madwell_menu( $post_ID = '' ) {

	// Default to current post
	global $post;
	if ( $post_ID == '' ) $post_ID = $post->ID;

	// Store the whole shebang in variable, in case we need to access or count things directly, outside the loop
	$the_menu = get_field('menu_sections', $post_ID);

	// Start flexible content
	if ( have_rows('menu_sections', $post_ID) ) :

		while ( have_rows('menu_sections', $post_ID) ) : the_row();

			// Create section element, use section name (apllicable to all layouts)
			echo '<section class="menu-section" id="menu-section--' . esc_url(slugify( get_sub_field('section_name', $post_ID) )) . '">';

				// Section header
				echo '<h3 class="menu-section__title">' . esc_html(get_sub_field('section_name', $post_ID)) . '</h3>';
				if ( get_field('section_description', $post_ID) ) echo esc_html(get_field('section_description', $post_ID));

				// Print out top-level menu items that do not belong in any subsection (applicable to all layouts)
				if ( get_field('menu_items', $post_ID) ) {

					echo '<ul class="menu-section__items menu-section__items--no-subsection">';
						while ( has_sub_field('menu_items') ) {

							// Call helper function to print standard menu item list item
							madwell_menu_item( $post_ID );

						}
					echo '</ul>';
				}

				switch ( get_row_layout() ) {

					// This layout has subsections, each with their own menu items
					case 'standard_subsections':

						if ( have_rows('subsections', $post_ID) ) :

							echo '<div class="menu-subsections">';

								echo '<ul class="menu-subsections__nav">';

									while ( have_rows('subsections', $post_ID) ) : the_row();

										// List all subsections (nav)
										echo '<li class="menu-subsections__nav-item" data-target="' . esc_attr(slugify( get_sub_field('subsection_name', $post_ID) )) . '">' . esc_html(get_sub_field('subsection_name', $post_ID)) . '</li>';

									endwhile;

								echo '</ul>';

								while ( have_rows('subsections', $post_ID) ) : the_row();

									// Create subsection element, use subsection name
									echo '<div class="menu-subsection" data-name="' . esc_attr(slugify( get_sub_field('subsection_name', $post_ID) )) . '" id="menu-subsection--' . esc_url(slugify( get_sub_field('subsection_name', $post_ID) )) . '">';

										// Subsection header
										echo '<h4 class="menu-subsection__title">' . esc_html(get_sub_field('subsection_name', $post_ID)) . '</h3>';
										if ( get_sub_field('subsection_description', $post_ID) ) echo '<p class="menu-subsection__description">' . esc_html(get_sub_field('subsection_description', $post_ID)) . '</p>';

										// Print out menu items for subsection
										if ( get_sub_field('subsection_menu_items', $post_ID) ) {

											echo '<ul class="menu-subsection__items">';
												while ( has_sub_field('subsection_menu_items') ) {

													// Call helper function to print standard menu item list item
													madwell_menu_item( $post_ID );

												}
											echo '</ul>';
										}

									echo '</div>';

								endwhile; // while subsections

							echo '</div>';

						endif; // if subsections

						break;

				} // /switch

			echo '</section>';

		endwhile;

	endif; // end flexible content
};