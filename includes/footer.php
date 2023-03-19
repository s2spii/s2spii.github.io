<script>
    const formatNumber = (number) => {
        number = parseInt(number)
        number = number.toLocaleString();
        number = number.replace(/,/g, " ")
        return number
    }

    $(document).ready(function() {

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

        afficherPanier()


    });

    function clearCart() {
        document.cookie = "my_cart=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
        afficherPanier()

    }

    function sendToDiscord() {
        $.ajax({
            url: "/cookie_data.php",
            type: "GET",
            success: (response) => {

                const weapons = JSON.parse(response)


                const data = {
                    "content": "||@here||",
                    "embeds": [{
                        "title": "Achat d'armes",
                        "description": "Une nouvelle commande est arrivé !",
                        "color": 9378587,
                        "fields": [{
                                "name": "Groupe:",
                                "value": "<?= $_SESSION["name"] ?>"
                            },
                            {
                                "name": "Armes:",
                                "value": ""
                            },
                            {
                                "name": "Prix Total:",
                                "value": ""
                            }
                        ]
                    }],
                    "attachments": [],
                };

                let weaponsValue = ""
                let weaponsPrice = 0
                weapons.forEach(weapon => {
                    const formatPricexQte = formatNumber(weapon.price * weapon.quantity)
                    const formatPrice = formatNumber(weapon.price)


                    weaponsValue += `x${weapon.quantity}  ${weapon.name}\n`
                    weaponsPrice += parseInt(weapon.price * weapon.quantity)
                });

                data.embeds[0].fields[1].value = weaponsValue
                data.embeds[0].fields[2].value = formatNumber(weaponsPrice) + "$"

                fetch("https://discord.com/api/webhooks/1086857370270965781/3BK8KZ-RbmrQ3HL27qphaf5HpTOW5TZbw4OIJVBqDtpBYOlfT9iABvmvpE3t63d5Lxcf", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json"
                        },
                        body: JSON.stringify(data)
                    })
                    .then(response => {
                        console.log("Commande envoyé");
                        clearCart(); // convertit la réponse en JSON
                    })
                    .catch(error => console.error(error));


            },
            error: function(xhr, status, error) {
                console.log('Erreur AJAX : ' + error);
            }
        })
    };
</script>


<div class="cart-show" id="cart-open"><i class="fa-solid fa-cart-shopping"></i></div>


<div class="overlay" id="cart">
    <div class="cart-box">
        <table class="cart-tab">
            <thead>
                <tr class="totalPrice">

                </tr>
                <tr>
                    <th id="cart-qty">Qté</th>
                    <th id="cart-weapons">Armes</th>
                    <th id="cart-price">Prix</th>
                </tr>

            </thead>
            <tbody>
            </tbody>
        </table>

    </div>

    <div class="cart-pay" id="cart-open" onclick="sendToDiscord(); $('.cart-tab .totalPrice').empty()"><i class="fa-solid fa-check"></i></div>
    <div class="cart-remove" id="cart-open" onclick="clearCart(); $('.totalPrice').empty()"><i class="fa-solid fa-trash"></i></div>
</div>

<script src="/cart.js"></script>
</body>

</html>