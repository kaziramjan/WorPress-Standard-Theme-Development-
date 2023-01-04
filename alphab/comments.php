<div class="comments">
    <h2 class="comments-title">
        <?php
        $alphab_cn = get_comments_number();
        if(1==$alphab_cn){
            _e("1 Comment", "alphab");
        }else {
            echo $alphab_cn. __("Comments", "alphab");
        }       
        ?>
    </h2>
    <div class="comments-list">
        <?php
        wp_list_comments();
        if(!comments_open()){
            _e("Comments are closed.", "alphab");
        }
        ?>
        <div class="comments-pagination">
            <?php 
                the_comments_pagination(array(
                    'prev_text' => '<'.__("Previous Comments", "alphab"),
                    'next_text' => '>'.__("Next Comments", "alphab"),
                )); 
            ?>
        </div>
        <div class="comments-form">
            <?php 
                comment_form();
            ?>
        </div>
    </div>
</div>
