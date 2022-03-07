<div class="form-group">
  <label for="name">Name</label>
  <input type="text" name="name" id="name" class="form-control" value="<?= (isset($q)?$q->getName():'') ?>" />
  <?php if (isset($formerrors['name'])): ?>
    <div class="alert alert-danger alert-dismissible mt-3">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <span class="form-error"><?= $formerrors['name'] ?></span>
    </div>
  <?php endif; ?>
</div>

<div class="form-group">
  <label for="name"> url link of partner</label>
  <input type="text" name="linkurl" id="linkurl" class="form-control" value="<?= (isset($q)?$q->getLinkurl():'') ?>" />
  <?php if (isset($formerrors['linkurl'])): ?>
    <div class="alert alert-danger alert-dismissible mt-3">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <span class="form-error"><?= $formerrors['linkurl'] ?></span>
    </div>
  <?php endif; ?>
</div>

