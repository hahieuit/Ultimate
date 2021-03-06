<?php
/*
 * @version 5.0.6
 * @package JotCache
 * @category Joomla 3.3
 * @copyright (C) 2010-2015 Vladimir Kanich
 * @license GNU General Public License version 2 or later
 */
defined('_JEXEC') or die;
JHtml::_('bootstrap.tooltip');
JHtml::_('behavior.multiselect');
JHtml::_('formbehavior.chosen', 'select');
$site_url = JURI::root();
$mode = $this->data->mode;
$listOrder = $this->lists['order'];
$listDirn = $this->lists['order_Dir'];
$sortFields = $this->getSortFields();
?>
<script language="javascript" type="text/javascript">
  Joomla.submitbutton = function(task) {
    if (task === 'deleteall') {
      if (confirm("<?php echo JText::_('JOTCACHE_RS_DELETE_ALL_CONFIRM'); ?>") !== true) {
        return;
      }
    }
    jotcache.submitform(task);
    /*    Joomla.submitform(task); */
  };
  Joomla.submitform = function(task, form) {
    jotcache.submitform(task, form);
  };
  orderTable = function() {
    table = document.getElementById("sortTable");
    direction = document.getElementById("directionTable");
    order = table.options[table.selectedIndex].value;
    if (order != '<?php echo $listOrder; ?>') {
      dirn = 'asc';
    } else {
      dirn = direction.options[direction.selectedIndex].value;
    }
    Joomla.tableOrdering(order, dirn, '');
  }
</script>
<style type="text/css">
  #toolbar-statplugin button.btn {
    background-image: linear-gradient(to bottom, <?php echo $this->statusPlugin; ?>);
  }
  #toolbar-statglobal button.btn {
    background-image: linear-gradient(to bottom, <?php echo $this->statusGlobal; ?>);
  }
  #toolbar-statclear button.btn {
    background-image: linear-gradient(to bottom, <?php echo $this->statusClear; ?>);
  }
</style>
<form action="<?php echo JRoute::_('index.php?option=com_jotcache'); ?>" method="post" name="adminForm" id="adminForm">
  <?php if (!empty($this->sidebar)): ?>
    <div id="j-sidebar-container" class="span2">
      <?php echo $this->sidebar; ?>
    </div>
    <div id="j-main-container" class="span10">
    <?php else : ?>
      <div id="j-main-container">
      <?php endif; ?>

      <?php
      if ($this->pars->enabled == 0 || $this->lists['last']) {
?>
        <span style="color:red;"><?php
          echo JText::_('JOTCACHE_RS_PLUGIN') . " ";
echo ($this->pars->enabled == 0) ? JText::_('JOTCACHE_RS_DISABLED') : "";
?> <?php
          echo ($this->lists['last']) ? JText::_('JOTCACHE_RS_NOT_LAST') . " " : "";
echo ($this->lists['plgid']) ? '<a href="' . JRoute::_('index.php?option=com_plugins&task=plugin.edit&extension_id=' . $this->lists['plgid']) . '">' . JText::_('JOTCACHE_RS_PLG_LINK') . '</a>' : "";
?></span>
      <?php } ?>
      <div id="filter-bar" class="btn-toolbar">
        <div class="filter-search btn-group pull-left">
          <?php
          if ($mode) {
$search_text = 'JOTCACHE_RS_USEARCH';
} else {
$search_text = 'JOTCACHE_RS_PSEARCH';
}?>
          <label for="filter_search" class="element-invisible"><?php echo JText::_($search_text); ?></label>
          <input type="text" name="filter_search" id="filter_search" placeholder="<?php echo JText::_($search_text); ?>" value="<?php echo $this->escape($this->lists['search']); ?>" title="<?php echo JText::_($search_text); ?>" onChange="jotcache.resetSelect(0);"/>
        </div>
        <div class="btn-group pull-left">
          <button class="btn hasTooltip" type="button" title="<?php echo JText::_('JSEARCH_FILTER_SUBMIT'); ?>" onclick="jotcache.resetSelect(0);"><i class="icon-search"></i></button>
          <button class="btn hasTooltip" type="button" title="<?php echo JText::_('JSEARCH_FILTER_CLEAR'); ?>" onclick="document.id('filter_search').value = '';
              jotcache.resetSelect(0);"><i class="icon-remove"></i></button>
        </div>
        <div class="btn-group pull-right hidden-phone">
          <label for="limit" class="element-invisible"><?php echo JText::_('JFIELD_PLG_SEARCH_SEARCHLIMIT_DESC'); ?></label>
          <?php echo $this->data->pageNav->getLimitBox(); ?>
        </div>
        <div class="btn-group pull-right hidden-phone">
          <label for="directionTable" class="element-invisible"><?php echo JText::_('JFIELD_ORDERING_DESC'); ?></label>
          <select name="directionTable" id="directionTable" class="input-medium" onchange="orderTable()">
            <option value=""><?php echo JText::_('JFIELD_ORDERING_DESC'); ?></option>
            <option value="asc" <?php if ($listDirn == 'asc') echo 'selected="selected"'; ?>><?php echo JText::_('JGLOBAL_ORDER_ASCENDING'); ?></option>
            <option value="desc" <?php if ($listDirn == 'desc') echo 'selected="selected"'; ?>><?php echo JText::_('JGLOBAL_ORDER_DESCENDING'); ?></option>
          </select>
        </div>
        <div class="btn-group pull-right">
          <label for="sortTable" class="element-invisible"><?php echo JText::_('JGLOBAL_SORT_BY'); ?></label>
          <select name="sortTable" id="sortTable" class="input-medium" onchange="orderTable()">
            <option value=""><?php echo JText::_('JGLOBAL_SORT_BY'); ?></option>
            <?php echo JHtml::_('select.options', $sortFields, 'value', 'text', $listOrder); ?>
          </select>
        </div>
      </div>
      <table class="table table-striped">
        <thead>
          <tr><th width="50">#</th>
            <th width="5"><input type="checkbox" name="toggle" value="" onclick="Joomla.checkAll(this);" /></th>
            <th class="title"><?php
              if ($mode) {
echo JHTML::_('grid.sort', 'JOTCACHE_RS_UTITLE', 'm.uri', @$this->lists['order_Dir'], @$this->lists['order']);
} else {
echo JHTML::_('grid.sort', 'JOTCACHE_RS_PTITLE', 'm.title', @$this->lists['order_Dir'], @$this->lists['order']);
}?></th>
            <?php if ($this->data->showfname) { ?>
              <th nowrap="true"><?php echo JText::_('JOTCACHE_RS_FNAME'); ?></th>
            <?php } ?>
            <th nowrap="nowrap"><?php echo JText::_('JOTCACHE_RS_COMP'); ?></th>
            <th nowrap="true"><?php echo JText::_('JOTCACHE_RS_VIEW'); ?></th>
            <th><?php echo Jhtml::_('grid.sort', 'JOTCACHE_RS_ID', 'm.id', $this->lists['order_Dir'], $this->lists['order']); ?></th>
            <th nowrap="nowrap"><?php echo Jhtml::_('grid.sort', 'JOTCACHE_RS_CREATED', 'm.ftime', $this->lists['order_Dir'], $this->lists['order']); ?></th>
            <th nowrap="nowrap"><?php echo Jhtml::_('grid.sort', 'JOTCACHE_RS_LANG', 'm.language', @$this->lists['order_Dir'], @$this->lists['order']); ?></th>
            <th nowrap="nowrap"><?php echo Jhtml::_('grid.sort', 'JOTCACHE_RS_BROWSER', 'm.browser', @$this->lists['order_Dir'], @$this->lists['order']); ?></th>
            <th nowrap="nowrap"><?php echo JText::_('JOTCACHE_RS_MARK'); ?></th>
          </tr>
        </thead>
        <?php
        $rows = $this->data->rows;
$k = 0;
for ($i = 0, $n = count($rows); $i < $n; $i++) {
$row = $rows[$i];
$checked = '<input type="checkbox" onclick="Joomla.isChecked(this.checked);" value="' . $row->fname . '" name="cid[]" id="cb' . $i . '">';
$expired = strlen($row->ftime) > 20 ? ' style="font-style: italic;"' : '';
$mark_qs = '';
if ($row->mark == 1) {
if (strlen($row->qs) > 0) {
$qitems = unserialize($row->qs);
foreach ($qitems as $key => $value) {
if ($mark_qs != '')
$mark_qs.='&';
$mark_qs.=$key . '=' . $value;
}$mark_qs = $site_url . 'index.php?' . $mark_qs;
$mark_qs = '<a href="' . $mark_qs . '" target="_blank">' . JText::_('JOTCACHE_RS_SEL_MARK_YES') . '</a>';
}else {
$mark_qs = JText::_('JOTCACHE_RS_SEL_MARK_YES');
}}?>
          <tr class="<?php echo "row$k"; ?>" <?php echo $expired; ?>>
            <td align="right"><?php echo $this->data->pageNav->getRowOffset($i); ?></td>
            <td align="center"><?php echo $checked; ?></td>
            <?php if ($mode) { ?>
              <td><a href="<?php echo $row->uri; ?>" target="_blank" title="<?php echo $row->title; ?>"><?php echo $row->uri; ?></a></td>
            <?php } else { ?>
              <td><a href="<?php echo $row->uri; ?>" target="_blank"><?php echo $row->title; ?></a></td>
            <?php } ?>
            <?php if ($this->data->showfname) { ?>
              <td><a href="<?php echo JRoute::_('index.php?option=com_jotcache&view=main&task=debug&mode=preview&fname=' . $row->fname); ?>" target="_top" title="<?php echo $row->title; ?>"><?php echo $row->fname; ?></a></td>
            <?php } ?>
            <td><?php echo $row->com; ?></td>
            <td><?php echo $row->view; ?></td>
            <td align="right" style="padding-right:30px;"><?php echo $row->id; ?></td>
            <td align="center"><?php echo $row->ftime; ?></td>
            <td align="center"><?php echo $row->language; ?></td>
            <td align="center"><?php echo $row->browser; ?></td>
            <?php
            if ($this->showcookies) {
$rcookies = substr($row->cookies, 1);
$cookies = explode('#', $rcookies);
?>
              <td align="center"><table class="showcookies"><?php
                  foreach ($cookies as $cookie) {
echo '<tr><td  style="border:0px;">' . $cookie . '</td></tr>';
}?></table></td>
            <?php } ?>
            <td align="center"><?php echo $mark_qs; ?></td>
          </tr>
          <?php
          $k = 1 - $k;
}?>
      </table>
      <br/>
      <?php echo $this->data->pageNav->getListFooter(); ?>
      <input type="hidden" id="form_view" name="view" value="main" />
      <input type="hidden" id="form_task" name="task" value="" />
      <input type="hidden" name="boxchecked" value="0" />
      <input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>" />
      <input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>" />
    </div>
</form>