<?php include ROOT . '/views/layouts/header.php'; ?>

    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <div class="left-sidebar">
                        <h2>Category</h2>
                        <div class="panel-group category-products" id="accordian"><!--category-productsr-->
                            <?php foreach($categories as $categoryItem): ?>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="<?php if($categoryId == $categoryItem['ID']) echo 'active';?>panel-title"><a href="/category/<?=$categoryItem['ID']?>"><?=$categoryItem['name']?> (<?=$categoryItem['count']?>)</a></h4>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div><!--/category-products-->

                        <div class="brands_products"><!--brands_products-->
                            <h2>Brands</h2>
                            <div class="brands-name">
                                <ul class="nav nav-pills nav-stacked">
                                    <?php foreach($brandList as $brand): ?>
                                        <li><a href="/brand/<?=$brand['ID']?>"> <span class="pull-right">(<?=$brand['count']?>)</span><?=$brand['name']?></a></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div><!--/brands_products-->
                    </div>
                </div>
                <div class="col-sm-9">
                    <div class="blog-post-area">
                        <h2 class="title text-center">Latest From our Blog</h2>
                        <?php foreach($posts as $post) :?>
                        <div class="single-blog-post">
                            <h3><?=$post['title']?></h3>
                            <div class="post-meta">
                                <ul>
                                    <li><i class="fa fa-calendar"></i><?=$post['date']?></li>
                                </ul>
                                <span>
                                    <?php for($i = 0; $i < $post['rating']; $i++) : ?>
                                    <?php if($i==ceil($post['rating']) - 1 && preg_match('/^\d+\.{1}\d+$/',$post['rating'])) : ?>
                                        <i class="fa fa-star-half-o"></i>
                                        <?php else : ?>
                                        <i class="fa fa-star"></i>
                                        <?php endif; endfor; ?>
								</span>
                            </div>
                            <a href="">
                                <img src="/template/images/blog/<?=$post['image']?>" alt="">
                            </a>
                            <p><?=substr($post['text'],0,335)?></p>
                            <a  class="btn btn-primary" href="/news/post/<?=$post['ID']?>">Read More</a>
                        </div>
                        <?php endforeach; ?>
                        <div class="pagination_div">
                            <?= $pagination->get(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php include ROOT . '/views/layouts/footer.php'; ?>