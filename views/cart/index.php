<?php include ROOT . '/views/layouts/header.php'; ?>

<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">Shopping Cart</li>
            </ol>
        </div>
        <?php if($result) : ?>
            <p>Заказ оформлен</p>
        <?php else : ?>
        <div class="table-responsive cart_info">
            <table class="table table-condensed">
                <?php if($productsInCart): ?>
                <thead>
                <tr class="cart_menu">
                    <td class="image">Item</td>
                    <td class="description"></td>
                    <td class="price">Price</td>
                    <td class="quantity">Quantity</td>
                    <td class="total">Total</td>
                    <td></td>
                </tr>
                </thead>
                <?php foreach($products as $product) : ?>
                <tbody>
                <tr id="product_<?=$product['ID']?>">
                    <td class="cart_product">
                        <a href=""><img src="/template/images/home/<?=$product['image']?>" alt=""></a>
                    </td>
                    <td class="cart_description">
                        <h4><a href=""><?=$product['name']?></a></h4>
                        <p>Web ID: <?=$product['code']?></p>
                    </td>
                    <td class="cart_price">
                        <p class="cart_priceProduct" id="price_<?=$product['ID']?>">$<?=$product['price']?></p>
                    </td>
                    <td class="cart_quantity">
                        <div class="cart_quantity_button">
                            <a class="cart_quantity_up" href=""> + </a>
                            <form method="POST">
                            <input class="cart_quantity_input" data-id="<?=$product['ID']?>" type="text" id="quantity" value="<?=$productsInCart[$product['ID']]?>" autocomplete="off" size="2">
                            <a class="cart_quantity_down" href=""> - </a>
                        </div>
                    </td>
                    <td class="cart_total">
                        <p id="total_<?=$product['ID']?>" class="cart_total_price">$<?=$product['total']?></p>
                    </td>
                    <td class="cart_delete">
                        <a data-id="<?=$product['ID']?>" class="cart_quantity_delete" href=""><i class="fa fa-times"></i></a>
                    </td>
                </tr>
                </tbody>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</section> <!--/#cart_items-->

<section id="do_action">
    <div class="container">
        <div class="heading">
            <?php if(isset($errors) && is_array($errors)) : ?>
            <ul>
                <?php foreach($errors as $error): ?>
                <li> - <?=$error;?></li>
                <?php endforeach; ?>
            </ul>
            <?php endif; ?>
            <h3>What would you like to do next?</h3>
            <p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="chose_area">
                    <ul class="user_info">
                        <li class="single_field">
                            <label>Country:</label>
                            <select>
                                <option>United States</option>
                                <option>Bangladesh</option>
                                <option>UK</option>
                                <option>India</option>
                                <option>Pakistan</option>
                                <option>Ucrane</option>
                                <option>Canada</option>
                                <option>Dubai</option>
                            </select>

                        </li>
                        <li class="single_field">
                            <label>Region / State:</label>
                            <select>
                                <option>Select</option>
                                <option>Dhaka</option>
                                <option>London</option>
                                <option>Dillih</option>
                                <option>Lahore</option>
                                <option>Alaska</option>
                                <option>Canada</option>
                                <option>Dubai</option>
                            </select>

                        </li>
                            <li class="single_field zip-field">
                                <label>FCs:</label>
                                <input name="FCS" type="text">
                            </li>
                            <li class="single_field zip-field">
                                <label>Phone number:</label>
                                <input name="phone" type="tel">
                            </li>
                            <li class="single_field zip-field">
                                <label>Address:</label>
                                <input name="address" type="text">
                            </li>
                    </ul>
                        <input type="submit" name="submit" class="btn btn-default check_out" href="">
                    </form>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="total_area">
                    <ul>
                        <li>Shipping Cost <span>Free</span></li>
                        <li class="total_price">Total <span>$<?=$totalPrice?></span></li>
                    </ul>
                </div>
                <?php else : ?>
                    <p>Корзина пуста</p>
                <?php endif; endif;?>
            </div>
        </div>
    </div>
</section><!--/#do_action-->

<?php include ROOT . '/views/layouts/footer.php'; ?>
<script>
</script>
