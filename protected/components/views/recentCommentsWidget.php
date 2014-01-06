<ul>
	<?php foreach($this->getData() as $comment): ?>
		<div class="author">
			<?php
				echo TbHtml::encode($comment->author->username);
			?> added a comment to:
		</div>

		<div class="issue">
			<?php
				echo CHtml::link(
					CHtml::encode($comment->issue->name),
					array(
						'issue/view',
						'id' => $comment->issue->id
					)
				);
			?>
		</div>
	<?php endforeach; ?>
</ul>