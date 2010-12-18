<h3><?php echo lang('polls.manage_poll_label'); ?></h3>
<?php echo form_open($this->uri->uri_string(), 'class="crud"'); ?>
	
	<!-- Poll ID -->
	<input type="hidden" name="poll_id" id="poll_id" value="<?php echo $poll['id']; ?>" />
	
	<ul>
		<li>
			<label for="title"><?php echo lang('polls.title_label'); ?></label>
			<input type="text" id="title" name="title" maxlength="255" value="<?php echo $poll['title']; ?>" />
			<span class="required-icon tooltip">Required</span>
		</li>

		<li class="even">
			<label for="slug"><?php echo lang('polls.slug_label'); ?></label>
			<?php echo form_input('slug', $poll['slug'], 'class="width-15"'); ?>
			<span class="required-icon tooltip">Required</span>
		</li>

		<li class="odd description">
			<label for="description"><?php echo lang('polls.description_label'); ?></label>
			<?php echo form_textarea(array('id'=>'description', 'name'=>'description', 'value' => $poll['description'], 'rows' => 10, 'class' => 'wysiwyg-simple')); ?>
		</li>

		<li id="section_options" class="even">
			<label for="options"><?php echo lang('polls.options_label'); ?></label>
			
			<div style="float: left; width: 700px;">
				<p>
					A poll option can either be <strong>defined</strong> or <strong>other</strong>.
					A <strong>defined</strong> poll option lets the user vote for a poll option that you specify.
					An <strong>other</strong> poll options allows the user to enter text into a text input for that particular option.
				</p>
				<ul id="options" style="float:left;">
					<li id="new_option">
						<select name="new_option_type" id="new_option_type">
							<option value="defined"><?php echo lang('polls.defined'); ?></option>
							<option value="other"><?php echo lang('polls.other'); ?></option>
						</select>
						<input type="text" name="new_option_title" id="new_option_title" />
						<input type="button" id="add_new_option" value="Add Option" />
					</li>
					<?php if ( isset($poll['options']) ): ?>
						<?php foreach($poll['options'] as $option): ?>
							<?php if ($option !== ''): ?>
								<li>
									<?php echo form_dropdown('options[' . $option['id'] . '][type]', array('defined'=>lang('polls.defined'), 'other'=>lang('polls.other')), $option['type']); ?>
									<input type="text" name="options[<?php echo $option['id']; ?>][title]" value="<?php echo $option['title']; ?>" />
								</li>
							<?php endif; ?>
						<?php endforeach; ?>
					<?php endif; ?>
				</ul>
			</div>
			<br style="clear: both;" />
		</li>
		
		<li class="odd">
			<label for="type"><?php echo lang('polls.type_label'); ?></label>
			<div style="float: left">
				<p>
					A poll can either be <strong>single</strong> or <strong>multiple</strong>.
					A <strong>single</strong> poll restricts users to only voting for one poll option.
					A <strong>multiple</strong> poll allows the user to vote for multiple poll options.
				</p>
				<?php echo form_dropdown('type', array('single'=>lang('polls.single'), 'multiple'=>lang('polls.multiple')), $poll['type']); ?>
			</div>
		</li>

		<li class="even">
			<label for="open_date"><?php echo lang('polls.open_date_label'); ?></label>
			<?php echo form_input('open_date', timestamp_to_date($poll['open_date']), 'id="open_date"'); ?>
		</li>

		<li class="odd">
			<label for="close_date"><?php echo lang('polls.close_date_label'); ?></label>
			<?php echo form_input('close_date', timestamp_to_date($poll['close_date']), 'id="close_date"'); ?>
		</li>

		<li class="even">
			<label for="comments"><?php echo lang('polls.comments_label'); ?></label>
			<?php echo form_dropdown('comments_enabled', array('1'=>lang('polls.yes'), '0'=>lang('polls.no')), $poll['comments_enabled']); ?>
		</li>

		<li class="odd">
			<label for="members_only"><?php echo lang('polls.members_only_label'); ?></label>
			<?php echo form_dropdown('members_only', array('1'=>lang('polls.yes'), '0'=>lang('polls.no')), $poll['members_only']); ?>
		</li>

	</ul>

	<?php $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'cancel') )); ?>
<?php echo form_close(); ?>