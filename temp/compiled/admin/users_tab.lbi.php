<div class="tabs_info">
    <ul>
        <li <?php if ($this->_var['menu_select']['current'] == '03_users_list'): ?>class="curr"<?php endif; ?>>
            <a href="users.php?act=list"><?php echo $this->_var['lang']['03_users_list']; ?></a>
        </li>
        <li <?php if ($this->_var['menu_select']['current'] == '05_user_rank_list'): ?>class="curr"<?php endif; ?>>
            <a href="user_rank.php?act=list"><?php echo $this->_var['lang']['05_user_rank_list']; ?></a>
        </li>
        <li <?php if ($this->_var['menu_select']['current'] == '16_users_real'): ?>class="curr"<?php endif; ?>>
            <a href="user_real.php?act=list"><?php echo $this->_var['lang']['16_users_real']; ?></a>
        </li>
        <li <?php if ($this->_var['menu_select']['current'] == '16_reg_fields'): ?>class="curr"<?php endif; ?>>
            <a href="reg_fields.php?act=list"><?php echo $this->_var['lang']['16_reg_fields']; ?></a>
        </li>
    </ul>
</div>