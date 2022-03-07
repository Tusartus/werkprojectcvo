<div class="form-group">
  <label for="title">Title</label>
  <input type="text" name="title" id="title" class="form-control" value="<?= (isset($q)?$q->getTitle():'') ?>" />
  <?php if (isset($formerrors['title'])): ?>
    <div class="alert alert-danger alert-dismissible mt-3">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <span class="form-error"><?= $formerrors['title'] ?></span>
    </div>
  <?php endif; ?>
</div>

<div class="form-group">
  <label for="title">description </label>
  <textarea type="text" name="description" id="content" cols="30" rows="10" class="form-control"  > <?= (isset($q)?$q->getDescription():'') ?></textarea>
  <?php if (isset($formerrors['description'])): ?>
    <div class="alert alert-danger alert-dismissible mt-3">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <span class="form-error"><?= $formerrors['description'] ?></span>
    </div>
  <?php endif; ?>
</div>

<div class="form-group">
  <label for="name"> url link: </label>
  <input type="text" name="linkurl" id="linkurl" class="form-control" value="<?= (isset($q)?$q->getLinkurl():'') ?>" />
  <?php if (isset($formerrors['linkurl'])): ?>
    <div class="alert alert-danger alert-dismissible mt-3">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <span class="form-error"><?= $formerrors['linkurl'] ?></span>
    </div>
  <?php endif; ?>
</div>

