<div id="wpbody">
	<div class="wrap">
		<h2><?php _e('Tabs Settings') ?></h2>
		<form action="options.php" method="post">
			<?php settings_fields( 'sis_tabs_options' ); ?>
			<?php $options = get_option( 'sis_tabs_options' ); ?>
			<table class="form-table">
				<tbody>
					<!-- Option 1: Radio Collapsible -->
					<tr valign="top">
	                    <th scope="row">
	                        <label><?php _e('Collapsible') ?></label>
	                    </th>
	                    <td>
	                        <input type="radio" name="sis_tabs_options[collapsible]" value="true" <?php checked( $options['collapsible'], 'true' ); ?> />Yes
	                        <input type="radio" name="sis_tabs_options[collapsible]" value="false" <?php checked( $options['collapsible'], 'false' ); ?> />No
	                        <p class="description"><?php _e('When set to Yes, the active panel can be closed. Click the selected tab to toggle its content closed/open.') ?></p>
	                    </td>
	                </tr>
					<!-- Option 2: Text active -->
					<tr valign="top">
	                    <th scope="row">
	                        <label><?php _e('Active') ?></label>
	                    </th>
	                    <td>
	                        <input type="text" name="sis_tabs_options[active]" id="active" value="<?php esc_attr_e($options['active']); ?>" >
	                        <p class="description"><?php _e('Which panel is currently open. Setting active to false will collapse all panels. This requires the collapsible option to be Yes. Integer: The zero-based index of the panel that is active (open). A negative value selects panels going backward from the last panel.') ?></p>
	                    </td>
	                </tr>
					<!-- Option 3: Text disabled -->
					<tr valign="top">
	                    <th scope="row">
	                        <label><?php _e('Disabled') ?></label>
	                    </th>
	                    <td>
	                        <input type="text" name="sis_tabs_options[disabled]" id="disabled" value="<?php esc_attr_e($options['disabled']); ?>" >
	                        <p class="description"><?php _e('Which tabs are disabled. An array containing the zero-based indexes of the tabs that should be disabled, e.g., [ 0, 2 ] would disable the first and third tab.') ?></p>
	                    </td>
	                </tr>
					<!-- Option 4: Radio event -->
					<tr valign="top">
	                    <th scope="row">
	                        <label><?php _e('Event') ?></label>
	                    </th>
	                    <td>
	                        <input type="radio" name="sis_tabs_options[event]" value="click" <?php checked( $options['event'], 'click' ); ?> />Click
	                        <input type="radio" name="sis_tabs_options[event]" value="mouseover" <?php checked( $options['event'], 'mouseover' ); ?> />Mouseover
	                        <p class="description"><?php _e('Toggle sections open/closed on mouseover with the event option. The default value for event is "click".  To activate on hover, use "mouseover".') ?></p>
	                    </td>
	                </tr>
					<!-- Option 5: Select Height Style -->
					<tr valign="top">
	                    <th scope="row">
	                        <label><?php _e('Height Style') ?></label>
	                    </th>
	                    <td>
	                        <select name="sis_tabs_options[heightStyle]">
	                            <option value="auto" <?php selected( $options['heightStyle'], 'auto' ); ?>>Auto</option>
	                            <option value="fill" <?php selected( $options['heightStyle'], 'fill' ); ?>>Fill</option>
	                            <option value="content" <?php selected( $options['heightStyle'], 'content' ); ?>>Content</option>
	                        </select>
	                        <p class="description"><?php _e('Controls the height of the tabs widget and each panel. Possible values:  "auto": All panels will be set to the height of the tallest panel. "fill": Expand to the available height based on the tabs parent height. "content": Each panel will be only as tall as its content.') ?></p>
	                    </td>
	                </tr>
					<!-- Option 6: Select Theme Style -->
					<tr valign="top">
	                    <th scope="row">
	                        <label><?php _e('Select Theme') ?></label>
	                    </th>
	                    <td>
	                        <select name="sis_tabs_options[theme]">
	                            <option value="lightness" <?php selected( $options['theme'], 'lightness' ); ?>>lightness</option>
	                            <option value="black-tie" <?php selected( $options['theme'], 'black-tie' ); ?>>black-tie</option>
	                            <option value="blitzer" <?php selected( $options['theme'], 'blitzer' ); ?>>blitzer</option>
	                            <option value="cupertino" <?php selected( $options['theme'], 'cupertino' ); ?>>cupertino</option>
	                            <option value="dark-hive" <?php selected( $options['theme'], 'dark-hive' ); ?>>dark-hive</option>
	                            <option value="darkness" <?php selected( $options['theme'], 'darkness' ); ?>>darkness</option>
	                            <option value="dot-luv" <?php selected( $options['theme'], 'dot-luv' ); ?>>dot-luv</option>
	                            <option value="eggplant" <?php selected( $options['theme'], 'eggplant' ); ?>>eggplant</option>
	                            <option value="excite-bike" <?php selected( $options['theme'], 'excite-bike' ); ?>>excite-bike</option>
	                            <option value="flick" <?php selected( $options['theme'], 'flick' ); ?>>flick</option>
	                            <option value="humanity" <?php selected( $options['theme'], 'humanity' ); ?>>humanity</option>
	                            <option value="le-frog" <?php selected( $options['theme'], 'le-frog' ); ?>>le-frog</option>
	                            <option value="overcast" <?php selected( $options['theme'], 'overcast' ); ?>>overcast</option>
	                            <option value="pepper-grinder" <?php selected( $options['theme'], 'pepper-grinder' ); ?>>pepper-grinder</option>
	                            <option value="redmond" <?php selected( $options['theme'], 'redmond' ); ?>>redmond</option>
	                            <option value="smoothness" <?php selected( $options['theme'], 'smoothness' ); ?>>smoothness</option>
	                            <option value="south-street" <?php selected( $options['theme'], 'south-street' ); ?>>south-street</option>
	                            <option value="start" <?php selected( $options['theme'], 'start' ); ?>>start</option>
	                            <option value="sunny" <?php selected( $options['theme'], 'sunny' ); ?>>sunny</option>
	                            <option value="vader" <?php selected( $options['theme'], 'vader' ); ?>>vader</option>
	                        </select>
	                        <p class="description"><?php _e('Select theme style.') ?></p>
	                    </td>
	                </tr>
				</tbody>
			</table>
			<p class="submit"><input type="submit" value="<?php _e('Save Changes') ?>" class="button button-primary" id="submit" name="submit"></p>
		</form>
	</div>
	<div class="clear"></div>
</div>
<div class="clear"></div>