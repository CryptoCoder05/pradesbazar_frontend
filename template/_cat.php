<section id="cat">
  <!--Category list hide and show-->
  <div id="catlisthideshow" class="px-4 py-1 bg-light">
    <div class="font-rale font-size-14 container">
      <div class="row">
        <?php
          foreach ($Category->getParent() as $parent):
          ?>
        <div class="col-md-2 py-2">
          <h6 class="font-weight-bold">
            <a href="view_more.php?cat_id=<?=$parent['id'];?>" style="color:black;"><?=$parent['categories'];?></a>
          </h6>
          <ul style="list-style-type:none;margin:0;padding:0;">
            <?php
            foreach ($Category->getChild($parent['id']) as $child):
            ?>
            <li>
              <a href="categories.php?cat_id=<?=$child['id'];?>" style="color:black;"><?=$child['categories'];?></a>
            </li>
            <?php endforeach; ?>
          </ul>
        </div>
        <?php
          endforeach;
         ?>
      </div>
    </div>
  </div>
  <!--end of category list hide and show-->
</section>
