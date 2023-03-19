<?php include('../../includes/header.php');
function format_number($number)
{
    return number_format($number, 0, '.', ' ');
}


?>

<script>
    function afficherPanier() {
        $.ajax({
            url: "/cookie_data.php",
            type: "GET",
            success: (response) => {
                $(".cart-tab tbody").empty()
                $('.totalPrice').empty()


                if (response != "") {
                    let totalPrice = 0;

                    const weapons = JSON.parse(response)
                    weapons.forEach(weapon => {
                        totalPrice += parseInt(weapon.price * weapon.quantity)
                        $(".cart-tab tbody").append(
                            "<tr>" +
                            "<td>x" + weapon.quantity + "</td>" +
                            "<td>" + weapon.name + "</td>" +
                            "<td>" + formatNumber(weapon.price * weapon.quantity) + "$</td>" +
                            "</tr>"
                        )
                    });

                    $('.totalPrice').append(
                        "<th></th>" +
                        "<th>Total : " + formatNumber(totalPrice) + "$ </th>" +
                        "<th></th>"
                    )
                }
            }
        });
    }

    $(document).ready(function() {
        $('.cart-form').submit(function(event) {
            event.preventDefault();

            var formData = $(this).serialize();

            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: formData,
                success: function(response) {
                    if (Array.isArray(response)) {
                        afficherPanier();
                    } else {
                        console.log('La réponse n\'est pas un tableau JSON valide');
                    }
                },
                error: function(xhr, status, error) {
                    console.log('Erreur b AJAX : ' + error);
                }
            });
        });

        $('.form-ammo').submit(function(event) {
            event.preventDefault();

            var formData = $(this).serialize();

            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: formData,
                success: function(response) {
                    if (Array.isArray(response)) {
                        afficherPanier();
                    } else {
                        console.log('La réponse n\'est pas un tableau JSON valide');
                    }
                },
                error: function(xhr, status, error) {
                    console.log('Erreur a AJAX : ' + error);
                }
            });
        });
    })
</script>


<div class="box-container">
    <?php foreach ($weapons as $data => $weapon) { ?>
        <div class="box">
            <figure>
                <figcaption><?= $weapon["name"] ?></figcaption>
                <img src="/media/img/weapons/<?= $weaponCategory ?>/<?= $weapon['name'] ?>.png" alt="Arme" width="<?= $imgSize ?>">
                <figcaption><?= format_number($weapon["price"]) ?>$</figcaption>

            </figure>
            <form action="/cookie.php" method="post" class="cart-form">
                <input type="hidden" name="name" value="<?= $weapon['name'] ?>">
                <input type="hidden" name="price" value="<?= $weapon["price"] ?>">
                <button type="submit" class="addToCart"><i class="fa-solid fa-plus"></i></button>
            </form>

        </div>
    <?php } ?>
    <div class="box">
        <figure>
            <figcaption>Munitions</figcaption>
            <img src="/media/img/weapons/ammo.png" alt="Arme" width="<?= $imgSize ?>">
            <figcaption>270$</figcaption>
        </figure>
        <button class="addToCart" id="ammoButton"><i class="fa-solid fa-plus"></i></button>
    </div>
</div>

<div class="overlay" id="ammoBox">
    <div class="ammoBox">
        <h1>Munitions</h1>
        <form action="/cookie.php" action="post" class="form-ammo">
            <input type="number" class="text" name="quantity"> <br>
            <input type="hidden" name="name" value="Boites de munitions">
            <input type="hidden" name="price" value="270">
            <div class="button">
                <input type="submit" id="ammo-add" value="Ajouter">
                <button id="ammo-cancel">Annuler</button>
            </div>
        </form>
    </div>
</div>

<?php include('../../includes/footer.php') ?>